@extends('layouts.app')
@section('title', 'Daftar Menu | Filo Coffee')
@section('meta_description', 'Eksplor menu lengkap Filo Specialty Coffee — dari racikan espresso klasik, single origin pour-over, mocktail segar, hingga artisan dessert.')

@section('content')

{{-- ═══════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[50vh] flex items-center bg-beige-50">
    {{-- Decorative Background Layers --}}
    <div class="absolute inset-0 opacity-50 pointer-events-none"
         style="background-image: radial-gradient(circle at 15% 15%, #CFDAD0 0%, transparent 40%), radial-gradient(circle at 85% 85%, #E6DCCF 0%, transparent 40%)">
    </div>
    <div class="absolute right-[-5%] top-1/4 w-[500px] h-[500px] bg-olive-200/30 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute left-[-5%] bottom-0 w-80 h-80 bg-beige-200/50 rounded-full blur-[100px] pointer-events-none"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 z-10">
        <div class="max-w-3xl animate-fade-in-up">
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-8 h-[1.5px] bg-olive-500"></span>
                <span class="text-olive-700 text-xs font-bold tracking-[0.25em] uppercase">Beyond The Cup</span>
            </div>
            <h1 class="font-display text-5xl md:text-7xl text-olive-900 font-bold leading-[1.05] mb-8">
                Menu
                <span class="text-beige-600 italic font-semibold">Terbaik.</span>
            </h1>
            <p class="text-olive-800/70 text-lg md:text-xl leading-relaxed mb-12 max-w-2xl">
                Setiap cangkir kopi dan hidangan pencuci mulut dibuat presisi menggunakan bahan-bahan bersertifikasi premium untuk menghadirkan ritual kuliner terbaik bagi Anda.
            </p>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     CONTENT
     ═══════════════════════════════════════ --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 pb-32">
    {{-- Filters & Sort --}}
    <div class="flex flex-col lg:flex-row gap-8 mb-20 items-center justify-between reveal">
        {{-- Category Chips --}}
        <div class="flex flex-wrap gap-2.5 justify-center">
            <a href="{{ route('menu') }}"
               class="px-6 py-3 rounded-2xl text-[0.65rem] font-bold uppercase tracking-wider transition-all duration-300 {{ $category === 'all'
                   ? 'bg-olive-800 text-beige-50'
                   : 'bg-white border border-beige-200 text-olive-800 hover:text-olive-950 hover:bg-beige-250' }}">
                Semua Menu
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('menu', ['category' => $cat]) }}"
               class="px-6 py-3 rounded-2xl text-[0.65rem] font-bold uppercase tracking-wider transition-all duration-300 {{ $category === $cat
                   ? 'bg-olive-800 text-beige-50'
                   : 'bg-white border border-beige-200 text-olive-800 hover:text-olive-950 hover:bg-beige-250' }}">
                {{ $cat }}
            </a>
            @endforeach
        </div>

        {{-- Dropdown Sorting --}}
        <div class="relative min-w-[220px] group">
            <select onchange="window.location='{{ route('menu') }}?sort='+this.value+'&category={{ $category }}'"
                    class="input-field !py-3.5 pr-12 text-[0.65rem] font-bold uppercase tracking-widest appearance-none cursor-pointer">
                <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Default Sorting</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
            </select>
            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-olive-700/40 group-hover:text-olive-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </div>
        </div>
    </div>

    {{-- Menu Grid --}}
    @if($menus->isEmpty())
    <div class="text-center py-32 reveal">
        <div class="w-20 h-20 bg-beige-100 border border-beige-200 rounded-[2rem] flex items-center justify-center mx-auto mb-8 text-olive-300 shadow-lg">
            ☕
        </div>
        <h3 class="font-display text-3xl text-olive-900 font-bold mb-3">Belum Ada Menu</h3>
        <p class="text-olive-800/40 text-sm max-w-sm mx-auto leading-relaxed">Maaf, kami belum memiliki pilihan menu untuk kategori ini. Silakan cek kategori lainnya.</p>
        <a href="{{ route('menu') }}" class="inline-flex items-center gap-2 text-olive-800 text-xs font-bold uppercase tracking-widest mt-8 hover:text-olive-950 transition-colors group/btn">
            <svg class="w-4 h-4 transition-transform duration-300 group-hover/btn:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke Semua Menu</span>
        </a>
    </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($menus as $i => $menu)
        <div class="relative bg-white border border-olive-800/20 rounded-[2rem] p-6 hover:border-olive-300 hover:shadow-xl hover:shadow-olive-900/8 transition-all duration-200 group reveal" style="transition-delay: {{ ($i % 9) * 0.07 }}s">
            
            {{-- Stretched Link to Detail Page --}}
            <a href="{{ route('menu.show', $menu) }}" class="absolute inset-0 rounded-[2.5rem] z-10" aria-label="Lihat detail {{ $menu->name }}"></a>
            
            {{-- Top Row --}}
            <div class="flex items-center justify-between mb-5 relative z-30">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-beige-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                    </svg>
                    <span class="text-olive-800/40 text-[0.65rem] font-bold uppercase tracking-widest">{{ $menu->category }}</span>
                </div>
                
                {{-- Cart Icon Button: functional add-to-cart --}}
                @auth
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" title="Tambah ke Keranjang"
                            class="w-9 h-9 rounded-full bg-olive-500 hover:bg-olive-800 text-beige-50 flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm active:scale-95">
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
            <h3 class="text-center font-display text-2xl font-bold text-olive-900 mb-6 leading-snug px-4 relative z-20">
                {{ $menu->name }}
            </h3>

            {{-- Middle Image with Price Badge --}}
            <div class="relative aspect-[4/3] rounded-[2rem] overflow-hidden bg-olive-950/40 border border-white/5 shadow-inner z-20">
                @if($menu->image)
                    <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="w-full h-full object-cover transform duration-500 group-hover:scale-105">
                @else
                    <div class="w-full h-full flex items-center justify-center opacity-20 text-6xl bg-olive-950/20">☕</div>
                @endif

                {{-- Price Badge (visual only — clicking card navigates to detail) --}}
                <div class="absolute bottom-5 left-1/2 -translate-x-1/2 bg-black/65 backdrop-blur-md px-5 py-2.5 rounded-full border border-white/10 flex items-center gap-2 shadow-md text-xs text-beige-200 whitespace-nowrap font-sans pointer-events-none">
                    <span class="font-semibold">{{ $menu->formatted_price }}</span>
                </div>
            </div>

            {{-- Bottom Description --}}
            <p class="text-center text-olive-700/80 text-xs leading-relaxed max-w-[280px] mx-auto mt-6 px-2 line-clamp-2 relative z-20">
                {{ $menu->description ?: 'Nikmati hidangan spesial racikan barista pilihan Filo Coffee yang disajikan segar untuk menyempurnakan hari Anda.' }}
            </p>
        </div>
        @endforeach
    </div>
    @endif

</div>

{{-- ═══════════════════════════════════════
     BOTTOM CTA BAND
     ═══════════════════════════════════════ --}}
<section class="relative py-28 overflow-hidden bg-olive-800 text-beige-50 reveal">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(250,248,245,0.05)_0%,transparent_70%)] pointer-events-none"></div>
    
    <div class="relative max-w-4xl mx-auto px-4 text-center space-y-8">
        <div class="inline-flex items-center gap-3 mb-2">
            <span class="w-8 h-px bg-beige-300"></span>
            <span class="text-beige-300 text-xs font-bold uppercase tracking-[0.2em]">Private Experience</span>
            <span class="w-8 h-px bg-beige-300"></span>
        </div>
        <h2 class="font-display text-4xl md:text-6xl font-bold leading-tight">Miliki Meja Favorit Anda Hari Ini.</h2>
        <p class="text-beige-100/70 text-base md:text-lg max-w-2xl mx-auto">Hindari antrean padat dan pastikan produktivitas serta santai berkualitas Anda berjalan sempurna dengan reservasi meja atau VIP Private Room terlebih dahulu.</p>
        
        <div class="flex flex-wrap justify-center items-center gap-4 pt-4">
            <a href="{{ route('reservation.index') }}" class="bg-beige-100 text-olive-900 hover:bg-beige-200 px-10 py-4 rounded-xl font-bold transition-all shadow-xl shadow-black/10 flex items-center gap-2 group/btn">
                <span>Reservasi Sekarang</span>
                <svg class="w-4 h-4 transition-transform duration-300 group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
            <a href="https://wa.me/6281234567890" target="_blank" class="border border-beige-200 text-beige-50 hover:bg-beige-100 hover:text-olive-900 px-10 py-4 rounded-xl font-bold transition-all">
                Hubungi WhatsApp
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Animation reveal on scroll
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
