<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\PosTransaction;
use App\Models\PosTransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PosController extends Controller
{
    public function index()
    {
        $menus = Menu::available()->orderBy('category')->orderBy('name')->get();
        return view('pos.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cart' => 'required|array',
            'total_price' => 'required|numeric',
            'cash_received' => 'required|numeric|min:' . $request->total_price,
            'cash_change' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $transaction = PosTransaction::create([
                'transaction_number' => PosTransaction::generateTransactionNumber(),
                'total_price' => $request->total_price,
                'cash_received' => $request->cash_received,
                'cash_change' => $request->cash_change,
                'notes' => $request->notes,
                'user_id' => Auth::id(),
            ]);

            foreach ($request->cart as $item) {
                PosTransactionItem::create([
                    'pos_transaction_id' => $transaction->id,
                    'menu_id' => $item['id'],
                    'menu_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan',
                'transaction' => $transaction
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan transaksi: ' . $e->getMessage()
            ], 500);
        }
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
