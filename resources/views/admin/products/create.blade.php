@extends('layouts.admin')
@section('title', 'Tambah Produk Baru')
@section('header', 'Tambah Laptop')

@section('content')
    <div class="max-w-4xl bg-[#121214] border border-white/5 rounded-2xl shadow-2xl p-6 md:p-8">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Produk -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Nama Laptop</label>
                    <input type="text" name="name" required
                        class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        placeholder="Contoh: ASUS ROG Strix G15">
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Kategori</label>
                    <select name="category_id" required
                        class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Harga -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Harga (Rp)</label>
                    <input type="number" name="price" required min="0"
                        class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        placeholder="15000000">
                </div>

                <!-- Stok & Berat -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Stok</label>
                        <input type="number" name="stock" required min="0"
                            class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-blue-500 focus:border-blue-500 transition-colors"
                            placeholder="10">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Berat (Gram)</label>
                        <input type="number" name="weight" required min="0"
                            class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-blue-500 focus:border-blue-500 transition-colors"
                            placeholder="2500">
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Spesifikasi / Deskripsi</label>
                <textarea name="description" rows="5" required
                    class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    placeholder="Jelaskan prosesor, RAM, SSD, dll..."></textarea>
            </div>

            <!-- Upload Multiple Gambar -->
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Gambar Produk (Bisa pilih lebih dari
                    satu)</label>
                <!-- Perhatikan name="images[]" dan atribut multiple -->
                <input type="file" name="images[]" multiple required accept="image/*"
                    class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-500/10 file:text-blue-500 hover:file:bg-blue-500/20 transition-all cursor-pointer">
                <p class="text-xs text-gray-500 mt-2">Gambar pertama yang dipilih akan otomatis menjadi thumbnail utama.</p>
            </div>
            
            <div class="pt-4 flex gap-4">
                <a href="{{ route('admin.products.index') }}"
                    class="px-6 py-3 bg-white/5 border border-white/10 text-white rounded-xl font-bold hover:bg-white/10 transition-colors">Batal</a>
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-500 transition-all shadow-[0_0_15px_rgba(37,99,235,0.3)]">Simpan
                    Produk</button>
            </div>
        </form>
    </div>
@endsection
