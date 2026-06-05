@extends('admin.layout')

@section('title', 'Detail Transaksi — ' . $transaction->transaction_number)
@section('page-title', 'Detail Transaksi')
@section('page-subtitle', $transaction->transaction_number)

@section('content')
<div class="max-w-3xl mx-auto space-y-6 animate-fade-in-up">

    {{-- Top Actions --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.pos.history') }}"
           class="flex items-center gap-2 text-cream/35 hover:text-mocca transition-colors text-sm font-medium group">
            <svg class="w-4 h-4 transition-transform duration-200 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Riwayat
        </a>
        <button onclick="window.print()"
                class="flex items-center gap-2 btn-outline-mocca print:hidden">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            Cetak Struk
        </button>
    </div>

    {{-- Receipt Card --}}
    <div class="admin-card overflow-hidden">
        {{-- Header --}}
        <div class="p-8 text-center border-b border-white/[0.06]">
            <div class="w-14 h-14 rounded-2xl bg-mocca/10 border border-mocca/20 flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-mocca" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            </div>
            <h2 class="font-display text-2xl text-mocca font-bold tracking-wide">FILO-COFFEE</h2>
            <p class="text-cream/25 text-xs mt-1">Point of Sale Receipt</p>
            <p class="text-cream/15 text-[0.6rem] mt-0.5 tracking-widest uppercase">www.filo-coffee.id</p>
        </div>

        {{-- Transaction Info --}}
        <div class="grid grid-cols-2 gap-6 p-6 border-b border-white/[0.05]">
            <div class="space-y-1">
                <p class="text-cream/25 text-[0.6rem] uppercase tracking-widest font-semibold">No. Transaksi</p>
                <p class="text-mocca font-bold font-mono text-sm tracking-wider">{{ $transaction->transaction_number }}</p>
            </div>
            <div class="space-y-1 text-right">
                <p class="text-cream/25 text-[0.6rem] uppercase tracking-widest font-semibold">Tanggal</p>
                <p class="text-cream font-semibold text-sm">{{ $transaction->created_at->format('d M Y') }}</p>
                <p class="text-cream/40 text-xs font-mono">{{ $transaction->created_at->format('H:i:s') }}</p>
            </div>
            <div class="space-y-1">
                <p class="text-cream/25 text-[0.6rem] uppercase tracking-widest font-semibold">Kasir</p>
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 rounded-full bg-mocca/10 border border-mocca/20 flex items-center justify-center flex-shrink-0">
                        <span class="text-mocca text-[0.55rem] font-bold">{{ substr($transaction->user->name ?? 'S', 0, 1) }}</span>
                    </div>
                    <span class="text-cream text-sm font-medium">{{ $transaction->user->name ?? 'System' }}</span>
                </div>
            </div>
            <div class="space-y-1 text-right">
                <p class="text-cream/25 text-[0.6rem] uppercase tracking-widest font-semibold">Status</p>
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.6rem] font-bold uppercase tracking-widest bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                    <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full"></span>
                    LUNAS
                </span>
            </div>
        </div>

        {{-- Items Table --}}
        <div class="p-6 border-b border-white/[0.05]">
            <p class="text-cream/25 text-[0.6rem] uppercase tracking-widest font-semibold mb-4">Item Pesanan</p>
            <div class="space-y-3">
                @foreach($transaction->items as $item)
                <div class="flex items-center gap-4">
                    <div class="flex-1 min-w-0">
                        <p class="text-cream text-sm font-semibold truncate">{{ $item->menu_name }}</p>
                        <p class="text-cream/35 text-xs font-mono">{{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                    </div>
                    <p class="text-mocca font-bold font-mono text-sm flex-shrink-0">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                </div>
                @if(!$loop->last)
                <div class="border-t border-white/[0.04]"></div>
                @endif
                @endforeach
            </div>
        </div>

        {{-- Totals --}}
        <div class="p-6 space-y-3">
            <div class="flex justify-between items-center">
                <span class="text-cream/40 text-xs uppercase tracking-wider font-semibold">Subtotal</span>
                <span class="text-cream/70 font-mono text-sm font-semibold">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
            </div>
            <div class="border-t border-dashed border-white/[0.08] pt-3 flex justify-between items-center">
                <span class="text-cream font-bold uppercase tracking-wide text-sm">Total</span>
                <span class="font-display text-mocca text-xl font-bold">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-cream/40 text-xs uppercase tracking-wider font-semibold">Tunai</span>
                <span class="text-cream/60 font-mono text-sm">Rp {{ number_format($transaction->cash_received, 0, ',', '.') }}</span>
            </div>
            <div class="border-t border-white/[0.05] pt-3 flex justify-between items-center">
                <span class="text-cream/40 text-xs uppercase tracking-wider font-semibold">Kembalian</span>
                <span class="text-mocca font-bold font-mono text-lg">Rp {{ number_format($transaction->cash_change, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- Footer --}}
        <div class="px-6 pb-8 text-center border-t border-dashed border-white/[0.05] pt-6">
            <p class="text-cream/20 text-xs italic">Terima kasih telah berkunjung ke Filo-Coffee!</p>
            <p class="text-cream/10 text-[0.6rem] mt-1 tracking-widest uppercase">Simpan struk ini sebagai bukti transaksi</p>
        </div>
    </div>
</div>

<style>
@media print {
    body { background: white !important; color: #000 !important; }
    .admin-card { box-shadow: none !important; border: none !important; background: white !important; }
    aside, header { display: none !important; }
    .print\:hidden { display: none !important; }
    main { padding: 0 !important; }
}
</style>
@endsection
