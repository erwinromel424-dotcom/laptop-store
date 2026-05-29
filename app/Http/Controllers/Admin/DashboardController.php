<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Data Card Statistik Utama (Total Keseluruhan)
        $totalCustomers = User::where('role', 'customer')->count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('grand_total');

        // --- LOGIKA TREND STATISTIK ---
        $startOfThisMonth = Carbon::now()->startOfMonth();
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();
        $startOfThisWeek = Carbon::now()->startOfWeek();

        // Trend Pendapatan (Bulan Ini vs Bulan Lalu)
        $revenueThisMonth = Order::where('status', 'completed')->where('created_at', '>=', $startOfThisMonth)->sum('grand_total');
        $revenueLastMonth = Order::where('status', 'completed')->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->sum('grand_total');
        $revenueTrend = $revenueLastMonth > 0 ? (($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth) * 100 : ($revenueThisMonth > 0 ? 100 : 0);

        // Trend Pesanan (Bulan Ini vs Bulan Lalu)
        $ordersThisMonth = Order::where('created_at', '>=', $startOfThisMonth)->count();
        $ordersLastMonth = Order::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();
        $ordersTrend = $ordersLastMonth > 0 ? (($ordersThisMonth - $ordersLastMonth) / $ordersLastMonth) * 100 : ($ordersThisMonth > 0 ? 100 : 0);

        // Stok Produk Menipis (Stok <= 5)
        $lowStockProducts = Product::where('stock', '<=', 5)->count();

        // Pelanggan Baru Minggu Ini
        $newCustomersThisWeek = User::where('role', 'customer')->where('created_at', '>=', $startOfThisWeek)->count();
        // ------------------------------

        // 2. Data Transaksi Terbaru
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        // 3. Logika Grafik Pendapatan (7 Hari Terakhir)
        $chartData = [];
        $maxRevenue = 1;

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dailyRevenue = Order::where('status', 'completed')
                ->whereDate('created_at', $date->toDateString())
                ->sum('grand_total');

            $chartData[] = [
                'day_name' => $date->translatedFormat('D'),
                'revenue' => $dailyRevenue,
                'formatted' => number_format($dailyRevenue / 1000000, 1) . 'M'
            ];
        }

        $highestDaily = max(array_column($chartData, 'revenue'));
        if ($highestDaily > 0) {
            $maxRevenue = $highestDaily;
        }

        // 4. Logika Produk Terlaris
        $topProducts = OrderItem::select('product_name', DB::raw('SUM(quantity) as total_sold'), DB::raw('SUM(price * quantity) as total_revenue'))
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->groupBy('product_name')
            ->orderByDesc('total_sold')
            ->take(3)
            ->get();

        return view('admin.dashboard', compact(
            'totalCustomers',
            'totalProducts',
            'totalOrders',
            'totalRevenue',
            'recentOrders',
            'chartData',
            'maxRevenue',
            'topProducts',
            'revenueTrend',
            'ordersTrend',
            'lowStockProducts',
            'newCustomersThisWeek'
        ));
    }

    public function exportPDF()
    {
        // 1. Ambil data metrik (sesuaikan logika query ini dengan dashboard utama kamu)
        $totalRevenue = Order::where('status', 'completed')->sum('grand_total');
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'customer')->count(); // Asumsi field role

        // Indikator tren dummy / real dari database kamu
        $revenueTrend = 12.5;
        $ordersTrend = 8.3;
        $lowStockProducts = Product::where('stock', '<', 5)->count();
        $newCustomersThisWeek = User::where('role', 'customer')
            ->where('created_at', '>=', Carbon::now()->startOfWeek())->count();

        // 2. Data Grafik Pendapatan 7 Hari Terakhir
        // (Gunakan data array/koleksi yang sama persis dengan index 'revenue' dan 'day_name')
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $revenue = Order::where('status', 'completed')
                ->whereDate('created_at', $date->toDateString())
                ->sum('grand_total');

            $chartData[] = [
                'day_name' => $date->isoFormat('dddd'), // contoh: Senin, Selasa
                'revenue' => $revenue
            ];
        }
        $maxRevenue = collect($chartData)->max('revenue') ?: 1;

        // 3. Top 5 Produk Terlaris
        $topProducts = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select(
                'products.name',
                DB::raw('SUM(order_items.quantity) as total_sold'),
                DB::raw('SUM(order_items.price * order_items.quantity) as total_revenue')
            )
            ->groupBy('products.id', 'products.name')
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();

        // 4. Riwayat Transaksi Terbaru
        $recentOrders = Order::with('user')->orderBy('created_at', 'desc')->take(5)->get();

        // Render ke View PDF khusus laporan eksekutif
        $pdf = Pdf::loadView('admin.dashboard-pdf', compact(
            'totalRevenue',
            'revenueTrend',
            'totalOrders',
            'ordersTrend',
            'totalProducts',
            'lowStockProducts',
            'totalCustomers',
            'newCustomersThisWeek',
            'chartData',
            'maxRevenue',
            'topProducts',
            'recentOrders'
        ))->setPaper('a4', 'portrait');

        return $pdf->download('Laporan_Analitik_Dashboard_' . Carbon::now()->format('d_M_Y') . '.pdf');
    }
}
