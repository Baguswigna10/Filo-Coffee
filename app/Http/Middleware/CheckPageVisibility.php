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

        // Ambil data halaman berdasarkan route name
        $page = Page::where('route_name', $currentRoute)->first();

        // Jika halaman ditemukan dan is_visible = false
        if ($page && !$page->is_visible) {
            // Berikan akses hanya jika user adalah admin (agar bisa testing)
            // Jika Anda ingin benar-benar 404 untuk semua orang, hapus kondisi !auth()->user()?->isAdmin()
            if (!auth()->check() || !auth()->user()->isAdmin()) {
                abort(404);
            }
        }

        return $next($request);
    }
}
