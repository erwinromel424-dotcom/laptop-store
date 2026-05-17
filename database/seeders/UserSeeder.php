<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin (Erwin Rommel)
        User::create([
            'name' => 'Erwin Rommel',
            'email' => 'admin@laptopstore.com',
            'email_verified_at' => now(),
            'phone' => '081234567890',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'remember_token' => Str::random(10),
        ]);

        // 2. Daftar Data Customer Dummy
        $customers = [
            [
                'name' => 'Asep Sukma',
                'email' => 'asep@gmail.com',
                'phone' => '081987654321',
                'address' => 'Jl. Perjuangan No. 1, Kesambi',
                'city' => 'Kota Cirebon',
                'postal' => '45131',
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@gmail.com',
                'phone' => '085612341234',
                'address' => 'Jl. Cipto Mangunkusumo No. 45',
                'city' => 'Kota Cirebon',
                'postal' => '45132',
            ],
            [
                'name' => 'Citra Lestari',
                'email' => 'citra.lestari@gmail.com',
                'phone' => '081233445566',
                'address' => 'Jl. Tuparev No. 88, Kedawung',
                'city' => 'Kabupaten Cirebon',
                'postal' => '45153',
            ],
            [
                'name' => 'Dika Pratama',
                'email' => 'dika.pratama@yahoo.com',
                'phone' => '087766554433',
                'address' => 'Perumahan Pemuda Estate Blok B2',
                'city' => 'Kota Cirebon',
                'postal' => '45132',
            ],
            [
                'name' => 'Eka Sari',
                'email' => 'eka.sari99@gmail.com',
                'phone' => '089911223344',
                'address' => 'Jl. Kartini No. 12, Kejaksan',
                'city' => 'Kota Cirebon',
                'postal' => '45123',
            ],
            [
                'name' => 'Fajar Hidayat',
                'email' => 'fajar.h@outlook.com',
                'phone' => '082233445566',
                'address' => 'Jl. Pemuda Raya No. 4',
                'city' => 'Kota Cirebon',
                'postal' => '45132',
            ],
            [
                'name' => 'Gita Kirana',
                'email' => 'gitakirana@gmail.com',
                'phone' => '081122334455',
                'address' => 'Kawasan Batik Trusmi, Weru',
                'city' => 'Kabupaten Cirebon',
                'postal' => '45154',
            ],
            [
                'name' => 'Hadi Kusuma',
                'email' => 'hadi.kusuma@gmail.com',
                'phone' => '085544332211',
                'address' => 'Jl. Siliwangi No. 100',
                'city' => 'Kota Cirebon',
                'postal' => '45124',
            ],
            [
                'name' => 'Indah Permatasari',
                'email' => 'indah.permata@yahoo.com',
                'phone' => '081344556677',
                'address' => 'Komp. Bima Indah, Sunyaragi',
                'city' => 'Kota Cirebon',
                'postal' => '45132',
            ],
            [
                'name' => 'Joko Susilo',
                'email' => 'joko.susilo@gmail.com',
                'phone' => '088899990000',
                'address' => 'Jl. Wahid Hasyim, Lemahwungkuk',
                'city' => 'Kota Cirebon',
                'postal' => '45111',
            ],
        ];

        // 3. Eksekusi Looping Data
        foreach ($customers as $data) {
            // Buat User
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'email_verified_at' => now(),
                'phone' => $data['phone'],
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'remember_token' => Str::random(10),
            ]);

            // Buat Alamat yang terhubung ke User tersebut
            Address::create([
                'user_id' => $user->id,
                'recipient_name' => $data['name'],
                'phone_number' => $data['phone'],
                'full_address' => $data['address'],
                'city' => $data['city'],
                'postal_code' => $data['postal'],
                'is_primary' => true,
            ]);
        }
    }
}
