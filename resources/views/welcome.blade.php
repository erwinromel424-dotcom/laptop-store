@extends('layouts.app')

@section('title', 'LaptopStore | Flagship Premium E-Commerce')

@section('content')
    <!-- 1. HERO SECTION: Edge-to-Edge Cinematic Showcase -->
    <div class="relative w-full min-h-screen bg-[#09090b] flex items-center justify-center overflow-hidden">

        <!-- BACKGROUND IMAGE: Laptop Background dengan Opacity Rendah -->
        <div class="absolute inset-0 z-0">
            <!-- Ganti URL di bawah dengan foto laptop flagship (misal: MacBook, ROG, atau XPS) -->
            <img src="https://images.unsplash.com/photo-1593642702821-c8da6771f0c6?q=80&w=2032&auto=format&fit=crop"
                class="w-full h-full object-cover opacity-[0.15] scale-105 transition-transform duration-[10s] animate-subtle-zoom"
                alt="Flagship Laptop Background">

            <!-- Overlay Linear: Memastikan teks terbaca & menyatu dengan warna brand -->
            <div class="absolute inset-0 bg-linear-to-b from-[#09090b] via-[#09090b]/80 to-[#09090b]"></div>
            <div class="absolute inset-0 bg-linear-to-r from-[#09090b] via-transparent to-[#09090b] opacity-60"></div>
        </div>

        <!-- Efek Cahaya Artistik (Ditingkatkan) -->
        <div class="absolute top-1/4 left-0 w-[60vw] h-[60vw] bg-blue-600/5 blur-[150px] rounded-full pointer-events-none transform -translate-x-1/2 animate-pulse"
            style="animation-duration: 8s;"></div>
        <div class="absolute bottom-0 right-0 w-[50vw] h-[50vw] bg-cyan-500/5 blur-[120px] rounded-full pointer-events-none transform translate-x-1/3 translate-y-1/3 animate-pulse"
            style="animation-duration: 12s;"></div>

        <!-- Grain/Noise Texture -->
        <div
            class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-2 mix-blend-overlay pointer-events-none z-1">
        </div>

        <div class="relative z-10 w-full px-6 md:px-12 lg:px-24 flex flex-col items-center text-center">

            <!-- Badge Flagship -->
            <div
                class="inline-flex items-center gap-3 px-5 py-2 rounded-full bg-white/3 border border-white/10 backdrop-blur-2xl mb-12 shadow-2xl transition-transform hover:scale-105 duration-500 cursor-default">
                <span class="relative flex h-2 w-2">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-cyan-500"></span>
                </span>
                <span class="text-[10px] md:text-xs font-bold tracking-[0.3em] text-gray-300 uppercase italic">Next-Gen
                    Computing</span>
            </div>

            <!-- Heading -->
            <h1 class="text-6xl md:text-8xl lg:text-[8rem] font-extrabold text-white tracking-tighter mb-10 leading-[0.9]">
                <span class="inline-block opacity-0 animate-fade-in-up"
                    style="animation-delay: 200ms; animation-fill-mode: forwards;">Evolusi</span><br>
                <span
                    class="p-4 text-transparent bg-clip-text bg-linear-to-r from-blue-500 via-cyan-300 to-indigo-400 drop-shadow-[0_10px_10px_rgba(0,0,0,0.5)] inline-block opacity-0 animate-fade-in-up"
                    style="animation-delay: 400ms; animation-fill-mode: forwards;">
                    Performa.
                </span>
            </h1>

            <!-- Subtext -->
            <p class="text-lg md:text-2xl text-gray-400 max-w-3xl mx-auto mb-16 font-light leading-relaxed antialiased opacity-0 animate-fade-in-up"
                style="animation-delay: 600ms; animation-fill-mode: forwards;">
                Mendefinisikan ulang standar komputasi modern untuk para kreator, teknisi, dan visioner sejati. Temukan
                perangkat yang melampaui batas hari ini.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-5 w-full sm:w-auto justify-center opacity-0 animate-fade-in-up"
                style="animation-delay: 800ms; animation-fill-mode: forwards;">
                <a href="{{ url('/katalog') }}"
                    class="group relative inline-flex justify-center items-center px-14 py-5 text-sm font-bold text-[#09090b] bg-white rounded-full overflow-hidden transition-all duration-500 hover:scale-105 hover:shadow-[0_0_50px_rgba(255,255,255,0.2)]">
                    <span class="relative flex items-center gap-2">
                        Eksplorasi Katalog
                        <svg class="w-4 h-4 group-hover:translate-x-1.5 transition-transform duration-300" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </span>
                </a>
                <a href="#kategori-unggulan"
                    class="inline-flex justify-center items-center px-14 py-5 text-sm font-bold text-white bg-white/5 border border-white/10 rounded-full hover:bg-white/10 hover:border-white/30 backdrop-blur-sm transition-all duration-300">
                    Lihat Kategori
                </a>
            </div>
        </div>

        <!-- Scroll Down Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-3">
            <span class="text-[9px] uppercase tracking-[0.4em] font-bold text-gray-600 animate-pulse">Explore</span>
            <div class="w-px h-16 bg-linear-to-b from-blue-500/50 via-gray-800 to-transparent"></div>
        </div>
    </div>
    <style>
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 1s ease-out;
        }

        @keyframes subtle-zoom {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.1);
            }
        }

        .animate-subtle-zoom {
            animation: subtle-zoom 20s infinite alternate ease-in-out;
        }
    </style>

    <!-- 2. BRAND MARQUEE: Social Proof & Trust Signals -->
    <div class="relative w-full bg-[#050505] border-y border-white/5 py-10 overflow-hidden flex items-center group">
        <!-- Overlay Gradasi Halus di Pinggir (Kiri & Kanan) -->
        <div
            class="absolute inset-y-0 left-0 w-24 md:w-48 bg-linear-to-r from-[#050505] to-transparent z-10 pointer-events-none">
        </div>
        <div
            class="absolute inset-y-0 right-0 w-24 md:w-48 bg-linear-to-l from-[#050505] to-transparent z-10 pointer-events-none">
        </div>

        <!-- Container Marquee -->
        <div class="flex w-fit animate-marquee whitespace-nowrap px-8 gap-16 md:gap-32 items-center">
            <!-- Group 1 -->
            <div
                class="flex items-center gap-16 md:gap-32 opacity-40 group-hover:opacity-100 transition-opacity duration-700">
                <span class="text-2xl md:text-4xl font-extrabold tracking-tighter text-white uppercase italic">Republic of
                    Gamers</span>
                <span
                    class="text-2xl md:text-4xl font-extrabold tracking-tighter text-white uppercase italic">MacBook</span>
                <span class="text-2xl md:text-4xl font-extrabold tracking-tighter text-white uppercase italic">Advan</span>
                <span
                    class="text-2xl md:text-4xl font-extrabold tracking-tighter text-white uppercase italic">ThinkPad</span>
                <span class="text-2xl md:text-4xl font-extrabold tracking-tighter text-white uppercase italic">Acer
                    Precision</span>
            </div>

            <!-- Group 2 (Duplikasi untuk loop tanpa putus) -->
            <div
                class="flex items-center gap-16 md:gap-32 opacity-40 group-hover:opacity-100 transition-opacity duration-700">
                <span class="text-2xl md:text-4xl font-extrabold tracking-tighter text-white uppercase italic">Republic of
                    Gamers</span>
                <span
                    class="text-2xl md:text-4xl font-extrabold tracking-tighter text-white uppercase italic">MacBook</span>
                <span class="text-2xl md:text-4xl font-extrabold tracking-tighter text-white uppercase italic">Advan</span>
                <span
                    class="text-2xl md:text-4xl font-extrabold tracking-tighter text-white uppercase italic">ThinkPad</span>
                <span class="text-2xl md:text-4xl font-extrabold tracking-tighter text-white uppercase italic">Acer
                    Precision</span>
            </div>
        </div>
    </div>
    <style>
        @keyframes marqueeCustom {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-marquee {
            display: flex;
            width: max-content;
            animation: marqueeCustom 30s linear infinite;
        }

        /* Opsional: Berhenti saat di-hover agar user bisa membaca */
        .group:hover .animate-marquee {
            animation-play-state: paused;
        }
    </style>

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
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 auto-rows-[350px] md:auto-rows-[450px]">

                <!-- Bento Kiri: Gaming -->
                <a href="{{ url('/katalog?kategori=laptop-gaming') }}"
                    class="group lg:col-span-2 relative bg-[#121214] border border-white/10 rounded-[3rem] overflow-hidden flex flex-col justify-end p-10 hover:border-blue-500/50 transition-all duration-700">

                    <!-- Image Background -->
                    <img src="https://images.unsplash.com/photo-1603481588273-2f908a9a7a1b?q=80&w=2070&auto=format&fit=crop"
                        class="absolute inset-0 w-full h-full object-cover opacity-30 group-hover:scale-110 group-hover:opacity-50 transition-all duration-1000"
                        alt="Gaming Setup">

                    <div class="absolute inset-0 bg-linear-to-t from-[#050505] via-[#050505]/40 to-transparent"></div>

                    <div class="relative z-10 w-full flex justify-between items-end">
                        <div>
                            <div
                                class="w-12 h-12 bg-blue-600/20 backdrop-blur-md rounded-xl border border-white/10 flex items-center justify-center mb-6">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-3xl md:text-5xl font-extrabold text-white mb-3 tracking-tighter">Esports &
                                Gaming</h3>
                            <p class="text-gray-400 text-lg max-w-md">Dominasi arena dengan frame rate maksimal.</p>
                        </div>
                        <div
                            class="hidden md:flex w-14 h-14 rounded-full bg-white text-black items-center justify-center group-hover:-rotate-45 transition-transform duration-500 shadow-[0_0_20px_rgba(255,255,255,0.3)]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Bento Kanan Atas: Profesional -->
                <a href="{{ url('/katalog?kategori=laptop-bisnis') }}"
                    class="group relative bg-[#121214] border border-white/10 rounded-[3rem] overflow-hidden flex flex-col justify-end p-8 hover:border-purple-500/50 transition-all duration-700">

                    <!-- Image Background -->
                    <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=2070&auto=format&fit=crop"
                        class="absolute inset-0 w-full h-full object-cover opacity-20 group-hover:scale-110 transition-all duration-1000"
                        alt="Professional Office">

                    <div class="absolute inset-0 bg-linear-to-t from-[#050505] to-transparent"></div>

                    <div class="relative z-10 w-full">
                        <div
                            class="w-10 h-10 bg-purple-600/20 backdrop-blur-md rounded-lg border border-white/10 flex items-center justify-center mb-4">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Profesional</h3>
                        <p class="text-gray-400 text-sm">Keamanan data tingkat tinggi dalam chassis teringan.</p>
                    </div>
                </a>

                <!-- Bento Bawah: Pelajar -->
                <a href="{{ url('/katalog?kategori=laptop-pelajar') }}"
                    class="group lg:col-span-3 relative bg-[#121214] border border-white/10 rounded-[3rem] overflow-hidden flex flex-col md:flex-row items-center md:items-end justify-between p-10 hover:border-cyan-500/50 transition-all duration-700">

                    <!-- Image Background -->
                    <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=2070&auto=format&fit=crop"
                        class="absolute inset-0 w-full h-full object-cover opacity-10 group-hover:opacity-20 group-hover:scale-105 transition-all duration-1000"
                        alt="Student coding">

                    <div class="absolute inset-0 bg-linear-to-r from-[#050505] via-[#050505]/80 to-transparent"></div>

                    <div class="relative z-10 w-full md:w-1/2 mb-6 md:mb-0">
                        <div
                            class="w-12 h-12 bg-cyan-600/20 backdrop-blur-md rounded-xl border border-white/10 flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-3xl md:text-4xl font-bold text-white mb-3">Pelajar & Kreatif</h3>
                        <p class="text-gray-400 text-lg">Investasi cerdas untuk masa depan dan reliabilitas tinggi.</p>
                    </div>
                    <div class="relative z-10 w-full md:w-auto flex justify-end">
                        <span
                            class="inline-flex items-center gap-2 text-cyan-400 font-bold group-hover:text-cyan-300 px-6 py-3 bg-white/5 rounded-full border border-white/10 backdrop-blur-sm transition-all">
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
    <div class="w-full bg-[#09090b] py-32 border-t border-white/5 relative overflow-hidden">
        <!-- Dekorasi Background (Subtle Glow) -->
        <div class="absolute top-0 right-0 w-125 h-125 bg-blue-600/5 blur-[120px] rounded-full -mr-64 -mt-64">
        </div>

        <div class="w-full px-6 md:px-12 lg:px-24 relative z-10">

            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-20 gap-8">
                <div class="max-w-3xl">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-bold uppercase tracking-widest mb-6">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                        </span>
                        Koleksi Terbaru
                    </div>
                    <h2 class="text-4xl md:text-6xl font-extrabold text-white tracking-tighter leading-tight">
                        Karya <span class="text-gray-500">Unggulan.</span>
                    </h2>
                    <p class="mt-6 text-gray-400 text-lg md:text-xl leading-relaxed">
                        Dipilih secara ketat berdasarkan rasio performa dan ulasan tertinggi dari komunitas profesional.
                    </p>
                </div>

                <a href="{{ url('/katalog') }}"
                    class="group flex items-center gap-3 px-8 py-4 rounded-full bg-white text-black font-bold hover:bg-gray-200 transition-all duration-300 shadow-lg shadow-white/5">
                    Lihat Semua Koleksi
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>

            <!-- Grid Highlight Laptop -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-10">
                @forelse ($products->take(4) as $product)
                    <a href="{{ url('/katalog/' . $product->slug) }}"
                        class="group relative bg-[#121214] border border-white/5 rounded-[2.5rem] p-7 hover:border-white/20 transition-all duration-500 hover:-translate-y-4 flex flex-col h-full shadow-2xl">

                        <!-- Gambar Area dengan Glow Effect -->
                        <div
                            class="w-full h-64 mb-10 flex items-center justify-center relative bg-linear-to-b from-white/2 to-transparent rounded-3xl overflow-hidden p-6">

                            <!-- Hover Glow Decor -->
                            <div
                                class="absolute inset-0 bg-blue-500/0 group-hover:bg-blue-500/5 transition-colors duration-700">
                            </div>

                            @if ($product->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-contain relative z-20 group-hover:scale-110 group-hover:rotate-2 transition-all duration-700 drop-shadow-[0_20px_30px_rgba(0,0,0,0.8)]">
                            @else
                                <div class="text-gray-700 font-mono text-xs tracking-tighter opacity-50">IMAGE_NOT_FOUND
                                </div>
                            @endif

                            <!-- Float Badge -->
                            <div class="absolute top-4 left-4 z-30">
                                <span
                                    class="px-4 py-1.5 text-[10px] uppercase tracking-widest font-black text-white bg-black/40 backdrop-blur-xl border border-white/10 rounded-lg">
                                    {{ $product->category->name ?? 'Premium' }}
                                </span>
                            </div>
                        </div>

                        <!-- Info Teks -->
                        <div class="flex-1 flex flex-col">
                            <h3
                                class="text-xl font-bold text-white mb-3 line-clamp-1 group-hover:text-blue-400 transition-colors duration-300">
                                {{ $product->name }}
                            </h3>
                            <p
                                class="text-gray-500 text-sm leading-relaxed line-clamp-2 mb-8 group-hover:text-gray-400 transition-colors">
                                {{ $product->description }}
                            </p>

                            <div class="mt-auto pt-6 border-t border-white/5 flex items-center justify-between">
                                <div>
                                    <span
                                        class="block text-[10px] text-gray-500 uppercase tracking-widest font-bold mb-1">Mulai
                                        Dari</span>
                                    <p class="text-2xl font-black text-white tracking-tight">
                                        <span
                                            class="text-sm font-normal text-gray-400 mr-1">Rp</span>{{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                </div>

                                <div
                                    class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-white group-hover:bg-blue-600 group-hover:shadow-[0_0_20px_rgba(37,99,235,0.4)] transition-all duration-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <!-- State jika produk kosong tetap menggunakan gaya yang konsisten -->
                    <div
                        class="col-span-full py-40 flex flex-col items-center justify-center border-2 border-dashed border-white/5 rounded-[3rem] bg-white/1">
                        <div class="w-24 h-24 rounded-full bg-white/5 flex items-center justify-center mb-8 animate-pulse">
                            <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Belum Ada Koleksi</h3>
                        <p class="text-gray-500">Perangkat unggulan akan segera hadir untukmu.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- 5. VALUE PROPOSITION (Trust Signals) -->
    <div class="w-full bg-[#050505] py-32 border-y border-white/5 relative overflow-hidden">
        <!-- Ambient Background Light -->
        <div
            class="absolute -bottom-24 left-1/2 -translate-x-1/2 w-full max-w-4xl h-64 bg-blue-500/5 blur-[120px] rounded-full">
        </div>

        <div class="w-full px-6 md:px-12 lg:px-24 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                <!-- Item 1: Garansi -->
                <div
                    class="group p-8 rounded-4xl bg-transparent hover:bg-white/2 border border-transparent hover:border-white/5 transition-all duration-500">
                    <div
                        class="w-14 h-14 rounded-2xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-500">
                        <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3">Garansi Resmi</h4>
                    <p class="text-gray-500 text-sm leading-relaxed group-hover:text-gray-400 transition-colors">
                        Semua perangkat dilindungi oleh perlindungan pabrik langsung. <span
                            class="text-blue-400/80 font-medium italic">100% Original.</span>
                    </p>
                </div>

                <!-- Item 2: Pengiriman -->
                <div
                    class="group p-8 rounded-4xl bg-transparent hover:bg-white/2 border border-transparent hover:border-white/5 transition-all duration-500">
                    <div
                        class="w-14 h-14 rounded-2xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-500">
                        <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3">Extra Safe Shipping</h4>
                    <p class="text-gray-500 text-sm leading-relaxed group-hover:text-gray-400 transition-colors">
                        Proteksi maksimal dengan bubble wrap ganda dan peti kayu untuk pengiriman jarak jauh.
                    </p>
                </div>

                <!-- Item 3: Support -->
                <div
                    class="group p-8 rounded-4xl bg-transparent hover:bg-white/2 border border-transparent hover:border-white/5 transition-all duration-500">
                    <div
                        class="w-14 h-14 rounded-2xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-500">
                        <svg class="w-7 h-7 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3">Dukungan Teknis</h4>
                    <p class="text-gray-500 text-sm leading-relaxed group-hover:text-gray-400 transition-colors">
                        Konsultasi gratis dengan tim IT ahli kami untuk kendala sistem maupun hardware.
                    </p>
                </div>

                <!-- Item 4: Retur -->
                <div
                    class="group p-8 rounded-4xl bg-transparent hover:bg-white/2 border border-transparent hover:border-white/5 transition-all duration-500">
                    <div
                        class="w-14 h-14 rounded-2xl bg-green-500/10 border border-green-500/20 flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-500">
                        <svg class="w-7 h-7 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3">7-Day Easy Return</h4>
                    <p class="text-gray-500 text-sm leading-relaxed group-hover:text-gray-400 transition-colors">
                        Jaminan retur unit jika ditemukan cacat pabrikan saat barang diterima.
                    </p>
                </div>

            </div>
        </div>
    </div>

    <!-- 6. MASSIVE BOTTOM BANNER (Full-width immersive CTA) -->
    <div class="w-full bg-[#09090b] py-32 relative overflow-hidden">
        <!-- Ambient Lighting Layers -->
        <div
            class="absolute -top-24 -left-24 w-150 h-150 bg-blue-600/10 blur-[150px] rounded-full pointer-events-none">
        </div>
        <div
            class="absolute -bottom-24 -right-24 w-150 h-150 bg-purple-600/10 blur-[150px] rounded-full pointer-events-none">
        </div>

        <div class="w-full px-6 md:px-12 lg:px-24 relative z-10">

            <div
                class="w-full rounded-[4rem] overflow-hidden bg-[#0c0c0e] border border-white/5 p-12 md:p-24 lg:p-32 flex flex-col lg:flex-row items-center justify-between gap-20 group relative">

                <!-- Carbon Fiber Texture Overlay -->
                <div
                    class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-3 mix-blend-overlay pointer-events-none">
                </div>

                <!-- Animated Background Grid -->
                <div
                    class="absolute inset-0 bg-[linear-linear(to_right,#80808012_1px,transparent_1px),linear-linear(to_bottom,#80808012_1px,transparent_1px)] bg-size-[40px_40px] mask-[radial-linear(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)]">
                </div>

                <div class="relative z-10 max-w-4xl text-center lg:text-left">
                    <!-- Status Badge -->
                    <div
                        class="inline-flex items-center gap-3 px-5 py-2 rounded-full bg-blue-500/10 border border-blue-500/20 mb-10 transition-transform duration-500 group-hover:-translate-y-1">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                        </span>
                        <span class="text-[10px] font-black tracking-[0.2em] text-blue-400 uppercase">Priority
                            Membership</span>
                    </div>

                    <h2 class="text-5xl md:text-8xl font-black text-white mb-10 leading-[0.9] tracking-tighter">
                        Leveling up <br>
                        <span
                            class="bg-linear-to-r from-gray-400 via-gray-100 to-gray-500 bg-clip-text text-transparent">starts
                            here.</span>
                    </h2>

                    <p class="text-gray-500 text-lg md:text-2xl mb-14 font-medium leading-relaxed max-w-2xl">
                        Jadilah yang pertama merasakan performa generasi terbaru. Dapatkan akses ke rilis terbatas dan
                        penawaran hardware khusus member.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center gap-6">
                        @guest
                            <a href="{{ route('register') }}"
                                class="w-full sm:w-auto inline-flex justify-center items-center px-14 py-6 text-lg font-black text-black bg-white rounded-2xl hover:bg-blue-400 transition-all duration-500 hover:scale-105 shadow-[0_20px_40px_rgba(255,255,255,0.1)] group/btn">
                                Inisialisasi Akun
                                <svg class="ml-3 w-6 h-6 group-hover/btn:translate-x-2 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        @else
                            <a href="{{ url('/katalog') }}"
                                class="w-full sm:w-auto inline-flex justify-center items-center px-14 py-6 text-lg font-black text-black bg-white rounded-2xl hover:bg-blue-400 transition-all duration-500 hover:scale-105 shadow-[0_20px_40px_rgba(255,255,255,0.1)] group/btn">
                                Buka Katalog Penuh
                            </a>
                        @endguest
                    </div>
                </div>

                <!-- Visual Component: The "Tech Core" -->
                <div class="relative z-10 w-full lg:w-1/3 aspect-square flex items-center justify-center">
                    <!-- Rotating Ring Decor -->
                    <div class="absolute inset-0 rounded-full border border-white/5 animate-[spin_20s_linear_infinite]">
                    </div>
                    <div
                        class="absolute inset-10 rounded-full border border-blue-500/20 animate-[spin_15s_linear_infinite_reverse]">
                    </div>

                    <!-- The Main Orb -->
                    <div
                        class="relative w-64 h-64 md:w-80 md:h-80 group-hover:scale-110 transition-transform duration-[2s]">
                        <!-- Glow Layer -->
                        <div class="absolute inset-0 bg-blue-600/30 blur-[60px] rounded-full animate-pulse"></div>

                        <!-- Glass Structure -->
                        <div
                            class="w-full h-full rounded-[3rem] bg-linear-to-br from-white/10 to-white/2 backdrop-blur-3xl border border-white/20 shadow-2xl relative overflow-hidden flex items-center justify-center transform rotate-12 group-hover:rotate-0 transition-transform duration-[1.5s]">

                            <!-- Simbol Abstract (Ganti dengan Logo kamu jika ada) -->
                            <div class="relative">
                                <svg class="w-32 h-32 text-white/80 group-hover:scale-125 transition-transform duration-1000"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                <!-- Inner Glow -->
                                <div
                                    class="absolute inset-0 bg-blue-400/50 blur-3xl opacity-0 group-hover:opacity-100 transition-opacity">
                                </div>
                            </div>

                            <!-- Scanline Effect -->
                            <div
                                class="absolute inset-0 bg-linear-to-b from-transparent via-white/5 to-transparent h-1/2 w-full -translate-y-full group-hover:translate-y-[200%] transition-transform duration-[3s] ease-in-out">
                            </div>
                        </div>
                    </div>

                    <!-- Floating Labels -->
                    <div
                        class="absolute top-10 right-0 bg-white/5 backdrop-blur-md border border-white/10 p-4 rounded-2xl hidden md:block animate-bounce [animation-duration:4s]">
                        <p class="text-[10px] text-gray-500 uppercase font-black">Performance</p>
                        <p class="text-white font-bold">100% Stable</p>
                    </div>
                    <div
                        class="absolute bottom-10 left-0 bg-white/5 backdrop-blur-md border border-white/10 p-4 rounded-2xl hidden md:block animate-bounce [animation-duration:5s]">
                        <p class="text-[10px] text-gray-500 uppercase font-black">Latency</p>
                        <p class="text-white font-bold">0.02ms</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
