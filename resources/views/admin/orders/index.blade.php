@extends('admin.layout')
@section('title', 'Transaksi')
@section('page-title', 'Manajemen Transaksi & Booking')
@section('page-subtitle', 'Kelola semua pembelian menu kopi dan booking PlayStation')

@section('content')
{{-- Filter --}}
<form method="GET" class="admin-card p-4 mb-6 animate-fade-in-up">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div class="flex flex-wrap items-center gap-3 flex-1">
            <div class="relative flex-1 min-w-[200px] max-w-xs">
                <svg class="w-4 h-4 text-olive-900/30 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="search" value="{{ request('search') }}" class="input-field !pl-10 text-sm" placeholder="Cari kode order/booking...">
            </div>
            
            {{-- Filter Tipe --}}
            <select name="type" class="input-field w-auto text-sm">
                <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>Semua Tipe</option>
                <option value="menu" {{ request('type') == 'menu' ? 'selected' : '' }}>Pesanan Menu (Cafe)</option>
                <option value="beans" {{ request('type') == 'beans' ? 'selected' : '' }}>Pembelian Shop Beans</option>
                <option value="pos" {{ request('type') == 'pos' ? 'selected' : '' }}>Pemesanan Kasir (POS)</option>
                <option value="ps" {{ request('type') == 'ps' ? 'selected' : '' }}>Booking PlayStation</option>
                <option value="table" {{ request('type') == 'table' ? 'selected' : '' }}>Reservasi Meja</option>
            </select>

            {{-- Filter Waktu --}}
            <select name="date_filter" class="input-field w-auto text-sm">
                <option value="">Semua Waktu</option>
                <option value="today" {{ request('date_filter') == 'today' ? 'selected' : '' }}>Harian (Hari Ini)</option>
                <option value="this_week" {{ request('date_filter') == 'this_week' ? 'selected' : '' }}>Mingguan (Minggu Ini)</option>
                <option value="this_month" {{ request('date_filter') == 'this_month' ? 'selected' : '' }}>Bulanan (Bulan Ini)</option>
                <option value="this_year" {{ request('date_filter') == 'this_year' ? 'selected' : '' }}>Tahunan (Tahun Ini)</option>
            </select>

            <select name="status" class="input-field w-auto text-sm">
                <option value="">Semua Status</option>
                @foreach(['Pending', 'Paid', 'Confirmed', 'Processing', 'Shipped', 'Completed', 'Cancelled'] as $s)
                <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
            </select>
            
            <button type="submit" class="btn-mocca">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                Filter
            </button>
        </div>

        {{-- Export CSV Button --}}
        <div>
            <a href="{{ request()->fullUrlWithQuery(['export' => 'csv']) }}" class="btn-outline-mocca flex items-center gap-2">
                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Export CSV
            </a>
        </div>
    </div>
</form>

{{-- Table --}}
<div class="admin-card overflow-hidden animate-fade-in-up" style="animation-delay: 0.1s">
    <table class="w-full admin-table">
        <thead>
            <tr class="border-b border-olive-900/5">
                <th class="text-left">Kode Transaksi</th>
                <th class="text-left">Pelanggan</th>
                <th class="text-left">Tipe</th>
                <th class="text-left">Total</th>
                <th class="text-left">Metode</th>
                <th class="text-left">Status</th>
                <th class="text-left">Tanggal</th>
                <th class="text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-olive-900/5">
            @forelse($records as $record)
            <tr>
                <td class="text-mocca-dark font-bold">{{ $record['code'] }}</td>
                <td class="text-olive-900/60 font-semibold">{{ $record['customer'] }}</td>
                <td>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-[10px] font-bold tracking-wide uppercase 
                        {{ $record['type_raw'] === 'menu' ? 'bg-mocca/10 text-mocca-dark' : '' }}
                        {{ $record['type_raw'] === 'beans' ? 'bg-amber-100 text-amber-800' : '' }}
                        {{ $record['type_raw'] === 'pos' ? 'bg-purple-100 text-purple-800' : '' }}
                        {{ $record['type_raw'] === 'ps' ? 'bg-blue-100 text-blue-800' : '' }}
                        {{ $record['type_raw'] === 'table' ? 'bg-emerald-100 text-emerald-800' : '' }}
                    ">
                        {{ $record['type'] }}
                    </span>
                </td>
                <td class="text-olive-900 font-bold">
                    {{ $record['total_price'] > 0 ? 'Rp ' . number_format($record['total_price'], 0, ',', '.') : 'Gratis / Free' }}
                </td>
                <td class="text-olive-900/40 text-xs font-semibold">{{ $record['payment_method'] }}</td>
                <td><span class="badge badge-{{ $record['status'] }}">{{ $record['status'] }}</span></td>
                <td class="text-olive-950/40 text-xs font-semibold">{{ $record['date'] }}</td>
                <td class="text-right">
                    <a href="{{ $record['show_url'] }}" class="inline-flex items-center gap-1.5 text-olive-900/45 hover:text-olive-900 transition-colors duration-200 text-xs font-semibold group">
                        Detail
                        <svg class="w-3 h-3 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="!py-16 text-center">
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-12 h-12 bg-olive-50 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-olive-900/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        </div>
                        <p class="text-olive-900/30 text-sm">Belum ada transaksi.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6 pagination-wrapper">{{ $records->links() }}</div>
@endsection
