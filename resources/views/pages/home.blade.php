@extends('layouts.app')
@section('title', 'Home')
@section('meta_description', 'Filo Coffee — Kesederhanaan dalam rasa, kehangatan dalam setiap cangkir kopi pilihan Nusantara.')

@section('content')

{{-- ═══════════════════════════════════════
     HERO SECTION
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[95vh] flex items-center bg-dark">
    {{-- Background layers --}}
    <div class="absolute inset-0 opacity-30"
         style="background-image: radial-gradient(circle at 10% 90%, #6B4226 0%, transparent 40%), radial-gradient(circle at 90% 10%, #C9A87C 0%, transparent 40%)">
    </div>
    
    {{-- Decorative blurs --}}
    <div class="absolute right-[-10%] top-1/4 w-[600px] h-[600px] bg-mocca/10 rounded-full blur-[140px] animate-pulse-glow"></div>
    <div class="absolute left-[-5%] bottom-[-5%] w-96 h-96 bg-coffee/20 rounded-full blur-[120px]"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 grid lg:grid-cols-2 gap-20 items-center">
        <div class="animate-fade-in-up">
            {{-- Tag --}}
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-12 h-px bg-mocca/40"></span>
                <span class="text-mocca text-xs font-bold tracking-[0.3em] uppercase">Premium Experience</span>
            </div>

            {{-- Headline --}}
            <h1 class="font-display text-5xl md:text-7xl text-cream font-bold leading-[1.05] mb-8">
                Rasa Yang<br>
                <span class="text-mocca italic font-medium">Bercerita.</span>
            </h1>

            {{-- Description --}}
            <p class="text-cream/60 text-lg md:text-xl leading-relaxed mb-12 max-w-lg">
                Menghadirkan harmoni antara kesederhanaan rasa dan kehangatan Nusantara dalam setiap seduhan yang kami sajikan khusus untuk Anda.
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-wrap items-center gap-6">
                <a href="{{ route('menu') }}" class="btn-mocca !px-10 !py-4 group">
                    <span>Lihat Menu</span>
                    <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="{{ route('reservation.index') }}" class="btn-outline !px-10 !py-4 group">
                    <span>Reservasi</span>
                    <svg class="w-5 h-5 transition-transform duration-500 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </a>
            </div>

            {{-- Stats --}}
            <div class="flex gap-12 mt-20 animate-fade-in-up" style="animation-delay: 0.4s">
                @foreach([
                    ['value' => '50+', 'label' => 'Curated Menu'],
                    ['value' => '12+', 'label' => 'Single Origin'],
                    ['value' => '4.9', 'label' => 'User Rating'],
                ] as $i => $stat)
                <div class="relative">
                    <div class="font-display text-3xl font-bold text-mocca">{{ $stat['value'] }}</div>
                    <div class="text-cream/30 text-xs mt-2 font-bold tracking-widest uppercase">{{ $stat['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Hero Image --}}
        <div class="hidden lg:flex justify-center relative animate-fade-in-up" style="animation-delay: 0.2s">
            <div class="relative w-full max-w-xl">
                {{-- Decorative circles --}}
                <div class="absolute inset-0 border border-mocca/10 rounded-full scale-110 animate-pulse"></div>
                <div class="absolute inset-0 border border-mocca/5 rounded-full scale-125 animate-pulse" style="animation-delay: 1s"></div>
                
                <div class="relative z-10 p-8">
                    <div class="absolute inset-0 bg-gradient-to-br from-mocca/20 to-transparent rounded-full blur-3xl opacity-30"></div>
                    <img src="{{ asset('images/hero-coffee.png') }}" alt="Premium Filo Coffee" class="w-full h-auto drop-shadow-[0_35px_35px_rgba(0,0,0,0.6)] animate-float relative z-10">
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-3">
        <span class="text-[0.6rem] font-bold uppercase tracking-[0.3em] text-cream/20">Explore</span>
        <div class="w-px h-12 bg-gradient-to-b from-mocca/40 to-transparent"></div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     FEATURED MENU
     ═══════════════════════════════════════ --}}
@if($featuredMenus->isNotEmpty())
<section class="py-32 bg-dark">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-20 reveal">
            <div class="max-w-2xl">
                <p class="section-subtitle">Our Specialties</p>
                <h2 class="section-title">Pilihan Barista Kami</h2>
                <p class="text-cream/40 mt-6 text-lg leading-relaxed">Setiap cangkir adalah mahakarya. Kami memilih biji kopi terbaik dan menyeduhnya dengan presisi untuk menghadirkan karakter rasa yang unik.</p>
            </div>
            <a href="{{ route('menu') }}" class="btn-outline group h-fit">
                Semua Menu
                <svg class="w-4 h-4 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($featuredMenus as $i => $menu)
            <div class="card group reveal" style="transition-delay: {{ $i * 0.1 }}s">
                {{-- Image & Badges --}}
                <a href="{{ route('menu.show', $menu) }}" class="block relative aspect-square bg-warm overflow-hidden">
                    @if($menu->image)
                        <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}"
                             class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                    @else
                        <div class="w-full h-full flex items-center justify-center opacity-5 text-7xl">☕</div>
                    @endif

                    {{-- Category Badge --}}
                    <div class="absolute top-5 left-5">
                        <span class="badge bg-dark/60 backdrop-blur-md text-mocca border-white/5 uppercase tracking-widest text-[0.6rem]">
                            {{ $menu->category }}
                        </span>
                    </div>
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-dark/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                </a>

                {{-- Menu Info --}}
                <div class="p-6">
                    <div class="mb-4">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-mocca text-[0.65rem] font-bold uppercase tracking-[0.2em]">{{ $menu->category }}</span>
                            <span class="w-1 h-1 bg-white/10 rounded-full"></span>
                            <span class="text-cream/30 text-[0.65rem] font-bold uppercase tracking-[0.2em]">Signature</span>
                        </div>
                        <a href="{{ route('menu.show', $menu) }}">
                            <h3 class="font-display text-2xl text-cream font-bold leading-tight hover:text-mocca transition-colors duration-500 mb-2">
                                {{ $menu->name }}
                            </h3>
                        </a>
                        @if($menu->description)
                        <p class="text-cream/20 text-sm leading-relaxed line-clamp-2 italic">
                            {{ $menu->description }}
                        </p>
                        @endif
                    </div>

                    {{-- Pricing & Action --}}
                    <div class="flex items-center justify-between pt-6 border-t border-white/[0.05]">
                        <div class="flex flex-col">
                            <span class="text-mocca font-bold text-xl leading-none mb-1">{{ $menu->formatted_price }}</span>
                            <span class="text-cream/10 text-[0.6rem] font-bold uppercase tracking-widest">Handcrafted</span>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            @auth
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="w-12 h-12 bg-warm border border-white/5 text-mocca rounded-2xl flex items-center justify-center hover:bg-mocca hover:text-dark transition-all duration-500 shadow-xl group/btn">
                                    <svg class="w-5 h-5 transition-transform duration-500 group-hover/btn:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </button>
                            </form>
                            @else
                            <a href="{{ route('login') }}" class="btn-outline !py-2.5 !px-5 !text-[0.6rem] !rounded-xl">
                                Login To Buy
                            </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════
     SERVICES
     ═══════════════════════════════════════ --}}
<section class="py-32 relative overflow-hidden bg-dark-deep">
    <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/dark-leather.png')]"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-20 reveal">
            <p class="section-subtitle">Beyond Coffee</p>
            <h2 class="section-title">Layanan & Fasilitas</h2>
            <p class="text-cream/30 mt-6 max-w-2xl mx-auto text-lg leading-relaxed">Kami tidak hanya menyajikan kopi, tapi juga pengalaman dan kenyamanan untuk setiap momen Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
            $services = [
                ['icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>', 'title' => 'Dine In', 'desc' => 'Suasana cozy & premium untuk bekerja atau bersantai.', 'link' => route('reservation.index'), 'cta' => 'Book Table'],
                ['icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>', 'title' => 'Retail Beans', 'desc' => 'Bawa pulang kesegaran biji kopi pilihan terbaik kami.', 'link' => route('shop'), 'cta' => 'Shop Now'],
                ['icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/></svg>', 'title' => 'PlayStation', 'desc' => 'Area gaming khusus untuk melepas penat bersama teman.', 'link' => route('playstation.index'), 'cta' => 'Book Gaming'],
                ['icon' => '<svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>', 'title' => 'WhatsApp Delivery', 'desc' => 'Nikmati kopi favorit tanpa keluar rumah. Cepat & aman.', 'link' => 'https://wa.me/6281234567890', 'cta' => 'Order Now'],
            ];
            @endphp

            @foreach($services as $i => $service)
            <div class="group bg-warm border border-white/5 rounded-[2rem] p-10 hover:bg-warm-light hover:border-mocca/20 transition-all duration-500 reveal" style="transition-delay: {{ $i * 0.1 }}s">
                <div class="w-16 h-16 mb-8 bg-dark rounded-2xl flex items-center justify-center text-mocca group-hover:scale-110 group-hover:bg-mocca group-hover:text-dark transition-all duration-500 shadow-xl shadow-black/20">
                    {!! $service['icon'] !!}
                </div>
                <h3 class="font-display text-2xl text-cream font-semibold mb-4">{{ $service['title'] }}</h3>
                <p class="text-cream/30 text-base leading-relaxed mb-8">{{ $service['desc'] }}</p>
                <a href="{{ $service['link'] }}" class="inline-flex items-center gap-2 text-mocca text-sm font-bold uppercase tracking-widest group/link">
                    {{ $service['cta'] }}
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     FEATURED PRODUCTS
     ═══════════════════════════════════════ --}}
@if($featuredProducts->isNotEmpty())
<section class="py-32 bg-dark relative overflow-hidden">
    {{-- Background decorative --}}
    <div class="absolute left-0 top-1/2 w-[500px] h-[500px] bg-mocca/[0.02] rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-10 mb-20 reveal">
            <div class="max-w-xl">
                <p class="section-subtitle">Premium Beans</p>
                <h2 class="section-title">Filo Roastery</h2>
                <p class="text-cream/40 mt-4">Koleksi biji kopi pilihan dari kebun-kebun terbaik di Indonesia, dipanggang dengan profil yang tepat untuk menjaga kualitas rasa.</p>
            </div>
            <a href="{{ route('shop') }}" class="btn-outline group">
                Shop All Beans
                <svg class="w-4 h-4 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($featuredProducts as $i => $product)
            <div class="card group reveal" style="transition-delay: {{ $i * 0.1 }}s">
                {{-- Image & Badges --}}
                <a href="{{ route('shop.show', $product) }}" class="block relative aspect-square bg-warm overflow-hidden">
                    @if($product->image)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                             class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                    @else
                        <div class="w-full h-full flex items-center justify-center opacity-5 text-7xl">☕</div>
                    @endif

                    {{-- Roast Badge --}}
                    <div class="absolute top-5 left-5">
                        <span class="badge bg-dark/60 backdrop-blur-md text-mocca border-white/5 uppercase tracking-widest text-[0.6rem]">
                            {{ $product->roast_level }}
                        </span>
                    </div>
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-dark/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                </a>

                {{-- Product Info --}}
                <div class="p-6">
                    <div class="mb-4">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-mocca text-[0.65rem] font-bold uppercase tracking-[0.2em]">{{ $product->origin }}</span>
                            <span class="w-1 h-1 bg-white/10 rounded-full"></span>
                            <span class="text-cream/30 text-[0.65rem] font-bold uppercase tracking-[0.2em]">{{ $product->weight_grams }}G</span>
                        </div>
                        <a href="{{ route('shop.show', $product) }}">
                            <h3 class="font-display text-2xl text-cream font-bold leading-tight hover:text-mocca transition-colors duration-500 mb-2">
                                {{ $product->name }}
                            </h3>
                        </a>
                        @if($product->flavor_notes)
                        <p class="text-cream/20 text-sm leading-relaxed line-clamp-1 italic">
                            Notes: {{ $product->flavor_notes }}
                        </p>
                        @endif
                    </div>

                    {{-- Pricing & Action --}}
                    <div class="flex items-center justify-between pt-6 border-t border-white/[0.05]">
                        <div class="flex flex-col">
                            <span class="text-mocca font-bold text-xl leading-none mb-1">{{ $product->formatted_price }}</span>
                            <span class="text-cream/10 text-[0.6rem] font-bold uppercase tracking-widest">Premium Package</span>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            @auth
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="w-12 h-12 bg-warm border border-white/5 text-mocca rounded-2xl flex items-center justify-center hover:bg-mocca hover:text-dark transition-all duration-500 shadow-xl group/btn">
                                    <svg class="w-5 h-5 transition-transform duration-500 group-hover/btn:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </button>
                            </form>
                            @else
                            <a href="{{ route('login') }}" class="btn-outline !py-2.5 !px-5 !text-[0.6rem] !rounded-xl">
                                Login To Buy
                            </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════
     CTA BAND
     ═══════════════════════════════════════ --}}
<section class="relative py-32 overflow-hidden reveal">
    <div class="absolute inset-0 bg-mocca"></div>
    <div class="absolute inset-0 opacity-10 animate-shimmer" style="background-image: radial-gradient(circle at 50% 50%, #1a1815 0%, transparent 70%)"></div>
    
    {{-- Decorative patterns --}}
    <div class="absolute top-0 left-0 w-64 h-64 border border-dark/5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 border border-dark/5 rounded-full translate-x-1/3 translate-y-1/3"></div>

    <div class="relative max-w-5xl mx-auto px-4 text-center">
        <h2 class="font-display text-4xl md:text-6xl text-dark font-bold mb-8">Awali Hari Anda Dengan Kualitas Terbaik.</h2>
        <p class="text-dark/60 text-lg md:text-xl mb-12 max-w-2xl mx-auto">Kami mengundang Anda untuk merasakan pengalaman kopi yang berbeda, di mana setiap tegukan adalah perjalanan rasa.</p>
        
        <div class="flex flex-wrap justify-center items-center gap-6">
            <a href="{{ route('reservation.index') }}" class="bg-dark text-cream px-10 py-4 rounded-2xl font-bold hover:bg-dark-deep transition-all duration-300 hover:-translate-y-1 shadow-2xl shadow-dark/20 flex items-center gap-3 group">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>Reservasi Sekarang</span>
                <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="{{ route('menu') }}" class="bg-dark/5 text-dark border border-dark/10 px-10 py-4 rounded-2xl font-bold hover:bg-dark/10 transition-all duration-300 hover:-translate-y-1 flex items-center gap-3 group">
                <span>Lihat Daftar Menu</span>
                <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>

@endsection

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
        }, { threshold: 0.1 });

        revealItems.forEach(item => observer.observe(item));
    });
</script>
@endpush
