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

        {{-- Detail Produk --}}
        <div class="admin-card p-6 space-y-5 border border-olive-900/5 shadow-sm">
            <div class="flex items-center gap-3 pb-4 border-b border-olive-900/5">
                <div class="w-9 h-9 bg-mocca/10 rounded-xl flex items-center justify-center ring-1 ring-mocca/20">
                    <span class="material-symbols-outlined text-mocca-dark text-lg">grain</span>
                </div>
                <div>
                    <h3 class="text-olive-900 text-sm font-bold">Detail Informasi Produk</h3>
                    <p class="text-[10px] text-olive-900/40 font-semibold">Nama, asal, roast level, dan notes aroma biji kopi</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="col-span-1 md:col-span-2 space-y-2">
                    <label class="block text-[10px] text-olive-900/40 font-bold uppercase tracking-wider">Nama Produk *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="input-field" placeholder="Masukkan nama produk biji kopi...">
                    @error('name')<span class="text-red-650 text-xs mt-1 block font-medium">{{ $message }}</span>@enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] text-olive-900/40 font-bold uppercase tracking-wider">Asal Daerah *</label>
                    <input type="text" name="origin" value="{{ old('origin', $product->origin) }}" required class="input-field" placeholder="Aceh Gayo, Flores, Toraja, dll.">
                    @error('origin')<span class="text-red-650 text-xs mt-1 block font-medium">{{ $message }}</span>@enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] text-olive-900/40 font-bold uppercase tracking-wider">Roast Level *</label>
                    <select name="roast_level" required class="input-field">
                        @foreach(['Light', 'Medium', 'Medium-Dark', 'Dark'] as $r)
                        <option value="{{ $r }}" {{ old('roast_level', $product->roast_level) == $r ? 'selected' : '' }}>{{ $r }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-1 md:col-span-2 space-y-2">
                    <label class="block text-[10px] text-olive-900/40 font-bold uppercase tracking-wider">Flavor Notes *</label>
                    <input type="text" name="flavor_notes" value="{{ old('flavor_notes', $product->flavor_notes) }}" required class="input-field" placeholder="Contoh: Caramel, Chocolate, Fruity, Floral...">
                    @error('flavor_notes')<span class="text-red-650 text-xs mt-1 block font-medium">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        {{-- Pricing & Stock --}}
        <div class="admin-card p-6 space-y-5 border border-olive-900/5 shadow-sm">
            <div class="flex items-center gap-3 pb-4 border-b border-olive-900/5">
                <div class="w-9 h-9 bg-emerald-500/10 rounded-xl flex items-center justify-center ring-1 ring-emerald-500/20">
                    <span class="material-symbols-outlined text-emerald-700 text-lg">payments</span>
                </div>
                <div>
                    <h3 class="text-olive-900 text-sm font-bold">Harga & Stok</h3>
                    <p class="text-[10px] text-olive-900/40 font-semibold">Tentukan harga jual, berat kemasan, dan jumlah stok</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="space-y-2">
                    <label class="block text-[10px] text-olive-900/40 font-bold uppercase tracking-wider">Harga (Rp) *</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-olive-900/40 text-sm font-semibold">Rp</span>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" required min="0" class="input-field !pl-10" placeholder="0">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] text-olive-900/40 font-bold uppercase tracking-wider">Berat (gram) *</label>
                    <div class="relative">
                        <input type="number" name="weight_grams" value="{{ old('weight_grams', $product->weight_grams ?? 250) }}" required min="0" class="input-field !pr-12" placeholder="250">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-olive-900/40 text-xs font-bold">GRAM</span>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] text-olive-900/40 font-bold uppercase tracking-wider">Jumlah Stok *</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" required min="0" class="input-field" placeholder="0">
                </div>
            </div>
        </div>

        {{-- Description & Image --}}
        <div class="admin-card p-6 space-y-5 border border-olive-900/5 shadow-sm">
            <div class="flex items-center gap-3 pb-4 border-b border-olive-900/5">
                <div class="w-9 h-9 bg-blue-500/10 rounded-xl flex items-center justify-center ring-1 ring-blue-500/20">
                    <span class="material-symbols-outlined text-blue-700 text-lg">description</span>
                </div>
                <div>
                    <h3 class="text-olive-900 text-sm font-bold">Deskripsi & Media</h3>
                    <p class="text-[10px] text-olive-900/40 font-semibold">Penjelasan lengkap mengenai produk dan foto representatif</p>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] text-olive-900/40 font-bold uppercase tracking-wider">Deskripsi</label>
                <textarea name="description" rows="4" class="input-field resize-none" placeholder="Tulis deskripsi detail produk biji kopi seperti karakter rasa, elevasi tanam, proses pasca-panen... (opsional)">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="space-y-3">
                <label class="block text-[10px] text-olive-900/40 font-bold uppercase tracking-wider">Foto Produk</label>
                <div class="flex items-start gap-4">
                    @if($product->image)
                    <div class="relative inline-block flex-shrink-0 group">
                        <img src="{{ $product->image_url }}" class="w-24 h-24 object-cover rounded-2xl ring-1 ring-olive-900/5 group-hover:ring-mocca/30 transition-all duration-300 shadow-sm">
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

            <div class="flex flex-col md:flex-row gap-5 pt-2">
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }} class="w-4 h-4 text-olive-600 border-olive-900/20 rounded focus:ring-olive-500/20 focus:ring-offset-0 cursor-pointer transition-all">
                    <span class="text-sm text-olive-900/60 group-hover:text-olive-900 transition-colors font-medium">Aktif Dijual di Toko</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="w-4 h-4 text-olive-600 border-olive-900/20 rounded focus:ring-olive-500/20 focus:ring-offset-0 cursor-pointer transition-all">
                    <span class="text-sm text-olive-900/60 group-hover:text-olive-900 transition-colors font-medium">Unggulkan di Halaman Depan</span>
                </label>
            </div>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center gap-3">
            <button type="submit" class="bg-olive-800 hover:bg-olive-900 text-beige-50 px-6 py-3 rounded-2xl font-bold flex items-center gap-2 transition-all hover:shadow-lg active:scale-95 text-xs shadow-sm">
                <span class="material-symbols-outlined text-sm">save</span>
                {{ $product->exists ? 'Simpan Perubahan' : 'Tambahkan Produk' }}
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn-outline-mocca !py-3">Batal</a>
        </div>
    </form>
</div>
@endsection
