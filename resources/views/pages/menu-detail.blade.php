@extends('layouts.app')
@section('title', $menu->name)

@section('content')

{{-- ═══════════════════════════════════════
     HEADER / BREADCRUMB
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
                        <a href="{{ route('menu') }}" class="text-[0.625rem] font-bold uppercase tracking-[0.2em] text-cream/20 hover:text-mocca transition-colors">Menu</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <span class="mx-2 text-mocca/30">/</span>
                        <span class="text-[0.625rem] font-bold uppercase tracking-[0.2em] text-mocca">{{ $menu->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</section>

{{-- ═══════════════════════════════════════
     MAIN DETAIL
     ═══════════════════════════════════════ --}}
<section class="pb-24 reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-20">
            
            {{-- Image Side --}}
            <div class="lg:col-span-6">
                <div class="group relative bg-white/[0.02] border border-white/[0.05] rounded-[2.5rem] overflow-hidden aspect-square flex items-center justify-center p-8 md:p-12">
                    {{-- Interactive background --}}
                    <div class="absolute inset-0 bg-gradient-to-br from-mocca/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                    
                    @if($menu->image)
                        <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" 
                             class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-1000 ease-out">
                    @else
                        <div class="text-8xl opacity-10">☕</div>
                    @endif

                    {{-- Badge --}}
                    <div class="absolute top-8 left-8">
                        <span class="bg-dark/80 backdrop-blur-md border border-white/10 px-4 py-2 rounded-xl text-[0.625rem] font-bold uppercase tracking-widest text-mocca">
                            {{ $menu->category }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Info Side --}}
            <div class="lg:col-span-6 flex flex-col justify-center">
                <div class="space-y-8">
                    <div>
                        <div class="inline-flex items-center gap-2 mb-4">
                            <span class="text-mocca text-[0.625rem] font-bold tracking-[0.2em] uppercase">{{ $menu->category }} · Specialty Menu</span>
                        </div>
                        <h1 class="font-display text-5xl md:text-6xl text-cream font-bold leading-tight mb-6">
                            {{ $menu->name }}
                        </h1>
                        <div class="text-mocca font-bold text-3xl mb-8">
                            {{ $menu->formatted_price }}
                        </div>
                        <p class="text-cream/40 text-sm leading-relaxed max-w-lg">
                            {{ $menu->description ?: 'Nikmati kelezatan menu spesial kami yang diracik khusus untuk memberikan pengalaman rasa terbaik.' }}
                        </p>
                    </div>

                    {{-- Action --}}
                    <div class="flex items-center gap-4 pt-4">
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-1 flex flex-col sm:flex-row gap-4">
                            @csrf
                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                            
                            <div class="flex items-center bg-white/[0.03] border border-white/10 rounded-2xl p-1 shrink-0 h-16">
                                <button type="button" onclick="this.nextElementSibling.stepDown()" class="w-12 h-full flex items-center justify-center text-cream/20 hover:text-mocca transition-colors">
                                     <span class="text-xl">−</span>
                                </button>
                                <input type="number" name="quantity" value="1" min="1" max="99" 
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

                    <div class="flex items-center gap-6 pt-4 text-[0.625rem] font-bold uppercase tracking-widest text-cream/15">
                        <span class="flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg> Premium Quality</span>
                        <span class="flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/></svg> Freshly Served</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
