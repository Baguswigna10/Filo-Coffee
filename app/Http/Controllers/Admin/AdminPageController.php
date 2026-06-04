<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function toggle(Request $request, Page $page)
    {
        $page->update([
            'is_visible' => !$page->is_visible
        ]);

        return back()->with('success', "Status visibilitas halaman {$page->name} berhasil diperbarui.");
    }
}
