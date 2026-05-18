@extends('layouts.app')
@section('title', 'Proses Checkout | LaptopStore')

@section('content')
    <!-- State AlpineJS yang diperluas -->
    <div class="relative pt-32 pb-24 bg-[#09090b] min-h-screen w-full overflow-hidden" x-data="{
        subtotal: {{ $subtotal }},
        shippingCost: 50000,
        selectedAddress: '{{ $address->id ?? '' }}',
        paymentMethod: 'Bank Transfer - Virtual Account BCA',
        formatRupiah(value) {
            return new Intl.NumberFormat('id-ID').format(value);
        }
    }">

        <!-- Ambient Glow -->
        <div
            class="absolute top-20 right-0 w-[40vw] h-[40vh] bg-blue-900/10 blur-[150px] pointer-events-none transform translate-x-1/4">
            </div>

        <div class="w-full px-6 md:px-12 lg:px-24 relative z-10">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
                <div class="flex items-center gap-4">
                    <div
                        class="w-14 h-14 bg-blue-500/10 border border-blue-500/30 rounded-2xl flex items-center justify-center shadow-[0_0_20px_rgba(59,130,246,0.15)]">
                        <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    <div>
                        <h1 class="text-3xl md:text-5xl font-semibold tracking-widest text-white">
                            Proses <span                                 class="text-gray-600">Checkout.</span></h1>
                        <p class="text-gray-500 mt-1 font-medium">Selesaikan pembayaran untuk
                            pesanan laptop impianmu.</p>
                        </div>
                    </div>
                </div>

            @if (session('error'))
                <div
                    class="mb-8 px-6 py-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-2xl flex items-center gap-3 font-medium animate-pulse">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

                    <!-- 1. Pemilihan Alamat -->
                    <div
                        class="bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/5 rounded-4xl p-6 sm:p-8 shadow-xl">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-xl font-bold text-white flex items-center gap-3">
                                <span
                                    class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-sm">1</span>
                                Alamat Pengiriman
                                </h3>
                            <a href="{{ route('profile.edit') }}"
                                
                                class="text-xs font-bold text-blue-400 hover:text-blue-300 uppercase tracking-widest transition-colors">+
                                Tambah Alamat</a>
                            </div>

                        @if ($addresses->isNotEmpty())
                            <div class="space-y-4">
                                <label
                                    class="block text-sm font-bold text-gray-400 mb-2">Pilih Alamat Tujuan</label>
                                <select name="address_id" x-model="selectedAddress"
                                    
                                    class="w-full bg-[#050505] border border-white/10 rounded-2xl px-5 py-4 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all appearance-none cursor-pointer">
                                    @foreach ($addresses as $addr)
                                        <option value="{{ $addr->id }}">{{ $addr->recipient_name }} -
                                            {{ $addr->city }}
                                            ({{ $addr->full_address }})</option>
                                    @endforeach
                                    </select>

                                <!-- Preview Alamat Terpilih (Opsional untuk Visual) -->
                                <div
                                    class="p-5 bg-blue-500/5 border border-blue-500/10 rounded-2xl mt-4">
                                    <div class="flex items-start gap-4">
                                        <svg class="w-5 h-5 text-blue-400 mt-1"
                                            fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                            </svg>
                                        <div>
                                            <p
                                                class="text-gray-400 text-sm leading-relaxed">Pastikan nomor telepon dan
                                                kode
                                                pos sudah sesuai untuk
                                                memudahkan kurir.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @else
                            <div class="p-10 text-center border border-dashed border-red-500/20 rounded-3xl bg-red-500/5">
                                <p class="text-red-400 mb-6 font-medium">Kamu belum memiliki
                                    alamat pengiriman tersimpan.
                                    </p>
                                <a href="{{ route('profile.edit') }}"
                                    
                                    class="inline-flex px-8 py-3 bg-white text-black font-semibold tracking-widest rounded-2xl hover:bg-gray-200 transition-colors">Setup
                                    Alamat Sekarang</a>
                                </div>
                            
                        @endif
                        </div>

                    <!-- 2. Kurir & Pembayaran -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Kurir dengan Ikon -->
                        <div
                            class="bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/5 rounded-4xl p-6 shadow-xl">
                            <h3
                                class="text-lg font-bold text-white mb-6 flex items-center gap-3">
                                <span
                                    class="w-7 h-7 bg-blue-500/20 text-blue-400 rounded-md flex items-center justify-center text-xs">2</span>
                                Opsi Pengiriman
                                </h3>
                            <div class="space-y-3">
                                @foreach ($shippingOptions as $method => $cost)
                                    <label
                                        class="relative flex items-center p-4 border border-white/10 rounded-2xl cursor-pointer hover:border-blue-500/30 transition-all bg-[#050505] has-checked:border-blue-500 has-checked:bg-blue-500/5 group">
                                        <input type="radio" name="shipping_method"
                                            value="{{ $method }}"
                                            @click="shippingCost = {{ $cost }}" class="hidden"
                                            {{ $method === 'JNE Reguler' ? 'checked' : '' }}
                                            required>

                                        <div
                                            class="flex items-center justify-between w-full">
                                            <div
                                                class="flex items-center gap-4">
                                                
                                                <!-- Ikon Kurir (Placeholder Logo) -->
                                                <div
                                                    
                                                    class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center font-black text-[10px] text-gray-500 uppercase italic">
                                                    
                                                    {{ Str::limit($method, 3, '') }}
                                                    </div>
                                                <div>
                                                    <span
                                                        
                                                        class="block text-white font-bold text-sm">{{ $method }}</span>
                                                    <span
                                                        
                                                        class="text-[10px] text-gray-500 uppercase tracking-tighter">Estimasi
                                                        2-3
                                                        Hari</span>
                                                    </div>
                                                </div>
                                            <span
                                                class="text-blue-400 font-bold text-sm">Rp
                                                
                                                {{ number_format($cost, 0, ',', '.') }}</span>
                                            </div>
                                        </label>
                                @endforeach
                                </div>
                            </div>

                        <!-- Pembayaran dengan COD & Ikon Bank -->
                        <div
                            class="bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/5 rounded-4xl p-6 shadow-xl">
                            <h3
                                class="text-lg font-bold text-white mb-6 flex items-center gap-3">
                                <span
                                    class="w-7 h-7 bg-blue-500/20 text-blue-400 rounded-md flex items-center justify-center text-xs">3</span>
                                Metode Pembayaran
                                </h3>
                            <div class="space-y-3">
                                <!-- BCA -->
                                <label
                                    class="relative flex items-center p-4 border border-white/10 rounded-2xl cursor-pointer hover:border-blue-500/30 transition-all bg-[#050505] has-checked:border-blue-500 has-checked:bg-blue-500/5">
                                    <input type="radio" name="payment_method"
                                        value="Bank Transfer - BCA"
                                        x-model="paymentMethod" class="hidden" checked>
                                    <div class="flex items-center gap-4">
                                        <div
                                            
                                            class="w-10 h-6 bg-blue-700 rounded flex items-center justify-center text-[8px] font-bold text-white">
                                            BCA</div>
                                        <span
                                            class="text-white font-bold text-sm">BCA Virtual Account</span>
                                        </div>
                                    </label>

                                <!-- Mandiri -->
                                <label
                                    class="relative flex items-center p-4 border border-white/10 rounded-2xl cursor-pointer hover:border-blue-500/30 transition-all bg-[#050505] has-checked:border-blue-500 has-checked:bg-blue-500/5">
                                    <input type="radio" name="payment_method"
                                        value="Bank Transfer - Mandiri"
                                        x-model="paymentMethod" class="hidden">
                                    <div class="flex items-center gap-4">
                                        <div
                                            
                                            class="w-10 h-6 bg-yellow-500 rounded flex items-center justify-center text-[7px] font-bold text-blue-900 uppercase tracking-tighter">
                                            Mandiri</div>
                                        <span
                                            class="text-white font-bold text-sm">Mandiri Virtual Account</span>
                                        </div>
                                    </label>

                                <!-- COD (New) -->
                                <label
                                    class="relative flex items-center p-4 border border-red-500/20 rounded-2xl cursor-pointer hover:border-red-500/40 transition-all bg-[#050505] has-checked:border-red-500 has-checked:bg-red-500/5">
                                    <input type="radio" name="payment_method"
                                        value="COD" x-model="paymentMethod"
                                        class="hidden">
                                    <div class="flex items-center gap-4">
                                        <div
                                            
                                            class="w-10 h-6 bg-red-600 rounded flex items-center justify-center text-[8px] font-bold text-white uppercase italic">
                                            COD</div>
                                        <div>
                                            <span
                                                class="text-white font-bold text-sm block">Cash on Delivery</span>
                                            </div>
                                        </div>
                                    </label>

                                <!-- Setelah label terakhir metode pembayaran -->
                                @error('payment_method')
                                    <p
                                        class="text-red-500 text-[10px] mt-2 font-bold uppercase tracking-widest italic animate-bounce">
                                        Silahkan pilih metode pembayaran!
                                        </p>
                                @enderror
                                
                            </div>
                            </div>
                        </div>

                    <!-- Catatan -->
                    <div
                        class="bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/5 rounded-4xl p-6 sm:p-8 shadow-xl">
                        <label class="block text-lg font-bold text-white mb-4">Catatan
                            Pesanan</label>
                        
                        <textarea name="notes" rows="3" placeholder="Contoh: Titip di satpam jika tidak ada orang..."                
                                       
                            class="w-full bg-[#050505] border border-white/10 rounded-2xl px-5 py-4 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-colors"></textarea>
                        
                    </div>

                    </div>

                <!-- KANAN: Ringkasan Final -->
                <div class="lg:col-span-1">
                    <div
                        class="bg-linear-to-br from-[#121214] to-[#0a0a0c] border border-white/5 rounded-[2.5rem] p-8 lg:p-10 sticky top-32 shadow-2xl">
                        <h3 class="text-xl font-bold text-white mb-8">Ringkasan Pesanan</h3>

                        <div
                            class="space-y-5 mb-10 max-h-[30vh] overflow-y-auto pr-2 custom-scrollbar">
                            @foreach ($cartItems as $item)
                                <div class="flex gap-4">
                                    <div
                                        class="w-12 h-12 bg-white/5 rounded-xl shrink-0 overflow-hidden border border-white/5">
                                        <img
                                            src="{{ Storage::url($item->product->images->where('is_primary', true)->first()->image_path ?? 'default.jpg') }}"
                                            class="w-full h-full object-cover">
                                        </div>
                                    <div class="flex-1 min-w-0">
                                        <p
                                            class="text-sm font-bold text-white truncate">{{ $item->product->name }}</p>
                                        <p class="text-xs text-gray-500 mt-0.5">
                                            {{ $item->quantity }}x <span
                                                class="text-gray-400">Rp
                                                
                                                {{ number_format($item->product->price, 0, ',', '.') }}</span></p>
                                        </div>
                                    </div>
                            @endforeach
                            </div>

                        <div class="space-y-4 pt-6 border-t border-white/5">
                            <div class="flex justify-between text-gray-400 text-sm">
                                <span>Subtotal</span>
                                <span class="text-white font-medium">Rp
                                    {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                            <div class="flex justify-between text-gray-400 text-sm">
                                <span>Pengiriman</span>
                                <span class="text-blue-400 font-bold">Rp <span
                                        x-text="formatRupiah(shippingCost)"></span></span>
                                </div>

                            <div
                                class="pt-6 mt-6 border-t border-dashed border-white/10 flex flex-col gap-2">
                                <span
                                    class="text-gray-500 font-bold text-xs uppercase tracking-widest text-center ">Total
                                    Akhir</span>
                                <span
                                    class="text-4xl font-black text-center text-transparent bg-clip-text bg-linear-to-r from-blue-400 to-cyan-300 tracking-tighter">
                                    Rp <span
                                        x-text="formatRupiah(subtotal + shippingCost)"></span>
                                    </span>
                                </div>
                            </div>

                        <button type="submit"
                            class="mt-10 group relative flex w-full h-16 bg-blue-600 text-white rounded-2xl font-semibold tracking-tighter text-lg transition-all hover:bg-blue-500 items-center justify-center gap-3 overflow-hidden shadow-[0_15px_30px_rgba(37,99,235,0.2)] active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed"
                            {{ $addresses->isEmpty() ? 'disabled' : '' }}>
                            <span class="relative z-10">Bayar Sekarang</span>
                            <svg
                                class="w-6 h-6 group-hover:translate-x-1 transition-transform relative z-10"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"                                     d="M14 5l7 7m0 0l-7 7m7-7H3">
                                </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
