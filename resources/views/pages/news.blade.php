@extends('layouts.app')
@section('title', 'Coffee News & Journal | Filo Coffee')
@section('meta_description', 'Eksplorasi dunia kopi melalui Filo Coffee Journal. Berita terbaru, tips brewing, dan cerita di balik setiap biji kopi.')

@section('content')

{{-- ═══════════════════════════════════════
     1. HERO SECTION
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[50vh] flex items-center bg-beige-50">
    {{-- Decorative Background --}}
    <div class="absolute inset-0 opacity-50 pointer-events-none"
         style="background-image: radial-gradient(circle at 15% 15%, #CFDAD0 0%, transparent 40%), radial-gradient(circle at 85% 85%, #E6DCCF 0%, transparent 40%)">
    </div>
    <div class="absolute right-[-5%] top-1/4 w-[500px] h-[500px] bg-olive-200/30 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute left-[-5%] bottom-0 w-80 h-80 bg-beige-200/50 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-28 z-10">
        <div class="max-w-3xl animate-fade-in-up">
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-8 h-[1.5px] bg-olive-500"></span>
                <span class="text-olive-700 text-xs font-bold tracking-[0.25em] uppercase">Filo Coffee Journal</span>
            </div>
            <h1 class="font-display text-5xl md:text-7xl text-olive-900 font-bold leading-[1.05] mb-8">
                Coffee News<br>
                <span class="text-beige-600 italic font-semibold">& Stories.</span>
            </h1>
            <p class="text-olive-800/70 text-lg md:text-xl leading-relaxed mb-12 max-w-2xl">
                Temukan wawasan mendalam mengenai tren kopi dunia, teknik seduh presisi, dan kisah perjalanan biji kopi dari hulu ke hilir.
            </p>

            {{-- Search Bar --}}
            <div class="flex flex-col sm:flex-row gap-3 max-w-2xl">
                <div class="relative flex-1">
                    <input type="text" id="search-input" class="w-full bg-white border border-beige-200 rounded-2xl px-5 pl-12 py-4 text-olive-900 placeholder:text-olive-400 focus:outline-none focus:border-olive-400 focus:ring-2 focus:ring-olive-100 transition-all shadow-sm text-sm font-medium" placeholder="Cari artikel...">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-olive-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <select class="bg-white border border-beige-200 rounded-2xl px-5 py-4 text-olive-800 text-sm font-bold focus:outline-none focus:border-olive-400 transition-all shadow-sm sm:w-48 appearance-none cursor-pointer">
                    <option>Semua Kategori</option>
                    @foreach(['Coffee Trends', 'Brewing Tips', 'Beans & Origin', 'Lifestyle', 'Our Story'] as $cat)
                    <option>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     4. LATEST ARTICLES GRID
     ═══════════════════════════════════════ --}}

<section class="py-20 bg-beige-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
        <div class="flex items-center gap-5 overflow-x-auto no-scrollbar pb-5">
            <span class="text-olive-500 text-[0.65rem] font-bold uppercase tracking-[0.25em] whitespace-nowrap">Trending:</span>
            @foreach($trendingTags as $tag)
            <a href="#" class="px-5 py-2.5 rounded-full bg-beige-50 border border-beige-200 text-olive-700 text-[0.65rem] font-bold uppercase tracking-wider hover:border-olive-500 hover:bg-olive-50 hover:text-olive-900 transition-all whitespace-nowrap">
                #{{ $tag }}
            </a>
            @endforeach
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="inline-flex items-center gap-3 mb-4">
                <span class="w-8 h-[1.5px] bg-olive-500"></span>
                <span class="text-olive-700 text-xs font-bold tracking-[0.25em] uppercase">Artikel Terbaru</span>
            </div>
            <h2 class="font-display text-4xl md:text-5xl text-olive-900 font-bold leading-[1.05] mb-16">
                Coffee News
                <span class="text-beige-600 italic font-semibold">Journal.</span>
            </h2>
            
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($latestPosts as $i => $post)
            <article class="group bg-white border border-beige-200 rounded-3xl overflow-hidden hover:border-olive-300 hover:shadow-xl hover:shadow-olive-900/8 transition-all duration-200 reveal" style="transition-delay: {{ ($i % 9) * 0.07 }}s">
                {{-- Image --}}
                <div class="aspect-[16/10] overflow-hidden relative bg-beige-100">
                    <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-108">
                    <div class="absolute top-4 left-4">
                        <span class="bg-white/90 backdrop-blur-sm text-olive-800 text-[0.6rem] font-bold px-3 py-1.5 rounded-full uppercase tracking-wider border border-beige-200">{{ $post['category'] }}</span>
                    </div>
                </div>
                {{-- Content --}}
                <div class="p-7">
                    <div class="flex items-center gap-3 text-[0.65rem] font-bold text-olive-400 uppercase tracking-widest mb-4">
                        <span>{{ $post['date'] }}</span>
                        <span class="w-1 h-1 rounded-full bg-beige-400"></span>
                        <span>{{ $post['read_time'] }}</span>
                    </div>
                    <h3 class="font-display text-xl text-olive-900 font-bold mb-3 group-hover:text-olive-700 transition-colors leading-snug">
                        <a href="{{ route('news.show', $post['slug']) }}">{{ $post['title'] }}</a>
                    </h3>
                    <p class="text-olive-600/80 text-sm leading-relaxed mb-6 line-clamp-2">
                        {{ $post['excerpt'] }}
                    </p>
                    <a href="{{ route('news.show', $post['slug']) }}" class="text-olive-800 text-[0.70rem] font-bold tracking-[0.2em] inline-flex items-center group/btn hover:text-olive-600 transition-colors">
                        <span>Baca Selengkapnya</span>
                        <span class="w-6 h-px bg-olive-400 group-hover/btn:w-10 transition-all duration-300"></span>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <div class="text-center mt-16 reveal">
            <button class="border border-olive-800/30 text-olive-900 hover:bg-olive-800 hover:text-beige-50 px-8 py-3 rounded-2xl font-bold transition-all duration-300 inline-flex items-center gap-2">
                <span>Muat Lebih Banyak</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     5. COFFEE EDUCATION
     ═══════════════════════════════════════ --}}
<section class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-20 items-center">
            <div class="reveal">
                <span class="inline-block text-olive-600 text-xs font-bold tracking-[0.25em] uppercase mb-4">Coffee 101</span>
                <h2 class="font-display text-4xl md:text-5xl text-olive-900 font-bold mb-8">
                    Tingkatkan <span class="text-beige-600 italic">Pengetahuan Kopi</span> Anda
                </h2>
                <div class="space-y-4">
                    @foreach([
                        ['t' => 'Arabica vs Robusta', 'd' => 'Panduan mendasar mengenai perbedaan rasa, habitat, dan karakteristik.'],
                        ['t' => 'Manual Brewing Guide', 'd' => 'Tips ekstraksi sempurna untuk V60, Chemex, dan AeroPress.'],
                        ['t' => 'Roast Profiles Explained', 'd' => 'Memahami Light, Medium, hingga Dark Roast dan pengaruhnya.'],
                    ] as $edu)
                    <div class="flex gap-5 p-6 rounded-2xl bg-beige-50 border border-beige-200 hover:border-olive-300 hover:bg-olive-50 transition-all duration-300 cursor-pointer group">
                        <div class="w-12 h-12 rounded-xl bg-white border border-beige-200 flex items-center justify-center text-olive-600 group-hover:bg-olive-800 group-hover:text-beige-50 group-hover:border-olive-800 transition-all flex-shrink-0 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div>
                            <h4 class="text-olive-900 font-bold text-base mb-1 group-hover:text-olive-700 transition-colors">{{ $edu['t'] }}</h4>
                            <p class="text-olive-500 text-sm leading-relaxed">{{ $edu['d'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="relative reveal" style="transition-delay: 0.2s">
                <div class="rounded-3xl overflow-hidden shadow-xl ring-1 ring-olive-900/5 relative group">
                    <img src="https://images.unsplash.com/photo-1511537190424-bbbab87ac5eb?q=80&w=2070&auto=format&fit=crop" class="w-full h-[500px] object-cover group-hover:scale-105 transition-all duration-1000">
                    <div class="absolute inset-0 bg-gradient-to-t from-olive-950/70 via-olive-900/20 to-transparent"></div>
                    <div class="absolute bottom-10 left-10 right-10">
                        <span class="text-beige-300 font-bold text-[0.65rem] tracking-[0.3em] uppercase block mb-3">Editor's Choice</span>
                        <h3 class="font-display text-2xl text-white font-bold leading-tight">Panduan Lengkap Memilih Biji Kopi Untuk Pemula</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     6. VIDEO SECTION
     ═══════════════════════════════════════ --}}
<section class="py-24 bg-beige-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 reveal">
            <span class="inline-block text-olive-600 text-xs font-bold tracking-[0.25em] uppercase mb-4">Visual Stories</span>
            <h2 class="font-display text-4xl md:text-5xl text-olive-900 font-bold">Video & Media</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach([
                ['t' => 'Latte Art Showcase 2024', 'v' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=2070&auto=format&fit=crop'],
                ['t' => 'Behind The Roast: Filo Coffee', 'v' => 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?q=80&w=2070&auto=format&fit=crop']
            ] as $v)
            <div class="relative aspect-video rounded-3xl overflow-hidden group reveal cursor-pointer shadow-lg hover:shadow-2xl hover:shadow-olive-900/15 transition-all duration-500">
                <img src="{{ $v['v'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-700">
                <div class="absolute inset-0 bg-olive-950/40 group-hover:bg-olive-950/20 transition-colors duration-500"></div>
                {{-- Play Button --}}
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-18 h-18 rounded-full bg-white/90 backdrop-blur-sm text-olive-900 flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300 shadow-2xl w-20 h-20">
                        <svg class="w-8 h-8 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                </div>
                <div class="absolute bottom-8 left-8 right-8">
                    <p class="text-white font-display text-xl font-bold">{{ $v['t'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const revealItems = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, { threshold: 0.05 });
        revealItems.forEach(item => observer.observe(item));
    });
</script>
@endpush
