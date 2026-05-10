<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil data yang sudah dibuat dari seeder sebelumnya
        $customer = User::where('email', 'jihan@gmail.com')->first();
        $product = Product::where('sku', 'LNV-IPS3-002')->first();

        // --- Skenario 1: Keranjang Belanja Aktif ---
        $cart = Cart::create(['user_id' => $customer->id]);
        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        // --- Skenario 2: Riwayat Transaksi Sukses ---
        $order = Order::create([
            'user_id' => $customer->id,
            'order_number' => 'INV-' . date('Ymd') . '-0001',
            'status' => 'completed',
            'subtotal' => $product->price,
            'shipping_cost' => 50000,
            'grand_total' => $product->price + 50000,
            'shipping_address' => $customer->addresses->first()->full_address . ', ' . $customer->addresses->first()->city,
            'shipping_method' => 'JNE Reguler',
            'tracking_number' => 'JNEXX123456789',
            'notes' => 'Tolong packing kayu ya.',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'product_name' => $product->name, // Snapshot nama
            'price' => $product->price,       // Snapshot harga
            'quantity' => 1,
        ]);

        Payment::create([
            'order_id' => $order->id,
            'payment_method' => 'Bank Transfer - BCA',
            'payment_status' => 'success',
            'amount' => $order->grand_total,
            'paid_at' => now(),
        ]);
    }
}
