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

        <div class="admin-card p-6 space-y-6 border border-olive-900/5 shadow-sm">
            {{-- Section header --}}
            <div class="flex items-center gap-3 pb-4 border-b border-olive-900/5">
                <div class="w-9 h-9 bg-mocca/10 rounded-xl flex items-center justify-center ring-1 ring-mocca/20">
                    <span class="material-symbols-outlined text-mocca-dark text-lg">restaurant_menu</span>
                </div>
                <div>
                    <h3 class="text-olive-900 text-sm font-bold">Detail Informasi Menu</h3>
                    <p class="text-[10px] text-olive-900/40 font-semibold">Lengkapi informasi produk menu kafe</p>
                </div>
            </div>

            {{-- Nama Menu --}}
            <div class="space-y-2">
                <label class="block text-[10px] text-olive-900/40 font-bold uppercase tracking-wider">Nama Menu *</label>
                <input type="text" name="name" value="{{ old('name', $menu->name) }}" required class="input-field" placeholder="Masukkan nama menu...">
                @error('name')<span class="text-red-650 text-xs mt-1 block font-medium">{{ $message }}</span>@enderror
            </div>

            {{-- Kategori & Harga --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-2">
                    <label class="block text-[10px] text-olive-900/40 font-bold uppercase tracking-wider">Kategori *</label>
                    <select name="category" required class="input-field">
                        @foreach(['Manual Brew', 'Non-Coffee', 'Coffee', 'Signature'] as $cat)
                        <option value="{{ $cat }}" {{ old('category', $menu->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] text-olive-900/40 font-bold uppercase tracking-wider">Harga (Rp) *</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-olive-900/40 text-sm font-semibold">Rp</span>
                        <input type="number" name="price" value="{{ old('price', $menu->price) }}" required min="0" class="input-field !pl-10" placeholder="0">
                    </div>
                    @error('price')<span class="text-red-650 text-xs mt-1 block font-medium">{{ $message }}</span>@enderror
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="space-y-2">
                <label class="block text-[10px] text-olive-900/40 font-bold uppercase tracking-wider">Deskripsi</label>
                <textarea name="description" rows="4" class="input-field resize-none" placeholder="Tuliskan penjelasan singkat mengenai rasa, bahan, atau penyajian menu ini...">{{ old('description', $menu->description) }}</textarea>
            </div>

            {{-- Media --}}
            <div class="space-y-3">
                <label class="block text-[10px] text-olive-900/40 font-bold uppercase tracking-wider">Foto Menu</label>
                <div class="flex items-start gap-4">
                    @if($menu->image)
                    <div class="relative inline-block flex-shrink-0 group">
                        <img src="{{ $menu->image_url }}" class="w-24 h-24 object-cover rounded-2xl ring-1 ring-olive-900/5 group-hover:ring-mocca/30 transition-all duration-300 shadow-sm">
                        <div class="absolute inset-0 bg-olive-950/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="text-white text-[9px] font-bold uppercase tracking-wider bg-olive-900/80 px-2 py-1 rounded-lg">Saat ini</span>
                        </div>
                    </div>
                    @endif
                    <div class="flex-1">
                        <div class="relative flex items-center justify-center border border-dashed border-olive-900/20 rounded-2xl p-4 bg-olive-50/20 hover:bg-olive-50/40 hover:border-mocca/50 transition-colors group cursor-pointer">
                            <input type="file" name="image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div class="text-center">
                                <span class="material-symbols-outlined text-olive-900/30 group-hover:text-mocca-dark transition-colors mb-1 text-2xl">add_photo_alternate</span>
                                <p class="text-xs text-olive-900/50 font-semibold group-hover:text-olive-900 transition-colors">Pilih file foto baru</p>
                                <p class="text-[10px] text-olive-900/30 mt-0.5">PNG, JPG, JPEG up to 2MB</p>
                            </div>
                        </div>
                        @error('image')<span class="text-red-650 text-xs mt-1.5 block font-medium">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            {{-- Sort Order & Checkboxes --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-2">
                <div class="space-y-2">
                    <label class="block text-[10px] text-olive-900/40 font-bold uppercase tracking-wider">Urutan Tampil (Sort Order)</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $menu->sort_order ?? 0) }}" min="0" class="input-field" placeholder="0">
                </div>
                <div class="flex flex-col gap-3 justify-center">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="hidden" name="is_available" value="0">
                        <input type="checkbox" name="is_available" value="1" {{ old('is_available', $menu->is_available ?? true) ? 'checked' : '' }}
                               class="w-4 h-4 text-olive-600 border-olive-900/20 rounded focus:ring-olive-500/20 focus:ring-offset-0 cursor-pointer transition-all">
                        <span class="text-sm text-olive-900/60 group-hover:text-olive-900 transition-colors font-medium">Tersedia untuk Dipesan</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="hidden" name="is_featured" value="0">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $menu->is_featured) ? 'checked' : '' }}
                               class="w-4 h-4 text-olive-600 border-olive-900/20 rounded focus:ring-olive-500/20 focus:ring-offset-0 cursor-pointer transition-all">
                        <span class="text-sm text-olive-900/60 group-hover:text-olive-900 transition-colors font-medium">Unggulkan di Halaman Depan</span>
                    </label>
                </div>
            </div>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center gap-3">
            <button type="submit" class="bg-olive-800 hover:bg-olive-900 text-beige-50 px-6 py-3 rounded-2xl font-bold flex items-center gap-2 transition-all hover:shadow-lg active:scale-95 text-xs shadow-sm">
                <span class="material-symbols-outlined text-sm">save</span>
                {{ $menu->exists ? 'Simpan Perubahan' : 'Tambahkan Menu' }}
            </button>
            <a href="{{ route('admin.menus.index') }}" class="btn-outline-mocca !py-3">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
