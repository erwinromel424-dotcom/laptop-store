<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    // Daftar Kurir diselaraskan dengan TransactionSeeder
    private $shippingOptions = [
        'JNE Reguler' => 50000,
        'J&T Express' => 45000,
        'SiCepat BEST' => 60000,
        'GoSend Instant' => 100000,
    ];

    public function index()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanjamu kosong.');
        }

        /** @var \App\Models\User $user */
        $address = $user->addresses()->where('is_primary', true)->first();
        if (!$address) {
            $address = $user->addresses()->first();
        }

        $cartItems = $cart->items()->with('product')->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Kirim opsi kurir ke view
        $shippingOptions = $this->shippingOptions;

        return view('front.checkout', compact('user', 'address', 'cartItems', 'subtotal', 'shippingOptions'));
    }

    public function process(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index');
        }

        // Validasi input form agar tidak dimanipulasi inspect element
        $request->validate([
            'shipping_method' => 'required|string|in:' . implode(',', array_keys($this->shippingOptions)),
            'payment_method' => 'required|string',
            'notes' => 'nullable|string|max:500',
        ]);

        /** @var \App\Models\User $user */
        $address = $user->addresses()->where('is_primary', true)->first();
        if (!$address) {
            return back()->with('error', 'Kamu belum memiliki alamat pengiriman. Silakan tambah di profil.');
        }

        try {
            DB::beginTransaction();

            $cartItems = $cart->items()->with('product')->get();
            $subtotal = 0;

            // Validasi Stok Realtime
            foreach ($cartItems as $item) {
                if ($item->product->stock < $item->quantity) {
                    throw new \Exception("Stok untuk produk {$item->product->name} tidak mencukupi.");
                }
                $subtotal += $item->product->price * $item->quantity;
            }

            // Ambil harga ongkir berdasarkan pilihan yang valid
            $shippingCost = $this->shippingOptions[$request->shipping_method];
            $grandTotal = $subtotal + $shippingCost;
            $orderNumber = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(6));

            // Buat Record Order
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => $orderNumber,
                'status' => 'pending',
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'grand_total' => $grandTotal,
                'shipping_address' => "{$address->recipient_name} ({$address->phone_number}) - {$address->full_address}, {$address->city}, {$address->postal_code}",
                'shipping_method' => $request->shipping_method,
                'notes' => $request->notes,
            ]);

            // Buat Record OrderItems & Potong Stok Produk
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            // Buat Record Pembayaran
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'amount' => $grandTotal,
            ]);

            $cart->items()->delete();

            DB::commit();

            return redirect()->route('checkout.success', $order->order_number);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }

    // ... method success tetap sama seperti sebelumnya
    public function success(string $order_number)
    {
        $order = Order::where('order_number', $order_number)->where('user_id', Auth::id())->firstOrFail();
        return view('front.checkout-success', compact('order'));
    }
}
