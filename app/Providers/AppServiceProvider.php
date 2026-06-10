<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\CartService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CartService::class);
    }

    public function boot(): void
    {
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Share visible pages to all views
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            // Semua route yang dikenal oleh sistem navigasi
            $allKnownRoutes = [
                'home', 'about', 'menu', 'shop', 'services',
                'news', 'member', 'reservation.index', 'playstation.index', 'contact',
            ];

            $visiblePages = $allKnownRoutes; // default: tampilkan semua

            if (\Illuminate\Support\Facades\Schema::hasTable('pages')) {
                $dbPages = \App\Models\Page::where('is_visible', true)->pluck('route_name')->toArray();
                // Hanya gunakan data dari DB jika tabel tidak kosong
                if (!empty($dbPages)) {
                    $visiblePages = $dbPages;
                }
            }

            $view->with('visiblePages', $visiblePages);
        });

        // Share cart count to all views
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            if (auth()->check()) {
                $cartService = app(CartService::class);
                $view->with('globalCartCount', $cartService->getCount());
            }
        });
    }
}
