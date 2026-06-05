@extends('layouts.app')
@section('title', $menu->name . ' | Menu Spesial Filo Coffee')
@section('meta_description', $menu->description ?: 'Nikmati ' . $menu->name . ', menu racikan barista premium kami dengan bahan pilihan berkualitas tinggi.')

@section('content')

{{-- ═══════════════════════════════════════
     HEADER / BREADCRUMB
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[10vh] flex items-center bg-beige-50">
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
                        <a href="{{ route('menu') }}" class="text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-700/60 hover:text-olive-900 transition-colors">Menu</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <span class="mx-2 text-olive-350">/</span>
                        <span class="text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-800">{{ $menu->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</section>

{{-- ═══════════════════════════════════════
     MAIN DETAIL SECTION
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[92vh] flex items-center bg-beige-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-20 items-center">
            
            {{-- Image Column --}}
            <div class="lg:col-span-6">
                <div class="group relative bg-white border border-olive-900/5 rounded-[2.5rem] overflow-hidden aspect-square flex items-center justify-center p-6 md:p-8 shadow-xl shadow-olive-900/5">
                    {{-- Soft premium gradient overlay on hover --}}
                    <div class="absolute inset-0 bg-gradient-to-br from-olive-100/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                    
                    @if($menu->image)
                        <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" 
                             class="w-full h-full object-cover rounded-[2rem] transform group-hover:scale-103 transition-transform duration-1000 ease-out">
                    @else
                        <div class="text-9xl opacity-20 transform group-hover:scale-110 transition-transform duration-700">☕</div>
                    @endif

                    {{-- Category Tag Badge --}}
                    <div class="absolute top-8 left-8">
                        <span class="bg-olive-850 text-beige-50 border border-olive-700/20 px-5 py-2.5 rounded-2xl text-[0.65rem] font-bold uppercase tracking-widest shadow-lg">
                            {{ $menu->category }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Info Content Column --}}
            <div class="lg:col-span-6 flex flex-col justify-center">
                <div class="space-y-8">
                    <div>
                        <div class="inline-flex items-center gap-2 mb-4">
                            <span class="w-4 h-[1px] bg-olive-500"></span>
                            <span class="text-olive-700 text-xs font-bold tracking-[0.2em] uppercase">{{ $menu->category }} · Specialty Menu</span>
                        </div>
                        <h1 class="font-display text-4xl md:text-5xl lg:text-6xl text-olive-900 font-bold leading-[1.1] mb-6">
                            {{ $menu->name }}
                        </h1>
                        <div class="text-olive-700 font-display font-semibold text-3xl mb-8">
                            {{ $menu->formatted_price }}
                        </div>
                        <p class="text-olive-800/70 text-base leading-relaxed max-w-lg">
                            {{ $menu->description ?: 'Nikmati kelezatan menu spesial kami yang diracik khusus dengan dedikasi tinggi oleh barista ahli untuk memberikan pengalaman cita rasa kopi modern yang sesungguhnya.' }}
                        </p>
                    </div>

                    {{-- Actions block --}}
                    <div class="flex items-center gap-4 pt-4 border-t border-olive-900/10 w-full">
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-1 flex flex-col gap-4 w-full">
                            @csrf
                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                            
                            <div class="flex flex-col sm:flex-row gap-4 w-full">
                                {{-- Interactive Quantity Picker --}}
                                <div class="flex items-center bg-white border border-olive-900/10 rounded-2xl p-1.5 shrink-0 h-16 shadow-sm justify-between sm:justify-start">
                                    <button type="button" onclick="this.nextElementSibling.stepDown()" class="w-12 h-full flex items-center justify-center text-olive-500 hover:text-olive-900 transition-colors">
                                         <span class="text-2xl font-medium">−</span>
                                    </button>
                                    <input type="number" name="quantity" value="1" min="1" max="99" 
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

                    {{-- Features strip --}}
                    <div class="flex flex-wrap items-center gap-6 pt-4 text-[0.65rem] font-bold uppercase tracking-widest text-olive-700/50">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-olive-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Kualitas Premium
                        </span>
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-olive-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Disajikan Segar
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
