@extends('layouts.app')
@section('title', 'Detail Pesanan ' . $order->order_number)

@section('content')
    <div class="relative pt-32 pb-24 bg-[#09090b] min-h-screen w-full overflow-hidden">
        <div class="w-full px-6 md:px-12 lg:px-24 relative z-10">

            <!-- Top Header -->
            <div class="mb-10 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                <div>
                    <a href="{{ route('customer.orders') }}"
                        class="inline-flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-white transition-colors mb-4 group">
                        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Daftar
                    </a>
                    <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight">
                        Pantau <span class="text-blue-500">Pesanan.</span>
                    </h1>
                </div>
            </div>

            <!-- Kondisi Khusus: Pesanan Dibatalkan -->
            @if ($order->status === 'cancelled')
                <div
                    class="mb-8 p-6 bg-red-500/10 border border-red-500/20 rounded-4xl flex items-center gap-6 animate-pulse">
                    <div class="w-14 h-14 bg-red-500/20 rounded-2xl flex items-center justify-center text-red-500 shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-lg">Pesanan Dibatalkan</h4>
                        <p class="text-sm text-red-400/80">
                            {{ $order->payment && $order->payment->payment_status === 'refunded' ? 'Dana kamu telah diproses untuk pengembalian (Refund).' : 'Pesanan ini telah dibatalkan dan tidak diproses lebih lanjut.' }}
                        </p>
                    </div>
                </div>
            @endif

            <!-- Shopee Style Stepper (Hanya muncul jika tidak cancelled) -->
            @if ($order->status !== 'cancelled')
                <div class="mb-12 bg-[#121214] border border-white/5 rounded-[2.5rem] p-8 lg:p-10 shadow-xl">
                    <div
                        class="relative flex flex-col md:flex-row justify-between items-start md:items-center gap-8 md:gap-4">
                        <div class="absolute top-1/2 left-0 w-full h-0.5 bg-white/5 -translate-y-1/2 hidden md:block z-0">
                        </div>

                        @php
                            $statuses = [
                                [
                                    'key' => 'pending',
                                    'label' => 'Pesanan Dibuat',
                                    'icon' =>
                                        'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z',
                                ],
                                [
                                    'key' => 'processing',
                                    'label' => 'Diproses',
                                    'icon' =>
                                        'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
                                ],
                                ['key' => 'shipped', 'label' => 'Dikirim', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                                ['key' => 'completed', 'label' => 'Selesai', 'icon' => 'M5 13l4 4L19 7'],
                            ];
                            $currentIdx = collect($statuses)->pluck('key')->search($order->status);
                        @endphp

                        @foreach ($statuses as $index => $step)
                            <div
                                class="relative z-10 flex md:flex-col items-center gap-4 md:gap-3 flex-1 text-center font-sans">
                                <div
                                    class="w-12 h-12 rounded-2xl flex items-center justify-center transition-all duration-500 {{ $index <= $currentIdx ? 'bg-blue-600 text-white shadow-[0_0_20px_rgba(37,99,235,0.4)]' : 'bg-[#09090b] text-gray-600 border border-white/5' }}">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $step['icon'] }}"></path>
                                    </svg>
                                </div>
                                <div class="text-left md:text-center">
                                    <p
                                        class="text-sm font-bold {{ $index <= $currentIdx ? 'text-white' : 'text-gray-600' }}">
                                        {{ $step['label'] }}</p>
                                    @if ($index == $currentIdx)
                                        <p
                                            class="text-[10px] text-blue-400 font-mono mt-1 px-2 py-0.5 bg-blue-500/10 rounded-full inline-block">
                                            Status Saat Ini</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 lg:gap-12 items-start">
                <!-- KIRI: Rincian Produk & Logistik -->
                <div class="xl:col-span-2 space-y-8">
                    <!-- Detail Produk Card -->
                    <div class="bg-[#121214] border border-white/5 rounded-[2.5rem] p-8 lg:p-10 shadow-xl">
                        <div class="flex justify-between items-center mb-8 border-b border-white/5 pb-6">
                            <h3 class="text-lg font-bold text-white flex items-center gap-3">
                                <span class="w-1.5 h-6 bg-blue-600 rounded-full"></span>
                                Rincian Produk
                            </h3>
                            <span class="text-xs font-mono text-gray-500">ID: {{ $order->order_number }}</span>
                        </div>

                        <div class="space-y-4">
                            @foreach ($order->items as $item)
                                <div
                                    class="group flex items-center gap-6 p-5 bg-black/20 rounded-3xl border border-white/5 hover:border-white/10 transition-all">
                                    <div
                                        class="w-20 h-20 bg-[#1c1c1f] rounded-2xl flex items-center justify-center border border-white/5 shrink-0 overflow-hidden p-2">
                                        @if ($item->product && $item->product->images->isNotEmpty())
                                            <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}"
                                                class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-white font-bold text-base md:text-lg truncate">
                                            {{ $item->product_name }}</h4>
                                        <p class="text-sm text-gray-500 mt-1">Jumlah: <span
                                                class="text-gray-300 font-bold">{{ $item->quantity }}x</span></p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs text-gray-500 mb-1">Subtotal</p>
                                        <p class="text-white font-extrabold text-lg">Rp
                                            {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Info Pengiriman -->
                    <div class="bg-[#121214] border border-white/5 rounded-[2.5rem] p-8 lg:p-10 shadow-xl">
                        <h3 class="text-lg font-bold text-white mb-8 flex items-center gap-3">
                            <span class="w-1.5 h-6 bg-purple-600 rounded-full"></span>
                            Informasi Logistik
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <div class="space-y-4">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-purple-500/10 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-widest font-bold mb-1">Alamat
                                            Pengiriman</p>
                                        <p class="text-gray-300 text-sm leading-relaxed">{{ $order->shipping_address }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-black/30 rounded-3xl p-6 border border-white/5 relative overflow-hidden group">
                                <p class="text-xs text-gray-500 uppercase tracking-widest font-bold mb-2">Kurir Pilihan</p>
                                <p class="text-white font-bold text-xl mb-4">{{ $order->shipping_method }}</p>
                                <p class="text-xs text-gray-500 uppercase tracking-widest font-bold mb-2">Nomor Resi</p>
                                @if ($order->tracking_number)
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="text-blue-400 font-mono font-bold tracking-widest text-lg">{{ $order->tracking_number }}</span>
                                    </div>
                                @else
                                    <span class="text-gray-600 italic text-sm">Sedang disiapkan...</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KANAN: Ringkasan & Pembayaran -->
                <div class="xl:col-span-1 space-y-8 font-sans">
                    <div
                        class="bg-[#121214] border border-white/5 rounded-[2.5rem] p-8 lg:p-10 sticky top-32 shadow-2xl overflow-hidden">

                        <!-- Logic Tombol Cancel / Status Selesai -->
                        <div class="mb-8">
                            @if ($order->status === 'pending' && $order->canBeCancelled())
                                <div class="p-6 bg-orange-500/5 border border-orange-500/10 rounded-4xl text-center mb-8">
                                    <p class="text-[10px] text-orange-500 uppercase font-bold tracking-widest mb-2">Batas
                                        Waktu Pembatalan</p>
                                    <div id="cancelTimer"
                                        class="text-3xl font-mono font-bold text-white tracking-tighter mb-4">
                                        10 Menit
                                    </div>
                                    <form action="{{ route('customer.orders.cancel', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="w-full py-4 bg-red-500 hover:bg-red-600 text-white rounded-2xl font-bold text-sm transition-all shadow-lg shadow-red-500/20">
                                            Batalkan Pesanan
                                        </button>
                                    </form>
                                </div>
                            @elseif($order->status === 'completed')
                                <div class="p-6 bg-green-500/10 border border-green-500/20 rounded-4xl text-center mb-8">
                                    <div
                                        class="w-12 h-12 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-3 text-green-400">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-white font-bold">Pesanan Selesai</p>
                                    <p class="text-[11px] text-gray-500 mt-1 uppercase tracking-wider">Terima kasih telah
                                        berbelanja!</p>
                                </div>
                            @endif

                            <h3 class="text-lg font-bold text-white mb-6">Ringkasan Biaya</h3>
                            <div class="space-y-5 mb-8 relative z-10">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-500">Subtotal Pesanan</span>
                                    <span class="text-white font-medium">Rp
                                        {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-500">Ongkos Kirim</span>
                                    <span class="text-white font-medium">Rp
                                        {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                                </div>
                                <div
                                    class="pt-6 mt-6 border-t border-dashed border-white/10 flex justify-between items-end">
                                    <div>
                                        <span
                                            class="block text-gray-500 text-[10px] uppercase font-bold tracking-widest mb-1">Total
                                            yang dibayar</span>
                                        <span
                                            class="text-2xl font-extrabold text-transparent bg-clip-text bg-linear-to-r from-blue-400 to-indigo-300">
                                            Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-black/40 rounded-3xl p-6 border border-white/5">
                                <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold mb-4">Metode
                                    Pembayaran</p>
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center shrink-0 border border-white/5">
                                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-white font-bold text-sm">
                                            {{ $order->payment->payment_method ?? 'Transfer Bank' }}</p>
                                        @php
                                            $statusClasses = [
                                                'success' => 'text-green-400 bg-green-500/10 border-green-500/20',
                                                'pending' => 'text-yellow-400 bg-yellow-500/10 border-yellow-500/20',
                                                'failed' => 'text-red-400 bg-red-500/10 border-red-500/20',
                                                'refunded' => 'text-purple-400 bg-purple-500/10 border-purple-500/20',
                                            ];
                                            $pStatus = $order->payment->payment_status ?? 'pending';
                                        @endphp
                                        <span
                                            class="inline-block mt-1 px-2 py-0.5 rounded-md text-[10px] font-bold border {{ $statusClasses[$pStatus] ?? $statusClasses['pending'] }}">
                                            {{ strtoupper(str_replace('_', ' ', $pStatus)) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 pt-6 border-t border-white/5">
                                <a href="{{ route('customer.orders.invoice', $order->id) }}" target="_blank"
                                    class="w-full py-3.5 bg-white/5 hover:bg-white/10 text-white rounded-2xl font-bold text-sm transition-all border border-white/10 flex items-center justify-center gap-2 group">
                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    Cetak Invoice Resmi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
