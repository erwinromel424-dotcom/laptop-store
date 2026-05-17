@extends('layouts.app')

@section('title', 'LaptopStore | Flagship Premium E-Commerce')

@section('content')
    <!-- 1. HERO SECTION: Edge-to-Edge Cinematic Showcase -->
    <div class="relative w-full h-screen bg-[#09090b] flex items-center justify-center overflow-hidden pt-20">

        <!-- Efek Cahaya Artistik Skala Besar -->
        <div
            class="absolute top-1/4 left-0 w-[50vw] h-[50vw] bg-blue-600/10 blur-[150px] rounded-full pointer-events-none transform -translate-x-1/2">
        </div>
        <div
            class="absolute bottom-0 right-0 w-[40vw] h-[40vw] bg-cyan-500/10 blur-[120px] rounded-full pointer-events-none transform translate-x-1/3 translate-y-1/3">
        </div>
        <div
            class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-[0.03] mix-blend-overlay">
        </div>

        <div class="relative z-10 w-full px-6 md:px-12 lg:px-24 flex flex-col items-center text-center">

            <div
                class="inline-flex items-center gap-3 px-5 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-xl mb-10 shadow-[0_0_30px_rgba(255,255,255,0.05)]">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-cyan-500"></span>
                </span>
                <span class="text-xs font-extrabold tracking-[0.2em] text-gray-300 uppercase">Koleksi Flagship 2026</span>
            </div>

            <h1 class="text-6xl md:text-8xl lg:text-[10rem] font-extrabold text-white tracking-tighter leading-[0.9] mb-8">
                Evolusi <br>
                <span
                    class="text-transparent bg-clip-text bg-linear-to-r from-blue-500 via-cyan-400 to-white drop-shadow-2xl">
                    Performa.
                </span>
            </h1>

            <p class="text-lg md:text-2xl text-gray-400 max-w-3xl mx-auto mb-14 font-light leading-relaxed">
                Mendefinisikan ulang standar komputasi modern. Jelajahi jajaran mesin arsitektur mutakhir yang dirancang
                presisi untuk para kreator, engineer, dan visioner sejati.
            </p>

            <div class="flex flex-col sm:flex-row gap-6 w-full sm:w-auto justify-center">
                <a href="{{ url('/katalog') }}"
                    class="group relative inline-flex justify-center items-center px-12 py-5 text-base font-bold text-[#09090b] bg-white rounded-full overflow-hidden transition-all duration-500 hover:scale-105 hover:shadow-[0_0_40px_rgba(255,255,255,0.4)]">
                    <span
                        class="absolute inset-0 w-full h-full bg-linear-to-r from-white via-gray-200 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
                    <span class="relative flex items-center gap-2">
                        Eksplorasi Katalog
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </span>
                </a>
                <a href="#kategori-unggulan"
                    class="inline-flex justify-center items-center px-12 py-5 text-base font-bold text-white bg-transparent border border-white/20 rounded-full hover:bg-white/10 hover:border-white/40 transition-all duration-300">
                    Lihat Kategori
                </a>
            </div>
        </div>

        <!-- Scroll Down Indicator -->
        <div class="absolute bottom-12 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 opacity-50">
            <span class="text-[10px] uppercase tracking-widest font-bold text-gray-400">Scroll</span>
            <div class="w-px h-12 bg-linear-to-b from-gray-400 to-transparent"></div>
        </div>
    </div>

    <!-- 2. BRAND MARQUEE: Social Proof & Trust Signals -->
    <div class="w-full bg-[#050505] border-y border-white/5 py-8 overflow-hidden flex items-center">
        <div
            class="w-full flex space-x-16 md:space-x-32 animate-[marquee_30s_linear_infinite] whitespace-nowrap opacity-40 px-8">
            <!-- Modern Typography Brands as Placeholders -->
            <span class="text-2xl md:text-3xl font-extrabold tracking-tighter text-white">REPUBLIC OF GAMERS</span>
            <span class="text-2xl md:text-3xl font-extrabold tracking-tighter text-white">APPLE SILICON</span>
            <span class="text-2xl md:text-3xl font-extrabold tracking-tighter text-white">ALIENWARE</span>
            <span class="text-2xl md:text-3xl font-extrabold tracking-tighter text-white">THINKPAD PRO</span>
            <span class="text-2xl md:text-3xl font-extrabold tracking-tighter text-white">RAZER BLADE</span>
            <!-- Duplicate for infinite loop illusion -->
            <span class="text-2xl md:text-3xl font-extrabold tracking-tighter text-white">REPUBLIC OF GAMERS</span>
            <span class="text-2xl md:text-3xl font-extrabold tracking-tighter text-white">APPLE SILICON</span>
            <span class="text-2xl md:text-3xl font-extrabold tracking-tighter text-white">ALIENWARE</span>
        </div>
    </div>

    <!-- 3. CATEGORY SHOWCASE (Bento Grid Full Width) -->
    <div id="kategori-unggulan" class="w-full bg-[#09090b] py-32 relative">
        <div class="w-full px-6 md:px-12 lg:px-24">

            <div class="mb-16">
                <h2 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight leading-tight">
                    Dirancang untuk <br>
                    <span class="text-gray-600">setiap ambisimu.</span>
                </h2>
            </div>

            <!-- Bento Grid Layout Kategori -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 auto-rows-[300px] md:auto-rows-[400px]">

                <!-- Bento Kiri: Gaming (Lebar 2 Kolom di LG) -->
                <a href="{{ url('/katalog?kategori=laptop-gaming') }}"
                    class="group lg:col-span-2 relative bg-linear-to-br from-[#121214] to-[#050505] border border-white/10 rounded-[2.5rem] overflow-hidden flex flex-col justify-end p-10 hover:border-blue-500/50 transition-all duration-700">
                    <div class="absolute inset-0 bg-blue-600/5 group-hover:bg-blue-600/20 transition-colors duration-700">
                    </div>
                    <!-- Aksesori Visual Background -->
                    <div
                        class="absolute -right-20 -top-20 w-96 h-96 bg-blue-500/20 blur-[80px] rounded-full group-hover:scale-150 transition-transform duration-1000">
                    </div>

                    <div class="relative z-10 w-full flex justify-between items-end">
                        <div>
                            <div
                                class="w-12 h-12 bg-black/50 backdrop-blur-md rounded-xl border border-white/10 flex items-center justify-center mb-6">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-3xl md:text-5xl font-extrabold text-white mb-3">Esports & Gaming</h3>
                            <p class="text-gray-400 text-lg max-w-md">Dominasi arena dengan frame rate maksimal dan sistem
                                pendingin mutakhir.</p>
                        </div>
                        <div
                            class="hidden md:flex w-14 h-14 rounded-full bg-white text-black items-center justify-center group-hover:-rotate-45 transition-transform duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Bento Kanan Atas: Profesional -->
                <a href="{{ url('/katalog?kategori=laptop-bisnis') }}"
                    class="group relative bg-[#121214] border border-white/10 rounded-[2.5rem] overflow-hidden flex flex-col justify-end p-8 hover:border-purple-500/50 transition-all duration-700">
                    <div
                        class="absolute -left-10 -bottom-10 w-64 h-64 bg-purple-500/20 blur-[60px] rounded-full group-hover:scale-150 transition-transform duration-1000">
                    </div>
                    <div class="relative z-10 w-full">
                        <div
                            class="w-10 h-10 bg-black/50 backdrop-blur-md rounded-lg border border-white/10 flex items-center justify-center mb-4">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Profesional & Bisnis</h3>
                        <p class="text-gray-400 text-sm">Keamanan data tingkat tinggi dalam chassis teringan di dunia.</p>
                    </div>
                </a>

                <!-- Bento Bawah: Pelajar -->
                <a href="{{ url('/katalog?kategori=laptop-pelajar') }}"
                    class="group lg:col-span-3 relative bg-[#121214] border border-white/10 rounded-[2.5rem] overflow-hidden flex flex-col md:flex-row items-center md:items-end justify-between p-10 hover:border-cyan-500/50 transition-all duration-700">
                    <div
                        class="absolute inset-0 bg-linear-to-r from-cyan-600/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700">
                    </div>
                    <div class="relative z-10 w-full md:w-1/2 mb-6 md:mb-0">
                        <div
                            class="w-12 h-12 bg-black/50 backdrop-blur-md rounded-xl border border-white/10 flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-3xl md:text-4xl font-bold text-white mb-3">Pelajar & Kreatif</h3>
                        <p class="text-gray-400 text-lg">Investasi cerdas untuk masa depan. Reliabilitas tinggi untuk tugas
                            tanpa henti.</p>
                    </div>
                    <div class="relative z-10 w-full md:w-auto flex justify-end">
                        <span class="inline-flex items-center gap-2 text-cyan-400 font-bold group-hover:text-cyan-300">
                            Eksplorasi Kelas Ini
                            <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </span>
                    </div>
                </a>

            </div>
        </div>
    </div>

    <!-- 4. FEATURED PRODUCTS EDGE-TO-EDGE -->
    <div class="w-full bg-[#09090b] py-20 border-t border-white/5 relative">
        <div class="w-full px-6 md:px-12 lg:px-24">

            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                <div>
                    <h2 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight">Karya <span
                            class="text-gray-600">Unggulan.</span></h2>
                    <p class="mt-4 text-gray-400 text-lg max-w-2xl">Dipilih secara ketat berdasarkan rasio performa dan
                        ulasan tertinggi dari komunitas.</p>
                </div>
                <a href="{{ url('/katalog') }}"
                    class="group inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white/5 border border-white/10 text-white font-bold hover:bg-white/10 transition-all">
                    Lihat Semua Koleksi
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>

            <!-- Grid Highlight Laptop -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                @forelse ($products->take(4) as $product)
                    <a href="{{ url('/produk/' . $product->slug) }}"
                        class="group relative bg-[#121214] border border-white/5 rounded-4xl p-6 hover:border-white/20 transition-all duration-500 hover:-translate-y-3 hover:shadow-[0_30px_60px_-15px_rgba(0,0,0,0.5)] flex flex-col h-full">

                        <!-- Gambar Area -->
                        <div
                            class="w-full h-56 mb-8 flex items-center justify-center relative bg-[#09090b] rounded-2xl p-4 overflow-hidden border border-white/5">
                            <!-- Overlay Linear untuk Kontras -->
                            <div class="absolute inset-0 bg-linear-to-t from-[#09090b] to-transparent opacity-50 z-10">
                            </div>

                            @if ($product->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-contain relative z-20 group-hover:scale-110 transition-transform duration-700 drop-shadow-2xl">
                            @else
                                <span class="text-gray-700 font-mono text-sm relative z-20">NO IMAGE</span>
                            @endif

                            <div class="absolute top-3 left-3 z-30">
                                <span
                                    class="px-3 py-1 text-[10px] uppercase tracking-widest font-bold text-white bg-white/10 backdrop-blur-md rounded-full border border-white/10">
                                    {{ $product->category->name ?? 'Premium' }}
                                </span>
                            </div>
                        </div>

                        <!-- Info Teks -->
                        <div class="flex-1 flex flex-col justify-end text-left">
                            <h3
                                class="text-xl font-bold text-white mb-2 line-clamp-2 leading-tight group-hover:text-blue-400 transition-colors">
                                {{ $product->name }}</h3>
                            <p class="text-sm text-gray-500 mb-6 line-clamp-2">{{ $product->description }}</p>

                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-white/5">
                                <p class="text-xl font-extrabold text-white">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</p>
                                <div
                                    class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-white group-hover:bg-white group-hover:text-black transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div
                        class="col-span-full py-32 flex flex-col items-center justify-center border border-dashed border-white/10 rounded-[3rem]">
                        <div class="w-20 h-20 rounded-full bg-white/5 flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Katalog Kosong</h3>
                        <p class="text-gray-400 font-medium tracking-wide">Belum ada perangkat yang ditambahkan ke sistem.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- 5. VALUE PROPOSITION (Trust Signals) -->
    <div class="w-full bg-[#050505] py-24 border-t border-white/5">
        <div class="w-full px-6 md:px-12 lg:px-24">
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 divide-y md:divide-y-0 md:divide-x divide-white/10 text-center lg:text-left">

                <div class="flex flex-col lg:flex-row items-center lg:items-start gap-6 px-4">
                    <div
                        class="w-16 h-16 rounded-2xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center shrink-0">
                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-white mb-2">Garansi Resmi</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">Semua perangkat dilindungi oleh perlindungan
                            pabrik langsung. 100% aman.</p>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row items-center lg:items-start gap-6 px-4 pt-12 md:pt-0">
                    <div
                        class="w-16 h-16 rounded-2xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center shrink-0">
                        <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-white mb-2">Pengiriman Ekstra Aman</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">Dikemas presisi menggunakan bubble wrap ganda dan
                            peti kayu untuk perjalanan jauh.</p>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row items-center lg:items-start gap-6 px-4 pt-12 md:pt-0">
                    <div
                        class="w-16 h-16 rounded-2xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center shrink-0">
                        <svg class="w-8 h-8 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-white mb-2">Dukungan Teknis</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">Tim IT ahli kami siap membantu kendala sistem
                            operasi atau perangkat keras.</p>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row items-center lg:items-start gap-6 px-4 pt-12 md:pt-0">
                    <div
                        class="w-16 h-16 rounded-2xl bg-green-500/10 border border-green-500/20 flex items-center justify-center shrink-0">
                        <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-white mb-2">Retur Mudah 7 Hari</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">Pengembalian unit terjamin jika terbukti ada
                            kerusakan atau cacat dari pabrikan.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- 6. MASSIVE BOTTOM BANNER (Full-width immersive CTA) -->
    <div class="w-full bg-[#09090b] py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-blue-900/20 blur-[150px] pointer-events-none"></div>
        <div class="w-full px-6 md:px-12 lg:px-24 relative z-10">

            <div
                class="w-full rounded-[4rem] overflow-hidden bg-linear-to-tr from-[#050505] via-[#121214] to-[#050505] border border-white/10 p-16 md:p-32 flex flex-col md:flex-row items-center justify-between gap-16 group">

                <div
                    class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-[0.05] mix-blend-overlay">
                </div>

                <div class="relative z-10 max-w-3xl text-center md:text-left">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 mb-8">
                        <span class="text-xs font-bold tracking-widest text-blue-400 uppercase">Akses Eksklusif</span>
                    </div>
                    <h2 class="text-5xl md:text-7xl font-extrabold text-white mb-8 leading-[1.1] tracking-tight">Leveling
                        up <br> <span class="text-gray-500">starts here.</span></h2>
                    <p class="text-gray-400 text-xl md:text-2xl mb-12 font-light leading-relaxed">Bergabung dengan
                        ekosistem kami untuk menerima rilis prioritas, diskon hardware khusus, dan pengiriman gratis.</p>

                    @guest
                        <a href="{{ route('register') }}"
                            class="inline-flex justify-center items-center px-12 py-5 text-base font-bold text-[#09090b] bg-white rounded-full hover:bg-gray-200 transition-all duration-300 hover:scale-105 shadow-[0_0_30px_rgba(255,255,255,0.2)]">
                            Inisialisasi Akun
                        </a>
                    @else
                        <a href="{{ url('/katalog') }}"
                            class="inline-flex justify-center items-center px-12 py-5 text-base font-bold text-[#09090b] bg-white rounded-full hover:bg-gray-200 transition-all duration-300 hover:scale-105 shadow-[0_0_30px_rgba(255,255,255,0.2)]">
                            Buka Katalog Penuh
                        </a>
                    @endguest
                </div>

                <!-- 3D/Abstract Glass Orb representation -->
                <div
                    class="relative z-10 w-64 h-64 md:w-96 md:h-96 rounded-full bg-linear-to-tr from-cyan-400 via-blue-600 to-purple-600 blur-sm opacity-70 mix-blend-screen group-hover:scale-110 group-hover:rotate-45 transition-all duration-2000 shadow-2xl flex items-center justify-center">
                    <div
                        class="w-full h-full rounded-full bg-linear-to-bl from-white/20 to-transparent backdrop-blur-3xl border border-white/30">
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
