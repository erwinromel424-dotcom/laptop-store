@extends('layouts.app')
@section('title', $product->name . ' | LaptopStore')

@section('content')
    <div class="relative pt-32 pb-24 bg-[#09090b] min-h-screen w-full overflow-hidden">

        <div
            class="absolute top-20 right-0 w-[40vw] h-[40vh] bg-blue-900/10 blur-[150px] pointer-events-none transform translate-x-1/4">
        </div>
        <div
            class="absolute bottom-1/4 left-0 w-[30vw] h-[30vh] bg-cyan-900/10 blur-[120px] pointer-events-none transform -translate-x-1/4">
        </div>

        <div class="w-full px-6 md:px-12 lg:px-24 relative z-10">

            <nav class="flex items-center gap-3 mb-8 text-sm font-medium text-gray-500">
                <a href="{{ url('/') }}" class="hover:text-blue-400 transition-colors flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    Beranda
                </a>
                <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ url('/katalog') }}" class="hover:text-blue-400 transition-colors">Katalog</a>
                <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-gray-300 truncate max-w-50 sm:max-w-none">{{ $product->name }}</span>
            </nav>

            <div
                class="bg-linear-to-br from-[#121214] to-[#0a0a0c] border border-white/5 rounded-[3rem] p-8 md:p-12 lg:p-16 shadow-2xl relative overflow-hidden">
                <div
                    class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.03] mix-blend-overlay pointer-events-none">
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 relative z-10">

                    @php $primaryImage = $product->images->where('is_primary', true)->first(); @endphp
                    <div x-data="{ mainImage: '{{ $primaryImage ? asset('storage/' . $primaryImage->image_path) : '' }}' }" class="flex flex-col gap-6">

                        <div
                            class="w-full aspect-4/3 sm:aspect-square rounded-4xl bg-[#050505] border border-white/10 flex items-center justify-center p-8 overflow-hidden relative group shadow-inner">
                            <div
                                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-3/4 h-3/4 bg-linear-to-tr from-blue-600/10 to-cyan-400/10 blur-[60px] rounded-full pointer-events-none group-hover:scale-110 transition-transform duration-700">
                            </div>

                            <template x-if="mainImage !== ''">
                                <img :src="mainImage" alt="{{ $product->name }}"
                                    class="w-full h-full object-contain relative z-10 transition-transform duration-700 drop-shadow-2xl group-hover:scale-105">
                            </template>
                            <template x-if="mainImage === ''">
                                <span class="text-gray-600 font-mono text-sm tracking-widest relative z-10">NO IMAGE
                                    AVAILABLE</span>
                            </template>
                        </div>

                        @if ($product->images->count() > 1)
                            <div class="grid grid-cols-4 gap-4">
                                @foreach ($product->images as $img)
                                    @php $imgUrl = asset('storage/' . $img->image_path); @endphp
                                    <div @click="mainImage = '{{ $imgUrl }}'"
                                        class="cursor-pointer aspect-square rounded-2xl bg-[#09090b] transition-all duration-300 p-3 flex items-center justify-center overflow-hidden border-2"
                                        :class="mainImage === '{{ $imgUrl }}' ?
                                            'border-blue-500 shadow-[0_0_20px_rgba(37,99,235,0.2)]' :
                                            'border-white/5 opacity-50 hover:opacity-100 hover:border-white/20'">
                                        <img src="{{ $imgUrl }}" class="w-full h-full object-contain">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col justify-center">

                        <div class="mb-6">
                            <span
                                class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase bg-white/5 border border-white/10 text-gray-300">
                                {{ $product->category->name ?? 'Premium Device' }}
                            </span>
                        </div>

                        <h1
                            class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-[1.1] mb-6">
                            {{ $product->name }}
                        </h1>

                        <div class="flex flex-wrap items-center gap-6 mb-8">
                            <p
                                class="text-4xl font-extrabold text-transparent bg-clip-text bg-linear-to-r from-blue-400 to-cyan-300">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                            <div class="h-8 w-px bg-white/10 hidden sm:block"></div>
                            <span
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold {{ $product->stock > 0 ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20' }}">
                                <span
                                    class="w-2 h-2 rounded-full {{ $product->stock > 0 ? 'bg-green-500 animate-pulse' : 'bg-red-500' }}"></span>
                                {{ $product->stock > 0 ? 'Tersedia ' . $product->stock . ' Unit' : 'Stok Habis' }}
                            </span>
                        </div>

                        <div class="prose prose-invert prose-gray max-w-none mb-10">
                            <p class="text-gray-400 text-lg leading-relaxed font-light whitespace-pre-line">
                                {{ $product->description }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-10">
                            <div class="bg-[#050505] p-5 rounded-2xl border border-white/5 flex flex-col gap-1">
                                <span class="text-xs text-gray-500 uppercase tracking-widest font-bold">Kode SKU</span>
                                <span class="font-mono text-white text-base">{{ $product->sku }}</span>
                            </div>
                            <div class="bg-[#050505] p-5 rounded-2xl border border-white/5 flex flex-col gap-1">
                                <span class="text-xs text-gray-500 uppercase tracking-widest font-bold">Berat Fisik</span>
                                <span
                                    class="font-bold text-white text-base">{{ number_format($product->weight, 0, ',', '.') }}
                                    Gram</span>
                            </div>
                        </div>

                        <div class="mt-auto pt-8 border-t border-white/5">
                            @if ($product->stock > 0)
                                <form action="{{ route('cart.store') }}" method="POST"
                                    class="flex flex-col sm:flex-row gap-4 relative" x-data="{ qty: 1, maxStock: {{ $product->stock }}, showAlert: false }">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    <div x-show="showAlert" x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 transform translate-y-2"
                                        x-transition:enter-end="opacity-100 transform translate-y-0"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100 transform translate-y-0"
                                        x-transition:leave-end="opacity-0 transform translate-y-2"
                                        class="absolute bottom-[calc(100%+10px)] left-0 bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-bold px-4 py-2 rounded-lg flex items-center gap-2 backdrop-blur-md"
                                        style="display: none;">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                            </path>
                                        </svg>
                                        Maksimal stok yang tersedia hanya {{ $product->stock }} unit.
                                    </div>

                                    <div
                                        class="w-full sm:w-40 bg-[#050505] border border-white/10 rounded-2xl flex items-center justify-between p-2 h-16 relative z-10">

                                        <button type="button" @click="if(qty > 1) { qty--; showAlert = false; }"
                                            class="w-10 h-10 rounded-xl bg-white/5 text-gray-400 hover:text-white hover:bg-white/10 transition-colors flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 12H4"></path>
                                            </svg>
                                        </button>

                                        <input type="number" name="quantity" x-model="qty" min="1"
                                            :max="maxStock"
                                            class="w-12 bg-transparent text-center text-white border-0 focus:ring-0 p-0 text-xl font-extrabold outline-none appearance-none"
                                            readonly>

                                        <button type="button"
                                            @click="if(qty < maxStock) { qty++; } else { showAlert = true; setTimeout(() => showAlert = false, 3000); }"
                                            class="w-10 h-10 rounded-xl bg-white/5 text-gray-400 hover:text-white hover:bg-white/10 transition-colors flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    @auth
                                        <button type="submit"
                                            class="flex-1 h-16 bg-blue-600 hover:bg-blue-500 text-white rounded-2xl font-extrabold text-lg transition-all shadow-[0_0_30px_rgba(37,99,235,0.3)] hover:shadow-[0_0_40px_rgba(37,99,235,0.5)] hover:-translate-y-1 flex items-center justify-center gap-3">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                            Masukkan Keranjang
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="flex-1 h-16 bg-white hover:bg-gray-200 text-[#09090b] rounded-2xl font-extrabold text-lg transition-all flex items-center justify-center gap-3 hover:-translate-y-1 shadow-xl">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                                </path>
                                            </svg>
                                            Login untuk Membeli
                                        </a>
                                    @endauth
                                </form>
                            @else
                                <div
                                    class="w-full h-16 bg-white/5 border border-white/10 flex items-center justify-center rounded-2xl text-gray-500 font-bold uppercase tracking-widest cursor-not-allowed">
                                    Produk Tidak Tersedia
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

            @if ($relatedProducts->isNotEmpty())
                <div class="mt-32">
                    <div class="flex items-center justify-between mb-10">
                        <h3 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight">Perangkat <span
                                class="text-gray-600">Sejenis.</span></h3>
                        <a href="{{ url('/katalog') }}"
                            class="hidden sm:flex items-center gap-2 text-blue-400 font-bold hover:text-blue-300 transition-colors group">
                            Eksplorasi Lainnya
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                        @foreach ($relatedProducts as $related)
                            <a href="{{ route('product.show', $related->slug) }}"
                                class="group relative bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/5 rounded-4xl p-5 hover:border-white/20 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_20px_40px_-15px_rgba(0,0,0,0.5)] flex flex-col h-full">

                                <div
                                    class="w-full aspect-video bg-[#09090b] rounded-xl overflow-hidden mb-6 relative flex items-center justify-center p-4 border border-white/5">
                                    <div
                                        class="absolute inset-0 bg-linear-to-t from-[#09090b] to-transparent opacity-50 z-10">
                                    </div>
                                    @if ($related->images->isNotEmpty())
                                        <img src="{{ asset('storage/' . $related->images->first()->image_path) }}"
                                            class="w-full h-full object-contain relative z-20 group-hover:scale-110 transition-transform duration-700 drop-shadow-2xl">
                                    @else
                                        <span class="text-gray-700 text-xs tracking-widest font-mono relative z-20">NO
                                            IMAGE</span>
                                    @endif
                                </div>

                                <div class="flex-1 flex flex-col justify-between">
                                    <h4
                                        class="text-lg font-bold text-white line-clamp-1 group-hover:text-blue-400 transition-colors mb-4">
                                        {{ $related->name }}
                                    </h4>

                                    <div class="pt-4 border-t border-white/5 flex items-center justify-between">
                                        <p class="text-lg font-extrabold text-white">Rp
                                            {{ number_format($related->price, 0, ',', '.') }}</p>
                                        <div
                                            class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center text-white group-hover:bg-blue-600 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
