@extends('admin.layout')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan performa bisnis Anda')

@section('content')
<div class="flex justify-end mb-8">
    <a href="{{ route('admin.pos.index') }}" class="bg-mocca text-dark px-8 py-4 rounded-2xl font-bold flex items-center gap-3 group shadow-2xl shadow-mocca/10 hover:-translate-y-1 transition-all duration-300">
        <svg class="w-6 h-6 transition-transform duration-500 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
        <span class="tracking-wide">Buka Kasir Mode</span>
    </a>
</div>

{{-- Stats Grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10 stagger-children">
    @php
    $stats = [
        ['label' => 'Total Revenue', 'value' => 'Rp ' . number_format($totalRevenue, 0, ',', '.'), 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>', 'color' => 'text-emerald-400', 'bg' => 'bg-emerald-500/10', 'ring' => 'ring-emerald-500/20'],
        ['label' => 'Total Pesanan', 'value' => $totalOrders, 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>', 'sub' => $pendingOrders . ' pending', 'color' => 'text-blue-400', 'bg' => 'bg-blue-500/10', 'ring' => 'ring-blue-500/20'],
        ['label' => 'Total Member', 'value' => $totalUsers, 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>', 'color' => 'text-purple-400', 'bg' => 'bg-purple-500/10', 'ring' => 'ring-purple-500/20'],
        ['label' => 'Stok Menipis', 'value' => $lowStockProducts . ' produk', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>', 'color' => 'text-amber-400', 'bg' => 'bg-amber-500/10', 'ring' => 'ring-amber-500/20'],
    ];
    @endphp

    @foreach($stats as $stat)
    <div class="stat-card group">
        <div class="flex items-center justify-between mb-5">
            <div class="w-12 h-12 {{ $stat['bg'] }} rounded-2xl flex items-center justify-center ring-1 {{ $stat['ring'] }} {{ $stat['color'] }} transition-transform duration-500 group-hover:scale-110">
                {!! $stat['icon'] !!}
            </div>
            <span class="text-[0.6rem] font-bold text-cream/20 uppercase tracking-[0.2em]">{{ $stat['label'] }}</span>
        </div>
        <div class="font-display text-2xl font-bold text-cream mb-1">{{ $stat['value'] }}</div>
        @if(isset($stat['sub']))
        <div class="text-cream/20 text-[0.65rem] font-medium tracking-wide">{{ $stat['sub'] }}</div>
        @else
        <div class="text-cream/10 text-[0.65rem] font-medium tracking-wide">Update terbaru hari ini</div>
        @endif
    </div>
    @endforeach
</div>

{{-- Pending Alerts --}}
@if($pendingOrders > 0 || $pendingTables > 0 || $pendingPs > 0)
<div class="bg-amber-500/[0.03] border border-amber-500/10 rounded-[2rem] p-6 mb-10 animate-fade-in-up">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-2.5 h-2.5 bg-amber-400 rounded-full animate-pulse shadow-[0_0_12px_rgba(251,191,36,0.5)]"></div>
        <span class="text-amber-400 text-[0.65rem] font-bold uppercase tracking-[0.2em]">Menunggu Konfirmasi</span>
    </div>
    <div class="flex flex-wrap gap-6">
        @if($pendingOrders > 0)
        <a href="{{ route('admin.orders.index', ['status' => 'Pending']) }}" class="flex items-center gap-3 group">
            <span class="w-9 h-9 bg-amber-500/10 rounded-xl flex items-center justify-center text-xs font-bold text-amber-400 ring-1 ring-amber-500/20 transition-all duration-300 group-hover:ring-amber-500/40">{{ $pendingOrders }}</span>
            <span class="text-cream/40 text-sm font-medium group-hover:text-amber-400 transition-colors">Pesanan Pending</span>
        </a>
        @endif
        @if($pendingTables > 0)
        <a href="{{ route('admin.reservations.tables', ['status' => 'Pending']) }}" class="flex items-center gap-3 group">
            <span class="w-9 h-9 bg-amber-500/10 rounded-xl flex items-center justify-center text-xs font-bold text-amber-400 ring-1 ring-amber-500/20 transition-all duration-300 group-hover:ring-amber-500/40">{{ $pendingTables }}</span>
            <span class="text-cream/40 text-sm font-medium group-hover:text-amber-400 transition-colors">Reservasi Meja Pending</span>
        </a>
        @endif
        @if($pendingPs > 0)
        <a href="{{ route('admin.reservations.ps', ['status' => 'Pending']) }}" class="flex items-center gap-3 group">
            <span class="w-9 h-9 bg-amber-500/10 rounded-xl flex items-center justify-center text-xs font-bold text-amber-400 ring-1 ring-amber-500/20 transition-all duration-300 group-hover:ring-amber-500/40">{{ $pendingPs }}</span>
            <span class="text-cream/40 text-sm font-medium group-hover:text-amber-400 transition-colors">Booking PS Pending</span>
        </a>
        @endif
    </div>
</div>
@endif

<div class="grid lg:grid-cols-3 gap-8">
    {{-- Recent Orders --}}
    <div class="lg:col-span-2 bg-dark-light/30 border border-white/[0.04] rounded-[2.5rem] overflow-hidden animate-fade-in-up" style="animation-delay: 0.15s">
        <div class="flex items-center justify-between px-8 py-6 border-b border-white/[0.04]">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-mocca/10 rounded-xl flex items-center justify-center ring-1 ring-mocca/20">
                    <svg class="w-5 h-5 text-mocca" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <h3 class="font-display text-lg text-cream font-bold tracking-tight">Pesanan Terbaru</h3>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="text-mocca/50 hover:text-mocca text-[0.65rem] font-bold uppercase tracking-[0.2em] transition-all duration-300 flex items-center gap-2 group">
                View All
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr class="border-b border-white/[0.02]">
                        <th class="text-left py-5">Order #</th>
                        <th class="text-left py-5">Pelanggan</th>
                        <th class="text-left py-5">Total</th>
                        <th class="text-left py-5">Status</th>
                        <th class="text-left py-5">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.02]">
                    @foreach($recentOrders as $order)
                    <tr class="hover:bg-white/[0.01] transition-colors">
                        <td class="py-5">
                            <a href="{{ route('admin.orders.show', $order) }}" class="text-mocca hover:text-mocca-dark font-bold transition-colors">{{ $order->order_number }}</a>
                        </td>
                        <td class="text-cream/40 py-5 font-medium">{{ $order->user->name }}</td>
                        <td class="text-cream py-5 font-bold">{{ $order->formatted_total }}</td>
                        <td class="py-5">
                            <span class="badge badge-{{ $order->status }} scale-90">{{ $order->status }}</span>
                        </td>
                        <td class="text-cream/20 py-5 text-xs font-medium">{{ $order->created_at->format('d M, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Top Products --}}
    <div class="bg-dark-light/30 border border-white/[0.04] rounded-[2.5rem] overflow-hidden animate-fade-in-up" style="animation-delay: 0.25s">
        <div class="flex items-center gap-4 px-8 py-6 border-b border-white/[0.04]">
            <div class="w-10 h-10 bg-mocca/10 rounded-xl flex items-center justify-center ring-1 ring-mocca/20">
                <svg class="w-5 h-5 text-mocca" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
            <h3 class="font-display text-lg text-cream font-bold tracking-tight">Top Products</h3>
        </div>
        <div class="p-6 space-y-4">
            @forelse($topProducts as $i => $product)
            <div class="flex items-center gap-4 p-4 rounded-2xl hover:bg-white/[0.02] transition-all duration-300 group border border-transparent hover:border-white/[0.04]">
                <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-mocca/20 to-mocca/5 text-mocca text-xs font-bold flex items-center justify-center flex-shrink-0 ring-1 ring-mocca/20 group-hover:scale-110 transition-transform">{{ $i+1 }}</span>
                <div class="flex-1 min-w-0">
                    <p class="text-cream text-sm font-bold truncate transition-colors group-hover:text-mocca">{{ $product->product_name }}</p>
                    <p class="text-cream/20 text-[0.65rem] font-bold uppercase tracking-wider mt-0.5">{{ $product->total_sold }} terjual</p>
                </div>
                <span class="text-mocca font-bold text-sm">
                    Rp {{ number_format($product->total_revenue, 0, ',', '.') }}
                </span>
            </div>
            @empty
            <div class="flex flex-col items-center justify-center py-20 text-center">
                <div class="w-16 h-16 bg-white/[0.02] rounded-2xl flex items-center justify-center mb-4 border border-white/[0.04]">
                    <svg class="w-8 h-8 text-cream/10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <p class="text-cream/20 text-sm font-medium">Belum ada data penjualan.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
