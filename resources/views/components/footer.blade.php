<footer class="bg-[#09090b] border-t border-white/5 pt-24 pb-12 relative overflow-hidden">
    <!-- Background Glow -->
    <div
        class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full max-w-5xl h-32 bg-blue-600/5 blur-[100px] rounded-full pointer-events-none">
    </div>

    <div class="w-full px-6 md:px-12 lg:px-24 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 mb-20">

            <!-- Column 1: Brand & Bio -->
            <div class="space-y-6">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-[0_0_20px_rgba(37,99,235,0.3)]">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <span class="text-2xl font-black text-white tracking-tighter">Laptop<span
                            class="text-blue-500">Store.</span></span>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Penyedia perangkat komputasi performa tinggi untuk kebutuhan profesional, kreatif, dan gaming.
                    Berbasis di Cirebon, melayani dengan presisi.
                </p>
            </div>

            <!-- Column 2: Navigation -->
            <div>
                <h4 class="text-white font-bold mb-8 tracking-widest uppercase text-[10px]">Navigasi</h4>
                <ul class="space-y-4">
                    <li><a href="{{ url('/') }}"
                            class="text-gray-500 hover:text-blue-400 text-sm transition-colors flex items-center gap-2 group">
                            <span class="w-0 group-hover:w-2 h-px bg-blue-400 transition-all"></span> Home
                        </a></li>
                    <li><a href="{{ url('/katalog') }}"
                            class="text-gray-500 hover:text-blue-400 text-sm transition-colors flex items-center gap-2 group">
                            <span class="w-0 group-hover:w-2 h-px bg-blue-400 transition-all"></span> Shop
                        </a></li>
                    <li><a href="{{ url('/tentang-kami') }}"
                            class="text-gray-500 hover:text-blue-400 text-sm transition-colors flex items-center gap-2 group">
                            <span class="w-0 group-hover:w-2 h-px bg-blue-400 transition-all"></span> About
                        </a></li>
                    <li><a href="{{ url('/kontak') }}"
                            class="text-gray-500 hover:text-blue-400 text-sm transition-colors flex items-center gap-2 group">
                            <span class="w-0 group-hover:w-2 h-px bg-blue-400 transition-all"></span> Contact
                        </a></li>
                </ul>
            </div>

            <!-- Column 3: Categories (Menyesuaikan Toko) -->
            <div>
                <h4 class="text-white font-bold mb-8 tracking-widest uppercase text-[10px]">Kategori</h4>
                <ul class="space-y-4">
                    <li><div class="text-gray-500 hover:text-blue-400 text-sm transition-colors">Gaming</div>
                    </li>
                    <li><div class="text-gray-500 hover:text-blue-400 text-sm transition-colors">Bisnis &
                            Profesional</div></li>
                    <li><div class="text-gray-500 hover:text-blue-400 text-sm transition-colors">Premium &
                            Ultrabook</div></li>
                    <li><div class="text-gray-500 hover:text-blue-400 text-sm transition-colors">Pelajar &
                            Entry Level</div></li>
                </ul>
            </div>

            <!-- Column 4: Contact/Store -->
            <div>
                <h4 class="text-white font-bold mb-8 tracking-widest uppercase text-[10px]">Lokasi & Kontak</h4>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            Jl. Watubelah No. 40, SMKN 1 Cirebon, Sumber, Jawa Barat.
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        <p class="text-gray-500 text-sm">support@laptopstore.com</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Bottom Copyright -->
        <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-xs text-gray-600 font-medium tracking-wide">
                &copy; {{ date('Y') }} LaptopStore. Project by <span class="text-gray-400">erwinrommel</span>. All
                rights reserved.
            </p>
            <div class="flex gap-8">
                <a href="#"
                    class="text-[10px] uppercase tracking-widest text-gray-600 hover:text-white transition-colors">Privacy
                    Policy</a>
                <a href="#"
                    class="text-[10px] uppercase tracking-widest text-gray-600 hover:text-white transition-colors">Terms
                    of Service</a>
            </div>
        </div>
    </div>
</footer>
