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
use Illuminate\Support\Str;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua data customer dan produk yang sudah di-generate sebelumnya
        $customers = User::where('role', 'customer')->get();
        $products = Product::all();

        // Guard clause: Pastikan ada data customer dan produk
        if ($customers->isEmpty() || $products->isEmpty()) {
            return;
        }

        // ==========================================
        // SKENARIO 1: Keranjang Belanja Aktif
        // ==========================================
        // Kita buatkan keranjang berisi barang untuk 3 customer pertama
        foreach ($customers->take(3) as $customer) {
            $cart = Cart::create(['user_id' => $customer->id]);

            // Masukkan 1-2 produk secara acak ke keranjang mereka
            $cartProducts = $products->random(rand(1, 2));
            foreach ($cartProducts as $product) {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => rand(1, 2),
                ]);
            }
        }

        // ==========================================
        // SKENARIO 2: Riwayat Transaksi 7 Hari Terakhir
        // ==========================================
        $statuses = ['pending', 'processing', 'shipped', 'completed', 'cancelled'];
        $shippingMethods = ['JNE Reguler', 'J&T Express', 'SiCepat BEST', 'GoSend Instant'];

        $orderCounter = 1;

        // Looping untuk 7 hari ke belakang (agar Grafik di Dashboard Admin terisi penuh)
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);

            // Simulasi ada 2 sampai 5 transaksi per harinya
            $dailyTransactions = rand(2, 5);

            for ($j = 0; $j < $dailyTransactions; $j++) {
                // Pilih customer dan alamatnya secara acak
                $customer = $customers->random();
                $address = $customer->addresses->first();

                if (!$address) continue; // Lewati jika customer tidak punya alamat

                // Pilih 1 atau 2 jenis produk secara acak untuk dibeli
                $orderProducts = $products->random(rand(1, 2));
                $subtotal = 0;
                $orderItemsData = [];

                foreach ($orderProducts as $product) {
                    $qty = rand(1, 2);
                    $subtotal += ($product->price * $qty);

                    // Simpan data item pesanan sementara
                    $orderItemsData[] = [
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'price' => $product->price,
                        'quantity' => $qty,
                    ];
                }

                $shippingCost = rand(2, 10) * 10000; // Ongkir random antara Rp 20.000 - Rp 100.000
                $grandTotal = $subtotal + $shippingCost;

                // Bobot probabilitas: 70% pesanan selesai (completed) agar grafik pendapatan naik
                $status = rand(1, 100) <= 70 ? 'completed' : $statuses[array_rand($statuses)];

                // 1. Buat Order (Pesanan Utama)
                $order = Order::create([
                    'user_id' => $customer->id,
                    'order_number' => 'INV-' . $date->format('Ymd') . '-' . str_pad($orderCounter, 4, '0', STR_PAD_LEFT),
                    'status' => $status,
                    'subtotal' => $subtotal,
                    'shipping_cost' => $shippingCost,
                    'grand_total' => $grandTotal,
                    'shipping_address' => $address->full_address . ', ' . $address->city . ' - ' . $address->postal_code,
                    'shipping_method' => $shippingMethods[array_rand($shippingMethods)],
                    'tracking_number' => in_array($status, ['shipped', 'completed']) ? 'RESI' . strtoupper(Str::random(10)) : null,
                    'notes' => rand(0, 1) ? 'Tolong packing kayu yang aman ya, jangan dibanting.' : null,
                    // Manipulasi tanggal agar seolah-olah terjadi di masa lalu
                    'created_at' => $date->copy()->addHours(rand(8, 20)),
                    'updated_at' => $date->copy()->addHours(rand(8, 20)),
                ]);

                // 2. Simpan Order Items
                foreach ($orderItemsData as $itemData) {
                    $itemData['order_id'] = $order->id;
                    OrderItem::create($itemData);
                }

                // 3. Simpan Riwayat Pembayaran
                $paymentStatus = in_array($status, ['processing', 'shipped', 'completed']) ? 'success' : ($status === 'cancelled' ? 'failed' : 'pending');

                Payment::create([
                    'order_id' => $order->id,
                    'payment_method' => 'Bank Transfer - Virtual Account BCA',
                    'payment_status' => $paymentStatus,
                    'amount' => $grandTotal,
                    // Jika sukses, waktu bayar selisih 15-60 menit dari waktu pesan
                    'paid_at' => $paymentStatus === 'success' ? $order->created_at->copy()->addMinutes(rand(15, 60)) : null,
                ]);

                $orderCounter++;
            }
        }
    }
}
