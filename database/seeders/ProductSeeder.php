<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Kategori Utama
        $categories = [
            'gaming' => Category::create(['name' => 'Laptop Gaming', 'slug' => 'laptop-gaming']),
            'bisnis' => Category::create(['name' => 'Bisnis & Profesional', 'slug' => 'laptop-bisnis']),
            'premium' => Category::create(['name' => 'Premium & Ultrabook', 'slug' => 'laptop-premium']),
            'pelajar' => Category::create(['name' => 'Pelajar & Entry Level', 'slug' => 'laptop-pelajar']),
        ];

        // 2. Siapkan Data 10 Laptop Lengkap dengan Spesifikasi Realistis
        $laptops = [
            [
                'folder' => 'lap-1',
                'name' => 'Acer Nitro AN515-58',
                'category_id' => $categories['gaming']->id,
                'sku' => 'ACER-NTR-001',
                'description' => "Prosesor: Intel Core i7-12700H\nRAM: 16GB DDR4\nStorage: 512GB NVMe SSD\nGPU: NVIDIA GeForce RTX 3060 6GB\nLayar: 15.6\" FHD 144Hz\nLaptop gaming tangguh dengan sistem pendingin dual-fan mutakhir, sangat cocok untuk E-Sports dan rendering 3D.",
                'price' => 14500000,
                'stock' => 12,
                'weight' => 2500,
            ],
            [
                'folder' => 'lap-2',
                'name' => 'Lenovo ThinkPad T480',
                'category_id' => $categories['bisnis']->id,
                'sku' => 'LNV-T480-002',
                'description' => "Prosesor: Intel Core i5-8350U\nRAM: 16GB DDR4\nStorage: 256GB SSD\nGPU: Intel UHD Graphics 620\nLayar: 14\" FHD IPS\nLaptop legendaris andalan para programmer dan pekerja kantoran. Keyboard paling nyaman di kelasnya dengan ketahanan standar militer (MIL-SPEC).",
                'price' => 4500000,
                'stock' => 8,
                'weight' => 1580,
            ],
            [
                'folder' => 'lap-3',
                'name' => 'ASUS Zenbook 14 OLED',
                'category_id' => $categories['premium']->id,
                'sku' => 'ASUS-ZEN-003',
                'description' => "Prosesor: Intel Core Ultra 7\nRAM: 32GB LPDDR5x\nStorage: 1TB PCIe 4.0 SSD\nGPU: Intel Arc Graphics\nLayar: 14\" 3K OLED 120Hz\nKarya seni teknologi. Laptop ultra tipis dengan layar OLED yang memanjakan mata, dirancang khusus untuk mobilitas tinggi dan kreator.",
                'price' => 21000000,
                'stock' => 5,
                'weight' => 1200,
            ],
            [
                'folder' => 'lap-4',
                'name' => 'Dell Inspiron 14 5440',
                'category_id' => $categories['pelajar']->id,
                'sku' => 'DELL-INS-004',
                'description' => "Prosesor: Intel Core 5 120U\nRAM: 16GB DDR5\nStorage: 512GB SSD\nGPU: Intel Graphics\nLayar: 14\" FHD+ WVA\nLaptop serba bisa dengan desain minimalis elegan. Sangat responsif untuk multitasking tugas sekolah dan pekerjaan administrasi harian.",
                'price' => 11200000,
                'stock' => 15,
                'weight' => 1560,
            ],
            [
                'folder' => 'lap-5',
                'name' => 'MacBook Pro M5',
                'category_id' => $categories['premium']->id,
                'sku' => 'MAC-PRO-005',
                'description' => "Prosesor: Apple M5 Pro Chip (12-core CPU)\nRAM: 18GB Unified Memory\nStorage: 512GB SSD\nGPU: 18-core GPU\nLayar: 14.2\" Liquid Retina XDR\nGenerasi masa depan dari Apple. Memberikan performa buas tanpa batas dengan efisiensi baterai yang mampu bertahan hingga 22 jam pemakaian.",
                'price' => 32999000,
                'stock' => 4,
                'weight' => 1600,
            ],
            [
                'folder' => 'lap-6',
                'name' => 'Axioo Hype JKT48',
                'category_id' => $categories['pelajar']->id,
                'sku' => 'AXO-HYP-006',
                'description' => "Prosesor: Intel Core i5-1035G4\nRAM: 8GB DDR4\nStorage: 512GB SSD\nLayar: 14\" FHD\nEdisi spesial kolaborasi dengan JKT48. Desain stylish, ringan, dan harga sangat terjangkau. Cocok untuk menemani hari-hari pelajar aktif.",
                'price' => 5499000,
                'stock' => 20,
                'weight' => 1400,
            ],
            [
                'folder' => 'lap-7',
                'name' => 'HP OmniBook',
                'category_id' => $categories['bisnis']->id,
                'sku' => 'HP-OMN-007',
                'description' => "Prosesor: Snapdragon X Elite\nRAM: 16GB LPDDR5x\nStorage: 1TB PCIe Gen4 NVMe\nGPU: Qualcomm Adreno\nLayar: 14\" 2.2K IPS\nLaptop era AI (Copilot+ PC). Prosesor arsitektur ARM memberikan ketahanan baterai luar biasa dengan fitur NPU untuk kecerdasan buatan terintegrasi.",
                'price' => 24500000,
                'stock' => 7,
                'weight' => 1340,
            ],
            [
                'folder' => 'lap-8',
                'name' => 'Advan Workplus',
                'category_id' => $categories['bisnis']->id,
                'sku' => 'ADV-WRK-008',
                'description' => "Prosesor: AMD Ryzen 5 6600H\nRAM: 16GB LPDDR5\nStorage: 512GB SSD\nGPU: AMD Radeon 660M\nLayar: 14\" FHD IPS\nLaptop lokal pembunuh raksasa. Performa kelas atas (prosesor seri H) namun ditawarkan dengan harga kelas menengah. Idola baru anak IT.",
                'price' => 7100000,
                'stock' => 18,
                'weight' => 1400,
            ],
            [
                'folder' => 'lap-9',
                'name' => 'ROG Zephyrus G14',
                'category_id' => $categories['gaming']->id,
                'sku' => 'ASUS-ROG-009',
                'description' => "Prosesor: AMD Ryzen 9 8945HS\nRAM: 32GB LPDDR5X\nStorage: 1TB PCIe 4.0\nGPU: NVIDIA GeForce RTX 4070 8GB\nLayar: 14\" 3K OLED 120Hz\nKombinasi sempurna antara tenaga dan estetika. Chassis aluminium CNC dengan lampu Slash Lighting di cover belakang, memancarkan aura sultan.",
                'price' => 35999000,
                'stock' => 3,
                'weight' => 1500,
            ],
            [
                'folder' => 'lap-10',
                'name' => 'Samsung Chromebook 4',
                'category_id' => $categories['pelajar']->id,
                'sku' => 'SAMSUNG-CHM-010',
                'description' => "Prosesor: Intel Celeron N4000\nRAM: 4GB LPDDR4\nStorage: 32GB eMMC\nLayar: 11.6\" HD\nSistem operasi ChromeOS yang super ringan dan bebas virus. Pilihan tepat dan aman untuk tugas sekolah dasar, browsing, dan mengetik dokumen online.",
                'price' => 2800000,
                'stock' => 30,
                'weight' => 1180,
            ],
        ];

        // 3. Pastikan folder tujuan (storage/app/public/products) ada
        if (!Storage::disk('public')->exists('products')) {
            Storage::disk('public')->makeDirectory('products');
        }

        // 4. Proses Eksekusi Data & Copy Gambar
        foreach ($laptops as $data) {
            // A. Insert ke tabel Products
            $product = Product::create([
                'category_id' => $data['category_id'],
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'sku' => $data['sku'],
                'description' => $data['description'],
                'price' => $data['price'],
                'stock' => $data['stock'],
                'weight' => $data['weight'],
            ]);

            // B. Logika Copy File Gambar
            $sourcePath = public_path('assets/img/' . $data['folder']);

            // Cek apakah folder asal (di public/assets/img/lap-x) benar-benar ada
            if (File::exists($sourcePath)) {
                $files = File::files($sourcePath);
                $imageCount = 0;

                foreach ($files as $file) {
                    // Batasi maksimal 3 gambar sesuai instruksi
                    if ($imageCount >= 3) break;

                    // Buat nama unik agar tidak bentrok (misal: lap-1-1715873200-1.jpg)
                    $filename = $data['folder'] . '-' . time() . '-' . $imageCount . '.' . $file->getExtension();
                    $destinationPath = storage_path('app/public/products/' . $filename);

                    // COPY FILE DARI PUBLIC KE STORAGE
                    File::copy($file->getPathname(), $destinationPath);

                    // Insert ke tabel ProductImages
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => 'products/' . $filename,
                        'is_primary' => $imageCount === 0 ? true : false, // Gambar pertama jadi thumbnail
                    ]);

                    $imageCount++;
                }
            } else {
                // Log/Info ke terminal jika folder lap-x tidak ditemukan
                $this->command->warn("Folder gambar untuk {$data['name']} tidak ditemukan di: {$sourcePath}");
            }
        }

        $this->command->info('Seeding Produk dan Migrasi Gambar berhasil diselesaikan!');
    }
}
