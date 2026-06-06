@extends('admin.layout')
@section('title', 'Transaksi')
@section('page-title', 'Manajemen Transaksi & Booking')
@section('page-subtitle', 'Kelola semua pembelian menu kopi dan booking PlayStation')

@section('content')
{{-- Filter & Export --}}
<form method="GET" class="admin-card p-5 mb-6 animate-fade-in-up">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div class="flex flex-wrap items-center gap-3 flex-1">
            <div class="relative flex-1 min-w-[220px] max-w-xs">
                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-olive-900/30 text-sm">search</span>
                <input type="text" name="search" value="{{ request('search') }}" class="input-field !pl-10 text-sm" placeholder="Cari kode order/booking...">
            </div>
            
            {{-- Filter Tipe --}}
            <div class="relative">
                <select name="type" class="input-field w-auto text-sm pr-10">
                    <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>Semua Tipe</option>
                    <option value="menu" {{ request('type') == 'menu' ? 'selected' : '' }}>Pesanan Menu (Cafe)</option>
                    <option value="beans" {{ request('type') == 'beans' ? 'selected' : '' }}>Pembelian Shop Beans</option>
                    <option value="pos" {{ request('type') == 'pos' ? 'selected' : '' }}>Pemesanan Kasir (POS)</option>
                    <option value="ps" {{ request('type') == 'ps' ? 'selected' : '' }}>Booking PlayStation</option>
                    <option value="table" {{ request('type') == 'table' ? 'selected' : '' }}>Reservasi Meja</option>
                </select>
            </div>

            {{-- Filter Waktu --}}
            <div class="relative">
                <select name="date_filter" class="input-field w-auto text-sm pr-10">
                    <option value="">Semua Waktu</option>
                    <option value="today" {{ request('date_filter') == 'today' ? 'selected' : '' }}>Harian (Hari Ini)</option>
                    <option value="this_week" {{ request('date_filter') == 'this_week' ? 'selected' : '' }}>Mingguan (Minggu Ini)</option>
                    <option value="this_month" {{ request('date_filter') == 'this_month' ? 'selected' : '' }}>Bulanan (Bulan Ini)</option>
                    <option value="this_year" {{ request('date_filter') == 'this_year' ? 'selected' : '' }}>Tahunan (Tahun Ini)</option>
                </select>
            </div>

            <div class="relative">
                <select name="status" class="input-field w-auto text-sm pr-10">
                    <option value="">Semua Status</option>
                    @foreach(['Pending', 'Paid', 'Confirmed', 'Processing', 'Shipped', 'Completed', 'Cancelled'] as $s)
                    <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn-mocca">
                <span class="material-symbols-outlined text-sm">filter_alt</span>
                Filter
            </button>
        </div>

        {{-- Export CSV Button --}}
        <div>
            <a href="{{ request()->fullUrlWithQuery(['export' => 'csv']) }}" class="btn-outline-mocca flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">download</span>
                Export CSV
            </a>
        </div>
    </div>
</form>

{{-- Table --}}
<div class="admin-card overflow-hidden animate-fade-in-up border border-olive-800/20" style="animation-delay: 0.1s">
    <div class="overflow-x-auto">
        <table class="w-full admin-table text-left border-collapse">
            <thead>
                <tr class="border-b border-olive-900/5 bg-olive-50/20">
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Kode Transaksi</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Pelanggan</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Tipe</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Total</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Metode</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Status</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Tanggal</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-olive-900/5">
                @forelse($records as $record)
                <tr class="hover:bg-olive-50/20 transition-colors">
                    <td class="py-4 px-6 text-mocca-dark font-bold text-sm font-mono">{{ $record['code'] }}</td>
                    <td class="py-4 px-6 text-olive-900/70 font-semibold text-xs">{{ $record['customer'] }}</td>
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-[9px] font-bold tracking-wider uppercase 
                            {{ $record['type_raw'] === 'menu' ? 'bg-mocca/10 text-mocca-dark border border-mocca/20' : '' }}
                            {{ $record['type_raw'] === 'beans' ? 'bg-amber-50 text-amber-800 border border-amber-200' : '' }}
                            {{ $record['type_raw'] === 'pos' ? 'bg-purple-50 text-purple-800 border border-purple-200' : '' }}
                            {{ $record['type_raw'] === 'ps' ? 'bg-blue-50 text-blue-800 border border-blue-200' : '' }}
                            {{ $record['type_raw'] === 'table' ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : '' }}
                        ">
                            {{ $record['type'] }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-olive-900 font-bold text-sm">
                        {{ $record['total_price'] > 0 ? 'Rp ' . number_format($record['total_price'], 0, ',', '.') : 'Gratis / Free' }}
                    </td>
                    <td class="py-4 px-6 text-olive-900/50 text-xs font-bold uppercase tracking-wider">{{ $record['payment_method'] }}</td>
                    <td class="py-4 px-6"><span class="badge badge-{{ $record['status'] }}">{{ $record['status'] }}</span></td>
                    <td class="py-4 px-6 text-olive-900/50 text-xs font-semibold">{{ $record['date'] }}</td>
                    <td class="py-4 px-6 text-right">
                        <a href="{{ $record['show_url'] }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-olive-50 hover:bg-olive-100 text-olive-900/60 hover:text-olive-900 transition-all text-xs font-bold uppercase tracking-wider group">
                            Detail
                            <span class="material-symbols-outlined text-xs transition-transform duration-200 group-hover:translate-x-0.5">chevron_right</span>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="py-16 text-center">
                        <div class="flex flex-col items-center justify-center gap-3">
                            <div class="w-14 h-14 bg-olive-50 rounded-2xl flex items-center justify-center text-olive-900/20">
                                <span class="material-symbols-outlined text-3xl">receipt_long</span>
                            </div>
                            <p class="text-olive-900/30 font-semibold text-sm">Belum ada transaksi.</p>
                            <p class="text-olive-900/20 text-xs">Coba ubah filter pencarian atau tipe transaksi.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6 pagination-wrapper">
    {{ $records->links() }}
</div>
@endsection
