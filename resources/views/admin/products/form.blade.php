@extends('admin.layout')
@section('title', $product->exists ? 'Edit Produk' : 'Tambah Produk')
@section('page-title', $product->exists ? 'Edit Produk' : 'Tambah Produk')
@section('page-subtitle', $product->exists ? $product->name : 'Tambahkan produk biji kopi baru')

@section('content')
<div class="max-w-2xl animate-fade-in-up">
    <form action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}"
          method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if($product->exists) @method('PUT') @endif

        <div class="admin-card p-6 space-y-5">
            {{-- Section header --}}
            <div class="flex items-center gap-3 pb-4 border-b border-olive-900/5">
                <div class="w-8 h-8 bg-mocca/10 rounded-lg flex items-center justify-center ring-1 ring-mocca/20">
                    <svg class="w-4 h-4 text-mocca-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <span class="text-olive-900/60 text-sm font-medium">Detail Produk</span>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-[10px] text-olive-900/40 mb-2 font-bold uppercase tracking-wider">Nama Produk *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="input-field">
                    @error('name')<span class="text-red-650 text-xs mt-1 block">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="block text-[10px] text-olive-900/40 mb-2 font-bold uppercase tracking-wider">Asal Daerah *</label>
                    <input type="text" name="origin" value="{{ old('origin', $product->origin) }}" required class="input-field" placeholder="Aceh Gayo, Flores, dll.">
                    @error('origin')<span class="text-red-650 text-xs mt-1 block">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="block text-[10px] text-olive-900/40 mb-2 font-bold uppercase tracking-wider">Roast Level *</label>
                    <select name="roast_level" required class="input-field">
                        @foreach(['Light', 'Medium', 'Medium-Dark', 'Dark'] as $r)
                        <option value="{{ $r }}" {{ old('roast_level', $product->roast_level) == $r ? 'selected' : '' }}>{{ $r }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2">
                    <label class="block text-[10px] text-olive-900/40 mb-2 font-bold uppercase tracking-wider">Flavor Notes *</label>
                    <input type="text" name="flavor_notes" value="{{ old('flavor_notes', $product->flavor_notes) }}" required class="input-field" placeholder="Caramel, Chocolate, Floral...">
                    @error('flavor_notes')<span class="text-red-650 text-xs mt-1 block">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        {{-- Pricing & Stock --}}
        <div class="admin-card p-6 space-y-5">
            <div class="flex items-center gap-3 pb-4 border-b border-olive-900/5">
                <div class="w-8 h-8 bg-emerald-500/10 rounded-lg flex items-center justify-center ring-1 ring-emerald-500/20">
                    <svg class="w-4 h-4 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <span class="text-olive-900/60 text-sm font-medium">Harga & Stok</span>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-[10px] text-olive-900/40 mb-2 font-bold uppercase tracking-wider">Harga (Rp) *</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" required min="0" class="input-field">
                </div>
                <div>
                    <label class="block text-[10px] text-olive-900/40 mb-2 font-bold uppercase tracking-wider">Berat (gram) *</label>
                    <input type="number" name="weight_grams" value="{{ old('weight_grams', $product->weight_grams ?? 250) }}" required min="0" class="input-field">
                </div>
                <div>
                    <label class="block text-[10px] text-olive-900/40 mb-2 font-bold uppercase tracking-wider">Stok *</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" required min="0" class="input-field">
                </div>
            </div>
        </div>

        {{-- Description & Image --}}
        <div class="admin-card p-6 space-y-5">
            <div class="flex items-center gap-3 pb-4 border-b border-olive-900/5">
                <div class="w-8 h-8 bg-blue-500/10 rounded-lg flex items-center justify-center ring-1 ring-blue-500/20">
                    <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <span class="text-olive-900/60 text-sm font-medium">Deskripsi & Media</span>
            </div>

            <div>
                <label class="block text-[10px] text-olive-900/40 mb-2 font-bold uppercase tracking-wider">Deskripsi</label>
                <textarea name="description" rows="3" class="input-field resize-none">{{ old('description', $product->description) }}</textarea>
            </div>

            <div>
                <label class="block text-[10px] text-olive-900/40 mb-2 font-bold uppercase tracking-wider">Foto Produk</label>
                @if($product->image)
                <div class="mb-3 relative inline-block group">
                    <img src="{{ $product->image_url }}" class="w-28 h-28 object-cover rounded-xl ring-1 ring-olive-900/5 group-hover:ring-mocca/30 transition-all duration-300">
                </div>
                @endif
                <input type="file" name="image" accept="image/*" class="input-field text-sm file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-mocca/10 file:text-mocca-dark hover:file:bg-mocca/20 file:transition-colors file:cursor-pointer">
            </div>

            <div class="flex gap-6 pt-2">
                <label class="flex items-center gap-2.5 cursor-pointer group">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }} class="w-4 h-4 accent-mocca text-olive-650 border-olive-900/10 rounded cursor-pointer">
                    <span class="text-sm text-olive-900/50 group-hover:text-olive-900 transition-colors font-medium">Aktif dijual</span>
                </label>
                <label class="flex items-center gap-2.5 cursor-pointer group">
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="w-4 h-4 accent-mocca text-olive-650 border-olive-900/10 rounded cursor-pointer">
                    <span class="text-sm text-olive-900/50 group-hover:text-olive-900 transition-colors font-medium">Featured di Home</span>
                </label>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-mocca">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ $product->exists ? 'Simpan Perubahan' : 'Tambahkan Produk' }}
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn-outline-mocca">Batal</a>
        </div>
    </form>
</div>
@endsection
