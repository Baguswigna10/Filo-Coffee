@extends('admin.layout')
@section('title', 'Manajemen Menu')
@section('page-title', 'Manajemen Menu')
@section('page-subtitle', 'Kelola semua item menu kafe')

@section('content')
{{-- Filter & Actions --}}
<form method="GET" class="admin-card p-5 mb-6 animate-fade-in-up" style="animation-delay: 0.05s">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div class="flex flex-wrap items-center gap-3 flex-1">
            <div class="relative flex-1 min-w-[220px] max-w-xs">
                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-olive-900/30 text-sm">search</span>
                <input type="text" name="search" value="{{ request('search') }}" class="input-field !pl-10 text-sm" placeholder="Cari menu...">
            </div>
            
            <div class="relative">
                <select name="category" class="input-field w-auto text-sm pr-10">
                    <option value="">Semua Kategori</option>
                    @foreach(['Manual Brew', 'Non-Coffee', 'Coffee', 'Signature'] as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-mocca">
                <span class="material-symbols-outlined text-sm">filter_alt</span>
                Filter
            </button>
        </div>

        <a href="{{ route('admin.menus.create') }}" class="bg-olive-800 hover:bg-olive-900 text-beige-50 px-5 py-2.5 rounded-2xl font-semibold flex items-center gap-2 transition-all hover:shadow-lg active:scale-95 text-xs">
            <span class="material-symbols-outlined text-sm">add</span>
            Tambah Menu
        </a>
    </div>
</form>

{{-- Table --}}
<div class="admin-card overflow-hidden animate-fade-in-up shadow-sm border border-olive-900/5" style="animation-delay: 0.1s">
    <div class="overflow-x-auto">
        <table class="w-full admin-table text-left border-collapse">
            <thead>
                <tr class="border-b border-olive-900/5 bg-olive-50/20">
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Menu</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Kategori</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Harga</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Status</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-olive-900/5">
                @forelse($menus as $menu)
                <tr class="hover:bg-olive-50/20 transition-colors">
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 flex-shrink-0 bg-olive-50 rounded-2xl overflow-hidden ring-1 ring-olive-900/5 relative">
                                @if($menu->image)
                                    <img src="{{ $menu->image_url }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-olive-100/40 text-olive-900/25">
                                        <span class="material-symbols-outlined text-lg">local_cafe</span>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <p class="text-olive-900 font-semibold text-sm leading-tight mb-1">{{ $menu->name }}</p>
                                @if($menu->is_featured)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                    <span class="material-symbols-outlined text-[10px] text-amber-600 mr-0.5" style="font-variation-settings: 'FILL' 1;">star</span>
                                    Featured
                                </span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-semibold bg-olive-50 text-olive-800 border border-olive-900/5">
                            {{ $menu->category }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-olive-900 font-bold text-sm">
                        {{ $menu->formatted_price }}
                    </td>
                    <td class="py-4 px-6">
                        <span class="badge {{ $menu->is_available ? 'badge-Confirmed' : 'badge-Cancelled' }}">
                            {{ $menu->is_available ? 'Tersedia' : 'Tidak Tersedia' }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-right">
                        <div class="flex items-center justify-end gap-1.5">
                            <a href="{{ route('admin.menus.edit', $menu) }}" class="w-9 h-9 flex items-center justify-center rounded-xl text-olive-900/40 hover:text-mocca-dark hover:bg-mocca/10 transition-all duration-200" title="Edit Menu">
                                <span class="material-symbols-outlined text-lg">edit</span>
                            </a>
                            <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" onsubmit="return confirm('Hapus menu ini?')" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-9 h-9 flex items-center justify-center rounded-xl text-olive-900/20 hover:text-red-650 hover:bg-red-50 transition-all duration-200" title="Hapus Menu">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-16 text-center">
                        <div class="flex flex-col items-center justify-center gap-3">
                            <div class="w-14 h-14 bg-olive-50 rounded-2xl flex items-center justify-center text-olive-900/20 shadow-inner">
                                <span class="material-symbols-outlined text-3xl">restaurant_menu</span>
                            </div>
                            <p class="text-olive-900/30 font-semibold text-sm">Belum ada data menu.</p>
                            <p class="text-olive-900/20 text-xs">Coba ubah filter pencarian Anda atau tambahkan menu baru.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6 pagination-wrapper">
    {{ $menus->links() }}
</div>
@endsection
