@extends('layouts.admin')
@section('title', 'Manajemen Pesanan')
@section('header', 'Data Pesanan Masuk')

@section('content')
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-extrabold text-white tracking-tight">Daftar Transaksi</h2>
            <p class="text-sm text-gray-400 mt-1">Pantau dan kelola seluruh pesanan masuk dari pelanggan.</p>
        </div>

        <a href="{{ route('admin.orders.pdf') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold rounded-xl transition-colors shadow-lg shadow-blue-600/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Cetak Laporan PDF
        </a>
    </div>

    <!-- Alerts -->
    @if (session('success'))
        <div
            class="mb-6 px-5 py-4 bg-green-500/10 border border-green-500/20 rounded-2xl flex items-center gap-3 backdrop-blur-sm">
            <div class="w-8 h-8 rounded-full bg-green-500/20 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <p class="text-sm font-medium text-green-400">{{ session('success') }}</p>
        </div>
    @endif

    @if (session('error'))
        <div
            class="mb-6 px-5 py-4 bg-red-500/10 border border-red-500/20 rounded-2xl flex items-center gap-3 backdrop-blur-sm">
            <div class="w-8 h-8 rounded-full bg-red-500/20 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                    </path>
                </svg>
            </div>
            <p class="text-sm font-medium text-red-400">{{ session('error') }}</p>
        </div>
    @endif

    <!-- Table Section -->
    <div class="bg-[#121214] border border-white/5 rounded-3xl overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-[#09090b] text-gray-400 text-[11px] uppercase tracking-widest border-b border-white/5">
                        <th class="px-6 py-5 font-bold">Order ID / Tanggal</th>
                        <th class="px-6 py-5 font-bold">Pelanggan</th>
                        <th class="px-6 py-5 font-bold">Total Nilai</th>
                        <th class="px-6 py-5 font-bold">Status</th>
                        <th class="px-6 py-5 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($orders as $order)
                        <tr class="hover:bg-white/2 transition-colors group">
                            <!-- Kolom Order ID & Tanggal -->
                            <td class="px-6 py-5">
                                <span
                                    class="text-sm font-extrabold text-gray-200 group-hover:text-white transition-colors block mb-1">
                                    {{ $order->order_number }}
                                </span>
                                <div class="flex items-center gap-2 text-xs text-gray-500">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </div>
                            </td>

                            <!-- Kolom Pelanggan -->
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-9 h-9 rounded-full bg-linear-to-br from-gray-700 to-gray-900 border border-white/10 text-white flex items-center justify-center font-bold text-sm shadow-inner shrink-0">
                                        {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-200">{{ $order->user->name }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Kolom Total Nilai -->
                            <td class="px-6 py-5">
                                <span
                                    class="text-sm font-bold text-blue-400 bg-blue-400/10 px-3 py-1.5 rounded-lg border border-blue-400/20">
                                    Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                                </span>
                            </td>

                            <!-- Kolom Status -->
                            <td class="px-6 py-5">
                                @php
                                    $statusConfig = [
                                        'pending' => ['label' => 'Menunggu', 'color' => 'yellow', 'pulse' => true],
                                        'processing' => ['label' => 'Diproses', 'color' => 'blue', 'pulse' => false],
                                        'shipped' => ['label' => 'Dikirim', 'color' => 'purple', 'pulse' => false],
                                        'completed' => ['label' => 'Selesai', 'color' => 'green', 'pulse' => false],
                                        'cancelled' => ['label' => 'Dibatalkan', 'color' => 'red', 'pulse' => false],
                                    ];
                                    $currentStatus = $statusConfig[$order->status] ?? $statusConfig['pending'];
                                @endphp

                                <span
                                    class="inline-flex items-center gap-2 pr-3 py-1.5 rounded-xl text-xs font-bold bg-{{ $currentStatus['color'] }}-500/10 text-{{ $currentStatus['color'] }}-400 border border-{{ $currentStatus['color'] }}-500/20">
                                    <span
                                        class="w-1.5 h-1.5 rounded-full bg-{{ $currentStatus['color'] }}-400 {{ $currentStatus['pulse'] ? 'animate-pulse' : '' }}"></span>
                                    {{ $currentStatus['label'] }}
                                </span>
                            </td>

                            <!-- Kolom Aksi -->
                            <td class="px-6 py-5 text-right">
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 border border-white/10 text-gray-300 hover:text-white hover:bg-white/10 rounded-xl text-sm font-medium transition-all group-hover:border-white/20">
                                    Detail
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <!-- Empty State -->
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div
                                        class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center mb-4 border border-white/10">
                                        <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-white font-bold text-lg mb-1">Belum Ada Pesanan</h3>
                                    <p class="text-gray-500 text-sm">Pesanan yang masuk dari pelanggan akan muncul di sini.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($orders->hasPages())
            <div class="px-6 py-4 border-t border-white/5 bg-[#09090b]">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection
