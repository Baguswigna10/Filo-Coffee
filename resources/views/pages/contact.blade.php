@extends('layouts.app')
@section('title', 'Hubungi Kami | Filo Coffee')
@section('meta_description', 'Hubungi Filo Coffee untuk pertanyaan, reservasi khusus, atau sekadar menyapa. Kami siap membantu Anda.')

@section('content')

{{-- ═══════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[50vh] flex items-center bg-beige-50">
    {{-- Decorative Background --}}
    <div class="absolute inset-0 opacity-50 pointer-events-none"
         style="background-image: radial-gradient(circle at 15% 15%, #CFDAD0 0%, transparent 40%), radial-gradient(circle at 85% 85%, #E6DCCF 0%, transparent 40%)">
    </div>
    <div class="absolute right-[-5%] top-0 w-[500px] h-[500px] bg-olive-200/30 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="absolute left-[-5%] bottom-0 w-80 h-80 bg-beige-200/50 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 z-10">
        <div class="max-w-3xl animate-fade-in-up">
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-8 h-[1.5px] bg-olive-500"></span>
                <span class="text-olive-700 text-xs font-bold tracking-[0.25em] uppercase">Beyond The Cup</span>
            </div>
            <h1 class="font-display text-5xl md:text-7xl text-olive-900 font-bold leading-[1.05] mb-8">
                Hubungi
                <span class="text-beige-600 italic font-semibold">Kami.</span>
            </h1>
            <p class="text-olive-800/70 text-lg md:text-xl leading-relaxed mb-12 max-w-2xl">
                Ada pertanyaan atau sekadar ingin menyapa? Kami selalu siap mendengarkan dan membantu Anda mendapatkan pengalaman terbaik di Filo Coffee.
            </p>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     CONTACT CONTENT
     ═══════════════════════════════════════ --}}
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 pb-28">
        <div class="grid lg:grid-cols-12 gap-14 items-start">

            {{-- CONTACT FORM --}}
            <div class="lg:col-span-7 reveal">
                <div class="bg-beige-50 border border-beige-200 rounded-2xl p-8 md:p-12 shadow-lg shadow-olive-900/5">
                    <div class="flex items-center gap-5 mb-10">
                        <div class="w-14 h-14 bg-olive-800 rounded-2xl flex items-center justify-center text-beige-50 shadow-lg">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <h2 class="font-display text-2xl text-olive-900 font-bold">Kirim Pesan</h2>
                            <p class="text-olive-500 text-[0.65rem] uppercase tracking-[0.2em] font-bold mt-0.5">Kami Akan Membalas Secepat Mungkin</p>
                        </div>
                    </div>

                    @if(session('success'))
                    <div class="mb-8 p-5 bg-green-50 border border-green-200 rounded-2xl flex items-center gap-4">
                        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center text-green-600 flex-shrink-0 font-bold">✓</div>
                        <p class="text-green-800 font-semibold text-sm">{{ session('success') }}</p>
                    </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-7">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Nama Lengkap *</label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                       class="w-full bg-white border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 placeholder:text-olive-300 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium"
                                       placeholder="Nama Anda">
                                @error('name')<span class="text-red-500 text-xs font-medium ml-1">{{ $message }}</span>@enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Alamat Email *</label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                       class="w-full bg-white border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 placeholder:text-olive-300 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium"
                                       placeholder="nama@email.com">
                                @error('email')<span class="text-red-500 text-xs font-medium ml-1">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Subjek *</label>
                            <input type="text" name="subject" value="{{ old('subject') }}" required
                                   class="w-full bg-white border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 placeholder:text-olive-300 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium"
                                   placeholder="Tuliskan subjek pesan Anda">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Pesan Anda *</label>
                            <textarea name="message" rows="6" required
                                      class="w-full bg-white border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 placeholder:text-olive-300 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium resize-none"
                                      placeholder="Ceritakan apa yang bisa kami bantu..."></textarea>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full bg-olive-800 text-beige-50 hover:bg-olive-900 py-4 rounded-2xl font-bold transition-all duration-300 hover:-translate-y-0.5 shadow-lg shadow-olive-900/20 flex items-center justify-center gap-3 group text-base">
                                <span>Kirim Pesan Sekarang</span>
                                <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- SIDEBAR --}}
            <div class="lg:col-span-5 space-y-8 reveal" style="transition-delay: 0.1s">

                {{-- Contact Info --}}
                <div class="bg-beige-50 border border-beige-200 rounded-2xl p-8 relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-olive-100/50 rounded-full blur-2xl pointer-events-none"></div>
                    <h3 class="font-display text-xl text-olive-900 font-bold mb-8 relative">Informasi Kontak</h3>

                    <div class="space-y-6 relative">
                        @php
                        $contactInfos = [
                            ['icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z', 'label' => 'Alamat Kami', 'value' => 'Depan SMK BAKTI, Jl. Anyar, KENCANA, Kec. Majalaya, Kabupaten Bandung, Jawa Barat 40382'],
                            ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'label' => 'Jam Operasional', 'value' => 'Setiap Hari: 12:00 – 23:00 WIB'],
                            ['icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'label' => 'Email Bantuan', 'value' => 'filocoffee@gmail.com'],
                            ['icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z', 'label' => 'Layanan Pelanggan', 'value' => '+62 812-3456-7890'],
                        ];
                        @endphp

                        @foreach($contactInfos as $info)
                        <div class="flex items-start gap-5 group">
                            <div class="w-11 h-11 bg-olive-100 border border-olive-200 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-olive-800 group-hover:text-beige-50 group-hover:border-olive-800 transition-all duration-500">
                                <svg class="w-5 h-5 text-olive-600 group-hover:text-beige-50 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $info['icon'] }}"/></svg>
                            </div>
                            <div class="pt-1">
                                <div class="text-olive-500 text-[0.65rem] font-bold uppercase tracking-[0.2em] mb-1">{{ $info['label'] }}</div>
                                <div class="text-olive-800 text-sm leading-relaxed font-medium group-hover:text-olive-900 transition-colors">{{ $info['value'] }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- WhatsApp CTA --}}
                <a href="https://wa.me/6281234567890" target="_blank"
                   class="group relative bg-green-50 border border-green-200 rounded-2xl p-7 flex items-center gap-5 hover:border-green-400 hover:shadow-lg transition-all duration-500">
                    <div class="w-14 h-14 bg-[#25D366] text-white rounded-2xl flex items-center justify-center shadow-lg shadow-[#25D366]/20 transition-transform duration-500 group-hover:scale-110 flex-shrink-0">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-olive-900 text-base font-bold leading-tight mb-1">WhatsApp Order</h4>
                        <p class="text-olive-500 text-sm">Respon cepat dalam hitungan menit.</p>
                    </div>
                    <div class="ml-auto w-10 h-10 rounded-full border border-green-300 flex items-center justify-center text-green-600 group-hover:bg-[#25D366] group-hover:text-white group-hover:border-[#25D366] transition-all duration-500 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     MAP SECTION
     ═══════════════════════════════════════ --}}
<section class="bg-beige-50 reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="relative group bg-white border border-beige-200 rounded-[2.5rem] overflow-hidden shadow-xl shadow-olive-900/5">
            {{-- Google Map --}}
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.846563710262!2d107.74544387463517!3d-7.027314892974451!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68c15f4992ad9b%3A0x1e5019f1a3b014c4!2sFilo%20coffee!5e0!3m2!1sid!2sid!4v1772018581660!5m2!1sid!2sid"
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>

            {{-- Inner ring overlay --}}
            <div class="absolute inset-0 pointer-events-none ring-1 ring-inset ring-olive-900/5 rounded-[2.5rem]"></div>

            {{-- Map Info Overlay --}}
            <div class="absolute bottom-8 right-8 left-8 md:left-auto md:w-96 bg-white/90 backdrop-blur-xl border border-beige-200 p-7 rounded-2xl shadow-xl">
                <div class="flex items-start gap-5">
                    <div class="w-12 h-12 bg-olive-100 border border-olive-200 rounded-xl flex items-center justify-center text-olive-700 shadow-sm flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-olive-900 text-sm font-bold uppercase tracking-[0.15em] mb-2">Lokasi Kami</h4>
                        <p class="text-olive-600 text-sm leading-relaxed mb-4">Samping SMK BAKTI, Jl. Anyar, KENCANA, Kec. Majalaya, Kabupaten Bandung, Jawa Barat 40382</p>
                        <a href="https://maps.google.com" target="_blank" class="inline-flex items-center gap-2 text-olive-800 text-[0.7rem] font-bold uppercase tracking-[0.25em] hover:text-olive-600 transition-colors group/map">
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
