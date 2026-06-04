@extends('layouts.app')
@section('title', $post['title'])
@section('meta_description', $post['excerpt'])

@section('content')

{{-- ═══════════════════════════════════════
     SINGLE POST HEADER
     ═══════════════════════════════════════ --}}
<section class="relative pt-32 pb-20 overflow-hidden">
    <div class="absolute inset-0 bg-dark"></div>
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 50% 0%, #CCB196 0%, transparent 70%)"></div>
    
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="animate-fade-in-up">
            <div class="flex flex-wrap justify-center items-center gap-4 mb-8">
                <span class="badge bg-mocca/10 text-mocca border border-mocca/20">{{ $post['category'] }}</span>
                <span class="text-cream/20 text-[0.625rem] font-bold uppercase tracking-[0.2em]">{{ $post['date'] }}</span>
                <span class="w-1 h-1 rounded-full bg-cream/10"></span>
                <span class="text-cream/20 text-[0.625rem] font-bold uppercase tracking-[0.2em]">{{ $post['read_time'] }}</span>
            </div>
            
            <h1 class="font-display text-4xl md:text-6xl text-cream font-bold leading-tight mb-10">
                {{ $post['title'] }}
            </h1>
            
            <div class="flex items-center justify-center gap-4">
                <div class="w-12 h-12 rounded-full bg-mocca/10 flex items-center justify-center text-mocca font-bold border border-mocca/20">
                    {{ substr($post['author'], 0, 1) }}
                </div>
                <div class="text-left">
                    <p class="text-cream font-bold text-sm">{{ $post['author'] }}</p>
                    <p class="text-cream/20 text-[0.625rem] uppercase tracking-widest">Coffee Editor</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     POST CONTENT
     ═══════════════════════════════════════ --}}
<section class="pb-24 relative">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Hero Image --}}
        <div class="relative aspect-[21/9] rounded-[3rem] overflow-hidden shadow-2xl mb-20 reveal">
            <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="w-full h-full object-cover">
        </div>
        
        <div class="max-w-3xl mx-auto">
            {{-- Content Area --}}
            <div class="prose prose-invert prose-cream max-w-none reveal">
                <p class="text-xl text-cream/60 leading-relaxed font-medium mb-12 italic border-l-4 border-mocca pl-8">
                    {{ $post['excerpt'] }}
                </p>
                
                <div class="text-cream/40 leading-[1.8] space-y-8 text-lg">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    
                    <h3 class="text-cream font-display text-2xl font-bold mt-12 mb-6">Memahami Karakter Rasa</h3>
                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    
                    <blockquote class="bg-white/[0.02] border-y border-white/5 py-12 px-10 text-center my-16 rounded-[2rem]">
                        <p class="font-display text-3xl text-cream font-bold italic leading-tight mb-4">"Kopi yang baik adalah awal dari percakapan yang baik."</p>
                        <cite class="text-mocca text-xs font-bold uppercase tracking-widest not-italic">— Filo Coffee Master</cite>
                    </blockquote>
                    
                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                </div>
            </div>
            
            {{-- Share & Tags --}}
            <div class="mt-20 pt-10 border-t border-white/5 flex flex-col md:flex-row items-center justify-between gap-6 reveal">
                <div class="flex items-center gap-3">
                    <span class="text-[0.625rem] font-bold text-cream/20 uppercase tracking-widest">Share:</span>
                    <div class="flex gap-2">
                        @foreach(['Twitter', 'Facebook', 'WhatsApp', 'LinkedIn'] as $social)
                        <button class="w-10 h-10 rounded-xl border border-white/5 flex items-center justify-center text-cream/20 hover:border-mocca hover:text-mocca transition-all">
                            <span class="sr-only">{{ $social }}</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15h-2v-6h2v6zm-1-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm5 7h-2v-6h2v6zm-1-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z"/></svg>
                        </button>
                        @endforeach
                    </div>
                </div>
                <div class="flex gap-2">
                    <span class="px-3 py-1 rounded-lg bg-white/[0.03] text-cream/20 text-[0.625rem] font-bold uppercase">#CoffeeJournal</span>
                    <span class="px-3 py-1 rounded-lg bg-white/[0.03] text-cream/20 text-[0.625rem] font-bold uppercase">#Brewing</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     RELATED ARTICLES
     ═══════════════════════════════════════ --}}
<section class="py-24 bg-dark-deep">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-16 reveal">
            <div>
                <p class="section-subtitle">Keep Reading</p>
                <h2 class="section-title">Artikel Terkait</h2>
            </div>
            <a href="{{ route('news') }}" class="text-mocca text-[0.625rem] font-bold uppercase tracking-widest hover:underline">View All Articles</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($relatedPosts as $r)
            <article class="group reveal">
                <div class="aspect-video overflow-hidden rounded-3xl bg-white/5 mb-6">
                    <img src="{{ $r['image'] }}" alt="{{ $r['title'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                </div>
                <h4 class="font-display text-lg text-cream font-bold mb-2 group-hover:text-mocca transition-colors">
                    <a href="{{ route('news.show', $r['slug']) }}">{{ $r['title'] }}</a>
                </h4>
                <p class="text-cream/20 text-[0.625rem] font-bold uppercase tracking-widest">{{ $r['date'] }}</p>
            </article>
            @endforeach
        </div>
    </div>
</section>

@endsection
