@extends('admin.layout')
@section('title', 'Reservasi Meja')
@section('page-title', 'Reservasi Meja')
@section('page-subtitle', 'Kelola reservasi meja pelanggan')

@section('content')
{{-- Filter --}}
<form method="GET" class="admin-card p-5 mb-6 animate-fade-in-up">
    <div class="flex flex-wrap items-center gap-3">
        <div class="relative">
            <select name="status" class="input-field w-auto text-sm pr-10">
                <option value="">Semua Status</option>
                @foreach(['Pending', 'Confirmed', 'Cancelled'] as $s)
                <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
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
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Tanggal & Waktu</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Area</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Tamu</th>
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
                        <div class="text-olive-900/70 text-xs font-semibold mb-0.5">{{ $res->reservation_date->format('d M Y') }}</div>
                        <div class="text-olive-900/40 text-[10px] font-bold uppercase tracking-wider leading-none">{{ substr($res->reservation_time, 0, 5) }}</div>
                    </td>
                    <td class="py-4 px-6">
                        <div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-[10px] font-bold bg-olive-50 text-olive-800 border border-olive-900/5">
                                {{ $res->area }}
                            </span>
                            @if($res->table_number)
                            <div class="text-mocca-dark text-[10px] font-bold mt-1 ml-0.5 uppercase tracking-wider">Meja {{ $res->table_number }}</div>
                            @endif
                        </div>
                    </td>
                    <td class="py-4 px-6 text-olive-900/70 font-bold text-xs">
                        {{ $res->guest_count }} orang
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
                                <span class="text-olive-900 text-xs font-bold uppercase tracking-wider">Update Status Reservasi</span>
                            </div>
                            <form action="{{ route('admin.reservations.tables.status', $res) }}" method="POST" class="space-y-3">
                                @csrf @method('PATCH')
                                <select name="status" class="input-field text-sm">
                                    @foreach(['Pending', 'Confirmed', 'Cancelled'] as $s)
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
                @if($res->special_request)
                <tr class="!border-t-0 bg-olive-50/5">
                    <td colspan="7" class="!pt-0 !pb-4 px-6">
                        <div class="flex items-start gap-2.5 ml-4 pl-4 border-l-2 border-mocca/30">
                            <span class="material-symbols-outlined text-mocca-dark text-xs mt-0.5">chat_bubble</span>
                            <p class="text-olive-900/60 text-xs leading-relaxed font-semibold italic">Permintaan khusus: "{{ $res->special_request }}"</p>
                        </div>
                    </td>
                </tr>
                @endif
                @empty
                <tr>
                    <td colspan="7" class="py-16 text-center">
                        <div class="flex flex-col items-center justify-center gap-3">
                            <div class="w-14 h-14 bg-olive-50 rounded-2xl flex items-center justify-center text-olive-900/20 shadow-inner">
                                <span class="material-symbols-outlined text-3xl">table_restaurant</span>
                            </div>
                            <p class="text-olive-900/30 font-semibold text-sm">Belum ada reservasi meja.</p>
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
