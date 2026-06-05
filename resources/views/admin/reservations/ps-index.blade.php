@extends('admin.layout')
@section('title', 'Booking PS')
@section('page-title', 'Booking PlayStation')
@section('page-subtitle', 'Kelola booking PlayStation pelanggan')

@section('content')
{{-- Filter --}}
<form method="GET" class="admin-card p-4 mb-6 animate-fade-in-up">
    <div class="flex flex-wrap items-center gap-3">
        <select name="status" class="input-field w-auto text-sm">
            <option value="">Semua Status</option>
            @foreach(['Pending', 'Confirmed', 'Cancelled', 'Completed'] as $s)
            <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
        </select>
        <select name="console" class="input-field w-auto text-sm">
            <option value="">Semua Konsol</option>
            <option value="PS4" {{ request('console') == 'PS4' ? 'selected' : '' }}>PS4</option>
            <option value="PS5" {{ request('console') == 'PS5' ? 'selected' : '' }}>PS5</option>
        </select>
        <input type="date" name="date" value="{{ request('date') }}" class="input-field w-auto text-sm">
        <button type="submit" class="btn-mocca">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
            Filter
        </button>
    </div>
</form>

{{-- Table --}}
<div class="admin-card animate-fade-in-up" style="animation-delay: 0.1s">
    <table class="w-full admin-table">
        <thead>
            <tr class="border-b border-olive-900/5">
                <th class="text-left">Kode</th>
                <th class="text-left">Nama</th>
                <th class="text-left">Konsol</th>
                <th class="text-left">Tanggal</th>
                <th class="text-left">Waktu</th>
                <th class="text-left">Total</th>
                <th class="text-left">Status</th>
                <th class="text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-olive-900/5">
            @forelse($reservations as $res)
            <tr x-data="{ open: false }">
                <td class="text-mocca-dark font-bold">{{ $res->reservation_code }}</td>
                <td>
                    <div>
                        <div class="text-olive-900 text-sm font-semibold">{{ $res->name }}</div>
                        <div class="text-olive-900/35 text-xs font-semibold">{{ $res->phone }}</div>
                    </div>
                </td>
                <td>
                    <span class="badge {{ $res->console_type == 'PS5' ? 'bg-indigo-100 text-indigo-850' : 'bg-blue-100 text-blue-850' }}">
                        {{ $res->console_type }}
                    </span>
                </td>
                <td class="text-olive-900/50 font-semibold text-sm">{{ $res->reservation_date->format('d M Y') }}</td>
                <td>
                    <div class="text-olive-900/50 text-sm font-semibold">{{ substr($res->start_time, 0, 5) }} – {{ substr($res->end_time, 0, 5) }}</div>
                    <div class="text-olive-900/30 text-xs font-semibold">{{ $res->duration }} jam</div>
                </td>
                <td class="text-olive-900 font-bold">Rp {{ number_format($res->total_price, 0, ',', '.') }}</td>
                <td><span class="badge badge-{{ $res->status }}">{{ $res->status }}</span></td>
                <td class="text-right relative">
                    <button @click="open = !open" class="inline-flex items-center gap-1.5 text-olive-900/45 hover:text-olive-900 transition-colors duration-200 text-xs font-semibold">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Update
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 -translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-72 dropdown-panel p-5 z-20">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-6 h-6 bg-mocca/10 rounded-md flex items-center justify-center ring-1 ring-mocca/20">
                                <svg class="w-3 h-3 text-mocca-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            </div>
                            <span class="text-olive-900 text-xs font-semibold">Update Status</span>
                        </div>
                        <form action="{{ route('admin.reservations.ps.status', $res) }}" method="POST" class="space-y-3">
                            @csrf @method('PATCH')
                            <select name="status" class="input-field text-sm">
                                @foreach(['Pending', 'Confirmed', 'Cancelled', 'Completed'] as $s)
                                <option value="{{ $s }}" {{ $res->status == $s ? 'selected' : '' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                            <textarea name="admin_notes" rows="2" class="input-field text-sm resize-none" placeholder="Catatan admin...">{{ $res->admin_notes }}</textarea>
                            <button type="submit" class="btn-mocca w-full justify-center text-xs">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Simpan
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="!py-16 text-center">
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-12 h-12 bg-olive-50 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-olive-900/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/></svg>
                        </div>
                        <p class="text-olive-900/30 text-sm">Belum ada booking PS.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6 pagination-wrapper">{{ $reservations->links() }}</div>
@endsection
