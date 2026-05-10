<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
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
}
