<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Services\MidtransService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(
        private CartService $cartService,
        private OrderService $orderService,
        private MidtransService $midtransService
    ) {}

    public function index()
    {
        $cartItems = $this->cartService->getCart();

        if ($cartItems->isEmpty()) {
            return redirect()->route('shop')->with('error', 'Keranjang Anda kosong.');
        }

        $subtotal = $this->cartService->getTotal();
        $shipping = 8000; // Default base fee
        $total    = $subtotal + $shipping;
        $user     = auth()->user();
        $shopLocation = config('services.shop');

        return view('pages.checkout', compact('cartItems', 'subtotal', 'shipping', 'total', 'user', 'shopLocation'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'recipient_name'    => 'required|string|max:100',
            'recipient_phone'   => 'required|string|max:20',
            'shipping_address'  => 'required|string|max:500',
            'shipping_city'     => 'required|string|max:100',
            'shipping_province' => 'required|string|max:100',
            'shipping_zip'      => 'required|string|max:10',
            'payment_method'    => 'required|in:Transfer,COD,Midtrans',
            'shipping_cost'     => 'required|numeric|min:0',
            'notes'             => 'nullable|string|max:500',
        ]);

        try {
            $order = $this->orderService->createOrder($request->all());

            // If Midtrans selected, generate QRIS image URL immediately via Core API
            if ($request->payment_method === 'Midtrans') {
                try {
                    $qrCodeUrl = $this->midtransService->chargeOrderQris($order);
                    $order->update(['midtrans_token' => $qrCodeUrl]);
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Midtrans QRIS error: ' . $e->getMessage());
                }
            }

            return redirect()->route('orders.show', $order->id)
                ->with('success', "Pesanan #{$order->order_number} berhasil dibuat!");
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}
