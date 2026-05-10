@extends('layouts.app')

@section('title', 'Katalog Laptop Premium')

@section('content')
    <!-- Hero Section: Cinematic & Modern Dark -->
    <div class="relative bg-[#09090b] min-h-[90vh] flex items-center overflow-hidden">
        <!-- Efek Glow Latar Belakang -->
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-200 h-100 bg-blue-600/20 blur-[120px] rounded-full pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                <!-- Teks Hero -->
                <div class="text-left">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/5 border border-white/10 backdrop-blur-md mb-6">
                        <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                        <span class="text-sm font-medium text-gray-300">Generasi Baru Telah Tiba</span>
                    </div>

                    <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight leading-[1.1]">
                        Kekuatan <br>
                        <span class="text-transparent bg-clip-text bg-linear-to-r from-blue-400 to-cyan-300">
                            Tanpa Batas.
                        </span>
                    </h1>

                    <p class="mt-6 text-lg text-gray-400 max-w-lg leading-relaxed">
                        Desain elegan berpadu dengan performa buas. Temukan mesin utama untuk setiap baris kodemu, karya
                        desainmu, hingga arena bermainmu.
                    </p>

                    <div class="mt-10 flex flex-col sm:flex-row gap-4">
                        <a href="#katalog"
                            class="inline-flex justify-center items-center px-8 py-4 text-sm font-bold text-[#09090b] bg-white rounded-full hover:bg-gray-200 hover:scale-105 transition-all duration-300">
                            Eksplorasi Katalog
                        </a>
                        @guest
                            <a href="{{ route('register') }}"
                                class="inline-flex justify-center items-center px-8 py-4 text-sm font-bold text-white bg-white/5 border border-white/10 rounded-full backdrop-blur-md hover:bg-white/10 transition-all duration-300">
                                Daftar Akun
                            </a>
                        @endguest
                    </div>
                </div>

                <!-- Visual Hero (Placeholder Elegan) -->
                <div class="relative hidden lg:block">
                    <div
                        class="w-full aspect-4/3 bg-linear-to-tr from-gray-800/40 to-gray-900/40 border border-white/10 rounded-3xl backdrop-blur-xl flex items-center justify-center shadow-2xl overflow-hidden group">
                        <!-- Kamu bisa menaruh file .png laptop transparan di sini nantinya -->
                        <div
                            class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10">
                        </div>
                        <div
                            class="text-gray-500 font-light tracking-widest text-sm group-hover:scale-110 transition-transform duration-700">
                            [ PRODUCT SHOWCASE ]
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Katalog Produk -->
    <div id="katalog" class="bg-[#09090b] py-24 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white tracking-tight">Koleksi <span
                            class="text-gray-500">Pilihan.</span></h2>
                    <p class="mt-2 text-gray-400">Dirakit untuk performa, didesain untuk estetika.</p>
                </div>
            </div>

            <!-- Grid Produk (Minimalis & Glassmorphism) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    <div
                        class="group relative bg-[#121214] border border-white/5 hover:border-white/20 rounded-2xl p-5 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_20px_40px_-15px_rgba(0,0,0,0.5)] flex flex-col">

                        <!-- Area Gambar -->
                        <div
                            class="w-full h-52 bg-[#09090b] rounded-xl overflow-hidden mb-6 relative p-4 flex items-center justify-center">
                            @if ($product->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-700">
                            @else
                                <span class="text-gray-700 text-xs tracking-widest">NO IMAGE</span>
                            @endif

                            <!-- Kategori Tag -->
                            <div class="absolute top-3 left-3">
                                <span
                                    class="px-3 py-1 text-[10px] uppercase tracking-widest font-bold text-white bg-white/10 backdrop-blur-md rounded-full border border-white/10">
                                    {{ $product->category->name ?? 'Laptop' }}
                                </span>
                            </div>
                        </div>

                        <!-- Info Text -->
                        <div class="flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-white leading-tight">
                                    {{ $product->name }}
                                </h3>
                                <p class="mt-2 text-sm text-gray-500 line-clamp-2">
                                    {{ $product->description }}
                                </p>
                            </div>

                            <div class="mt-6 pt-6 border-t border-white/5 flex items-center justify-between">
                                <div class="flex flex-col">
                                    <span
                                        class="text-[10px] uppercase tracking-widest text-gray-500 font-bold mb-1">Harga</span>
                                    <span class="text-lg font-bold text-white">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </div>

                                @auth
                                    <button type="button"
                                        class="w-10 h-10 rounded-full bg-white text-black flex items-center justify-center hover:scale-110 hover:bg-blue-500 hover:text-white transition-all duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </button>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="text-xs font-bold text-gray-400 hover:text-white transition-colors border-b border-transparent hover:border-white pb-1">
                                        Login Beli
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full py-20 flex flex-col items-center justify-center border border-dashed border-white/10 rounded-3xl">
                        <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <span class="text-gray-400 font-medium tracking-wide">Katalog masih kosong</span>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Section: Tentang Kami (Bento Grid Style) -->
    <div id="about" class="bg-[#09090b] py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <span class="text-blue-500 font-bold tracking-widest text-sm uppercase mb-2 block">Tentang Kami</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight leading-tight">
                    Lebih dari sekadar <br> <span class="text-gray-500">toko perangkat keras.</span>
                </h2>
            </div>

            <!-- Bento Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1: Visi (Lebar 2 kolom di desktop) -->
                <div
                    class="md:col-span-2 bg-linear-to-br from-[#121214] to-[#0a0a0c] border border-white/5 rounded-3xl p-8 lg:p-12 relative overflow-hidden group">
                    <div
                        class="absolute top-0 right-0 w-64 h-64 bg-blue-600/10 rounded-full blur-[80px] group-hover:bg-blue-600/20 transition-all duration-700">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="w-12 h-12 bg-white/5 rounded-xl flex items-center justify-center mb-6 border border-white/10">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Dedikasi pada Performa</h3>
                        <p class="text-gray-400 leading-relaxed text-lg max-w-xl">
                            Kami memahami bahwa laptop bukan sekadar alat, melainkan investasi untuk karya, karir, dan masa
                            depanmu. Oleh karena itu, kami melakukan kurasi ketat untuk memastikan setiap unit yang kami
                            jual memiliki kualitas standar industri dengan garansi resmi yang terjamin.
                        </p>
                    </div>
                </div>

                <!-- Card 2: Keunggulan -->
                <div
                    class="bg-[#121214] border border-white/5 rounded-3xl p-8 flex flex-col justify-between hover:border-white/20 transition-colors">
                    <div>
                        <h3 class="text-xl font-bold text-white mb-2">100% Original</h3>
                        <p class="text-gray-500 text-sm">Semua produk dilengkapi dengan segel pabrik dan perlindungan
                            garansi resmi.</p>
                    </div>
                    <div class="mt-8 pt-6 border-t border-white/5">
                        <h3 class="text-xl font-bold text-white mb-2">Support Ahli</h3>
                        <p class="text-gray-500 text-sm">Tim teknisi kami siap membantu memilih spesifikasi yang paling
                            tepat untuk kebutuhanmu.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Kontak & Lokasi Toko -->
    <div id="contact" class="bg-[#09090b] py-20 pb-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-[#121214] border border-white/5 rounded-[2.5rem] p-2 sm:p-4 relative overflow-hidden">
                <!-- Inner Container -->
                <div
                    class="relative bg-[#0a0a0c] rounded-4xl p-8 md:p-16 border border-white/5 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center overflow-hidden">

                    <!-- Background Glow -->
                    <div class="absolute bottom-0 left-0 w-full h-1/2 bg-blue-900/10 blur-[100px] pointer-events-none">
                    </div>

                    <!-- Kiri: Info Kontak -->
                    <div class="relative z-10">
                        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Kunjungi <span
                                class="text-transparent bg-clip-text bg-linear-to-r from-blue-400 to-cyan-300">Basecamp
                                Kami.</span></h2>
                        <p class="text-gray-400 mb-10 text-lg">Konsultasikan kebutuhanmu secara langsung, lihat fisik
                            produk, atau sekadar mampir untuk mengambil pesananmu.</p>

                        <div class="space-y-8">
                            <!-- Item Kontak 1: Alamat -->
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center shrink-0 border border-white/10">
                                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-white font-bold text-lg">Alamat Toko</h4>
                                    <p class="text-gray-400 mt-1 leading-relaxed">
                                        Jl. Perjuangan, Karyamulya,<br>
                                        Kec. Kesambi, Kota Cirebon,<br>
                                        Jawa Barat 45131
                                    </p>
                                </div>
                            </div>

                            <!-- Item Kontak 2: Jam Operasional -->
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center shrink-0 border border-white/10">
                                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-white font-bold text-lg">Jam Operasional</h4>
                                    <p class="text-gray-400 mt-1">Senin - Sabtu: 09.00 - 20.00 WIB<br>Minggu: Libur</p>
                                </div>
                            </div>

                            <!-- Item Kontak 3: Email/Telepon -->
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center shrink-0 border border-white/10">
                                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-white font-bold text-lg">Kontak Digital</h4>
                                    <p class="text-gray-400 mt-1">halo@laptopstore.com<br>+62 812-3456-7890</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kanan: Visual Map Placeholder (Sangat Modern) -->
                    <div
                        class="relative w-full h-100 bg-[#121214] rounded-3xl border border-white/10 overflow-hidden group">
                        <!-- Pola Grid Halus sebagai pengganti peta kasar -->
                        <div
                            class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10">
                        </div>
                        <div class="absolute inset-0 bg-linear-to-t from-[#0a0a0c] via-transparent to-transparent z-10">
                        </div>

                        <!-- Titik Lokasi Animasi -->
                        <div
                            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20 flex flex-col items-center">
                            <div class="relative flex h-8 w-8 mb-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                <span
                                    class="relative inline-flex rounded-full h-8 w-8 bg-blue-500 border-2 border-[#0a0a0c]"></span>
                            </div>
                            <div class="bg-white/10 backdrop-blur-md px-4 py-2 rounded-full border border-white/10">
                                <span class="text-white text-xs font-bold tracking-widest uppercase">Basecamp Kita</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
