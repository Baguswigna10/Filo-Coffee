<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::firstOrCreate(
            ['email' => 'admin@kopi.com'],
            ['name' => 'Admin Filo Coffee', 'password' => Hash::make('password'), 'role' => 'admin', 'phone' => '08100000001']
        );

        // Regular user
        User::firstOrCreate(
            ['email' => 'user@kopi.com'],
            ['name' => 'User Tes', 'password' => Hash::make('password'), 'role' => 'user', 'phone' => '08199999999']
        );

        // Konfigurasi halaman navigasi
        $this->call([
            PageSeeder::class,
        ]);
    }
}
