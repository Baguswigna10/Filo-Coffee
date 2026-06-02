<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\PosTransaction;
use App\Models\PosTransactionItem;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PosController extends Controller
{
    public function __construct(private MidtransService $midtransService) {}

    public function index()
    {
        $menus = Menu::available()->orderBy('category')->orderBy('name')->get();
        return view('pos.index', compact('menus'));
    }

    /**
     * Store a CASH (tunai) transaction.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cart'          => 'required|array',
            'total_price'   => 'required|numeric',
            'cash_received' => 'required|numeric|min:' . $request->total_price,
            'cash_change'   => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $transaction = PosTransaction::create([
                'transaction_number' => PosTransaction::generateTransactionNumber(),
                'total_price'        => $request->total_price,
                'cash_received'      => $request->cash_received,
                'cash_change'        => $request->cash_change,
                'notes'              => $request->notes,
                'user_id'            => Auth::id(),
                'payment_method'     => 'Tunai',
            ]);

            foreach ($request->cart as $item) {
                PosTransactionItem::create([
                    'pos_transaction_id' => $transaction->id,
                    'menu_id'            => $item['id'],
                    'menu_name'          => $item['name'],
                    'price'              => $item['price'],
                    'quantity'           => $item['quantity'],
                    'subtotal'           => $item['price'] * $item['quantity'],
                ]);
            }

            DB::commit();
            return response()->json([
                'success'     => true,
                'message'     => 'Transaksi berhasil disimpan',
                'transaction' => $transaction,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan transaksi: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Create a pending QRIS transaction and return the Snap token.
     */
    public function createQris(Request $request)
    {
        $request->validate([
            'cart'        => 'required|array',
            'total_price' => 'required|numeric|min:1',
        ]);

        DB::beginTransaction();
        try {
            $transaction = PosTransaction::create([
                'transaction_number' => PosTransaction::generateTransactionNumber(),
                'total_price'        => $request->total_price,
                'cash_received'      => 0,
                'cash_change'        => 0,
                'notes'              => $request->notes ?? '',
                'user_id'            => Auth::id(),
                'payment_method'     => 'QRIS',
            ]);

            foreach ($request->cart as $item) {
                PosTransactionItem::create([
                    'pos_transaction_id' => $transaction->id,
                    'menu_id'            => $item['id'],
                    'menu_name'          => $item['name'],
                    'price'              => $item['price'],
                    'quantity'           => $item['quantity'],
                    'subtotal'           => $item['price'] * $item['quantity'],
                ]);
            }

            // Generate Midtrans Snap token
            $snapToken = $this->midtransService->generatePosQrisToken($transaction, $request->cart);
            $transaction->update(['midtrans_token' => $snapToken]);

            DB::commit();
            return response()->json([
                'success'            => true,
                'snap_token'         => $snapToken,
                'client_key'         => config('services.midtrans.client_key'),
                'transaction_number' => $transaction->transaction_number,
                'transaction_id'     => $transaction->id,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat transaksi QRIS: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Poll Midtrans for QRIS payment status.
     */
    public function checkQrisStatus($id)
    {
        $transaction = PosTransaction::findOrFail($id);

        // If it was already marked paid, just return success
        if ($transaction->payment_status === 'Paid') {
            return response()->json(['paid' => true, 'transaction_number' => $transaction->transaction_number]);
        }

        $status = $this->midtransService->checkPosTransactionStatus($transaction->transaction_number);

        $paid = in_array($status, ['settlement', 'capture']);

        return response()->json([
            'paid'               => $paid,
            'status'             => $status,
            'transaction_number' => $transaction->transaction_number,
        ]);
    }

    public function history()
    {
        $transactions = PosTransaction::with(['items', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('pos.history', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = PosTransaction::with(['items.menu', 'user'])->findOrFail($id);
        return view('pos.show', compact('transaction'));
    }
}
