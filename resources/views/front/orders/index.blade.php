@extends('layouts.app')
@section('title', 'Pesanan Saya | LaptopStore')

@section('content')
    <div class="relative pt-32 pb-24 bg-[#09090b] min-h-screen w-full overflow-hidden">
        <!-- Ambient Glow -->
        <div
            class="absolute top-20 left-0 w-[30vw] h-[40vh] bg-blue-900/10 blur-[150px] pointer-events-none transform -translate-x-1/4">
        </div>

        <div class="w-full px-6 md:px-12 lg:px-24 relative z-10">

            <div class="flex items-center gap-4 mb-10">
                <div
                    class="w-12 h-12 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center shadow-inner">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight">
                    Pesanan <span class="text-gray-600">Saya.</span>
                </h1>
            </div>

            @if ($orders->isEmpty())
                <div
                    class="bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/5 rounded-[3rem] p-16 md:p-24 text-center flex flex-col items-center shadow-2xl">
                    <div
                        class="w-24 h-24 rounded-full bg-white/5 flex items-center justify-center mb-6 shadow-inner border border-white/10">
                        <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-4">Belum Ada Transaksi</h3>
                    <p class="text-gray-400 mb-10 text-lg max-w-md">Kamu belum melakukan pemesanan apa pun. Mari mulai
                        perjalanan teknologimu hari ini.</p>
                    <a href="{{ url('/katalog') }}"
                        class="inline-flex justify-center items-center px-10 py-4 font-bold text-[#09090b] bg-white rounded-full hover:bg-gray-200 transition-all duration-300 hover:scale-105 shadow-[0_0_30px_rgba(255,255,255,0.15)]">
                        Mulai Belanja
                    </a>
                </div>
            @else
                <div class="space-y-6">
                    @foreach ($orders as $order)
                        <div
                            class="bg-linear-to-r from-[#121214] to-[#0a0a0c] border border-white/5 rounded-[2.5rem] p-6 lg:p-8 flex flex-col lg:flex-row gap-8 justify-between items-start lg:items-center group hover:border-white/20 transition-colors shadow-lg">

                            <!-- Info Dasar Pesanan -->
                            <div class="flex-1 w-full space-y-4">
                                <div class="flex flex-wrap items-center gap-4">
                                    <span
                                        class="text-sm font-mono text-gray-400 bg-white/5 px-3 py-1 rounded-lg border border-white/10">{{ $order->order_number }}</span>
                                    <span
                                        class="text-sm text-gray-500 font-medium">{{ $order->created_at->format('d M Y, H:i') }}</span>

                                    <!-- Status Badge -->
                                    @if ($order->status === 'completed')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-500/10 text-green-400 border border-green-500/20"><span
                                                class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Selesai</span>
                                    @elseif($order->status === 'shipped')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-purple-500/10 text-purple-400 border border-purple-500/20"><span
                                                class="w-1.5 h-1.5 rounded-full bg-purple-500 animate-pulse"></span> Sedang
                                            Dikirim</span>
                                    @elseif($order->status === 'processing')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-500/10 text-blue-400 border border-blue-500/20"><span
                                                class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Diproses</span>
                                    @elseif($order->status === 'cancelled')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-500/10 text-red-400 border border-red-500/20"><span
                                                class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Dibatalkan</span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-yellow-500/10 text-yellow-400 border border-yellow-500/20"><span
                                                class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span> Menunggu</span>
                                    @endif
                                </div>

                                <!-- Ringkasan Item -->
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-16 h-16 rounded-xl bg-[#050505] flex items-center justify-center p-2 border border-white/5 shrink-0">
                                        @if ($order->items->first()->product && $order->items->first()->product->images->isNotEmpty())
                                            <img src="{{ asset('storage/' . $order->items->first()->product->images->first()->image_path) }}"
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
                                    <div>
                                        <h4 class="text-white font-bold text-base leading-tight line-clamp-1">
                                            {{ $order->items->first()->product_name }}</h4>
                                        <p class="text-sm text-gray-500">
                                            @if ($order->items->count() > 1)
                                                + {{ $order->items->count() - 1 }} produk lainnya
                                            @else
                                                1 Produk
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Total & Aksi -->
                            <div
                                class="w-full lg:w-auto flex flex-col sm:flex-row lg:flex-col items-center sm:items-end justify-between gap-4 border-t lg:border-t-0 border-white/5 pt-4 lg:pt-0">
                                <div class="text-left sm:text-right w-full sm:w-auto">
                                    <span
                                        class="block text-[10px] text-gray-500 uppercase tracking-widest font-bold mb-1">Total
                                        Belanja</span>
                                    <span class="text-xl font-extrabold text-blue-400">Rp
                                        {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                                </div>
                                <a href="{{ route('customer.orders.show', $order->order_number) }}"
                                    class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 font-bold text-white bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-colors">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($orders->hasPages())
                    <div
                        class="mt-12 p-6 bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/5 rounded-4xl">
                        {{ $orders->links() }}
                    </div>
                @endif
            @endif

        </div>
    </div>
@endsection
