<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Kategori
        $catGaming = Category::create(['name' => 'Laptop Gaming', 'slug' => 'laptop-gaming']);
        $catPelajar = Category::create(['name' => 'Laptop Pelajar', 'slug' => 'laptop-pelajar']);

        // Produk 1: Gaming
        $prod1 = Product::create([
            'category_id' => $catGaming->id,
            'name' => 'ASUS ROG Strix G15',
            'slug' => Str::slug('ASUS ROG Strix G15'),
            'sku' => 'ASUS-ROG-G15-001',
            'description' => 'Laptop gaming performa tinggi dengan RTX 4060.',
            'price' => 18500000,
            'stock' => 10,
            'weight' => 2500, // 2.5 kg
        ]);

        ProductImage::create([
            'product_id' => $prod1->id,
            'image_path' => 'products/asus-rog-g15.jpg', // Dummy path
            'is_primary' => true,
        ]);

        // Produk 2: Pelajar/RPL
        $prod2 = Product::create([
            'category_id' => $catPelajar->id,
            'name' => 'Lenovo IdeaPad Slim 3',
            'slug' => Str::slug('Lenovo IdeaPad Slim 3'),
            'sku' => 'LNV-IPS3-002',
            'description' => 'Laptop ringan dan tangguh, cocok untuk tugas sekolah dan coding dasar.',
            'price' => 6500000,
            'stock' => 25,
            'weight' => 1500, // 1.5 kg
        ]);

        ProductImage::create([
            'product_id' => $prod2->id,
            'image_path' => 'products/lenovo-ideapad.jpg',
            'is_primary' => true,
        ]);
    }
}
