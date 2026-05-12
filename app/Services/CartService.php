<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function getCart(): \Illuminate\Database\Eloquent\Collection
    {
        return Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();
    }

    public function addToCart(int $productId, int $quantity = 1): array
    {
        $product = Product::active()->findOrFail($productId);

        if ($product->stock < $quantity) {
            return ['success' => false, 'message' => 'Stok tidak mencukupi.'];
        }

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $newQty = $cartItem->quantity + $quantity;
            if ($product->stock < $newQty) {
                return ['success' => false, 'message' => 'Stok tidak mencukupi.'];
            }
            $cartItem->update(['quantity' => $newQty]);
        } else {
            Cart::create([
                'user_id'    => Auth::id(),
                'product_id' => $productId,
                'quantity'   => $quantity,
            ]);
        }

        return ['success' => true, 'message' => 'Produk ditambahkan ke keranjang!'];
    }

    public function updateQuantity(int $cartId, int $quantity): array
    {
        $cartItem = Cart::where('id', $cartId)->where('user_id', Auth::id())->firstOrFail();

        if ($quantity <= 0) {
            $cartItem->delete();
            return ['success' => true, 'message' => 'Item dihapus dari keranjang.'];
        }

        if ($cartItem->product->stock < $quantity) {
            return ['success' => false, 'message' => 'Stok tidak mencukupi.'];
        }

        $cartItem->update(['quantity' => $quantity]);
        return ['success' => true, 'message' => 'Keranjang diperbarui.'];
    }

    public function removeItem(int $cartId): void
    {
        Cart::where('id', $cartId)->where('user_id', Auth::id())->delete();
    }

    public function clearCart(): void
    {
        Cart::where('user_id', Auth::id())->delete();
    }

    public function getTotal(): float
    {
        return $this->getCart()->sum(fn($item) => $item->quantity * $item->product->price);
    }

    public function getCount(): int
    {
        return Cart::where('user_id', Auth::id())->sum('quantity');
    }
}
