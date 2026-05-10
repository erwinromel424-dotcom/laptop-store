@extends('layouts.admin')

@section('title', 'Dashboard Analitik')
@section('header', 'Overview System')

@section('content')
    <!-- Header Actions -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-white tracking-tight">Metrik Penjualan</h2>
            <p class="text-gray-400 text-sm mt-1">Pantau performa dan aktivitas e-market secara real-time.</p>
        </div>
        <div class="flex gap-3 w-full md:w-auto">
            <button
                class="flex md:flex-none justify-center items-center gap-2 px-4 py-2.5 bg-[#121214] border border-white/10 rounded-xl text-sm font-medium text-white hover:bg-white/5 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                Export PDF
            </button>
            <button
                class="flex md:flex-none justify-center items-center gap-2 px-4 py-2.5 bg-blue-600 rounded-xl text-sm font-bold text-white hover:bg-blue-500 transition-all shadow-[0_0_15px_rgba(37,99,235,0.3)]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Data Baru
            </button>
        </div>
    </div>

    <!-- Grid Statistik dengan Indikator Trend -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <!-- Card 1: Revenue -->
        <div
            class="bg-[#121214] border border-white/5 rounded-2xl p-6 relative overflow-hidden group hover:border-white/20 transition-all">
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-green-500/10 rounded-full blur-[50px] -mr-10 -mt-10 group-hover:bg-green-500/20 transition-all">
            </div>
            <div class="flex justify-between items-start relative z-10">
                <div>
                    <p class="text-xs font-bold tracking-widest text-gray-500 uppercase mb-2">Pendapatan</p>
                    <h3 class="text-2xl font-extrabold text-white">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                </div>
                <div class="p-3 bg-[#09090b] border border-white/10 rounded-xl text-green-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs font-medium relative z-10">
                @if ($revenueTrend >= 0)
                    <span class="text-green-400 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        +{{ number_format($revenueTrend, 1) }}%
                    </span>
                @else
                    <span class="text-red-400 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"></path>
                        </svg>
                        {{ number_format($revenueTrend, 1) }}%
                    </span>
                @endif
                <span class="text-gray-500 ml-2">dari bulan lalu</span>
            </div>
        </div>

        <!-- Card 2: Orders -->
        <div
            class="bg-[#121214] border border-white/5 rounded-2xl p-6 relative overflow-hidden group hover:border-white/20 transition-all">
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-blue-500/10 rounded-full blur-[50px] -mr-10 -mt-10 group-hover:bg-blue-500/20 transition-all">
            </div>
            <div class="flex justify-between items-start relative z-10">
                <div>
                    <p class="text-xs font-bold tracking-widest text-gray-500 uppercase mb-2">Pesanan</p>
                    <h3 class="text-2xl font-extrabold text-white">{{ $totalOrders }} <span
                            class="text-sm font-medium text-gray-500">Unit</span></h3>
                </div>
                <div class="p-3 bg-[#09090b] border border-white/10 rounded-xl text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs font-medium relative z-10">
                @if ($ordersTrend >= 0)
                    <span class="text-green-400 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        +{{ number_format($ordersTrend, 1) }}%
                    </span>
                @else
                    <span class="text-red-400 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"></path>
                        </svg>
                        {{ number_format($ordersTrend, 1) }}%
                    </span>
                @endif
                <span class="text-gray-500 ml-2">dari bulan lalu</span>
            </div>
        </div>

        <!-- Card 3: Products -->
        <div
            class="bg-[#121214] border border-white/5 rounded-2xl p-6 relative overflow-hidden group hover:border-white/20 transition-all">
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-purple-500/10 rounded-full blur-[50px] -mr-10 -mt-10 group-hover:bg-purple-500/20 transition-all">
            </div>
            <div class="flex justify-between items-start relative z-10">
                <div>
                    <p class="text-xs font-bold tracking-widest text-gray-500 uppercase mb-2">Katalog</p>
                    <h3 class="text-2xl font-extrabold text-white">{{ $totalProducts }} <span
                            class="text-sm font-medium text-gray-500">Item</span></h3>
                </div>
                <div class="p-3 bg-[#09090b] border border-white/10 rounded-xl text-purple-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs font-medium relative z-10">
                @if ($lowStockProducts > 0)
                    <span class="text-red-400 flex items-center gap-1 font-bold animate-pulse">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                        {{ $lowStockProducts }} produk butuh restock!
                    </span>
                @else
                    <span class="text-gray-400 flex items-center gap-1">Stok aman terkendali</span>
                @endif
            </div>
        </div>

        <!-- Card 4: Customers -->
        <div
            class="bg-[#121214] border border-white/5 rounded-2xl p-6 relative overflow-hidden group hover:border-white/20 transition-all">
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-orange-500/10 rounded-full blur-[50px] -mr-10 -mt-10 group-hover:bg-orange-500/20 transition-all">
            </div>
            <div class="flex justify-between items-start relative z-10">
                <div>
                    <p class="text-xs font-bold tracking-widest text-gray-500 uppercase mb-2">Pelanggan</p>
                    <h3 class="text-2xl font-extrabold text-white">{{ $totalCustomers }} <span
                            class="text-sm font-medium text-gray-500">User</span></h3>
                </div>
                <div class="p-3 bg-[#09090b] border border-white/10 rounded-xl text-orange-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs font-medium relative z-10">
                <span class="text-green-400 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    +{{ $newCustomersThisWeek }} Baru
                </span>
                <span class="text-gray-500 ml-2">minggu ini</span>
            </div>
        </div>
    </div>

    <!-- Section Tengah: Grafik CSS & Produk Terlaris -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

        <!-- Chart Area Real-Database -->
        <div class="lg:col-span-2 bg-[#121214] border border-white/5 rounded-2xl p-6">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h3 class="text-lg font-bold text-white">Grafik Pendapatan</h3>
                    <p class="text-xs text-gray-500 mt-1">7 Hari Terakhir</p>
                </div>
            </div>

            <!-- CSS Bar Chart Representation -->
            <div class="h-52 flex items-end justify-between gap-2 sm:gap-6 border-b border-white/10 pb-2 relative">
                <!-- Garis Horizontal Latar (Grid) -->
                <div class="absolute inset-0 flex flex-col justify-between pointer-events-none opacity-20">
                    <div class="border-t border-white/20 w-full"></div>
                    <div class="border-t border-white/20 w-full"></div>
                    <div class="border-t border-white/20 w-full"></div>
                </div>

                <!-- Looping Data Grafik dari Controller -->
                @foreach ($chartData as $data)
                    @php
                        // Menghitung persentase tinggi bar (minimal 5% agar bar tetap terlihat meski 0)
                        $heightPercent = $data['revenue'] > 0 ? ($data['revenue'] / $maxRevenue) * 100 : 5;
                    @endphp
                    <div class="w-full relative group flex flex-col justify-end h-full">
                        <div
                            class="absolute -top-8 left-1/2 -translate-x-1/2 bg-white text-black text-xs font-bold px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity z-20 whitespace-nowrap">
                            Rp {{ number_format($data['revenue'], 0, ',', '.') }}
                        </div>
                        <div class="{{ $heightPercent == 100 ? 'bg-blue-500 shadow-[0_0_15px_rgba(37,99,235,0.5)]' : 'bg-blue-600/50 hover:bg-blue-500' }} w-full rounded-t-md transition-all duration-500"
                            style="height: {{ $heightPercent }}%;"></div>
                    </div>
                @endforeach
            </div>
            <!-- Labels Bawah Chart -->
            <div class="flex justify-between mt-3 text-xs text-gray-500 px-1">
                @foreach ($chartData as $data)
                    <span class="{{ $loop->last ? 'text-white font-bold' : '' }}">{{ $data['day_name'] }}</span>
                @endforeach
            </div>
        </div>

        <!-- Top Products List Real-Database -->
        <div class="bg-[#121214] border border-white/5 rounded-2xl p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-white">Top Laptop</h3>
                <a href="#" class="text-xs font-bold text-blue-500 hover:text-blue-400">Terlaris</a>
            </div>

            <div class="space-y-5">
                @forelse($topProducts as $index => $topProduct)
                    <div class="flex items-center gap-4 group">
                        <div
                            class="w-12 h-12 bg-[#09090b] rounded-xl border border-white/5 flex items-center justify-center text-xl font-bold text-blue-500 group-hover:scale-110 transition-transform">
                            #{{ $index + 1 }}
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <h4 class="text-sm font-bold text-white truncate">{{ $topProduct->product_name }}</h4>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $topProduct->total_sold }} Terjual</p>
                        </div>
                        <div class="text-sm font-bold text-green-400 whitespace-nowrap">
                            Rp {{ number_format($topProduct->total_revenue / 1000000, 1) }}M
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center h-full text-center opacity-50 pt-4">
                        <span class="text-3xl mb-2">📦</span>
                        <p class="text-sm text-gray-400">Belum ada data penjualan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Tabel Transaksi Dark Mode Premium -->
    <div class="bg-[#121214] border border-white/5 rounded-2xl overflow-hidden shadow-2xl">
        <div class="px-6 py-5 border-b border-white/5 flex justify-between items-center">
            <h3 class="text-lg font-bold text-white">Riwayat Transaksi Terbaru</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#09090b] text-gray-400 text-xs uppercase tracking-widest border-b border-white/5">
                        <th class="px-6 py-4 font-bold">Order ID</th>
                        <th class="px-6 py-4 font-bold">Pelanggan</th>
                        <th class="px-6 py-4 font-bold">Tanggal</th>
                        <th class="px-6 py-4 font-bold">Total Harga</th>
                        <th class="px-6 py-4 font-bold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse ($recentOrders as $order)
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="px-6 py-5">
                                <span
                                    class="text-sm font-bold text-gray-300 group-hover:text-white transition-colors">{{ $order->order_number }}</span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-9 h-9 rounded-full bg-blue-600/20 border border-blue-500/30 text-blue-500 flex items-center justify-center font-bold text-sm">
                                        {{ substr($order->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <span
                                            class="block text-sm font-bold text-gray-200">{{ $order->user->name }}</span>
                                        <span class="block text-xs text-gray-500">{{ $order->user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-sm text-gray-400">
                                {{ $order->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-5 text-sm font-bold text-white">
                                Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-5">
                                @if ($order->status === 'completed')
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-500/10 text-green-400 border border-green-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Selesai
                                    </span>
                                @elseif($order->status === 'pending')
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-yellow-500/10 text-yellow-400 border border-yellow-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 animate-pulse"></span> Menunggu
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-500/10 text-gray-400 border border-gray-500/20">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/5 mb-4">
                                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-400 font-medium tracking-wide">Belum ada transaksi terekam.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
