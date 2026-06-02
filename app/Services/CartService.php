<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function getCart(): \Illuminate\Database\Eloquent\Collection
    {
        return Cart::with(['product', 'menu'])
            ->where('user_id', Auth::id())
            ->get();
    }

    public function addToCart(?int $productId, int $quantity = 1, ?int $menuId = null): array
    {
        if ($productId) {
            $item = \App\Models\Product::active()->findOrFail($productId);
            $column = 'product_id';
            $id = $productId;
            
            if ($item->stock < $quantity) {
                return ['success' => false, 'message' => 'Stok tidak mencukupi.'];
            }
        } else {
            $item = \App\Models\Menu::available()->findOrFail($menuId);
            $column = 'menu_id';
            $id = $menuId;
        }

        $cartItem = Cart::where('user_id', Auth::id())
            ->where($column, $id)
            ->first();

        if ($cartItem) {
            $newQty = $cartItem->quantity + $quantity;
            if ($productId && $item->stock < $newQty) {
                return ['success' => false, 'message' => 'Stok tidak mencukupi.'];
            }
            $cartItem->update(['quantity' => $newQty]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                $column   => $id,
                'quantity' => $quantity,
            ]);
        }

        return ['success' => true, 'message' => ($productId ? 'Produk' : 'Menu') . ' ditambahkan ke keranjang!'];
    }

    public function updateQuantity(int $cartId, int $quantity): array
    {
        $cartItem = Cart::where('id', $cartId)->where('user_id', Auth::id())->firstOrFail();

        if ($quantity <= 0) {
            $cartItem->delete();
            return ['success' => true, 'message' => 'Item dihapus dari keranjang.'];
        }

        if ($cartItem->product_id && $cartItem->product->stock < $quantity) {
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
        return $this->getCart()->sum(function($item) {
            $price = $item->product_id ? $item->product->price : $item->menu->price;
            return $item->quantity * $price;
        });
    }

    public function getCount(): int
    {
        return Cart::where('user_id', Auth::id())->sum('quantity');
    }
}
