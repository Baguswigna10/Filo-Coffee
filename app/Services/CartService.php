<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class CartService
{
    /**
     * Get all cart items for the authenticated user.
     */
    public function getCart(): Collection
    {
        return Cart::with(['product', 'menu'])
            ->where('user_id', Auth::id())
            ->get();
    }

    /**
     * Get total price of all cart items.
     */
    public function getTotal(): float
    {
        return $this->getCart()->sum(fn ($item) => $item->subtotal);
    }

    /**
     * Get total number of items in cart.
     */
    public function getCount(): int
    {
        return Cart::where('user_id', Auth::id())->sum('quantity');
    }

    /**
     * Add item to cart. If item already exists, increment quantity.
     */
    public function addToCart(?int $productId, int $quantity, ?int $menuId = null): array
    {
        // Validate that the item exists
        if ($productId) {
            $product = Product::find($productId);
            if (!$product) {
                return ['success' => false, 'message' => 'Produk tidak ditemukan.'];
            }
            if ($product->stock < $quantity) {
                return ['success' => false, 'message' => 'Stok produk tidak mencukupi.'];
            }
        } elseif ($menuId) {
            $menu = Menu::find($menuId);
            if (!$menu) {
                return ['success' => false, 'message' => 'Menu tidak ditemukan.'];
            }
        } else {
            return ['success' => false, 'message' => 'Item tidak valid.'];
        }

        // Check if item already in cart
        $existing = Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->where('menu_id', $menuId)
            ->first();

        if ($existing) {
            $newQty = $existing->quantity + $quantity;

            // Check stock for products
            if ($productId && $product->stock < $newQty) {
                return ['success' => false, 'message' => 'Stok produk tidak mencukupi untuk jumlah tersebut.'];
            }

            $existing->update(['quantity' => $newQty]);
        } else {
            Cart::create([
                'user_id'    => Auth::id(),
                'product_id' => $productId,
                'menu_id'    => $menuId,
                'quantity'   => $quantity,
            ]);
        }

        return ['success' => true, 'message' => 'Item berhasil ditambahkan ke keranjang.'];
    }

    /**
     * Update quantity of a cart item. If quantity is 0, remove the item.
     */
    public function updateQuantity(int $cartId, int $quantity): array
    {
        $cartItem = Cart::where('id', $cartId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$cartItem) {
            return ['success' => false, 'message' => 'Item tidak ditemukan di keranjang.'];
        }

        if ($quantity <= 0) {
            $cartItem->delete();
            return ['success' => true, 'message' => 'Item dihapus dari keranjang.'];
        }

        // Check stock for products
        if ($cartItem->product_id) {
            $product = $cartItem->product;
            if ($product && $product->stock < $quantity) {
                return ['success' => false, 'message' => 'Stok produk tidak mencukupi.'];
            }
        }

        $cartItem->update(['quantity' => $quantity]);

        return ['success' => true, 'message' => 'Keranjang berhasil diperbarui.'];
    }

    /**
     * Remove a specific item from the cart.
     */
    public function removeItem(int $cartId): void
    {
        Cart::where('id', $cartId)
            ->where('user_id', Auth::id())
            ->delete();
    }

    /**
     * Clear all cart items for the authenticated user.
     */
    public function clearCart(): void
    {
        Cart::where('user_id', Auth::id())->delete();
    }
}
