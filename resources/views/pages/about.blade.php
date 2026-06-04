@extends('layouts.app')
@section('title', 'Tentang Kami')
@section('meta_description', 'Filo Coffee — Mengenal kami lebih dalam. Kisah, nilai, dan semangat di balik setiap cangkir kopi kami.')

@section('content')

{{-- ═══════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[60vh] flex items-center bg-dark">
    {{-- Background layers --}}
    <div class="absolute inset-0 opacity-20"
         style="background-image: radial-gradient(circle at 10% 90%, #6B4226 0%, transparent 40%), radial-gradient(circle at 90% 10%, #C9A87C 0%, transparent 40%)">
    </div>
    <div class="absolute right-0 top-0 w-[500px] h-[500px] bg-mocca/10 rounded-full blur-[140px] animate-pulse-glow"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <div class="inline-flex items-center gap-3 mb-8 animate-fade-in-up">
            <span class="w-10 h-px bg-mocca/40"></span>
            <span class="text-mocca text-xs font-bold tracking-[0.3em] uppercase">The Legacy</span>
            <span class="w-10 h-px bg-mocca/40"></span>
        </div>
        <h1 class="font-display text-5xl md:text-7xl text-cream font-bold leading-tight mb-8 animate-fade-in-up" style="animation-delay: 0.1s">
            Cerita Di Balik<br>
            <span class="text-mocca italic">Filo Coffee.</span>
        </h1>
        <p class="text-cream/50 text-base md:text-lg leading-relaxed max-w-2xl mx-auto animate-fade-in-up" style="animation-delay: 0.2s">
            Lebih dari sekadar kedai kopi — kami adalah ruang hangat tempat cerita lahir, persahabatan tumbuh, dan cita rasa terbaik Nusantara tersaji dalam setiap tegukan.
        </p>
    </div>
</section>

{{-- ═══════════════════════════════════════
     STORY SECTION
     ═══════════════════════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 md:py-40">
    <div class="grid lg:grid-cols-2 gap-24 items-center">

        {{-- Story text --}}
        <div class="reveal">
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-8 h-px bg-mocca/40"></span>
                <span class="text-mocca text-xs font-bold tracking-[0.2em] uppercase">Our Journey</span>
            </div>
            <h2 class="section-title mb-10 leading-tight">
                Lebih dari Sekadar<br>
                <span class="text-mocca italic">Secangkir Kopi.</span>
            </h2>
            <div class="space-y-8 text-cream/40 text-lg leading-relaxed">
                <p>
                    Filo Coffee lahir dari kecintaan mendalam terhadap kopi Indonesia. Sejak 2019, kami telah berdedikasi untuk menghadirkan pengalaman kopi terbaik dari biji-biji pilihan pegunungan Nusantara — dari Aceh Gayo yang floral hingga Flores yang earthy.
                </p>
                <p>
                    Kami percaya bahwa secangkir kopi yang baik mampu menciptakan momen berharga. Itulah mengapa setiap detail — dari pemilihan biji, proses roasting, hingga cara penyajian — kami perhatikan dengan penuh ketelitian dan cinta.
                </p>
            </div>

            {{-- Stats row --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 mt-16 pt-12 border-t border-white/[0.05]">
                @foreach([
                    ['value' => '2019', 'label' => 'Founded'],
                    ['value' => '10k+', 'label' => 'Members'],
                    ['value' => '50+', 'label' => 'Specialty Menu'],
                    ['value' => '4.9★', 'label' => 'Customer Rating'],
                ] as $stat)
                <div class="group">
                    <div class="font-display text-3xl font-bold text-mocca group-hover:scale-110 transition-transform duration-500">{{ $stat['value'] }}</div>
                    <div class="text-cream/20 text-[0.65rem] mt-2 font-bold uppercase tracking-widest">{{ $stat['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Visual Image --}}
        <div class="relative reveal" style="transition-delay: 0.2s">
            <div class="absolute -inset-10 bg-mocca/5 rounded-full blur-[100px] opacity-40"></div>
            <div class="relative rounded-[4rem] overflow-hidden border border-white/5 shadow-2xl group">
                <img src="https://images.unsplash.com/photo-1442512595331-e89e73853f31?q=80&w=2070&auto=format&fit=crop" class="w-full h-[600px] object-cover grayscale opacity-60 group-hover:grayscale-0 group-hover:scale-105 transition-all duration-[2s]">
                <div class="absolute inset-0 bg-gradient-to-t from-dark via-transparent to-transparent opacity-60"></div>
                
                {{-- Floating Badge --}}
                <div class="absolute bottom-10 left-10 p-6 glass rounded-3xl border border-white/10 shadow-2xl animate-float">
                    <p class="text-mocca font-bold text-lg">Premium Specialty</p>
                    <p class="text-cream/40 text-xs font-medium uppercase tracking-widest">Since 2019</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     VALUES
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden bg-dark-deep py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-20 reveal">
            <p class="section-subtitle">Our Values</p>
            <h2 class="section-title">Yang Kami Percayai</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-10">
            @php
            $values = [
                [
                    'icon' => '🌱',
                    'title' => 'Sustainability',
                    'desc' => 'Kami bermitra langsung dengan petani lokal untuk memastikan praktik pertanian yang berkelanjutan dan ramah lingkungan.',
                ],
                [
                    'icon' => '✨',
                    'title' => 'Pure Quality',
                    'desc' => 'Setiap biji dipilih dengan teliti dan di-roast oleh ahli kami untuk menghasilkan cita rasa optimal yang konsisten.',
                ],
                [
                    'icon' => '🤝',
                    'title' => 'Community',
                    'desc' => 'Filo Coffee adalah ruang berkumpulnya komunitas pencinta kopi, tempat di mana persahabatan tumbuh dan kenangan tercipta.',
                ],
            ];
            @endphp

            @foreach($values as $i => $val)
            <div class="card p-10 group reveal" style="transition-delay: {{ $i * 0.1 }}s">
                <div class="w-16 h-16 bg-dark rounded-2xl flex items-center justify-center text-4xl mb-8 group-hover:scale-110 group-hover:bg-mocca group-hover:text-dark transition-all duration-500 shadow-xl">
                    {{ $val['icon'] }}
                </div>
                <h3 class="font-display text-2xl text-cream font-bold mb-4 group-hover:text-mocca transition-colors duration-500">{{ $val['title'] }}</h3>
                <p class="text-cream/30 text-base leading-relaxed">{{ $val['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     TIMELINE
     ═══════════════════════════════════════ --}}
<section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-32 md:py-40">
    <div class="text-center mb-24 reveal">
        <p class="section-subtitle">The Journey</p>
        <h2 class="section-title">Tonggak Sejarah Kami</h2>
    </div>

    <div class="relative">
        {{-- Vertical line --}}
        <div class="absolute left-1/2 top-0 bottom-0 w-px bg-gradient-to-b from-mocca/40 via-mocca/10 to-transparent hidden md:block"></div>

        <div class="space-y-24">
            @php
            $timeline = [
                ['year' => '2019', 'title' => 'The Beginning', 'desc' => 'Membuka gerai pertama kami di Jakarta Selatan dengan misi menyajikan kopi terbaik Nusantara.', 'side' => 'left'],
                ['year' => '2020', 'title' => 'Roastery Launch', 'desc' => 'Mulai melakukan roasting mandiri untuk memastikan standar kualitas biji kopi kami selalu terjaga.', 'side' => 'right'],
                ['year' => '2022', 'title' => 'Experience Expansion', 'desc' => 'Menghadirkan fasilitas PlayStation lounge dan Private Room untuk kenyamanan maksimal.', 'side' => 'left'],
                ['year' => '2024', 'title' => 'Digital Era', 'desc' => 'Meluncurkan platform digital untuk reservasi online dan sistem membership premium.', 'side' => 'right'],
            ];
            @endphp

            @foreach($timeline as $i => $event)
            <div class="relative grid md:grid-cols-2 gap-12 md:gap-20 items-center reveal" style="transition-delay: {{ $i * 0.1 }}s">
                @if($event['side'] === 'left')
                <div class="md:text-right">
                    <div class="text-mocca font-display text-4xl font-bold mb-4">{{ $event['year'] }}</div>
                    <h3 class="text-cream font-bold text-xl mb-4">{{ $event['title'] }}</h3>
                    <p class="text-cream/30 text-base leading-relaxed">{{ $event['desc'] }}</p>
                </div>
                <div class="hidden md:flex absolute left-1/2 -translate-x-1/2 w-4 h-4 bg-mocca rounded-full z-10 shadow-[0_0_20px_rgba(201,168,124,0.6)]"></div>
                <div class="hidden md:block"></div>
                @else
                <div class="hidden md:block"></div>
                <div class="hidden md:flex absolute left-1/2 -translate-x-1/2 w-4 h-4 bg-mocca rounded-full z-10 shadow-[0_0_20px_rgba(201,168,124,0.6)]"></div>
                <div class="md:text-left">
                    <div class="text-mocca font-display text-4xl font-bold mb-4">{{ $event['year'] }}</div>
                    <h3 class="text-cream font-bold text-xl mb-4">{{ $event['title'] }}</h3>
                    <p class="text-cream/30 text-base leading-relaxed">{{ $event['desc'] }}</p>
                </div>
                @endif
                
                {{-- Mobile indicator --}}
                <div class="md:hidden flex items-center gap-4 -mt-8">
                    <div class="w-3 h-3 bg-mocca rounded-full shadow-[0_0_15px_rgba(201,168,124,0.5)]"></div>
                    <span class="text-mocca font-bold text-xl">{{ $event['year'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     LOCATION INFO
     ═══════════════════════════════════════ --}}
{{-- ═══════════════════════════════════════
     LOCATION INFO (HOME CTA STYLE)
     ═══════════════════════════════════════ --}}
{{-- ═══════════════════════════════════════
     LOCATION INFO (HOME CTA STYLE)
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
            <span class="text-dark/40 text-[0.65rem] font-bold uppercase tracking-[0.2em]">Visit Us</span>
            <span class="w-8 h-px bg-dark/20"></span>
        </div>
        <h2 class="font-display text-4xl md:text-6xl text-dark font-bold mb-8">Temukan Kami Secara <span class="italic font-medium">Langsung.</span></h2>
        
        <div class="flex flex-wrap justify-center gap-x-12 gap-y-6 mb-12">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-dark rounded-xl flex items-center justify-center text-mocca shadow-lg flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zm-5.657-3.657a2 2 0 100-4 2 2 0 000 4z"/></svg>
                </div>
                <p class="text-dark/60 text-sm font-medium">Jl. Kopi Nusantara No. 12, Jakarta Selatan</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-dark rounded-xl flex items-center justify-center text-mocca shadow-lg flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-dark/60 text-sm font-medium">Setiap Hari: 08:00 – 22:00 WIB</p>
            </div>
        </div>

        <div class="flex flex-wrap justify-center items-center gap-6">
            <a href="{{ route('reservation.index') }}" class="bg-dark text-cream px-10 py-4 rounded-2xl font-bold hover:bg-dark-deep transition-all duration-300 hover:-translate-y-1 shadow-2xl shadow-dark/20 flex items-center gap-3 group">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>Reservasi Sekarang</span>
                <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="{{ route('menu') }}" class="bg-dark/5 text-dark border border-dark/10 px-10 py-4 rounded-2xl font-bold hover:bg-dark/10 transition-all duration-300 hover:-translate-y-1 flex items-center gap-3 group">
                <span>Eksplor Daftar Menu</span>
                <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>

@endsection
