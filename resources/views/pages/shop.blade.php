@extends('layouts.app')
@section('title', 'Shop Beans')
@section('meta_description', 'Beli biji kopi premium pilihan dari berbagai daerah di Indonesia, langsung ke rumah Anda.')

@section('content')

{{-- ═══════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[50vh] flex items-center bg-dark">
    {{-- Background layers --}}
    <div class="absolute inset-0 opacity-20"
         style="background-image: radial-gradient(circle at 10% 90%, #6B4226 0%, transparent 40%), radial-gradient(circle at 90% 10%, #C9A87C 0%, transparent 40%)">
    </div>
    <div class="absolute right-0 bottom-0 w-[500px] h-[500px] bg-mocca/[0.05] rounded-full blur-[120px] animate-pulse-glow"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <div class="inline-flex items-center gap-3 mb-6 animate-fade-in-up">
            <span class="w-10 h-px bg-mocca/40"></span>
            <span class="text-mocca text-xs font-bold tracking-[0.3em] uppercase">Premium Roast</span>
            <span class="w-10 h-px bg-mocca/40"></span>
        </div>
        <h1 class="font-display text-5xl md:text-7xl text-cream font-bold leading-tight mb-6 animate-fade-in-up" style="animation-delay: 0.1s">
            Shop <span class="text-mocca italic">Beans.</span>
        </h1>
        <p class="text-cream/50 text-base md:text-lg leading-relaxed max-w-2xl mx-auto animate-fade-in-up" style="animation-delay: 0.2s">
            Bawa pulang cita rasa Nusantara. Biji kopi pilihan yang dipanggang dengan presisi untuk menghadirkan pengalaman menyeduh terbaik di rumah Anda.
        </p>
    </div>
</section>

{{-- ═══════════════════════════════════════
     SHOP CONTENT
     ═══════════════════════════════════════ --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 pb-32">

    {{-- Section Header --}}
    <div class="mb-16 reveal">
        <p class="section-subtitle">Filo Roastery Selection</p>
        <h2 class="section-title">Koleksi Biji Kopi</h2>
        <p class="text-cream/40 mt-6 max-w-2xl text-lg leading-relaxed">Pilihan biji kopi terbaik dari berbagai pelosok Nusantara, diproses dengan ketelitian tinggi untuk memastikan kesegaran dan karakter rasa yang optimal.</p>
    </div>

    {{-- Filters & Sort --}}
    <div class="flex flex-col lg:flex-row gap-8 mb-20 items-center justify-between reveal">
        <div class="flex flex-wrap gap-3 justify-center">
            <a href="{{ route('shop') }}"
               class="px-6 py-3 rounded-2xl text-[0.7rem] font-bold uppercase tracking-[0.15em] transition-all duration-500 {{ $roast === 'all'
                   ? 'bg-mocca text-dark shadow-xl shadow-mocca/20'
                   : 'bg-warm border border-white/5 text-cream/40 hover:text-mocca hover:border-mocca/30' }}">
                Semua Roast
            </a>
            @foreach($roasts as $r)
            <a href="{{ route('shop', ['roast' => $r]) }}"
               class="px-6 py-3 rounded-2xl text-[0.7rem] font-bold uppercase tracking-[0.15em] transition-all duration-500 {{ $roast === $r
                   ? 'bg-mocca text-dark shadow-xl shadow-mocca/20'
                   : 'bg-warm border border-white/5 text-cream/40 hover:text-mocca hover:border-mocca/30' }}">
                {{ $r }}
            </a>
            @endforeach
        </div>

        <div class="relative min-w-[220px] group">
            <select onchange="window.location='{{ route('shop') }}?sort='+this.value+'&roast={{ $roast }}'"
                    class="input-field !py-3.5 pr-12 text-[0.7rem] font-bold uppercase tracking-widest appearance-none cursor-pointer">
                <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Terbaru</option>
                <option value="price_asc" {{ $sort === 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                <option value="price_desc" {{ $sort === 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
            </select>
            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-mocca/40 group-hover:text-mocca transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </div>
        </div>
    </div>

    @if($products->isEmpty())
    <div class="text-center py-32 reveal">
        <div class="w-24 h-24 bg-warm border border-white/5 rounded-[2.5rem] flex items-center justify-center mx-auto mb-10 text-cream/10 shadow-2xl">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
        </div>
        <h3 class="font-display text-3xl text-cream font-bold mb-4">Segera Hadir</h3>
        <p class="text-cream/30 text-lg max-w-md mx-auto leading-relaxed">Kami sedang mengkurasi biji kopi terbaik untuk Anda. Nantikan peluncuran koleksi terbaru kami.</p>
        <a href="{{ route('shop') }}" class="inline-flex items-center gap-4 text-mocca text-sm font-bold uppercase tracking-[0.2em] mt-12 hover:text-mocca-light transition-colors group">
            <svg class="w-5 h-5 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Koleksi
        </a>
    </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 mb-20">
        @foreach($products as $i => $product)
        <div class="card group reveal" style="transition-delay: {{ ($i % 12) * 0.05 }}s">
            
            {{-- Image & Badges --}}
            <a href="{{ route('shop.show', $product) }}" class="block relative aspect-square bg-warm overflow-hidden">
                @if($product->image)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                         class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                @else
                    <div class="w-full h-full flex items-center justify-center opacity-5 text-7xl">☕</div>
                @endif

                {{-- Status Badges --}}
                <div class="absolute top-5 left-5 flex flex-col gap-3">
                    <span class="badge bg-dark/60 backdrop-blur-md text-mocca border-white/5 uppercase tracking-widest text-[0.6rem]">
                        {{ $product->roast_level }}
                    </span>
                    @if(!$product->isInStock())
                    <span class="badge bg-red-900/40 backdrop-blur-md text-red-400 border-red-500/20 uppercase tracking-widest text-[0.6rem]">
                        Out of Stock
                    </span>
                    @endif
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
                    
                    @if($product->isInStock())
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
                        <a href="{{ route('login') }}" class="btn-outline !py-3 !px-6 !text-[0.65rem] !rounded-xl">
                            Login To Buy
                        </a>
                        @endauth
                    @else
                    <span class="text-cream/15 text-[0.65rem] font-bold uppercase tracking-widest bg-white/[0.03] px-5 py-3 rounded-xl border border-white/[0.05]">
                        Sold Out
                    </span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="reveal mt-12 flex justify-center">
        {{ $products->links() }}
    </div>
    @endif
</div>

{{-- ═══════════════════════════════════════
     7. SHOP FEATURES (ABOUT VALUES STYLE)
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden bg-dark-deep py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-20 reveal">
            <p class="section-subtitle">Why Filo Roastery?</p>
            <h2 class="section-title">Kualitas Yang Kami Jaga</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-10">
            @php
            $features = [
                [
                    'icon' => '✨',
                    'title' => 'Kualitas Selektif',
                    'desc' => 'Hanya biji kopi grade spesialti terbaik yang kami pilih langsung dari petani terpercaya untuk Anda.',
                ],
                [
                    'icon' => '🔥',
                    'title' => 'Freshly Roasted',
                    'desc' => 'Setiap biji dipanggang dalam batch kecil secara rutin oleh roaster ahli kami untuk menjaga kesegaran aroma.',
                ],
                [
                    'icon' => '📦',
                    'title' => 'Secure Delivery',
                    'desc' => 'Pengemasan khusus dengan one-way valve untuk menjamin kualitas rasa tetap optimal hingga sampai di rumah Anda.',
                ],
            ];
            @endphp

            @foreach($features as $i => $feature)
            <div class="card p-10 group reveal" style="transition-delay: {{ $i * 0.1 }}s">
                <div class="w-16 h-16 bg-dark rounded-2xl flex items-center justify-center text-4xl mb-8 group-hover:scale-110 group-hover:bg-mocca group-hover:text-dark transition-all duration-500 shadow-xl">
                    {{ $feature['icon'] }}
                </div>
                <h3 class="font-display text-2xl text-cream font-bold mb-4 group-hover:text-mocca transition-colors duration-500">{{ $feature['title'] }}</h3>
                <p class="text-cream/30 text-base leading-relaxed">{{ $feature['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
