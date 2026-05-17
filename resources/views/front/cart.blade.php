@extends('layouts.app')
@section('title', 'Keranjang Belanja | LaptopStore')

@section('content')
    <!-- ALPINE ROOT: Menyimpan Total Harga & State Modal Global -->
    <div class="relative pt-32 pb-24 bg-[#09090b] min-h-screen w-full overflow-hidden" x-data="{
        grandTotal: {{ $total }},
        formatRupiah(value) {
            return new Intl.NumberFormat('id-ID').format(value);
        },
    
        // State untuk Modal Hapus
        deleteModal: false,
        deleteUrl: '',
        deleteItemName: '',
    }"
        @update-total.window="grandTotal += $event.detail"
        @open-delete-modal.window="deleteModal = true; deleteUrl = $event.detail.url; deleteItemName = $event.detail.name">

        <!-- Ambient Glow -->
        <div
            class="absolute top-20 right-0 w-[40vw] h-[40vh] bg-blue-900/10 blur-[150px] pointer-events-none transform translate-x-1/4">
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
                    Keranjang <span class="text-gray-600">Belanja.</span>
                </h1>
            </div>

            <!-- Notifikasi Session -->
            @if (session('success'))
                <div
                    class="mb-8 px-6 py-4 bg-green-500/10 border border-green-500/20 text-green-400 rounded-2xl flex items-center gap-3 font-medium shadow-lg">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div
                    class="mb-8 px-6 py-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-2xl flex items-center gap-3 font-medium shadow-lg">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            @if ($cartItems->isEmpty())
                <!-- Empty State -->
                <div
                    class="bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/5 rounded-[3rem] p-16 md:p-24 text-center flex flex-col items-center shadow-2xl">
                    <div
                        class="w-24 h-24 rounded-full bg-white/5 flex items-center justify-center mb-6 shadow-inner border border-white/10">
                        <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-4">Keranjang Masih Kosong</h3>
                    <p class="text-gray-400 mb-10 text-lg max-w-md">Perangkat komputasi impianmu sedang menunggu. Mari
                        temukan mesin yang tepat untukmu.</p>
                    <a href="{{ url('/katalog') }}"
                        class="inline-flex justify-center items-center px-10 py-4 font-bold text-[#09090b] bg-white rounded-full hover:bg-gray-200 transition-all duration-300 hover:scale-105 shadow-[0_0_30px_rgba(255,255,255,0.15)]">
                        Eksplorasi Katalog Produk
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">

                    <!-- KIRI: Daftar Item Keranjang -->
                    <div class="lg:col-span-2 space-y-6">
                        @foreach ($cartItems as $item)
                            <!-- ALPINE CHILD: State Per Item -->
                            <div class="bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/5 rounded-[2.5rem] p-5 sm:p-8 flex flex-col sm:flex-row items-start sm:items-center gap-6 sm:gap-8 group hover:border-white/20 transition-all shadow-xl relative"
                                x-data="{
                                    qty: {{ $item->quantity }},
                                    maxStock: {{ $item->product->stock }},
                                    price: {{ $item->product->price }},
                                    showAlert: false,
                                
                                    // Fungsi background fetch (tanpa reload)
                                    updateBackend(actionType) {
                                        let formData = new FormData();
                                        formData.append('_token', '{{ csrf_token() }}');
                                        formData.append('_method', 'PUT');
                                        formData.append('action', actionType);
                                
                                        fetch('{{ route('cart.update', $item->id) }}', {
                                            method: 'POST',
                                            body: formData,
                                            headers: { 'X-Requested-With': 'XMLHttpRequest' }
                                        });
                                    },
                                    increase() {
                                        if (this.qty < this.maxStock) {
                                            this.qty++;
                                            $dispatch('update-total', this.price); // Kirim event nambah total
                                            this.updateBackend('increase');
                                        } else {
                                            this.showAlert = true;
                                            setTimeout(() => this.showAlert = false, 3000);
                                        }
                                    },
                                    decrease() {
                                        if (this.qty > 1) {
                                            this.qty--;
                                            $dispatch('update-total', -this.price); // Kirim event ngurang total
                                            this.updateBackend('decrease');
                                        }
                                    }
                                }">

                                <!-- Toast Alert Limit Stok Lokal -->
                                <div x-show="showAlert" x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform translate-y-2"
                                    x-transition:enter-end="opacity-100 transform translate-y-0"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100 transform translate-y-0"
                                    x-transition:leave-end="opacity-0 transform translate-y-2"
                                    class="absolute -top-4 right-8 bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-bold px-4 py-2 rounded-lg flex items-center gap-2 backdrop-blur-md z-20"
                                    style="display: none;">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg>
                                    Stok maksimal tersisa {{ $item->product->stock }} unit!
                                </div>

                                <!-- Gambar -->
                                <a href="{{ route('product.show', $item->product->slug) }}"
                                    class="w-full sm:w-40 aspect-square bg-[#050505] rounded-3xl flex items-center justify-center p-4 border border-white/5 shrink-0 relative overflow-hidden shadow-inner">
                                    @if ($item->product->images->isNotEmpty())
                                        <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}"
                                            alt="{{ $item->product->name }}"
                                            class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-700">
                                    @else
                                        <span class="text-[10px] text-gray-600 tracking-widest font-mono">NO IMAGE</span>
                                    @endif
                                </a>

                                <!-- Detail Item -->
                                <div class="flex-1 w-full flex flex-col h-full justify-center">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="text-xl font-bold text-white leading-tight pr-4">
                                            <a href="{{ route('product.show', $item->product->slug) }}"
                                                class="hover:text-blue-400 transition-colors">
                                                {{ $item->product->name }}
                                            </a>
                                        </h3>

                                        <!-- Tombol Trigger Modal Hapus -->
                                        <button type="button"
                                            @click="$dispatch('open-delete-modal', { url: '{{ route('cart.destroy', $item->id) }}', name: '{{ addslashes($item->product->name) }}' })"
                                            class="w-10 h-10 shrink-0 rounded-full bg-white/5 text-gray-500 hover:text-white hover:bg-red-500 transition-all flex items-center justify-center shadow-sm"
                                            title="Hapus Item">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>

                                    <p class="text-blue-400 font-extrabold text-2xl mb-6">
                                        Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                    </p>

                                    <!-- Controller & Subtotal (Realtime AlpineJS) -->
                                    <div
                                        class="flex flex-wrap items-center justify-between gap-4 mt-auto pt-5 border-t border-white/5">

                                        <!-- Controller Kuantitas -->
                                        <div
                                            class="bg-[#050505] border border-white/10 rounded-2xl flex items-center p-1.5 shadow-inner">
                                            <button type="button" @click="decrease()"
                                                class="w-10 h-10 rounded-xl bg-white/5 text-gray-400 hover:text-white hover:bg-white/10 flex items-center justify-center transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M20 12H4"></path>
                                                </svg>
                                            </button>

                                            <!-- Display Kuantitas (Reaktif) -->
                                            <span class="w-14 text-center text-white font-extrabold text-lg"
                                                x-text="qty"></span>

                                            <button type="button" @click="increase()"
                                                class="w-10 h-10 rounded-xl bg-white/5 text-gray-400 hover:text-white hover:bg-white/10 flex items-center justify-center transition-colors disabled:opacity-30 disabled:cursor-not-allowed"
                                                :disabled="qty >= maxStock">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 4v16m8-8H4"></path>
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Subtotal Item Dinamis -->
                                        <div class="text-right">
                                            <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold mb-1">
                                                Subtotal Item</p>
                                            <p class="text-white font-extrabold text-xl">Rp <span
                                                    x-text="formatRupiah(qty * price)"></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- KANAN: Ringkasan Pembayaran -->
                    <div class="lg:col-span-1">
                        <div
                            class="bg-linear-to-br from-[#121214] to-[#0a0a0c] border border-white/5 rounded-[2.5rem] p-8 lg:p-10 sticky top-32 shadow-2xl">
                            <h3 class="text-xl font-bold text-white mb-8 flex items-center gap-3">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Ringkasan Transaksi
                            </h3>

                            <div class="space-y-5 mb-8">
                                <div
                                    class="pt-6 mt-6 border-t border-dashed border-white/20 flex justify-between items-end">
                                    <div>
                                        <span class="block text-white font-bold mb-1">Total Belanja</span>
                                        <span class="block text-[10px] text-gray-500 uppercase tracking-widest">*Belum
                                            termasuk ongkir</span>
                                    </div>
                                    <!-- Angka Grand Total yang merespon klik + dan - -->
                                    <span
                                        class="text-2xl font-extrabold text-transparent bg-clip-text bg-linear-to-r from-blue-400 to-cyan-300">
                                        Rp <span x-text="formatRupiah(grandTotal)"></span>
                                    </span>
                                </div>
                            </div>

                            <a href="{{ route('checkout.index') }}"
                                class="group relative flex w-full h-16 bg-white text-[#09090b] rounded-2xl font-extrabold text-lg transition-all hover:bg-gray-200 items-center justify-center gap-3 overflow-hidden shadow-[0_0_30px_rgba(255,255,255,0.1)] hover:shadow-[0_0_40px_rgba(255,255,255,0.3)] hover:-translate-y-1">
                                Lanjutkan Checkout
                                <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>

                            <div class="mt-6 flex items-center justify-center gap-2 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                                <span class="text-xs font-medium tracking-wide">Data Terenkripsi Aman</span>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

        </div>

        <!-- MODAL KONFIRMASI HAPUS (GLOBAL) -->
        <div x-show="deleteModal" style="display: none;"
            class="fixed inset-0 z-100 flex items-center justify-center p-4">
            <!-- Background Overlay -->
            <div x-show="deleteModal" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="absolute inset-0 bg-black/60 backdrop-blur-sm"
                @click="deleteModal = false">
            </div>

            <!-- Modal Box -->
            <div x-show="deleteModal" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-90 translate-y-4"
                class="relative bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/10 rounded-4xl w-full max-w-md p-8 shadow-2xl overflow-hidden">

                <!-- Hiasan Background Modal -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-red-500/10 blur-[50px] rounded-full pointer-events-none">
                </div>

                <div class="flex flex-col items-center text-center relative z-10">
                    <div
                        class="w-16 h-16 rounded-full bg-red-500/10 border border-red-500/20 text-red-500 flex items-center justify-center mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Hapus dari Keranjang?</h3>
                    <p class="text-gray-400 mb-8 text-sm">Apakah kamu yakin ingin mengeluarkan <span
                            class="text-white font-bold" x-text="deleteItemName"></span> dari keranjang belanja?</p>

                    <div class="flex gap-4 w-full">
                        <button type="button" @click="deleteModal = false"
                            class="flex-1 py-3.5 rounded-xl bg-white/5 border border-white/10 text-white font-bold hover:bg-white/10 transition-colors">
                            Batal
                        </button>
                        <form :action="deleteUrl" method="POST" class="flex-1 m-0">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="w-full py-3.5 rounded-xl bg-red-600 hover:bg-red-500 text-white font-bold shadow-[0_0_15px_rgba(220,38,38,0.3)] transition-all">
                                Ya, Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
