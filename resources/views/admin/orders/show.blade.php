@extends('admin.layout')
@section('title', 'Detail Pesanan')
@section('page-title', 'Detail Pesanan')
@section('page-subtitle', '#' . $order->order_number)

@section('content')
<div class="grid lg:grid-cols-3 gap-6">
    {{-- Items --}}
    <div class="lg:col-span-2 space-y-6">
        <div class="admin-card overflow-hidden animate-fade-in-up">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-white/[0.06]">
                <div class="w-8 h-8 bg-mocca/10 rounded-lg flex items-center justify-center ring-1 ring-mocca/20">
                    <svg class="w-4 h-4 text-mocca" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <span class="font-display text-cream font-semibold text-sm">Item Pesanan</span>
            </div>
            <table class="w-full admin-table">
                <thead><tr class="border-b border-white/[0.04]">
                    <th class="text-left">Produk</th>
                    <th class="text-center">Qty</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Subtotal</th>
                </tr></thead>
                <tbody class="divide-y divide-white/[0.03]">
                    @foreach($order->items as $item)
                    <tr>
                        <td class="text-cream font-medium">{{ $item->product_name }}</td>
                        <td class="text-center text-cream/40">{{ $item->quantity }}</td>
                        <td class="text-right text-cream/40">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="text-right text-cream font-medium">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="border-t border-white/[0.06]">
                    <tr>
                        <td colspan="3" class="!py-3 text-right text-cream/40 text-xs">Subtotal</td>
                        <td class="!py-3 text-right text-cream text-sm">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="!py-3 text-right text-cream/40 text-xs">Ongkir</td>
                        <td class="!py-3 text-right text-cream text-sm">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="border-t border-white/[0.06]">
                        <td colspan="3" class="!py-4 text-right font-bold text-cream text-sm">Total</td>
                        <td class="!py-4 text-right text-mocca font-bold text-lg font-display">{{ $order->formatted_total }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Payment Proof --}}
        @if($order->payment_proof)
        <div class="admin-card p-6 animate-fade-in-up" style="animation-delay: 0.1s">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-mocca/10 rounded-lg flex items-center justify-center ring-1 ring-mocca/20">
                    <svg class="w-4 h-4 text-mocca" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="font-display text-cream font-semibold text-sm">Bukti Pembayaran</h3>
            </div>
            <img src="{{ asset('storage/' . $order->payment_proof) }}" class="max-w-sm rounded-xl border border-white/[0.06] hover:border-mocca/30 transition-all duration-300">
        </div>
        @endif
    </div>

    {{-- Sidebar Info --}}
    <div class="space-y-6">
        {{-- Update Status --}}
        <div class="admin-card p-6 animate-fade-in-up" style="animation-delay: 0.15s">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-mocca/10 rounded-lg flex items-center justify-center ring-1 ring-mocca/20">
                    <svg class="w-4 h-4 text-mocca" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                </div>
                <h3 class="font-display text-sm text-cream font-semibold">Update Status</h3>
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
                <div class="w-8 h-8 bg-purple-500/10 rounded-lg flex items-center justify-center ring-1 ring-purple-500/20">
                    <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <h3 class="font-display text-sm text-cream font-semibold">Info Pelanggan</h3>
            </div>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between items-center">
                    <span class="text-cream/30 text-xs uppercase tracking-wider">Nama</span>
                    <span class="text-cream font-medium">{{ $order->user->name }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-cream/30 text-xs uppercase tracking-wider">Email</span>
                    <span class="text-cream/70 text-xs">{{ $order->user->email }}</span>
                </div>
                <div class="border-t border-white/[0.06] pt-3">
                    <p class="text-cream/30 text-xs uppercase tracking-wider mb-2">Alamat Pengiriman</p>
                    <div class="bg-white/[0.02] rounded-lg p-3">
                        <p class="text-cream/60 text-xs leading-relaxed">
                            <span class="text-cream font-medium">{{ $order->recipient_name }}</span> ({{ $order->recipient_phone }})<br>
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
                <div class="w-8 h-8 bg-blue-500/10 rounded-lg flex items-center justify-center ring-1 ring-blue-500/20">
                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="font-display text-sm text-cream font-semibold">Info Order</h3>
            </div>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between items-center">
                    <span class="text-cream/30 text-xs uppercase tracking-wider">Metode Bayar</span>
                    <span class="text-cream font-medium">{{ $order->payment_method }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-cream/30 text-xs uppercase tracking-wider">Tanggal Order</span>
                    <span class="text-cream/70">{{ $order->created_at->format('d M Y H:i') }}</span>
                </div>
                @if($order->paid_at)
                <div class="flex justify-between items-center">
                    <span class="text-cream/30 text-xs uppercase tracking-wider">Tanggal Bayar</span>
                    <span class="text-cream/70">{{ $order->paid_at->format('d M Y') }}</span>
                </div>
                @endif
                @if($order->notes)
                <div class="border-t border-white/[0.06] pt-3">
                    <span class="text-cream/30 text-xs uppercase tracking-wider block mb-2">Catatan</span>
                    <div class="bg-white/[0.02] rounded-lg p-3">
                        <p class="text-cream/50 text-xs leading-relaxed">{{ $order->notes }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
