@extends('layouts.admin')
@section('title', 'Tambah Pengguna')
@section('header', 'Pengguna Baru')

@section('content')
    <div class="max-w-3xl bg-[#121214] border border-white/5 rounded-2xl shadow-2xl p-6 md:p-8">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    @error('name')
                        <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    @error('email')
                        <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- No HP -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Nomor HP (Opsional)</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    @error('phone')
                        <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Role / Peran</label>
                    <select name="role" required
                        class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <option value="customer">Customer</option>
                        <option value="admin">Administrator</option>
                    </select>
                    @error('role')
                        <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Password Baru</label>
                    <input type="password" name="password" required
                        class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    @error('password')
                        <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-blue-500 focus:border-blue-500 transition-colors">
                </div>
            </div>

            <div class="pt-4 flex gap-4">
                <a href="{{ route('admin.users.index') }}"
                    class="px-6 py-3 bg-white/5 border border-white/10 text-white rounded-xl font-bold hover:bg-white/10 transition-colors">Batal</a>
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-500 transition-all shadow-[0_0_15px_rgba(37,99,235,0.3)]">Buat
                    Akun</button>
            </div>
        </form>
    </div>
@endsection
