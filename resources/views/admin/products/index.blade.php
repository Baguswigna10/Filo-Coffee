@extends('admin.layout')
@section('title', 'Produk Beans')
@section('page-title', 'Produk Biji Kopi')
@section('page-subtitle', 'Kelola katalog biji kopi')

@section('content')
{{-- Filter & Actions --}}
<form method="GET" class="admin-card p-5 mb-6 animate-fade-in-up" style="animation-delay: 0.05s">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div class="flex flex-wrap items-center gap-3 flex-1">
            <div class="relative flex-1 min-w-[220px] max-w-xs">
                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-olive-900/30 text-sm">search</span>
                <input type="text" name="search" value="{{ request('search') }}" class="input-field !pl-10 text-sm" placeholder="Cari produk...">
            </div>
            
            <div class="relative">
                <select name="roast" class="input-field w-auto text-sm pr-10">
                    <option value="">Semua Roast</option>
                    @foreach(['Light', 'Medium', 'Medium-Dark', 'Dark'] as $r)
                    <option value="{{ $r }}" {{ request('roast') == $r ? 'selected' : '' }}>{{ $r }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-mocca">
                <span class="material-symbols-outlined text-sm">filter_alt</span>
                Filter
            </button>
        </div>

        <a href="{{ route('admin.products.create') }}" class="bg-olive-800 hover:bg-olive-900 text-beige-50 px-5 py-2.5 rounded-2xl font-semibold flex items-center gap-2 transition-all hover:shadow-lg active:scale-95 text-xs">
            <span class="material-symbols-outlined text-sm">add</span>
            Tambah Produk
        </a>
    </div>
</form>

{{-- Table --}}
<div class="admin-card overflow-hidden animate-fade-in-up shadow-sm border border-olive-900/5" style="animation-delay: 0.1s">
    <div class="overflow-x-auto">
        <table class="w-full admin-table text-left border-collapse">
            <thead>
                <tr class="border-b border-olive-900/5 bg-olive-50/20">
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Produk</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Asal</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Roast</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Harga</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Stok</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800">Status</th>
                    <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-olive-800 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-olive-900/5">
                @forelse($products as $product)
                <tr class="hover:bg-olive-50/20 transition-colors">
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 flex-shrink-0 bg-olive-50 rounded-2xl overflow-hidden ring-1 ring-olive-900/5 relative">
                                @if($product->image)
                                    <img src="{{ $product->image_url }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-olive-100/40 text-olive-900/25">
                                        <span class="material-symbols-outlined text-lg">grain</span>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <p class="text-olive-900 font-semibold text-sm leading-tight mb-1">{{ $product->name }}</p>
                                <p class="text-olive-900/40 text-xs font-bold uppercase tracking-wider leading-none">{{ $product->weight_grams }}gr</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-6 text-olive-900/70 font-semibold text-xs">
                        {{ $product->origin }}
                    </td>
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-semibold bg-olive-50 text-olive-800 border border-olive-900/5">
                            {{ $product->roast_level }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-olive-900 font-bold text-sm">
                        {{ $product->formatted_price }}
                    </td>
                    <td class="py-4 px-6">
                        @if($product->stock == 0)
                        <span class="inline-flex items-center gap-1.5 text-red-600 font-bold text-xs bg-red-50 px-2.5 py-1 rounded-full border border-red-200 animate-pulse">
                            <span class="w-1.5 h-1.5 bg-red-650 rounded-full"></span>
                            Habis
                        </span>
                        @elseif($product->stock <= 5)
                        <span class="inline-flex items-center gap-1.5 text-amber-700 font-bold text-xs bg-amber-50 px-2.5 py-1 rounded-full border border-amber-250 animate-pulse">
                            <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                            {{ $product->stock }} Tersisa
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 text-emerald-700 font-bold text-xs bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-250">
                            <span class="w-1.5 h-1.5 bg-emerald-600 rounded-full"></span>
                            {{ $product->stock }}
                        </span>
                        @endif
                    </td>
                    <td class="py-4 px-6">
                        <span class="badge {{ $product->is_active ? 'badge-Confirmed' : 'badge-Cancelled' }}">
                            {{ $product->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-right">
                        <div class="flex items-center justify-end gap-1.5">
                            <a href="{{ route('admin.products.edit', $product) }}" class="w-9 h-9 flex items-center justify-center rounded-xl text-olive-900/40 hover:text-mocca-dark hover:bg-mocca/10 transition-all duration-200" title="Edit Produk">
                                <span class="material-symbols-outlined text-lg">edit</span>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-9 h-9 flex items-center justify-center rounded-xl text-olive-900/20 hover:text-red-650 hover:bg-red-50 transition-all duration-200" title="Hapus Produk">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-16 text-center">
                        <div class="flex flex-col items-center justify-center gap-3">
                            <div class="w-14 h-14 bg-olive-50 rounded-2xl flex items-center justify-center text-olive-900/20 shadow-inner">
                                <span class="material-symbols-outlined text-3xl">coffee_maker</span>
                            </div>
                            <p class="text-olive-900/30 font-semibold text-sm">Belum ada produk biji kopi.</p>
                            <p class="text-olive-900/20 text-xs">Coba ubah filter pencarian Anda atau tambahkan produk baru.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6 pagination-wrapper">
    {{ $products->links() }}
</div>
@endsection
