@extends('layouts.app')
@section('title', 'Proses Checkout | LaptopStore')

@section('content')
    <!-- Wrap seluruh halaman dalam state AlpineJS -->
    <div class="relative pt-32 pb-24 bg-[#09090b] min-h-screen w-full overflow-hidden" x-data="{
        subtotal: {{ $subtotal }},
        shippingCost: 50000, // Default value (JNE Reguler)
        formatRupiah(value) {
            return new Intl.NumberFormat('id-ID').format(value);
        }
    }">

        <!-- Ambient Glow -->
        <div
            class="absolute top-20 right-0 w-[40vw] h-[40vh] bg-blue-900/10 blur-[150px] pointer-events-none transform translate-x-1/4">
        </div>

        <div class="w-full px-6 md:px-12 lg:px-24 relative z-10">

            <div class="flex items-center gap-4 mb-10">
                <div class="w-12 h-12 bg-blue-500/10 border border-blue-500/30 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight">
                    Proses <span class="text-gray-600">Checkout.</span>
                </h1>
            </div>

            @if (session('error'))
                <div
                    class="mb-8 px-6 py-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-2xl flex items-center gap-3 font-medium">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('checkout.process') }}" method="POST"
                class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
                @csrf

                <!-- KIRI: Data Pengiriman & Opsi -->
                <div class="lg:col-span-2 space-y-8">

                    <!-- 1. Alamat Pengiriman -->
                    <div
                        class="bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/5 rounded-4xl p-6 sm:p-8 shadow-xl">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-white flex items-center gap-3">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Alamat Pengiriman
                            </h3>
                            <a href="{{ route('profile.edit') }}"
                                class="text-sm font-bold text-gray-400 hover:text-white transition-colors">Ubah Alamat</a>
                        </div>

                        @if ($address)
                            <div class="p-5 bg-blue-500/5 border border-blue-500/20 rounded-2xl">
                                <p class="font-extrabold text-white text-lg mb-1">{{ $address->recipient_name }} <span
                                        class="text-sm font-normal text-gray-400">({{ $address->phone_number }})</span></p>
                                <p class="text-gray-400 leading-relaxed text-sm">{{ $address->full_address }},
                                    {{ $address->city }}, {{ $address->postal_code }}</p>
                                <div
                                    class="mt-3 inline-flex items-center px-3 py-1 rounded-md bg-blue-500/10 text-blue-400 text-xs font-bold uppercase tracking-widest border border-blue-500/20">
                                    Alamat Utama Terpilih
                                </div>
                            </div>
                        @else
                            <div class="p-8 text-center border border-dashed border-red-500/30 rounded-2xl">
                                <p class="text-red-400 mb-4 font-medium">Kamu belum mendaftarkan alamat pengiriman.</p>
                                <a href="{{ route('profile.edit') }}"
                                    class="inline-flex px-6 py-2 bg-white text-black font-bold rounded-full">Isi Alamat
                                    Sekarang</a>
                            </div>
                        @endif
                    </div>

                    <!-- 2. Kurir & Pembayaran -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <!-- Kurir -->
                        <div
                            class="bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/5 rounded-4xl p-6 sm:p-8 shadow-xl">
                            <h3 class="text-lg font-bold text-white mb-6">Pilih Kurir</h3>
                            <div class="space-y-3">
                                @foreach ($shippingOptions as $method => $cost)
                                    <label
                                        class="flex items-center justify-between p-4 border border-white/10 rounded-xl cursor-pointer hover:border-blue-500/50 transition-colors bg-[#050505] has-checked:border-blue-500 has-checked:bg-blue-500/5">
                                        <div class="flex items-center gap-3">
                                            <!-- Alpine @click untuk trigger perubahan harga secara instan -->
                                            <input type="radio" name="shipping_method" value="{{ $method }}"
                                                @click="shippingCost = {{ $cost }}"
                                                class="text-blue-500 focus:ring-blue-500 bg-[#121214] border-gray-600"
                                                {{ $method === 'JNE Reguler' ? 'checked' : '' }} required>
                                            <div>
                                                <span class="block text-white font-bold">{{ $method }}</span>
                                            </div>
                                        </div>
                                        <span class="text-white font-bold text-sm">Rp
                                            {{ number_format($cost, 0, ',', '.') }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Pembayaran (Disamakan dengan TransactionSeeder) -->
                        <div
                            class="bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/5 rounded-4xl p-6 sm:p-8 shadow-xl">
                            <h3 class="text-lg font-bold text-white mb-6">Metode Pembayaran</h3>
                            <div class="space-y-3">
                                <label
                                    class="flex items-center justify-between p-4 border border-white/10 rounded-xl cursor-pointer hover:border-blue-500/50 transition-colors bg-[#050505] has-checked:border-blue-500 has-checked:bg-blue-500/5">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" name="payment_method"
                                            value="Bank Transfer - Virtual Account BCA"
                                            class="text-blue-500 focus:ring-blue-500 bg-[#121214] border-gray-600" required
                                            checked>
                                        <span class="text-white font-bold text-sm">BCA Virtual Account</span>
                                    </div>
                                </label>

                                <label
                                    class="flex items-center justify-between p-4 border border-white/10 rounded-xl cursor-pointer hover:border-blue-500/50 transition-colors bg-[#050505] has-checked:border-blue-500 has-checked:bg-blue-500/5">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" name="payment_method"
                                            value="Bank Transfer - Virtual Account Mandiri"
                                            class="text-blue-500 focus:ring-blue-500 bg-[#121214] border-gray-600">
                                        <span class="text-white font-bold text-sm">Mandiri Virtual Account</span>
                                    </div>
                                </label>

                                <label
                                    class="flex items-center justify-between p-4 border border-white/10 rounded-xl cursor-pointer hover:border-blue-500/50 transition-colors bg-[#050505] has-checked:border-blue-500 has-checked:bg-blue-500/5">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" name="payment_method"
                                            value="Bank Transfer - Virtual Account BNI"
                                            class="text-blue-500 focus:ring-blue-500 bg-[#121214] border-gray-600">
                                        <span class="text-white font-bold text-sm">BNI Virtual Account</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Catatan -->
                    <div
                        class="bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/5 rounded-4xl p-6 sm:p-8 shadow-xl">
                        <label class="block text-lg font-bold text-white mb-4">Catatan untuk Penjual <span
                                class="text-gray-500 font-normal text-sm">(Opsional)</span></label>
                        <textarea name="notes" rows="3" placeholder="Contoh: Tolong packing kayu ekstra tebal..."
                            class="w-full bg-[#050505] border border-white/10 rounded-2xl px-5 py-4 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-colors"></textarea>
                    </div>

                </div>

                <!-- KANAN: Ringkasan Final & Tombol Bayar (Realtime Alpine) -->
                <div class="lg:col-span-1">
                    <div
                        class="bg-linear-to-br from-[#121214] to-[#0a0a0c] border border-white/5 rounded-[2.5rem] p-8 lg:p-10 sticky top-32 shadow-2xl">

                        <h3 class="text-xl font-bold text-white mb-6">Barang yang Dibeli</h3>
                        <div class="space-y-4 mb-8">
                            @foreach ($cartItems as $item)
                                <div class="flex justify-between items-start gap-4">
                                    <div class="flex-1">
                                        <p class="text-sm font-bold text-white line-clamp-1">{{ $item->product->name }}
                                        </p>
                                        <p class="text-xs text-gray-500">{{ $item->quantity }} x Rp
                                            {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                    </div>
                                    <p class="text-sm font-bold text-white shrink-0">Rp
                                        {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t border-white/10 pt-6 space-y-4 mb-8">
                            <div class="flex justify-between items-center text-gray-400 text-sm">
                                <span>Subtotal Produk</span>
                                <span class="text-white font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>

                            <!-- Biaya Pengiriman Dinamis x-text -->
                            <div class="flex justify-between items-center text-gray-400 text-sm">
                                <span>Ongkos Kirim</span>
                                <span class="text-white font-medium">Rp <span
                                        x-text="formatRupiah(shippingCost)"></span></span>
                            </div>

                            <!-- Total Akhir Dinamis x-text -->
                            <div class="pt-6 mt-6 border-t border-dashed border-white/20 flex justify-between items-end">
                                <span class="block text-white font-bold text-lg">Total Pembayaran</span>
                                <span
                                    class="text-3xl font-extrabold text-transparent bg-clip-text bg-linear-to-r from-blue-400 to-cyan-300">
                                    Rp <span x-text="formatRupiah(subtotal + shippingCost)"></span>
                                </span>
                            </div>
                        </div>

                        <button type="submit"
                            class="group relative flex w-full h-16 bg-blue-600 text-white rounded-2xl font-extrabold text-lg transition-all hover:bg-blue-500 items-center justify-center gap-3 overflow-hidden shadow-[0_0_30px_rgba(37,99,235,0.3)] hover:-translate-y-1"
                            {{ !$address ? 'disabled' : '' }}>
                            Buat Pesanan
                            <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection
