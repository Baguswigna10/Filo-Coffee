@extends('admin.layout')

@section('title', 'Riwayat Transaksi POS')
@section('page-title', 'Riwayat Transaksi')
@section('page-subtitle', 'Semua transaksi kasir yang telah dicatat')

@section('content')
<div class="space-y-6 animate-fade-in-up">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-cream text-lg font-semibold">Riwayat POS</h2>
            <p class="text-cream/30 text-sm mt-0.5">Daftar transaksi yang diproses melalui kasir</p>
        </div>
        <a href="{{ route('admin.pos.index') }}"
           class="btn-mocca flex items-center gap-2 shadow-lg shadow-mocca/10">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
            Buka Kasir
        </a>
    </div>

    {{-- Table --}}
    <div class="admin-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr class="border-b border-white/[0.05]">
                        <th class="text-left">No. Transaksi</th>
                        <th class="text-left">Tanggal & Waktu</th>
                        <th class="text-left">Kasir</th>
                        <th class="text-right">Total</th>
                        <th class="text-right">Tunai</th>
                        <th class="text-right">Kembalian</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.03]">
                    @forelse($transactions as $transaction)
                    <tr class="hover:bg-white/[0.015] transition-colors">
                        <td>
                            <span class="text-mocca font-bold font-mono text-xs tracking-wider">{{ $transaction->transaction_number }}</span>
                        </td>
                        <td class="text-cream/50">
                            <div class="text-sm">{{ $transaction->created_at->format('d M Y') }}</div>
                            <div class="text-xs text-cream/25 font-mono">{{ $transaction->created_at->format('H:i:s') }}</div>
                        </td>
                        <td class="text-cream/60">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-mocca/10 border border-mocca/20 flex items-center justify-center flex-shrink-0">
                                    <span class="text-mocca text-[0.55rem] font-bold">{{ substr($transaction->user->name ?? 'S', 0, 1) }}</span>
                                </div>
                                <span class="text-sm">{{ $transaction->user->name ?? 'System' }}</span>
                            </div>
                        </td>
                        <td class="text-right">
                            <span class="text-cream font-bold font-mono">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
                        </td>
                        <td class="text-right text-cream/50 text-sm font-mono">
                            Rp {{ number_format($transaction->cash_received, 0, ',', '.') }}
                        </td>
                        <td class="text-right">
                            <span class="text-mocca font-semibold text-sm font-mono">Rp {{ number_format($transaction->cash_change, 0, ',', '.') }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.pos.show', $transaction->id) }}"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold transition-all"
                               style="background: rgba(204,177,150,0.08); color: #CCB196; border: 1px solid rgba(204,177,150,0.2);"
                               onmouseover="this.style.background='rgba(204,177,150,0.15)'"
                               onmouseout="this.style.background='rgba(204,177,150,0.08)'">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-12 h-12 rounded-2xl bg-white/[0.03] border border-white/[0.05] flex items-center justify-center">
                                    <svg class="w-5 h-5 text-cream/15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                                <p class="text-cream/25 text-sm">Belum ada transaksi tercatat.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($transactions->hasPages())
        <div class="px-6 py-4 border-t border-white/[0.05] pagination-wrapper">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
