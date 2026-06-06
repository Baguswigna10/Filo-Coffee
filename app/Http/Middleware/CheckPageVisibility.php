<?php

namespace App\Http\Middleware;

use App\Models\Page;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckPageVisibility
{
    public function handle(Request $request, Closure $next): Response
    {
        $currentRoute = Route::currentRouteName();

        if (!$currentRoute) {
            return $next($request);
        }

        // Periksa juga parent route (misal: 'menu.show' -> cek 'menu')
        $routeParts = explode('.', $currentRoute);
        $routeBase  = $routeParts[0];

        // Coba cari halaman dengan route_name exact atau route_name parent
        $page = Page::where('route_name', $currentRoute)->first()
             ?? Page::where('route_name', $routeBase)->first()
             ?? Page::where('route_name', $routeBase . '.index')->first();

        // Jika halaman ditemukan dan is_visible = false
        if ($page && !$page->is_visible) {
            // Berikan akses hanya jika user adalah admin (agar bisa testing)
            if (!auth()->check() || !auth()->user()->isAdmin()) {
                abort(404);
            }
        }

        return $next($request);
    }
}
