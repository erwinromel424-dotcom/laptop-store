@extends('layouts.app')

@section('content')
    <div class="relative w-full min-h-screen bg-[#09090b] flex items-center justify-center overflow-hidden pt-20">

        <!-- BACKGROUND: Grid & Light Effect -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_-20%,#3b82f615,transparent)]"></div>
            <div
                class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff05_1px,transparent_1px),linear-gradient(to_bottom,#ffffff05_1px,transparent_1px)] bg-size-[40px_40px]">
            </div>
        </div>

        <!-- Efek Cahaya Artistik -->
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-150 h-150 bg-blue-600/10 blur-[120px] rounded-full pointer-events-none">
        </div>

        <div class="relative z-10 w-full px-6 md:px-12 lg:px-24 py-12 max-w-full">

            <!-- Header Section -->
            <div class="mb-16 text-center md:text-left">
                <h1 class="text-5xl md:text-6xl font-black text-white tracking-tighter mb-4">
                    Layanan <span
                        class="text-transparent bg-clip-text bg-linear-to-r from-blue-500 to-indigo-400">Eksklusif.</span>
                </h1>
                <p class="text-gray-500 text-lg max-w-xl">
                    Lebih dari sekadar toko. Kami menyediakan ekosistem pendukung untuk kebutuhan teknis Anda.
                </p>
            </div>

            <div class="grid lg:grid-cols-5 gap-12 items-start">

                <!-- KOLOM KIRI: Service Cards (Ganti Form) -->
                <div class="lg:col-span-3 grid md:grid-cols-2 gap-6">

                    <!-- Card 1: Konsultasi -->
                    <div
                        class="group bg-white/3 border border-white/10 backdrop-blur-xl rounded-[2.5rem] p-8 hover:bg-white/5 transition-all duration-500 hover:-translate-y-2">
                        <div
                            class="w-14 h-14 bg-blue-500/20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.663 17h4.674a1 1 0 00.951-.688l1.396-4.707A1 1 0 0015.733 10H8.267a1 1 0 00-.951.605l-1.396 4.708A1 1 0 006.873 17h2.79zM12 2v2m0 16v2m10-10h-2M4 10H2m16.07-5.07l-1.414 1.414M7.414 16.586L6 18m12.07 1.414l-1.414-1.414M7.414 7.414L6 6" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Konsultasi Spek</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Bantu sesuaikan perangkat dengan workflow desain,
                            coding, atau gaming Anda.</p>
                    </div>

                    <!-- Card 2: After Sales -->
                    <div
                        class="group bg-white/3 border border-white/10 backdrop-blur-xl rounded-[2.5rem] p-8 hover:bg-white/5 transition-all duration-500 hover:-translate-y-2">
                        <div
                            class="w-14 h-14 bg-indigo-500/20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Garansi Prioritas</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Layanan purna jual tanpa ribet dengan penanganan
                            langsung oleh teknisi ahli.</p>
                    </div>

                    <!-- Card 3: Custom Setup -->
                    <div
                        class="group bg-white/3 border border-white/10 backdrop-blur-xl rounded-[2.5rem] p-8 hover:bg-white/5 transition-all duration-500 hover:-translate-y-2">
                        <div
                            class="w-14 h-14 bg-cyan-500/20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 4a2 2 0 114 0v1a2 2 0 01-2 2 2 2 0 01-2-2V4zm-6 8a2 2 0 114 0v1a2 2 0 01-2 2 2 2 0 01-2-2v-1zm12 0a2 2 0 114 0v1a2 2 0 01-2 2 2 2 0 01-2-2v-1z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Custom Build</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Rakit workstation impian dengan manajemen kabel
                            yang rapi dan estetika tinggi.</p>
                    </div>

                    <!-- Card 4: Community -->
                    <div
                        class="group bg-white/3 border border-white/10 backdrop-blur-xl rounded-[2.5rem] p-8 hover:bg-white/5 transition-all duration-500 hover:-translate-y-2">
                        <div
                            class="w-14 h-14 bg-purple-500/20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">User Community</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Bergabung dengan jaringan kreatif kami untuk update
                            teknologi terbaru.</p>
                    </div>

                </div>

                <!-- KOLOM KANAN: Info & Location (Tetap sama, 2/5) -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Person in Charge -->
                    <div
                        class="bg-linear-to-br from-blue-600/20 to-transparent border border-blue-500/20 rounded-4xl p-8">
                        <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-blue-400 mb-4">Store Manager</p>
                        <h3 class="text-2xl font-bold text-white mb-1">Erwin Rommel</h3>
                        <p class="text-gray-400 text-sm">Spesialis Sistem & Logistik</p>
                        <div class="mt-6 flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                                </svg>
                            </div>
                            <span class="text-gray-300 font-mono text-sm">erwin.rommel@yourstore.com</span>
                        </div>
                    </div>

                    <!-- Location Detail -->
                    <div class="bg-white/3 border border-white/10 rounded-4xl p-8">
                        <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-gray-500 mb-4">Lokasi Fisik</p>
                        <h4 class="text-lg font-bold text-white mb-2">Cirebon Hub</h4>
                        <p class="text-gray-400 text-sm leading-relaxed mb-6 italic">
                            Jl. Perjuangan No. 1, Sunyaragi, Kec. Kesambi, Kota Cirebon, Jawa Barat 45132 (Kawasan SMKN 1
                            Cirebon)
                        </p>

                        <a href="https://maps.google.com" target="_blank"
                            class="group flex items-center justify-between p-4 bg-black/40 border border-white/5 rounded-2xl hover:border-blue-500/50 transition-all">
                            <span class="text-xs font-bold text-gray-300">Buka di Google Maps</span>
                            <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-500 transition-colors" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
