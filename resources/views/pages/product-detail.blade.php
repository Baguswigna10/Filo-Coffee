@extends('layouts.app')
@section('title', $product->name . ' | Roaster\'s Reserve Filo Coffee')
@section('meta_description', $product->description ?: 'Beli biji kopi premium ' . $product->name . ' origin ' . $product->origin . ' roast level ' . $product->roast_level . ' hanya di Filo Coffee Shop.')

@section('content')

{{-- ═══════════════════════════════════════
     PRODUCT HEADER / BREADCRUMB
     ═══════════════════════════════════════ --}}
<section class="pt-16 pb-8 md:pt-20 md:pb-12 bg-beige-50 relative overflow-hidden">
    {{-- Decorative subtle background shapes --}}
    <div class="absolute inset-0 opacity-50 pointer-events-none"
         style="background-image: radial-gradient(circle at 15% 15%, #CFDAD0 0%, transparent 40%), radial-gradient(circle at 85% 85%, #E6DCCF 0%, transparent 40%)">
    </div>
    <div class="absolute right-[-5%] top-1/4 w-[500px] h-[500px] bg-olive-200/30 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute left-[-5%] bottom-0 w-80 h-80 bg-beige-200/50 rounded-full blur-[100px] pointer-events-none"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex mb-4 animate-fade-in-up" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-700/60 hover:text-olive-900 transition-colors">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <span class="mx-2 text-olive-350">/</span>
                        <a href="{{ route('shop') }}" class="text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-700/60 hover:text-olive-900 transition-colors">Shop Beans</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <span class="mx-2 text-olive-350">/</span>
                        <span class="text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-800">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</section>

{{-- ═══════════════════════════════════════
     PRODUCT MAIN DETAIL SECTION
     ═══════════════════════════════════════ --}}
<section class="pb-24 bg-beige-50 relative overflow-hidden reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-20">
            
            {{-- Image Column --}}
            <div class="lg:col-span-6">
                <div class="group relative bg-white border border-olive-900/5 rounded-[2.5rem] overflow-hidden aspect-square flex items-center justify-center p-8 md:p-12 shadow-xl shadow-olive-900/5">
                    {{-- Soft premium gradient overlay on hover --}}
                    <div class="absolute inset-0 bg-gradient-to-br from-olive-100/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                    
                    @if($product->image)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                             class="max-w-[85%] max-h-[85%] object-contain drop-shadow-[0_20px_40px_rgba(21,28,21,0.08)] transform group-hover:scale-105 transition-transform duration-1000 ease-out">
                    @else
                        <div class="text-9xl opacity-20 transform group-hover:scale-110 transition-transform duration-700">🫘</div>
                    @endif

                    {{-- Badges Container --}}
                    <div class="absolute top-8 left-8 flex flex-col gap-3">
                        <span class="bg-olive-850 text-beige-50 border border-olive-700/20 px-4 py-2 rounded-xl text-[0.65rem] font-bold uppercase tracking-widest shadow-md">
                            Roast: {{ $product->roast_level }}
                        </span>
                        @if($product->stock <= 5)
                        <span class="bg-red-50 text-red-700 border border-red-200/50 px-4 py-2 rounded-xl text-[0.65rem] font-bold uppercase tracking-widest shadow-md">
                             Stok Terbatas
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Info Content Column --}}
            <div class="lg:col-span-6 flex flex-col justify-center">
                <div class="space-y-8">
                    <div>
                        <div class="inline-flex items-center gap-2 mb-4">
                            <span class="w-4 h-[1px] bg-olive-500"></span>
                            <span class="text-olive-700 text-xs font-bold tracking-[0.2em] uppercase">{{ $product->origin }} · Single Origin</span>
                        </div>
                        <h1 class="font-display text-4xl md:text-5xl lg:text-6xl text-olive-900 font-bold leading-[1.1] mb-6">
                            {{ $product->name }}
                        </h1>
                        <div class="text-olive-700 font-display font-semibold text-3xl mb-8">
                            {{ $product->formatted_price }}
                        </div>
                        <p class="text-olive-800/70 text-base leading-relaxed max-w-lg">
                            {{ $product->description ?: 'Biji kopi pilihan kualitas specialty grade yang diproses secara tradisional dan disangrai presisi untuk mengeluarkan profil rasa orisinal terbaik dari perkebunan Nusantara.' }}
                        </p>
                    </div>

                    {{-- Technical Specifications Grid --}}
                    <div class="grid grid-cols-2 gap-6 py-6 border-y border-olive-900/10">
                        <div>
                            <span class="text-olive-700/50 text-[0.65rem] font-bold uppercase tracking-widest mb-1 block">Origin Region</span>
                            <span class="text-olive-900 font-bold text-sm tracking-wide">{{ $product->origin }}</span>
                        </div>
                        <div>
                            <span class="text-olive-700/50 text-[0.65rem] font-bold uppercase tracking-widest mb-1 block">Roast Level</span>
                            <span class="text-olive-700 font-semibold text-sm tracking-wide uppercase">{{ $product->roast_level }}</span>
                        </div>
                        <div>
                            <span class="text-olive-700/50 text-[0.65rem] font-bold uppercase tracking-widest mb-1 block">Net Weight</span>
                            <span class="text-olive-900 font-bold text-sm tracking-wide">{{ $product->weight_grams }} Grams</span>
                        </div>
                        <div>
                            <span class="text-olive-700/50 text-[0.65rem] font-bold uppercase tracking-widest mb-1 block">Availability</span>
                            @if($product->stock > 0)
                                <span class="text-green-700 font-bold text-sm tracking-wide">{{ $product->stock }} Pcs Tersedia</span>
                            @else
                                <span class="text-red-650 font-bold text-sm tracking-wide">Stok Habis</span>
                            @endif
                        </div>
                    </div>

                    {{-- Add to Cart Action Block --}}
                    @if($product->stock > 0)
                    <div class="flex items-center gap-4 pt-2 w-full">
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-1 flex flex-col gap-4 w-full">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <div class="flex flex-col sm:flex-row gap-4 w-full">
                                {{-- Quantity selector --}}
                                <div class="flex items-center bg-white border border-olive-900/10 rounded-2xl p-1.5 shrink-0 h-16 shadow-sm justify-between sm:justify-start">
                                    <button type="button" onclick="this.nextElementSibling.stepDown()" class="w-12 h-full flex items-center justify-center text-olive-500 hover:text-olive-900 transition-colors">
                                         <span class="text-2xl font-medium">−</span>
                                    </button>
                                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                           class="w-14 bg-transparent border-0 text-center text-olive-900 font-bold text-lg focus:ring-0 focus:outline-none">
                                    <button type="button" onclick="this.previousElementSibling.stepUp()" class="w-12 h-full flex items-center justify-center text-olive-500 hover:text-olive-900 transition-colors">
                                         <span class="text-2xl font-medium">+</span>
                                    </button>
                                </div>

                                {{-- Buttons Group --}}
                                <div class="flex flex-row gap-3 flex-1">
                                    {{-- Add to Cart Button --}}
                                    <button type="submit" name="redirect_to" value="" class="h-16 flex-1 border border-olive-800 text-olive-800 hover:bg-olive-50/50 font-bold rounded-2xl flex items-center justify-center gap-2 transition-all duration-300 group text-sm sm:text-base">
                                        <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                        <span>+ Keranjang</span>
                                    </button>

                                    {{-- Buy Now Button --}}
                                    <button type="submit" name="redirect_to" value="checkout" class="h-16 flex-1 bg-olive-800 text-beige-50 hover:bg-olive-900 font-bold rounded-2xl flex items-center justify-center gap-2 transition-all duration-300 shadow-xl shadow-olive-900/10 group text-sm sm:text-base">
                                        <svg class="w-5 h-5 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                        <span>Beli Langsung</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @else
                    <div class="pt-2">
                        <button type="button" disabled class="h-16 w-full bg-olive-900/10 text-olive-900/40 font-bold rounded-2xl flex items-center justify-center gap-3 cursor-not-allowed">
                            Stok Habis
                        </button>
                    </div>
                    @endif

                    {{-- Secure info strip --}}
                    <div class="flex flex-wrap items-center gap-6 pt-4 text-[0.65rem] font-bold uppercase tracking-widest text-olive-700/50">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-olive-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Checkout Aman
                        </span>
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-olive-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            Pengiriman Cepat
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     RELATED PRODUCTS
     ═══════════════════════════════════════ --}}
@if($related->isNotEmpty())
<section class="py-24 bg-beige-100 border-t border-olive-900/5 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex items-center justify-between mb-12">
            <div>
                <p class="text-olive-600 text-xs font-bold uppercase tracking-[0.18em] mb-2 flex items-center gap-2">
                    <span class="w-4 h-[1px] bg-olive-500"></span> Pilihan Lainnya
                </p>
                <h2 class="font-display text-3xl text-olive-900 font-bold">Produk <span class="text-beige-600 italic">Rekomendasi</span></h2>
            </div>
            <a href="{{ route('shop') }}" class="text-[0.65rem] font-bold uppercase tracking-widest text-olive-700/60 hover:text-olive-900 transition-colors">Lihat Semua Koleksi →</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($related as $rel)
            <a href="{{ route('shop.show', $rel) }}" class="group reveal" style="transition-delay: {{ $loop->index * 0.1 }}s">
                <div class="bg-white border border-olive-900/5 overflow-hidden rounded-[2rem] aspect-[4/5] flex flex-col hover:border-olive-900/10 hover:shadow-xl hover:shadow-olive-900/5 transition-all duration-500">
                    <div class="relative flex-1 bg-beige-50/50 flex items-center justify-center p-6 transition-colors duration-500 overflow-hidden">
                        @if($rel->image)
                            <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}" class="max-w-[70%] max-h-full object-contain transform group-hover:scale-105 transition-transform duration-700">
                        @else
                            <div class="text-6xl opacity-20 group-hover:scale-105 transition-transform duration-700">🫘</div>
                        @endif
                        <span class="absolute bottom-4 left-4 bg-white/80 backdrop-blur-md px-3 py-1 rounded-lg text-[0.65rem] font-bold uppercase tracking-widest text-olive-700 border border-olive-900/5 shadow-sm">{{ $rel->roast_level }}</span>
                    </div>
                    <div class="p-6 bg-white">
                        <h4 class="text-olive-900 text-base font-bold mb-1 truncate group-hover:text-olive-750 transition-colors">{{ $rel->name }}</h4>
                        <div class="text-olive-700 font-bold text-sm">{{ $rel->formatted_price }}</div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
