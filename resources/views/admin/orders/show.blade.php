@extends('admin.layout')
@section('title', 'Detail Pesanan')
@section('page-title', 'Detail Pesanan')
@section('page-subtitle', '#' . $order->order_number)

@section('content')
<div class="grid lg:grid-cols-3 gap-6">
    {{-- Items --}}
    <div class="lg:col-span-2 space-y-6">
        <div class="admin-card overflow-hidden animate-fade-in-up">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-olive-900/5">
                <div class="w-8 h-8 bg-mocca/10 rounded-lg flex items-center justify-center ring-1 ring-mocca/20">
                    <svg class="w-4 h-4 text-mocca-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <span class="font-display text-olive-900 font-semibold text-sm">Item Pesanan</span>
            </div>
            <table class="w-full admin-table">
                <thead><tr class="border-b border-olive-900/5">
                    <th class="text-left">Produk</th>
                    <th class="text-center">Qty</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Subtotal</th>
                </tr></thead>
                <tbody class="divide-y divide-olive-900/5">
                    @foreach($order->items as $item)
                    <tr>
                        <td class="text-olive-900 font-semibold text-sm">{{ $item->product_name }}</td>
                        <td class="text-center text-olive-900/50 font-semibold">{{ $item->quantity }}</td>
                        <td class="text-right text-olive-900/50 font-semibold">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="text-right text-olive-900 font-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="border-t border-olive-900/5">
                    <tr>
                        <td colspan="3" class="!py-3 text-right text-olive-900/50 text-xs font-semibold">Subtotal</td>
                        <td class="!py-3 text-right text-olive-900 font-semibold text-sm">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="!py-3 text-right text-olive-900/50 text-xs font-semibold">Ongkir</td>
                        <td class="!py-3 text-right text-olive-900 font-semibold text-sm">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="border-t border-olive-900/5">
                        <td colspan="3" class="!py-4 text-right font-bold text-olive-900 text-sm">Total</td>
                        <td class="!py-4 text-right text-mocca-dark font-bold text-lg font-display">{{ $order->formatted_total }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Payment Proof --}}
        @if($order->payment_proof)
        <div class="admin-card p-6 animate-fade-in-up" style="animation-delay: 0.1s">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-mocca/10 rounded-lg flex items-center justify-center ring-1 ring-mocca/20">
                    <svg class="w-4 h-4 text-mocca-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="font-display text-olive-900 font-semibold text-sm">Bukti Pembayaran</h3>
            </div>
            <img src="{{ asset('storage/' . $order->payment_proof) }}" class="max-w-sm rounded-xl border border-olive-900/5 hover:border-mocca/30 transition-all duration-300">
        </div>
        @endif
    </div>

    {{-- Sidebar Info --}}
    <div class="space-y-6">
        {{-- Update Status --}}
        <div class="admin-card p-6 animate-fade-in-up" style="animation-delay: 0.15s">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-mocca/10 rounded-lg flex items-center justify-center ring-1 ring-mocca/20">
                    <svg class="w-4 h-4 text-mocca-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                </div>
                <h3 class="font-display text-sm text-olive-900 font-semibold">Update Status</h3>
            </div>
            <div class="mb-4">
                <span class="badge badge-{{ $order->status }}">{{ $order->status }}</span>
            </div>
            <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="space-y-3">
                @csrf @method('PATCH')
                <select name="status" required class="input-field text-sm">
                    @foreach(['Pending', 'Paid', 'Processing', 'Shipped', 'Completed', 'Cancelled'] as $s)
                    <option value="{{ $s }}" {{ $order->status == $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-mocca w-full justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Update Status
                </button>
            </form>
        </div>

        {{-- Customer Info --}}
        <div class="admin-card p-6 animate-fade-in-up" style="animation-delay: 0.2s">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-olive-100 rounded-lg flex items-center justify-center ring-1 ring-olive-900/5">
                    <svg class="w-4 h-4 text-olive-850" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <h3 class="font-display text-sm text-olive-900 font-semibold">Info Pelanggan</h3>
            </div>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between items-center">
                    <span class="text-olive-900/40 text-xs font-bold uppercase tracking-wider">Nama</span>
                    <span class="text-olive-900 font-semibold">{{ $order->user->name }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-olive-900/40 text-xs font-bold uppercase tracking-wider">Email</span>
                    <span class="text-olive-900/60 font-semibold text-xs">{{ $order->user->email }}</span>
                </div>
                <div class="border-t border-olive-900/5 pt-3">
                    <p class="text-olive-900/40 text-xs font-bold uppercase tracking-wider mb-2">Alamat Pengiriman</p>
                    <div class="bg-olive-50 rounded-lg p-3">
                        <p class="text-olive-900/60 text-xs font-semibold leading-relaxed">
                            <span class="text-olive-900 font-bold">{{ $order->recipient_name }}</span> ({{ $order->recipient_phone }})<br>
                            {{ $order->shipping_address }}<br>
                            {{ $order->shipping_city }}, {{ $order->shipping_province }} {{ $order->shipping_zip }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Order Meta --}}
        <div class="admin-card p-6 animate-fade-in-up" style="animation-delay: 0.25s">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-olive-100 rounded-lg flex items-center justify-center ring-1 ring-olive-900/5">
                    <svg class="w-4 h-4 text-olive-850" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="font-display text-sm text-olive-900 font-semibold">Info Order</h3>
            </div>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between items-center">
                    <span class="text-olive-900/40 text-xs font-bold uppercase tracking-wider">Metode Bayar</span>
                    <span class="text-olive-900 font-semibold">{{ $order->payment_method }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-olive-900/40 text-xs font-bold uppercase tracking-wider">Tanggal Order</span>
                    <span class="text-olive-900/60 font-semibold">{{ $order->created_at->format('d M Y H:i') }}</span>
                </div>
                @if($order->paid_at)
                <div class="flex justify-between items-center">
                    <span class="text-olive-900/40 text-xs font-bold uppercase tracking-wider">Tanggal Bayar</span>
                    <span class="text-olive-900/60 font-semibold">{{ $order->paid_at->format('d M Y') }}</span>
                </div>
                @endif
                @if($order->notes)
                <div class="border-t border-olive-900/5 pt-3">
                    <span class="text-olive-900/40 text-xs font-bold uppercase tracking-wider block mb-2">Catatan</span>
                    <div class="bg-olive-50 rounded-lg p-3">
                        <p class="text-olive-900/50 text-xs font-semibold leading-relaxed">{{ $order->notes }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
