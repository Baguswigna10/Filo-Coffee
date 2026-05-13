<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMenuController extends Controller
{
    public function index(Request $request)
    {
        $menus = Menu::when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->when($request->category, fn($q) => $q->where('category', $request->category))
            ->orderBy('category')->orderBy('sort_order')
            ->paginate(20);

        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.form', ['menu' => new Menu()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateMenu($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        Menu::create($data);
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menus.form', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $data = $this->validateMenu($request);

        if ($request->hasFile('image')) {
            if ($menu->image) Storage::disk('public')->delete($menu->image);
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu->update($data);
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->image) Storage::disk('public')->delete($menu->image);
        $menu->delete();
        return back()->with('success', 'Menu berhasil dihapus.');
    }

    private function validateMenu(Request $request): array
    {
        return $request->validate([
            'name'         => 'required|string|max:150',
            'category'     => 'required|in:Coffee,Non-Coffee,Food,Dessert,Seasonal',
            'description'  => 'nullable|string|max:1000',
            'price'        => 'required|numeric|min:0',
            'image'        => 'nullable|image|max:2048',
            'is_available' => 'boolean',
            'is_featured'  => 'boolean',
            'sort_order'   => 'integer|min:0',
        ]);
    }
}
