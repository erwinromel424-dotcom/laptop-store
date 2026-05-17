<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Cari keranjang user yang sedang login, atau buat baru jika belum punya
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        // Ambil item keranjang beserta relasi produk dan gambarnya
        $cartItems = CartItem::with(['product.images'])->where('cart_id', $cart->id)->latest()->get();

        // Hitung total harga keranjang
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('front.cart', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Cek stok
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stok produk tidak mencukupi.');
        }

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        // Cek apakah produk sudah ada di keranjang
        $existingItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($existingItem) {
            // Jika ada, tambahkan quantity-nya (tapi cek stok total dulu)
            $newQty = $existingItem->quantity + $request->quantity;
            if ($newQty > $product->stock) {
                return back()->with('error', 'Gagal menambahkan! Total kuantitas melebihi stok yang tersedia.');
            }
            $existingItem->update(['quantity' => $newQty]);
        } else {
            // Jika belum ada, buat item baru
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, String $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $product = $cartItem->product;

        if ($request->action === 'increase') {
            if ($cartItem->quantity < $product->stock) {
                $cartItem->increment('quantity');
            }
        } elseif ($request->action === 'decrease') {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
            } else {
                $cartItem->delete(); // Hapus jika dikurangi dari 1
            }
        }
    
        return back();
    }

    public function destroy(String $id)
    {
        CartItem::findOrFail($id)->delete();
        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
