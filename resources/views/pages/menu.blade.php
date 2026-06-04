@extends('layouts.app')
@section('title', 'Menu Kami')
@section('meta_description', 'Jelajahi menu lengkap Filo Coffee — dari kopi pilihan Nusantara, non-coffee, makanan, hingga dessert.')

@section('content')

{{-- ═══════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[50vh] flex items-center bg-dark">
    {{-- Background layers --}}
    <div class="absolute inset-0 opacity-20"
         style="background-image: radial-gradient(circle at 10% 90%, #6B4226 0%, transparent 40%), radial-gradient(circle at 90% 10%, #C9A87C 0%, transparent 40%)">
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <div class="inline-flex items-center gap-3 mb-6 animate-fade-in-up">
            <span class="w-10 h-px bg-mocca/40"></span>
            <span class="text-mocca text-xs font-bold tracking-[0.3em] uppercase">Premium Selection</span>
            <span class="w-10 h-px bg-mocca/40"></span>
        </div>
        <h1 class="font-display text-5xl md:text-7xl text-cream font-bold leading-tight mb-6 animate-fade-in-up" style="animation-delay: 0.1s">
            Menu <span class="text-mocca italic">Terbaik.</span>
        </h1>
        <p class="text-cream/50 text-base md:text-lg leading-relaxed max-w-2xl mx-auto animate-fade-in-up" style="animation-delay: 0.2s">
            Setiap racikan dibuat dengan presisi oleh barista kami menggunakan bahan-bahan pilihan untuk menghadirkan cita rasa autentik Nusantara.
        </p>
    </div>
</section>

{{-- ═══════════════════════════════════════
     CONTENT
     ═══════════════════════════════════════ --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 pb-32">

    {{-- Section Header --}}
    <div class="mb-16 reveal">
        <p class="section-subtitle">The Complete Collection</p>
        <h2 class="section-title">Semua Menu Kami</h2>
        <p class="text-cream/40 mt-6 max-w-2xl text-lg leading-relaxed">Dari racikan espresso klasik hingga inovasi minuman fusion Nusantara, temukan setiap mahakarya barista kami di sini.</p>
    </div>

    {{-- Filters & Sort --}}
    <div class="flex flex-col lg:flex-row gap-8 mb-20 items-center justify-between reveal">
        <div class="flex flex-wrap gap-3 justify-center">
            <a href="{{ route('menu') }}"
               class="px-6 py-3 rounded-2xl text-[0.7rem] font-bold uppercase tracking-[0.15em] transition-all duration-500 {{ $category === 'all'
                   ? 'bg-mocca text-dark shadow-xl shadow-mocca/20'
                   : 'bg-warm border border-white/5 text-cream/40 hover:text-mocca hover:border-mocca/30' }}">
                Semua Menu
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('menu', ['category' => $cat]) }}"
               class="px-6 py-3 rounded-2xl text-[0.7rem] font-bold uppercase tracking-[0.15em] transition-all duration-500 {{ $category === $cat
                   ? 'bg-mocca text-dark shadow-xl shadow-mocca/20'
                   : 'bg-warm border border-white/5 text-cream/40 hover:text-mocca hover:border-mocca/30' }}">
                {{ $cat }}
            </a>
            @endforeach
        </div>

        <div class="relative min-w-[220px] group">
            <select onchange="window.location='{{ route('menu') }}?sort='+this.value+'&category={{ $category }}'"
                    class="input-field !py-3.5 pr-12 text-[0.7rem] font-bold uppercase tracking-widest appearance-none cursor-pointer">
                <option value="default">Default Sorting</option>
                <option value="price_asc">Harga Terendah</option>
                <option value="price_desc">Harga Tertinggi</option>
            </select>
            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-mocca/40 group-hover:text-mocca transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </div>
        </div>
    </div>

    {{-- Active category label (if needed, but already in filter) --}}
    @if($category !== 'all' && false) {{-- Hidden as it's redundant with the new filter style --}}
    <div class="flex items-center gap-4 mb-10 reveal">
        <span class="text-cream/20 text-xs font-bold uppercase tracking-widest">Kategori:</span>
        <span class="inline-flex items-center gap-2 text-mocca text-xs font-bold bg-mocca/[0.08] border border-mocca/20 px-4 py-2 rounded-xl">
            {{ $category }}
            <a href="{{ route('menu') }}" class="text-mocca/40 hover:text-mocca transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </a>
        </span>
        <span class="text-cream/10 text-xs font-bold uppercase tracking-tighter">{{ $menus->count() }} Pilihan</span>
    </div>
    @endif

    {{-- Menu Grid --}}
    @if($menus->isEmpty())
    <div class="text-center py-32 reveal">
        <div class="w-24 h-24 bg-warm border border-white/5 rounded-[2.5rem] flex items-center justify-center mx-auto mb-10 text-cream/10 shadow-2xl">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        <h3 class="font-display text-3xl text-cream font-bold mb-4">Belum Ada Menu</h3>
        <p class="text-cream/30 text-lg max-w-md mx-auto leading-relaxed">Maaf, kami belum memiliki pilihan untuk kategori ini. Silakan cek kategori lainnya.</p>
        <a href="{{ route('menu') }}" class="inline-flex items-center gap-4 text-mocca text-sm font-bold uppercase tracking-[0.2em] mt-12 hover:text-mocca-light transition-colors group">
            <svg class="w-5 h-5 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Semua Menu
        </a>
    </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
        @foreach($menus as $i => $menu)
        <div class="card group reveal" style="transition-delay: {{ ($i % 12) * 0.05 }}s">
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
    @endif

</div>

{{-- ═══════════════════════════════════════
     BOTTOM CTA BAND
     ═══════════════════════════════════════ --}}
{{-- ═══════════════════════════════════════
     BOTTOM CTA BAND (HOME STYLE)
     ═══════════════════════════════════════ --}}
<section class="relative py-24 overflow-hidden reveal">
    <div class="absolute inset-0 bg-mocca"></div>
    <div class="absolute inset-0 opacity-10 animate-shimmer" style="background-image: radial-gradient(circle at 50% 50%, #1a1815 0%, transparent 70%)"></div>
    
    {{-- Decorative patterns --}}
    <div class="absolute top-0 left-0 w-64 h-64 border border-dark/5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 border border-dark/5 rounded-full translate-x-1/3 translate-y-1/3"></div>

    <div class="relative max-w-5xl mx-auto px-4 text-center">
        <div class="inline-flex items-center gap-3 mb-6">
            <span class="w-8 h-px bg-dark/20"></span>
            <span class="text-dark/40 text-[0.65rem] font-bold uppercase tracking-[0.2em]">Private Experience</span>
            <span class="w-8 h-px bg-dark/20"></span>
        </div>
        <h2 class="font-display text-4xl md:text-6xl text-dark font-bold mb-8">Miliki Meja Favorit Anda Hari Ini.</h2>
        <p class="text-dark/60 text-lg md:text-xl mb-12 max-w-2xl mx-auto font-medium">Hindari antrean dan pastikan momen kopi Anda berjalan sempurna dengan reservasi meja terlebih dahulu.</p>
        
        <div class="flex flex-wrap justify-center items-center gap-6">
            <a href="{{ route('reservation.index') }}" class="bg-dark text-cream px-10 py-4 rounded-2xl font-bold hover:bg-dark-deep transition-all duration-300 hover:-translate-y-1 shadow-2xl shadow-dark/20 flex items-center gap-3 group">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>Reservasi Sekarang</span>
                <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="https://wa.me/6281234567890" target="_blank" class="bg-dark/5 text-dark border border-dark/10 px-10 py-4 rounded-2xl font-bold hover:bg-dark/10 transition-all duration-300 hover:-translate-y-1 flex items-center gap-3 group">
                <span>Chat WhatsApp</span>
                <svg class="w-5 h-5 transition-transform duration-500 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v14l4-4h3.5"/></svg>
            </a>
        </div>
    </div>
</section>

@endsection
