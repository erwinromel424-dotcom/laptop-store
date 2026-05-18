<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard') | E-Market Laptop</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<!-- AlpineJS Data ditaruh di tag body -->

<body class="font-sans antialiased bg-[#050505] text-gray-300" x-data="{ isSidebarOpen: false }">

    <!-- Overlay Gelap untuk Mobile (Muncul jika sidebar dibuka di HP) -->
    <div x-show="isSidebarOpen" @click="isSidebarOpen = false"
        x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm md:hidden" style="display: none;"></div>

    <!-- Memanggil Komponen Sidebar -->
    <x-sidebar />

    <!-- Wrapper Konten Utama (Diberi margin kiri sebesar lebar sidebar di desktop) -->
    <div class="flex flex-col min-h-screen md:pl-64 transition-all duration-300">

        <!-- Ubah Header menjadi gelap: bg-[#09090b] border-white/5 -->
        <header
            class="h-20 bg-[#09090b] border-b border-white/5 flex items-center justify-between px-4 sm:px-6 lg:px-8 sticky top-0 z-30 backdrop-blur-md">

            <div class="flex items-center gap-4">
                <button @click="isSidebarOpen = true"
                    class="md:hidden p-2 text-gray-500 hover:text-white hover:bg-white/5 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <h1 class="text-xl font-bold tracking-tight text-white">
                    @yield('header', 'Dashboard')
                </h1>
            </div>

            <!-- Profil Admin: Sekarang bisa diklik -->
            <a href="{{ route('profile.edit') }}"
                class="group flex items-center gap-4 hover:bg-white/5 p-2 rounded-2xl transition-all duration-300">
                <div class="hidden sm:flex flex-col text-right transition-opacity group-hover:opacity-80">
                    <span
                        class="text-sm font-bold text-white leading-none mb-1">{{ Auth::user()->name ?? 'Administrator' }}</span>
                    <span class="text-[10px] text-blue-500 font-black uppercase tracking-widest">Admin Account</span>
                </div>

                <div class="relative">
                    <div
                        class="w-10 h-10 rounded-full bg-linear-to-tr from-blue-600 to-cyan-500 text-white flex items-center justify-center font-bold shadow-[0_0_15px_rgba(37,99,235,0.3)] group-hover:shadow-blue-500/50 group-hover:scale-105 transition-all duration-300 border border-white/10">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                    <!-- Status Indicator -->
                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-[#09090b] rounded-full">
                    </div>
                </div>
            </a>
        </header>
        <!-- Area Konten Utama Halaman Admin -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            @yield('content')
        </main>

    </div>

</body>

</html>
