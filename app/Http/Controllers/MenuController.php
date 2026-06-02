<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query    = Menu::available()->orderBy('category')->orderBy('sort_order');
        $category = $request->get('category', 'all');

        if ($category !== 'all') {
            $query->where('category', $category);
        }

        $menus      = $query->get();
        $categories = Menu::available()->distinct()->pluck('category');

        return view('pages.menu', compact('menus', 'categories', 'category'));
    }

    public function show(Menu $menu)
    {
        if (!$menu->is_available) {
            abort(404);
        }
        return view('pages.menu-detail', compact('menu'));
    }
}
