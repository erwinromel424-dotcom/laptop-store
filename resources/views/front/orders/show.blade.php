@extends('layouts.app')
@section('title', 'Detail Pesanan ' . $order->order_number)

@section('content')
    <div class="relative pt-32 pb-24 bg-[#09090b] min-h-screen w-full overflow-hidden">
        <div class="w-full px-6 md:px-12 lg:px-24 relative z-10">

            <div class="mb-10 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                <div>
                    <a href="{{ route('customer.orders') }}"
                        class="inline-flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-white transition-colors mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Daftar
                    </a>
                    <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight">
                        Detail <span class="text-gray-600">Pesanan.</span>
                    </h1>
                </div>

                <!-- Print Button (Opsional / Estetika) -->
                <button onclick="window.print()"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white/5 border border-white/10 text-white font-bold hover:bg-white/10 transition-colors shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                        </path>
                    </svg>
                    Unduh Invoice
                </button>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 lg:gap-12">

                <!-- KIRI: Rincian Produk & Pengiriman -->
                <div class="xl:col-span-2 space-y-8">

                    <!-- Header Invoice Card -->
                    <div
                        class="bg-linear-to-br from-[#121214] to-[#0a0a0c] border border-white/5 rounded-[2.5rem] p-8 lg:p-10 shadow-xl relative overflow-hidden">
                        <div
                            class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8 border-b border-white/5 pb-8">
                            <div>
                                <span class="text-xs text-gray-500 uppercase tracking-widest font-bold block mb-1">Nomor
                                    Invoice</span>
                                <h2 class="text-2xl md:text-3xl font-mono font-bold text-white">{{ $order->order_number }}
                                </h2>
                                <p class="text-sm text-gray-500 mt-2">Dipesan pada:
                                    {{ $order->created_at->format('d F Y, H:i') }}</p>
                            </div>
                            <div class="text-left md:text-right">
                                <span class="text-xs text-gray-500 uppercase tracking-widest font-bold block mb-2">Status
                                    Pesanan</span>
                                @if ($order->status === 'completed')
                                    <span
                                        class="inline-flex px-4 py-2 rounded-xl text-sm font-bold bg-green-500/10 text-green-400 border border-green-500/20">Transaksi
                                        Selesai</span>
                                @elseif($order->status === 'shipped')
                                    <span
                                        class="inline-flex px-4 py-2 rounded-xl text-sm font-bold bg-purple-500/10 text-purple-400 border border-purple-500/20">Dalam
                                        Pengiriman</span>
                                @elseif($order->status === 'processing')
                                    <span
                                        class="inline-flex px-4 py-2 rounded-xl text-sm font-bold bg-blue-500/10 text-blue-400 border border-blue-500/20">Sedang
                                        Diproses</span>
                                @elseif($order->status === 'cancelled')
                                    <span
                                        class="inline-flex px-4 py-2 rounded-xl text-sm font-bold bg-red-500/10 text-red-400 border border-red-500/20">Dibatalkan</span>
                                @else
                                    <span
                                        class="inline-flex px-4 py-2 rounded-xl text-sm font-bold bg-yellow-500/10 text-yellow-400 border border-yellow-500/20">Menunggu
                                        Pembayaran</span>
                                @endif
                            </div>
                        </div>

                        <!-- Daftar Item -->
                        <h3 class="text-lg font-bold text-white mb-4">Daftar Produk</h3>
                        <div class="space-y-4">
                            @foreach ($order->items as $item)
                                <div class="flex items-center gap-6 p-4 bg-[#050505] rounded-2xl border border-white/5">
                                    <div
                                        class="w-16 h-16 bg-[#121214] rounded-xl flex items-center justify-center border border-white/5 shrink-0 p-2">
                                        @if ($item->product && $item->product->images->isNotEmpty())
                                            <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}"
                                                class="w-full h-full object-contain">
                                        @else
                                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-white font-bold text-sm sm:text-base">{{ $item->product_name }}</h4>
                                        <p class="text-sm text-gray-500 mt-1">{{ $item->quantity }} x Rp
                                            {{ number_format($item->price, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <p class="text-white font-extrabold">Rp
                                            {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Info Pengiriman -->
                    <div
                        class="bg-linear-to-br from-[#121214] to-[#0a0a0c] border border-white/5 rounded-[2.5rem] p-8 lg:p-10 shadow-xl">
                        <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                </path>
                            </svg>
                            Informasi Pengiriman
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-widest font-bold mb-2">Kurir & Resi</p>
                                <p class="text-white font-bold text-lg">{{ $order->shipping_method }}</p>
                                @if ($order->tracking_number)
                                    <div
                                        class="mt-3 inline-flex items-center gap-3 px-4 py-2 rounded-xl bg-blue-500/10 border border-blue-500/20">
                                        <span
                                            class="text-blue-400 font-mono font-bold tracking-widest">{{ $order->tracking_number }}</span>
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500 mt-1 italic">Nomor resi belum tersedia</p>
                                @endif
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-widest font-bold mb-2">Alamat Tujuan</p>
                                <div class="p-4 bg-[#050505] rounded-2xl border border-white/5">
                                    <p class="text-sm text-gray-300 leading-relaxed">{{ $order->shipping_address }}</p>
                                </div>
                            </div>
                        </div>

                        @if ($order->notes)
                            <div class="mt-6 p-4 bg-yellow-500/5 border border-yellow-500/10 rounded-2xl">
                                <p class="text-xs text-yellow-600 uppercase tracking-widest font-bold mb-1">Catatan Pembeli
                                </p>
                                <p class="text-sm text-yellow-400/80">{{ $order->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- KANAN: Rincian Pembayaran -->
                <div class="xl:col-span-1">
                    <div
                        class="bg-linear-to-br from-[#121214] to-[#0a0a0c] border border-white/5 rounded-[2.5rem] p-8 lg:p-10 sticky top-32 shadow-2xl">
                        <h3 class="text-lg font-bold text-white mb-6">Ringkasan Pembayaran</h3>

                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between items-center text-sm text-gray-400">
                                <span>Subtotal Produk</span>
                                <span class="text-white font-medium">Rp
                                    {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm text-gray-400">
                                <span>Biaya Pengiriman</span>
                                <span class="text-white font-medium">Rp
                                    {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                            </div>

                            <div class="pt-6 mt-6 border-t border-dashed border-white/20 flex justify-between items-end">
                                <span class="block text-white font-bold">Total Akhir</span>
                                <span
                                    class="text-2xl font-extrabold text-transparent bg-clip-text bg-linear-to-r from-blue-400 to-cyan-300">
                                    Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <div class="bg-[#050505] border border-white/5 rounded-2xl p-5 mb-8">
                            <span class="text-[10px] text-gray-500 uppercase tracking-widest font-bold block mb-2">Metode
                                Pembayaran</span>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white font-bold text-sm">
                                        {{ $order->payment->payment_method ?? 'Transfer Bank' }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Status: <span
                                            class="font-bold {{ $order->payment && $order->payment->payment_status === 'success' ? 'text-green-400' : 'text-yellow-400' }}">{{ ucfirst($order->payment->payment_status ?? 'Pending') }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- CTA Call Center -->
                        <a href="#"
                            class="flex w-full h-14 bg-white/5 border border-white/10 text-white rounded-xl font-bold text-sm transition-all hover:bg-white/10 items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                            Butuh Bantuan?
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
