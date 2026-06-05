@extends('admin.layout')
@section('title', 'Manajemen Halaman')
@section('page-title', 'Manajemen Halaman')
@section('page-subtitle', 'Lihat atau sembunyikan halaman website')

@section('content')
<div class="admin-card animate-fade-in-up">
    <table class="w-full admin-table">
        <thead>
            <tr class="border-b border-olive-900/5">
                <th class="text-left">Nama Halaman</th>
                <th class="text-left">Slug / Route</th>
                <th class="text-left">Status Visibilitas</th>
                <th class="text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-olive-900/5">
            @forelse($pages as $page)
            <tr class="group">
                <td>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-olive-50 flex items-center justify-center ring-1 ring-olive-900/5">
                            <svg class="w-4 h-4 text-mocca-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6m-6 4h1"/></svg>
                        </div>
                        <span class="text-olive-900 font-semibold text-sm">{{ $page->name }}</span>
                    </div>
                </td>
                <td>
                    <code class="text-[0.7rem] bg-olive-50 px-2 py-1 rounded text-olive-900/55 font-bold font-mono">{{ $page->route_name }}</code>
                </td>
                <td>
                    @if($page->is_visible)
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-250">
                        <span class="w-1.5 h-1.5 bg-emerald-600 rounded-full animate-pulse"></span>
                        Visible
                    </span>
                    @else
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-olive-50 text-olive-900/35 border border-olive-900/10">
                        <span class="w-1.5 h-1.5 bg-olive-900/30 rounded-full"></span>
                        Hidden
                    </span>
                    @endif
                </td>
                <td class="text-right">
                    <form action="{{ route('admin.pages.toggle', $page) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-lg text-xs font-bold uppercase tracking-widest transition-all duration-300 {{ $page->is_visible ? 'bg-olive-50 text-olive-900/40 hover:bg-red-50 hover:text-red-650' : 'bg-mocca/10 text-mocca-dark hover:bg-mocca/20' }}">
                            {{ $page->is_visible ? 'Sembunyikan' : 'Tampilkan' }}
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="!py-16 text-center">
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-12 h-12 bg-olive-50 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-olive-900/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <p class="text-olive-900/30 text-sm">Belum ada data halaman.</p>
                        <p class="text-olive-900/20 text-xs">Jalankan seeder untuk mengisi data awal.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-12 admin-card p-8 bg-mocca/5 border border-mocca/20 rounded-[2rem]">
    <div class="flex items-start gap-4">
        <div class="w-10 h-10 rounded-xl bg-mocca/20 flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5 text-mocca-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <h4 class="text-mocca-dark font-bold text-sm uppercase tracking-wider mb-2">Informasi Penting</h4>
            <p class="text-olive-900/60 text-xs leading-relaxed max-w-2xl font-semibold">
                Daftar halaman di atas dikelola secara manual melalui kode program. Admin hanya dapat mengontrol apakah halaman tersebut dapat diakses oleh publik (Visible) atau disembunyikan (Hidden). Menghilangkan tanda centang "Visible" akan membuat halaman tersebut mengembalikan status 404 dan menghilangkan tautannya dari navigasi utama.
            </p>
        </div>
    </div>
</div>
@endsection
