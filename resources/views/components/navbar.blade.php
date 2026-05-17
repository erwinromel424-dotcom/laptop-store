<nav x-data="{ open: false, profileOpen: false }"
    class="fixed top-0 inset-x-0 z-50 bg-[#09090b]/80 backdrop-blur-md border-b border-white/5 transition-all duration-300">
    <!-- Menggunakan w-full dan padding responsif, membuang max-w-7xl -->
    <div class="w-full px-6 md:px-10 lg:px-12">
        <div class="flex items-center justify-between h-20">

            <!-- Bagian Kiri: Logo -->
            <div class="flex-1 flex justify-start">
                <a href="/" class="text-2xl font-extrabold tracking-tight text-white flex items-center gap-2 group">
                    <div
                        class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center group-hover:scale-105 transition-transform shadow-[0_0_15px_rgba(37,99,235,0.5)]">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    Laptop<span class="text-blue-500">Store</span>
                </a>
            </div>

            <!-- Bagian Tengah: Menu Utama + Search & Cart -->
            <div class="hidden lg:flex flex-row items-center gap-8">
                <!-- Link Navigasi -->
                <a href="/"
                    class="text-sm font-medium text-gray-300 hover:text-white transition-colors">Home</a>
                <a href="/katalog" class="text-sm font-medium text-gray-300 hover:text-white transition-colors">Shop</a>
                <a href="/tentang-kami"
                    class="text-sm font-medium text-gray-300 hover:text-white transition-colors">About</a>
                <a href="/kontak" class="text-sm font-medium text-gray-300 hover:text-white transition-colors">Contact</a>

                <!-- Garis Pemisah Visual -->
                <div class="w-px h-5 bg-white/10"></div>

                <!-- Ikon Search & Cart -->
                <div class="flex items-center gap-5">
                    <!-- Tombol Search (Nanti bisa trigger modal pencarian) -->
                    <button type="button" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>

                    <!-- Tombol Cart -->
                    <a href="{{ auth()->check() ? '/keranjang' : route('login') }}"
                        class="relative text-gray-400 hover:text-white transition-colors group">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        @auth
                            <span
                                class="absolute -top-1.5 -right-2.5 w-4 h-4 bg-blue-600 text-white text-[10px] font-bold rounded-full flex items-center justify-center border border-[#09090b]">0</span>
                        @endauth
                    </a>
                </div>
            </div>

            <!-- Bagian Kanan: Auth -->
            <div class="flex-1 flex justify-end items-center">
                <div class="hidden lg:flex items-center gap-4">
                    @auth
                        <!-- Jika Admin -->
                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="px-4 py-2 text-sm font-bold text-blue-400 bg-blue-500/10 border border-blue-500/20 rounded-full hover:bg-blue-500 hover:text-white transition-all mr-2">
                                Panel Admin
                            </a>
                        @endif

                        <!-- Dropdown Profil User -->
                        <div class="relative" @click.away="profileOpen = false">
                            <button @click="profileOpen = !profileOpen"
                                class="flex items-center gap-2 text-sm font-medium text-gray-300 hover:text-white transition-colors focus:outline-none">
                                <div
                                    class="w-8 h-8 rounded-full bg-white/10 border border-white/20 flex items-center justify-center font-bold text-xs">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span>{{ explode(' ', auth()->user()->name)[0] }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <!-- Menu Dropdown -->
                            <div x-show="profileOpen" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-2"
                                class="absolute right-0 mt-4 w-48 bg-[#121214] border border-white/10 rounded-xl shadow-2xl py-2"
                                style="display: none;">

                                <div class="px-4 py-2 border-b border-white/5 mb-1">
                                    <p class="text-xs text-gray-500">Masuk sebagai</p>
                                    <p class="text-sm font-bold text-white truncate">{{ auth()->user()->email }}</p>
                                </div>

                                <a href="/pesanan"
                                    class="flex items-center gap-2 px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    Pesanan Saya
                                </a>
                                <a href="{{ route('profile.edit') }}"
                                    class="flex items-center gap-2 px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Pengaturan Akun
                                </a>

                                <form method="POST" action="{{ route('logout') }}"
                                    class="border-t border-white/5 mt-1 pt-1">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-colors text-left">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                            </path>
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm font-medium text-gray-300 hover:text-white transition-colors">Masuk</a>
                        <a href="{{ route('register') }}"
                            class="px-5 py-2.5 text-sm font-bold text-[#09090b] bg-white rounded-full hover:bg-gray-200 hover:scale-105 transition-all shadow-[0_0_15px_rgba(255,255,255,0.2)]">Daftar</a>
                    @endauth
                </div>

                <!-- Mobile Menu Hamburger -->
                <div class="flex items-center lg:hidden">
                    <button @click="open = !open" class="text-gray-400 hover:text-white focus:outline-none">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Dropdown -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="lg:hidden bg-[#09090b] border-b border-white/5 absolute w-full" style="display: none;">
        <div class="pt-2 pb-6 space-y-1 px-6">
            <!-- Mobile Links -->
            <a href="/"
                class="block px-3 py-3 rounded-lg text-base font-medium text-gray-300 hover:text-white hover:bg-white/5">Home</a>
            <a href="/katalog"
                class="block px-3 py-3 rounded-lg text-base font-medium text-gray-300 hover:text-white hover:bg-white/5">Semua
                Laptop</a>
            <a href="/tentang-kami"
                class="block px-3 py-3 rounded-lg text-base font-medium text-gray-300 hover:text-white hover:bg-white/5">Tentang
                Toko</a>
            <a href="/kontak"
                class="block px-3 py-3 rounded-lg text-base font-medium text-gray-300 hover:text-white hover:bg-white/5">Kontak
                & Lokasi</a>

            <div class="flex items-center gap-4 px-3 py-3 mt-2 border-t border-white/10">
                <button type="button" class="text-gray-400 hover:text-white flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Pencarian
                </button>
                <div class="w-px h-5 bg-white/10"></div>
                <a href="{{ auth()->check() ? '/keranjang' : route('login') }}"
                    class="text-gray-400 hover:text-white flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Keranjang
                </a>
            </div>

            @auth
                <div class="border-t border-white/10 mt-4 pt-4">
                    <div class="px-3 mb-4 flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-white/10 border border-white/20 flex items-center justify-center font-bold text-white">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-white font-bold">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                            class="block px-3 py-2 text-blue-400 font-bold mb-2">Panel Admin</a>
                    @endif
                    <a href="/pesanan" class="block px-3 py-2 text-gray-300 hover:text-white">Pesanan Saya</a>
                    <a href="{{ route('profile.edit') }}"
                        class="block px-3 py-2 text-gray-300 hover:text-white">Pengaturan Akun</a>

                    <form method="POST" action="{{ route('logout') }}" class="mt-2 border-t border-white/5 pt-2">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-3 py-2 text-red-400 font-bold flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Keluar Akun
                        </button>
                    </form>
                </div>
            @else
                <div class="border-t border-white/10 mt-4 pt-4 space-y-3">
                    <a href="{{ route('login') }}"
                        class="block w-full text-center px-3 py-3 rounded-lg text-base font-medium text-gray-300 border border-white/10 hover:bg-white/5 transition-colors">Masuk
                        Akun</a>
                    <a href="{{ route('register') }}"
                        class="block w-full text-center px-3 py-3 rounded-lg text-base font-bold text-[#09090b] bg-white transition-colors">Daftar
                        Sekarang</a>
                </div>
            @endguest
        </div>
    </div>
</nav>
