<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(private CartService $cartService) {}

    public function index()
    {
        $cartItems = $this->cartService->getCart();
        $total     = $this->cartService->getTotal();

        return view('pages.cart', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'menu_id'    => 'nullable|exists:menus,id',
            'quantity'   => 'required|integer|min:1|max:99',
        ]);

        if (!$request->product_id && !$request->menu_id) {
            return back()->with('error', 'Pilih item yang ingin dipesan.');
        }

        $result = $this->cartService->addToCart($request->product_id, $request->quantity, $request->menu_id);

        if ($request->expectsJson()) {
            return response()->json($result);
        }

        if ($result['success']) {
            if ($request->redirect_to === 'checkout') {
                return redirect()->route('checkout');
            }
            return back()->with('success', $result['message']);
        }

        return back()->with('error', $result['message']);
    }

    public function update(Request $request, int $cartId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0|max:99',
        ]);

        $result = $this->cartService->updateQuantity($cartId, $request->quantity);

        if ($request->expectsJson()) {
            return response()->json([
                ...$result,
                'total'     => $this->cartService->getTotal(),
                'cartCount' => $this->cartService->getCount(),
            ]);
        }

        return back()->with($result['success'] ? 'success' : 'error', $result['message']);
    }

    public function remove(int $cartId)
    {
        $this->cartService->removeItem($cartId);

        if (request()->expectsJson()) {
            return response()->json([
                'success'   => true,
                'total'     => $this->cartService->getTotal(),
                'cartCount' => $this->cartService->getCount(),
            ]);
        }

        return back()->with('success', 'Item dihapus dari keranjang.');
    }
}
