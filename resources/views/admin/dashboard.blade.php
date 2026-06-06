@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')

{{-- Welcome Header --}}
<div class="mb-10 animate-fade-in-up">
    <h2 class="font-display text-4xl text-olive-900 font-bold mb-1">Halo, {{ auth()->user()->name }}</h2>
    <p class="text-olive-850/60 text-sm font-medium">Berikut ringkasan performa bisnis Filo Coffee hari ini.</p>
</div>

{{-- Pending Alerts --}}
@if($pendingOrders > 0 || $pendingTables > 0 || $pendingPs > 0)
<div class="bg-amber-50/70 border border-amber-200/60 rounded-3xl p-6 mb-10 animate-fade-in-up">
    <div class="flex items-center gap-3 mb-4">
        <div class="w-2.5 h-2.5 bg-amber-500 rounded-full animate-pulse shadow-[0_0_12px_rgba(245,158,11,0.5)]"></div>
        <span class="text-amber-800 text-xs font-bold uppercase tracking-[0.2em]">Konfirmasi Diperlukan</span>
    </div>
    <div class="flex flex-wrap gap-6">
        @if($pendingOrders > 0)
        <a href="{{ route('admin.orders.index', ['status' => 'Pending']) }}" class="flex items-center gap-3 group">
            <span class="w-9 h-9 bg-amber-500/10 rounded-xl flex items-center justify-center text-xs font-bold text-amber-700 ring-1 ring-amber-500/20 transition-all duration-300 group-hover:ring-amber-500/40">{{ $pendingOrders }}</span>
            <span class="text-olive-900/60 text-sm font-medium group-hover:text-amber-800 transition-colors">Pesanan Pending</span>
        </a>
        @endif
        @if($pendingTables > 0)
        <a href="{{ route('admin.reservations.tables', ['status' => 'Pending']) }}" class="flex items-center gap-3 group">
            <span class="w-9 h-9 bg-amber-500/10 rounded-xl flex items-center justify-center text-xs font-bold text-amber-700 ring-1 ring-amber-500/20 transition-all duration-300 group-hover:ring-amber-500/40">{{ $pendingTables }}</span>
            <span class="text-olive-900/60 text-sm font-medium group-hover:text-amber-800 transition-colors">Reservasi Meja Pending</span>
        </a>
        @endif
        @if($pendingPs > 0)
        <a href="{{ route('admin.reservations.ps', ['status' => 'Pending']) }}" class="flex items-center gap-3 group">
            <span class="w-9 h-9 bg-amber-500/10 rounded-xl flex items-center justify-center text-xs font-bold text-amber-700 ring-1 ring-amber-500/20 transition-all duration-300 group-hover:ring-amber-500/40">{{ $pendingPs }}</span>
            <span class="text-olive-900/60 text-sm font-medium group-hover:text-amber-800 transition-colors">Booking PS Pending</span>
        </a>
        @endif
    </div>
</div>
@endif

{{-- Metrics Row --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    {{-- Daily Revenue --}}
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-olive-800/20">
        <div class="flex justify-between items-start mb-6">
            <div class="w-12 h-12 rounded-2xl bg-olive-100 flex items-center justify-center text-olive-800">
                <span class="material-symbols-outlined text-xl">payments</span>
            </div>
            <div class="flex items-center text-olive-800 font-bold text-xs bg-olive-100/60 px-2.5 py-1 rounded-full">
                <span class="material-symbols-outlined text-[10px] mr-1">trending_up</span> Live
            </div>
        </div>
        <p class="text-olive-900/40 text-[10px] font-bold tracking-widest mb-1">Total Pendapatan</p>
        <h3 class="font-display text-2xl font-bold text-olive-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
        
        <div class="mt-6 h-10 w-full flex items-end gap-1">
            @php $maxRevenue = $dailyRevenue->max('revenue') ?: 1; @endphp
            @foreach($dailyRevenue as $day)
                @php $percentage = min(100, max(15, ($day->revenue / $maxRevenue) * 100)); @endphp
                <div class="flex-1 bg-olive-500/20 rounded-md" style="height: {{ $percentage }}%" title="Rp {{ number_format($day->revenue, 0, ',', '.') }}"></div>
            @endforeach
        </div>
    </div>

    {{-- Total Orders --}}
    <div class="bg-white p-6 rounded-3xl border border-olive-800/20">
        <div class="flex justify-between items-start mb-6">
            <div class="w-12 h-12 rounded-2xl bg-mocca/10 flex items-center justify-center text-mocca-dark">
                <span class="material-symbols-outlined text-xl">shopping_cart</span>
            </div>
            <div class="flex items-center text-mocca-dark font-bold text-xs bg-mocca/5 px-2.5 py-1 rounded-full">
                {{ $pendingOrders }} pending
            </div>
        </div>
        <p class="text-olive-900/40 text-[10px] font-bold tracking-widest mb-1">Total Pesanan</p>
        <h3 class="font-display text-2xl font-bold text-olive-900">{{ $totalOrders }}</h3>
        
        <div class="mt-6 h-10 w-full flex items-end gap-1">
            <div class="flex-1 bg-mocca/10 h-[40%] rounded-md"></div>
            <div class="flex-1 bg-mocca/10 h-[60%] rounded-md"></div>
            <div class="flex-1 bg-mocca/10 h-[55%] rounded-md"></div>
            <div class="flex-1 bg-mocca/10 h-[75%] rounded-md"></div>
            <div class="flex-1 bg-mocca/20 h-[65%] rounded-md"></div>
            <div class="flex-1 bg-mocca/40 h-[90%] rounded-md"></div>
        </div>
    </div>

    {{-- Total Users --}}
    <div class="bg-white p-6 rounded-3xl border border-olive-800/20">
        <div class="flex justify-between items-start mb-6">
            <div class="w-12 h-12 rounded-2xl bg-coffee-light/10 flex items-center justify-center text-coffee-light">
                <span class="material-symbols-outlined text-xl">person_add</span>
            </div>
            <div class="flex items-center text-coffee-light font-bold text-xs bg-coffee-light/5 px-2.5 py-1 rounded-full">
                Member
            </div>
        </div>
        <p class="text-olive-900/40 text-[10px] font-bold tracking-widest mb-1">Total Member</p>
        <h3 class="font-display text-2xl font-bold text-olive-900">{{ $totalUsers }}</h3>
        
        <div class="mt-6 h-10 w-full flex items-end gap-1">
            <div class="flex-1 bg-coffee-light/10 h-[30%] rounded-md"></div>
            <div class="flex-1 bg-coffee-light/10 h-[50%] rounded-md"></div>
            <div class="flex-1 bg-coffee-light/10 h-[40%] rounded-md"></div>
            <div class="flex-1 bg-coffee-light/10 h-[70%] rounded-md"></div>
            <div class="flex-1 bg-coffee-light/20 h-[55%] rounded-md"></div>
            <div class="flex-1 bg-coffee-light/40 h-[80%] rounded-md"></div>
        </div>
    </div>

    {{-- Stock Alerts --}}
    <div class="bg-white p-6 rounded-3xl border border-olive-800/20">
        <div class="flex justify-between items-start mb-6">
            <div class="w-12 h-12 rounded-2xl bg-red-100 flex items-center justify-center text-red-600">
                <span class="material-symbols-outlined text-xl">warning</span>
            </div>
            @if($lowStockProducts > 0)
            <div class="flex items-center text-red-600 font-bold text-xs bg-red-50 px-2.5 py-1 rounded-full animate-pulse">
                Butuh Restock
            </div>
            @else
            <div class="flex items-center text-olive-700 font-bold text-xs bg-olive-50 px-2.5 py-1 rounded-full">
                Aman
            </div>
            @endif
        </div>
        <p class="text-olive-900/40 text-[10px] font-bold tracking-widest mb-1">Stok Menipis</p>
        <h3 class="font-display text-2xl font-bold text-olive-900">{{ $lowStockProducts }} produk</h3>
        
        <div class="mt-6 h-10 w-full flex items-end gap-1">
            <div class="flex-1 bg-red-500/10 h-[90%] rounded-md"></div>
            <div class="flex-1 bg-red-500/10 h-[75%] rounded-md"></div>
            <div class="flex-1 bg-red-500/10 h-[60%] rounded-md"></div>
            <div class="flex-1 bg-red-500/10 h-[45%] rounded-md"></div>
            <div class="flex-1 bg-red-500/20 h-[30%] rounded-md"></div>
            <div class="flex-1 bg-red-500/40 h-[15%] rounded-md"></div>
        </div>
    </div>
</div>

{{-- Middle Row --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
    {{-- Sales Analytics Chart --}}
    <div class="lg:col-span-2 bg-white p-8 rounded-3xl border border-olive-800/20">
        <div class="flex justify-between items-center mb-10">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-olive-800">bar_chart</span>
                <h4 class="text-lg font-bold text-olive-900 font-display">Analitik Penjualan</h4>
            </div>
            <div class="text-xs text-olive-900/40 font-bold tracking-widest bg-olive-50 px-3 py-1.5 rounded-xl">
                7 Hari Terakhir
            </div>
        </div>
        
        <div class="h-[300px] w-full relative">
            <div class="absolute inset-0 flex items-end justify-between px-4 z-10">
                @foreach($dailyRevenue as $day)
                    @php
                        $percentage = min(100, max(15, ($day->revenue / $maxRevenue) * 100));
                        $isToday = date('Y-m-d') === date('Y-m-d', strtotime($day->date));
                    @endphp
                    <div class="w-12 bg-olive-100 hover:bg-olive-200 transition-all duration-300 rounded-md relative group flex flex-col justify-end {{ $isToday ? '!bg-olive-600 shadow-md shadow-olive-600/10' : '' }}" style="height: {{ $percentage }}%">
                        <span class="absolute -top-12 left-1/2 -translate-x-1/2 bg-olive-900 text-white text-[10px] py-2 px-3 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 font-bold whitespace-nowrap shadow-xl z-20">
                            Rp {{ number_format($day->revenue, 0, ',', '.') }}
                        </span>
                    </div>
                @endforeach
            </div>
            <div class="absolute inset-0 flex flex-col justify-between pointer-events-none opacity-5 py-2">
                <div class="border-b border-olive-900 w-full"></div>
                <div class="border-b border-olive-900 w-full"></div>
                <div class="border-b border-olive-900 w-full"></div>
                <div class="border-b border-olive-900 w-full"></div>
            </div>
        </div>
        <div class="flex justify-between mt-6 px-4 text-olive-900/40 font-bold text-[10px] tracking-widest uppercase">
            @foreach($dailyRevenue as $day)
                <span>{{ date('D', strtotime($day->date)) }}</span>
            @endforeach
        </div>
    </div>

    {{-- Top Products / Inventory --}}
    <div class="bg-white p-8 rounded-3xl border border-olive-800/20">
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-olive-800">inventory_2</span>
                <h4 class="text-lg font-bold text-olive-900 font-display">Produk Terlaris</h4>
            </div>
            <a href="{{ route('admin.menus.index') }}" class="text-olive-600 hover:underline font-semibold text-xs transition-all">Lihat Semua</a>
        </div>
        
        <div class="space-y-6">
            @php $maxSold = $topProducts->max('total_sold') ?: 1; @endphp
            @forelse($topProducts as $product)
                @php $percentage = min(100, ($product->total_sold / $maxSold) * 100); @endphp
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-semibold text-olive-900 truncate max-w-[170px]">{{ $product->product_name }}</span>
                        <span class="text-[9px] font-bold text-olive-800 bg-olive-100 px-2.5 py-0.5 rounded-full uppercase">{{ $product->total_sold }} terjual</span>
                    </div>
                    <div class="w-full bg-olive-50 h-2 rounded-full overflow-hidden">
                        <div class="bg-olive-500 h-full rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                    </div>
                    <div class="flex justify-between text-[10px] text-olive-900/40 font-semibold">
                        <span>Rp {{ number_format($product->total_revenue, 0, ',', '.') }}</span>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <span class="material-symbols-outlined text-3xl text-olive-900/20 mb-2">inventory_2</span>
                    <p class="text-xs text-olive-900/35 font-medium">Belum ada data penjualan.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

{{-- Bottom Row --}}
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    {{-- Recent Orders Table --}}
    <div class="lg:col-span-3 bg-white p-8 rounded-3xl border border-olive-800/20">
        <div class="flex justify-between items-center mb-8">
            <h4 class="text-lg font-bold text-olive-900 font-display">Pesanan Terbaru</h4>
            <div class="flex gap-2">
                <a href="{{ route('admin.orders.index') }}" class="w-10 h-10 flex items-center justify-center bg-olive-50 hover:bg-olive-100 rounded-xl text-olive-800 transition-colors" title="Semua Pesanan">
                    <span class="material-symbols-outlined text-sm">list_alt</span>
                </a>
            </div>
        </div>
        
        <table class="w-full text-left">
            <thead>
                <tr class="text-[10px] font-bold text-olive-900/40 tracking-widest uppercase border-b border-olive-900/5">
                    <th class="px-4 py-4">Nomor Pesanan</th>
                    <th class="px-4 py-4">Pelanggan</th>
                    <th class="px-4 py-4">Tanggal</th>
                    <th class="px-4 py-4">Status</th>
                    <th class="px-4 py-4 text-right">Total</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($recentOrders as $order)
                <tr class="hover:bg-olive-50/30 transition-colors border-b border-olive-900/5 group">
                    <td class="px-4 py-5 font-bold text-olive-900">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-olive-700 hover:text-olive-900 transition-colors">{{ $order->order_number }}</a>
                    </td>
                    <td class="px-4 py-5 text-olive-900/60 font-semibold">{{ $order->user->name }}</td>
                    <td class="px-4 py-5 text-olive-950/40 text-xs font-semibold">{{ $order->created_at->format('d M, Y') }}</td>
                    <td class="px-4 py-5">
                        @php
                            $badgeClass = match($order->status) {
                                'Pending' => 'bg-amber-100 text-amber-700',
                                'Paid' => 'bg-emerald-100 text-emerald-700',
                                'Confirmed' => 'bg-emerald-100 text-emerald-700',
                                'Processing' => 'bg-indigo-100 text-indigo-700',
                                'Shipped' => 'bg-purple-100 text-purple-700',
                                'Completed' => 'bg-blue-100 text-blue-700',
                                'Cancelled' => 'bg-red-100 text-red-700',
                                default => 'bg-olive-100 text-olive-700'
                            };
                        @endphp
                        <span class="{{ $badgeClass }} text-[9px] font-bold px-3 py-1 rounded-full uppercase tracking-tight">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="px-4 py-5 text-right font-bold text-olive-900">{{ $order->formatted_total }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-10 text-olive-900/30 text-xs font-medium">Tidak ada pesanan terbaru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Stats gauge / occupancy --}}
    <div class="bg-white p-8 rounded-3xl border border-olive-800/20 flex flex-col items-center justify-center text-center">
        <div class="relative w-36 h-36 mb-8">
            <svg class="w-full h-full -rotate-90" viewBox="0 0 100 100">
                <circle class="text-olive-50 stroke-current" cx="50" cy="50" fill="transparent" r="42" stroke-width="8"></circle>
                <circle class="text-olive-600 stroke-current" cx="50" cy="50" fill="transparent" r="42" stroke-dasharray="263.8" stroke-dashoffset="26.38" stroke-linecap="round" stroke-width="8"></circle>
            </svg>
            <div class="absolute inset-0 flex flex-col items-center justify-center">
                <span class="font-display text-3xl font-bold text-olive-900">90%</span>
                <span class="text-[9px] text-olive-900/30 font-bold uppercase tracking-widest">Kapasitas</span>
            </div>
        </div>
        
        <h4 class="text-lg font-bold text-olive-900 font-display mb-1">Reservasi & PS</h4>
        <p class="text-olive-850/60 text-xs mb-8 leading-relaxed">Persentase keberhasilan konfirmasi reservasi hari ini.</p>
        
        <div class="grid grid-cols-2 gap-4 w-full pt-6 border-t border-olive-900/5">
            <div>
                <p class="text-olive-900/40 text-[9px] font-bold uppercase tracking-widest mb-1">Reservasi Meja</p>
                <p class="text-base font-bold text-olive-800">{{ $pendingTables }} Pending</p>
            </div>
            <div>
                <p class="text-olive-900/40 text-[9px] font-bold uppercase tracking-widest mb-1">Booking PS</p>
                <p class="text-base font-bold text-olive-800">{{ $pendingPs }} Pending</p>
            </div>
        </div>
    </div>
</div>

<!-- Floating Action Button (POS) -->
<a href="{{ route('admin.pos.index') }}" title="Buka Kasir Mode" class="fixed bottom-10 right-10 w-16 h-16 bg-olive-800 hover:bg-olive-900 text-beige-50 rounded-2xl shadow-2xl flex items-center justify-center hover:scale-110 hover:-translate-y-1 active:scale-95 transition-all duration-300 z-50">
    <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'wght' 600;">point_of_sale</span>
</a>

@endsection
