@extends('layouts.app')
@section('title', 'Tentang Filo Coffee | Modern Specialty Roasters')
@section('meta_description', 'Kisah dedikasi Filo Coffee dalam menghadirkan kemewahan cita rasa biji kopi Nusantara dan kehangatan ruang temu modern.')

@section('content')

{{-- ═══════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[60vh] flex items-center bg-beige-50">
    {{-- Decorative Background Layers --}}
    <div class="absolute inset-0 opacity-50 pointer-events-none"
         style="background-image: radial-gradient(circle at 15% 15%, #CFDAD0 0%, transparent 40%), radial-gradient(circle at 85% 85%, #E6DCCF 0%, transparent 40%)">
    </div>
    <div class="absolute right-[-5%] top-1/4 w-[500px] h-[500px] bg-olive-200/30 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute left-[-5%] bottom-0 w-80 h-80 bg-beige-200/50 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 z-10">
        <div class="inline-flex items-center gap-3 mb-6 animate-fade-in-up">
            <span class="w-8 h-[1.5px] bg-olive-500"></span>
            <span class="text-olive-700 text-xs font-bold tracking-[0.25em] uppercase">Warisan Dedikasi</span>
        </div>
        <h1 class="font-display text-5xl md:text-7xl text-olive-900 font-bold leading-[1.05] mb-8 animate-fade-in-up">
            Lebih dari Sekadar<br>
            <span class="text-beige-600 italic font-semibold font-display">Secangkir Kopi.</span>
        </h1>
        <p class="text-olive-800/80 text-lg md:text-xl leading-relaxed max-w-2xl animate-fade-in-up" style="animation-delay: 0.1s">
            Filo Coffee lahir dari kecintaan mendalam terhadap kekayaan alam Indonesia, berakar dari komitmen untuk menyajikan cita rasa biji kopi sangrai terbaik dan ruang temu yang bermakna bagi setiap patron kami.
        </p>
    </div>
</section>

{{-- ═══════════════════════════════════════
     STORY SECTION
     ═══════════════════════════════════════ --}}
<section class="bg-beige-100 py-24 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            {{-- Story text --}}
            <div class="reveal">
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-5 h-[1px] bg-olive-500"></span>
                    <span class="text-olive-600 text-xs font-bold uppercase tracking-[0.2em]">Kisah Kami</span>
                </div>
                <h2 class="font-display text-4xl md:text-5xl text-olive-900 font-bold mb-6">
                    Menjaga Kemurnian Rasa Dari Kebun Nusantara.
                </h2>
                <div class="space-y-6 text-olive-800/70 text-base leading-relaxed">
                    <p>
                        Sejak pintu pertama kami dibuka, kami berdedikasi melacak asal-usul biji kopi terbaik Nusantara secara langsung dari tangan para petani berdedikasi tinggi — mulai dari aroma floral basah khas pegunungan Aceh Gayo hingga kompleksitas rasa manis cokelat bumi Flores.
                    </p>
                    <p>
                        Setiap lot biji kopi disortir dengan ketat dan dipanggang secara presisi di fasilitas *roastery* internal kami, demi memastikan keunikan profil rasa yang jujur, seimbang, dan konsisten menemani ritual pagi Anda.
                    </p>
                </div>

                {{-- Stats grid --}}
                <div class="grid grid-cols-2 gap-8 mt-12 pt-10 border-t border-olive-900/10">
                    @foreach([
                        ['value' => '2019', 'label' => 'Tahun Berdiri'],
                        ['value' => '12+', 'label' => 'Mitra Tani Lokal'],
                        ['value' => '85+', 'label' => 'Skor Cupping Min.'],
                        ['value' => '4.9★', 'label' => 'Ulasan Penikmat Kopi'],
                    ] as $stat)
                    <div>
                        <div class="font-display text-3xl font-bold text-olive-900">{{ $stat['value'] }}</div>
                        <div class="text-olive-500 text-[0.65rem] mt-2 font-bold uppercase tracking-wider">{{ $stat['label'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Large visual photography --}}
            <div class="relative reveal" style="transition-delay: 0.2s">
                <div class="absolute -inset-10 bg-olive-200/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="relative rounded-[3.5rem] overflow-hidden shadow-2xl shadow-olive-900/10 border border-olive-900/5 h-[550px] group">
                    {{-- Parallax Element --}}
                    <div class="parallax-element absolute inset-0 -top-[20%] -bottom-[20%] w-full h-[140%] z-0 will-change-transform" data-speed="0.12">
                        <img src="{{ asset('images/premium_cafe_hero.png') }}" alt="Filo Cafe Ambience" class="w-full h-full object-cover transform duration-1000 group-hover:scale-103">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-olive-950/40 via-transparent to-transparent opacity-60 z-10 pointer-events-none"></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     TIMELINE (MILSTONES)
     ═══════════════════════════════════════ --}}
<section class="bg-white py-24 overflow-hidden">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-24 reveal">
            <div class="inline-flex items-center gap-2 mb-4">
                <span class="w-5 h-[1px] bg-olive-500"></span>
                <span class="text-olive-600 text-xs font-bold uppercase tracking-[0.2em]">Tonggak Sejarah</span>
                <span class="w-5 h-[1px] bg-olive-500"></span>
            </div>
            <h2 class="font-display text-4xl md:text-5xl text-olive-900 font-bold">Langkah Perjalanan Kami</h2>
        </div>

        <div class="relative">
            {{-- Vertical line --}}
            <div class="absolute left-1/2 top-0 bottom-0 w-px bg-gradient-to-b from-olive-800/20 via-olive-800/10 to-transparent hidden md:block"></div>

            <div class="space-y-20">
                @php
                $timeline = [
                    ['year' => '2019', 'title' => 'Pertama Kali Berdiri', 'desc' => 'Filo resmi membuka bar espresso pertamanya di kawasan Jakarta Selatan dengan visi mengangkat cita rasa biji kopi single origin pegunungan Nusantara.', 'side' => 'left'],
                    ['year' => '2020', 'title' => 'Roastery & Lab Mandiri', 'desc' => 'Guna mengontrol kualitas rasa secara mutlak, kami meluncurkan mesin sangrai premium kami sendiri serta laboratorium cupping bersertifikasi.', 'side' => 'right'],
                    ['year' => '2022', 'title' => 'VIP Lounge & PlayStation Suite', 'desc' => 'Menghadirkan kenyamanan maksimal dengan meluncurkan bilik gaming PlayStation 5 ber-AC kedap suara serta ruang kerja tenang yang cozy.', 'side' => 'left'],
                    ['year' => '2024', 'title' => 'Reservasi Instan & Filo Privilege', 'desc' => 'Mentransformasikan operasional layanan dengan reservasi meja dinamis, booking slot gaming online, serta program loyalitas Filo Club.', 'side' => 'right'],
                ];
                @endphp

                @foreach($timeline as $i => $event)
                <div class="relative grid md:grid-cols-2 gap-12 md:gap-20 items-center reveal" style="transition-delay: {{ $i * 0.1 }}s">
                    @if($event['side'] === 'left')
                    <div class="md:text-right">
                        <div class="text-olive-700 font-display text-3xl font-bold mb-2">{{ $event['year'] }}</div>
                        <h3 class="text-olive-900 font-bold text-xl mb-3">{{ $event['title'] }}</h3>
                        <p class="text-olive-800/60 text-sm leading-relaxed">{{ $event['desc'] }}</p>
                    </div>
                    <div class="hidden md:flex absolute left-1/2 -translate-x-1/2 w-4 h-4 bg-olive-700 rounded-full z-10 shadow-[0_0_15px_rgba(70,93,72,0.4)]"></div>
                    <div class="hidden md:block"></div>
                    @else
                    <div class="hidden md:block"></div>
                    <div class="hidden md:flex absolute left-1/2 -translate-x-1/2 w-4 h-4 bg-olive-700 rounded-full z-10 shadow-[0_0_15px_rgba(70,93,72,0.4)]"></div>
                    <div class="md:text-left">
                        <div class="text-olive-700 font-display text-3xl font-bold mb-2">{{ $event['year'] }}</div>
                        <h3 class="text-olive-900 font-bold text-xl mb-3">{{ $event['title'] }}</h3>
                        <p class="text-olive-800/60 text-sm leading-relaxed">{{ $event['desc'] }}</p>
                    </div>
                    @endif
                    
                    {{-- Mobile indicator --}}
                    <div class="md:hidden flex items-center gap-4 -mt-8">
                        <div class="w-3 h-3 bg-olive-700 rounded-full shadow-[0_0_10px_rgba(70,93,72,0.3)]"></div>
                        <span class="text-olive-700 font-bold text-xl">{{ $event['year'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Parallax Scroll Effect for Background
        const parallaxElements = document.querySelectorAll('.parallax-element');
        let ticking = false;
        
        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    parallaxElements.forEach(el => {
                        const speed = parseFloat(el.getAttribute('data-speed')) || 0.12;
                        const rect = el.parentElement.getBoundingClientRect();
                        const centerOffset = (rect.top + rect.height / 2) - (window.innerHeight / 2);
                        const yPos = centerOffset * speed;
                        el.style.transform = `translateY(${yPos}px)`;
                    });
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });
        
        window.dispatchEvent(new Event('scroll'));

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
