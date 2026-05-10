@extends('layouts.admin')
@section('title', 'Detail Produk')
@section('header', 'Informasi Laptop')

@section('content')
    <div class="mb-6 flex gap-3">
        <a href="{{ route('admin.products.index') }}"
            class="px-4 py-2 bg-white/5 border border-white/10 text-white rounded-xl text-sm font-bold hover:bg-white/10 transition-colors">←
            Kembali</a>
        <a href="{{ route('admin.products.edit', $product->id) }}"
            class="px-4 py-2 bg-yellow-600 text-white rounded-xl text-sm font-bold hover:bg-yellow-500 transition-colors shadow-[0_0_15px_rgba(202,138,4,0.3)]">Edit
            Produk</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Area Gambar dengan Interaksi AlpineJS -->
        @php $primaryImage = $product->images->where('is_primary', true)->first(); @endphp

        <div x-data="{ mainImage: '{{ $primaryImage ? asset('storage/' . $primaryImage->image_path) : '' }}' }"
            class="md:col-span-1 bg-[#121214] border border-white/5 rounded-3xl p-6 flex flex-col items-center">

            <!-- Gambar Utama Dinamis -->
            <div
                class="w-full aspect-square rounded-2xl bg-[#09090b] border border-white/10 overflow-hidden mb-4 relative flex items-center justify-center">

                <template x-if="mainImage !== ''">
                    <!-- Atribut :src akan otomatis berubah saat thumbnail diklik -->
                    <img :src="mainImage" alt="{{ $product->name }}"
                        class="w-full h-full object-contain p-4 transition-all duration-300">
                </template>

                <template x-if="mainImage === ''">
                    <span class="text-gray-600 font-medium tracking-wide">Tidak ada gambar</span>
                </template>

                <span
                    class="absolute top-4 left-4 px-3 py-1 bg-blue-500/20 text-blue-400 border border-blue-500/30 text-xs font-bold rounded-full backdrop-blur-md">
                    {{ $product->category->name ?? 'Uncategorized' }}
                </span>
            </div>

            <!-- Galeri Thumbnail (Gambar Tambahan) -->
            @if ($product->images->count() > 0)
                <div class="grid grid-cols-4 gap-3 w-full mb-6">
                    @foreach ($product->images as $img)
                        @php $imgUrl = asset('storage/' . $img->image_path); @endphp

                        <!-- Event @click untuk mengubah mainImage -->
                        <div @click="mainImage = '{{ $imgUrl }}'"
                            class="cursor-pointer aspect-square rounded-xl bg-[#09090b] border transition-all duration-300 overflow-hidden"
                            :class="mainImage === '{{ $imgUrl }}' ?
                                'border-blue-500 shadow-[0_0_15px_rgba(37,99,235,0.3)] opacity-100 scale-105' :
                                'border-white/10 opacity-50 hover:opacity-100 hover:scale-100'">
                            <img src="{{ $imgUrl }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="text-center w-full mt-auto">
                <p class="text-gray-500 text-sm mb-2 font-medium">Kode SKU</p>
                <div
                    class="px-4 py-2.5 bg-[#09090b] border border-white/10 rounded-xl text-white font-mono tracking-widest text-sm inline-block shadow-inner">
                    {{ $product->sku }}
                </div>
            </div>
        </div>

        <!-- Area Informasi Spesifikasi -->
        <div class="md:col-span-2 bg-[#121214] border border-white/5 rounded-3xl p-8">
            <h2 class="text-3xl font-extrabold text-white mb-2">{{ $product->name }}</h2>
            <div class="flex items-center gap-6 mb-8 pb-8 border-b border-white/5">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Harga Jual</p>
                    <p class="text-2xl font-bold text-blue-400">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
                <div class="w-px h-10 bg-white/10"></div>
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Stok Tersedia</p>
                    <p class="text-xl font-bold {{ $product->stock <= 5 ? 'text-red-400' : 'text-green-400' }}">
                        {{ $product->stock }} <span class="text-sm font-normal text-gray-500">Unit</span></p>
                </div>
                <div class="w-px h-10 bg-white/10"></div>
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Berat</p>
                    <p class="text-xl font-bold text-white">{{ $product->weight }} <span
                            class="text-sm font-normal text-gray-500">Gram</span></p>
                </div>
            </div>

            <div>
                <p class="text-xs text-gray-500 uppercase tracking-widest mb-3 font-bold">Spesifikasi Utama</p>
                <div class="prose prose-invert max-w-none text-gray-300">
                    <p class="whitespace-pre-line leading-relaxed">{{ $product->description }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
