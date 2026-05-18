@extends('layouts.admin')
@section('title', 'Detail Pesanan')
@section('header', 'Invoice: ' . $order->order_number)

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.orders.index') }}"
            class="px-4 py-2 bg-white/5 border border-white/10 text-white rounded-xl text-sm font-bold hover:bg-white/10 transition-colors">←
            Kembali ke Daftar</a>
    </div>

    <!-- Alert Success -->
    @if (session('success'))
        <div
            class="mb-6 px-4 py-3 bg-green-500/10 border border-green-500/20 text-green-400 rounded-xl flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Kiri: Detail Informasi Pesanan (Kirim & Pembayaran) -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Header Invoice -->
            <div
                class="bg-[#121214] border border-white/5 rounded-3xl p-6 md:p-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-2xl font-extrabold text-white mb-1">{{ $order->order_number }}</h2>
                    <p class="text-sm text-gray-500">Tanggal: {{ $order->created_at->format('d F Y, H:i') }}</p>
                </div>
                <div>
                    @if ($order->status === 'completed')
                        <span
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold bg-green-500/10 text-green-400 border border-green-500/20"><span
                                class="w-2 h-2 rounded-full bg-green-500"></span> Selesai</span>
                    @elseif($order->status === 'shipped')
                        <span
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold bg-purple-500/10 text-purple-400 border border-purple-500/20"><span
                                class="w-2 h-2 rounded-full bg-purple-500"></span> Dikirim</span>
                    @elseif($order->status === 'processing')
                        <span
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold bg-blue-500/10 text-blue-400 border border-blue-500/20"><span
                                class="w-2 h-2 rounded-full bg-blue-500"></span> Diproses</span>
                    @elseif($order->status === 'cancelled')
                        <span
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold bg-red-500/10 text-red-400 border border-red-500/20"><span
                                class="w-2 h-2 rounded-full bg-red-500"></span> Dibatalkan</span>
                    @else
                        <span
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold bg-yellow-500/10 text-yellow-400 border border-yellow-500/20"><span
                                class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></span> Menunggu</span>
                    @endif
                </div>
            </div>

            <!-- Grid Info Pengiriman & Pembayaran -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Info Pengiriman -->
                <div class="bg-[#121214] border border-white/5 rounded-3xl p-6">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-4">Informasi Pengiriman</h3>
                    <p class="font-bold text-gray-200 mb-1">{{ $order->user->name }}</p>
                    <p class="text-sm text-gray-400 mb-4">{{ $order->user->phone ?? '-' }}</p>

                    <div class="p-4 bg-[#09090b] border border-white/5 rounded-xl">
                        <p class="text-sm text-gray-300 leading-relaxed">{{ $order->shipping_address }}</p>
                    </div>

                    <div class="mt-4 pt-4 border-t border-white/5">
                        <p class="text-sm text-gray-400">Kurir: <span
                                class="font-bold text-white">{{ $order->shipping_method }}</span></p>
                        @if ($order->tracking_number)
                            <p class="text-sm text-gray-400 mt-1">Resi: <span
                                    class="font-mono text-blue-400 bg-blue-500/10 px-2 py-0.5 rounded">{{ $order->tracking_number }}</span>
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Info Pembayaran -->
                <div class="bg-[#121214] border border-white/5 rounded-3xl p-6">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-4">Status Pembayaran</h3>
                    @if ($order->payment)
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-10 h-10 rounded-xl bg-[#09090b] border border-white/5 flex items-center justify-center text-xl">
                                💳</div>
                            <div>
                                <p class="font-bold text-white">{{ $order->payment->payment_method }}</p>
                                <p class="text-xs text-gray-400">{{ $order->payment->payment_status }}</p>
                            </div>
                        </div>
                        <div class="p-4 bg-[#09090b] border border-white/5 rounded-xl space-y-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Subtotal</span>
                                <span class="text-white font-medium">Rp
                                    {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Ongkos Kirim</span>
                                <span class="text-white font-medium">Rp
                                    {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between pt-2 mt-2 border-t border-white/5">
                                <span class="text-gray-300 font-bold">Total Pembayaran</span>
                                <span class="text-blue-400 font-bold text-lg">Rp
                                    {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="mt-6 p-4 bg-[#09090b] border border-white/5 rounded-xl">
                            <p class="text-xs uppercase tracking-widest text-gray-500 mb-3 font-bold">Bukti Pembayaran</p>
                            @if ($order->payment->payment_proof)
                                <a href="{{ asset('storage/' . $order->payment->payment_proof) }}" target="_blank"
                                    class="text-sm text-blue-400 hover:underline mb-3 inline-block">Lihat Bukti
                                    Pembayaran</a>
                                <div class="overflow-hidden rounded-2xl border border-white/10">
                                    <img src="{{ asset('storage/' . $order->payment->payment_proof) }}"
                                        alt="Bukti Pembayaran" class="w-full max-h-52 object-contain">
                                </div>
                            @else
                                <p class="text-sm text-gray-400 italic">Belum ada bukti pembayaran.</p>
                            @endif
                        </div>

                        @if (!$order->payment->payment_proof)
                            <div
                                class="mt-4 p-4 rounded-2xl bg-yellow-500/10 border border-yellow-500/20 text-sm text-yellow-100">
                                Bukti pembayaran kosong. Jika tidak valid, ubah status menjadi <strong>cancelled</strong>
                                untuk mengembalikan stok.
                            </div>
                        @endif
                    @else
                        <div class="py-8 text-center border border-dashed border-white/10 rounded-xl">
                            <p class="text-gray-500 text-sm">Data pembayaran belum tersedia.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Detail Produk yang Dibeli -->
            <div class="bg-[#121214] border border-white/5 rounded-3xl overflow-hidden">
                <div class="px-6 py-5 border-b border-white/5">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest">Item Pesanan</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-[#09090b]">
                            <tr class="text-gray-400 text-xs uppercase tracking-widest">
                                <th class="px-6 py-3 font-bold">Produk</th>
                                <th class="px-6 py-3 font-bold text-center">Qty</th>
                                <th class="px-6 py-3 font-bold text-right">Harga Satuan</th>
                                <th class="px-6 py-3 font-bold text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach ($order->items as $item)
                                <tr class="hover:bg-white/5">
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-bold text-white">{{ $item->product_name }}</p>
                                        @if (!$item->product)
                                            <span
                                                class="text-[10px] text-red-400 border border-red-500/30 px-1.5 py-0.5 rounded mt-1 inline-block">Produk
                                                Dihapus dari Katalog</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-300">{{ $item->quantity }}</td>
                                    <td class="px-6 py-4 text-right text-sm text-gray-400">Rp
                                        {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-right text-sm font-bold text-white">Rp
                                        {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($order->notes)
                <div class="bg-yellow-500/10 border border-yellow-500/20 rounded-2xl p-4 flex gap-3">
                    <svg class="w-6 h-6 text-yellow-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="text-xs font-bold text-yellow-500 uppercase tracking-widest mb-1">Catatan Pembeli</p>
                        <p class="text-sm text-yellow-100">{{ $order->notes }}</p>
                    </div>
                </div>
            @endif

        </div>

        <!-- Kanan: Panel Update Status -->
        <div class="lg:col-span-1">
            <div class="bg-[#121214] border border-white/5 rounded-3xl p-6 sticky top-28">
                <h3 class="text-lg font-bold text-white mb-4">Tindakan Admin</h3>

                <!-- Logika UI: Sembunyikan form jika status sudah final -->
                @if (in_array($order->status, ['completed', 'cancelled']))
                    <div class="p-4 bg-[#09090b] border border-white/10 rounded-xl text-center">
                        <div
                            class="w-12 h-12 mx-auto bg-gray-500/10 text-gray-400 rounded-full flex items-center justify-center mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-sm font-bold text-gray-300 mb-1">Status Terkunci</p>
                        <p class="text-xs text-gray-500 leading-relaxed">
                            Pesanan ini telah berstatus <b>{{ ucfirst($order->status) }}</b> dan arsipnya sudah dikunci
                            secara permanen.
                        </p>
                    </div>
                @else
                    <!-- Tombol aksi bertahap untuk update status pesanan -->
                    @php
                        $canAdvance = true;
                        $advanceLabel = 'Lanjutkan ke langkah berikutnya';

                        if ($order->status === 'pending') {
                            $advanceLabel = 'Konfirmasi Pembayaran & Proses Pesanan';
                            if (
                                $order->payment &&
                                $order->payment->payment_method !== 'COD' &&
                                !$order->payment->payment_proof
                            ) {
                                $canAdvance = false;
                            }
                        } elseif ($order->status === 'processing') {
                            $advanceLabel = 'Tandai Pesanan Dikirim';
                        } elseif ($order->status === 'shipped') {
                            $advanceLabel = 'Tandai Pesanan Selesai';
                        }
                    @endphp

                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="action" value="advance">

                        <p class="text-sm text-gray-400 mb-3">Lanjutkan ke langkah berikutnya:</p>

                        <button type="submit"
                            class="w-full py-3 rounded-xl text-sm font-bold transition-all {{ $canAdvance ? 'bg-blue-600 text-white hover:bg-blue-500 shadow-[0_0_15px_rgba(37,99,235,0.3)]' : 'bg-gray-700 text-gray-300 cursor-not-allowed border border-white/10' }}"
                            {{ $canAdvance ? '' : 'disabled' }}>
                            {{ $advanceLabel }}
                        </button>

                        @if (!$canAdvance)
                            <p class="text-xs text-red-400">Bukti pembayaran belum tersedia. Silakan tunggu bukti transfer
                                sebelum memproses pesanan.</p>
                        @endif
                    </form>

                    @if ($order->status === 'pending')
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST"
                            class="space-y-4 mt-4">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="action" value="cancel">
                            <button type="submit" onclick="return confirm('Yakin ingin membatalkan pesanan ini?')"
                                class="w-full py-3 bg-red-500 text-white rounded-xl font-bold hover:bg-red-600 transition-all shadow-[0_0_15px_rgba(239,68,68,0.3)]">
                                Batalkan Pesanan
                            </button>
                        </form>
                    @endif

                    <p class="text-xs text-gray-500 italic">Status saat ini: <span
                            class="font-semibold text-white">{{ ucfirst($order->status) }}</span></p>
                @endif

                <div class="mt-8 pt-6 border-t border-white/5">
                    <p class="text-xs text-gray-500 uppercase tracking-widest font-bold mb-3">Workflow Pesanan</p>
                    <ol class="relative border-l border-white/10 ml-3 space-y-4">
                        <li class="mb-4 ml-4">
                            <div class="absolute w-3 h-3 bg-gray-500 rounded-full -left-1.5 border border-[#121214]"></div>
                            <p class="text-xs text-gray-400">Pesanan Dibuat</p>
                        </li>
                        <li class="mb-4 ml-4">
                            <div
                                class="absolute w-3 h-3 {{ in_array($order->status, ['processing', 'shipped', 'completed']) ? 'bg-blue-500 shadow-[0_0_8px_rgba(37,99,235,0.8)]' : 'bg-gray-700' }} rounded-full -left-1.5 border border-[#121214] transition-colors">
                            </div>
                            <p
                                class="text-xs {{ in_array($order->status, ['processing', 'shipped', 'completed']) ? 'text-blue-400 font-bold' : 'text-gray-500' }}">
                                Diproses</p>
                        </li>
                        <li class="mb-4 ml-4">
                            <div
                                class="absolute w-3 h-3 {{ in_array($order->status, ['shipped', 'completed']) ? 'bg-purple-500 shadow-[0_0_8px_rgba(168,85,247,0.8)]' : 'bg-gray-700' }} rounded-full -left-1.5 border border-[#121214] transition-colors">
                            </div>
                            <p
                                class="text-xs {{ in_array($order->status, ['shipped', 'completed']) ? 'text-purple-400 font-bold' : 'text-gray-500' }}">
                                Dikirim</p>
                        </li>
                        <li class="ml-4">
                            <div
                                class="absolute w-3 h-3 {{ $order->status === 'completed' ? 'bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.8)]' : 'bg-gray-700' }} rounded-full -left-1.5 border border-[#121214] transition-colors">
                            </div>
                            <p
                                class="text-xs {{ $order->status === 'completed' ? 'text-green-400 font-bold' : 'text-gray-500' }}">
                                Selesai</p>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
