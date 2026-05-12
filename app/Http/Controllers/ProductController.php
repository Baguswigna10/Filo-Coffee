<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query     = Product::active()->inStock();
        $roast     = $request->get('roast', 'all');
        $sort      = $request->get('sort', 'newest');

        if ($roast !== 'all') {
            $query->where('roast_level', $roast);
        }

        match($sort) {
            'price_asc'  => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'popular'    => $query->orderBy('id', 'desc'),
            default      => $query->latest(),
        };

        $products = $query->paginate(12);
        $roasts   = ['Light', 'Medium', 'Medium-Dark', 'Dark'];

        return view('pages.shop', compact('products', 'roasts', 'roast', 'sort'));
    }

    public function show(Product $product)
    {
        if (!$product->is_active) {
            abort(404);
        }

        $related = Product::active()
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('pages.product-detail', compact('product', 'related'));
    }
}
