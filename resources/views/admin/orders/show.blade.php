@extends('layouts.admin')
@section('title', 'Detail Pesanan #' . $order->order_number)

@section('content')
    <!-- Header & Navigation -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.orders.index') }}"
                class="group p-3 bg-white/5 border border-white/10 text-gray-400 rounded-2xl hover:bg-white/10 hover:text-white transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-extrabold text-white tracking-tight">Detail Pesanan</h2>
                <p class="text-sm text-gray-500">Invoice <span
                        class="text-gray-300 font-mono">{{ $order->order_number }}</span></p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            @php
                $statusConfig = [
                    'pending' => ['label' => 'Menunggu', 'color' => 'yellow'],
                    'processing' => ['label' => 'Diproses', 'color' => 'blue'],
                    'shipped' => ['label' => 'Dikirim', 'color' => 'purple'],
                    'completed' => ['label' => 'Selesai', 'color' => 'green'],
                    'cancelled' => ['label' => 'Dibatalkan', 'color' => 'red'],
                ];
                $currentStatus = $statusConfig[$order->status] ?? $statusConfig['pending'];
            @endphp
            <span
                class="px-4 py-2 rounded-xl text-xs font-bold bg-{{ $currentStatus['color'] }}-500/10 text-{{ $currentStatus['color'] }}-400 border border-{{ $currentStatus['color'] }}-500/20 uppercase tracking-widest">
                ● {{ $currentStatus['label'] }}
            </span>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
        <div
            class="mb-6 px-5 py-4 bg-green-500/10 border border-green-500/20 text-green-400 rounded-2xl flex items-center gap-3 animate-fade-in">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Kolom Kiri: Informasi Pesanan -->
        <div class="lg:col-span-2 space-y-8">

            <!-- Grid Info Pelanggan & Pembayaran -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kartu Pelanggan -->
                <div class="bg-[#121214] border border-white/5 rounded-3xl p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-6 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <h3 class="text-xs font-bold uppercase tracking-widest">Informasi Pelanggan</h3>
                    </div>
                    <p class="text-lg font-bold text-white mb-2">{{ $order->user->name }}</p>
                    <p
                        class="text-sm text-gray-400 leading-relaxed bg-[#09090b] p-4 rounded-2xl border border-white/5 italic">
                        "{{ $order->shipping_address }}"
                    </p>
                </div>

                <!-- Kartu Pembayaran -->
                <div class="bg-[#121214] border border-white/5 rounded-3xl p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-6 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                            </path>
                        </svg>
                        <h3 class="text-xs font-bold uppercase tracking-widest">Metode & Status</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center pb-3 border-b border-white/5">
                            <span class="text-sm text-gray-500">Metode</span>
                            <span
                                class="text-sm font-bold text-white uppercase">{{ $order->payment->payment_method ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-white/5">
                            <span class="text-sm text-gray-500">Status Bayar</span>
                            <span
                                class="text-sm font-bold text-emerald-400 uppercase tracking-tighter">{{ $order->payment->payment_status ?? 'Pending' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Total Transaksi</span>
                            <span class="text-base font-black text-blue-400">Rp
                                {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Produk -->
            <div class="bg-[#121214] border border-white/5 rounded-3xl overflow-hidden shadow-sm">
                <div class="p-6 border-b border-white/5 flex justify-between items-center bg-white/2">
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider">Item Pesanan</h3>
                    <span class="text-xs text-gray-500">{{ count($order->items) }} Produk</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] text-gray-500 uppercase tracking-widest border-b border-white/5">
                                <th class="px-8 py-4">Produk</th>
                                <th class="px-8 py-4 text-center">Jumlah</th>
                                <th class="px-8 py-4 text-right">Harga Satuan</th>
                                <th class="px-8 py-4 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach ($order->items as $item)
                                <tr class="group hover:bg-white/2 transition-colors text-sm">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-gray-500 border border-white/10 group-hover:border-white/20">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <span
                                                class="font-bold text-gray-200 group-hover:text-white">{{ $item->product->name ?? $item->product_name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-center font-mono text-gray-400">{{ $item->quantity }}x</td>
                                    <td class="px-8 py-5 text-right text-gray-400">Rp
                                        {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="px-8 py-5 text-right font-bold text-white text-base">
                                        Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-8 bg-[#09090b]/50 border-t border-white/5 flex justify-end">
                    <div class="text-right space-y-1">
                        <p class="text-xs text-gray-500 uppercase font-bold tracking-widest">Total Bayar</p>
                        <p class="text-3xl font-black text-white tracking-tighter">Rp
                            {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Bukti Pembayaran -->
            @if (strtolower(optional($order->payment)->payment_method) !== 'cod')
                <div class="bg-[#121214] border border-white/5 rounded-3xl p-8">
                    <h3 class="text-sm font-bold text-white uppercase tracking-widest mb-6">Bukti Pembayaran</h3>
                    @if (optional($order->payment)->payment_proof)
                        <div class="relative group max-w-sm rounded-3xl overflow-hidden border border-white/10 shadow-2xl">
                            <img src="{{ asset('storage/' . $order->payment->payment_proof) }}" alt="Proof"
                                class="w-full h-auto object-cover">
                            <a href="{{ asset('storage/' . $order->payment->payment_proof) }}" target="_blank"
                                class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="bg-white text-black px-6 py-2 rounded-full font-bold text-sm">Lihat
                                    Fullscreen</span>
                            </a>
                        </div>
                    @else
                        <div
                            class="flex flex-col items-center justify-center py-12 border-2 border-dashed border-white/5 rounded-3xl">
                            <p class="text-gray-500 italic">Belum ada lampiran bukti pembayaran.</p>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Kolom Kanan: Panel Aksi -->
        <div class="lg:col-span-1">
            <div class="bg-[#121214] border border-white/5 rounded-3xl p-6 sticky top-8 shadow-2xl">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-1.5 h-6 bg-blue-600 rounded-full"></div>
                    <h3 class="text-lg font-black text-white tracking-tight uppercase">Admin Control</h3>
                </div>

                @if (in_array($order->status, ['completed', 'cancelled']))
                    <div class="p-6 bg-white/5 border border-white/10 rounded-2xl text-center">
                        <svg class="w-10 h-10 text-gray-600 mx-auto mb-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                        <p class="text-sm text-gray-400 font-medium">Transaksi Terkunci</p>
                        <p class="text-[10px] text-gray-600 uppercase mt-1">Status Final ({{ $order->status }})</p>
                    </div>
                @else
                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        @if ($order->status === 'pending')
                            <div class="p-4 bg-blue-500/5 border border-blue-500/20 rounded-2xl mb-2">
                                <p class="text-xs text-blue-400 leading-relaxed font-medium">
                                    Konfirmasi akan mengubah status menjadi <span class="font-bold">Proses</span>. Pastikan
                                    pembayaran valid.
                                </p>
                            </div>
                            <input type="hidden" name="status" value="processing">
                            <button type="submit"
                                class="w-full py-4 bg-blue-600 hover:bg-blue-500 text-white rounded-2xl font-bold transition-all shadow-lg shadow-blue-900/20">
                                Konfirmasi & Proses
                            </button>
                        @elseif($order->status === 'processing')
                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">No. Resi
                                    Pengiriman</label>
                                <input type="text" name="tracking_number" required placeholder="Input resi kurir..."
                                    class="w-full bg-[#09090b] border border-white/10 rounded-2xl px-4 py-4 text-white focus:border-purple-500 focus:ring-1 focus:ring-purple-500 outline-none transition-all placeholder:text-gray-700">
                            </div>
                            <input type="hidden" name="status" value="shipped">
                            <button type="submit"
                                class="w-full py-4 bg-purple-600 hover:bg-purple-500 text-white rounded-2xl font-bold transition-all shadow-lg shadow-purple-900/20">
                                Update Resi & Kirim
                            </button>
                        @elseif($order->status === 'shipped')
                            <div class="p-4 bg-green-500/5 border border-green-500/20 rounded-2xl mb-2">
                                <p class="text-xs text-green-400 leading-relaxed font-medium">
                                    Tandai pesanan telah sampai dan diterima dengan baik oleh pelanggan.
                                </p>
                            </div>
                            <input type="hidden" name="status" value="completed">
                            <button type="submit"
                                class="w-full py-4 bg-green-600 hover:bg-green-500 text-white rounded-2xl font-bold transition-all shadow-lg shadow-green-900/20">
                                Selesaikan Pesanan
                            </button>
                        @endif
                    </form>

                    <!-- Pembatalan -->
                    @if (in_array($order->status, ['pending', 'processing']))
                        <div class="mt-8 pt-6 border-t border-white/5">
                            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit"
                                    onclick="return confirm('Yakin batalkan pesanan? Stok akan dikembalikan.')"
                                    class="w-full py-3 text-red-500/60 hover:text-red-400 hover:bg-red-500/5 rounded-2xl text-xs font-bold transition-all">
                                    Batalkan Transaksi
                                </button>
                            </form>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
