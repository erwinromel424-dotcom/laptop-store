<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class CustomerOrderController extends Controller
{
    public function index()
    {
        // Ambil semua pesanan milik user yang sedang login, urutkan dari terbaru
        $orders = Order::where('user_id', Auth::id())
            ->with(['items.product', 'payment'])
            ->latest()
            ->paginate(10);

        return view('front.orders.index', compact('orders'));
    }

    public function show(string $order_number)
    {
        // Cari pesanan berdasarkan nomor order, PASTIKAN itu milik user yang sedang login
        $order = Order::where('order_number', $order_number)
            ->where('user_id', Auth::id())
            ->with(['items.product', 'payment'])
            ->firstOrFail();

        return view('front.orders.show', compact('order'));
    }

    public function downloadInvoice(string $id)
    {
        $order = Order::with(['items.product', 'payment', 'user'])->findOrFail($id);
        $pdf = Pdf::loadView('front.orders.invoice-pdf', compact('order'));
        
        return $pdf->download('invoice-' . $order->order_number . '.pdf');
    }
}
