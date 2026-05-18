@extends('layouts.app')

@section('content')
    <div class="relative w-full min-h-screen bg-[#09090b] flex items-center justify-center overflow-hidden">

        <!-- BACKGROUND IMAGE: Tech/Office Abstract dengan Opacity Rendah -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=2070&auto=format&fit=crop"
                class="w-full h-full object-cover opacity-[0.1] scale-105 transition-transform duration-[10s] animate-subtle-zoom"
                alt="About Background">

            <!-- Overlay Linear -->
            <div class="absolute inset-0 bg-linear-to-b from-[#09090b] via-[#09090b]/80 to-[#09090b]"></div>
        </div>

        <!-- Efek Cahaya Artistik -->
        <div
            class="absolute top-0 right-0 w-[50vw] h-[50vw] bg-indigo-600/10 blur-[150px] rounded-full pointer-events-none transform translate-x-1/2 -translate-y-1/2">
        </div>
        <div
            class="absolute bottom-0 left-0 w-[40vw] h-[40vw] bg-blue-500/5 blur-[120px] rounded-full pointer-events-none transform -translate-x-1/4 translate-y-1/4">
        </div>

        <!-- Grain Texture -->
        <div
            class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-2 mix-blend-overlay pointer-events-none z-1">
        </div>

        <div class="relative z-10 w-full px-6 md:px-12 lg:px-24 py-20 flex flex-col items-center">

            <!-- Badge -->
            <div
                class="inline-flex items-center gap-3 px-5 py-2 rounded-full bg-white/3 border border-white/10 backdrop-blur-2xl mb-12 shadow-2xl animate-fade-in">
                <span class="text-[10px] md:text-xs font-bold tracking-[0.3em] text-cyan-400 uppercase italic">Tentang
                    Kami</span>
            </div>

            <!-- Heading -->
            <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tighter mb-12 leading-tight text-center">
                Membangun Masa Depan <br>
                <span class="text-transparent bg-clip-text bg-linear-to-r from-blue-400 to-cyan-300">Satu Inovasi
                    Sekaligus.</span>
            </h1>

            <!-- Content Grid -->
            <div class="grid md:grid-cols-2 gap-12 items-center max-w-6xl w-full">
                <div class="space-y-6 text-gray-400 text-lg leading-relaxed antialiased">
                    <p>
                        Kami bukan sekadar penyedia perangkat. Kami adalah tim yang berdedikasi untuk menghadirkan teknologi
                        terbaik bagi mereka yang berani bermimpi lebih tinggi.
                    </p>
                    <p>
                        Berawal dari semangat di <span class="text-white font-medium">SMKN 1 Cirebon</span>, kami memahami
                        bahwa setiap baris kode dan setiap desain membutuhkan performa yang tanpa kompromi. Itulah mengapa
                        setiap produk dalam katalog kami dipilih dengan standar presisi yang tinggi.
                    </p>

                    <!-- Link Kembali ke Beranda -->
                    <div class="pt-6">
                        <a href="{{ url('/') }}"
                            class="inline-flex items-center gap-2 text-sm font-bold text-white hover:text-cyan-400 transition-colors group">
                            <svg class="w-4 h-4 rotate-180 group-hover:-translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>

                <!-- Stats Card / Decorative Element -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-8 rounded-3xl bg-white/5 border border-white/10 backdrop-blur-md">
                        <h3 class="text-3xl font-bold text-white mb-1">10+</h3>
                        <p class="text-xs text-gray-500 uppercase tracking-widest">Core Members</p>
                    </div>
                    <div class="p-8 rounded-3xl bg-white/5 border border-white/10 backdrop-blur-md translate-y-8">
                        <h3 class="text-3xl font-bold text-cyan-400 mb-1">24/7</h3>
                        <p class="text-xs text-gray-500 uppercase tracking-widest">Logic & Design</p>
                    </div>
                    <div class="p-8 rounded-3xl bg-white/5 border border-white/10 backdrop-blur-md">
                        <h3 class="text-3xl font-bold text-blue-500 mb-1">XI</h3>
                        <p class="text-xs text-gray-600 uppercase tracking-widest">RPL 1 Generation</p>
                    </div>
                    <div class="p-8 rounded-3xl bg-white/5 border border-white/10 backdrop-blur-md translate-y-8">
                        <h3 class="text-3xl font-bold text-white mb-1">Limitless</h3>
                        <p class="text-xs text-gray-500 uppercase tracking-widest">Creative Vision</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
