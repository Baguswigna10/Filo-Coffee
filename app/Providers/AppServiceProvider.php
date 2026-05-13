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
        // Share cart count to all views
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $cartService = app(CartService::class);
                $view->with('globalCartCount', $cartService->getCount());
            }
        });
    }
}
