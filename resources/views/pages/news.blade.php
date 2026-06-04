@extends('layouts.app')
@section('title', 'Coffee News & Journal')
@section('meta_description', 'Eksplorasi dunia kopi melalui Filo Coffee Journal. Berita terbaru, tips brewing, dan cerita di balik setiap biji kopi.')

@section('content')

{{-- ═══════════════════════════════════════
     1. HERO SECTION
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[60vh] flex items-center pt-24">
    {{-- Background decorative --}}
    <div class="absolute inset-0 bg-dark"></div>
    <div class="absolute inset-0 opacity-10"
         style="background-image: radial-gradient(circle at 15% 15%, #CCB196 0%, transparent 40%), radial-gradient(circle at 85% 85%, #6B4226 0%, transparent 40%)">
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="max-w-3xl animate-fade-in-up">
            <div class="inline-flex items-center gap-2 mb-6">
                <span class="w-8 h-px bg-mocca/50"></span>
                <span class="text-mocca text-xs font-semibold tracking-[0.2em] uppercase">Filo Coffee Journal</span>
            </div>
            <h1 class="font-display text-5xl md:text-7xl text-cream font-bold leading-[1.1] mb-8">
                Latest Coffee<br>
                <span class="text-mocca italic">News & Stories</span>
            </h1>
            <p class="text-cream/40 text-base md:text-lg leading-relaxed mb-10">
                Temukan wawasan mendalam mengenai tren kopi dunia, teknik seduh presisi, dan kisah perjalanan biji kopi dari hulu ke hilir.
            </p>
            
            {{-- Search & Filter Bar --}}
            <div class="flex flex-col md:flex-row gap-4 max-w-2xl">
                <div class="relative flex-1">
                    <input type="text" class="input-field pl-12" placeholder="Search articles...">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-cream/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <select class="input-field md:w-48">
                    <option>All Categories</option>
                    @foreach(['Coffee Trends', 'Brewing Tips', 'Beans', 'Lifestyle', 'Business'] as $cat)
                    <option>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     2. FEATURED NEWS SECTION
     ═══════════════════════════════════════ --}}
@if($featuredPost)
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 -mt-10 relative z-10">
    <div class="bg-dark-deep rounded-[3rem] overflow-hidden border border-white/5 shadow-2xl reveal">
        <div class="grid lg:grid-cols-2">
            <div class="aspect-video lg:aspect-auto overflow-hidden">
                <img src="{{ $featuredPost['image'] }}" alt="{{ $featuredPost['title'] }}" class="w-full h-full object-cover">
            </div>
            <div class="p-10 md:p-16 flex flex-col justify-center">
                <div class="flex items-center gap-4 mb-6">
                    <span class="badge bg-mocca/10 text-mocca border border-mocca/20">{{ $featuredPost['category'] }}</span>
                    <span class="text-[0.625rem] font-bold text-cream/20 uppercase tracking-widest">{{ $featuredPost['date'] }}</span>
                </div>
                <h2 class="font-display text-3xl md:text-5xl text-cream font-bold mb-6 leading-tight hover:text-mocca transition-colors">
                    <a href="{{ route('news.show', $featuredPost['slug']) }}">{{ $featuredPost['title'] }}</a>
                </h2>
                <p class="text-cream/40 text-sm leading-relaxed mb-10 line-clamp-3">
                    {{ $featuredPost['excerpt'] }}
                </p>
                <div class="flex items-center justify-between mt-auto">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-mocca/20 flex items-center justify-center text-mocca font-bold text-xs border border-mocca/30">
                            {{ substr($featuredPost['author'], 0, 1) }}
                        </div>
                        <div>
                            <p class="text-cream text-xs font-bold">{{ $featuredPost['author'] }}</p>
                            <p class="text-cream/20 text-[0.625rem]">{{ $featuredPost['read_time'] }}</p>
                        </div>
                    </div>
                    <a href="{{ route('news.show', $featuredPost['slug']) }}" class="btn-outline !py-3 group">
                        Read Story
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════
     3. TRENDING TOPICS
     ═══════════════════════════════════════ --}}
<section class="py-12 border-b border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-6 overflow-x-auto pb-4 no-scrollbar">
            <span class="text-[0.625rem] font-bold text-mocca uppercase tracking-[0.3em] whitespace-nowrap">Trending Topics:</span>
            @foreach($trendingTags as $tag)
            <a href="#" class="px-5 py-2 rounded-full bg-white/[0.03] border border-white/10 text-cream/40 text-[0.625rem] font-bold uppercase tracking-widest hover:border-mocca hover:text-mocca transition-all whitespace-nowrap">
                #{{ $tag }}
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     4. LATEST COFFEE NEWS (GRID)
     ═══════════════════════════════════════ --}}
<section class="py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-16 reveal">
            <div>
                <p class="section-subtitle">Journal Updates</p>
                <h2 class="section-title">Artikel Terbaru</h2>
            </div>
            <div class="hidden md:flex gap-2">
                <button class="w-10 h-10 rounded-xl border border-white/5 flex items-center justify-center text-cream/20 hover:border-mocca hover:text-mocca transition-all"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></button>
                <button class="w-10 h-10 rounded-xl border border-white/5 flex items-center justify-center text-cream/20 hover:border-mocca hover:text-mocca transition-all"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($latestPosts as $i => $post)
            <article class="group reveal" style="transition-delay: {{ $i * 0.1 }}s">
                <div class="aspect-[16/10] overflow-hidden rounded-[2rem] bg-white/5 mb-6 relative">
                    <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute top-4 left-4">
                        <span class="bg-dark/70 backdrop-blur-md text-mocca text-[0.625rem] font-bold px-3 py-1 rounded-lg border border-mocca/20">{{ $post['category'] }}</span>
                    </div>
                </div>
                <div class="px-2">
                    <div class="flex items-center gap-3 text-[0.625rem] font-bold text-cream/20 uppercase tracking-widest mb-4">
                        <span>{{ $post['date'] }}</span>
                        <span class="w-1 h-1 rounded-full bg-mocca/30"></span>
                        <span>{{ $post['read_time'] }}</span>
                    </div>
                    <h3 class="font-display text-xl text-cream font-bold mb-4 group-hover:text-mocca transition-colors leading-snug">
                        <a href="{{ route('news.show', $post['slug']) }}">{{ $post['title'] }}</a>
                    </h3>
                    <p class="text-cream/30 text-xs leading-relaxed mb-6 line-clamp-2">
                        {{ $post['excerpt'] }}
                    </p>
                    <a href="{{ route('news.show', $post['slug']) }}" class="text-mocca text-[0.625rem] font-bold uppercase tracking-[0.2em] inline-flex items-center gap-2 group/btn">
                        Read More
                        <span class="w-8 h-px bg-mocca/30 group-hover/btn:w-12 transition-all"></span>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <div class="text-center mt-20 reveal">
            <button class="btn-outline px-12 group">
                Load More Articles
            </button>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     5. COFFEE EDUCATION SECTION
     ═══════════════════════════════════════ --}}
<section class="py-24 bg-white/[0.02] border-y border-white/5 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-20 items-center">
            <div class="reveal">
                <p class="section-subtitle">Coffee 101</p>
                <h2 class="section-title mb-8">Tingkatkan <span class="text-mocca italic">Pengetahuan Kopi</span> Anda</h2>
                <div class="space-y-6">
                    @foreach([
                        ['t' => 'Arabica vs Robusta', 'd' => 'Panduan mendasar mengenai perbedaan rasa, habitat, dan karakteristik.'],
                        ['t' => 'Manual Brewing Guide', 'd' => 'Tips ekstraksi sempurna untuk V60, Chemex, dan AeroPress.'],
                        ['t' => 'Roast Profiles', 'd' => 'Memahami Light, Medium, hingga Dark Roast dan pengaruhnya.'],
                    ] as $edu)
                    <div class="flex gap-6 p-6 rounded-3xl bg-white/[0.02] border border-white/5 hover:border-mocca/20 transition-all cursor-pointer group">
                        <div class="w-12 h-12 rounded-2xl bg-mocca/10 flex items-center justify-center text-mocca group-hover:bg-mocca group-hover:text-dark transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div>
                            <h4 class="text-cream font-bold text-sm mb-1">{{ $edu['t'] }}</h4>
                            <p class="text-cream/25 text-[0.625rem]">{{ $edu['d'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="relative reveal" style="transition-delay: 0.2s">
                <div class="aspect-square rounded-[3rem] overflow-hidden border border-white/10 relative group">
                    <img src="https://images.unsplash.com/photo-1511537190424-bbbab87ac5eb?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover grayscale opacity-60 group-hover:scale-105 group-hover:grayscale-0 transition-all duration-1000">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent"></div>
                    <div class="absolute bottom-10 left-10 right-10">
                        <p class="text-mocca font-bold text-[0.625rem] tracking-[0.3em] uppercase mb-4">Editor's Choice</p>
                        <h3 class="font-display text-3xl text-cream font-bold leading-tight">Panduan Lengkap Memilih Biji Kopi Untuk Pemula</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     6. VIDEO / MEDIA SECTION
     ═══════════════════════════════════════ --}}
<section class="py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 reveal">
            <p class="section-subtitle">Visual Stories</p>
            <h2 class="section-title">Video & Media</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach([
                ['t' => 'Latte Art Showcase 2024', 'v' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=2070&auto=format&fit=crop'],
                ['t' => 'Behind The Roast: Filo Coffee', 'v' => 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?q=80&w=2070&auto=format&fit=crop']
            ] as $v)
            <div class="relative aspect-video rounded-[2.5rem] overflow-hidden group reveal">
                <img src="{{ $v['v'] }}" class="w-full h-full object-cover grayscale opacity-40 group-hover:scale-105 group-hover:grayscale-0 transition-all duration-700">
                <div class="absolute inset-0 bg-dark/20 group-hover:bg-transparent transition-colors"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <button class="w-20 h-20 rounded-full bg-mocca/90 text-dark flex items-center justify-center transform group-hover:scale-110 transition-transform shadow-2xl">
                        <svg class="w-8 h-8 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </button>
                </div>
                <div class="absolute bottom-8 left-8">
                    <p class="text-cream font-bold text-lg">{{ $v['t'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     7. NEWSLETTER SUBSCRIPTION
     ═══════════════════════════════════════ --}}
{{-- ═══════════════════════════════════════
     7. NEWSLETTER SUBSCRIPTION (HOME STYLE)
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
            <span class="text-dark/40 text-[0.65rem] font-bold uppercase tracking-[0.2em]">Our Newsletter</span>
            <span class="w-8 h-px bg-dark/20"></span>
        </div>
        <h2 class="font-display text-4xl md:text-6xl text-dark font-bold mb-8">Stay Updated With<br>Our Newsletter</h2>
        <p class="text-dark/60 text-lg md:text-xl mb-12 max-w-2xl mx-auto font-medium">Berlangganan untuk mendapatkan berita terbaru, tips mingguan, dan penawaran eksklusif langsung di kotak masuk Anda.</p>
        
        <form class="flex flex-col sm:flex-row gap-4 max-w-2xl mx-auto">
            <input type="email" placeholder="Enter your email address" 
                   class="flex-1 bg-dark/5 border border-dark/10 rounded-2xl px-8 py-4 text-dark placeholder:text-dark/30 focus:outline-none focus:border-dark/30 transition-all font-medium">
            <button type="submit" class="bg-dark text-cream px-10 py-4 rounded-2xl font-bold hover:bg-dark-deep transition-all duration-300 hover:-translate-y-1 shadow-2xl shadow-dark/20 whitespace-nowrap">
                Subscribe Now
            </button>
        </form>
    </div>
</section>

@endsection
