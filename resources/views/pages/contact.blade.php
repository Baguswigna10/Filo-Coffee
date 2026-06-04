@extends('layouts.app')
@section('title', 'Kontak')
@section('meta_description', 'Hubungi Filo Coffee untuk pertanyaan, reservasi khusus, atau sekadar menyapa. Kami siap membantu Anda.')

@section('content')

{{-- ═══════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[50vh] flex items-center bg-dark">
    {{-- Background layers --}}
    <div class="absolute inset-0 opacity-20"
         style="background-image: radial-gradient(circle at 10% 90%, #6B4226 0%, transparent 40%), radial-gradient(circle at 90% 10%, #C9A87C 0%, transparent 40%)">
    </div>
    <div class="absolute right-0 top-0 w-[500px] h-[500px] bg-mocca/10 rounded-full blur-[140px] animate-pulse-glow"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <div class="inline-flex items-center gap-3 mb-8 animate-fade-in-up">
            <span class="w-10 h-px bg-mocca/40"></span>
            <span class="text-mocca text-xs font-bold tracking-[0.3em] uppercase">Connect With Us</span>
            <span class="w-10 h-px bg-mocca/40"></span>
        </div>
        <h1 class="font-display text-5xl md:text-7xl text-cream font-bold leading-tight mb-8 animate-fade-in-up" style="animation-delay: 0.1s">
            Hubungi <span class="text-mocca italic">Kami.</span>
        </h1>
        <p class="text-cream/50 text-base md:text-lg leading-relaxed max-w-2xl mx-auto animate-fade-in-up" style="animation-delay: 0.2s">
            Ada pertanyaan atau sekadar ingin menyapa? Kami selalu siap mendengarkan dan membantu Anda mendapatkan pengalaman terbaik di Filo Coffee.
        </p>
    </div>
</section>

{{-- ═══════════════════════════════════════
     CONTACT CONTENT
     ═══════════════════════════════════════ --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 pb-32">
    <div class="grid lg:grid-cols-12 gap-20 items-start">
        
        {{-- Contact Form Column --}}
        <div class="lg:col-span-7 reveal">
            <div class="bg-warm border border-white/[0.05] rounded-[3rem] p-8 md:p-14 shadow-2xl">
                <div class="flex items-center gap-6 mb-12">
                    <div class="w-16 h-16 bg-dark rounded-2xl flex items-center justify-center text-mocca shadow-xl ring-1 ring-mocca/20">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <h2 class="font-display text-3xl text-cream font-bold">Kirim Pesan</h2>
                        <p class="text-mocca text-[0.65rem] uppercase tracking-[0.2em] font-bold mt-1">Kami Akan Membalas Secepat Mungkin</p>
                    </div>
                </div>

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Nama Lengkap *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="input-field" placeholder="Nama Anda">
                            @error('name')<span class="text-red-400 text-[0.65rem] font-medium ml-1">{{ $message }}</span>@enderror
                        </div>
                        <div class="space-y-3">
                            <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Alamat Email *</label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="input-field" placeholder="nama@email.com">
                            @error('email')<span class="text-red-400 text-[0.65rem] font-medium ml-1">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Subjek *</label>
                        <input type="text" name="subject" value="{{ old('subject') }}" required class="input-field" placeholder="Tuliskan subjek pesan Anda">
                    </div>

                    <div class="space-y-3">
                        <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Pesan Anda *</label>
                        <textarea name="message" rows="6" required class="input-field resize-none" placeholder="Ceritakan apa yang bisa kami bantu..."></textarea>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="btn-mocca w-full justify-center !py-5 !text-lg shadow-2xl shadow-mocca/20 group">
                            <span>Kirim Pesan Sekarang</span>
                            <svg class="w-6 h-6 transition-transform duration-500 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Info Column --}}
        <div class="lg:col-span-5 space-y-10 reveal" style="transition-delay: 0.1s">
            
            {{-- Contact Cards --}}
            <div class="bg-warm border border-white/[0.03] rounded-[2.5rem] p-10 relative overflow-hidden shadow-xl">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-mocca/5 rounded-full blur-3xl"></div>
                <h3 class="font-display text-2xl text-cream font-bold mb-10">Informasi Kontak</h3>
                
                <div class="space-y-8">
                    @php
                    $contactInfos = [
                        ['icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z', 'label' => 'Alamat Kami', 'value' => 'Jl. Kopi Nusantara No. 12, Kebayoran Baru, Jakarta Selatan 12180'],
                        ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'label' => 'Jam Operasional', 'value' => 'Setiap Hari: 08:00 – 22:00 WIB'],
                        ['icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'label' => 'Email Bantuan', 'value' => 'hello@filocoffee.com'],
                        ['icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z', 'label' => 'Layanan Pelanggan', 'value' => '+62 812-3456-7890'],
                    ];
                    @endphp

                    @foreach($contactInfos as $info)
                    <div class="flex items-start gap-6 group">
                        <div class="w-12 h-12 bg-dark rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-mocca group-hover:text-dark transition-all duration-500 shadow-lg">
                            <svg class="w-5 h-5 text-mocca group-hover:text-dark transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $info['icon'] }}"/></svg>
                        </div>
                        <div class="pt-2">
                            <div class="text-mocca text-[0.65rem] font-bold uppercase tracking-[0.2em] mb-1">{{ $info['label'] }}</div>
                            <div class="text-cream/40 text-sm leading-relaxed group-hover:text-cream transition-colors duration-500">{{ $info['value'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- WhatsApp Card --}}
            <a href="https://wa.me/6281234567890" target="_blank"
               class="group relative bg-[#25D366]/[0.05] border border-[#25D366]/10 rounded-[2rem] p-8 flex items-center gap-6 hover:border-[#25D366]/40 transition-all duration-500 shadow-xl">
                <div class="w-16 h-16 bg-[#25D366] text-white rounded-2xl flex items-center justify-center shadow-2xl shadow-[#25D366]/30 transition-transform duration-500 group-hover:scale-110">
                    <svg class="w-9 h-9" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="text-cream text-lg font-bold leading-tight mb-1">WhatsApp Order</h4>
                    <p class="text-cream/30 text-sm">Respon cepat dalam hitungan menit.</p>
                </div>
                <div class="ml-auto w-10 h-10 rounded-full border border-[#25D366]/20 flex items-center justify-center text-[#25D366] group-hover:bg-[#25D366] group-hover:text-dark transition-all duration-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </div>
            </a>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     MAP SECTION
     ═══════════════════════════════════════ --}}
<section class="reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-32">
        <div class="relative group bg-warm border border-white/[0.05] rounded-[3.5rem] overflow-hidden shadow-2xl">
            {{-- Google Map --}}
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.846563710262!2d107.74544387463517!3d-7.027314892974451!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68c15f4992ad9b%3A0x1e5019f1a3b014c4!2sFilo%20coffee!5e0!3m2!1sid!2sid!4v1772018581660!5m2!1sid!2sid"
                width="100%"
                height="500"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            
            <div class="absolute inset-0 pointer-events-none ring-1 ring-inset ring-white/10 rounded-[3.5rem]"></div>
            
            {{-- Map Info Box Overlay --}}
            <div class="absolute bottom-10 right-10 left-10 md:left-auto md:w-96 bg-dark/90 backdrop-blur-xl border border-white/10 p-8 rounded-[2rem] shadow-2xl animate-fade-in-up">
                <div class="flex items-start gap-6">
                    <div class="w-14 h-14 bg-mocca/10 rounded-2xl flex items-center justify-center text-mocca shadow-lg">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-cream text-sm font-bold uppercase tracking-[0.2em] mb-2">Lokasi Kami</h4>
                        <p class="text-cream/40 text-sm leading-relaxed mb-6">Samping SMK BAKTI, Jl. Anyar, KENCANA, Kec. Majalaya, Kabupaten Bandung, Jawa Barat 40382</p>
                        <a href="https://maps.google.com" target="_blank" class="inline-flex items-center gap-2 text-mocca text-[0.7rem] font-bold uppercase tracking-[0.3em] hover:text-mocca-light transition-colors group/map">
                            <span>Get Directions</span>
                            <svg class="w-4 h-4 transition-transform group-hover/map:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
