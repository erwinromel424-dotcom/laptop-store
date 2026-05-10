@extends('layouts.admin')
@section('title', 'Edit Produk')
@section('header', 'Edit Laptop: ' . $product->name)

@section('content')
    <div class="max-w-4xl bg-[#121214] border border-white/5 rounded-2xl shadow-2xl p-6 md:p-8">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama & Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Nama Laptop</label>
                    <input type="text" name="name" value="{{ $product->name }}" required
                        class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Kategori</label>
                    <select name="category_id" required
                        class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-blue-500">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Harga & Stok/Berat -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ $product->price }}" required min="0"
                        class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-blue-500">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Stok</label>
                        <input type="number" name="stock" value="{{ $product->stock }}" required min="0"
                            class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Berat (Gram)</label>
                        <input type="number" name="weight" value="{{ $product->weight }}" required min="0"
                            class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Spesifikasi / Deskripsi</label>
                <textarea name="description" rows="5" required
                    class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-blue-500">{{ $product->description }}</textarea>
            </div>
            <!-- Upload Multiple Gambar & Interaksi Preview -->
            @php $primaryImage = $product->images->where('is_primary', true)->first(); @endphp

            <div x-data="{ mainImage: '{{ $primaryImage ? asset('storage/' . $primaryImage->image_path) : '' }}' }">
                <label class="block text-sm font-medium text-gray-400 mb-3">Gambar Produk Saat Ini</label>

                @if ($product->images->isNotEmpty())
                    <!-- Kotak Preview Utama (Muncul jika ada gambar) -->
                    <div
                        class="w-full h-48 sm:h-64 bg-[#09090b] border border-white/10 rounded-2xl mb-4 flex items-center justify-center overflow-hidden">
                        <img :src="mainImage" class="h-full object-contain p-2 transition-all duration-300">
                    </div>

                    <!-- Deretan Thumbnail yang bisa diklik -->
                    <div class="flex flex-wrap gap-3 mb-6">
                        @foreach ($product->images as $img)
                            @php $imgUrl = asset('storage/' . $img->image_path); @endphp

                            <div @click="mainImage = '{{ $imgUrl }}'"
                                class="cursor-pointer w-16 h-16 sm:w-20 sm:h-20 rounded-xl bg-[#09090b] overflow-hidden shrink-0 border transition-all duration-300"
                                :class="mainImage === '{{ $imgUrl }}' ?
                                    'border-blue-500 shadow-[0_0_10px_rgba(37,99,235,0.3)] opacity-100 scale-105' :
                                    'border-white/10 opacity-50 hover:opacity-100'">
                                <img src="{{ $imgUrl }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                @else
                    <div
                        class="w-full py-8 border-2 border-dashed border-white/10 rounded-2xl mb-6 flex items-center justify-center text-gray-500">
                        Belum ada gambar tersimpan.
                    </div>
                @endif

                <label class="block text-sm font-medium text-yellow-500 mb-2 mt-4">Upload Gambar Baru (Kosongkan jika tidak
                    ingin mengubah)</label>
                <div class="text-xs text-gray-500 mb-3">Peringatan: Mengupload gambar baru akan <b>menghapus</b> semua
                    gambar lama yang ada di atas.</div>

                <input type="file" name="images[]" multiple accept="image/*"
                    class="w-full bg-[#09090b] border border-white/10 rounded-xl px-4 py-3 text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-yellow-500/10 file:text-yellow-500 hover:file:bg-yellow-500/20 transition-all cursor-pointer">
            </div>

            <div class="pt-4 flex gap-4">
                <a href="{{ route('admin.products.index') }}"
                    class="px-6 py-3 bg-white/5 border border-white/10 text-white rounded-xl font-bold">Batal</a>
                <button type="submit"
                    class="px-6 py-3 bg-yellow-600 text-white rounded-xl font-bold hover:bg-yellow-500 transition-all shadow-[0_0_15px_rgba(202,138,4,0.3)]">Update
                    Produk</button>
            </div>
        </form>
    </div>
@endsection
