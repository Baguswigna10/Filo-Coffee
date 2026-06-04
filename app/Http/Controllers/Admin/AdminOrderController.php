<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PsReservation;
use App\Models\TableReservation;
use App\Models\PosTransaction;
use App\Services\OrderService;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function __construct(private OrderService $orderService) {}

    public function index(Request $request)
    {
        $type = $request->get('type', 'all'); // all, menu, beans, ps, table, pos
        $dateFilter = $request->get('date_filter'); // today, this_week, this_month, this_year
        $status = $request->get('status');
        $search = $request->get('search');

        $ordersQuery = Order::with('user');
        $psQuery = PsReservation::with('user');
        $tableQuery = TableReservation::with('user');
        $posQuery = PosTransaction::with('user');

        // Apply search filter
        if ($search) {
            $ordersQuery->where('order_number', 'like', "%{$search}%");
            $psQuery->where('reservation_code', 'like', "%{$search}%");
            $tableQuery->where('reservation_code', 'like', "%{$search}%");
            $posQuery->where('transaction_number', 'like', "%{$search}%");
        }

        // Apply status filter
        if ($status) {
            $ordersQuery->where('status', $status);
            $psQuery->where('status', $status);
            $tableQuery->where('status', $status);
            // POS transactions are always Completed/Paid. If they filter by something else, POS won't show.
        }

        // Apply date filter
        if ($dateFilter) {
            switch ($dateFilter) {
                case 'today':
                    $ordersQuery->whereDate('created_at', today());
                    $psQuery->whereDate('created_at', today());
                    $tableQuery->whereDate('created_at', today());
                    $posQuery->whereDate('created_at', today());
                    break;
                case 'this_week':
                    $ordersQuery->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    $psQuery->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    $tableQuery->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    $posQuery->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'this_month':
                    $ordersQuery->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
                    $psQuery->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
                    $tableQuery->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
                    $posQuery->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
                    break;
                case 'this_year':
                    $ordersQuery->whereYear('created_at', now()->year);
                    $psQuery->whereYear('created_at', now()->year);
                    $tableQuery->whereYear('created_at', now()->year);
                    $posQuery->whereYear('created_at', now()->year);
                    break;
            }
        }

        // Gather records depending on the type filter
        $records = collect();

        // 1. Menu Orders (contains items with menu_id)
        if ($type === 'all' || $type === 'menu') {
            $ordersQueryCopy = clone $ordersQuery;
            $menuOrders = $ordersQueryCopy->whereHas('items', fn($q) => $q->whereNotNull('menu_id'))->get();
            foreach ($menuOrders as $order) {
                $records->push([
                    'id' => $order->id,
                    'code' => $order->order_number,
                    'customer' => $order->user->name ?? 'Guest',
                    'type' => 'Pesanan Menu',
                    'type_raw' => 'menu',
                    'total_price' => $order->total_price,
                    'payment_method' => $order->payment_method,
                    'status' => $order->status,
                    'date' => $order->created_at->format('Y-m-d H:i'),
                    'created_at' => $order->created_at,
                    'show_url' => route('admin.orders.show', $order->id),
                ]);
            }
        }

        // 2. Shop Beans Purchases (contains items with product_id)
        if ($type === 'all' || $type === 'beans') {
            $ordersQueryCopy = clone $ordersQuery;
            $beanOrders = $ordersQueryCopy->whereHas('items', fn($q) => $q->whereNotNull('product_id'))->get();
            foreach ($beanOrders as $order) {
                $records->push([
                    'id' => $order->id,
                    'code' => $order->order_number,
                    'customer' => $order->user->name ?? 'Guest',
                    'type' => 'Shop Beans',
                    'type_raw' => 'beans',
                    'total_price' => $order->total_price,
                    'payment_method' => $order->payment_method,
                    'status' => $order->status,
                    'date' => $order->created_at->format('Y-m-d H:i'),
                    'created_at' => $order->created_at,
                    'show_url' => route('admin.orders.show', $order->id),
                ]);
            }
        }

        // 3. PlayStation Bookings
        if ($type === 'all' || $type === 'ps') {
            $psReservations = $psQuery->get();
            foreach ($psReservations as $res) {
                $records->push([
                    'id' => $res->id,
                    'code' => $res->reservation_code,
                    'customer' => $res->name ?? ($res->user->name ?? 'Guest'),
                    'type' => 'PlayStation ' . $res->console_type,
                    'type_raw' => 'ps',
                    'total_price' => $res->total_price,
                    'payment_method' => 'Midtrans / Transfer',
                    'status' => $res->status,
                    'date' => $res->created_at->format('Y-m-d H:i'),
                    'created_at' => $res->created_at,
                    'show_url' => route('admin.reservations.ps'),
                ]);
            }
        }

        // 4. Table Reservations
        if ($type === 'all' || $type === 'table') {
            $tableReservations = $tableQuery->get();
            foreach ($tableReservations as $res) {
                $records->push([
                    'id' => $res->id,
                    'code' => $res->reservation_code,
                    'customer' => $res->name ?? ($res->user->name ?? 'Guest'),
                    'type' => 'Reservasi Meja (' . $res->area . ')',
                    'type_raw' => 'table',
                    'total_price' => 0.00,
                    'payment_method' => 'Gratis / Free',
                    'status' => $res->status,
                    'date' => $res->created_at->format('Y-m-d H:i'),
                    'created_at' => $res->created_at,
                    'show_url' => route('admin.reservations.tables'),
                ]);
            }
        }

        // 5. Cashier / POS Transactions
        if ($type === 'all' || $type === 'pos') {
            if (!$status || in_array($status, ['Completed', 'Paid'])) {
                $posTransactions = $posQuery->get();
                foreach ($posTransactions as $res) {
                    $records->push([
                        'id' => $res->id,
                        'code' => $res->transaction_number,
                        'customer' => 'Kasir (' . ($res->user->name ?? 'Staff') . ')',
                        'type' => 'Pemesanan Kasir (POS)',
                        'type_raw' => 'pos',
                        'total_price' => $res->total_price,
                        'payment_method' => 'Tunai / Cash',
                        'status' => 'Completed',
                        'date' => $res->created_at->format('Y-m-d H:i'),
                        'created_at' => $res->created_at,
                        'show_url' => route('admin.pos.show', $res->id),
                    ]);
                }
            }
        }

        // Sort by created_at descending
        $records = $records->sortByDesc('created_at');

        // Check if export to CSV is requested
        if ($request->get('export') === 'csv') {
            return $this->exportCsv($records);
        }

        // Paginate manually
        $page = (int) $request->get('page', 1);
        $perPage = 15;
        $sliced = $records->slice(($page - 1) * $perPage, $perPage)->values();
        
        $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $sliced,
            $records->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.orders.index', [
            'records' => $paginated,
            'type' => $type,
            'dateFilter' => $dateFilter,
            'status' => $status,
            'search' => $search
        ]);
    }

    private function exportCsv($records)
    {
        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=laporan-penjualan-" . date('Y-m-d') . ".csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Nomor Transaksi / Booking', 'Pelanggan', 'Tipe', 'Total Pembayaran', 'Metode Bayar', 'Status', 'Tanggal'];

        $callback = function() use($records, $columns) {
            $file = fopen('php://output', 'w');
            
            // Add BOM to support UTF-8 in Excel
            fputs($file, "\xEF\xBB\xBF");
            
            fputcsv($file, $columns, ';');

            $totalRevenue = 0;

            foreach ($records as $record) {
                $totalRevenue += (float) $record['total_price'];
                
                fputcsv($file, [
                    $record['code'],
                    $record['customer'],
                    $record['type'],
                    (float) $record['total_price'], // Raw number so Excel can do math
                    $record['payment_method'],
                    $record['status'],
                    $record['date']
                ], ';');
            }

            // Bottom TOTAL row
            fputcsv($file, [
                'TOTAL PENJUALAN & RESERVASI',
                '',
                '',
                $totalRevenue,
                '',
                '',
                ''
            ], ';');

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product', 'items.menu']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:Pending,Paid,Processing,Shipped,Completed,Cancelled',
        ]);

        $this->orderService->updateStatus($order, $request->status);

        return back()->with('success', "Status pesanan diperbarui ke: {$request->status}");
    }
}
