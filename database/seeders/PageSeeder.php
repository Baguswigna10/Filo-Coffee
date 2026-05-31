<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            ['name' => 'Home', 'slug' => '/', 'route_name' => 'home'],
            ['name' => 'About', 'slug' => '/about', 'route_name' => 'about'],
            ['name' => 'Menu', 'slug' => '/menu', 'route_name' => 'menu'],
            ['name' => 'Shop (Beans)', 'slug' => '/shop', 'route_name' => 'shop'],
            ['name' => 'Services', 'slug' => '/services', 'route_name' => 'services'],
            ['name' => 'News/Magazine', 'slug' => '/news', 'route_name' => 'news'],
            ['name' => 'Membership', 'slug' => '/membership', 'route_name' => 'member'],
            ['name' => 'Table Reservation', 'slug' => '/reservation', 'route_name' => 'reservation.index'],
            ['name' => 'PlayStation Booking', 'slug' => '/playstation', 'route_name' => 'playstation.index'],
            ['name' => 'Contact', 'slug' => '/contact', 'route_name' => 'contact'],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(['route_name' => $page['route_name']], $page);
        }
    }
}
