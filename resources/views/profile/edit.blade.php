{{-- jika role admin panggil layouts.admin --}}
@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')
@section('title', 'Pengaturan Akun | LaptopStore')

@section('content')
    <div class="relative pt-32 pb-24 bg-[#09090b] min-h-screen w-full rounded-4xl overflow-hidden" x-data="{
        addAddressModal: false,
    
        // State untuk Hapus Alamat
        deleteAddressModal: false,
        deleteUrl: '',
    
        // State untuk Edit Alamat
        editAddressModal: false,
        editUrl: '',
        editData: {
            recipient_name: '',
            phone_number: '',
            city: '',
            postal_code: '',
            full_address: ''
        }
    }"
        @open-delete-address.window="deleteAddressModal = true; deleteUrl = $event.detail.url"
        @open-edit-address.window="
            editAddressModal = true; 
            editUrl = $event.detail.url; 
            editData = $event.detail.address;
        ">

        <!-- Ambient Glow Berdasarkan Role -->
        @if (auth()->user()->role === 'admin')
            <div
                class="absolute top-0 left-1/2 -translate-x-1/2 w-[50vw] h-[30vh] bg-red-900/10 blur-[150px] pointer-events-none">
            </div>
        @else
            <div
                class="absolute top-0 left-1/2 -translate-x-1/2 w-[50vw] h-[30vh] bg-blue-900/10 blur-[150px] pointer-events-none">
            </div>
        @endif

        <div class="w-full px-6 md:px-12 lg:px-24 relative z-10">

            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12 border-b border-white/5 pb-8">
                <div class="flex items-center gap-4">
                    <div
                        class="w-16 h-16 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-2xl font-bold text-white shadow-inner">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h1 class="text-3xl font-extrabold text-white tracking-tight">Pengaturan <span
                                class="text-gray-500">Akun.</span></h1>
                        <p class="text-sm text-gray-400 mt-1">Kelola informasi personal dan keamanan akun Anda.</p>
                    </div>
                </div>

                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-blue-600/10 text-blue-400 border border-blue-500/20 font-bold hover:bg-blue-600/20 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Dashboard
                    </a>
                @endif
            </div>

            <!-- Notifikasi Bawaan Breeze & Custom -->
            @if (session('status') === 'profile-updated' || session('status') === 'password-updated' || session('success'))
                <div class="mb-8 px-6 py-4 bg-green-500/10 border border-green-500/20 text-green-400 rounded-2xl flex items-center gap-3 font-medium"
                    x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('success') ?? 'Pembaruan berhasil disimpan.' }}
                </div>
            @endif


            <!-- LOGIKA LAYOUT BERDASARKAN ROLE -->
            @if (auth()->user()->role === 'admin')
                <!-- TAMPILAN ADMIN: 2 Kolom (Profil & Password) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">

                    <!-- Form Informasi Profil (Admin) -->
                    <div
                        class="bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/5 rounded-3xl p-8 shadow-xl">
                        <div class="flex items-center gap-3 mb-6">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <h3 class="text-lg font-bold text-white">Informasi Dasar</h3>
                        </div>

                        <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                            @csrf @method('patch')
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Nama
                                    Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                                    required
                                    class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-colors">
                                @error('name')
                                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Alamat
                                    Email</label>
                                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                                    required
                                    class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-colors">
                                @error('email')
                                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="pt-4 border-t border-white/5">
                                <button type="submit"
                                    class="w-full py-3 bg-white text-[#09090b] rounded-xl font-bold hover:bg-gray-200 transition-colors">Simpan
                                    Profil</button>
                            </div>
                        </form>
                    </div>

                    <!-- Form Ubah Password (Admin) -->
                    <div
                        class="bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/5 rounded-3xl p-8 shadow-xl">
                        <div class="flex items-center gap-3 mb-6">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            <h3 class="text-lg font-bold text-white">Keamanan Akun</h3>
                        </div>

                        <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                            @csrf @method('put')
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Password
                                    Saat Ini</label>
                                <input type="password" name="current_password" required
                                    class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-purple-500 focus:ring-1 focus:ring-purple-500 outline-none transition-colors">
                                @error('current_password', 'updatePassword')
                                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Password
                                    Baru</label>
                                <input type="password" name="password" required
                                    class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-purple-500 focus:ring-1 focus:ring-purple-500 outline-none transition-colors">
                                @error('password', 'updatePassword')
                                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Konfirmasi
                                    Password</label>
                                <input type="password" name="password_confirmation" required
                                    class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-purple-500 focus:ring-1 focus:ring-purple-500 outline-none transition-colors">
                            </div>
                            <div class="pt-4 border-t border-white/5">
                                <button type="submit"
                                    class="w-full py-3 bg-white/10 text-white border border-white/10 rounded-xl font-bold hover:bg-white/20 transition-colors">Update
                                    Password</button>
                            </div>
                        </form>
                    </div>

                </div>
            @else
                <!-- TAMPILAN CUSTOMER: 3 Kolom (Profil/Pass di kiri, Alamat di kanan) -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">

                    <!-- KOLOM KIRI: Form Profil & Password -->
                    <div class="lg:col-span-1 space-y-8">
                        <!-- Profil -->
                        <div
                            class="bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/5 rounded-3xl p-8 shadow-xl">
                            <div class="flex items-center gap-3 mb-6">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <h3 class="text-lg font-bold text-white">Informasi Dasar</h3>
                            </div>
                            <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                                @csrf @method('patch')
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Nama
                                        Lengkap</label>
                                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                                        required
                                        class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-blue-500 outline-none transition-colors">
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Alamat
                                        Email</label>
                                    <input type="email" name="email"
                                        value="{{ old('email', auth()->user()->email) }}" required
                                        class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-blue-500 outline-none transition-colors">
                                </div>
                                <div class="pt-4 border-t border-white/5">
                                    <button type="submit"
                                        class="w-full py-3 bg-white text-[#09090b] rounded-xl font-bold hover:bg-gray-200 transition-colors">Simpan
                                        Profil</button>
                                </div>
                            </form>
                        </div>

                        <!-- Password -->
                        <div
                            class="bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/5 rounded-3xl p-8 shadow-xl">
                            <div class="flex items-center gap-3 mb-6">
                                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                                <h3 class="text-lg font-bold text-white">Keamanan Akun</h3>
                            </div>
                            <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                                @csrf @method('put')
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Password
                                        Saat Ini</label>
                                    <input type="password" name="current_password" required
                                        class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-purple-500 outline-none transition-colors">
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Password
                                        Baru</label>
                                    <input type="password" name="password" required
                                        class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-purple-500 outline-none transition-colors">
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Konfirmasi
                                        Password</label>
                                    <input type="password" name="password_confirmation" required
                                        class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-purple-500 outline-none transition-colors">
                                </div>
                                <div class="pt-4 border-t border-white/5">
                                    <button type="submit"
                                        class="w-full py-3 bg-white/10 text-white border border-white/10 rounded-xl font-bold hover:bg-white/20 transition-colors">Update
                                        Password</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- KOLOM KANAN: Buku Alamat -->
                    <div class="lg:col-span-2">
                        <div
                            class="bg-linear-to-br from-[#121214] to-[#0a0a0c] border border-white/5 rounded-[2.5rem] p-8 lg:p-10 shadow-2xl h-full">
                            <div
                                class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 border-b border-white/5 pb-6">
                                <div>
                                    <h3 class="text-2xl font-bold text-white flex items-center gap-3">
                                        <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Buku Alamat
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1">Kelola alamat pengiriman pesananmu.</p>
                                </div>
                                <button type="button" @click="addAddressModal = true"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-cyan-500/10 text-cyan-400 font-bold hover:bg-cyan-500/20 transition-colors border border-cyan-500/20">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Tambah Alamat
                                </button>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @forelse(auth()->user()->addresses as $address)
                                    <div
                                        class="bg-[#050505] border {{ $address->is_primary ? 'border-cyan-500/50 shadow-[0_0_20px_rgba(34,211,238,0.1)]' : 'border-white/10 hover:border-white/30' }} rounded-2xl p-6 transition-all relative flex flex-col h-full">

                                        @if ($address->is_primary)
                                            <div class="absolute -top-3 -right-3">
                                                <span
                                                    class="bg-cyan-500 text-[#09090b] text-[10px] font-extrabold uppercase tracking-widest px-3 py-1 rounded-full shadow-lg">Utama</span>
                                            </div>
                                        @endif

                                        <div class="mb-4">
                                            <h4 class="text-lg font-bold text-white">{{ $address->recipient_name }}</h4>
                                            <p class="text-sm font-mono text-gray-400">{{ $address->phone_number }}</p>
                                        </div>

                                        <p class="text-gray-400 text-sm leading-relaxed mb-6 flex-1">
                                            {{ $address->full_address }}<br>
                                            {{ $address->city }}, {{ $address->postal_code }}
                                        </p>

                                        <div class="flex items-center gap-3 pt-4 border-t border-white/5">
                                            @if (!$address->is_primary)
                                                <form action="{{ route('address.setPrimary', $address->id) }}"
                                                    method="POST" class="flex-1 m-0">
                                                    @csrf @method('PUT')
                                                    <button type="submit"
                                                        class="w-full py-2.5 text-xs font-bold text-cyan-400 bg-cyan-500/10 rounded-xl hover:bg-cyan-500/20 transition-colors">Jadikan
                                                        Utama</button>
                                                </form>
                                            @else
                                                <div class="flex-1"></div> <!-- Spacer untuk menjaga layout sejajar -->
                                            @endif

                                            <!-- Tombol Edit -->
                                            <button type="button"
                                                @click="$dispatch('open-edit-address', { 
                                                    url: '{{ route('address.update', $address->id) }}',
                                                    address: {
                                                        recipient_name: '{{ addslashes($address->recipient_name) }}',
                                                        phone_number: '{{ addslashes($address->phone_number) }}',
                                                        city: '{{ addslashes($address->city) }}',
                                                        postal_code: '{{ addslashes($address->postal_code) }}',
                                                        full_address: '{{ addslashes($address->full_address) }}'
                                                    }
                                                })"
                                                class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 flex items-center justify-center transition-colors"
                                                title="Edit Alamat">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                    </path>
                                                </svg>
                                            </button>

                                            <!-- Tombol Hapus -->
                                            <button type="button"
                                                @click="$dispatch('open-delete-address', { url: '{{ route('address.destroy', $address->id) }}' })"
                                                class="w-10 h-10 rounded-xl bg-red-500/10 text-red-400 hover:bg-red-500/20 flex items-center justify-center transition-colors"
                                                title="Hapus Alamat">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @empty
                                    <div
                                        class="col-span-full border border-dashed border-white/10 rounded-2xl p-10 text-center flex flex-col items-center">
                                        <div
                                            class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <p class="text-gray-400 font-medium">Belum ada alamat yang tersimpan.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        <!-- ==============================================
                 ZONA MODAL ALPINE (Dijalankan di luar Grid Utama)
                 ============================================== -->

        <!-- MODAL TAMBAH ALAMAT -->
        <div x-show="addAddressModal" style="display: none;"
            class="fixed inset-0 z-100 flex items-center justify-center p-4">
            <div x-show="addAddressModal" x-transition.opacity class="absolute inset-0 bg-black/60 backdrop-blur-sm"
                @click="addAddressModal = false"></div>

            <div x-show="addAddressModal" x-transition.scale.90
                class="relative bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/10 rounded-4xl w-full max-w-lg p-8 shadow-2xl overflow-hidden z-10">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                        </svg>
                        Tambah Alamat Baru
                    </h3>
                    <button type="button" @click="addAddressModal = false"
                        class="text-gray-500 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form action="{{ route('address.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Nama
                            Penerima</label>
                        <input type="text" name="recipient_name" required placeholder="Cth: Rumah, Kantor, Asep"
                            class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-cyan-500 focus:ring-1 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Nomor
                            Telepon</label>
                        <input type="text" name="phone_number" required placeholder="0812..."
                            class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-cyan-500 focus:ring-1 outline-none">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Kota/Kabupaten</label>
                            <input type="text" name="city" required
                                class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-cyan-500 focus:ring-1 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Kode
                                Pos</label>
                            <input type="text" name="postal_code" required
                                class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-cyan-500 focus:ring-1 outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Alamat
                            Lengkap</label>
                        <textarea name="full_address" rows="3" required placeholder="Nama jalan, gedung, no. rumah..."
                            class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-cyan-500 focus:ring-1 outline-none"></textarea>
                    </div>
                    <div class="pt-4 border-t border-white/5">
                        <button type="submit"
                            class="w-full py-3 bg-cyan-600 hover:bg-cyan-500 text-white rounded-xl font-bold transition-all shadow-[0_0_15px_rgba(34,211,238,0.3)]">
                            Simpan Alamat
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL EDIT ALAMAT -->
        <div x-show="editAddressModal" style="display: none;"
            class="fixed inset-0 z-100 flex items-center justify-center p-4">
            <div x-show="editAddressModal" x-transition.opacity class="absolute inset-0 bg-black/60 backdrop-blur-sm"
                @click="editAddressModal = false"></div>

            <div x-show="editAddressModal" x-transition.scale.90
                class="relative bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/10 rounded-4xl w-full max-w-lg p-8 shadow-2xl overflow-hidden z-10">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                            </path>
                        </svg>
                        Edit Data Alamat
                    </h3>
                    <button type="button" @click="editAddressModal = false"
                        class="text-gray-500 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form :action="editUrl" method="POST" class="space-y-4">
                    @csrf @method('PUT')
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Nama
                            Penerima</label>
                        <input type="text" name="recipient_name" x-model="editData.recipient_name" required
                            class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-blue-500 focus:ring-1 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Nomor
                            Telepon</label>
                        <input type="text" name="phone_number" x-model="editData.phone_number" required
                            class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-blue-500 focus:ring-1 outline-none">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Kota/Kabupaten</label>
                            <input type="text" name="city" x-model="editData.city" required
                                class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-blue-500 focus:ring-1 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Kode
                                Pos</label>
                            <input type="text" name="postal_code" x-model="editData.postal_code" required
                                class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-blue-500 focus:ring-1 outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Alamat
                            Lengkap</label>
                        <textarea name="full_address" x-model="editData.full_address" rows="3" required
                            class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-blue-500 focus:ring-1 outline-none"></textarea>
                    </div>

                    <div class="pt-4 border-t border-white/5">
                        <button type="submit"
                            class="w-full py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-xl font-bold transition-all shadow-[0_0_15px_rgba(37,99,235,0.3)]">
                            Update Alamat
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL KONFIRMASI HAPUS ALAMAT -->
        <div x-show="deleteAddressModal" style="display: none;"
            class="fixed inset-0 z-100 flex items-center justify-center p-4">
            <div x-show="deleteAddressModal" x-transition.opacity class="absolute inset-0 bg-black/60 backdrop-blur-sm"
                @click="deleteAddressModal = false"></div>

            <div x-show="deleteAddressModal" x-transition.scale.90
                class="relative bg-linear-to-b from-[#121214] to-[#0a0a0c] border border-white/10 rounded-4xl w-full max-w-md p-8 shadow-2xl overflow-hidden z-10 text-center flex flex-col items-center">
                <div
                    class="w-16 h-16 rounded-full bg-red-500/10 border border-red-500/20 text-red-500 flex items-center justify-center mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-2">Hapus Alamat?</h3>
                <p class="text-gray-400 mb-8 text-sm">Alamat yang dihapus tidak dapat dipulihkan. Apakah Anda yakin?</p>

                <div class="flex gap-4 w-full">
                    <button type="button" @click="deleteAddressModal = false"
                        class="flex-1 py-3.5 rounded-xl bg-white/5 border border-white/10 text-white font-bold hover:bg-white/10 transition-colors">Batal</button>
                    <form :action="deleteUrl" method="POST" class="flex-1 m-0">
                        @csrf @method('DELETE')
                        <button type="submit"
                            class="w-full py-3.5 rounded-xl bg-red-600 hover:bg-red-500 text-white font-bold shadow-[0_0_15px_rgba(220,38,38,0.3)] transition-all">Ya,
                            Hapus</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
