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
    public function pay(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // First sync payment status to see if it is already paid on Midtrans
        try {
            $this->midtransService->syncPaymentStatus($order);
        } catch (\Exception $e) {
            Log::warning('Midtrans sync status on pay error: ' . $e->getMessage());
        }

        $freshOrder = $order->fresh();

        // If status has updated to Paid, trigger frontend redirect
        if ($freshOrder->status === 'Paid') {
            return response()->json([
                'error'    => 'Pesanan ini sudah berhasil dibayar! Halaman akan dimuat ulang.',
                'redirect' => true,
            ], 422);
        }

        if ($freshOrder->status !== 'Pending' || $freshOrder->payment_method !== 'Midtrans') {
            return response()->json(['error' => 'Order tidak valid untuk pembayaran Midtrans.'], 422);
        }

        // If frontend is just polling status (QRIS already shown), skip re-generation
        $checkOnly = $request->boolean('check_status');
        if ($checkOnly) {
            // If already have a QR URL, just return it (or nothing if only checking)
            if ($freshOrder->midtrans_token && str_starts_with($freshOrder->midtrans_token, 'http')) {
                return response()->json(['qr_code_url' => $freshOrder->midtrans_token]);
            }
            return response()->json(['qr_code_url' => null]);
        }

        try {
            // Reuse existing QRIS URL if present (must start with http/https), otherwise generate a new one
            $qrCodeUrl = $freshOrder->midtrans_token;
            if (!$qrCodeUrl || !str_starts_with($qrCodeUrl, 'http')) {
                $qrCodeUrl = $this->midtransService->chargeOrderQris($freshOrder);
                $freshOrder->update(['midtrans_token' => $qrCodeUrl]);
            }

            return response()->json([
                'qr_code_url' => $qrCodeUrl,
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans pay error: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal membuat QRIS pembayaran: ' . $e->getMessage()], 500);
        }
    }
}
