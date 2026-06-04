@extends('layouts.app')
@section('title', 'Our Services')
@section('meta_description', 'Filo Coffee menawarkan lebih dari sekadar kopi. Nikmati layanan Home Brewing, Coworking Space, dan Private Room eksklusif.')

@section('content')

{{-- ═══════════════════════════════════════
     1. HERO SECTION
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[75vh] flex items-center bg-dark">
    {{-- Background layers --}}
    <div class="absolute inset-0 opacity-20"
         style="background-image: radial-gradient(circle at 10% 90%, #6B4226 0%, transparent 40%), radial-gradient(circle at 90% 10%, #C9A87C 0%, transparent 40%)">
    </div>
    
    {{-- Main Image background with overlay --}}
    <div class="absolute inset-0 opacity-10">
        <img src="https://images.unsplash.com/photo-1442512595331-e89e73853f31?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover grayscale brightness-50">
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <div class="animate-fade-in-up">
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-10 h-px bg-mocca/40"></span>
                <span class="text-mocca text-xs font-bold tracking-[0.3em] uppercase">Beyond The Cup</span>
                <span class="w-10 h-px bg-mocca/40"></span>
            </div>
            <h1 class="font-display text-5xl md:text-7xl text-cream font-bold leading-tight mb-6">
                Lebih Dari<br>
                <span class="text-mocca italic">Sekadar Kopi.</span>
            </h1>
            <p class="text-cream/50 text-base md:text-base leading-relaxed mb-10 max-w-2xl mx-auto">
                Filo Coffee menghadirkan ruang kolaborasi, edukasi seduh mandiri, dan area pertemuan eksklusif yang dirancang untuk mendukung gaya hidup modern Anda.
            </p>
            <div class="flex flex-wrap justify-center items-center gap-6">
                <a href="#services-overview" class="btn-mocca !px-10 !py-4 shadow-xl group">
                    <span>Eksplor Layanan</span>
                    <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </a>
                <a href="{{ route('reservation.index') }}" class="btn-outline !px-10 !py-4 group">
                    <span>Reservasi Sekarang</span>
                    <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-3">
        <div class="w-px h-12 bg-gradient-to-b from-mocca/40 to-transparent"></div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     2. SERVICES OVERVIEW
     ═══════════════════════════════════════ --}}
<section id="services-overview" class="py-24 bg-dark-deep">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 reveal">
            <p class="section-subtitle">Our Specialization</p>
            <h2 class="section-title">Layanan Unggulan Kami</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                [
                    'img' => 'https://images.unsplash.com/photo-1544787210-282aa065362e?q=80&w=1974&auto=format&fit=crop',
                    'title' => 'Home Brewing',
                    'desc' => 'Pelajari seni menyeduh kopi manual di rumah dengan bimbingan barista profesional kami.',
                    'link' => '#home-brewing'
                ],
                [
                    'img' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069&auto=format&fit=crop',
                    'title' => 'Coworking Space',
                    'desc' => 'Area kerja produktif dengan WiFi kencang, suasana tenang, dan kopi tak terbatas.',
                    'link' => '#coworking'
                ],
                [
                    'img' => 'https://images.unsplash.com/photo-1600508774444-455b8ad70e97?q=80&w=2070&auto=format&fit=crop',
                    'title' => 'Private Room',
                    'desc' => 'Ruangan eksklusif untuk meeting, acara privat, atau sesi gaming intens bersama teman.',
                    'link' => '#private-room'
                ]
            ] as $i => $s)
            <div class="group relative overflow-hidden rounded-[3rem] bg-warm border border-white/5 reveal shadow-2xl" style="transition-delay: {{ $i * 0.1 }}s">
                <div class="aspect-[4/5] overflow-hidden">
                    <img src="{{ $s['img'] }}" class="w-full h-full object-cover grayscale opacity-40 group-hover:grayscale-0 group-hover:scale-110 group-hover:opacity-100 transition-all duration-1000">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-dark via-dark/20 to-transparent p-8 flex flex-col justify-end">
                    <h3 class="font-display text-2xl text-cream font-bold mb-4 group-hover:text-mocca transition-colors duration-500">{{ $s['title'] }}</h3>
                    <p class="text-cream/40 text-sm leading-relaxed mb-6 opacity-0 group-hover:opacity-100 transform translate-y-6 group-hover:translate-y-0 transition-all duration-500">
                        {{ $s['desc'] }}
                    </p>
                    <a href="{{ $s['link'] }}" class="text-mocca text-[0.7rem] font-bold uppercase tracking-[0.25em] inline-flex items-center gap-3 group/btn">
                        <span>Learn More</span>
                        <span class="w-10 h-px bg-mocca/30 group-hover/btn:w-16 group-hover/btn:bg-mocca transition-all duration-500"></span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     3. HOME BREWING SECTION
     ═══════════════════════════════════════ --}}
<section id="home-brewing" class="py-24 relative bg-dark">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-20 items-center">
            <div class="reveal">
                <p class="section-subtitle">Art of Brewing</p>
                <h2 class="section-title mb-8">Jadilah Barista <span class="text-mocca italic">Bagi Diri Sendiri.</span></h2>
                <p class="text-cream/40 text-base leading-relaxed mb-10">
                    Seni menyeduh kopi bukan hanya tentang rasa, tapi tentang proses. Kami menyediakan workshop mendalam mengenai berbagai metode seduh manual agar Anda bisa menikmati kopi berkualitas cafe di rumah sendiri.
                </p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-12 mb-16">
                    @foreach(['V60 Method Specialist', 'French Press Technique', 'Aeropress Mastery', 'Manual Espresso Guide'] as $method)
                    <div class="flex items-center gap-5 group">
                        <div class="w-1.5 h-1.5 rounded-full bg-mocca shadow-[0_0_12px_rgba(201,168,124,0.6)] group-hover:scale-150 transition-transform"></div>
                        <span class="text-xs font-bold uppercase tracking-[0.15em] text-cream/60 group-hover:text-mocca transition-colors">{{ $method }}</span>
                    </div>
                    @endforeach
                </div>

                <a href="{{ route('contact') }}" class="btn-mocca !px-12 group shadow-xl">
                    <span>Booking Workshop</span>
                    <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="relative reveal" style="transition-delay: 0.2s">
                <div class="grid grid-cols-2 gap-6">
                    <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=2070&auto=format&fit=crop" class="rounded-[3rem] aspect-square object-cover mt-16 shadow-2xl border border-white/5">
                    <img src="https://images.unsplash.com/photo-1511537190424-bbbab87ac5eb?q=80&w=2070&auto=format&fit=crop" class="rounded-[3rem] aspect-square object-cover shadow-2xl border border-white/5">
                </div>
                <div class="absolute -z-10 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-mocca/5 rounded-full blur-[120px]"></div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     4. COWORKING SPACE SECTION
     ═══════════════════════════════════════ --}}
<section id="coworking" class="py-24 bg-dark-deep relative overflow-hidden">
    {{-- Decorative background --}}
    <div class="absolute inset-0 opacity-5 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-2 gap-20 items-center">
            <div class="order-2 lg:order-1 reveal">
                <div class="relative rounded-[3rem] overflow-hidden shadow-2xl border border-white/[0.03] group">
                    <img src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?q=80&w=2070&auto=format&fit=crop" class="w-full h-auto transform group-hover:scale-105 transition-all duration-[2000ms]">
                    <div class="absolute bottom-8 left-8 right-8 p-6 glass rounded-3xl border border-white/10 shadow-2xl">
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-6">
                            <div>
                                <p class="text-[0.65rem] font-bold text-mocca uppercase tracking-[0.2em] mb-1">Coworking Package</p>
                                <p class="text-cream font-bold text-xl">Rp 50.000 <span class="text-xs text-cream/40 font-medium">/ Day</span></p>
                            </div>
                            <span class="badge bg-mocca/20 text-mocca border border-mocca/30 !px-5 !py-1.5 !text-[0.55rem] uppercase tracking-widest">Free Flow Coffee</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="order-1 lg:order-2 reveal" style="transition-delay: 0.2s">
                <p class="section-subtitle">The Workspace</p>
                <h2 class="section-title mb-8">Ruang Kerja <span class="text-mocca italic">Penuh Inspirasi.</span></h2>
                <p class="text-cream/40 text-base leading-relaxed mb-10">
                    Bosan bekerja dari rumah? Area coworking kami dirancang untuk memacu kreativitas dan produktivitas Anda dengan fasilitas modern dan suasana yang menenangkan.
                </p>

                <div class="space-y-8 mb-16">
                    @foreach([
                        ['icon' => '⚡', 'title' => 'Ultra Speed WiFi', 'desc' => 'Koneksi fiber optik stabil untuk menunjang pekerjaan Anda.'],
                        ['icon' => '🔌', 'title' => 'Personal Power Outlets', 'desc' => 'Tersedia di setiap meja untuk kenyamanan perangkat Anda.'],
                        ['icon' => '❄️', 'title' => 'Climate Controlled Space', 'desc' => 'Area sejuk dengan sirkulasi udara yang menyegarkan.'],
                    ] as $f)
                    <div class="flex gap-6 group">
                        <div class="w-14 h-14 rounded-2xl bg-warm border border-white/5 flex items-center justify-center text-2xl group-hover:bg-mocca group-hover:text-dark group-hover:scale-110 transition-all duration-500 shadow-lg">
                            {{ $f['icon'] }}
                        </div>
                        <div>
                            <h4 class="text-cream font-bold text-lg mb-1 group-hover:text-mocca transition-colors">{{ $f['title'] }}</h4>
                            <p class="text-cream/20 text-sm">{{ $f['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <a href="{{ route('reservation.index') }}" class="btn-outline !px-12 group">
                    <span>Amankan Meja</span>
                    <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     5. PRIVATE ROOM SECTION
     ═══════════════════════════════════════ --}}
<section id="private-room" class="py-24 relative bg-dark">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-20 items-center">
            <div class="reveal">
                <p class="section-subtitle">Exclusive Space</p>
                <h2 class="section-title mb-8">Ruang Privat Untuk <span class="text-mocca italic">Momen Eksklusif.</span></h2>
                <p class="text-cream/40 text-base leading-relaxed mb-10">
                    Meeting penting atau acara komunitas? Private room kami menawarkan privasi total dengan dukungan fasilitas audiovisual lengkap dan pelayanan servis prima.
                </p>

                <div class="bg-warm border border-white/5 rounded-[2.5rem] p-10 mb-16 shadow-2xl">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
                        <div>
                            <p class="text-[0.65rem] font-bold text-mocca uppercase tracking-[0.2em] mb-2">Kapasitas</p>
                            <p class="text-cream font-bold text-lg">Hingga 15 Orang</p>
                        </div>
                        <div>
                            <p class="text-[0.65rem] font-bold text-mocca uppercase tracking-[0.2em] mb-2">Fasilitas</p>
                            <p class="text-cream font-bold text-lg">Projector, Audio, AC</p>
                        </div>
                        <div>
                            <p class="text-[0.65rem] font-bold text-mocca uppercase tracking-[0.2em] mb-2">Harga Sewa</p>
                            <p class="text-cream font-bold text-lg">Rp 150k <span class="text-xs text-cream/30 font-medium">/ Jam</span></p>
                        </div>
                        <div>
                            <p class="text-[0.65rem] font-bold text-mocca uppercase tracking-[0.2em] mb-2">Ketersediaan</p>
                            <p class="text-green-400 font-bold text-lg flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                                Booking Required
                            </p>
                        </div>
                    </div>
                </div>

                <a href="{{ route('reservation.index') }}" class="btn-mocca !px-12 group">
                    <span>Reservasi Ruangan</span>
                    <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <div class="reveal" style="transition-delay: 0.2s">
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-6">
                        <img src="https://images.unsplash.com/photo-1431540015161-0bf868a2d407?q=80&w=2070&auto=format&fit=crop" class="rounded-[3rem] w-full h-72 object-cover shadow-2xl border border-white/5">
                        <img src="https://images.unsplash.com/photo-1600508774444-455b8ad70e97?q=80&w=2070&auto=format&fit=crop" class="rounded-[3rem] w-full h-80 object-cover shadow-2xl border border-white/5">
                    </div>
                    <div class="space-y-6 pt-16">
                        <img src="https://images.unsplash.com/photo-1517502848574-33a59336531c?q=80&w=2070&auto=format&fit=crop" class="rounded-[3rem] w-full h-80 object-cover shadow-2xl border border-white/5">
                        <img src="https://images.unsplash.com/photo-1542744094-24638eff58bb?q=80&w=2070&auto=format&fit=crop" class="rounded-[3rem] w-full h-72 object-cover shadow-2xl border border-white/5">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     6. WHY CHOOSE US
     ═══════════════════════════════════════ --}}
<section class="py-24 bg-dark-deep relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 animate-shimmer" style="background-image: radial-gradient(circle at 50% 50%, #C9A87C 0%, transparent 70%)"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <div class="max-w-2xl mx-auto mb-16 reveal">
            <p class="section-subtitle">Experience First</p>
            <h2 class="section-title">Mengapa Filo Coffee?</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach([
                ['icon' => '☕', 'title' => 'Premium Beans', 'desc' => 'Hanya menggunakan biji kopi grade spesialti terbaik Nusantara.'],
                ['icon' => '✨', 'title' => 'Aesthetic Vibe', 'desc' => 'Desain interior premium yang nyaman dan inspiratif.'],
                ['icon' => '🔇', 'title' => 'Quiet Ambience', 'desc' => 'Atmosfer yang tenang untuk fokus kerja dan relaksasi.'],
                ['icon' => '👨‍🍳', 'title' => 'Expert Barista', 'desc' => 'Tim profesional yang berdedikasi menyajikan rasa terbaik.'],
            ] as $i => $reason)
            <div class="bg-warm border border-white/5 rounded-[2rem] p-8 hover:border-mocca/30 transition-all duration-500 reveal group shadow-xl" style="transition-delay: {{ $i * 0.1 }}s">
                <div class="w-14 h-14 bg-dark rounded-2xl flex items-center justify-center text-3xl mb-6 mx-auto group-hover:scale-110 group-hover:bg-mocca group-hover:text-dark transition-all duration-500 shadow-lg">
                    {{ $reason['icon'] }}
                </div>
                <h4 class="text-cream font-bold text-lg mb-3 group-hover:text-mocca transition-colors">{{ $reason['title'] }}</h4>
                <p class="text-cream/30 text-sm leading-relaxed">{{ $reason['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     7. BOOKING CTA SECTION
     ═══════════════════════════════════════ --}}
{{-- ═══════════════════════════════════════
     7. BOOKING CTA SECTION (HOME CTA STYLE)
     ═══════════════════════════════════════ --}}
<section class="relative py-24 overflow-hidden reveal">
    <div class="absolute inset-0 bg-mocca"></div>
    <div class="absolute inset-0 opacity-10 animate-shimmer" style="background-image: radial-gradient(circle at 50% 50%, #1a1815 0%, transparent 70%)"></div>
    
    {{-- Decorative patterns --}}
    <div class="absolute top-0 left-0 w-64 h-64 border border-dark/5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 border border-dark/5 rounded-full translate-x-1/3 translate-y-1/3"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl">
            <h2 class="font-display text-4xl md:text-5xl lg:text-6xl text-dark font-bold leading-tight mb-8">
                Amankan Ruang Anda &<br>
                <span class="italic font-medium">Nikmati Momennya.</span>
            </h2>
            <p class="text-dark/60 text-base md:text-lg leading-relaxed mb-10 max-w-2xl font-medium">
                Jangan lewatkan momen produktif atau pertemuan penting Anda. Pesan tempat Anda sekarang dan nikmati layanan premium Filo Coffee.
            </p>
            <div class="flex flex-wrap gap-10 items-center">
                <a href="{{ route('reservation.index') }}" class="bg-dark text-cream px-10 py-4 rounded-2xl font-bold hover:bg-dark-deep transition-all duration-300 hover:-translate-y-1 shadow-2xl shadow-dark/20 flex items-center gap-3 group">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>Reservasi Meja</span>
                    <svg class="w-4 h-4 transition-transform duration-500 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <div class="flex flex-col">
                    <span class="text-dark/40 text-[0.65rem] font-bold uppercase tracking-[0.3em] mb-1">WhatsApp Order</span>
                    <span class="text-dark font-bold text-xl">+62 812-3456-7890</span>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
