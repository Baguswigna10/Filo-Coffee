@extends('layouts.app')
@section('title', 'Checkout')

@section('content')

{{-- ═══════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden py-16 md:py-24">
    <div class="absolute inset-0 bg-dark"></div>
    <div class="absolute inset-0 opacity-15"
         style="background-image: radial-gradient(circle at 10% 85%, #CCB196 0%, transparent 45%), radial-gradient(circle at 90% 15%, #6B4226 0%, transparent 45%)">
    </div>
    <div class="absolute right-0 top-0 w-[400px] h-[400px] bg-mocca/[0.03] rounded-full blur-[100px]"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center gap-2 mb-5 animate-fade-in-up">
            <span class="w-8 h-px bg-mocca/50"></span>
            <span class="text-mocca text-xs font-semibold tracking-[0.2em] uppercase">Finalize Your Order</span>
            <span class="w-8 h-px bg-mocca/50"></span>
        </div>
        <h1 class="font-display text-5xl md:text-6xl text-cream font-bold leading-tight mb-4 animate-fade-in-up" style="animation-delay: 0.1s">
            Langkah <span class="text-mocca italic">Terakhir</span>
        </h1>
        <p class="text-cream/35 text-sm md:text-base leading-relaxed max-w-md mx-auto animate-fade-in-up" style="animation-delay: 0.2s">
            Lengkapi data pengiriman dan pilih metode pembayaran untuk menyelesaikan pesanan kopi Anda.
        </p>
    </div>
</section>

{{-- ═══════════════════════════════════════
     CHECKOUT CONTENT
     ═══════════════════════════════════════ --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 pb-28">
    
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="grid lg:grid-cols-12 gap-10">
            
            {{-- Form Column --}}
            <div class="lg:col-span-8 space-y-8 reveal">
                
                {{-- Shipping Info --}}
                <div class="bg-white/[0.02] border border-white/[0.05] rounded-[2.5rem] p-6 md:p-10 relative overflow-hidden">
                    <div class="flex items-center gap-4 mb-10">
                        <div class="w-12 h-12 bg-mocca/10 rounded-2xl flex items-center justify-center text-mocca ring-1 ring-mocca/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <h2 class="font-display text-2xl text-cream font-bold">Detail Pengiriman</h2>
                            <p class="text-cream/20 text-[0.625rem] font-bold uppercase tracking-widest mt-0.5">Ke Mana Pesanan Anda Dikirim?</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-[0.625rem] font-bold uppercase tracking-widest text-cream/30 ml-1">Nama Penerima *</label>
                            <input type="text" name="recipient_name" value="{{ old('recipient_name', $user->name) }}" required class="input-field" placeholder="Nama Lengkap">
                            @error('recipient_name')<span class="text-red-400 text-[0.625rem] font-medium ml-1">{{ $message }}</span>@enderror
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[0.625rem] font-bold uppercase tracking-widest text-cream/30 ml-1">Nomor WhatsApp *</label>
                            <input type="tel" name="recipient_phone" value="{{ old('recipient_phone', $user->phone) }}" required class="input-field" placeholder="08xxxxxxxx">
                            @error('recipient_phone')<span class="text-red-400 text-[0.625rem] font-medium ml-1">{{ $message }}</span>@enderror
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-[0.625rem] font-bold uppercase tracking-widest text-cream/30 ml-1">Alamat Lengkap *</label>
                            <textarea name="shipping_address" rows="3" required class="input-field resize-none" placeholder="Jl. Nama Jalan No. XX, Kelurahan, Kecamatan">{{ old('shipping_address', $user->address) }}</textarea>
                            @error('shipping_address')<span class="text-red-400 text-[0.625rem] font-medium ml-1">{{ $message }}</span>@enderror
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[0.625rem] font-bold uppercase tracking-widest text-cream/30 ml-1">Kota / Kabupaten *</label>
                            <input type="text" name="shipping_city" value="{{ old('shipping_city') }}" required class="input-field" placeholder="Misal: Jakarta Selatan">
                            @error('shipping_city')<span class="text-red-400 text-[0.625rem] font-medium ml-1">{{ $message }}</span>@enderror
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[0.625rem] font-bold uppercase tracking-widest text-cream/30 ml-1">Provinsi *</label>
                            <input type="text" name="shipping_province" value="{{ old('shipping_province') }}" required class="input-field" placeholder="Misal: DKI Jakarta">
                            @error('shipping_province')<span class="text-red-400 text-[0.625rem] font-medium ml-1">{{ $message }}</span>@enderror
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[0.625rem] font-bold uppercase tracking-widest text-cream/30 ml-1">Kode Pos *</label>
                            <input type="text" name="shipping_zip" value="{{ old('shipping_zip') }}" required class="input-field" placeholder="12345">
                            @error('shipping_zip')<span class="text-red-400 text-[0.625rem] font-medium ml-1">{{ $message }}</span>@enderror
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-[0.625rem] font-bold uppercase tracking-widest text-cream/30 ml-1">Catatan Tambahan (Opsional)</label>
                            <input type="text" name="notes" value="{{ old('notes') }}" class="input-field" placeholder="Misal: Lantai 2, pintu warna coklat, dll.">
                        </div>
                    </div>
                </div>

                {{-- Payment Method --}}
                <div class="bg-white/[0.02] border border-white/[0.05] rounded-[2.5rem] p-6 md:p-10 relative overflow-hidden">
                    <div class="flex items-center gap-4 mb-10">
                        <div class="w-12 h-12 bg-mocca/10 rounded-2xl flex items-center justify-center text-mocca ring-1 ring-mocca/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        </div>
                        <div>
                            <h2 class="font-display text-2xl text-cream font-bold">Metode Pembayaran</h2>
                            <p class="text-cream/20 text-[0.625rem] font-bold uppercase tracking-widest mt-0.5">Pilih Cara Anda Membayar</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        @foreach([
                            ['value' => 'Transfer', 'label' => 'Bank Transfer', 'icon' => '🏦', 'desc' => 'Verifikasi Manual'],
                            ['value' => 'COD',      'label' => 'Cash on Delivery', 'icon' => '💵', 'desc' => 'Bayar di Tempat'],
                            ['value' => 'Midtrans', 'label' => 'Online Payment', 'icon' => '💳', 'desc' => 'Konfirmasi Instan'],
                        ] as $method)
                        <label class="relative group cursor-pointer h-full">
                            <input type="radio" name="payment_method" value="{{ $method['value'] }}" class="peer hidden"
                                   {{ old('payment_method', 'Transfer') == $method['value'] ? 'checked' : '' }}>
                            
                            <div class="h-full bg-white/[0.03] border border-white/[0.08] rounded-3xl p-6 text-center transition-all duration-300
                                        peer-checked:border-mocca peer-checked:bg-mocca/[0.03] peer-checked:ring-1 peer-checked:ring-mocca/20
                                        group-hover:border-white/20">
                                <div class="w-12 h-12 bg-white/[0.05] rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl group-hover:scale-110 transition-transform">
                                    {{ $method['icon'] }}
                                </div>
                                <h4 class="text-cream font-bold text-sm mb-1">{{ $method['label'] }}</h4>
                                <p class="text-cream/20 text-[0.625rem] font-bold uppercase tracking-widest">{{ $method['desc'] }}</p>
                                
                                {{-- Selection circle --}}
                                <div class="absolute top-4 right-4 w-4 h-4 bg-dark border border-white/10 rounded-full flex items-center justify-center transition-all
                                            peer-checked:bg-mocca peer-checked:border-mocca-dark">
                                    <svg class="w-2.5 h-2.5 text-dark opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </div>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('payment_method')<p class="mt-4 text-[0.625rem] font-medium text-red-400 ml-1">{{ $message }}</p>@enderror

                    <div class="mt-8 p-5 bg-mocca/5 border border-mocca/10 rounded-2xl flex items-start gap-4">
                        <div class="w-8 h-8 rounded-full bg-mocca/10 flex items-center justify-center text-mocca flex-shrink-0 animate-pulse">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="text-[0.625rem] font-medium leading-relaxed uppercase tracking-wider text-mocca/60">
                            PENTING: Khusus Bank Transfer, Anda perlu mengunggah bukti pembayaran di halaman Pesanan setelah konfirmasi.
                            <br>BCA 1234567890 a/n Filo Coffee
                        </div>
                    </div>
                </div>
            </div>

            {{-- Summary Sidebar --}}
            <div class="lg:col-span-4 reveal" style="transition-delay: 0.1s">
                <div class="bg-white/[0.02] border border-white/[0.05] rounded-[2.5rem] p-8 sticky top-32">
                    <h3 class="font-display text-xl text-cream font-bold mb-8">Informasi Pesanan</h3>

                    {{-- Mini Item List --}}
                    <div class="space-y-4 mb-10 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($cartItems as $item)
                        @php
                            $isMenu = (bool)$item->menu_id;
                            $object = $isMenu ? $item->menu : $item->product;
                        @endphp
                        <div class="flex gap-4 items-center group">
                            <div class="w-14 h-14 flex-shrink-0 bg-gradient-to-br from-white/[0.02] to-mocca/[0.05] rounded-xl overflow-hidden ring-1 ring-white/5">
                                @if($object->image)
                                    <img src="{{ $object->image_url }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center opacity-30 text-[0.6rem]">
                                        {{ $isMenu ? '☕' : '🫘' }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-cream text-xs font-bold truncate group-hover:text-mocca transition-colors">{{ $object->name }}</p>
                                <p class="text-cream/20 text-[0.625rem] font-bold uppercase tracking-widest mt-0.5">{{ $item->quantity }} x {{ number_format($object->price, 0, ',', '.') }}</p>
                            </div>
                            <span class="text-cream/40 text-xs font-bold font-body">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </span>
                        </div>
                        @endforeach
                    </div>

                    {{-- Calculations --}}
                    <div class="space-y-4 mb-8 border-t border-white/5 pt-8">
                        <div class="flex justify-between items-center">
                            <span class="text-cream/30 text-xs font-semibold uppercase tracking-widest">Subtotal Belanja</span>
                            <span class="text-cream font-bold text-sm">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-cream/30 text-xs font-semibold uppercase tracking-widest">Biaya Pengiriman</span>
                            <span class="text-cream font-bold text-sm">Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="border-t border-white/10 pt-6 mb-10">
                        <div class="flex justify-between items-baseline mb-2">
                            <span class="text-cream/40 text-[0.625rem] font-bold uppercase tracking-[0.2em]">Total Tagihan</span>
                            <span class="text-mocca font-bold text-3xl leading-none">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <button type="submit" class="btn-mocca w-full justify-center !py-4 shadow-xl shadow-mocca/10 font-bold group">
                            <span>Konfirmasi & Bayar</span>
                            <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </button>
                        <a href="{{ route('cart') }}" class="flex items-center justify-center gap-2 text-cream/20 hover:text-mocca text-[0.625rem] font-bold uppercase tracking-widest py-3 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Edit Keranjang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
