@extends('layouts.app')
@section('title', $menu->name . ' | Filo Coffee')
@section('meta_description', $menu->description ?: 'Nikmati ' . $menu->name . ', menu racikan barista premium kami dengan bahan pilihan berkualitas tinggi.')

@section('content')


{{-- ═══════════════════════════════════════
     MAIN DETAIL SECTION
     ═══════════════════════════════════════ --}}
<section class="pt-24 pb-24 bg-beige-50 relative overflow-hidden reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-12 gap-8 lg:gap-16 items-center">
            
            {{-- Image Column (Full-bleed card) --}}
            <div class="lg:col-span-6">
                <div class="group relative bg-white border border-olive-900/5 rounded-[2.5rem] overflow-hidden aspect-square flex items-center justify-center shadow-xl shadow-olive-900/5">
                    {{-- Soft premium gradient overlay on hover --}}
                    <div class="absolute inset-0 bg-gradient-to-br group-hover:opacity-100 transition-opacity duration-1000 z-10"></div>
                    
                    @if($menu->image)
                        <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" 
                             class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-1000 ease-out">
                    @else
                        <div class="text-9xl opacity-20 transform group-hover:scale-110 transition-transform duration-700">☕</div>
                    @endif

                    {{-- Category Tag Badge --}}
                    <div class="absolute top-6 left-6 z-20">
                        <span class="bg-olive-800/95 backdrop-blur-md text-beige-50 border border-white/10 px-5 py-2.5 rounded-2xl text-[0.65rem] font-bold uppercase tracking-widest shadow-md">
                            {{ $menu->category }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Info Content Column --}}
            <div class="lg:col-span-6 flex flex-col justify-center py-2">
                <div class="space-y-6">
                    <div>
                        <div class="inline-flex items-center gap-2 mb-3">
                            <span class="w-4 h-[1px] bg-olive-500"></span>
                            <span class="text-olive-600 text-[10px] font-bold tracking-[0.25em] uppercase">{{ $menu->category }} · Specialty Menu</span>
                        </div>
                        <h1 class="font-display text-4xl md:text-5xl lg:text-6xl text-olive-900 font-bold leading-[1.1] mb-4">
                            {{ $menu->name }}
                        </h1>
                        <div class="text-mocca-dark font-display font-semibold text-3xl mb-6">
                            {{ $menu->formatted_price }}
                        </div>
                        <p class="text-olive-800/70 text-sm leading-relaxed max-w-xl">
                            {{ $menu->description ?: 'Nikmati kelezatan menu spesial kami yang diracik khusus dengan dedikasi tinggi oleh barista ahli untuk memberikan pengalaman cita rasa kopi modern yang sesungguhnya.' }}
                        </p>
                    </div>

                    {{-- Actions block --}}
                    <div class="flex items-center gap-4 pt-6 border-t border-olive-900/10 w-full">
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-1 flex flex-col gap-4 w-full">
                            @csrf
                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                            
                            <div class="flex flex-col sm:flex-row gap-4 w-full">
                                {{-- Interactive Quantity Picker --}}
                                <div class="flex items-center bg-white border border-olive-900/10 rounded-2xl p-1.5 shrink-0 h-14 shadow-sm justify-between sm:justify-start ring-1 ring-olive-900/5">
                                    <button type="button" onclick="this.nextElementSibling.stepDown()" class="w-10 h-full flex items-center justify-center text-olive-500 hover:text-olive-900 transition-colors focus:outline-none">
                                         <span class="text-xl font-medium">−</span>
                                    </button>
                                    <input type="number" name="quantity" value="1" min="1" max="99" 
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
                                    <button type="submit" name="redirect_to" value="checkout" class="h-14 flex-1 bg-olive-800 text-beige-50 hover:bg-olive-900 font-bold rounded-2xl flex items-center justify-center gap-2 transition-all duration-300 shadow-lg shadow-olive-900/10 group text-xs sm:text-sm active:scale-98">
                                        <span>Beli Langsung</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- Features strip --}}
                    <div class="flex flex-wrap items-center gap-6 pt-3 text-[9px] font-bold uppercase tracking-widest text-olive-750/40 border-t border-olive-900/5">
                        <span class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-base text-olive-500">workspace_premium</span>
                            Kualitas Premium
                        </span>
                        <span class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-base text-olive-500">coffee</span>
                            Disajikan Segar
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
