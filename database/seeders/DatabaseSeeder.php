<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::firstOrCreate(
            ['email' => 'admin@kopi.com'],
            ['name' => 'Admin Kopi Nusantara', 'password' => Hash::make('password'), 'role' => 'admin', 'phone' => '08100000001']
        );

        // Regular user
        User::firstOrCreate(
            ['email' => 'user@kopi.com'],
            ['name' => 'Pelanggan Setia', 'password' => Hash::make('password'), 'role' => 'user', 'phone' => '08199999999']
        );

        // Sample menus
        $menus = [
            ['name' => 'Kopi Tubruk Klasik',       'category' => 'Coffee',     'price' => 18000,  'description' => 'Kopi tubruk tradisional dengan cita rasa kuat dan aroma yang khas.', 'is_featured' => true],
            ['name' => 'Espresso Single Origin',   'category' => 'Coffee',     'price' => 22000,  'description' => 'Espresso pekat dengan karakter biji single origin Aceh Gayo.', 'is_featured' => true],
            ['name' => 'Flat White',               'category' => 'Coffee',     'price' => 28000,  'description' => 'Espresso double shot dengan susu steam micro-foam yang lembut.', 'is_featured' => true],
            ['name' => 'Caramel Macchiato',        'category' => 'Coffee',     'price' => 32000,  'description' => 'Espresso dengan susu yang di-foam sempurna dan drizzle karamel.', 'is_featured' => true],
            ['name' => 'Avocado Coffee',           'category' => 'Coffee',     'price' => 38000,  'description' => 'Kreasi unik alpukat creamy dengan shot espresso segar.', 'is_featured' => true],
            ['name' => 'Iced Matcha Latte',        'category' => 'Non-Coffee', 'price' => 30000,  'description' => 'Matcha premium Jepang dengan susu segar dingin yang menyegarkan.', 'is_featured' => true],
            ['name' => 'Croissant Butter',         'category' => 'Food',       'price' => 25000,  'description' => 'Croissant mentega segar yang renyah di luar dan lembut di dalam.'],
            ['name' => 'Tiramisu Classic',         'category' => 'Dessert',    'price' => 35000,  'description' => 'Tiramisu klasik Italia dengan mascarpone dan espresso.'],
            ['name' => 'Cold Brew 24hrs',          'category' => 'Coffee',     'price' => 30000,  'description' => 'Cold brew yang diseduh 24 jam dengan rasa halus dan kadar kafein tinggi.'],
            ['name' => 'Strawberry Sparkling',     'category' => 'Non-Coffee', 'price' => 25000,  'description' => 'Minuman soda strawberry segar dengan potongan buah asli.'],
        ];

        foreach ($menus as $i => $menu) {
            Menu::firstOrCreate(
                ['name' => $menu['name']],
                [...$menu, 'is_available' => true, 'sort_order' => $i]
            );
        }

        // Sample products
        $products = [
            ['name' => 'Gayo Highlands Premium',    'origin' => 'Aceh Gayo',     'roast_level' => 'Medium',      'flavor_notes' => 'Caramel, Chocolate, Earthy', 'price' => 95000,  'stock' => 50, 'weight_grams' => 250, 'is_featured' => true],
            ['name' => 'Toraja Sulawesi Select',    'origin' => 'Toraja',         'roast_level' => 'Medium-Dark', 'flavor_notes' => 'Dark Chocolate, Smoky, Bold', 'price' => 115000, 'stock' => 30, 'weight_grams' => 250, 'is_featured' => true],
            ['name' => 'Flores Bajawa Natural',     'origin' => 'Flores NTT',     'roast_level' => 'Light',       'flavor_notes' => 'Fruity, Floral, Bright',    'price' => 105000, 'stock' => 25, 'weight_grams' => 200, 'is_featured' => true],
            ['name' => 'Kintamani Bali Honey',      'origin' => 'Kintamani Bali', 'roast_level' => 'Medium',      'flavor_notes' => 'Honey, Citrus, Clean',      'price' => 125000, 'stock' => 20, 'weight_grams' => 200, 'is_featured' => true],
            ['name' => 'Mandailing Natural',        'origin' => 'Mandailing',     'roast_level' => 'Dark',        'flavor_notes' => 'Full Body, Spicy, Herbal',  'price' => 85000,  'stock' => 40, 'weight_grams' => 250],
            ['name' => 'Papua Wamena Washed',       'origin' => 'Papua Wamena',   'roast_level' => 'Light',       'flavor_notes' => 'Clean, Sweet, Delicate',    'price' => 150000, 'stock' => 15, 'weight_grams' => 200],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['name' => $product['name']],
                [...$product, 'is_active' => true]
            );
        }
        $this->call([
            PageSeeder::class,
        ]);
    }
}
