@extends('layouts.app')
@section('title', $product->name . ' | Filo Coffee')
@section('meta_description', $product->description ?: 'Beli biji kopi premium ' . $product->name . ' origin ' . $product->origin . ' roast level ' . $product->roast_level . ' hanya di Filo Coffee Shop.')

@section('content')

{{-- ═══════════════════════════════════════
     PRODUCT MAIN DETAIL SECTION
     ═══════════════════════════════════════ --}}
<section class="pt-24 pb-24 bg-beige-50 relative overflow-hidden reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-12 gap-8 lg:gap-16 items-start">
            
            {{-- Image Column (Full-bleed card) --}}
            <div class="lg:col-span-6">
                <div class="group relative bg-white border border-olive-900/5 rounded-[2.5rem] overflow-hidden aspect-square flex items-center justify-center shadow-xl shadow-olive-900/5">
                    {{-- Soft premium gradient overlay on hover --}}
                    <div class="absolute inset-0 bg-gradient-to-br group-hover:opacity-100 transition-opacity duration-5000 z-10"></div>
                    
                    @if($product->image)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                             class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-1000 ease-out">
                    @else
                        <div class="text-9xl opacity-20 transform group-hover:scale-110 transition-transform duration-700">🫘</div>
                    @endif

                    {{-- Badges Container --}}
                    <div class="absolute top-6 left-6 flex flex-col gap-2 z-20">
                        <span class="bg-olive-800/95 backdrop-blur-md text-beige-50 border border-white/10 px-4 py-2 rounded-2xl text-[0.65rem] font-bold uppercase tracking-widest shadow-md">
                            Roast: {{ $product->roast_level }}
                        </span>
                        @if($product->stock <= 5 && $product->stock > 0)
                        <span class="bg-red-600/90 backdrop-blur-md text-white border border-red-500/20 px-4 py-2 rounded-2xl text-[0.65rem] font-bold uppercase tracking-widest shadow-md animate-pulse">
                             Stok Terbatas
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Info Content Column --}}
            <div class="lg:col-span-6 flex flex-col justify-center py-2">
                <div class="space-y-6">
                    <div>
                        <div class="inline-flex items-center gap-2 mb-3">
                            <span class="w-4 h-[1px] bg-olive-500"></span>
                            <span class="text-olive-600 text-[10px] font-bold tracking-[0.25em] uppercase">{{ $product->origin }} · Single Origin</span>
                        </div>
                        <h1 class="font-display text-4xl md:text-5xl lg:text-6xl text-olive-900 font-bold leading-[1.1] mb-4">
                            {{ $product->name }}
                        </h1>
                        <div class="text-mocca-dark font-display font-semibold text-3xl mb-6 flex items-baseline gap-2">
                            <span>{{ $product->formatted_price }}</span>
                            <span class="text-xs font-sans text-olive-900/40 uppercase tracking-widest font-bold">/ {{ number_format($product->weight_grams, 0) }} gr</span>
                        </div>
                        <p class="text-olive-800/70 text-sm leading-relaxed max-w-xl">
                            {{ $product->description ?: 'Biji kopi pilihan kualitas specialty grade yang diproses secara tradisional dan disangrai presisi untuk mengeluarkan profil rasa orisinal terbaik dari perkebunan Nusantara.' }}
                        </p>
                    </div>

                    {{-- Technical Specifications Grid --}}
                    <div class="grid grid-cols-2 gap-x-6 gap-y-4 py-6 border-y border-olive-900/10">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-xl bg-olive-50 border border-olive-100 flex items-center justify-center text-olive-700 shrink-0 shadow-sm">
                                <span class="material-symbols-outlined text-lg">public</span>
                            </div>
                            <div>
                                <span class="text-olive-750/45 text-[9px] font-bold uppercase tracking-wider mb-0.5 block">Origin Region</span>
                                <span class="text-olive-900 font-bold text-xs tracking-wide">{{ $product->origin }}</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-xl bg-olive-50 border border-olive-100 flex items-center justify-center text-olive-700 shrink-0 shadow-sm">
                                <span class="material-symbols-outlined text-lg">local_fire_department</span>
                            </div>
                            <div>
                                <span class="text-olive-750/45 text-[9px] font-bold uppercase tracking-wider mb-0.5 block">Roast Level</span>
                                <span class="text-olive-900 font-bold text-xs tracking-wide uppercase">{{ $product->roast_level }}</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-xl bg-olive-50 border border-olive-100 flex items-center justify-center text-olive-700 shrink-0 shadow-sm">
                                <span class="material-symbols-outlined text-lg">scale</span>
                            </div>
                            <div>
                                <span class="text-olive-750/45 text-[9px] font-bold uppercase tracking-wider mb-0.5 block">Net Weight</span>
                                <span class="text-olive-900 font-bold text-xs tracking-wide">{{ number_format($product->weight_grams, 0) }} Gram</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-xl bg-olive-50 border border-olive-100 flex items-center justify-center text-olive-700 shrink-0 shadow-sm">
                                <span class="material-symbols-outlined text-lg">inventory_2</span>
                            </div>
                            <div>
                                <span class="text-olive-750/45 text-[9px] font-bold uppercase tracking-wider mb-0.5 block">Availability</span>
                                @if($product->stock > 0)
                                    <span class="text-emerald-700 font-bold text-xs tracking-wide">{{ $product->stock }} Pcs Tersedia</span>
                                @else
                                    <span class="text-red-650 font-bold text-xs tracking-wide">Stok Habis</span>
                                @endif
                            </div>
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
                                <div class="flex items-center bg-white border border-olive-900/10 rounded-2xl p-1.5 shrink-0 h-14 shadow-sm justify-between sm:justify-start ring-1 ring-olive-900/5">
                                    <button type="button" onclick="this.nextElementSibling.stepDown()" class="w-10 h-full flex items-center justify-center text-olive-500 hover:text-olive-900 transition-colors focus:outline-none">
                                         <span class="text-xl font-medium">−</span>
                                    </button>
                                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                           class="w-12 bg-transparent border-0 text-center text-olive-900 font-bold text-base focus:ring-0 focus:outline-none py-0">
                                    <button type="button" onclick="this.previousElementSibling.stepUp()" class="w-10 h-full flex items-center justify-center text-olive-500 hover:text-olive-900 transition-colors focus:outline-none">
                                         <span class="text-xl font-medium">+</span>
                                    </button>
                                </div>

                                {{-- Buttons Group --}}
                                <div class="flex flex-row gap-3 flex-1">
                                    {{-- Add to Cart Button --}}
                                    <button type="submit" name="redirect_to" value="" class="border border-olive-800/30 text-olive-900 hover:bg-olive-800 hover:text-beige-50 px-8 py-3 rounded-2xl font-bold transition-all duration-300 inline-flex items-center gap-2">
                                        <span class="material-symbols-outlined">shopping_bag</span>
                                        <span>+ Keranjang</span>
                                    </button>

                                    {{-- Buy Now Button --}}
                                    <button type="submit" name="redirect_to" value="checkout" class="flex-1 bg-olive-800 text-beige-50 hover:bg-olive-900 font-bold px-8 py-3 rounded-2xl flex items-center justify-center gap-2 transition-all duration-300 shadow-lg shadow-olive-900/10 group text-xs sm:text-sm active:scale-98">
                                        <span>Beli Langsung</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @else
                    <div class="pt-2">
                        <button type="button" disabled class="h-14 w-full bg-olive-900/10 text-olive-900/40 font-bold rounded-2xl flex items-center justify-center gap-3 cursor-not-allowed text-sm">
                            Stok Habis
                        </button>
                    </div>
                    @endif

                    {{-- Secure info strip --}}
                    <div class="flex flex-wrap items-center gap-6 pt-3 text-[9px] font-bold uppercase tracking-widest text-olive-750/40 border-t border-olive-900/5">
                        <span class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-base text-olive-500">lock</span>
                            Checkout Aman
                        </span>
                        <span class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-base text-olive-500">local_shipping</span>
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
<section class="py-20 bg-beige-100 border-t border-olive-900/5 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex items-end justify-between mb-10">
            <div>
                <p class="text-olive-600 text-xs font-bold uppercase tracking-[0.18em] mb-1.5 flex items-center gap-2">
                    <span class="w-4 h-[1px] bg-olive-500"></span> Pilihan Lainnya
                </p>
                <h2 class="font-display text-3xl text-olive-900 font-bold">Produk <span class="text-beige-600 italic">Rekomendasi</span></h2>
            </div>
            <a href="{{ route('shop') }}" class="text-[10px] font-bold uppercase tracking-wider text-olive-700/60 hover:text-olive-900 transition-colors flex items-center gap-1 group">
                Lihat Semua Koleksi 
                <span class="material-symbols-outlined text-xs transition-transform duration-250 group-hover:translate-x-0.5">chevron_right</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($related as $rel)
            <a href="{{ route('shop.show', $rel) }}" class="group reveal" style="transition-delay: {{ $loop->index * 0.08 }}s">
                <div class="bg-white border border-olive-900/5 overflow-hidden rounded-3xl aspect-[4/5] flex flex-col hover:border-olive-900/10 hover:shadow-xl hover:shadow-olive-900/5 transition-all duration-500">
                    <div class="relative flex-1 bg-beige-50/50 flex items-center justify-center overflow-hidden">
                        @if($rel->image)
                            <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                        @else
                            <div class="text-6xl opacity-20 group-hover:scale-105 transition-transform duration-700">🫘</div>
                        @endif
                        <span class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-md px-3 py-1 rounded-xl text-[9px] font-bold uppercase tracking-wider text-olive-700 border border-olive-900/5 shadow-sm">{{ $rel->roast_level }}</span>
                    </div>
                    <div class="p-5 bg-white">
                        <h4 class="text-olive-900 text-sm font-bold mb-1 truncate group-hover:text-mocca-dark transition-colors">{{ $rel->name }}</h4>
                        <div class="text-olive-700 font-extrabold text-xs">{{ $rel->formatted_price }}</div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
