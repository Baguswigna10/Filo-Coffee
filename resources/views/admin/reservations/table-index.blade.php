@extends('admin.layout')
@section('title', 'Reservasi Meja')
@section('page-title', 'Reservasi Meja')
@section('page-subtitle', 'Kelola reservasi meja pelanggan')

@section('content')
{{-- Filter --}}
<form method="GET" class="admin-card p-4 mb-6 animate-fade-in-up">
    <div class="flex flex-wrap items-center gap-3">
        <select name="status" class="input-field w-auto text-sm">
            <option value="">Semua Status</option>
            @foreach(['Pending', 'Confirmed', 'Cancelled'] as $s)
            <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
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
            <tr class="border-b border-white/[0.06]">
                <th class="text-left">Kode</th>
                <th class="text-left">Nama</th>
                <th class="text-left">Tanggal & Waktu</th>
                <th class="text-left">Area</th>
                <th class="text-left">Tamu</th>
                <th class="text-left">Status</th>
                <th class="text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/[0.03]">
            @forelse($reservations as $res)
            <tr x-data="{ open: false }">
                <td class="text-mocca font-medium">{{ $res->reservation_code }}</td>
                <td>
                    <div>
                        <div class="text-cream text-sm font-medium">{{ $res->name }}</div>
                        <div class="text-cream/25 text-xs">{{ $res->phone }}</div>
                    </div>
                </td>
                <td>
                    <div class="text-cream/60 text-sm">{{ $res->reservation_date->format('d M Y') }}</div>
                    <div class="text-cream/25 text-xs">{{ substr($res->reservation_time, 0, 5) }}</div>
                </td>
                <td>
                    <span class="text-cream/40 text-xs font-medium bg-white/[0.03] px-2.5 py-1 rounded-lg">{{ $res->area }}</span>
                </td>
                <td class="text-cream/40">{{ $res->guest_count }} orang</td>
                <td><span class="badge badge-{{ $res->status }}">{{ $res->status }}</span></td>
                <td class="text-right relative">
                    <button @click="open = !open" class="inline-flex items-center gap-1.5 text-cream/40 hover:text-mocca transition-colors duration-200 text-xs font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Update
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 -translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-72 dropdown-panel p-5 z-20">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-6 h-6 bg-mocca/10 rounded-md flex items-center justify-center ring-1 ring-mocca/20">
                                <svg class="w-3 h-3 text-mocca" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            </div>
                            <span class="text-cream text-xs font-semibold">Update Status</span>
                        </div>
                        <form action="{{ route('admin.reservations.tables.status', $res) }}" method="POST" class="space-y-3">
                            @csrf @method('PATCH')
                            <select name="status" class="input-field text-sm">
                                @foreach(['Pending', 'Confirmed', 'Cancelled'] as $s)
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
            @if($res->special_request)
            <tr class="!border-t-0">
                <td colspan="7" class="!pt-0 !pb-3">
                    <div class="flex items-start gap-2 ml-4 pl-4 border-l-2 border-mocca/15">
                        <svg class="w-3.5 h-3.5 text-mocca/40 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        <p class="text-cream/30 text-xs leading-relaxed">{{ $res->special_request }}</p>
                    </div>
                </td>
            </tr>
            @endif
            @empty
            <tr>
                <td colspan="7" class="!py-16 text-center">
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-12 h-12 bg-white/[0.03] rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-cream/15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <p class="text-cream/25 text-sm">Belum ada reservasi meja.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6 pagination-wrapper">{{ $reservations->links() }}</div>
@endsection
