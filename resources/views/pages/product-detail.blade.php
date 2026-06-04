@extends('layouts.app')
@section('title', $product->name)

@section('content')

{{-- ═══════════════════════════════════════
     PRODUCT HEADER / BREADCRUMB
     ═══════════════════════════════════════ --}}
<section class="pt-12 pb-6 md:pt-16 md:pb-10 bg-dark relative overflow-hidden">
    <div class="absolute inset-0 bg-dark opacity-40 pointer-events-none"></div>
    <div class="absolute inset-0 opacity-10 pointer-events-none" 
         style="background-image: radial-gradient(circle at 10% 20%, #CCB196 0%, transparent 40%)">
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex mb-8 animate-fade-in-up" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-[0.625rem] font-bold uppercase tracking-[0.2em] text-cream/20 hover:text-mocca transition-colors">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <span class="mx-2 text-cream/10">/</span>
                        <a href="{{ route('shop') }}" class="text-[0.625rem] font-bold uppercase tracking-[0.2em] text-cream/20 hover:text-mocca transition-colors">Shop Beans</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <span class="mx-2 text-mocca/30">/</span>
                        <span class="text-[0.625rem] font-bold uppercase tracking-[0.2em] text-mocca">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</section>

{{-- ═══════════════════════════════════════
     PRODUCT MAIN DETAIL
     ═══════════════════════════════════════ --}}
<section class="pb-24 reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-20">
            
            {{-- Image Side --}}
            <div class="lg:col-span-6">
                <div class="group relative bg-white/[0.02] border border-white/[0.05] rounded-[2.5rem] overflow-hidden aspect-square flex items-center justify-center p-8 md:p-12">
                    {{-- Interactive background --}}
                    <div class="absolute inset-0 bg-gradient-to-br from-mocca/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                    
                    @if($product->image)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                             class="max-w-full max-h-full object-contain drop-shadow-[0_20px_50px_rgba(0,0,0,0.5)] transform group-hover:scale-110 transition-transform duration-1000 ease-out">
                    @else
                        <div class="text-8xl opacity-10">☕</div>
                    @endif

                    {{-- Badges --}}
                    <div class="absolute top-8 left-8 flex flex-col gap-3">
                        <span class="bg-dark/80 backdrop-blur-md border border-white/10 px-4 py-2 rounded-xl text-[0.625rem] font-bold uppercase tracking-widest text-cream">
                            {{ $product->roast_level }} Roast
                        </span>
                        @if($product->stock <= 5)
                        <span class="bg-red-500/20 backdrop-blur-md border border-red-500/20 px-4 py-2 rounded-xl text-[0.625rem] font-bold uppercase tracking-widest text-red-400">
                             Low Stock
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Info Side --}}
            <div class="lg:col-span-6 flex flex-col justify-center">
                <div class="space-y-8">
                    <div>
                        <div class="inline-flex items-center gap-2 mb-4">
                            <span class="text-mocca text-[0.625rem] font-bold tracking-[0.2em] uppercase">{{ $product->origin }} · Single Origin</span>
                        </div>
                        <h1 class="font-display text-5xl md:text-6xl text-cream font-bold leading-tight mb-6">
                            {{ $product->name }}
                        </h1>
                        <div class="text-mocca font-bold text-3xl mb-8">
                            {{ $product->formatted_price }}
                        </div>
                        <p class="text-cream/40 text-sm leading-relaxed max-w-lg">
                            {{ $product->description }}
                        </p>
                    </div>

                    {{-- Technical Details --}}
                    <div class="grid grid-cols-2 gap-8 py-8 border-y border-white/[0.05]">
                        <div>
                            <span class="text-cream/15 text-[0.625rem] font-bold uppercase tracking-widest mb-2 block">Origin Region</span>
                            <span class="text-cream font-bold text-sm tracking-wide">{{ $product->origin }}</span>
                        </div>
                        <div>
                            <span class="text-cream/15 text-[0.625rem] font-bold uppercase tracking-widest mb-2 block">Roast Level</span>
                            <span class="text-mocca font-bold text-sm tracking-wide uppercase">{{ $product->roast_level }}</span>
                        </div>
                        <div>
                            <span class="text-cream/15 text-[0.625rem] font-bold uppercase tracking-widest mb-2 block">Net Weight</span>
                            <span class="text-cream font-bold text-sm tracking-wide">{{ $product->weight_grams }} Grams</span>
                        </div>
                        <div>
                            <span class="text-cream/15 text-[0.625rem] font-bold uppercase tracking-widest mb-2 block">Availability</span>
                            <span class="text-green-400 font-bold text-sm tracking-wide">{{ $product->stock }} Units in Stock</span>
                        </div>
                    </div>

                    {{-- Add to Cart Action --}}
                    <div class="flex items-center gap-4 pt-4">
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-1 flex gap-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <div class="flex items-center bg-white/[0.03] border border-white/10 rounded-2xl p-1 shrink-0 h-16">
                                <button type="button" onclick="this.nextElementSibling.stepDown()" class="w-12 h-full flex items-center justify-center text-cream/20 hover:text-mocca transition-colors">
                                     <span class="text-xl">−</span>
                                </button>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                       class="w-14 bg-transparent border-0 text-center text-cream font-bold text-lg focus:ring-0">
                                <button type="button" onclick="this.previousElementSibling.stepUp()" class="w-12 h-full flex items-center justify-center text-cream/20 hover:text-mocca transition-colors">
                                     <span class="text-xl">+</span>
                                </button>
                            </div>

                            <button type="submit" class="h-16 flex-1 bg-mocca text-dark font-bold rounded-2xl flex items-center justify-center gap-3 hover:bg-mocca-dark transition-all duration-300 shadow-xl shadow-mocca/10 group">
                                <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                Add to Cart
                            </button>
                        </form>
                    </div>

                    {{-- Share & Support --}}
                    <div class="flex items-center gap-6 pt-4 text-[0.625rem] font-bold uppercase tracking-widest text-cream/15">
                        <span class="flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg> Secure Checkout</span>
                        <span class="flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg> Shipping Worldwide</span>
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
<section class="py-24 border-t border-white/[0.03]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h2 class="font-display text-3xl text-cream font-bold">You Might <span class="text-mocca italic">Also Like</span></h2>
                <div class="w-12 h-1 bg-mocca mt-4"></div>
            </div>
            <a href="{{ route('shop') }}" class="text-[0.625rem] font-bold uppercase tracking-widest text-cream/20 hover:text-mocca transition-colors">See All Collection →</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($related as $rel)
            <a href="{{ route('shop.show', $rel) }}" class="group reveal" style="transition-delay: {{ $loop->index * 0.1 }}s">
                <div class="card overflow-hidden !rounded-[2rem] aspect-[4/5] flex flex-col">
                    <div class="relative flex-1 bg-white/[0.02] flex items-center justify-center p-6 group-hover:bg-mocca/[0.03] transition-colors duration-500 overflow-hidden">
                        @if($rel->image)
                            <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}" class="max-w-[70%] max-h-full object-contain transform group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="text-5xl opacity-5 group-hover:scale-110 transition-transform duration-700">☕</div>
                        @endif
                        <span class="absolute bottom-4 left-4 bg-dark/80 backdrop-blur-md px-3 py-1 rounded-lg text-[0.625rem] font-bold uppercase tracking-widest text-cream/40">{{ $rel->roast_level }}</span>
                    </div>
                    <div class="p-6 bg-white/[0.01]">
                        <h4 class="text-cream text-base font-bold mb-1 truncate group-hover:text-mocca transition-colors">{{ $rel->name }}</h4>
                        <div class="text-mocca text-sm font-bold">{{ $rel->formatted_price }}</div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
