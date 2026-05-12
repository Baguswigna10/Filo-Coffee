<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(
        private CartService $cartService,
        private OrderService $orderService
    ) {}

    public function index()
    {
        $cartItems = $this->cartService->getCart();

        if ($cartItems->isEmpty()) {
            return redirect()->route('shop')->with('error', 'Keranjang Anda kosong.');
        }

        $subtotal = $this->cartService->getTotal();
        $shipping = 15000;
        $total    = $subtotal + $shipping;
        $user     = auth()->user();

        return view('pages.checkout', compact('cartItems', 'subtotal', 'shipping', 'total', 'user'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'recipient_name'   => 'required|string|max:100',
            'recipient_phone'  => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'shipping_city'    => 'required|string|max:100',
            'shipping_province'=> 'required|string|max:100',
            'shipping_zip'     => 'required|string|max:10',
            'payment_method'   => 'required|in:Transfer,COD,Midtrans',
            'notes'            => 'nullable|string|max:500',
        ]);

        try {
            $order = $this->orderService->createOrder($request->all());
            return redirect()->route('orders.show', $order->id)
                ->with('success', "Pesanan #{$order->order_number} berhasil dibuat!");
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}
