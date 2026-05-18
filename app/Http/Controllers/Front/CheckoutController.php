<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Address; // Pastikan import Model Address
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
    private $shippingOptions = [
        'JNE Reguler' => 50000,
        'J&T Express' => 45000,
        'GoSend Instant' => 100000,
    ];

    public function index()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanjamu kosong.');
        }

        // AMBIL SEMUA ALAMAT: Agar bisa tampil di dropdown view
        /** @var \App\Models\User $user */
        $addresses = $user->addresses()->latest()->get();

        $cartItems = $cart->items()->with('product')->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $shippingOptions = $this->shippingOptions;

        // Kirim $addresses (jamak) ke view
        return view('front.checkout', compact('user', 'addresses', 'cartItems', 'subtotal', 'shippingOptions'));
    }

    public function process(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index');
        }

        // VALIDASI: Tambahkan address_id karena sekarang dikirim dari select dropdown
        $request->validate([
            'address_id' => 'required|exists:addresses,id,user_id,' . $user->id,
            'shipping_method' => 'required|string|in:' . implode(',', array_keys($this->shippingOptions)),
            'payment_method' => 'required|string',
            'notes' => 'nullable|string|max:500',
        ]);

        // Cari alamat yang dipilih user berdasarkan ID yang dikirim
        $address = Address::find($request->address_id);

        try {
            DB::beginTransaction();

            $cartItems = $cart->items()->with('product')->get();
            $subtotal = 0;

            foreach ($cartItems as $item) {
                if ($item->product->stock < $item->quantity) {
                    throw new \Exception("Stok untuk produk {$item->product->name} tidak mencukupi.");
                }
                $subtotal += $item->product->price * $item->quantity;
            }

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

            // Record Pembayaran (Mendukung COD dan VA)
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending', // Keduanya mulai dari pending
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

    public function success(string $order_number)
    {
        $order = Order::where('order_number', $order_number)
            ->where('user_id', Auth::id())
            ->with(['items', 'payment']) // Eager load untuk efisiensi di view success
            ->firstOrFail();

        return view('front.checkout-success', compact('order'));
    }

    public function uploadProof(Request $request, string $order_id)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $order = Order::where('id', $order_id)->where('user_id', Auth::id())->firstOrFail();

        if ($request->hasFile('payment_proof')) {
            // Simpan file ke folder storage/app/public/payments/proofs
            $path = $request->file('payment_proof')->store('payments/proofs', 'public');

            // Update kolom payment_proof di tabel payments (relasi dari Order)
            $order->payment->update([
                'payment_proof' => $path,
                'payment_status' => 'pending'
            ]);
        }

        return back()->with('success', 'Bukti berhasil diunggah!');
    }

    public function cancelOrder(string $id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($order->canBeCancelled()) {
            $order->update(['status' => 'cancelled']);

            // Kembalikan stok produk
            foreach ($order->items as $item) {
                $item->product?->increment('stock', $item->quantity);
            }

            if ($order->payment) {
                // Jika metode transfer, set ke refunded. Jika COD, tetap cancelled.
                $newStatus = ($order->payment->payment_method !== 'COD') ? 'refunded' : 'failed';
                $order->payment->update(['payment_status' => $newStatus]);
            }

            return back()->with('success', 'Pesanan berhasil dibatalkan.');
        }

        return back()->with('error', 'Waktu pembatalan sudah habis (maksimal 10 menit).');
    }
}
