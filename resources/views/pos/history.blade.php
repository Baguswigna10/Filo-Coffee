@extends('admin.layout')

@section('title', 'Riwayat Transaksi POS')
@section('page-title', 'Riwayat Transaksi')
@section('page-subtitle', 'Semua transaksi kasir yang telah dicatat')

@section('content')
<div class="space-y-6 animate-fade-in-up">

    {{-- Stats Summary --}}
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white border border-olive-900/8 rounded-2xl p-5 flex items-center gap-4 shadow-sm">
            <div class="w-11 h-11 rounded-xl bg-olive-50 border border-olive-200/60 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-olive-600" style="font-size:20px">receipt_long</span>
            </div>
            <div>
                <p class="text-[10px] text-olive-900/40 uppercase tracking-widest font-bold">Total Transaksi</p>
                <p class="text-2xl font-bold text-olive-900 font-display leading-none mt-0.5">{{ $totalCount }}</p>
            </div>
        </div>
        <div class="bg-white border border-olive-900/8 rounded-2xl p-5 flex items-center gap-4 shadow-sm">
            <div class="w-11 h-11 rounded-xl bg-beige-100 border border-beige-200/60 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-mocca-dark" style="font-size:20px">payments</span>
            </div>
            <div>
                <p class="text-[10px] text-olive-900/40 uppercase tracking-widest font-bold">Total Pendapatan</p>
                <p class="text-lg font-bold text-olive-900 font-display leading-none mt-0.5">
                    Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                </p>
            </div>
        </div>
        <div class="bg-white border border-olive-900/8 rounded-2xl p-5 flex items-center gap-4 shadow-sm">
            <div class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-200/60 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-emerald-600" style="font-size:20px">today</span>
            </div>
            <div>
                <p class="text-[10px] text-olive-900/40 uppercase tracking-widest font-bold">Transaksi Hari Ini</p>
                <p class="text-2xl font-bold text-olive-900 font-display leading-none mt-0.5">{{ $todayCount }}</p>
            </div>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="bg-white border border-olive-900/8 rounded-2xl shadow-sm overflow-hidden">

        {{-- Card Header --}}
        <div class="px-6 py-4 border-b border-olive-900/6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-olive-50 rounded-lg border border-olive-200/60 flex items-center justify-center">
                    <span class="material-symbols-outlined text-olive-600" style="font-size:16px">history</span>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-olive-900">Daftar Transaksi</h3>
                    <p class="text-xs text-olive-900/40">Semua transaksi POS tercatat</p>
                </div>
            </div>
            <a href="{{ route('admin.pos.index') }}"
               class="btn-mocca flex items-center gap-2 shadow-sm">
                <span class="material-symbols-outlined" style="font-size:15px">point_of_sale</span>
                Buka Kasir
            </a>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr class="border-b border-olive-900/5 bg-olive-50/50">
                        <th class="text-left">No. Transaksi</th>
                        <th class="text-left">Tanggal & Waktu</th>
                        <th class="text-left">Kasir</th>
                        <th class="text-right">Total</th>
                        <th class="text-right">Tunai</th>
                        <th class="text-right">Kembalian</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-olive-900/4">
                    @forelse($transactions as $transaction)
                    <tr class="hover:bg-olive-50/40 transition-colors duration-150">
                        {{-- No. Transaksi --}}
                        <td>
                            <span class="font-mono text-xs font-bold text-mocca-dark bg-beige-100 px-2.5 py-1 rounded-lg border border-beige-200/80 tracking-wide">
                                {{ $transaction->transaction_number }}
                            </span>
                        </td>

                        {{-- Tanggal --}}
                        <td>
                            <div class="text-sm font-semibold text-olive-900">{{ $transaction->created_at->format('d M Y') }}</div>
                            <div class="text-xs text-olive-900/35 font-mono mt-0.5">{{ $transaction->created_at->format('H:i:s') }}</div>
                        </td>

                        {{-- Kasir --}}
                        <td>
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-olive-100 to-olive-200 border border-olive-300/50 flex items-center justify-center flex-shrink-0">
                                    <span class="text-olive-700 text-[0.6rem] font-bold">{{ substr($transaction->user->name ?? 'S', 0, 1) }}</span>
                                </div>
                                <span class="text-sm text-olive-900/75 font-medium">{{ $transaction->user->name ?? 'System' }}</span>
                            </div>
                        </td>

                        {{-- Total --}}
                        <td class="text-right">
                            <span class="text-sm font-bold text-olive-900 font-mono">
                                Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                            </span>
                        </td>

                        {{-- Tunai --}}
                        <td class="text-right">
                            <span class="text-sm text-olive-900/55 font-mono">
                                Rp {{ number_format($transaction->cash_received, 0, ',', '.') }}
                            </span>
                        </td>

                        {{-- Kembalian --}}
                        <td class="text-right">
                            <span class="text-sm font-semibold text-mocca-dark font-mono">
                                Rp {{ number_format($transaction->cash_change, 0, ',', '.') }}
                            </span>
                        </td>

                        {{-- Aksi --}}
                        <td class="text-center">
                            <a href="{{ route('admin.pos.show', $transaction->id) }}"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold
                                      text-olive-700 bg-olive-50 border border-olive-200/70
                                      hover:bg-olive-100 hover:border-olive-300 transition-all duration-200">
                                <span class="material-symbols-outlined" style="font-size:13px">visibility</span>
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-20 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-14 h-14 rounded-2xl bg-olive-50 border border-olive-200/60 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-olive-400" style="font-size:24px">receipt_long</span>
                                </div>
                                <p class="text-sm font-semibold text-olive-900/50">Belum ada transaksi tercatat</p>
                                <p class="text-xs text-olive-900/30">Mulai transaksi pertama dari halaman kasir</p>
                                <a href="{{ route('admin.pos.index') }}" class="btn-mocca mt-1">Buka Kasir</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($transactions->hasPages())
        <div class="px-6 py-4 border-t border-olive-900/5 bg-olive-50/30 pagination-wrapper">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
