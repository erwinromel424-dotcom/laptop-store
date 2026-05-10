@extends('layouts.admin')
@section('title', 'Tambah Kategori')
@section('header', 'Kategori Baru')

@section('content')
    <div class="max-w-2xl bg-[#121214] border border-white/5 rounded-2xl shadow-2xl p-6 md:p-8">
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nama Kategori -->
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Nama Kategori</label>
                <input type="text" name="name" required
                    class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    placeholder="Contoh: Laptop Gaming, Laptop Pelajar, dll">
                @error('name')
                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Deskripsi (Opsional)</label>
                <textarea name="description" rows="4"
                    class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    placeholder="Tuliskan deskripsi singkat tentang kategori ini..."></textarea>
                @error('description')
                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="pt-4 flex gap-4">
                <a href="{{ route('admin.categories.index') }}"
                    class="px-6 py-3 bg-white/5 border border-white/10 text-white rounded-xl font-bold hover:bg-white/10 transition-colors">Batal</a>
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-500 transition-all shadow-[0_0_15px_rgba(37,99,235,0.3)]">Simpan
                    Kategori</button>
            </div>
        </form>
    </div>
@endsection
