@extends('admin.layout')
@section('title', 'Pesanan')
@section('page-title', 'Manajemen Pesanan')
@section('page-subtitle', 'Kelola semua pesanan biji kopi')

@section('content')
{{-- Filter --}}
<form method="GET" class="admin-card p-4 mb-6 animate-fade-in-up">
    <div class="flex flex-wrap items-center gap-3">
        <div class="relative flex-1 min-w-[200px] max-w-xs">
            <svg class="w-4 h-4 text-cream/20 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="search" value="{{ request('search') }}" class="input-field !pl-10 text-sm" placeholder="Cari nomor order...">
        </div>
        <select name="status" class="input-field w-auto text-sm">
            <option value="">Semua Status</option>
            @foreach(['Pending', 'Paid', 'Processing', 'Shipped', 'Completed', 'Cancelled'] as $s)
            <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn-mocca">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
            Filter
        </button>
    </div>
</form>

{{-- Table --}}
<div class="admin-card overflow-hidden animate-fade-in-up" style="animation-delay: 0.1s">
    <table class="w-full admin-table">
        <thead>
            <tr class="border-b border-white/[0.06]">
                <th class="text-left">Order</th>
                <th class="text-left">Pelanggan</th>
                <th class="text-left">Total</th>
                <th class="text-left">Payment</th>
                <th class="text-left">Status</th>
                <th class="text-left">Tanggal</th>
                <th class="text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/[0.03]">
            @forelse($orders as $order)
            <tr>
                <td class="text-mocca font-medium">{{ $order->order_number }}</td>
                <td class="text-cream/50">{{ $order->user->name }}</td>
                <td class="text-cream font-medium">{{ $order->formatted_total }}</td>
                <td class="text-cream/40">{{ $order->payment_method }}</td>
                <td><span class="badge badge-{{ $order->status }}">{{ $order->status }}</span></td>
                <td class="text-cream/30">{{ $order->created_at->format('d M Y') }}</td>
                <td class="text-right">
                    <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center gap-1.5 text-cream/40 hover:text-mocca transition-colors duration-200 text-xs font-medium group">
                        Detail
                        <svg class="w-3 h-3 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="!py-16 text-center">
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-12 h-12 bg-white/[0.03] rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-cream/15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        </div>
                        <p class="text-cream/25 text-sm">Belum ada pesanan.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6 pagination-wrapper">{{ $orders->links() }}</div>
@endsection
