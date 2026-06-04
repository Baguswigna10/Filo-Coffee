<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->when($request->roast, fn($q) => $q->where('roast_level', $request->roast))
            ->latest()
            ->paginate(20);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.form', ['product' => new Product()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateProduct($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validateProduct($request);

        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    private function validateProduct(Request $request): array
    {
        return $request->validate([
            'name'         => 'required|string|max:150',
            'origin'       => 'required|string|max:100',
            'roast_level'  => 'required|in:Light,Medium,Medium-Dark,Dark',
            'flavor_notes' => 'required|string|max:200',
            'description'  => 'nullable|string|max:1000',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'weight_grams' => 'required|numeric|min:0',
            'image'        => 'nullable|image|max:2048',
            'is_active'    => 'boolean',
            'is_featured'  => 'boolean',
        ]);
    }
}
