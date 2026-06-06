@extends('admin.layout')
@section('title', 'Booking PS')
@section('page-title', 'Booking PlayStation')
@section('page-subtitle', 'Kelola booking PlayStation pelanggan')

@section('content')
{{-- Filter --}}
<form method="GET" class="admin-card p-5 mb-6 animate-fade-in-up">
    <div class="flex flex-wrap items-center gap-3">
        <div class="relative">
            <select name="status" class="input-field w-auto text-sm pr-10">
                <option value="">Semua Status</option>
                @foreach(['Pending', 'Confirmed', 'Cancelled', 'Completed'] as $s)
                <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
            </select>
        </div>
        <div class="relative">
            <select name="console" class="input-field w-auto text-sm pr-10">
                <option value="">Semua Konsol</option>
                <option value="PS4" {{ request('console') == 'PS4' ? 'selected' : '' }}>PS4</option>
                <option value="PS5" {{ request('console') == 'PS5' ? 'selected' : '' }}>PS5</option>
            </select>
        </div>
        <input type="date" name="date" value="{{ request('date') }}" class="input-field w-auto text-sm">
        
        <button type="submit" class="btn-mocca">
            <span class="material-symbols-outlined text-sm">filter_alt</span>
            Filter
        </button>
    </div>
</form>

{{-- Table --}}
<div class="admin-card overflow-hidden animate-fade-in-up shadow-sm border border-olive-900/5" style="animation-delay: 0.1s">
    <div class="overflow-x-auto">
        <table class="w-full admin-table text-left border-collapse">
            <thead>
                <tr class="border-b border-olive-900/5 bg-olive-50/20">
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Kode</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Nama</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Konsol</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Tanggal</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Waktu</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Total</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Status</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-olive-900/5">
                @forelse($reservations as $res)
                <tr x-data="{ open: false }" class="hover:bg-olive-50/20 transition-colors">
                    <td class="py-4 px-6 text-mocca-dark font-bold text-sm font-mono">{{ $res->reservation_code }}</td>
                    <td class="py-4 px-6">
                        <div>
                            <div class="text-olive-900 text-sm font-semibold leading-tight mb-0.5">{{ $res->name }}</div>
                            <div class="text-olive-900/40 text-xs font-medium">{{ $res->phone }}</div>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-[10px] font-bold tracking-wider uppercase {{ $res->console_type == 'PS5' ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'bg-blue-50 text-blue-700 border border-blue-200' }}">
                            {{ $res->console_type }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-olive-900/70 font-semibold text-xs">
                        {{ $res->reservation_date->format('d M Y') }}
                    </td>
                    <td class="py-4 px-6">
                        <div class="text-olive-900/70 text-xs font-semibold mb-0.5">{{ substr($res->start_time, 0, 5) }} – {{ substr($res->end_time, 0, 5) }}</div>
                        <div class="text-olive-900/40 text-[10px] font-bold uppercase tracking-wider">{{ $res->duration }} jam</div>
                    </td>
                    <td class="py-4 px-6 text-olive-900 font-bold text-sm">
                        Rp {{ number_format($res->total_price, 0, ',', '.') }}
                    </td>
                    <td class="py-4 px-6">
                        <span class="badge badge-{{ $res->status }}">
                            {{ $res->status }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-right relative">
                        <button @click="open = !open" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-olive-50 hover:bg-olive-100/80 text-olive-900/60 hover:text-olive-900 transition-all text-xs font-bold uppercase tracking-wider">
                            <span class="material-symbols-outlined text-sm">edit</span>
                            Update
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 -translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-72 dropdown-panel p-5 z-20 text-left" style="display: none;">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-6 h-6 bg-mocca/10 rounded-md flex items-center justify-center ring-1 ring-mocca/20">
                                    <span class="material-symbols-outlined text-mocca-dark text-sm">sync_alt</span>
                                </div>
                                <span class="text-olive-900 text-xs font-bold uppercase tracking-wider">Update Booking Status</span>
                            </div>
                            <form action="{{ route('admin.reservations.ps.status', $res) }}" method="POST" class="space-y-3">
                                @csrf @method('PATCH')
                                <select name="status" class="input-field text-sm">
                                    @foreach(['Pending', 'Confirmed', 'Cancelled', 'Completed'] as $s)
                                    <option value="{{ $s }}" {{ $res->status == $s ? 'selected' : '' }}>{{ $s }}</option>
                                    @endforeach
                                </select>
                                <textarea name="admin_notes" rows="2" class="input-field text-sm resize-none" placeholder="Tambahkan catatan admin... (opsional)">{{ $res->admin_notes }}</textarea>
                                <button type="submit" class="btn-mocca w-full justify-center text-xs">
                                    <span class="material-symbols-outlined text-sm">save</span>
                                    Simpan Status
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="py-16 text-center">
                        <div class="flex flex-col items-center justify-center gap-3">
                            <div class="w-14 h-14 bg-olive-50 rounded-2xl flex items-center justify-center text-olive-900/20 shadow-inner">
                                <span class="material-symbols-outlined text-3xl">sports_esports</span>
                            </div>
                            <p class="text-olive-900/30 font-semibold text-sm">Belum ada booking PS.</p>
                            <p class="text-olive-900/20 text-xs">Coba ubah filter pencarian Anda atau tanggal reservasi.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6 pagination-wrapper">
    {{ $reservations->links() }}
</div>
@endsection
