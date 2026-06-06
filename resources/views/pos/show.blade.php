@extends('admin.layout')

@section('title', 'Detail Transaksi — ' . $transaction->transaction_number)
@section('page-title', 'Detail Transaksi')
@section('page-subtitle', $transaction->transaction_number)

@section('content')
<div class="max-w-3xl mx-auto space-y-5 animate-fade-in-up">

    {{-- Top Actions --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.pos.history') }}"
           class="flex items-center gap-2 text-olive-900/40 hover:text-olive-800 transition-colors text-sm font-medium group">
            <span class="material-symbols-outlined text-sm transition-transform duration-200 group-hover:-translate-x-0.5">arrow_back</span>
            Kembali ke Riwayat
        </a>
        <button onclick="window.print()"
                class="btn-outline-mocca flex items-center gap-2 print:hidden">
            <span class="material-symbols-outlined" style="font-size:16px">print</span>
            Cetak Struk
        </button>
    </div>

    {{-- Receipt Card --}}
    <div class="bg-white border border-olive-900/8 rounded-2xl shadow-sm overflow-hidden">

        {{-- Receipt Header --}}
        <div class="px-8 py-8 text-center border-b border-olive-900/6 bg-gradient-to-b from-beige-50 to-white">
            <div class="w-14 h-14 rounded-2xl bg-white border border-olive-200/70 shadow-sm flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-olive-600" style="font-size:26px">storefront</span>
            </div>
            <h2 class="font-display text-2xl text-olive-900 font-bold tracking-wide">FILO COFFEE</h2>
            <p class="text-olive-900/35 text-xs mt-1 font-medium">Point of Sale — Struk Transaksi</p>
            <p class="text-olive-900/20 text-[0.6rem] mt-0.5 tracking-widest uppercase font-mono">www.filo-coffee.id</p>
        </div>

        {{-- Transaction Meta --}}
        <div class="grid grid-cols-2 gap-0 border-b border-olive-900/6">
            {{-- No. Transaksi --}}
            <div class="p-5 border-r border-olive-900/6">
                <p class="text-[10px] text-olive-900/35 uppercase tracking-widest font-bold mb-1.5">No. Transaksi</p>
                <span class="font-mono text-xs font-bold text-mocca-dark bg-beige-100 px-2.5 py-1 rounded-lg border border-beige-200 tracking-wide inline-block">
                    {{ $transaction->transaction_number }}
                </span>
            </div>
            {{-- Tanggal --}}
            <div class="p-5">
                <p class="text-[10px] text-olive-900/35 uppercase tracking-widest font-bold mb-1.5">Tanggal & Waktu</p>
                <p class="text-sm font-semibold text-olive-900">{{ $transaction->created_at->format('d M Y') }}</p>
                <p class="text-xs text-olive-900/40 font-mono mt-0.5">{{ $transaction->created_at->format('H:i:s') }}</p>
            </div>
            {{-- Kasir --}}
            <div class="p-5 border-r border-t border-olive-900/6">
                <p class="text-[10px] text-olive-900/35 uppercase tracking-widest font-bold mb-1.5">Kasir</p>
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-full bg-gradient-to-br from-olive-100 to-olive-200 border border-olive-300/50 flex items-center justify-center flex-shrink-0">
                        <span class="text-olive-700 text-[0.6rem] font-bold">{{ substr($transaction->user->name ?? 'S', 0, 1) }}</span>
                    </div>
                    <span class="text-sm font-medium text-olive-900">{{ $transaction->user->name ?? 'System' }}</span>
                </div>
            </div>
            {{-- Status --}}
            <div class="p-5 border-t border-olive-900/6">
                <p class="text-[10px] text-olive-900/35 uppercase tracking-widest font-bold mb-1.5">Status</p>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-widest bg-emerald-50 text-emerald-700 border border-emerald-200/70">
                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                    Lunas
                </span>
            </div>
        </div>

        {{-- Item List --}}
        <div class="p-6 border-b border-olive-900/6">
            <p class="text-[10px] text-olive-900/35 uppercase tracking-widest font-bold mb-4">Item Pesanan</p>
            <div class="space-y-0 divide-y divide-olive-900/4">
                @foreach($transaction->items as $item)
                <div class="flex items-center gap-4 py-3 @if($loop->first) pt-0 @endif @if($loop->last) pb-0 @endif">
                    {{-- Item index badge --}}
                    <div class="w-6 h-6 rounded-md bg-olive-50 border border-olive-200/60 flex items-center justify-center flex-shrink-0">
                        <span class="text-[0.6rem] font-bold text-olive-600">{{ $loop->index + 1 }}</span>
                    </div>
                    {{-- Name & qty --}}
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-olive-900 truncate">{{ $item->menu_name }}</p>
                        <p class="text-xs text-olive-900/40 font-mono mt-0.5">
                            {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}
                        </p>
                    </div>
                    {{-- Subtotal --}}
                    <p class="text-sm font-bold text-olive-900 font-mono flex-shrink-0">
                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Totals --}}
        <div class="p-6 space-y-2.5 border-b border-olive-900/6 bg-olive-50/30">
            {{-- Subtotal --}}
            <div class="flex justify-between items-center">
                <span class="text-xs text-olive-900/45 uppercase tracking-wider font-semibold">Subtotal</span>
                <span class="text-sm text-olive-900/65 font-mono font-medium">
                    Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                </span>
            </div>

            {{-- Divider --}}
            <div class="border-t border-dashed border-olive-900/12 my-1"></div>

            {{-- Total --}}
            <div class="flex justify-between items-center">
                <span class="text-sm font-bold text-olive-900 uppercase tracking-wide">TOTAL</span>
                <span class="font-display text-xl font-bold text-olive-900">
                    Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                </span>
            </div>

            {{-- Divider --}}
            <div class="border-t border-olive-900/8 pt-2 mt-1 space-y-2">
                {{-- Tunai --}}
                <div class="flex justify-between items-center">
                    <span class="text-xs text-olive-900/45 uppercase tracking-wider font-semibold">Tunai Diterima</span>
                    <span class="text-sm text-olive-900/60 font-mono">
                        Rp {{ number_format($transaction->cash_received, 0, ',', '.') }}
                    </span>
                </div>
                {{-- Kembalian --}}
                <div class="flex justify-between items-center">
                    <span class="text-xs text-olive-900/45 uppercase tracking-wider font-semibold">Kembalian</span>
                    <span class="text-base font-bold text-mocca-dark font-mono">
                        Rp {{ number_format($transaction->cash_change, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="px-8 py-6 text-center">
            <div class="flex items-center gap-3 justify-center mb-3">
                <div class="h-px flex-1 bg-olive-900/6"></div>
                <span class="material-symbols-outlined text-olive-300" style="font-size:16px">favorite</span>
                <div class="h-px flex-1 bg-olive-900/6"></div>
            </div>
            <p class="text-olive-900/40 text-xs italic">Terima kasih telah berkunjung ke Filo Coffee!</p>
            <p class="text-olive-900/20 text-[0.6rem] mt-1 tracking-widest uppercase">Simpan struk ini sebagai bukti transaksi</p>
        </div>
    </div>

</div>

{{-- Print Styles --}}
<style>
@media print {
    aside, header, .print\:hidden { display: none !important; }
    main { margin: 0 !important; padding: 0 !important; }
    body { background: white !important; }
    .bg-white { box-shadow: none !important; border: 1px solid #e5e7eb !important; }
    .animate-fade-in-up { animation: none !important; }
}
</style>
@endsection
