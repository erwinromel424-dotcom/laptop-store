@extends('layouts.admin')
@section('title', 'Manajemen Pengguna')
@section('header', 'Data Pengguna')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-white">Daftar Akun</h2>
        <a href="{{ route('admin.users.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-500 transition-all shadow-[0_0_15px_rgba(37,99,235,0.3)] flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 8a4 4 0 11-8 0 4 4 0 018 0zM2 20a10 10 0 0110-10h4"></path>
            </svg>
            Tambah Pengguna
        </a>
    </div>

    <!-- Alerts -->
    @if (session('success'))
        <div
            class="mb-4 px-4 py-3 bg-green-500/10 border border-green-500/20 text-green-400 rounded-xl flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 px-4 py-3 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                </path>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-[#121214] border border-white/5 rounded-2xl overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            {{-- Alert Notification jika admin baru saja menekan tombol reset --}}
            @if (session('success'))
                <div
                    class="mb-6 p-5 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 animate-fade-in">
                    <div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span class="text-sm font-bold">Reset Berhasil!</span>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">{{ session('success') }}</p>
                    </div>

                    {{-- Tombol otomatis kirim pesan rapi ke WhatsApp Customer --}}
                    @if (session('customer_phone') && session('new_password'))
                        <a href="https://wa.me/{{ session('customer_phone') }}?text=Halo%20{{ urlencode(session('customer_name')) }},%20password%20akun%20LaptopStore%20kamu%20telah%20di-reset%20oleh%20Admin.%20%0A%0APassword%20baru%3A%20*{{ session('new_password') }}*%20%0A%0ASilakan%20login%20kembali%20dan%20segera%20ubah%20password%20kamu%20di%20halaman%20profil%20demi%20keamanan."
                            target="_blank"
                            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-bold transition-all shadow-lg shadow-emerald-900/20 whitespace-nowrap">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397 0 11.948 0c3.173.001 6.154 1.24 8.396 3.486 2.241 2.247 3.477 5.232 3.475 8.406-.003 6.557-5.338 11.907-11.893 11.907-2.01 0-3.99-.51-5.747-1.483L0 24zm6.27-4.577c1.654.982 3.25 1.488 4.792 1.49 5.342 0 9.71-4.321 9.712-9.614.001-2.565-1-4.977-2.817-6.791-1.817-1.814-4.232-2.813-6.8-2.814-5.347 0-9.714 4.323-9.717 9.617-.001 1.706.463 3.376 1.343 4.849l-.993 3.626 3.71-.963z" />
                            </svg>
                            Kirim via WhatsApp
                        </a>
                    @endif
                </div>
            @endif
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#09090b] text-gray-400 text-xs uppercase tracking-widest border-b border-white/5">
                        <th class="px-6 py-4 font-bold">Profil</th>
                        <th class="px-6 py-4 font-bold">Kontak</th>
                        <th class="px-6 py-4 font-bold">Role</th>
                        <th class="px-6 py-4 font-bold">Terdaftar</th>
                        <th class="px-6 py-4 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach ($users as $user)
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <!-- Avatar Genereator (Inisial) -->
                                    <div
                                        class="w-10 h-10 rounded-xl {{ $user->role === 'admin' ? 'bg-linear-to-tr from-blue-600 to-purple-500 text-white' : 'bg-white/10 text-gray-300' }} flex items-center justify-center font-bold text-sm shadow-inner shrink-0">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-200 group-hover:text-white transition-colors">
                                            {{ $user->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-300">{{ $user->email }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $user->phone ?? 'No Phone' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @if ($user->role === 'admin')
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-bold bg-blue-500/20 text-blue-400 border border-blue-500/30">Administrator</span>
                                @else
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-bold bg-gray-500/20 text-gray-400 border border-gray-500/30">Customer</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 flex justify-end gap-2">
                                <a href="{{ route('admin.users.show', $user->id) }}"
                                    class="p-2 bg-white/5 text-gray-400 hover:text-blue-400 hover:bg-blue-500/10 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="p-2 bg-white/5 text-gray-400 hover:text-yellow-400 hover:bg-yellow-500/10 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </a>
                                <!-- Mencegah Admin Hapus Diri Sendiri di UI -->
                                @if (auth()->id() !== $user->id)
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Yakin ingin menghapus akun ini?');">
                                        @csrf @method('DELETE')
                                        <button
                                            class="p-2 bg-white/5 text-gray-400 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                @endif

                                {{-- Tombol Pemicu Reset Password --}}
                                <form action="{{ route('admin.users.reset-password', $user->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        onclick="return confirm('Yakin ingin mereset password akun {{ $user->name }} menjadi password123?')"
                                        class="inline-flex items-center gap-2 px-3 py-2 bg-yellow-500/10 border border-yellow-500/20 text-yellow-500 hover:bg-yellow-500/20 rounded-xl text-xs font-bold transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                                            </path>
                                        </svg>
                                        Reset Password
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-white/5">
            {{ $users->links() }}
        </div>
    </div>
@endsection
