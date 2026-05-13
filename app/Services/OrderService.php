<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function __construct(private CartService $cartService) {}

    public function createOrder(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            $cartItems = $this->cartService->getCart();

            if ($cartItems->isEmpty()) {
                throw new \Exception('Keranjang kosong.');
            }

            // Validate stock
            foreach ($cartItems as $item) {
                if ($item->product->stock < $item->quantity) {
                    throw new \Exception("Stok {$item->product->name} tidak mencukupi.");
                }
            }

            $subtotal = $cartItems->sum(fn($i) => $i->quantity * $i->product->price);
            $shippingCost = $data['shipping_cost'] ?? 15000;
            $total = $subtotal + $shippingCost;

            $order = Order::create([
                'order_number'     => Order::generateOrderNumber(),
                'user_id'          => Auth::id(),
                'subtotal'         => $subtotal,
                'shipping_cost'    => $shippingCost,
                'total_price'      => $total,
                'payment_method'   => $data['payment_method'],
                'status'           => 'Pending',
                'shipping_address' => $data['shipping_address'],
                'shipping_city'    => $data['shipping_city'],
                'shipping_province'=> $data['shipping_province'],
                'shipping_zip'     => $data['shipping_zip'],
                'recipient_name'   => $data['recipient_name'],
                'recipient_phone'  => $data['recipient_phone'],
                'notes'            => $data['notes'] ?? null,
            ]);

            // Create order items & reduce stock
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item->product_id,
                    'product_name' => $item->product->name,
                    'quantity'     => $item->quantity,
                    'price'        => $item->product->price,
                    'subtotal'     => $item->quantity * $item->product->price,
                ]);

                // Reduce stock (Observer also handles this)
                $item->product->decrement('stock', $item->quantity);
            }

            // Clear cart
            $this->cartService->clearCart();

            return $order->fresh();
        });
    }

    public function updateStatus(Order $order, string $status): Order
    {
        $data = ['status' => $status];

        if ($status === 'Paid') {
            $data['paid_at'] = now();
        } elseif ($status === 'Shipped') {
            $data['shipped_at'] = now();
        } elseif ($status === 'Completed') {
            $data['completed_at'] = now();
        }

        $order->update($data);
        return $order->fresh();
    }
}
