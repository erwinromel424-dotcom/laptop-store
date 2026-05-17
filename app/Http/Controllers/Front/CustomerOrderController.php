<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;

class CustomerOrderController extends Controller
{
    public function index()
    {
        // Ambil semua pesanan milik user yang sedang login, urutkan dari terbaru
        $orders = Order::where('user_id', auth()->id())
            ->with(['items.product', 'payment'])
            ->latest()
            ->paginate(10);

        return view('front.orders.index', compact('orders'));
    }

    public function show($order_number)
    {
        // Cari pesanan berdasarkan nomor order, PASTIKAN itu milik user yang sedang login
        $order = Order::where('order_number', $order_number)
            ->where('user_id', auth()->id())
            ->with(['items.product', 'payment'])
            ->firstOrFail();

        return view('front.orders.show', compact('order'));
    }
}
