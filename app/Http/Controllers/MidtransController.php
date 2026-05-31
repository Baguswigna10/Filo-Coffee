<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\MidtransService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function __construct(
        private MidtransService $midtransService,
        private OrderService $orderService
    ) {}

    /**
     * Webhook: Midtrans sends payment notification here.
     * Route: POST /midtrans/notification
     * Must be exempt from CSRF.
     */
    public function notification(Request $request)
    {
        try {
            $notification = $this->midtransService->parseNotification();

            $transactionStatus = $notification->transaction_status;
            $fraudStatus       = $notification->fraud_status;
            $orderId           = $notification->order_id; // This is our order_number

            $order = Order::where('order_number', $orderId)->firstOrFail();

            Log::info("Midtrans Notification — OrderNumber: {$orderId} | Status: {$transactionStatus} | Fraud: {$fraudStatus}");

            if ($transactionStatus === 'capture') {
                if ($fraudStatus === 'accept') {
                    $this->orderService->updateStatus($order, 'Paid');
                }
            } elseif ($transactionStatus === 'settlement') {
                $this->orderService->updateStatus($order, 'Paid');
            } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
                $this->orderService->updateStatus($order, 'Cancelled');
            } elseif ($transactionStatus === 'pending') {
                // Stay as Pending — nothing to update
            }

            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            Log::error('Midtrans notification error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Generate (or refresh) a Snap token for an existing pending Midtrans order.
     * Route: POST /midtrans/pay/{order}
     * Used when user revisits order-detail and wants to trigger payment popup.
     */
    public function pay(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if ($order->status !== 'Pending' || $order->payment_method !== 'Midtrans') {
            return response()->json(['error' => 'Order tidak valid untuk pembayaran Midtrans.'], 422);
        }

        try {
            // Re-generate token if expired or missing
            $snapToken = $this->midtransService->generateSnapToken($order);
            $order->update(['midtrans_token' => $snapToken]);

            return response()->json([
                'snap_token' => $snapToken,
                'client_key' => config('services.midtrans.client_key'),
                'is_production' => config('services.midtrans.is_production'),
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans pay error: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal membuat token pembayaran: ' . $e->getMessage()], 500);
        }
    }
}
