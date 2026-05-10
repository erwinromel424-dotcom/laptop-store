@extends('layouts.admin')
@section('title', 'Detail Pengguna')
@section('header', 'Profil Pengguna')

@section('content')
    <div class="mb-6 flex gap-3">
        <a href="{{ route('admin.users.index') }}"
            class="px-4 py-2 bg-white/5 border border-white/10 text-white rounded-xl text-sm font-bold hover:bg-white/10 transition-colors">←
            Kembali</a>
        <a href="{{ route('admin.users.edit', $user->id) }}"
            class="px-4 py-2 bg-yellow-600 text-white rounded-xl text-sm font-bold hover:bg-yellow-500 transition-colors shadow-[0_0_15px_rgba(202,138,4,0.3)]">Edit
            Akun</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- ID Card Panel Kiri -->
        <div class="md:col-span-1">
            <div
                class="bg-linear-to-b from-[#1a1a1f] to-[#09090b] border border-white/5 rounded-3xl p-8 text-center relative overflow-hidden">
                <!-- Efek Glow di belakang avatar -->
                <div
                    class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-32 {{ $user->role === 'admin' ? 'bg-blue-500/20' : 'bg-gray-500/20' }} blur-[50px]">
                </div>

                <div class="relative z-10">
                    <div
                        class="w-24 h-24 mx-auto rounded-2xl {{ $user->role === 'admin' ? 'bg-linear-to-tr from-blue-600 to-purple-500' : 'bg-white/10' }} flex items-center justify-center text-4xl font-extrabold text-white shadow-xl mb-4 border border-white/10">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-1">{{ $user->name }}</h3>
                    <p class="text-gray-400 text-sm mb-4">{{ $user->email }}</p>

                    @if ($user->role === 'admin')
                        <span
                            class="inline-flex px-4 py-1.5 rounded-full text-xs font-bold bg-blue-500/20 text-blue-400 border border-blue-500/30 mb-6">Administrator</span>
                    @else
                        <span
                            class="inline-flex px-4 py-1.5 rounded-full text-xs font-bold bg-gray-500/20 text-gray-400 border border-gray-500/30 mb-6">Customer
                            Biasa</span>
                    @endif

                    <div class="pt-6 border-t border-white/5 text-left space-y-4">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-widest font-bold mb-1">Nomor HP</p>
                            <p class="text-white font-medium">{{ $user->phone ?? 'Belum ditambahkan' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-widest font-bold mb-1">Tanggal Bergabung</p>
                            <p class="text-white font-medium">{{ $user->created_at->format('d F Y, H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel Kanan (Alamat & Riwayat Transaksi) -->
        <div class="md:col-span-2 space-y-6">

            <!-- Riwayat Transaksi -->
            <div class="bg-[#121214] border border-white/5 rounded-3xl p-6">
                <h3 class="text-lg font-bold text-white mb-4">5 Transaksi Terakhir</h3>

                @if ($user->orders->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-gray-400 text-xs uppercase tracking-widest border-b border-white/5">
                                    <th class="py-3 font-bold">Order ID</th>
                                    <th class="py-3 font-bold">Tanggal</th>
                                    <th class="py-3 font-bold">Total</th>
                                    <th class="py-3 font-bold">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach ($user->orders as $order)
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="py-3 text-sm font-bold text-gray-200">{{ $order->order_number }}</td>
                                        <td class="py-3 text-sm text-gray-400">{{ $order->created_at->format('d M Y') }}
                                        </td>
                                        <td class="py-3 text-sm font-bold text-green-400">Rp
                                            {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                                        <td class="py-3">
                                            @if ($order->status === 'completed')
                                                <span
                                                    class="px-2 py-1 rounded text-xs font-bold bg-green-500/10 text-green-400">Selesai</span>
                                            @elseif($order->status === 'pending')
                                                <span
                                                    class="px-2 py-1 rounded text-xs font-bold bg-yellow-500/10 text-yellow-400">Menunggu</span>
                                            @else
                                                <span
                                                    class="px-2 py-1 rounded text-xs font-bold bg-gray-500/10 text-gray-400">{{ ucfirst($order->status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="py-8 text-center border border-dashed border-white/10 rounded-2xl">
                        <p class="text-gray-500 text-sm">Pengguna ini belum pernah melakukan transaksi.</p>
                    </div>
                @endif
            </div>

            <!-- Daftar Alamat -->
            <div class="bg-[#121214] border border-white/5 rounded-3xl p-6">
                <h3 class="text-lg font-bold text-white mb-4">Buku Alamat</h3>

                @if ($user->addresses->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach ($user->addresses as $address)
                            <div
                                class="p-4 bg-[#09090b] border {{ $address->is_primary ? 'border-blue-500/30 shadow-[0_0_15px_rgba(37,99,235,0.1)]' : 'border-white/5' }} rounded-2xl">
                                @if ($address->is_primary)
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-wider text-blue-400 bg-blue-500/10 px-2 py-0.5 rounded mb-2 inline-block">Alamat
                                        Utama</span>
                                @endif
                                <p class="text-sm font-bold text-gray-200 mb-1">{{ $address->recipient_name }} <span
                                        class="text-gray-500 font-normal">({{ $address->phone_number }})</span></p>
                                <p class="text-xs text-gray-400 leading-relaxed">{{ $address->full_address }},
                                    {{ $address->city }}, {{ $address->postal_code }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="py-6 text-center border border-dashed border-white/10 rounded-2xl">
                        <p class="text-gray-500 text-sm">Belum ada alamat yang disimpan.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
