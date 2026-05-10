<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Menampilkan semua pesanan diurutkan dari yang paling baru
        $orders = Order::with('user')->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Load relasi item pesanan, data produk (meski sudah dihapus/withTrashed), user, dan info pembayaran
        $order->load(['items.product', 'user', 'payment']);
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        // 1. SECURITY PATCH: Cek apakah status pesanan sudah final
        if (in_array($order->status, ['completed', 'cancelled'])) {
            return redirect()->back()->with('error', 'Akses ditolak! Pesanan yang sudah berstatus ' . strtoupper($order->status) . ' bersifat permanen dan tidak dapat diubah lagi.');
        }

        // 2. Validasi input
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled'
        ]);

        // 3. Update status
        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui menjadi ' . strtoupper($request->status));
    }

    public function destroy(Order $order)
    {
        // Untuk menjaga integritas data keuangan, pesanan yang sudah 'completed' tidak boleh dihapus sembarangan
        if ($order->status === 'completed') {
            return redirect()->route('admin.orders.index')->with('error', 'Pesanan yang sudah selesai tidak dapat dihapus untuk keperluan riwayat keuangan.');
        }

        // Hapus pesanan (cascade akan otomatis menghapus order_items dan payment jika di-set di migration)
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Data pesanan berhasil dihapus.');
    }
}
