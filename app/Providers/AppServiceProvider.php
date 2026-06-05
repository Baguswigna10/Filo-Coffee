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
        // Share visible pages to all views
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $visiblePages = [];
            if (\Illuminate\Support\Facades\Schema::hasTable('pages')) {
                $visiblePages = \App\Models\Page::where('is_visible', true)->pluck('route_name')->toArray();
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
