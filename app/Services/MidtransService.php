<?php

namespace App\Services;

use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey    = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized  = config('services.midtrans.is_sanitized');
        Config::$is3ds        = config('services.midtrans.is_3ds');
    }

    /**
     * Generate Midtrans Snap token for an order.
     */
    public function generateSnapToken(Order $order): string
    {
        $order->load(['items', 'user']);

        // Build item details for Midtrans
        $itemDetails = [];

        foreach ($order->items as $item) {
            $itemDetails[] = [
                'id'       => ($item->menu_id ? 'MENU-' : 'PROD-') . ($item->menu_id ?? $item->product_id),
                'price'    => (int) $item->price,
                'quantity' => $item->quantity,
                'name'     => mb_substr($item->product_name, 0, 50),
            ];
        }

        // Add shipping cost as an item
        if ($order->shipping_cost > 0) {
            $itemDetails[] = [
                'id'       => 'SHIPPING',
                'price'    => (int) $order->shipping_cost,
                'quantity' => 1,
                'name'     => 'Biaya Pengiriman',
            ];
        }

        $params = [
            'transaction_details' => [
                'order_id'     => $order->order_number,
                'gross_amount' => (int) $order->total_price,
            ],
            'item_details'    => $itemDetails,
            'customer_details' => [
                'first_name' => $order->recipient_name,
                'phone'      => $order->recipient_phone,
                'email'      => $order->user->email ?? 'customer@filocoffee.com',
                'shipping_address' => [
                    'first_name' => $order->recipient_name,
                    'phone'      => $order->recipient_phone,
                    'address'    => $order->shipping_address,
                    'city'       => $order->shipping_city,
                    'postal_code'=> $order->shipping_zip,
                    'country_code' => 'IDN',
                ],
            ],
            'callbacks' => [
                'finish' => route('orders.show', $order->id),
            ],
        ];

        return Snap::getSnapToken($params);
    }

    /**
     * Parse and verify Midtrans notification payload.
     * Returns the notification object if valid, throws on failure.
     */
    public function parseNotification(): Notification
    {
        return new Notification();
    }
}
