<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredMenus    = Menu::available()->featured()->orderBy('sort_order')->take(6)->get();
        $featuredProducts = Product::featured()->inStock()->take(4)->get();

        return view('pages.home', compact('featuredMenus', 'featuredProducts'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        // In production: send email via Mail::to(...)->send(...)
        return back()->with('success', 'Pesan Anda telah terkirim! Kami akan segera membalas.');
    }
}
