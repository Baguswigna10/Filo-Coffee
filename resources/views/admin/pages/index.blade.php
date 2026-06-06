@extends('admin.layout')
@section('title', 'Manajemen Halaman')
@section('page-title', 'Manajemen Halaman')
@section('page-subtitle', 'Lihat atau sembunyikan halaman website')

@section('content')
<div class="admin-card overflow-hidden animate-fade-in-up shadow-sm border border-olive-900/5">
    <div class="overflow-x-auto">
        <table class="w-full admin-table text-left border-collapse">
            <thead>
                <tr class="border-b border-olive-900/5 bg-olive-50/20">
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Nama Halaman</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Slug / Route</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Status Visibilitas</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-olive-900/5">
                @forelse($pages as $page)
                <tr class="group hover:bg-olive-50/20 transition-colors">
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-olive-50 flex items-center justify-center ring-1 ring-olive-900/5 group-hover:bg-olive-100 transition-colors duration-200">
                                <span class="material-symbols-outlined text-mocca-dark text-lg">web</span>
                            </div>
                            <span class="text-olive-900 font-semibold text-sm">{{ $page->name }}</span>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        <code class="text-xs bg-olive-50 px-2.5 py-1 rounded-lg text-olive-900/60 font-semibold font-mono tracking-wide border border-olive-900/5">{{ $page->route_name }}</code>
                    </td>
                    <td class="py-4 px-6">
                        @if($page->is_visible)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span class="w-1.5 h-1.5 bg-emerald-600 rounded-full animate-pulse"></span>
                            Visible
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-olive-50 text-olive-900/40 border border-olive-900/10">
                            <span class="w-1.5 h-1.5 bg-olive-900/30 rounded-full"></span>
                            Hidden
                        </span>
                        @endif
                    </td>
                    <td class="py-4 px-6 text-right">
                        <form action="{{ route('admin.pages.toggle', $page) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-300 shadow-sm {{ $page->is_visible ? 'bg-olive-50 hover:bg-red-50 text-olive-900/50 hover:text-red-650 border border-olive-900/5 hover:border-red-200' : 'bg-mocca/10 hover:bg-mocca/20 text-mocca-dark border border-mocca/10' }}">
                                <span class="material-symbols-outlined text-sm">{{ $page->is_visible ? 'visibility_off' : 'visibility' }}</span>
                                {{ $page->is_visible ? 'Sembunyikan' : 'Tampilkan' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-16 text-center">
                        <div class="flex flex-col items-center justify-center gap-3">
                            <div class="w-14 h-14 bg-olive-50 rounded-2xl flex items-center justify-center text-olive-900/20 shadow-inner">
                                <span class="material-symbols-outlined text-3xl">web</span>
                            </div>
                            <p class="text-olive-900/30 font-semibold text-sm">Belum ada data halaman.</p>
                            <p class="text-olive-900/20 text-xs">Jalankan seeder untuk mengisi data awal.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-8 admin-card p-6 bg-mocca/5 border border-mocca/20 rounded-3xl animate-fade-in-up" style="animation-delay: 0.15s">
    <div class="flex items-start gap-4">
        <div class="w-10 h-10 rounded-2xl bg-mocca/15 flex items-center justify-center flex-shrink-0 text-mocca-dark shadow-sm ring-1 ring-mocca/25">
            <span class="material-symbols-outlined text-lg">info</span>
        </div>
        <div>
            <h4 class="text-mocca-dark font-bold text-xs uppercase tracking-wider mb-1.5">Informasi Penting</h4>
            <p class="text-olive-900/60 text-xs leading-relaxed max-w-2xl font-semibold">
                Daftar halaman di atas dikelola secara manual melalui kode program. Admin hanya dapat mengontrol apakah halaman tersebut dapat diakses oleh publik (Visible) atau disembunyikan (Hidden). Menghilangkan tanda centang "Visible" akan membuat halaman tersebut mengembalikan status 404 dan menghilangkan tautannya dari navigasi utama.
            </p>
        </div>
    </div>
</div>
@endsection
