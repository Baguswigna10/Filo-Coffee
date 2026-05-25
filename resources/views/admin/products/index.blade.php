@extends('admin.layout')
@section('title', 'Produk Beans')
@section('page-title', 'Produk Biji Kopi')
@section('page-subtitle', 'Kelola katalog biji kopi')

@section('content')
{{-- Header --}}
<div class="flex items-center justify-between mb-6 animate-fade-in-up">
    <div></div>
    <a href="{{ route('admin.products.create') }}" class="btn-mocca">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Produk
    </a>
</div>

{{-- Filter --}}
<form method="GET" class="admin-card p-4 mb-6 animate-fade-in-up" style="animation-delay: 0.05s">
    <div class="flex flex-wrap items-center gap-3">
        <div class="relative flex-1 min-w-[200px] max-w-xs">
            <svg class="w-4 h-4 text-cream/20 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="search" value="{{ request('search') }}" class="input-field !pl-10 text-sm" placeholder="Cari produk...">
        </div>
        <select name="roast" class="input-field w-auto text-sm">
            <option value="">Semua Roast</option>
            @foreach(['Light', 'Medium', 'Medium-Dark', 'Dark'] as $r)
            <option value="{{ $r }}" {{ request('roast') == $r ? 'selected' : '' }}>{{ $r }}</option>
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
                <th class="text-left">Produk</th>
                <th class="text-left">Asal</th>
                <th class="text-left">Roast</th>
                <th class="text-left">Harga</th>
                <th class="text-left">Stok</th>
                <th class="text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/[0.03]">
            @forelse($products as $product)
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 flex-shrink-0 bg-white/[0.03] rounded-xl overflow-hidden ring-1 ring-white/[0.06]">
                            @if($product->image)
                                <img src="{{ $product->image_url }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-cream/15 text-sm">🫘</div>
                            @endif
                        </div>
                        <div>
                            <p class="text-cream font-medium text-sm">{{ $product->name }}</p>
                            <p class="text-cream/25 text-xs">{{ $product->weight_grams }}gr</p>
                        </div>
                    </div>
                </td>
                <td class="text-cream/40">{{ $product->origin }}</td>
                <td>
                    <span class="text-cream/40 text-xs font-medium bg-white/[0.03] px-2.5 py-1 rounded-lg">{{ $product->roast_level }}</span>
                </td>
                <td class="text-cream font-medium">{{ $product->formatted_price }}</td>
                <td>
                    @if($product->stock == 0)
                    <span class="inline-flex items-center gap-1.5 text-red-400 font-semibold text-xs">
                        <span class="w-1.5 h-1.5 bg-red-400 rounded-full"></span>
                        Habis
                    </span>
                    @elseif($product->stock <= 5)
                    <span class="inline-flex items-center gap-1.5 text-amber-400 font-semibold text-xs">
                        <span class="w-1.5 h-1.5 bg-amber-400 rounded-full animate-pulse"></span>
                        {{ $product->stock }} tersisa
                    </span>
                    @else
                    <span class="text-cream/40 text-sm">{{ $product->stock }}</span>
                    @endif
                </td>
                <td class="text-right">
                    <div class="flex items-center justify-end gap-1">
                        <a href="{{ route('admin.products.edit', $product) }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-cream/30 hover:text-mocca hover:bg-mocca/10 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
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
                <td colspan="6" class="!py-16 text-center">
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-12 h-12 bg-white/[0.03] rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-cream/15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <p class="text-cream/25 text-sm">Belum ada produk.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6 pagination-wrapper">{{ $products->links() }}</div>
@endsection
