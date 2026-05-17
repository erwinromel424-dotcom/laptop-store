@extends('layouts.app')
@section('title', 'Katalog Laptop Premium')

@section('content')
    <!-- Container Utama: Full Width dengan Ambient Glow -->
    <div class="relative pt-32 pb-24 bg-[#09090b] min-h-screen w-full overflow-hidden">

        <!-- Ambient Glow di bagian atas halaman -->
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-screen h-[50vh] bg-blue-900/10 blur-[120px] pointer-events-none">
        </div>

        <!-- Inner Container Edge-to-Edge -->
        <div class="w-full px-6 md:px-12 lg:px-24 relative z-10">

            <!-- Header Katalog -->
            <div class="mb-12 md:mb-16 text-center md:text-left">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/5 border border-white/10 backdrop-blur-md mb-4">
                    <span class="text-xs font-bold tracking-widest text-blue-400 uppercase">Eksplorasi</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight leading-tight mb-4">
                    Katalog <span
                        class="text-transparent bg-clip-text bg-linear-to-r from-blue-400 to-cyan-300">Produk.</span>
                </h1>
                <p class="text-gray-400 text-lg max-w-2xl font-light">Temukan mesin komputasi presisi yang dirancang khusus
                    untuk menyesuaikan dengan ritme dan beban kerjamu.</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">

                <!-- KIRI: Sidebar Filter -->
                <div class="w-full lg:w-72 shrink-0 space-y-8">

                    <!-- Search Box -->
                    <div
                        class="bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/5 rounded-4xl p-6 shadow-2xl">
                        <h3 class="text-white font-bold mb-4 text-sm uppercase tracking-widest">Pencarian</h3>
                        <form action="{{ route('catalog') }}" method="GET" class="relative">
                            @if (request('kategori'))
                                <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                            @endif
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari seri laptop..."
                                class="w-full bg-[#09090b] border border-white/10 rounded-xl pl-5 pr-12 py-4 text-sm text-white placeholder-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all shadow-inner">
                            <button type="submit"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-blue-400 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </form>
                    </div>

                    <!-- Kategori List -->
                    <div
                        class="bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/5 rounded-4xl p-6 shadow-2xl">
                        <h3 class="text-white font-bold mb-4 text-sm uppercase tracking-widest">Kategori</h3>
                        <div class="space-y-1">
                            <a href="{{ route('catalog') }}"
                                class="flex items-center justify-between group px-4 py-3 rounded-xl transition-all {{ !request('kategori') ? 'bg-blue-600/10 border border-blue-500/20' : 'hover:bg-white/5 border border-transparent' }}">
                                <span
                                    class="text-sm font-bold {{ !request('kategori') ? 'text-blue-400' : 'text-gray-400 group-hover:text-white' }} transition-colors">Semua
                                    Kategori</span>
                            </a>

                            @foreach ($categories as $cat)
                                <a href="{{ route('catalog', ['kategori' => $cat->slug, 'search' => request('search')]) }}"
                                    class="flex items-center justify-between group px-4 py-3 rounded-xl transition-all {{ request('kategori') === $cat->slug ? 'bg-blue-600/10 border border-blue-500/20' : 'hover:bg-white/5 border border-transparent' }}">
                                    <span
                                        class="text-sm font-bold {{ request('kategori') === $cat->slug ? 'text-blue-400' : 'text-gray-400 group-hover:text-white' }} transition-colors">{{ $cat->name }}</span>
                                    <span
                                        class="text-[10px] font-bold bg-[#09090b] border {{ request('kategori') === $cat->slug ? 'border-blue-500/30 text-blue-400' : 'border-white/10 text-gray-500 group-hover:border-white/30 group-hover:text-white' }} px-2 py-1 rounded-md transition-all">{{ $cat->products_count }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- KANAN: Grid Produk -->
                <div class="flex-1">
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 lg:gap-8">
                        @forelse($products as $product)
                            <a href="{{ route('product.show', $product->slug) }}"
                                class="group relative bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/5 rounded-4xl p-5 hover:border-white/20 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_20px_40px_-15px_rgba(0,0,0,0.5)] flex flex-col h-full">

                                <!-- Gambar Wrapper -->
                                <div
                                    class="w-full aspect-video bg-[#09090b] rounded-xl overflow-hidden mb-6 relative flex items-center justify-center p-4 border border-white/5">
                                    <div
                                        class="absolute inset-0 bg-linear-to-t from-[#09090b] to-transparent opacity-50 z-10">
                                    </div>

                                    @if ($product->images->isNotEmpty())
                                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-full object-contain relative z-20 group-hover:scale-110 transition-transform duration-700 drop-shadow-2xl">
                                    @else
                                        <span class="text-gray-700 text-xs tracking-widest font-mono relative z-20">NO
                                            IMAGE</span>
                                    @endif

                                    <span
                                        class="absolute top-3 left-3 z-30 px-3 py-1.5 text-[10px] uppercase tracking-widest font-bold text-white bg-white/10 backdrop-blur-md rounded-lg border border-white/10">
                                        {{ $product->category->name ?? 'Laptop' }}
                                    </span>
                                </div>

                                <!-- Info Konten -->
                                <div class="flex-1 flex flex-col justify-between">
                                    <div>
                                        <h3
                                            class="text-xl font-bold text-white leading-tight group-hover:text-blue-400 transition-colors mb-2">
                                            {{ $product->name }}
                                        </h3>
                                        <p class="text-sm text-gray-500 line-clamp-2 font-light leading-relaxed">
                                            {{ $product->description }}
                                        </p>
                                    </div>

                                    <div
                                        class="mt-6 pt-5 border-t border-white/5 flex items-center justify-between relative z-20">
                                        <div class="flex flex-col">
                                            <span class="text-lg font-extrabold text-white">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </span>
                                            <span
                                                class="text-[10px] uppercase tracking-widest font-bold mt-1 {{ $product->stock > 0 ? 'text-green-500' : 'text-red-500' }}">
                                                {{ $product->stock > 0 ? 'Tersedia: ' . $product->stock . ' Unit' : 'Stok Habis' }}
                                            </span>
                                        </div>
                                        <div
                                            class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-white group-hover:bg-blue-600 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <!-- Empty State Tanpa Emoji -->
                            <div
                                class="col-span-full py-32 flex flex-col items-center justify-center border border-dashed border-white/10 rounded-[3rem]">
                                <div class="w-20 h-20 rounded-full bg-white/5 flex items-center justify-center mb-6">
                                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-white mb-2">Pencarian Tidak Ditemukan</h3>
                                <p class="text-gray-400 font-medium tracking-wide">Coba gunakan kata kunci atau filter
                                    kategori yang berbeda.</p>
                                <a href="{{ route('catalog') }}"
                                    class="mt-6 px-6 py-3 bg-white/5 hover:bg-white/10 border border-white/10 text-white text-sm font-bold rounded-full transition-colors">Reset
                                    Filter</a>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if ($products->hasPages())
                        <div class="mt-12 p-6 bg-[#121214] border border-white/5 rounded-4xl">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
