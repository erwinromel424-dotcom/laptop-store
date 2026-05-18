<nav x-data="{ open: false, profileOpen: false }"
    class="fixed top-0 inset-x-0 z-50 bg-[#09090b]/80 backdrop-blur-xl border-b border-white/5 transition-all duration-300">

    <div class="w-full px-6 md:px-10 lg:px-24">
        <div class="flex items-center justify-between h-20">

            <!-- Bagian Kiri: Logo -->
            <div class="flex-1 flex justify-start">
                <a href="/" class="text-2xl font-black tracking-tighter text-white flex items-center gap-3 group">
                    <div
                        class="w-9 h-9 bg-blue-600 rounded-xl flex items-center justify-center group-hover:rotate-6 transition-all duration-300 shadow-[0_0_20px_rgba(37,99,235,0.4)]">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <span>Laptop<span class="text-blue-500">Store</span></span>
                </a>
            </div>

            <!-- Bagian Tengah: Menu Utama -->
            <div class="hidden lg:flex flex-row items-center gap-10">
                <div class="flex items-center gap-8">
                    @php
                        $navItems = [
                            ['name' => 'Home', 'url' => '/'],
                            ['name' => 'Shop', 'url' => '/katalog'],
                            ['name' => 'About', 'url' => '/tentang-kami'],
                            ['name' => 'Contact', 'url' => '/kontak'],
                        ];
                    @endphp

                    @foreach ($navItems as $item)
                        <a href="{{ $item['url'] }}"
                            class="relative text-sm font-semibold tracking-wide {{ Request::is(trim($item['url'], '/')) || (Request::is('/') && $item['url'] == '/') ? 'text-white' : 'text-gray-400' }} hover:text-white transition-colors group">
                            {{ $item['name'] }}
                            <span
                                class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-500 transition-all duration-300 group-hover:w-full {{ Request::is(trim($item['url'], '/')) || (Request::is('/') && $item['url'] == '/') ? 'w-full' : '' }}"></span>
                        </a>
                    @endforeach
                </div>

                <div class="w-px h-6 bg-white/10 mx-2"></div>

                <!-- Ikon Search & Cart Dinamis -->
                <div class="flex items-center gap-6">

                    <a href="{{ auth()->check() ? '/keranjang' : route('login') }}"
                        class="relative text-gray-400 hover:text-blue-400 transition-all group">
                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>

                        @auth
                            @php
                                // Mengambil jumlah item unik atau total quantity dari cart milik user
                                $cartCount = \App\Models\CartItem::whereHas('cart', function ($query) {
                                    $query->where('user_id', auth()->id());
                                })->count();
                            @endphp

                            @if ($cartCount > 0)
                                <span
                                    class="absolute -top-1.5 -right-2 w-4 h-4 bg-blue-600 text-white text-[9px] font-black rounded-full flex items-center justify-center border-2 border-[#09090b] shadow-lg animate-bounce">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        @endauth
                    </a>
                </div>
            </div>

            <!-- Bagian Kanan: Auth -->
            <div class="flex-1 flex justify-end items-center">
                <div class="hidden lg:flex items-center gap-6">
                    @auth
                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-[11px] uppercase tracking-[0.2em] font-bold text-blue-400 px-4 py-2 bg-blue-500/5 border border-blue-500/20 rounded-lg hover:bg-blue-600 hover:text-white transition-all">
                                Admin Panel
                            </a>
                        @endif

                        <div class="relative" @click.away="profileOpen = false">
                            <button @click="profileOpen = !profileOpen"
                                class="flex items-center gap-3 p-1 pr-3 rounded-full bg-white/5 border border-white/5 hover:border-white/20 transition-all">
                                <div
                                    class="w-8 h-8 rounded-full bg-linear-to-tr from-blue-600 to-indigo-600 flex items-center justify-center font-bold text-xs text-white shadow-inner">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span
                                    class="text-sm font-semibold text-gray-300">{{ explode(' ', auth()->user()->name)[0] }}</span>
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <!-- Menu Dropdown -->
                            <div x-show="profileOpen" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                class="absolute right-0 mt-4 w-56 bg-[#121214] border border-white/10 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.5)] py-3 z-60"
                                style="display: none;">

                                <div class="px-5 py-3 border-b border-white/5 mb-2">
                                    <p class="text-[10px] uppercase tracking-widest text-gray-500 font-bold">Account</p>
                                    <p class="text-sm font-bold text-white truncate">{{ auth()->user()->email }}</p>
                                </div>

                                <a href="/pesanan"
                                    class="flex items-center gap-3 px-5 py-2.5 text-sm text-gray-400 hover:text-white hover:bg-white/5 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-width="2"></path>
                                    </svg>
                                    My Orders
                                </a>
                                <a href="{{ route('profile.edit') }}"
                                    class="flex items-center gap-3 px-5 py-2.5 text-sm text-gray-400 hover:text-white hover:bg-white/5 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M10.3 4.3c.4-1.7 2.9-1.7 3.3 0a1.7 1.7 0 002.6 1.1c1.5-.9 3.3.8 2.4 2.4a1.7 1.7 0 001.1 2.6c1.7.4 1.7 2.9 0 3.3a1.7 1.7 0 00-1.1 2.6c.9 1.5-.8 3.3-2.4 2.4a1.7 1.7 0 00-2.6 1.1c-.4 1.7-2.9 1.7-3.3 0a1.7 1.7 0 00-2.6-1.1c-1.5.9-3.3-.8-2.4-2.4a1.7 1.7 0 00-1.1-2.6c-1.7-.4-1.7-2.9 0-3.3a1.7 1.7 0 001.1-2.6c-.9-1.5.8-3.3 2.4-2.4.3.2 1 .2 1.3-.3z"
                                            stroke-width="2"></path>
                                    </svg>
                                    Settings
                                </a>

                                <form method="POST" action="{{ route('logout') }}"
                                    class="mt-2 pt-2 border-t border-white/5">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center gap-3 px-5 py-2.5 text-sm text-red-500 hover:bg-red-500/10 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                                stroke-width="2"></path>
                                        </svg>
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm font-semibold text-gray-400 hover:text-white transition-colors">Sign In</a>
                        <a href="{{ route('register') }}"
                            class="px-6 py-2.5 text-sm font-bold text-white bg-blue-600 rounded-xl hover:bg-blue-500 hover:scale-105 transition-all shadow-[0_10px_20px_rgba(37,99,235,0.3)]">
                            Get Started
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button @click="open = !open" class="lg:hidden text-gray-400 hover:text-white p-2">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'block': !open }" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'block': open, 'hidden': !open }" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Overlay (Opsional untuk kesan pro) -->
    <div x-show="open" class="lg:hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-[-1]" @click="open = false">
    </div>

    <!-- Mobile Menu Content -->
    <div x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-full" x-transition:enter-end="opacity-100 translate-y-0"
        class="lg:hidden bg-[#09090b] border-b border-white/5 overflow-hidden">
        <div class="px-6 py-8 space-y-4">
            @foreach ($navItems as $item)
                <a href="{{ $item['url'] }}"
                    class="block text-lg font-bold text-gray-400 hover:text-blue-500 transition-colors">{{ $item['name'] }}</a>
            @endforeach
            <hr class="border-white/5">
            <div class="flex gap-4 pt-2">
                @guest
                    <a href="{{ route('login') }}"
                        class="flex-1 text-center py-3 rounded-xl border border-white/10 text-gray-300 font-bold">Login</a>
                    <a href="{{ route('register') }}"
                        class="flex-1 text-center py-3 rounded-xl bg-blue-600 text-white font-bold shadow-lg">Register</a>
                @endguest
            </div>
        </div>
    </div>
</nav>
