<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['items.product', 'user', 'payment']);
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled',
            'tracking_number' => 'nullable|string|max:100'
        ]);

        if (in_array($order->status, ['completed', 'cancelled'])) {
            return redirect()->back()->with('error', 'Status pesanan yang sudah selesai/batal tidak dapat diubah.');
        }

        try {
            DB::beginTransaction();

            // 1. Logika Pembatalan (Balikin Stok)
            if ($request->status === 'cancelled') {
                foreach ($order->items as $item) {
                    if ($item->product) {
                        $item->product->increment('stock', $item->quantity);
                    }
                }
            }

            // 2. Logika Transfer: konfirmasi pembayaran sekaligus proses pesanan
            if ($request->status === 'processing' && $order->payment) {
                $paymentMethod = strtolower($order->payment->payment_method ?? '');
                if ($paymentMethod !== 'cod' && $order->payment->payment_status !== 'success') {
                    $order->payment->update([
                        'payment_status' => 'success',
                        'paid_at' => now()
                    ]);
                }
            }

            // 3. Logika Selesai (Khusus COD)
            if ($request->status === 'completed') {
                // Gunakan strtolower untuk antisipasi perbedaan input/data
                if (strtolower($order->shipping_method) === 'cod' || ($order->payment && strtolower($order->payment->payment_method) === 'cod')) {
                    if ($order->payment) {
                        $order->payment->update([
                            'payment_status' => 'success', // Sesuai migration: payment_status
                            'paid_at' => now()
                        ]);
                    }
                }
            }

            // 4. Update Data Pesanan
            $order->update([
                'status' => $request->status,
                'tracking_number' => $request->tracking_number ?? $order->tracking_number
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function confirmPayment(Order $order)
    {
        // Pastikan payment exist
        if (!$order->payment) {
            return redirect()->back()->with('error', 'Data pembayaran tidak ditemukan.');
        }

        // Ambil method dari table payment (lebih akurat)
        $method = strtolower($order->payment->payment_method);

        // Khusus untuk pesanan TRANSFER (Bukan COD)
        if ($method !== 'cod') {
            $order->payment->update([
                'payment_status' => 'success', // Sesuai migration: payment_status
                'paid_at' => now()
            ]);

            // Opsional: Setelah bayar dikonfirmasi, otomatis pindahkan ke 'processing'
            if ($order->status === 'pending') {
                $order->update(['status' => 'processing']);
            }

            return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi!');
        }

        return redirect()->back()->with('error', 'Gagal mengonfirmasi pembayaran. Metode COD dikonfirmasi otomatis saat status SELESAI.');
    }

    public function destroy(Order $order)
    {
        if (in_array($order->status, ['completed', 'cancelled'])) {
            return redirect()->back()->with('error', 'Data riwayat tidak boleh dihapus.');
        }

        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }

    public function exportPDF()
    {
        // Ambil semua data pesanan beserta relasi user-nya
        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();

        // Hitung total nilai akumulasi untuk ringkasan di atas halaman laporan
        $totalSales = $orders->where('status', 'completed')->sum('grand_total');
        $pendingSales = $orders->where('status', 'pending')->sum('grand_total');

        $countCompleted = $orders->where('status', 'completed')->count();
        $countPending = $orders->where('status', 'pending')->count();
        $countProcessing = $orders->where('status', 'processing')->count();
        $countCancelled = $orders->where('status', 'cancelled')->count();

        // Render template khusus PDF daftar pesanan
        $pdf = Pdf::loadView('admin.orders.index-pdf', compact(
            'orders',
            'totalSales',
            'pendingSales',
            'countCompleted',
            'countPending',
            'countProcessing',
            'countCancelled'
        ))->setPaper('a4', 'portrait'); // Menggunakan ukuran A4 Portrait

        return $pdf->download('Laporan_Daftar_Pesanan_' . Carbon::now()->format('d_M_Y') . '.pdf');
    }

    public function exportDetailPDF(string $id)
    {
        // Eager loading seluruh relasi yang dibutuhkan agar render cepat & hemat query
        $order = Order::with(['items.product', 'payment', 'user'])->findOrFail($id);

        // Buat PDF dari view khusus invoice admin
        $pdf = Pdf::loadView('admin.orders.show-pdf', compact('order'))->setPaper('a4', 'portrait');

        // Berikan nama file unik sesuai nomor invoice pesanan
        return $pdf->download('Invoice_Admin_' . $order->order_number . '.pdf');
    }
}
