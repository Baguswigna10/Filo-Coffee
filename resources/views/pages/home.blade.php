@extends('layouts.app')
@section('title', 'Filo Coffee')
@section('meta_description', 'Nikmati ritual kopi premium di Filo Specialty Coffee. Dari biji kopi pilihan nusantara hingga working space eksklusif dan lounge PS5 berkelas.')

@section('content')

{{-- ═══════════════════════════════════════
     HERO SECTION (LUXURIOUS SPECIALTY HERITAGE)
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[92vh] flex items-center bg-beige-50">
    {{-- Decorative Background Patterns --}}
    <div class="absolute inset-0 opacity-40 pointer-events-none"
         style="background-image: radial-gradient(circle at 15% 15%, #CFDAD0 0%, transparent 40%), radial-gradient(circle at 85% 85%, #E6DCCF 0%, transparent 40%)">
    </div>
    
    {{-- Soft Glow Lights --}}
    <div class="absolute right-[-10%] top-1/4 w-[500px] h-[500px] bg-olive-200/30 rounded-full blur-[120px] animate-pulse-glow pointer-events-none"></div>
    <div class="absolute left-[-5%] bottom-[-5%] w-80 h-80 bg-beige-200/50 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="relative w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 grid lg:grid-cols-12 gap-12 items-center z-10">
        {{-- Hero Text Column --}}
        <div class="lg:col-span-6 animate-fade-in-up py-6">
            {{-- Elegant Tagline --}}
            <div class="inline-flex items-center gap-3 mb-6">
                <span class="w-8 h-[1.5px] bg-olive-500"></span>
                <span class="text-olive-700 text-xs font-bold tracking-[0.25em] uppercase">Est. 2024 · Specialty Roasters</span>
            </div>

            {{-- Premium Serif Heading --}}
            <h1 class="font-display text-5xl md:text-7xl text-olive-900 font-bold leading-[1.05] mb-8">
                Ritual Kopi<br>
                <span class="text-beige-600 italic font-semibold font-display">Kelas Dunia.</span>
            </h1>

            {{-- Luxurious Body Copy --}}
            <p class="text-olive-800/80 text-lg md:text-xl leading-relaxed mb-10 max-w-xl">
                Filo Specialty Coffee menyatukan kehangatan tradisi lokal dengan teknik seduh presisi modern, menciptakan ruang berkelas bagi para pencinta cita rasa sejati.
            </p>

            {{-- Conversion-Focused CTAs --}}
            <div class="flex flex-wrap items-center gap-4 mb-14">
                <a href="{{ route('menu') }}" class="bg-olive-800 text-beige-50 hover:bg-olive-900 px-8 py-4 rounded-2xl font-bold transition-all duration-300 shadow-lg shadow-olive-900/20 inline-flex items-center gap-2 group">
                    <span>Order Online</span>
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                <a href="{{ route('reservation.index') }}" class="border border-olive-800/30 text-olive-900 hover:bg-olive-800 hover:text-beige-50 px-8 py-3 rounded-2xl font-bold transition-all duration-300 inline-flex items-center gap-2">
                    <span>Reservasi Meja</span>
                </a>
            </div>

            {{-- Premium Features Strip --}}
            <div class="grid grid-cols-3 gap-6 pt-8 border-t border-olive-900/10 max-w-md">
                @foreach([
                    ['num' => '100%', 'title' => 'Arabica Gayo'],
                    ['num' => '85+', 'title' => 'Cupping Score'],
                    ['num' => '5★', 'title' => 'Premium Spot'],
                ] as $stat)
                <div>
                    <div class="font-display text-2xl font-bold text-olive-800">{{ $stat['num'] }}</div>
                    <div class="text-olive-500 text-[0.65rem] font-bold tracking-widest uppercase mt-1">{{ $stat['title'] }}</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Hero Photo Showcase Column --}}
        <div class="lg:col-span-6 relative animate-fade-in-up" style="animation-delay: 0.2s">
            <div class="relative w-full aspect-[4/3] sm:aspect-video lg:aspect-[5/4] rounded-[2rem] overflow-hidden shadow-2xl shadow-olive-900/10 ring-1 ring-olive-900/5 group">
                <img src="{{ asset('images/premium_cafe_hero.png') }}" alt="Filo Premium Cafe Interior" class="w-full h-full object-cover transform duration-1000 group-hover:scale-105">
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     SLIDING TEXT MARQUEE
     ═══════════════════════════════════════ --}}
<div class="relative w-full overflow-hidden bg-olive-900 py-6 border-y border-beige-300/10 z-20 hover-pause">
    <div class="flex whitespace-nowrap gap-0">
        <div class="flex shrink-0 min-w-full justify-around gap-16 animate-marquee">
            <span class="text-beige-200 text-lg md:text-xl font-display font-bold uppercase tracking-[0.2em] flex items-center gap-3">
                ✦ Specialty Coffee Roasters
            </span>
            <span class="text-beige-200 text-lg md:text-xl font-display font-bold uppercase tracking-[0.2em] flex items-center gap-3">
                ✦ Premium Single Origin
            </span>
            <span class="text-beige-200 text-lg md:text-xl font-display font-bold uppercase tracking-[0.2em] flex items-center gap-3">
                ✦ Cozy Co-Working Space
            </span>
            <span class="text-beige-200 text-lg md:text-xl font-display font-bold uppercase tracking-[0.2em] flex items-center gap-3">
                ✦ Exclusive PS5 Zone
            </span>
            <span class="text-beige-200 text-lg md:text-xl font-display font-bold uppercase tracking-[0.2em] flex items-center gap-3">
                ✦ Freshly Baked Pastry
            </span>
        </div>
        <div class="flex shrink-0 min-w-full justify-around gap-16 animate-marquee" aria-hidden="true">
            <span class="text-beige-200 text-lg md:text-xl font-display font-bold uppercase tracking-[0.2em] flex items-center gap-3">
                ✦ Specialty Coffee Roasters
            </span>
            <span class="text-beige-200 text-lg md:text-xl font-display font-bold uppercase tracking-[0.2em] flex items-center gap-3">
                ✦ Premium Single Origin
            </span>
            <span class="text-beige-200 text-lg md:text-xl font-display font-bold uppercase tracking-[0.2em] flex items-center gap-3">
                ✦ Exclusive PS5 Zone
            </span>
            <span class="text-beige-200 text-lg md:text-xl font-display font-bold uppercase tracking-[0.2em] flex items-center gap-3">
                ✦ Cozy Co-Working Space
            </span>
            <span class="text-beige-200 text-lg md:text-xl font-display font-bold uppercase tracking-[0.2em] flex items-center gap-3">
                ✦ Freshly Baked Pastry
            </span>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     SPECIALTY COFFEE MENU SECTION (THE SIP ART)
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[92vh] flex items-center bg-beige-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-16 reveal">
            <div class="max-w-2xl">
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-5 h-[1px] bg-olive-500"></span>
                    <span class="text-olive-600 text-xs font-bold uppercase tracking-[0.2em]">Ritual Harian</span>
                </div>
                <h2 class="font-display text-4xl md:text-6xl text-olive-900 font-bold leading-tight">
                    The Art of <span class="text-beige-600 italic font-semibold">Sip.</span>
                </h2>
                <p class="text-olive-800/70 text-base md:text-lg mt-4 leading-relaxed">
                    Setiap cangkir adalah simfoni rasa yang diracik presisi oleh barista berlisensi kami menggunakan mesin espresso tercanggih dan biji berkualitas tinggi.
                </p>
            </div>
            <a href="{{ route('menu') }}" class="border border-olive-800/30 text-olive-900 hover:bg-olive-800 hover:text-beige-50 px-8 py-3 rounded-2xl font-bold transition-all duration-300 inline-flex items-center gap-2">
                <span>Seluruh Menu</span>
            </a>
        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($featuredMenus as $i => $menu)
            <div class="relative bg-white border border-olive-800/20 rounded-[2rem] p-6 hover:border-olive-300 hover:shadow-xl hover:shadow-olive-900/8 transition-all duration-200 group reveal" style="transition-delay: {{ ($i % 9) * 0.07 }}s">
                {{-- Stretched Link to Detail Page --}}
                <a href="{{ route('menu.show', $menu) }}" class="absolute inset-0 rounded-[2.5rem] z-10" aria-label="Lihat detail {{ $menu->name }}"></a>
                
                {{-- Top Row --}}
                <div class="flex items-center justify-between mb-5 relative z-30">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-olive-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                        </svg>
                        <span class="text-olive-800/40 text-[0.65rem] font-bold uppercase tracking-widest">{{ $menu->category }}</span>
                    </div>
                    
                    {{-- Cart Icon: Add to Cart (auth) or Login redirect (guest) --}}
                    @auth
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" title="Tambah ke Keranjang"
                                class="w-9 h-9 rounded-full bg-olive-500 hover:bg-olive-800 hover:text-beige-50 text-beige-50 flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" title="Login untuk menambah ke keranjang"
                       class="w-9 h-9 rounded-full bg-beige-200 hover:bg-olive-700 hover:text-beige-50 text-olive-900 flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </a>
                    @endauth
                </div>

                {{-- Title Centered --}}
                <h3 class="text-center font-display text-2xl font-bold tracking-wide text-olive-900 mb-6 leading-snug px-4 relative z-20">
                    {{ $menu->name }}
                </h3>

                {{-- Middle Image with Pill Badge --}}
                <div class="relative aspect-[4/3] rounded-[2rem] overflow-hidden bg-olive-950/40 border border-white/5 shadow-inner z-20">
                    @if($menu->image)
                        <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="w-full h-full object-cover transform duration-300 group-hover:scale-105">
                    @else
                        <div class="w-full h-full flex items-center justify-center opacity-20 text-6xl bg-olive-950/20">☕</div>
                    @endif

                    {{-- Branded Price Badge (non-interactive, just visual) --}}
                    <div class="absolute bottom-5 left-1/2 -translate-x-1/2 bg-black/65 backdrop-blur-md px-5 py-2.5 rounded-full border border-white/10 flex items-center gap-2 shadow-md text-xs text-beige-200 whitespace-nowrap">
                        <span class="font-semibold">{{ $menu->formatted_price }}</span>
                    </div>
                </div>

                {{-- Bottom Description --}}
                <p class="text-center text-olive-700/80 text-xs leading-relaxed max-w-[280px] mx-auto mt-6 px-2 line-clamp-2 relative z-20">
                    {{ $menu->description ?: 'Nikmati hidangan spesial racikan barista pilihan Filo Coffee yang disajikan segar untuk menyempurnakan hari Anda.' }}
                </p>
            </div>
            @empty
            {{-- Fallback Mockup Cards if DB is Empty --}}
            @foreach([
                ['name' => 'Rose Pistachio Latte', 'price' => 'Rp 38.000', 'desc' => 'Espresso espresso ristretto dipadukan susu evaporasi, ekstrak kelopak mawar alami dan remukan pistachio gurih.'],
                ['name' => 'Signature Cold Drip Gayo', 'price' => 'Rp 42.000', 'desc' => 'Seduhan tetesan air dingin selama 12 jam menghasilkan ekstraksi buah berry manis bebas asam berlebih.'],
                ['name' => 'Salted Caramel Macchiato', 'price' => 'Rp 36.000', 'desc' => 'Espresso bold, vanilla syrup, fresh milk berbusa tebal diguyur saus karamel asin spesial racikan Filo.']
            ] as $i => $mock)
            <div class="relative bg-beige-50 border border-olive-800/20 rounded-[2.5rem] p-6 hover:border-olive-700/35 hover:shadow-2xl hover:shadow-olive-950/40 transition-all duration-500 group reveal shadow-xl" style="transition-delay: {{ $i * 0.1 }}s">
                {{-- Stretched Link to Menu Page --}}
                <a href="{{ route('menu') }}" class="absolute inset-0 rounded-[2.5rem] z-10" aria-label="Lihat detail {{ $mock['name'] }}"></a>
                
                {{-- Top Row --}}
                <div class="flex items-center justify-between mb-5 relative z-20">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-olive-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                        </svg>
                        <span class="text-olive-800/40 text-[0.65rem] font-bold uppercase tracking-widest">Signature Craft</span>
                    </div>
                    
                    <span class="w-9 h-9 rounded-full bg-olive-500 hover:bg-olive-800 text-beige-50 flex items-center justify-center transition-all duration-300 hover:scale-105 shadow-sm">
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </span>
                </div>

                {{-- Title Centered --}}
                <h3 class="text-center font-display text-2xl font-bold tracking-wide text-olive-900 uppercase mb-6 leading-snug px-4 relative z-20">
                    {{ $mock['name'] }}
                </h3>

                {{-- Middle Image with Pill Badge --}}
                <div class="relative aspect-[4/3] rounded-[2rem] overflow-hidden bg-olive-950/40 border border-white/5 shadow-inner z-20">
                    <div class="w-full h-full flex items-center justify-center opacity-20 text-6xl bg-olive-950/20">☕</div>

                    {{-- Branded Price Pill CTA --}}
                    <a href="{{ route('login') }}" class="absolute bottom-5 left-1/2 -translate-x-1/2 z-30 bg-black/75 hover:bg-olive-800 hover:text-beige-50 backdrop-blur-md px-5 py-2.5 rounded-full border border-white/10 flex items-center gap-2 shadow-md transition-all duration-300 transform hover:scale-105 active:scale-95 text-xs text-beige-200 whitespace-nowrap">
                        <span class="font-semibold">{{ $mock['price'] }}</span>
                    </a>
                </div>

                {{-- Bottom Description --}}
                <p class="text-center text-olive-850/60 text-xs leading-relaxed max-w-[280px] mx-auto mt-6 px-2 line-clamp-2 relative z-20">
                    {{ $mock['desc'] }}
                </p>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     THE BEAN SHOP SECTION (ROASTER'S RESERVE)
     ═══════════════════════════════════════ --}}
<section class="py-24 bg-olive-900 text-beige-50 relative overflow-hidden min-h-[92vh] flex items-center">
    {{-- Decorative Background Ring --}}
    <div class="absolute left-[-15%] top-1/3 w-[600px] h-[600px] border border-beige-50/5 rounded-full pointer-events-none"></div>
    <div class="absolute right-0 bottom-0 w-[400px] h-[400px] bg-olive-800/50 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Section Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-16 reveal">
            <div class="max-w-2xl">
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-5 h-[1px] bg-beige-300"></span>
                    <span class="text-beige-300 text-xs font-bold uppercase tracking-[0.2em]">Kopi Seduh di Rumah</span>
                </div>
                <h2 class="font-display text-4xl md:text-6xl text-beige-50 font-bold leading-tight">
                    Roaster's <span class="text-beige-300 italic font-semibold">Reserve.</span>
                </h2>
                <p class="text-beige-100/60 text-base md:text-lg mt-4 leading-relaxed">
                    Kurasi biji kopi mikro-lot pilihan dari perkebunan terbaik Nusantara. Dipanggang secara presisi oleh *head roaster* kami guna memancarkan karakter rasa murni.
                </p>
            </div>
            <a href="{{ route('shop') }}" class="border border-beige-300/30 text-beige-100 hover:bg-beige-100 hover:text-olive-900 px-8 py-3 rounded-2xl font-bold transition-all duration-200 inline-flex items-center gap-2">
                <span>Lihat Seluruh Beans</span>
            </a>
        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($featuredProducts as $i => $product)
            <div class="relative bg-olive-900 border border-beige-300/10 rounded-[2.5rem] p-6 hover:border-beige-300/40 hover:shadow-2xl hover:shadow-olive-950/40 transition-all duration-200 group reveal" style="transition-delay: {{ ($i % 9) * 0.07 }}s">
                {{-- Stretched Link to Detail Page --}}
                <a href="{{ route('shop.show', $product) }}" class="absolute inset-0 rounded-[2.5rem] z-10" aria-label="Lihat detail {{ $product->name }}"></a>

                {{-- Top Row --}}
                <div class="flex items-center justify-between mb-5 relative z-30">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-beige-400/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2H5zm7 4a1 1 0 011 1v4a1 1 0 01-2 0V8a1 1 0 011-1zm0 8a1 1 0 100-2 1 1 0 000 2z"/>
                        </svg>
                        <span class="text-beige-100/40 text-[0.65rem] font-bold uppercase tracking-widest">{{ $product->origin }} · {{ $product->weight_grams }}g</span>
                    </div>

                    {{-- Cart Button --}}
                    @auth
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" title="Tambah ke Keranjang"
                                class="w-9 h-9 rounded-full bg-beige-200 hover:bg-olive-700 hover:text-beige-50 text-olive-900 flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" title="Login untuk membeli"
                       class="w-9 h-9 rounded-full bg-beige-200 hover:bg-olive-700 hover:text-beige-50 text-olive-900 flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </a>
                    @endauth
                </div>

                {{-- Title Centered --}}
                <h3 class="text-center font-display text-2xl font-bold tracking-wide text-beige-50 mb-6 leading-snug px-4 relative z-20">
                    {{ $product->name }}
                </h3>

                {{-- Image with Price Badge --}}
                <div class="relative aspect-[4/3] rounded-[2rem] overflow-hidden bg-olive-950/40 border border-white/5 shadow-inner z-20">
                    @if($product->image)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover transform duration-300 group-hover:scale-105">
                    @else
                        <div class="w-full h-full flex items-center justify-center opacity-20 text-6xl bg-olive-950/20">☕</div>
                    @endif

                    {{-- Roast Level Badge (top-left) --}}
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1.5 rounded-full text-[0.6rem] font-bold tracking-widest uppercase bg-beige-500/90 text-olive-950 shadow-md backdrop-blur-sm">
                            {{ $product->roast_level }}
                        </span>
                    </div>

                    {{-- Price Badge (bottom center, visual only) --}}
                    <div class="absolute bottom-5 left-1/2 -translate-x-1/2 bg-black/65 backdrop-blur-md px-5 py-2.5 rounded-full border border-white/10 flex items-center gap-2 shadow-md text-xs text-beige-200 whitespace-nowrap pointer-events-none">
                        <span class="font-semibold">{{ $product->formatted_price }}</span>
                    </div>
                </div>

                {{-- Bottom Flavor Notes --}}
                <p class="text-center text-beige-100/40 text-xs leading-relaxed max-w-[280px] mx-auto mt-6 px-2 line-clamp-2 relative z-20">
                    {{ $product->flavor_notes ?: 'Biji kopi arabika pilihan berkarakter rasa khas yang disangrai presisi untuk cita rasa terbaik.' }}
                </p>
            </div>
            @empty
            {{-- Fallback Mockup Beans if DB is Empty --}}
            @foreach([
                ['name' => 'Mount Kerinci Washed', 'price' => 'Rp 95.000', 'notes' => 'Mandarin Orange, Red Apple, Cane Sugar sweetness.', 'roast' => 'Light Roast', 'origin' => 'Sumatra · 250g'],
                ['name' => 'Toraja Sapan Natural', 'price' => 'Rp 110.000', 'notes' => 'Dark Cherry, Raisin, Cacao Nibs complex finish.', 'roast' => 'Medium Roast', 'origin' => 'Sulawesi · 250g'],
                ['name' => 'Gayo Anaerob Honey', 'price' => 'Rp 125.000', 'notes' => 'Tropical Fruit, Pineapple punch, Jasmine aroma.', 'roast' => 'Medium-Dark', 'origin' => 'Aceh · 250g']
            ] as $i => $mock)
            <div class="relative bg-olive-900 border border-olive-800/20 rounded-[2.5rem] p-6 hover:border-olive-700/35 hover:shadow-2xl hover:shadow-olive-950/40 transition-all duration-500 group reveal shadow-xl" style="transition-delay: {{ $i * 0.1 }}s">

                {{-- Stretched Link to Shop Page --}}
                <a href="{{ route('shop') }}" class="absolute inset-0 rounded-[2.5rem] z-10" aria-label="Lihat koleksi biji kopi"></a>

                {{-- Top Row --}}
                <div class="flex items-center justify-between mb-5 relative z-30">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-beige-400/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2H5zm7 4a1 1 0 011 1v4a1 1 0 01-2 0V8a1 1 0 011-1zm0 8a1 1 0 100-2 1 1 0 000 2z"/>
                        </svg>
                        <span class="text-beige-100/40 text-[0.65rem] font-bold uppercase tracking-widest">{{ $mock['origin'] }}</span>
                    </div>
                    <a href="{{ route('login') }}" title="Login untuk membeli"
                       class="w-9 h-9 rounded-full bg-beige-200 hover:bg-olive-700 hover:text-beige-50 text-olive-900 flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </a>
                </div>

                {{-- Title Centered --}}
                <h3 class="text-center font-display text-2xl font-bold tracking-wide text-beige-50 uppercase mb-6 leading-snug px-4 relative z-20">
                    {{ $mock['name'] }}
                </h3>

                {{-- Image with Price Badge --}}
                <div class="relative aspect-[4/3] rounded-[2rem] overflow-hidden bg-olive-950/40 border border-white/5 shadow-inner z-20">
                    <div class="w-full h-full flex items-center justify-center opacity-20 text-6xl bg-olive-950/20">☕</div>

                    {{-- Roast Badge --}}
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1.5 rounded-full text-[0.6rem] font-bold tracking-widest uppercase bg-beige-500/90 text-olive-950 shadow-md backdrop-blur-sm">
                            {{ $mock['roast'] }}
                        </span>
                    </div>

                    {{-- Price Badge --}}
                    <div class="absolute bottom-5 left-1/2 -translate-x-1/2 bg-black/65 backdrop-blur-md px-5 py-2.5 rounded-full border border-white/10 flex items-center gap-2 shadow-md text-xs text-beige-200 whitespace-nowrap pointer-events-none">
                        <span>🫘</span>
                        <span class="font-semibold">{{ $mock['price'] }}</span>
                    </div>
                </div>

                {{-- Bottom Flavor Notes --}}
                <p class="text-center text-beige-100/40 text-xs leading-relaxed max-w-[280px] mx-auto mt-6 px-2 line-clamp-2 relative z-20">
                    {{ $mock['notes'] }}
                </p>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     EXPERIENCES & SPACES (TABLE & PLAYSTATION RESERVATIONS)
     ═══════════════════════════════════════ --}}
<section class="py-24 bg-beige-50 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center max-w-2xl mx-auto mb-20 reveal">
            <div class="inline-flex items-center gap-2 mb-4">
                <span class="w-5 h-[1px] bg-olive-500"></span>
                <span class="text-olive-600 text-xs font-bold uppercase tracking-[0.2em]">Fasilitas Eksklusif</span>
                <span class="w-5 h-[1px] bg-olive-500"></span>
            </div>
            <h2 class="font-display text-4xl md:text-6xl text-olive-900 font-bold">
                Pesan<br>
                <span class="text-beige-600 italic font-semibold">Pengalaman Anda.</span>
            </h2>
            <p class="text-olive-800/70 text-base md:text-lg mt-4 leading-relaxed">
                Dari ruang diskusi yang hening hingga arena gaming paling modern. Kami menyediakan space ternyaman sesuai gaya ritus Anda.
            </p>
        </div>

        {{-- Side-by-Side Spaces Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            {{-- Experience Card 1: Dine-in Table Reservations --}}
            <div class="bg-beige-100 border border-beige-200 rounded-[2.5rem] p-10 md:p-14 shadow-xl shadow-olive-900/5 relative overflow-hidden group reveal">
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-olive-100 rounded-full blur-3xl pointer-events-none transition-transform duration-1000 group-hover:scale-110"></div>
                
                <div class="w-16 h-16 bg-olive-800 text-beige-50 rounded-2xl flex items-center justify-center text-3xl shadow-lg shadow-olive-900/10 mb-10 group-hover:scale-105 transition-transform duration-500">
                    🏠
                </div>

                <span class="text-beige-600 text-[0.65rem] font-bold uppercase tracking-[0.2em] block mb-2">Modern Cafe House</span>
                <h3 class="font-display text-3xl md:text-4xl text-olive-900 font-bold mb-4">
                    VIP Private Room & Working Space
                </h3>
                <p class="text-olive-800/70 text-base leading-relaxed mb-8 max-w-md">
                    Butuh privasi untuk rapat atau meja tenang dengan internet serat optik super kencang? Nikmati colokan melimpah, AC sejuk, smart TV presentasi, dan kursi ergonomis kami.
                </p>

                <div class="pt-6 border-t border-beige-200 flex flex-wrap items-center gap-6">
                    <a href="{{ route('reservation.index') }}" class="border border-olive-800/30 text-olive-900 hover:bg-olive-800 hover:text-beige-50 px-8 py-3 rounded-2xl font-bold transition-all duration-300 inline-flex items-center gap-2">
                        <span>Pesan Meja Sekarang</span>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="{{ route('services') }}" class="text-olive-800 hover:text-olive-950 font-bold text-sm tracking-wider uppercase">Info Detail</a>
                </div>
            </div>

            {{-- Experience Card 2: PlayStation Gaming Setup --}}
            <div class="bg-olive-900 border border-olive-800 rounded-[2.5rem] p-10 md:p-14 text-beige-50 shadow-2xl shadow-black/20 relative overflow-hidden group reveal" style="transition-delay: 0.2s">
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-olive-750/30 rounded-full blur-3xl pointer-events-none transition-transform duration-1000 group-hover:scale-110"></div>

                <div class="w-16 h-16 bg-beige-100 text-olive-900 rounded-2xl flex items-center justify-center text-3xl shadow-lg shadow-black/20 mb-10 group-hover:scale-105 transition-transform duration-500">
                    🎮
                </div>

                <span class="text-beige-300 text-[0.65rem] font-bold uppercase tracking-[0.2em] block mb-2">High Fidelity Gaming Suites</span>
                <h3 class="font-display text-3xl md:text-4xl text-beige-50 font-bold mb-4">
                    Exclusive PlayStation VR & 4K PS5 Lounge
                </h3>
                <p class="text-beige-100/60 text-base leading-relaxed mb-8 max-w-md">
                    Segarkan kembali pikiran Anda bersama kerabat terbaik dalam bilik eksklusif kedap suara lengkap dengan konsol PS5 terbaru, layar LED 4K premium, serta sistem tata suara dolby surround.
                </p>

                <div class="pt-6 border-t border-olive-800 flex flex-wrap items-center gap-6">
                    <a href="{{ route('playstation.index') }}" class="border border-beige-300/30 text-beige-100 hover:bg-beige-100 hover:text-olive-900 px-8 py-3 rounded-2xl font-bold transition-all duration-200 inline-flex items-center gap-2">
                        <span>Booking Slot PS5</span>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     MEMBER REWARDS SECTION (PRIVILEGE RITUAL)
     ═══════════════════════════════════════ --}}
<section class="py-20 bg-beige-100 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="bg-olive-800 rounded-[3rem] p-10 md:p-20 text-beige-50 relative overflow-hidden flex flex-col lg:flex-row items-center gap-12 shadow-2xl shadow-olive-900/10 border border-olive-750/30 reveal">
            {{-- Deco glow --}}
            <div class="absolute -right-20 -bottom-20 w-[400px] h-[400px] bg-olive-700/40 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="lg:w-2/3 space-y-6">
                <span class="px-4 py-1.5 rounded-full text-[0.6rem] font-bold tracking-widest uppercase bg-beige-500 text-olive-950">
                    Filo Club Member Privilege
                </span>
                <h2 class="font-display text-4xl md:text-5xl text-beige-50 font-bold leading-tight">
                    Tingkatkan Ritual Ngopi<br>
                    <span class="italic font-semibold">Anda. Dapatkan Hadiah Eksklusif.</span>
                </h2>
                <p class="text-beige-100/70 text-base md:text-lg leading-relaxed max-w-xl">
                    Sebagai anggota kehormatan Filo Club, kumpulkan poin dari setiap cangkir kopi dan biji sangrai yang dibeli. Nikmati segelas kopi gratis di hari lahir Anda, reservasi VIP prioritas, serta undangan cupping kopi terbatas.
                </p>
                <div class="flex items-center gap-8 pt-4">
                    <div>
                        <div class="font-display text-3xl font-bold text-beige-300">1 Poin</div>
                        <div class="text-beige-100/50 text-[0.65rem] font-bold uppercase tracking-widest mt-1">Tiap Rp 10.000</div>
                    </div>
                    <div class="w-px h-10 bg-olive-700"></div>
                    <div>
                        <div class="font-display text-3xl font-bold text-beige-300">100 Poin</div>
                        <div class="text-beige-100/50 text-[0.65rem] font-bold uppercase tracking-widest mt-1">Free Latte/Flat White</div>
                    </div>
                </div>
            </div>

            <div class="lg:w-1/3 w-full flex flex-col items-center justify-center gap-4">
                <a href="{{ route('member') }}" class="border border-beige-200/30 text-beige-50 hover:bg-beige-100 hover:text-olive-900 w-full text-center px-10 py-4 rounded-2xl font-bold transition-all">
                    Gabung Sekarang
                </a>
                <p class="text-beige-100/40 text-xs">
                    Sudah memiliki akun? <a href="{{ route('login') }}" class="text-beige-300 underline font-bold hover:text-beige-100">Login di sini</a>.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     ONLINE ORDERING BANNER
     ═══════════════════════════════════════ --}}
<section class="py-20 bg-beige-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="reveal">
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-5 h-[1px] bg-olive-500"></span>
                    <span class="text-olive-600 text-xs font-bold uppercase tracking-[0.2em]">Pesan & Ambil Cepat</span>
                </div>
                <h2 class="font-display text-4xl md:text-5xl text-olive-900 font-bold leading-tight">
                    Ekspresikan Selera Kopi Anda Tanpa Mengantre.
                </h2>
                <p class="text-olive-800/70 text-base md:text-lg mt-6 leading-relaxed">
                    Sedang terburu-buru? Gunakan platform pemesanan online kami untuk memesan minuman favorit sebelum kedatangan. Kopi Anda akan disiapkan dengan suhu penyajian optimal tepat saat Anda menginjakkan kaki di kafe kami.
                </p>
                <div class="flex gap-4 mt-8">
                    <a href="{{ route('menu') }}" class="border border-olive-800/30 text-olive-900 hover:bg-olive-800 hover:text-beige-50 px-8 py-3 rounded-2xl font-bold transition-all duration-300 inline-flex items-center gap-2">
                        <span>Order Instant Pickup</span>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
            
            <div class="bg-beige-100 border border-beige-200 rounded-[2.5rem] p-8 md:p-12 relative overflow-hidden shadow-inner flex flex-col justify-center reveal" style="transition-delay: 0.2s">
                <div class="flex items-center gap-6 mb-6">
                    <div class="w-14 h-14 bg-green-900/10 rounded-2xl flex items-center justify-center text-3xl">
                        🛵
                    </div>
                    <div>
                        <h4 class="font-display text-xl text-olive-900 font-bold">Express WhatsApp Delivery</h4>
                        <p class="text-olive-800/50 text-xs font-semibold uppercase tracking-wider">Antar Cepat Area Terdekat</p>
                    </div>
                </div>
                <p class="text-olive-800/70 text-sm leading-relaxed mb-6">
                    Ingin bersantai di rumah tanpa mengurangi kualitas kafein harian? Hubungi barista kami langsung melalui jalur khusus WhatsApp. Pengantaran menggunakan kemasan botol kaca bersegel steril eksklusif.
                </p>
                <a href="https://wa.me/6281234567890" target="_blank" class="bg-green-600 text-white hover:bg-green-700 py-4 rounded-2xl text-center font-bold flex items-center justify-center gap-2 shadow-lg shadow-green-600/15">
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    <span>Pesan Lewat Whatsapp</span>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     CUSTOMER REVIEWS SECTION (THE CONNOISSEUR'S VOICE)
     ═══════════════════════════════════════ --}}
<section class="py-24 bg-beige-100 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center max-w-2xl mx-auto mb-20 reveal">
            <div class="inline-flex items-center gap-2 mb-4">
                <span class="w-5 h-[1px] bg-olive-500"></span>
                <span class="text-olive-600 text-xs font-bold uppercase tracking-[0.2em]">Ulasan Penikmat Kopi</span>
                <span class="w-5 h-[1px] bg-olive-500"></span>
            </div>
            <h2 class="font-display text-4xl md:text-5xl text-olive-900 font-bold">
                Suara Para <span class="text-beige-600 italic font-semibold">Penikmat Rasa.</span>
            </h2>
            <p class="text-olive-800/70 text-sm md:text-base mt-4">
                Pendapat jujur dari para patron setia kami yang menghargai dedikasi dan kualitas penyajian kopi premium.
            </p>
        </div>

        {{-- Review Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                [
                    'name' => 'Adrian Wijaya',
                    'tag' => 'Coffee Enthusiast',
                    'quote' => 'Single Origin Pour Over mereka luar biasa bersih dan mengeluarkan sweet acidity fruity yang sangat jelas. Sangat jarang menemukan kualitas sangrai kopi yang seimbang ini di luar ibu kota.',
                    'stars' => '★★★★★'
                ],
                [
                    'name' => 'Clarissa Putri',
                    'tag' => 'Remote Creative',
                    'quote' => 'Pesan Working Space mereka untuk meeting penting dan sangat kagum dengan ketenangan ruangannya. Kursi ergonomis, kopi latte yang disajikan hangat ke meja, benar-benar produktif.',
                    'stars' => '★★★★★'
                ],
                [
                    'name' => 'Reza Syahputra',
                    'tag' => 'Gamer & Barista',
                    'quote' => 'Bilik PS5 di Filo adalah surga setelah hari yang melelahkan. Kami memesan kopi andalan dan langsung gaming dengan audio Dolby yang menggelegar. Kombinasi kafein dan hiburan berkelas!',
                    'stars' => '★★★★★'
                ]
            ] as $i => $review)
            <div class="bg-beige-50 border border-beige-200 rounded-[2rem] p-10 hover:border-olive-300 hover:shadow-xl hover:shadow-olive-900/5 transition-all duration-500 flex flex-col justify-between reveal" style="transition-delay: {{ $i * 0.1 }}s">
                <div>
                    {{-- Stars --}}
                    <div class="text-[#D4AF37] text-lg tracking-widest mb-6">{{ $review['stars'] }}</div>
                    
                    {{-- Review Content --}}
                    <p class="text-olive-900/80 text-sm leading-relaxed italic mb-8">
                        "{{ $review['quote'] }}"
                    </p>
                </div>
                
                {{-- Client Info --}}
                <div class="flex items-center gap-4 pt-6 border-t border-beige-200">
                    <div class="w-11 h-11 bg-olive-100 rounded-full flex items-center justify-center text-olive-800 text-lg font-bold">
                        {{ substr($review['name'], 0, 1) }}
                    </div>
                    <div>
                        <h4 class="font-display font-bold text-sm text-olive-900">{{ $review['name'] }}</h4>
                        <p class="text-olive-500 text-[0.65rem] font-bold uppercase tracking-wider">{{ $review['tag'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    @keyframes marquee {
        0% { transform: translateX(0%); }
        100% { transform: translateX(-100%); }
    }
    .animate-marquee {
        animation: marquee 25s linear infinite;
    }
    .hover-pause:hover .animate-marquee {
        animation-play-state: paused;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Animation delay for reveal items
        const revealItems = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.05 });

        revealItems.forEach(item => observer.observe(item));
    });
</script>
@endpush
