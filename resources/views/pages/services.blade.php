@extends('layouts.app')
@section('title', 'Layanan Kami')
@section('meta_description', 'Filo Coffee menawarkan lebih dari sekadar kopi. Nikmati layanan Home Brewing, Coworking Space, dan Private Room eksklusif.')

@section('content')

{{-- ═══════════════════════════════════════
     1. HERO SECTION
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[50vh] flex items-center bg-beige-50">
    {{-- Decorative Background --}}
    <div class="absolute inset-0 opacity-50 pointer-events-none"
         style="background-image: radial-gradient(circle at 15% 15%, #CFDAD0 0%, transparent 40%), radial-gradient(circle at 85% 85%, #E6DCCF 0%, transparent 40%)">
    </div>
    <div class="absolute right-[-5%] top-1/3 w-[450px] h-[450px] bg-olive-200/30 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute left-[-5%] bottom-0 w-80 h-80 bg-beige-200/50 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 z-10">
        <div class="max-w-3xl animate-fade-in-up">
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-8 h-[1.5px] bg-olive-500"></span>
                <span class="text-olive-700 text-xs font-bold tracking-[0.25em] uppercase">Beyond The Cup</span>
            </div>
            <h1 class="font-display text-5xl md:text-7xl text-olive-900 font-bold leading-[1.05] mb-8">
                Lebih Dari<br>
                <span class="text-beige-600 italic font-semibold">Sekadar Kopi.</span>
            </h1>
            <p class="text-olive-800/70 text-lg md:text-xl leading-relaxed mb-12 max-w-2xl">
                Filo Coffee menghadirkan ruang kolaborasi, edukasi seduh mandiri, dan area pertemuan eksklusif yang dirancang untuk mendukung gaya hidup modern Anda.
            </p>
            <div class="flex flex-wrap items-center gap-4">
                <a href="#services-overview" class="bg-olive-800 text-beige-50 hover:bg-olive-900 px-8 py-4 rounded-2xl font-bold transition-all duration-300 shadow-lg shadow-olive-900/20 inline-flex items-center gap-2 group">
                    <span>Eksplor Layanan</span>
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </a>
                <a href="{{ route('reservation.index') }}" class="border border-olive-800/30 text-olive-900 hover:bg-olive-800 hover:text-beige-50 px-8 py-3 rounded-2xl font-bold transition-all duration-300 inline-flex items-center gap-2">
                    <span>Reservasi Sekarang</span>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     2. SERVICES OVERVIEW
     ═══════════════════════════════════════ --}}
<section id="services-overview" class="py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 reveal">
            <span class="inline-block text-olive-600 text-xs font-bold tracking-[0.25em] uppercase mb-4">Our Specialization</span>
            <h2 class="font-display text-4xl md:text-5xl text-olive-900 font-bold">Layanan Unggulan Kami</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                [
                    'img' => 'https://images.unsplash.com/photo-1544787210-282aa065362e?q=80&w=1974&auto=format&fit=crop',
                    'tag' => 'Education',
                    'title' => 'Home Brewing',
                    'desc' => 'Pelajari seni menyeduh kopi manual di rumah dengan bimbingan barista profesional kami.',
                    'link' => '#home-brewing'
                ],
                [
                    'img' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069&auto=format&fit=crop',
                    'tag' => 'Workspace',
                    'title' => 'Coworking Space',
                    'desc' => 'Area kerja produktif dengan WiFi kencang, suasana tenang, dan kopi tak terbatas.',
                    'link' => '#coworking'
                ],
                [
                    'img' => 'https://images.unsplash.com/photo-1600508774444-455b8ad70e97?q=80&w=2070&auto=format&fit=crop',
                    'tag' => 'Exclusive',
                    'title' => 'Private Room',
                    'desc' => 'Ruangan eksklusif untuk meeting, acara privat, atau sesi gaming intens bersama teman.',
                    'link' => '#private-room'
                ]
            ] as $i => $s)
            <div class="group relative overflow-hidden rounded-3xl shadow-lg hover:shadow-2xl hover:shadow-olive-900/15 transition-all duration-700 reveal" style="transition-delay: {{ $i * 0.1 }}s">
                <div class="aspect-[3/4] overflow-hidden">
                    <img src="{{ $s['img'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-1000">
                </div>
                {{-- Gradient Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-olive-950 via-olive-900/40 to-transparent"></div>
                {{-- Tag --}}
                <div class="absolute top-6 left-6">
                    <span class="bg-white/20 backdrop-blur-sm text-white text-[0.65rem] font-bold tracking-[0.25em] uppercase px-3 py-1.5 rounded-full border border-white/30">{{ $s['tag'] }}</span>
                </div>
                {{-- Content --}}
                <div class="absolute inset-0 p-8 flex flex-col justify-end">
                    <h3 class="font-display text-2xl text-white font-bold mb-3 group-hover:text-beige-200 transition-colors duration-500">{{ $s['title'] }}</h3>
                    <p class="text-white/60 text-sm leading-relaxed mb-6 opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                        {{ $s['desc'] }}
                    </p>
                    <a href="{{ $s['link'] }}" class="text-beige-300 text-[0.7rem] font-bold uppercase tracking-[0.25em] inline-flex items-center gap-3 group/btn">
                        <span>Selengkapnya</span>
                        <span class="w-8 h-px bg-beige-300/50 group-hover/btn:w-14 group-hover/btn:bg-beige-300 transition-all duration-500"></span>
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
<section id="home-brewing" class="py-28 bg-beige-50 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-20 items-center">
            <div class="reveal">
                <span class="inline-block text-olive-600 text-xs font-bold tracking-[0.25em] uppercase mb-4">Art of Brewing</span>
                <h2 class="font-display text-4xl md:text-5xl text-olive-900 font-bold leading-tight mb-8">
                    Jadilah Barista <span class="text-beige-600 italic">Bagi Diri Sendiri.</span>
                </h2>
                <p class="text-olive-800/70 text-lg leading-relaxed mb-10">
                    Seni menyeduh kopi bukan hanya tentang rasa, tapi tentang proses. Kami menyediakan workshop mendalam mengenai berbagai metode seduh manual agar Anda bisa menikmati kopi berkualitas cafe di rumah sendiri.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-12">
                    @foreach(['V60 Method Specialist', 'French Press Technique', 'Aeropress Mastery', 'Manual Espresso Guide'] as $method)
                    <div class="flex items-center gap-3 group p-3 rounded-xl hover:bg-olive-50 transition-colors">
                        <div class="w-2 h-2 rounded-full bg-olive-500 shadow-sm group-hover:scale-150 transition-transform flex-shrink-0"></div>
                        <span class="text-sm font-semibold text-olive-800 group-hover:text-olive-900 transition-colors">{{ $method }}</span>
                    </div>
                    @endforeach
                </div>

                <a href="{{ route('contact') }}" class="bg-olive-800 text-beige-50 hover:bg-olive-900 px-8 py-4 rounded-2xl font-bold transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg shadow-olive-900/20 inline-flex items-center gap-2 group">
                    <span>Booking Workshop</span>
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="relative reveal" style="transition-delay: 0.2s">
                <div class="grid grid-cols-2 gap-5">
                    <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=2070&auto=format&fit=crop" class="rounded-3xl aspect-square object-cover mt-16 shadow-xl ring-1 ring-olive-900/5">
                    <img src="https://images.unsplash.com/photo-1511537190424-bbbab87ac5eb?q=80&w=2070&auto=format&fit=crop" class="rounded-3xl aspect-square object-cover shadow-xl ring-1 ring-olive-900/5">
                </div>
                {{-- Decorative badge --}}
                <div class="absolute -bottom-6 -left-6 bg-white border border-beige-200 rounded-2xl p-5 shadow-xl">
                    <div class="text-2xl font-display font-bold text-olive-900">12+</div>
                    <div class="text-olive-600 text-[0.65rem] font-bold tracking-widest uppercase mt-0.5">Workshop/Bulan</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     4. COWORKING SPACE SECTION
     ═══════════════════════════════════════ --}}
<section id="coworking" class="py-28 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-20 items-center">
            {{-- Image --}}
            <div class="order-2 lg:order-1 reveal">
                <div class="relative rounded-3xl overflow-hidden shadow-xl ring-1 ring-olive-900/5 group">
                    <img src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?q=80&w=2070&auto=format&fit=crop" class="w-full h-auto transform group-hover:scale-105 transition-all duration-[2000ms]">
                    {{-- Glass Info Badge --}}
                    <div class="absolute bottom-6 left-6 right-6 p-5 bg-white/80 backdrop-blur-md border border-white/60 rounded-2xl shadow-lg">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-olive-600 text-[0.65rem] font-bold uppercase tracking-[0.2em] mb-1">Coworking Package</p>
                                <p class="text-olive-900 font-bold text-xl">Rp 50.000 <span class="text-xs text-olive-500 font-medium">/ Day</span></p>
                            </div>
                            <span class="bg-olive-100 text-olive-700 text-[0.6rem] font-bold px-4 py-1.5 rounded-full uppercase tracking-widest border border-olive-200">Free Flow Coffee</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Text --}}
            <div class="order-1 lg:order-2 reveal" style="transition-delay: 0.2s">
                <span class="inline-block text-olive-600 text-xs font-bold tracking-[0.25em] uppercase mb-4">The Workspace</span>
                <h2 class="font-display text-4xl md:text-5xl text-olive-900 font-bold leading-tight mb-8">
                    Ruang Kerja <span class="text-beige-600 italic">Penuh Inspirasi.</span>
                </h2>
                <p class="text-olive-800/70 text-lg leading-relaxed mb-10">
                    Bosan bekerja dari rumah? Area coworking kami dirancang untuk memacu kreativitas dan produktivitas Anda dengan fasilitas modern dan suasana yang menenangkan.
                </p>

                <div class="space-y-6 mb-12">
                    @foreach([
                        ['icon' => '⚡', 'title' => 'Ultra Speed WiFi', 'desc' => 'Koneksi fiber optik stabil untuk menunjang pekerjaan Anda.'],
                        ['icon' => '🔌', 'title' => 'Personal Power Outlets', 'desc' => 'Tersedia di setiap meja untuk kenyamanan perangkat Anda.'],
                        ['icon' => '❄️', 'title' => 'Climate Controlled Space', 'desc' => 'Area sejuk dengan sirkulasi udara yang menyegarkan.'],
                    ] as $f)
                    <div class="flex gap-5 group">
                        <div class="w-12 h-12 rounded-2xl bg-olive-50 border border-olive-200 flex items-center justify-center text-xl group-hover:bg-olive-800 group-hover:text-white group-hover:border-olive-800 transition-all duration-500 flex-shrink-0 shadow-sm">
                            {{ $f['icon'] }}
                        </div>
                        <div>
                            <h4 class="text-olive-900 font-bold text-base mb-1 group-hover:text-olive-700 transition-colors">{{ $f['title'] }}</h4>
                            <p class="text-olive-600 text-sm">{{ $f['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <a href="{{ route('reservation.index') }}" class="border-2 border-olive-800 text-olive-900 hover:bg-olive-800 hover:text-beige-50 px-8 py-3.5 rounded-2xl font-bold transition-all duration-300 transform hover:-translate-y-0.5 inline-flex items-center gap-2 group">
                    <span>Amankan Meja</span>
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     5. PRIVATE ROOM SECTION
     ═══════════════════════════════════════ --}}
<section id="private-room" class="py-28 bg-beige-50 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-20 items-center">
            <div class="reveal">
                <span class="inline-block text-olive-600 text-xs font-bold tracking-[0.25em] uppercase mb-4">Exclusive Space</span>
                <h2 class="font-display text-4xl md:text-5xl text-olive-900 font-bold leading-tight mb-8">
                    Ruang Privat Untuk <span class="text-beige-600 italic">Momen Eksklusif.</span>
                </h2>
                <p class="text-olive-800/70 text-lg leading-relaxed mb-10">
                    Meeting penting atau acara komunitas? Private room kami menawarkan privasi total dengan dukungan fasilitas audiovisual lengkap dan pelayanan servis prima.
                </p>

                {{-- Info Card --}}
                <div class="bg-white border border-beige-200 rounded-3xl p-8 mb-10 shadow-sm grid grid-cols-2 gap-8">
                    <div>
                        <p class="text-olive-500 text-[0.65rem] font-bold uppercase tracking-[0.2em] mb-2">Kapasitas</p>
                        <p class="text-olive-900 font-bold text-lg">Hingga 15 Orang</p>
                    </div>
                    <div>
                        <p class="text-olive-500 text-[0.65rem] font-bold uppercase tracking-[0.2em] mb-2">Fasilitas</p>
                        <p class="text-olive-900 font-bold text-lg">Proyektor, Audio, AC</p>
                    </div>
                    <div>
                        <p class="text-olive-500 text-[0.65rem] font-bold uppercase tracking-[0.2em] mb-2">Harga Sewa</p>
                        <p class="text-olive-900 font-bold text-lg">Rp 150k <span class="text-sm text-olive-500 font-medium">/ Jam</span></p>
                    </div>
                    <div>
                        <p class="text-olive-500 text-[0.65rem] font-bold uppercase tracking-[0.2em] mb-2">Ketersediaan</p>
                        <p class="text-green-700 font-bold text-lg flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                            Booking Required
                        </p>
                    </div>
                </div>

                <a href="{{ route('reservation.index') }}" class="bg-olive-800 text-beige-50 hover:bg-olive-900 px-8 py-4 rounded-2xl font-bold transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg shadow-olive-900/20 inline-flex items-center gap-2 group">
                    <span>Reservasi Ruangan</span>
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <div class="reveal" style="transition-delay: 0.2s">
                <div class="grid grid-cols-2 gap-5">
                    <div class="space-y-5">
                        <img src="https://images.unsplash.com/photo-1431540015161-0bf868a2d407?q=80&w=2070&auto=format&fit=crop" class="rounded-3xl w-full h-56 object-cover shadow-lg ring-1 ring-olive-900/5">
                        <img src="https://images.unsplash.com/photo-1600508774444-455b8ad70e97?q=80&w=2070&auto=format&fit=crop" class="rounded-3xl w-full h-64 object-cover shadow-lg ring-1 ring-olive-900/5">
                    </div>
                    <div class="space-y-5 pt-14">
                        <img src="https://images.unsplash.com/photo-1517502848574-33a59336531c?q=80&w=2070&auto=format&fit=crop" class="rounded-3xl w-full h-64 object-cover shadow-lg ring-1 ring-olive-900/5">
                        <img src="https://images.unsplash.com/photo-1542744094-24638eff58bb?q=80&w=2070&auto=format&fit=crop" class="rounded-3xl w-full h-56 object-cover shadow-lg ring-1 ring-olive-900/5">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     6. WHY CHOOSE US
     ═══════════════════════════════════════ --}}
<section class="py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="max-w-2xl mx-auto mb-16 reveal">
            <span class="inline-block text-olive-600 text-xs font-bold tracking-[0.25em] uppercase mb-4">Experience First</span>
            <h2 class="font-display text-4xl md:text-5xl text-olive-900 font-bold">Mengapa Filo Coffee?</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['icon' => '☕', 'title' => 'Premium Beans', 'desc' => 'Hanya menggunakan biji kopi grade spesialti terbaik Nusantara.'],
                ['icon' => '✨', 'title' => 'Aesthetic Vibe', 'desc' => 'Desain interior premium yang nyaman dan inspiratif.'],
                ['icon' => '🔇', 'title' => 'Quiet Ambience', 'desc' => 'Atmosfer yang tenang untuk fokus kerja dan relaksasi.'],
                ['icon' => '👨‍🍳', 'title' => 'Expert Barista', 'desc' => 'Tim profesional yang berdedikasi menyajikan rasa terbaik.'],
            ] as $i => $reason)
            <div class="bg-beige-50 border border-beige-200 rounded-3xl p-8 hover:border-olive-400 hover:bg-olive-50 hover:shadow-lg hover:-translate-y-1 transition-all duration-500 reveal group" style="transition-delay: {{ $i * 0.1 }}s">
                <div class="w-14 h-14 bg-white border border-beige-200 rounded-2xl flex items-center justify-center text-3xl mb-6 mx-auto group-hover:bg-olive-800 group-hover:border-olive-800 transition-all duration-500 shadow-sm">
                    {{ $reason['icon'] }}
                </div>
                <h4 class="text-olive-900 font-bold text-lg mb-3 group-hover:text-olive-700 transition-colors">{{ $reason['title'] }}</h4>
                <p class="text-olive-600 text-sm leading-relaxed">{{ $reason['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
