@extends('admin.layout')
@section('title', 'Manajemen Halaman')
@section('page-title', 'Manajemen Halaman')
@section('page-subtitle', 'Lihat atau sembunyikan halaman website')

@section('content')
<div class="admin-card animate-fade-in-up">
    <table class="w-full admin-table">
        <thead>
            <tr class="border-b border-white/[0.06]">
                <th class="text-left">Nama Halaman</th>
                <th class="text-left">Slug / Route</th>
                <th class="text-left">Status Visibilitas</th>
                <th class="text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/[0.03]">
            @forelse($pages as $page)
            <tr class="group">
                <td>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-white/[0.03] flex items-center justify-center ring-1 ring-white/[0.06]">
                            <svg class="w-4 h-4 text-mocca/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6m-6 4h1"/></svg>
                        </div>
                        <span class="text-cream font-medium text-sm">{{ $page->name }}</span>
                    </div>
                </td>
                <td>
                    <code class="text-[0.7rem] bg-white/[0.03] px-2 py-1 rounded text-cream/40">{{ $page->route_name }}</code>
                </td>
                <td>
                    @if($page->is_visible)
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                        <span class="w-1 h-1 bg-emerald-400 rounded-full"></span>
                        Visible
                    </span>
                    @else
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-white/[0.03] text-cream/20 border border-white/10">
                        <span class="w-1 h-1 bg-cream/20 rounded-full"></span>
                        Hidden
                    </span>
                    @endif
                </td>
                <td class="text-right">
                    <form action="{{ route('admin.pages.toggle', $page) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-lg text-xs font-bold uppercase tracking-widest transition-all duration-300 {{ $page->is_visible ? 'bg-white/[0.03] text-cream/30 hover:bg-white/[0.06] hover:text-red-400' : 'bg-mocca/10 text-mocca hover:bg-mocca/20' }}">
                            {{ $page->is_visible ? 'Sembunyikan' : 'Tampilkan' }}
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="!py-16 text-center">
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-12 h-12 bg-white/[0.03] rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-cream/15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <p class="text-cream/25 text-sm">Belum ada data halaman.</p>
                        <p class="text-cream/15 text-xs">Jalankan seeder untuk mengisi data awal.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-12 admin-card p-8 bg-mocca/5 border-mocca/10">
    <div class="flex items-start gap-4">
        <div class="w-10 h-10 rounded-xl bg-mocca/20 flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5 text-mocca" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <h4 class="text-mocca font-bold text-sm uppercase tracking-wider mb-2">Informasi Penting</h4>
            <p class="text-cream/40 text-xs leading-relaxed max-w-2xl">
                Daftar halaman di atas dikelola secara manual melalui kode program. Admin hanya dapat mengontrol apakah halaman tersebut dapat diakses oleh publik (Visible) atau disembunyikan (Hidden). Menghilangkan tanda centang "Visible" akan membuat halaman tersebut mengembalikan status 404 dan menghilangkan tautannya dari navigasi utama.
            </p>
        </div>
    </div>
</div>
@endsection
