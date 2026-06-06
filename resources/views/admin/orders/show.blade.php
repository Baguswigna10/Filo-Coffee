@extends('admin.layout')
@section('title', 'Detail Pesanan')
@section('page-title', 'Detail Pesanan')
@section('page-subtitle', '#' . $order->order_number)

@section('content')
<div class="grid lg:grid-cols-3 gap-6">
    {{-- Items --}}
    <div class="lg:col-span-2 space-y-6">
        <div class="admin-card overflow-hidden animate-fade-in-up shadow-sm border border-olive-900/5">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-olive-900/5 bg-olive-50/10">
                <div class="w-9 h-9 bg-mocca/10 rounded-xl flex items-center justify-center ring-1 ring-mocca/20">
                    <span class="material-symbols-outlined text-mocca-dark text-lg">receipt_long</span>
                </div>
                <div>
                    <h3 class="text-olive-900 text-sm font-bold">Rincian Item Pesanan</h3>
                    <p class="text-[10px] text-olive-900/40 font-semibold">Daftar produk yang dibeli oleh pelanggan</p>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full admin-table text-left border-collapse">
                    <thead>
                        <tr class="border-b border-olive-900/5 bg-olive-50/20">
                            <th class="py-3 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Produk</th>
                            <th class="py-3 px-6 text-xs font-bold uppercase tracking-wider text-olive-800 text-center">Qty</th>
                            <th class="py-3 px-6 text-xs font-bold uppercase tracking-wider text-olive-800 text-right">Harga</th>
                            <th class="py-3 px-6 text-xs font-bold uppercase tracking-wider text-olive-800 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-olive-900/5">
                        @foreach($order->items as $item)
                        <tr class="hover:bg-olive-50/10 transition-colors">
                            <td class="py-4 px-6 text-olive-900 font-semibold text-sm">{{ $item->product_name }}</td>
                            <td class="py-4 px-6 text-center text-olive-900/60 font-bold text-xs">{{ $item->quantity }}</td>
                            <td class="py-4 px-6 text-right text-olive-900/50 font-semibold text-xs">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="py-4 px-6 text-right text-olive-900 font-bold text-sm">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="border-t border-olive-900/5 bg-olive-50/5">
                        <tr>
                            <td colspan="3" class="py-3 px-6 text-right text-olive-900/40 text-xs font-bold uppercase tracking-wider">Subtotal</td>
                            <td class="py-3 px-6 text-right text-olive-900 font-semibold text-sm">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="py-3 px-6 text-right text-olive-900/40 text-xs font-bold uppercase tracking-wider">Ongkos Kirim</td>
                            <td class="py-3 px-6 text-right text-olive-900 font-semibold text-sm">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="border-t border-olive-900/5 bg-olive-50/20">
                            <td colspan="3" class="py-4 px-6 text-right text-olive-900/40 text-xs font-extrabold uppercase tracking-widest">Total Bayar</td>
                            <td class="py-4 px-6 text-right text-mocca-dark font-extrabold text-lg font-display">{{ $order->formatted_total }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        {{-- Payment Proof --}}
        @if($order->payment_proof)
        <div class="admin-card p-6 animate-fade-in-up border border-olive-900/5 shadow-sm" style="animation-delay: 0.1s">
            <div class="flex items-center gap-3 mb-4 pb-4 border-b border-olive-900/5">
                <div class="w-9 h-9 bg-mocca/10 rounded-xl flex items-center justify-center ring-1 ring-mocca/20">
                    <span class="material-symbols-outlined text-mocca-dark text-lg">image</span>
                </div>
                <div>
                    <h3 class="text-olive-900 text-sm font-bold">Bukti Pembayaran</h3>
                    <p class="text-[10px] text-olive-900/40 font-semibold">Lampiran bukti transfer dari pelanggan</p>
                </div>
            </div>
            <div class="inline-block relative group overflow-hidden rounded-2xl border border-olive-900/5 max-w-sm">
                <img src="{{ asset('storage/' . $order->payment_proof) }}" class="w-full object-cover group-hover:scale-102 transition-transform duration-300">
            </div>
        </div>
        @endif
    </div>

    {{-- Sidebar Info --}}
    <div class="space-y-6">
        {{-- Update Status --}}
        <div class="admin-card p-6 animate-fade-in-up border border-olive-900/5 shadow-sm" style="animation-delay: 0.15s">
            <div class="flex items-center gap-3 mb-4 pb-4 border-b border-olive-900/5">
                <div class="w-9 h-9 bg-mocca/10 rounded-xl flex items-center justify-center ring-1 ring-mocca/20">
                    <span class="material-symbols-outlined text-mocca-dark text-lg">sync_alt</span>
                </div>
                <div>
                    <h3 class="text-olive-900 text-sm font-bold">Update Status</h3>
                    <p class="text-[10px] text-olive-900/40 font-semibold">Kelola status pemrosesan pesanan</p>
                </div>
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
                    <span class="material-symbols-outlined text-sm">save</span>
                    Simpan Perubahan
                </button>
            </form>
        </div>

        {{-- Customer Info --}}
        <div class="admin-card p-6 animate-fade-in-up border border-olive-900/5 shadow-sm" style="animation-delay: 0.2s">
            <div class="flex items-center gap-3 mb-4 pb-4 border-b border-olive-900/5">
                <div class="w-9 h-9 bg-olive-100 rounded-xl flex items-center justify-center ring-1 ring-olive-900/5">
                    <span class="material-symbols-outlined text-olive-850 text-lg">person</span>
                </div>
                <div>
                    <h3 class="text-olive-900 text-sm font-bold">Informasi Pelanggan</h3>
                    <p class="text-[10px] text-olive-900/40 font-semibold">Detail kontak dan alamat pengiriman</p>
                </div>
            </div>
            <div class="space-y-4 text-sm">
                <div class="flex justify-between items-center pb-2 border-b border-olive-900/5">
                    <span class="text-olive-900/40 text-[10px] font-bold uppercase tracking-wider">Nama</span>
                    <span class="text-olive-900 font-semibold text-xs">{{ $order->user->name }}</span>
                </div>
                <div class="flex justify-between items-center pb-2 border-b border-olive-900/5">
                    <span class="text-olive-900/40 text-[10px] font-bold uppercase tracking-wider">Email</span>
                    <span class="text-olive-900/60 font-semibold text-xs">{{ $order->user->email }}</span>
                </div>
                @if($order->recipient_name)
                <div class="pt-2">
                    <p class="text-olive-900/40 text-[10px] font-bold uppercase tracking-wider mb-2">Alamat Pengiriman</p>
                    <div class="bg-olive-50/50 rounded-2xl p-4 border border-olive-900/5">
                        <p class="text-olive-900/70 text-xs font-semibold leading-relaxed">
                            <span class="text-olive-900 font-bold block mb-1 text-sm">{{ $order->recipient_name }}</span>
                            <span class="inline-flex items-center text-olive-900/40 font-bold mb-3 text-[10px] tracking-wide bg-olive-150 px-2 py-0.5 rounded-md">📞 {{ $order->recipient_phone }}</span><br>
                            {{ $order->shipping_address }}<br>
                            {{ $order->shipping_city }}, {{ $order->shipping_province }} {{ $order->shipping_zip }}
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Order Meta --}}
        <div class="admin-card p-6 animate-fade-in-up border border-olive-900/5 shadow-sm" style="animation-delay: 0.25s">
            <div class="flex items-center gap-3 mb-4 pb-4 border-b border-olive-900/5">
                <div class="w-9 h-9 bg-olive-100 rounded-xl flex items-center justify-center ring-1 ring-olive-900/5">
                    <span class="material-symbols-outlined text-olive-850 text-lg">info</span>
                </div>
                <div>
                    <h3 class="text-olive-900 text-sm font-bold">Metadata Pesanan</h3>
                    <p class="text-[10px] text-olive-900/40 font-semibold">Informasi pencatatan sistem</p>
                </div>
            </div>
            <div class="space-y-4 text-sm">
                <div class="flex justify-between items-center pb-2 border-b border-olive-900/5">
                    <span class="text-olive-900/40 text-[10px] font-bold uppercase tracking-wider">Metode Bayar</span>
                    <span class="text-olive-900 font-semibold text-xs">{{ $order->payment_method }}</span>
                </div>
                <div class="flex justify-between items-center pb-2 border-b border-olive-900/5">
                    <span class="text-olive-900/40 text-[10px] font-bold uppercase tracking-wider">Tanggal Order</span>
                    <span class="text-olive-900/60 font-semibold text-xs">{{ $order->created_at->format('d M Y H:i') }}</span>
                </div>
                @if($order->paid_at)
                <div class="flex justify-between items-center pb-2 border-b border-olive-900/5">
                    <span class="text-olive-900/40 text-[10px] font-bold uppercase tracking-wider">Tanggal Bayar</span>
                    <span class="text-olive-900/60 font-semibold text-xs">{{ $order->paid_at->format('d M Y') }}</span>
                </div>
                @endif
                @if($order->notes)
                <div class="pt-2">
                    <span class="text-olive-900/40 text-[10px] font-bold uppercase tracking-wider block mb-2">Catatan Pesanan</span>
                    <div class="bg-olive-50/50 rounded-2xl p-4 border border-olive-900/5">
                        <p class="text-olive-900/60 text-xs font-semibold leading-relaxed italic">"{{ $order->notes }}"</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
