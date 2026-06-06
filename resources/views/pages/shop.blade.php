@extends('layouts.app')
@section('title', 'Koleksi Biji Kopi Sangrai Pilihan | Filo Roastery')
@section('meta_description', 'Bawa pulang ritual kopi terbaik Anda. Beli biji kopi arabika pilihan Nusantara segar hasil roasting presisi di Filo Specialty Coffee.')

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
                Bawa Pulang<br>
                <span class="text-beige-600 italic font-semibold">Ritual Kopi Anda.</span>
            </h1>
            <p class="text-olive-800/70 text-lg md:text-xl leading-relaxed mb-12 max-w-2xl">
                Bawa pulang esensi ritual rasa Nusantara. Biji kopi pilihan ber-skor cupping tinggi yang disangrai dengan presisi untuk menghadirkan pengalaman menyeduh terbaik di rumah Anda.
            </p>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     SHOP CONTENT
     ═══════════════════════════════════════ --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 pb-32">

    {{-- Section Header --}}
    <div class="mb-16 reveal">
        <span class="text-beige-600 text-xs font-bold uppercase tracking-[0.25em] block mb-2">Filo Roastery Selection</span>
        <h2 class="font-display text-3xl md:text-5xl text-olive-900 font-bold">Koleksi Biji Kopi Sangrai</h2>
        <p class="text-olive-850/60 mt-4 max-w-2xl text-base leading-relaxed">Pilihan biji kopi arabika terbaik dari berbagai pelosok sabang sampai merauke, di-roast presisi oleh *head roaster* kami demi mempertahankan profil rasa aslinya.</p>
    </div>

    {{-- Filters & Sort --}}
    <div class="flex flex-col lg:flex-row gap-8 mb-20 items-center justify-between reveal">
        {{-- Roast Level Chips --}}
        <div class="flex flex-wrap gap-2.5 justify-center">
            <a href="{{ route('shop') }}"
               class="px-6 py-3 rounded-2xl text-[0.65rem] font-bold uppercase tracking-wider transition-all duration-300 {{ $roast === 'all'
                   ? 'bg-olive-800 text-beige-50 shadow-md shadow-olive-900/10'
                   : 'bg-white border border-beige-200 text-olive-800 hover:text-olive-950 hover:bg-beige-250' }}">
                Semua Roast
            </a>
            @foreach($roasts as $r)
            <a href="{{ route('shop', ['roast' => $r]) }}"
               class="px-6 py-3 rounded-2xl text-[0.65rem] font-bold uppercase tracking-wider transition-all duration-300 {{ $roast === $r
                   ? 'bg-olive-800 text-beige-50 shadow-md shadow-olive-900/10'
                   : 'bg-white border border-beige-200 text-olive-800 hover:text-olive-950 hover:bg-beige-250' }}">
                {{ $r }}
            </a>
            @endforeach
        </div>

        {{-- Dropdown Sorting --}}
        <div class="relative min-w-[220px] group">
            <select onchange="window.location='{{ route('shop') }}?sort='+this.value+'&roast={{ $roast }}'"
                    class="input-field !py-3.5 pr-12 text-[0.65rem] font-bold uppercase tracking-widest appearance-none cursor-pointer">
                <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Terbaru</option>
                <option value="price_asc" {{ $sort === 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                <option value="price_desc" {{ $sort === 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
            </select>
            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-olive-700/40 group-hover:text-olive-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </div>
        </div>
    </div>

    @if($products->isEmpty())
    <div class="text-center py-32 reveal">
        <div class="w-20 h-20 bg-beige-100 border border-beige-200 rounded-[2rem] flex items-center justify-center mx-auto mb-8 text-olive-350 shadow-lg">
            📦
        </div>
        <h3 class="font-display text-3xl text-olive-900 font-bold mb-3">Segera Hadir</h3>
        <p class="text-olive-800/40 text-sm max-w-sm mx-auto leading-relaxed">Kami sedang mengkurasi buah ceri kopi terbaik untuk Anda. Silakan cek kategori sangrai lainnya.</p>
        <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 text-olive-800 text-xs font-bold uppercase tracking-widest mt-8 hover:text-olive-950 transition-colors group/btn">
            <svg class="w-4 h-4 transition-transform duration-300 group-hover/btn:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke Koleksi</span>
        </a>
    </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
        @foreach($products as $i => $product)
        <div class="relative bg-white border border-olive-800/20 rounded-[2rem] p-6 hover:border-olive-300 hover:shadow-xl hover:shadow-olive-900/8 transition-all duration-200 group reveal" style="transition-delay: {{ ($i % 9) * 0.07 }}s">
            
            {{-- Stretched Link to Detail Page --}}
            <a href="{{ route('shop.show', $product) }}" class="absolute inset-0 rounded-[2.5rem] z-10" aria-label="Lihat detail {{ $product->name }}"></a>

            {{-- Top Row --}}
            <div class="flex items-center justify-between mb-5 relative z-30">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-beige-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <span class="text-olive-800/40 text-[0.65rem] font-bold uppercase tracking-widest">{{ $product->origin }} · {{ $product->weight_grams }}G</span>
                </div>
                
                {{-- Action / Add to Cart --}}
                <div class="relative z-30">
                    @if($product->isInStock())
                        @auth
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" title="Tambah ke Keranjang"
                                    class="w-9 h-9 rounded-full bg-olive-500 hover:bg-olive-800 hover:text-beige-50 text-beige-50 flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm active:scale-95">
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
                    @else
                        <span class="px-2.5 py-1.5 rounded-full text-[0.55rem] font-bold tracking-widest uppercase bg-red-950/60 text-red-400 border border-red-900/30">
                            Habis
                        </span>
                    @endif
                </div>
            </div>

            {{-- Title Centered --}}
            <h3 class="text-center font-display text-2xl font-bold tracking-wide text-olive-900 mb-6 leading-snug px-4 relative z-20" title="{{ $product->name }}">
                {{ $product->name }}
            </h3>

            {{-- Middle Image with Price & Roast Badge --}}
            <div class="relative aspect-[4/3] rounded-[2rem] overflow-hidden bg-olive-950/40 border border-white/5 shadow-inner z-20">
                @if($product->image)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover transform duration-500 group-hover:scale-105">
                @else
                    <div class="w-full h-full flex items-center justify-center opacity-20 text-6xl bg-olive-950/20">🫘</div>
                @endif

                {{-- Status Badges --}}
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1 rounded-full text-[0.6rem] font-bold tracking-wider uppercase bg-black/60 text-beige-200 border border-white/10 backdrop-blur-sm">
                        {{ $product->roast_level }}
                    </span>
                </div>

                {{-- Price Badge --}}
                <div class="absolute bottom-5 left-1/2 -translate-x-1/2 bg-black/65 backdrop-blur-md px-5 py-2.5 rounded-full border border-white/10 flex items-center gap-2 shadow-md text-xs text-beige-200 whitespace-nowrap pointer-events-none">
                    <span class="font-semibold">{{ $product->formatted_price }}</span>
                </div>
            </div>

            {{-- Bottom Flavor Notes --}}
            <p class="text-center text-olive-700/40 text-xs leading-relaxed max-w-[280px] mx-auto mt-6 px-2 line-clamp-2 relative z-20">
                @if($product->flavor_notes)
                    Notes: {{ $product->flavor_notes }}
                @else
                    Nikmati biji kopi arabika pilihan Nusantara segar hasil roasting presisi yang disangrai khusus untuk menyempurnakan ritual menyeduh harian Anda.
                @endif
            </p>
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
     SHOP FEATURES (VALUE CARD GRID)
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden bg-beige-100 py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-20 reveal">
            <div class="inline-flex items-center gap-2 mb-4">
                <span class="w-5 h-[1px] bg-olive-500"></span>
                <span class="text-olive-600 text-xs font-bold uppercase tracking-[0.25em]">Why Filo Roastery?</span>
                <span class="w-5 h-[1px] bg-olive-500"></span>
            </div>
            <h2 class="font-display text-4xl md:text-5xl text-olive-900 font-bold">Kualitas Yang Selalu Terjaga</h2>
            <p class="text-olive-800/60 text-sm md:text-base mt-4 leading-relaxed">
                Kami memastikan standar mutu tinggi mulai dari penjemputan biji hingga menyeduh cangkir Anda di rumah.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @php
            $features = [
                [
                    'emoji' => '✨',
                    'title' => 'Grade Selektif Premium',
                    'desc' => 'Hanya biji kopi arabika specialty grade dengan nilai cupping 85+ yang masuk dalam koleksi sangrai kami.',
                ],
                [
                    'emoji' => '🔥',
                    'title' => 'Freshly Roasted in Batches',
                    'desc' => 'Setiap kopi disangrai dalam kapasitas kecil (micro-lot batch) guna menjamin konsistensi & kesegaran profil aroma optimal.',
                ],
                [
                    'emoji' => '📦',
                    'title' => 'Kemasan Bersegel Valve',
                    'desc' => 'Dikemas dalam kantung aluminium foil premium tebal dengan katup degassing satu arah untuk menjaga kesegaran rasa.',
                ],
            ];
            @endphp

            @foreach($features as $i => $feature)
            <div class="bg-beige-50 border border-beige-200 rounded-[2.5rem] p-10 hover:border-olive-300 hover:bg-white/80 transition-all duration-500 group reveal" style="transition-delay: {{ $i * 0.1 }}s">
                <div class="w-16 h-16 bg-olive-100 text-olive-800 rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:scale-105 transition-transform duration-500 shadow-lg">
                    {{ $feature['emoji'] }}
                </div>
                <h3 class="font-display text-2xl text-olive-900 font-bold mb-4">{{ $feature['title'] }}</h3>
                <p class="text-black/60 text-sm leading-relaxed">{{ $feature['desc'] }}</p>
            </div>
            @endforeach
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
