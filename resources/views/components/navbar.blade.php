<nav x-data="{ open: false }"
    class="fixed top-0 inset-x-0 z-50 bg-[#09090b]/80 backdrop-blur-md border-b border-white/5 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="text-2xl font-extrabold tracking-tight text-white flex items-center gap-2">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    Laptop<span class="text-blue-500">Store</span>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden sm:flex sm:items-center sm:space-x-8">
                <a href="#katalog"
                    class="text-sm font-medium text-gray-300 hover:text-white transition-colors">Katalog</a>
                <a href="#about" class="text-sm font-medium text-gray-300 hover:text-white transition-colors">Tentang
                    Kami</a>
                <a href="#contact"
                    class="text-sm font-medium text-gray-300 hover:text-white transition-colors">Lokasi</a>

                @auth
                    <a href="#"
                        class="text-sm font-medium text-gray-300 hover:text-white transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Keranjang
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="text-sm font-medium text-red-400 hover:text-red-300 transition-colors">Logout</button>
                    </form>
                @else
                    <div class="flex items-center space-x-4 pl-4 border-l border-white/10">
                        <a href="{{ route('login') }}"
                            class="text-sm font-medium text-gray-300 hover:text-white transition-colors">Login</a>
                        <a href="{{ route('register') }}"
                            class="px-5 py-2.5 text-sm font-bold text-[#09090b] bg-white rounded-full hover:bg-gray-200 transition-all shadow-[0_0_15px_rgba(255,255,255,0.3)]">Daftar</a>
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex items-center sm:hidden">
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

    <!-- Mobile Menu Dropdown -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="sm:hidden bg-[#09090b] border-b border-white/5 absolute w-full" style="display: none;">
        <div class="pt-2 pb-4 space-y-1 px-4">
            <a href="#katalog"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-white/5">Katalog</a>
            <a href="#about"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-white/5">Tentang
                Kami</a>

            @guest
                <div class="border-t border-white/10 mt-4 pt-4">
                    <a href="{{ route('login') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-white/5">Login</a>
                    <a href="{{ route('register') }}"
                        class="mt-2 block px-3 py-2 rounded-md text-base font-bold text-[#09090b] bg-white text-center">Daftar
                        Akun</a>
                </div>
            @endguest
        </div>
    </div>
</nav>
