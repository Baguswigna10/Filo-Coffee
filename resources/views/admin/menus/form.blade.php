@extends('admin.layout')
@section('title', $menu->exists ? 'Edit Menu' : 'Tambah Menu')
@section('page-title', $menu->exists ? 'Edit Menu' : 'Tambah Menu')
@section('page-subtitle', $menu->exists ? $menu->name : 'Tambahkan item menu baru ke katalog')

@section('content')
<div class="max-w-2xl animate-fade-in-up">
    <form action="{{ $menu->exists ? route('admin.menus.update', $menu) : route('admin.menus.store') }}"
          method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if($menu->exists) @method('PUT') @endif

        <div class="admin-card p-6 space-y-5">
            {{-- Section header --}}
            <div class="flex items-center gap-3 pb-4 border-b border-white/[0.06]">
                <div class="w-8 h-8 bg-mocca/10 rounded-lg flex items-center justify-center ring-1 ring-mocca/20">
                    <svg class="w-4 h-4 text-mocca" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <span class="text-cream/50 text-sm font-medium">Detail Menu</span>
            </div>

            <div>
                <label class="block text-xs text-cream/40 mb-2 font-medium uppercase tracking-wider">Nama Menu *</label>
                <input type="text" name="name" value="{{ old('name', $menu->name) }}" required class="input-field">
                @error('name')<span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>@enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs text-cream/40 mb-2 font-medium uppercase tracking-wider">Kategori *</label>
                    <select name="category" required class="input-field">
                        @foreach(['Coffee', 'Non-Coffee', 'Food', 'Dessert', 'Seasonal'] as $cat)
                        <option value="{{ $cat }}" {{ old('category', $menu->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs text-cream/40 mb-2 font-medium uppercase tracking-wider">Harga (Rp) *</label>
                    <input type="number" name="price" value="{{ old('price', $menu->price) }}" required min="0" class="input-field">
                    @error('price')<span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>@enderror
                </div>
            </div>

            <div>
                <label class="block text-xs text-cream/40 mb-2 font-medium uppercase tracking-wider">Deskripsi</label>
                <textarea name="description" rows="3" class="input-field resize-none">{{ old('description', $menu->description) }}</textarea>
            </div>

            <div>
                <label class="block text-xs text-cream/40 mb-2 font-medium uppercase tracking-wider">Foto Menu</label>
                @if($menu->image)
                <div class="mb-3 relative inline-block group">
                    <img src="{{ $menu->image_url }}" class="w-28 h-28 object-cover rounded-xl ring-1 ring-white/[0.06] group-hover:ring-mocca/30 transition-all duration-300">
                </div>
                @endif
                <input type="file" name="image" accept="image/*" class="input-field text-sm file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-mocca/10 file:text-mocca hover:file:bg-mocca/20 file:transition-colors file:cursor-pointer">
                @error('image')<span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>@enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs text-cream/40 mb-2 font-medium uppercase tracking-wider">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $menu->sort_order ?? 0) }}" min="0" class="input-field">
                </div>
            </div>

            <div class="flex gap-6 pt-2">
                <label class="flex items-center gap-2.5 cursor-pointer group">
                    <input type="hidden" name="is_available" value="0">
                    <input type="checkbox" name="is_available" value="1" {{ old('is_available', $menu->is_available ?? true) ? 'checked' : '' }}
                           class="w-4 h-4 accent-[#CCB196] rounded cursor-pointer">
                    <span class="text-sm text-cream/50 group-hover:text-cream/70 transition-colors">Tersedia</span>
                </label>
                <label class="flex items-center gap-2.5 cursor-pointer group">
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $menu->is_featured) ? 'checked' : '' }}
                           class="w-4 h-4 accent-[#CCB196] rounded cursor-pointer">
                    <span class="text-sm text-cream/50 group-hover:text-cream/70 transition-colors">Featured di Home</span>
                </label>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-mocca">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ $menu->exists ? 'Simpan Perubahan' : 'Tambahkan Menu' }}
            </button>
            <a href="{{ route('admin.menus.index') }}" class="btn-outline-mocca">Batal</a>
        </div>
    </form>
</div>
@endsection
