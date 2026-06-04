@extends('admin.layout')
@section('title', 'Manajemen Menu')
@section('page-title', 'Manajemen Menu')
@section('page-subtitle', 'Kelola semua item menu kafe')

@section('content')
{{-- Header --}}
<div class="flex items-center justify-between mb-6 animate-fade-in-up">
    <div></div>
    <a href="{{ route('admin.menus.create') }}" class="btn-mocca">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Menu
    </a>
</div>

{{-- Filter --}}
<form method="GET" class="admin-card p-4 mb-6 animate-fade-in-up" style="animation-delay: 0.05s">
    <div class="flex flex-wrap items-center gap-3">
        <div class="relative flex-1 min-w-[200px] max-w-xs">
            <svg class="w-4 h-4 text-cream/20 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="search" value="{{ request('search') }}" class="input-field !pl-10 text-sm" placeholder="Cari menu...">
        </div>
        <select name="category" class="input-field w-auto text-sm">
            <option value="">Semua Kategori</option>
            @foreach(['Coffee', 'Non-Coffee', 'Food', 'Dessert', 'Seasonal'] as $cat)
            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn-mocca">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
            Filter
        </button>
    </div>
</form>

{{-- Table --}}
<div class="admin-card overflow-hidden animate-fade-in-up" style="animation-delay: 0.1s">
    <table class="w-full admin-table">
        <thead>
            <tr class="border-b border-white/[0.06]">
                <th class="text-left">Menu</th>
                <th class="text-left">Kategori</th>
                <th class="text-left">Harga</th>
                <th class="text-left">Status</th>
                <th class="text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/[0.03]">
            @forelse($menus as $menu)
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 flex-shrink-0 bg-white/[0.03] rounded-xl overflow-hidden ring-1 ring-white/[0.06]">
                            @if($menu->image)
                                <img src="{{ $menu->image_url }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-cream/15 text-sm">☕</div>
                            @endif
                        </div>
                        <div>
                            <p class="text-cream font-medium text-sm">{{ $menu->name }}</p>
                            @if($menu->is_featured)
                            <span class="inline-flex items-center gap-1 text-mocca text-[0.65rem] font-medium">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                Featured
                            </span>
                            @endif
                        </div>
                    </div>
                </td>
                <td>
                    <span class="text-cream/40 text-xs font-medium bg-white/[0.03] px-2.5 py-1 rounded-lg">{{ $menu->category }}</span>
                </td>
                <td class="text-cream font-medium">{{ $menu->formatted_price }}</td>
                <td>
                    <span class="badge {{ $menu->is_available ? 'bg-emerald-500/12 text-emerald-400 border border-emerald-500/20' : 'bg-red-500/12 text-red-400 border border-red-500/20' }}">
                        {{ $menu->is_available ? 'Tersedia' : 'Tidak Tersedia' }}
                    </span>
                </td>
                <td class="text-right">
                    <div class="flex items-center justify-end gap-1">
                        <a href="{{ route('admin.menus.edit', $menu) }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-cream/30 hover:text-mocca hover:bg-mocca/10 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" onsubmit="return confirm('Hapus menu ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg text-cream/20 hover:text-red-400 hover:bg-red-500/10 transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="!py-16 text-center">
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-12 h-12 bg-white/[0.03] rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-cream/15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <p class="text-cream/25 text-sm">Belum ada data menu.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6 pagination-wrapper">{{ $menus->links() }}</div>
@endsection
