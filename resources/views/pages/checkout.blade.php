@extends('layouts.app')
@section('title', 'Selesaikan Pembayaran (Checkout) | Filo Coffee')

@section('content')

{{-- ═══════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[50vh] flex items-center bg-beige-50">
    {{-- Decorative subtle background shapes --}}
    <div class="absolute inset-0 opacity-50 pointer-events-none"
         style="background-image: radial-gradient(circle at 15% 15%, #CFDAD0 0%, transparent 40%), radial-gradient(circle at 85% 85%, #E6DCCF 0%, transparent 40%)">
    </div>
    <div class="absolute right-[-5%] top-1/4 w-[500px] h-[500px] bg-olive-200/30 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute left-[-5%] bottom-0 w-80 h-80 bg-beige-200/50 rounded-full blur-[100px] pointer-events-none"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 z-10">
        <div class="max-w-3xl animate-fade-in-up">
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-8 h-[1.5px] bg-olive-500"></span>
                <span class="text-olive-700 text-xs font-bold tracking-[0.25em] uppercase">Langkah Terakhir</span>
            </div>
            <h1 class="font-display text-5xl md:text-7xl text-olive-900 font-bold leading-[1.05] mb-8">
                Checkout<br>
                <span class="text-beige-600 italic font-semibold font-display">Pengiriman Kopi.</span>
            </h1>
            <p class="text-olive-800/70 text-lg md:text-xl leading-relaxed mb-12 max-w-2xl">
                Tentukan lokasi pengiriman Anda pada peta, dapatkan perhitungan ongkir instan, dan selesaikan transaksi dengan aman.
            </p>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     CHECKOUT CONTENT
     ═══════════════════════════════════════ --}}
<div class="bg-beige-50 min-h-[60vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pb-28">
        
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            
            {{-- Hidden input for shipping cost, dynamically updated by JS --}}
            <input type="hidden" name="shipping_cost" id="shipping-cost-input" value="15000">

            <div class="grid lg:grid-cols-12 gap-10 items-start">
                
                {{-- Form Column --}}
                <div class="lg:col-span-8 space-y-8 reveal">
                    
                    {{-- ── MAP SECTION (INTEGRATED LOCATION PICKER) ── --}}
                    <div class="bg-white border border-olive-900/5 rounded-[2.5rem] p-6 md:p-10 shadow-xl shadow-olive-900/5 relative overflow-hidden">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 bg-olive-100 rounded-2xl flex items-center justify-center text-olive-800 ring-1 ring-olive-900/10">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                            </div>
                            <div>
                                <h2 class="font-display text-2xl text-olive-900 font-bold">Peta Pengiriman</h2>
                                <p class="text-olive-700/40 text-[0.625rem] font-bold uppercase tracking-widest mt-0.5">Tentukan Lokasi &amp; Cek Radius Antar</p>
                            </div>
                        </div>

                        {{-- Search Box & suggestions dropdown --}}
                        <div class="space-y-3 mb-6 relative">
                            <label class="block text-[0.625rem] font-bold uppercase tracking-widest text-olive-700/50 ml-1">Cari Alamat Autocomplete</label>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <div class="relative flex-1 group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-olive-700/30 group-focus-within:text-olive-700 transition-colors">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                    </div>
                                    <input type="text" id="address-search" 
                                           class="bg-beige-50 border border-olive-900/10 rounded-2xl pl-12 pr-4 py-3.5 text-olive-900 text-sm focus:ring-2 focus:ring-olive-500/20 focus:border-olive-500 focus:outline-none w-full transition-all placeholder-olive-700/30 font-medium" 
                                           placeholder="Masukkan nama jalan, gedung, atau daerah...">
                                    
                                    {{-- Suggestions Container --}}
                                    <div id="autocomplete-suggestions" class="absolute z-50 left-0 right-0 top-full mt-2 bg-white border border-beige-200 rounded-2xl shadow-xl max-h-60 overflow-y-auto hidden"></div>
                                </div>
                                <button type="button" id="btn-gps" class="bg-olive-800 hover:bg-olive-900 text-beige-50 rounded-2xl px-6 py-4 text-xs font-bold uppercase tracking-widest flex items-center justify-center gap-2 transition-all shadow-md active:scale-95 whitespace-nowrap">
                                    <span>📍 Gunakan Lokasi Saya</span>
                                </button>
                            </div>
                        </div>

                        {{-- Leaflet Map Container --}}
                        <div class="relative rounded-[2rem] overflow-hidden border border-olive-900/10 shadow-inner h-[380px] mb-6">
                            <div id="map" class="w-full h-full z-10"></div>
                        </div>

                        {{-- Delivery Information Card --}}
                        <div class="bg-beige-50 border border-olive-900/5 rounded-3xl p-6 space-y-5 shadow-sm">
                            <div class="flex items-center justify-between">
                                <h3 class="font-display text-base text-olive-900 font-bold">Rincian Pengantaran</h3>
                                <span id="delivery-status-badge" class="px-3 py-1 rounded-full text-[0.62rem] font-bold uppercase tracking-widest bg-gray-150 text-gray-500">Memproses</span>
                            </div>
                            
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 text-center">
                                <div class="bg-white border border-olive-900/5 rounded-2xl p-4 flex flex-col justify-center">
                                    <span class="block text-[0.55rem] font-bold uppercase tracking-wider text-olive-700/50 mb-1">Jarak Antar</span>
                                    <span id="delivery-distance" class="text-sm font-bold text-olive-900">—</span>
                                </div>
                                <div class="bg-white border border-olive-900/5 rounded-2xl p-4 flex flex-col justify-center">
                                    <span class="block text-[0.55rem] font-bold uppercase tracking-wider text-olive-700/50 mb-1">Ongkos Kirim</span>
                                    <span id="delivery-fee-display" class="text-sm font-bold text-olive-900">—</span>
                                </div>
                                <div class="bg-white border border-olive-900/5 rounded-2xl p-4 col-span-2 sm:col-span-1 flex flex-col justify-center">
                                    <span class="block text-[0.55rem] font-bold uppercase tracking-wider text-olive-700/50 mb-1">Estimasi Waktu</span>
                                    <span id="delivery-time" class="text-sm font-bold text-olive-900">—</span>
                                </div>
                            </div>

                            {{-- Alert message status --}}
                            <div id="delivery-alert" class="p-4 rounded-2xl flex items-center gap-3 font-bold text-xs uppercase tracking-wider text-center justify-center border transition-all">
                                Menghitung koordinat...
                            </div>
                        </div>

                        {{-- Confirm Location Button --}}
                        <div class="mt-6">
                            <button type="button" id="btn-confirm-location" class="w-full bg-olive-800 hover:bg-olive-900 text-beige-50 font-bold py-4 rounded-xl transition-all shadow-md text-xs uppercase tracking-widest">
                                Konfirmasi Lokasi Pengiriman
                            </button>
                        </div>
                    </div>
                    
                    {{-- Shipping Form Inputs --}}
                    <div id="recipient-form-section" class="bg-white border border-olive-900/5 rounded-[2.5rem] p-6 md:p-10 shadow-xl shadow-olive-900/5 relative overflow-hidden">
                        <div class="flex items-center gap-4 mb-10">
                            <div class="w-12 h-12 bg-olive-100 rounded-2xl flex items-center justify-center text-olive-800 ring-1 ring-olive-900/10">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <h2 class="font-display text-2xl text-olive-900 font-bold">Data Penerima &amp; Alamat</h2>
                                <p class="text-olive-700/40 text-[0.625rem] font-bold uppercase tracking-widest mt-0.5">Lengkapi Informasi Penerima &amp; Detail Alamat</p>
                            </div>
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-[0.625rem] font-bold uppercase tracking-widest text-olive-700/50 ml-1">Nama Penerima *</label>
                                <input type="text" name="recipient_name" id="recipient_name" value="{{ old('recipient_name', $user->name) }}" required 
                                       class="bg-beige-50 border border-olive-900/10 rounded-2xl px-4 py-3.5 text-olive-900 text-sm focus:ring-2 focus:ring-olive-500/20 focus:border-olive-500 focus:outline-none w-full transition-all placeholder-olive-700/30" placeholder="Nama Lengkap">
                                @error('recipient_name')<span class="text-red-650 text-[0.625rem] font-medium ml-1">{{ $message }}</span>@enderror
                            </div>
                            
                            <div class="space-y-2">
                                <label class="block text-[0.625rem] font-bold uppercase tracking-widest text-olive-700/50 ml-1">Nomor WhatsApp *</label>
                                <input type="tel" name="recipient_phone" id="recipient_phone" value="{{ old('recipient_phone', $user->phone) }}" required 
                                       class="bg-beige-50 border border-olive-900/10 rounded-2xl px-4 py-3.5 text-olive-900 text-sm focus:ring-2 focus:ring-olive-500/20 focus:border-olive-500 focus:outline-none w-full transition-all placeholder-olive-700/30" placeholder="08xxxxxxxx">
                                @error('recipient_phone')<span class="text-red-650 text-[0.625rem] font-medium ml-1">{{ $message }}</span>@enderror
                            </div>
                            
                            <div class="md:col-span-2 space-y-2">
                                <label class="block text-[0.625rem] font-bold uppercase tracking-widest text-olive-700/50 ml-1">Alamat Lengkap *</label>
                                <textarea name="shipping_address" id="shipping_address" rows="3" required 
                                          class="bg-beige-50 border border-olive-900/10 rounded-2xl px-4 py-3.5 text-olive-900 text-sm focus:ring-2 focus:ring-olive-500/20 focus:border-olive-500 focus:outline-none w-full transition-all placeholder-olive-700/30 resize-none font-medium" placeholder="Pilih alamat di peta atau ketik di sini...">{{ old('shipping_address', $user->address) }}</textarea>
                                @error('shipping_address')<span class="text-red-650 text-[0.625rem] font-medium ml-1">{{ $message }}</span>@enderror
                            </div>
                            
                            <div class="space-y-2">
                                <label class="block text-[0.625rem] font-bold uppercase tracking-widest text-olive-700/50 ml-1">Kota / Kabupaten *</label>
                                <input type="text" name="shipping_city" id="shipping_city" value="{{ old('shipping_city') }}" required 
                                       class="bg-beige-50 border border-olive-900/10 rounded-2xl px-4 py-3.5 text-olive-900 text-sm focus:ring-2 focus:ring-olive-500/20 focus:border-olive-500 focus:outline-none w-full transition-all placeholder-olive-700/30" placeholder="Kecamatan / Kota">
                                @error('shipping_city')<span class="text-red-650 text-[0.625rem] font-medium ml-1">{{ $message }}</span>@enderror
                            </div>
                            
                            <div class="space-y-2">
                                <label class="block text-[0.625rem] font-bold uppercase tracking-widest text-olive-700/50 ml-1">Provinsi *</label>
                                <input type="text" name="shipping_province" id="shipping_province" value="{{ old('shipping_province') }}" required 
                                       class="bg-beige-50 border border-olive-900/10 rounded-2xl px-4 py-3.5 text-olive-900 text-sm focus:ring-2 focus:ring-olive-500/20 focus:border-olive-500 focus:outline-none w-full transition-all placeholder-olive-700/30" placeholder="Provinsi">
                                @error('shipping_province')<span class="text-red-650 text-[0.625rem] font-medium ml-1">{{ $message }}</span>@enderror
                            </div>
                            
                            <div class="space-y-2">
                                <label class="block text-[0.625rem] font-bold uppercase tracking-widest text-olive-700/50 ml-1">Kode Pos *</label>
                                <input type="text" name="shipping_zip" id="shipping_zip" value="{{ old('shipping_zip') }}" required 
                                       class="bg-beige-50 border border-olive-900/10 rounded-2xl px-4 py-3.5 text-olive-900 text-sm focus:ring-2 focus:ring-olive-500/20 focus:border-olive-500 focus:outline-none w-full transition-all placeholder-olive-700/30" placeholder="12345">
                                @error('shipping_zip')<span class="text-red-650 text-[0.625rem] font-medium ml-1">{{ $message }}</span>@enderror
                            </div>
                            
                            <div class="md:col-span-2 space-y-2">
                                <label class="block text-[0.625rem] font-bold uppercase tracking-widest text-olive-700/50 ml-1">Catatan Tambahan (Opsional)</label>
                                <input type="text" name="notes" id="notes" value="{{ old('notes') }}" 
                                       class="bg-beige-50 border border-olive-900/10 rounded-2xl px-4 py-3.5 text-olive-900 text-sm focus:ring-2 focus:ring-olive-500/20 focus:border-olive-500 focus:outline-none w-full transition-all placeholder-olive-700/30" placeholder="Misal: Pagar hitam, warna cat rumah, lantai 2, dll.">
                            </div>
                        </div>
                    </div>
    
                    {{-- Payment Method Card --}}
                    <div class="bg-white border border-olive-900/5 rounded-[2.5rem] p-6 md:p-10 shadow-xl shadow-olive-900/5 relative overflow-hidden">
                        <div class="flex items-center gap-4 mb-10">
                            <div class="w-12 h-12 bg-olive-100 rounded-2xl flex items-center justify-center text-olive-800 ring-1 ring-olive-900/10">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                            </div>
                            <div>
                                <h2 class="font-display text-2xl text-olive-900 font-bold">Metode Pembayaran</h2>
                                <p class="text-olive-700/40 text-[0.625rem] font-bold uppercase tracking-widest mt-0.5">Pilih Cara Anda Membayar</p>
                            </div>
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            @foreach([
                                ['value' => 'Transfer', 'label' => 'Bank Transfer', 'icon' => '🏦', 'desc' => 'Verifikasi Manual'],
                                ['value' => 'COD',      'label' => 'Cash on Delivery', 'icon' => '💵', 'desc' => 'Bayar di Tempat'],
                                ['value' => 'Midtrans', 'label' => 'Online Payment', 'icon' => '💳', 'desc' => 'Konfirmasi Instan'],
                            ] as $method)
                            <label class="relative group cursor-pointer h-full block">
                                <input type="radio" name="payment_method" value="{{ $method['value'] }}" class="peer hidden"
                                       {{ old('payment_method', 'Transfer') == $method['value'] ? 'checked' : '' }}>
                                
                                <div class="h-full bg-beige-50/40 border border-olive-900/5 rounded-3xl p-6 text-center transition-all duration-300
                                            peer-checked:border-olive-700 peer-checked:bg-olive-100/30 peer-checked:ring-1 peer-checked:ring-olive-700/20
                                            group-hover:border-olive-900/20 shadow-sm relative">
                                    <div class="w-12 h-12 bg-white border border-olive-900/5 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl group-hover:scale-105 transition-transform shadow-sm">
                                        {{ $method['icon'] }}
                                    </div>
                                    <h4 class="text-olive-900 font-bold text-sm mb-1">{{ $method['label'] }}</h4>
                                    <p class="text-olive-750/50 text-[0.625rem] font-bold uppercase tracking-widest">{{ $method['desc'] }}</p>
                                    
                                    <div class="absolute top-4 right-4 w-4 h-4 bg-white border border-olive-900/10 rounded-full flex items-center justify-center transition-all
                                                peer-checked:bg-olive-850 peer-checked:border-olive-850 marker-circle">
                                        <svg class="w-2.5 h-2.5 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                </div>
                            </label>
                            @endforeach
                        </div>
                        @error('payment_method')<p class="mt-4 text-[0.625rem] font-medium text-red-655 ml-1">{{ $message }}</p>@enderror
    
                        {{-- Dynamic info boxes --}}
                        <div id="info-Transfer" class="mt-8 p-5 bg-olive-50 border border-olive-900/5 rounded-2xl flex items-start gap-4 shadow-sm">
                            <div class="w-8 h-8 rounded-full bg-olive-100 flex items-center justify-center text-olive-800 flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div class="text-[0.65rem] font-bold leading-relaxed uppercase tracking-wider text-olive-800/60 flex-1">
                                Setelah checkout, Anda dapat mengunggah bukti transfer pada halaman rincian pesanan.<br>
                                Rekening BCA: <strong class="text-olive-900">1234567890</strong> a/n Filo Coffee
                            </div>
                        </div>
    
                        <div id="info-COD" class="mt-8 p-5 bg-green-50 border border-green-200/50 rounded-2xl flex items-start gap-4 hidden shadow-sm">
                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-700 flex-shrink-0">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            </div>
                            <div class="text-[0.65rem] font-bold leading-relaxed uppercase tracking-wider text-green-700/70 flex-1">
                                Siapkan uang pas saat kurir tiba. Pembayaran dilakukan secara tunai langsung kepada kurir kami.
                            </div>
                        </div>
    
                        <div id="info-Midtrans" class="mt-8 p-5 bg-amber-50 border border-amber-500/10 rounded-2xl flex items-start gap-4 hidden shadow-sm">
                            <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 flex-shrink-0">
                                💳
                            </div>
                            <div class="text-[0.65rem] font-bold leading-relaxed uppercase tracking-wider text-amber-800/75 flex-1">
                                Setelah checkout, Anda akan diarahkan ke gerbang pembayaran aman Midtrans. Pilih metode: virtual account, GoPay, OVO, Dana &amp; lainnya. <strong class="text-amber-900">Konfirmasi otomatis instan!</strong>
                            </div>
                        </div>
                    </div>
                </div>
    
                {{-- Summary Sidebar --}}
                <div class="lg:col-span-4 reveal" style="transition-delay: 0.1s">
                    <div class="bg-white border border-olive-900/5 rounded-[2.5rem] p-8 sticky top-32 shadow-xl shadow-olive-900/5">
                        <h3 class="font-display text-xl text-olive-900 font-bold mb-8">Informasi Pesanan</h3>
    
                        {{-- Mini Item List --}}
                        <div class="space-y-4 mb-10 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                            @foreach($cartItems as $item)
                            @php
                                $isMenu = (bool)$item->menu_id;
                                $object = $isMenu ? $item->menu : $item->product;
                            @endphp
                            <div class="flex gap-4 items-center group">
                                <div class="w-14 h-14 flex-shrink-0 bg-beige-50 border border-olive-900/5 rounded-xl overflow-hidden shadow-sm">
                                    @if($object->image)
                                        <img src="{{ $object->image_url }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center opacity-30 text-[0.6rem] font-bold">
                                            {{ $isMenu ? '☕' : '🫘' }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-olive-900 text-xs font-bold truncate group-hover:text-olive-750 transition-colors">{{ $object->name }}</p>
                                    <p class="text-olive-700/40 text-[0.625rem] font-bold uppercase tracking-widest mt-0.5">{{ $item->quantity }} x Rp {{ number_format($object->price, 0, ',', '.') }}</p>
                                </div>
                                <span class="text-olive-900/80 text-xs font-bold font-body">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </span>
                            </div>
                            @endforeach
                        </div>
    
                        {{-- Calculations --}}
                        <div class="space-y-4 mb-8 border-t border-olive-900/5 pt-8">
                            <div class="flex justify-between items-center">
                                <span class="text-olive-700/40 text-xs font-semibold uppercase tracking-widest">Subtotal Belanja</span>
                                <span class="text-olive-900 font-bold text-sm">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-olive-700/40 text-xs font-semibold uppercase tracking-widest">Biaya Pengiriman</span>
                                <span id="sidebar-shipping-fee" class="text-olive-900 font-bold text-sm">Rp 15.000</span>
                            </div>
                        </div>
    
                        <div class="border-t border-olive-900/10 pt-6 mb-10">
                            <div class="flex justify-between items-baseline mb-2">
                                <span class="text-olive-700/60 text-[0.65rem] font-bold uppercase tracking-[0.2em]">Total Tagihan</span>
                                <span id="sidebar-total-price" class="text-olive-850 font-display font-bold text-3xl leading-none">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
    
                        <div class="space-y-3">
                            <button type="submit" id="btn-submit-order" class="w-full bg-olive-800 hover:bg-olive-900 text-beige-50 font-bold py-4 rounded-xl transition-all shadow-xl shadow-olive-900/10 group flex items-center justify-center gap-3">
                                <span>Konfirmasi &amp; Bayar</span>
                                <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </button>
                            <a href="{{ route('cart') }}" class="flex items-center justify-center gap-2 text-olive-700/40 hover:text-olive-900 text-[0.65rem] font-bold uppercase tracking-widest py-3 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                Edit Keranjang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('styles')
{{-- Leaflet Map CSS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    .leaflet-container {
        font-family: 'Poppins', sans-serif !important;
        filter: sepia(0.12) hue-rotate(5deg) contrast(0.95) saturate(1.1);
        width: 100%;
        height: 100%;
    }
    .leaflet-popup-content-wrapper {
        background: #ffffff !important;
        border: 1px solid #F2EDE4 !important;
        border-radius: 12px !important;
        box-shadow: 0 4px 12px rgba(70,93,72,0.08) !important;
    }
    .leaflet-popup-tip {
        background: #ffffff !important;
    }
</style>
@endpush

@push('scripts')
{{-- Leaflet Map JS --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    // ── Payment method details toggler ──
    (function() {
        const radios   = document.querySelectorAll('input[name="payment_method"]');
        const infoIds  = ['info-Transfer', 'info-COD', 'info-Midtrans'];

        function updateInfo(selected) {
            infoIds.forEach(id => {
                const el = document.getElementById(id);
                if (!el) return;
                if (id === 'info-' + selected) {
                    el.classList.remove('hidden');
                } else {
                    el.classList.add('hidden');
                }
            });
        }

        radios.forEach(radio => {
            radio.addEventListener('change', () => updateInfo(radio.value));
        });

        const checked = document.querySelector('input[name="payment_method"]:checked');
        if (checked) updateInfo(checked.value);
    })();

    // ── OpenStreetMap Location Picker Logic ──
    const shopLat = {{ $shopLocation['latitude'] ?? -6.178306 }};
    const shopLng = {{ $shopLocation['longitude'] ?? 106.631889 }};
    const clientLat = -6.201234;
    const clientLng = 106.652345;
    const maxDeliveryDistance = 10; // km
    const baseFee = 8000;
    const perKmFee = 2000;
    const subtotal = {{ $subtotal }};

    // Custom icons
    const coffeeShopIcon = L.divIcon({
        html: `<div class="w-10 h-10 rounded-full bg-[#465D48] border-2 border-white flex items-center justify-center text-white text-lg shadow-lg">☕</div>`,
        className: '',
        iconSize: [40, 40],
        iconAnchor: [20, 20]
    });

    const clientLocationIcon = L.divIcon({
        html: `<div class="w-8 h-8 rounded-full bg-[#C9A87C] border-2 border-white flex items-center justify-center text-white text-base shadow-lg animate-bounce" style="animation-duration: 2.5s">📍</div>`,
        className: '',
        iconSize: [32, 32],
        iconAnchor: [16, 32]
    });

    // Initialize Map centered near customer location
    let map = L.map('map').setView([clientLat, clientLng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Coffee Shop Marker
    L.marker([shopLat, shopLng], { icon: coffeeShopIcon }).addTo(map)
        .bindPopup(`<strong class="text-olive-900 font-display">Filo Coffee Shop</strong><br><span class="text-xs text-olive-750/70 font-semibold">Lokasi Utama Kafe</span>`)
        .openPopup();

    // Client Location Marker (Draggable) initialized at customer's coordinates
    let clientMarker = L.marker([clientLat, clientLng], {
        icon: clientLocationIcon,
        draggable: true
    }).addTo(map);

    // Dynamic distance checking & UI updates
    function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; // earth radius in km
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                  Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                  Math.sin(dLon/2) * Math.sin(dLon/2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        return R * c;
    }

    function updateDeliveryInfo(lat, lng) {
        const dist = calculateDistance(shopLat, shopLng, lat, lng);
        const distStr = dist.toFixed(2) + ' km';
        document.getElementById('delivery-distance').textContent = distStr;
        
        const alertEl = document.getElementById('delivery-alert');
        const badgeEl = document.getElementById('delivery-status-badge');
        const timeEl  = document.getElementById('delivery-time');
        const feeEl   = document.getElementById('delivery-fee-display');
        
        const submitBtn = document.getElementById('btn-submit-order');
        const confirmBtn = document.getElementById('btn-confirm-location');
        
        const sidebarFeeEl   = document.getElementById('sidebar-shipping-fee');
        const sidebarTotalEl = document.getElementById('sidebar-total-price');
        const hiddenCostInput = document.getElementById('shipping-cost-input');

        if (dist <= maxDeliveryDistance) {
            // Fee logic
            let fee = baseFee;
            if (dist > 2) {
                fee += Math.round((dist - 2) * perKmFee);
            }
            fee = Math.round(fee / 100) * 100; // round to nearest hundred
            
            const estMin = Math.round(15 + dist * 3);
            const estMax = estMin + 10;
            timeEl.textContent = `${estMin} - ${estMax} Menit`;
            
            feeEl.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(fee);
            
            badgeEl.textContent = 'Tersedia';
            badgeEl.className = 'px-3 py-1 rounded-full text-[0.62rem] font-bold uppercase tracking-widest bg-green-100 text-green-700';
            
            alertEl.textContent = 'Location is within delivery area.';
            alertEl.className = 'p-4 rounded-2xl flex items-center gap-3 font-bold text-xs uppercase tracking-wider text-center justify-center bg-green-50 border border-green-200 text-green-700';
            
            submitBtn.disabled = false;
            submitBtn.style.opacity = '1';
            submitBtn.style.cursor = 'pointer';

            confirmBtn.disabled = false;
            confirmBtn.textContent = '✓ Lokasi Terkonfirmasi';
            confirmBtn.className = 'w-full bg-[#465D48] hover:bg-[#354638] text-beige-50 font-bold py-4 rounded-xl transition-all shadow-md text-xs uppercase tracking-widest';
            
            hiddenCostInput.value = fee;
            sidebarFeeEl.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(fee);
            sidebarTotalEl.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal + fee);
        } else {
            timeEl.textContent = '—';
            feeEl.textContent = '—';
            
            badgeEl.textContent = 'Tidak Tersedia';
            badgeEl.className = 'px-3 py-1 rounded-full text-[0.62rem] font-bold uppercase tracking-widest bg-red-100 text-red-700';
            
            alertEl.textContent = 'Sorry, your location is outside our delivery area.';
            alertEl.className = 'p-4 rounded-2xl flex items-center gap-3 font-bold text-xs uppercase tracking-wider text-center justify-center bg-red-50 border border-red-200 text-red-700';
            
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.35';
            submitBtn.style.cursor = 'not-allowed';

            confirmBtn.disabled = true;
            confirmBtn.textContent = 'Diluar Radius Pengantaran (Maks 10 km)';
            confirmBtn.className = 'w-full bg-gray-200 border border-gray-300 text-gray-400 font-bold py-4 rounded-xl transition-all cursor-not-allowed text-xs uppercase tracking-widest text-center';
            
            hiddenCostInput.value = '';
            sidebarFeeEl.textContent = 'Tidak Terjangkau';
            sidebarTotalEl.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal);
        }
    }

    // Geocoding and Reverse Geocoding via Nominatim
    let reverseGeocodeTimeout;
    function reverseGeocode(lat, lng) {
        clearTimeout(reverseGeocodeTimeout);
        reverseGeocodeTimeout = setTimeout(async () => {
            try {
                const res = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&addressdetails=1&email=filocoffee@gmail.com`);
                const data = await res.json();
                if (data && data.address) {
                    const road = data.address.road || '';
                    const suburb = data.address.suburb || data.address.neighbourhood || '';
                    const village = data.address.village || data.address.hamlet || '';
                    const fullRoad = [road, suburb, village].filter(Boolean).join(', ') || data.display_name;
                    
                    document.getElementById('shipping_address').value = fullRoad;
                    
                    const city = data.address.city || data.address.town || data.address.municipality || data.address.city_district || '';
                    document.getElementById('shipping_city').value = city;
                    
                    const state = data.address.state || data.address.region || '';
                    document.getElementById('shipping_province').value = state;
                    
                    const postcode = data.address.postcode || '';
                    document.getElementById('shipping_zip').value = postcode;
                }
            } catch(e) {
                console.error('Error reverse geocoding:', e);
            }
        }, 400);
    }

    // Drag Listener
    clientMarker.on('dragend', function() {
        const position = clientMarker.getLatLng();
        updateDeliveryInfo(position.lat, position.lng);
        reverseGeocode(position.lat, position.lng);
    });

    // Init on client coordinates
    updateDeliveryInfo(clientLat, clientLng);
    reverseGeocode(clientLat, clientLng);

    // ── Autocomplete Search Address logic ──
    const searchInput = document.getElementById('address-search');
    const suggestionsContainer = document.getElementById('autocomplete-suggestions');
    let searchTimeout;

    searchInput.addEventListener('input', () => {
        clearTimeout(searchTimeout);
        const query = searchInput.value.trim();
        if (query.length < 3) {
            suggestionsContainer.classList.add('hidden');
            suggestionsContainer.innerHTML = '';
            return;
        }

        searchTimeout = setTimeout(async () => {
            try {
                const res = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&addressdetails=1&limit=5&countrycodes=id&email=filocoffee@gmail.com`);
                const results = await res.json();

                if (results && results.length > 0) {
                    suggestionsContainer.innerHTML = results.map(item => `
                        <div class="p-4 hover:bg-beige-50/70 border-b border-beige-100 last:border-0 cursor-pointer text-xs transition-colors text-olive-900 font-medium"
                             onclick="selectSuggestion(${item.lat}, ${item.lon}, '${escapeHtml(item.display_name)}')">
                            ${escapeHtml(item.display_name)}
                        </div>
                    `).join('');
                    suggestionsContainer.classList.remove('hidden');
                } else {
                    suggestionsContainer.innerHTML = '<div class="p-4 text-xs text-olive-700/50">Alamat tidak ditemukan</div>';
                    suggestionsContainer.classList.remove('hidden');
                }
            } catch(e) {
                console.error('Autocomplete error:', e);
            }
        }, 450);
    });

    // Hide autocomplete on click outside
    document.addEventListener('click', (e) => {
        if (!searchInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
            suggestionsContainer.classList.add('hidden');
        }
    });

    window.selectSuggestion = function(lat, lng, displayName) {
        suggestionsContainer.classList.add('hidden');
        searchInput.value = displayName;
        
        const latLng = L.latLng(lat, lng);
        clientMarker.setLatLng(latLng);
        map.setView(latLng, 16);
        
        updateDeliveryInfo(lat, lng);
        reverseGeocode(lat, lng);
    }

    function escapeHtml(str) {
        return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
    }

    // ── GPS Geolocation Button ──
    const gpsBtn = document.getElementById('btn-gps');
    gpsBtn.addEventListener('click', () => {
        if (!navigator.geolocation) {
            alert('Geolokalasi tidak didukung oleh browser Anda.');
            return;
        }

        gpsBtn.disabled = true;
        gpsBtn.textContent = '📍 Mendeteksi GPS...';

        navigator.geolocation.getCurrentPosition(
            (position) => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                const latLng = L.latLng(lat, lng);
                
                clientMarker.setLatLng(latLng);
                map.setView(latLng, 16);
                
                updateDeliveryInfo(lat, lng);
                reverseGeocode(lat, lng);
                
                gpsBtn.disabled = false;
                gpsBtn.textContent = '📍 Gunakan Lokasi Saya';
            },
            (error) => {
                console.error('GPS error:', error);
                alert('Gagal mendeteksi lokasi GPS Anda. Silakan cari manual atau geser pin pada peta.');
                gpsBtn.disabled = false;
                gpsBtn.textContent = '📍 Gunakan Lokasi Saya';
            },
            { enableHighAccuracy: true, timeout: 8000 }
        );
    });

    // ── Confirm Location Button Action ──
    const confirmLocationBtn = document.getElementById('btn-confirm-location');
    confirmLocationBtn.addEventListener('click', () => {
        const formSection = document.getElementById('recipient-form-section');
        if (formSection) {
            formSection.scrollIntoView({ behavior: 'smooth' });
            
            // Add a visual flash effect to highlight fields
            formSection.style.transition = 'box-shadow 0.3s ease, border-color 0.3s ease';
            formSection.style.borderColor = '#465D48';
            formSection.style.boxShadow = '0 0 0 4px rgba(70,93,72,0.15)';
            setTimeout(() => {
                formSection.style.borderColor = 'rgba(21, 28, 21, 0.05)';
                formSection.style.boxShadow = '';
            }, 1000);
        }
    });
</script>
@endpush
