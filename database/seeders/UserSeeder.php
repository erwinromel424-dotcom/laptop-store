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
        // 1. Akun Admin
        User::create([
            'name' => 'Erwin Rommel',
            'email' => 'admin@laptopstore.com',
            'email_verified_at' => now(),
            'phone' => '081234567890',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'remember_token' => Str::random(10),
        ]);

        // 2. Akun Customer 1
        $customer1 = User::create([
            'name' => 'Asep Sukma',
            'email' => 'asep@gmail.com',
            'email_verified_at' => now(),
            'phone' => '081987654321',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'remember_token' => Str::random(10),
        ]);

        Address::create([
            'user_id' => $customer1->id,
            'recipient_name' => 'Asep Sukma',
            'phone_number' => '081987654321',
            'full_address' => 'Jl. Perjuangan No. 1, Kesambi',
            'city' => 'Kota Cirebon',
            'postal_code' => '45131',
            'is_primary' => true,
        ]);

        // 3. Akun Customer 2
        $customer2 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'email_verified_at' => now(),
            'phone' => '085612341234',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'remember_token' => Str::random(10),
        ]);

        Address::create([
            'user_id' => $customer2->id,
            'recipient_name' => 'Budi Santoso',
            'phone_number' => '085612341234',
            'full_address' => 'Jl. Cipto Mangunkusumo',
            'city' => 'Kota Cirebon',
            'postal_code' => '45132',
            'is_primary' => true,
        ]);
    }
}
