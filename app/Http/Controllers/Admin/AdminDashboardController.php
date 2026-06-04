<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\TableReservation;
use App\Models\PsReservation;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Overview Stats
        $totalRevenue     = Order::whereIn('status', ['Paid', 'Processing', 'Shipped', 'Completed'])->sum('total_price');
        $totalOrders      = Order::count();
        $pendingOrders    = Order::where('status', 'Pending')->count();
        $totalUsers       = User::where('role', 'user')->count();
        $pendingTables    = TableReservation::where('status', 'Pending')->count();
        $pendingPs        = PsReservation::where('status', 'Pending')->count();
        $lowStockProducts = Product::where('stock', '<=', 5)->where('is_active', true)->count();

        // Daily revenue - last 7 days
        $dailyRevenue = Order::whereIn('status', ['Paid', 'Processing', 'Shipped', 'Completed'])
            ->where('created_at', '>=', now()->subDays(7))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_price) as revenue'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Recent orders
        $recentOrders = Order::with('user')->latest()->take(10)->get();

        // Top products
        $topProducts = DB::table('order_items')
            ->select('product_name', DB::raw('SUM(quantity) as total_sold'), DB::raw('SUM(subtotal) as total_revenue'))
            ->groupBy('product_name')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalRevenue', 'totalOrders', 'pendingOrders', 'totalUsers',
            'pendingTables', 'pendingPs', 'lowStockProducts',
            'dailyRevenue', 'recentOrders', 'topProducts'
        ));
    }
}
