@extends('layouts.admin')
@section('title', 'Manajemen Pesanan')
@section('header', 'Data Pesanan Masuk')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-white">Daftar Transaksi</h2>
    </div>

    <!-- Alerts -->
    @if (session('success'))
        <div
            class="mb-4 px-4 py-3 bg-green-500/10 border border-green-500/20 text-green-400 rounded-xl flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 px-4 py-3 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                </path>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-[#121214] border border-white/5 rounded-2xl overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#09090b] text-gray-400 text-xs uppercase tracking-widest border-b border-white/5">
                        <th class="px-6 py-4 font-bold">Order ID / Tgl</th>
                        <th class="px-6 py-4 font-bold">Pelanggan</th>
                        <th class="px-6 py-4 font-bold">Total Nilai</th>
                        <th class="px-6 py-4 font-bold">Status</th>
                        <th class="px-6 py-4 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($orders as $order)
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="px-6 py-4">
                                <span
                                    class="text-sm font-bold text-gray-200 group-hover:text-white transition-colors block mb-1">{{ $order->order_number }}</span>
                                <span class="text-xs text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-blue-500/20 text-blue-400 flex items-center justify-center font-bold text-xs shrink-0">
                                        {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-200">{{ $order->user->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-blue-400">Rp
                                    {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($order->status === 'completed')
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-500/10 text-green-400 border border-green-500/20">Selesai</span>
                                @elseif($order->status === 'shipped')
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-purple-500/10 text-purple-400 border border-purple-500/20">Dikirim</span>
                                @elseif($order->status === 'processing')
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-500/10 text-blue-400 border border-blue-500/20">Diproses</span>
                                @elseif($order->status === 'cancelled')
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-500/10 text-red-400 border border-red-500/20">Dibatalkan</span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-yellow-500/10 text-yellow-400 border border-yellow-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 animate-pulse"></span> Menunggu
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex justify-end gap-2">
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                    class="p-2 bg-blue-600/20 text-blue-400 hover:text-white hover:bg-blue-600 rounded-lg transition-colors border border-blue-500/30">
                                    Detail / Proses
                                </a>
                                @if ($order->status !== 'completed')
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">
                                        @csrf @method('DELETE')
                                        <button
                                            class="p-2 bg-white/5 text-gray-400 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-colors border border-white/5 hover:border-red-500/20">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">Belum ada pesanan yang masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($orders->hasPages())
            <div class="p-4 border-t border-white/5">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection
