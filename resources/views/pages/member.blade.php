@extends('layouts.app')
@section('title', 'Membership')
@section('meta_description', 'Bergabunglah dengan Filo Coffee Membership dan nikmati berbagai keuntungan eksklusif, reward point, dan layanan premium.')

@section('content')

{{-- ═══════════════════════════════════════
     1. HERO SECTION
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[75vh] flex items-center bg-dark">
    {{-- Background layers --}}
    <div class="absolute inset-0 opacity-20"
         style="background-image: radial-gradient(circle at 10% 90%, #6B4226 0%, transparent 40%), radial-gradient(circle at 90% 10%, #C9A87C 0%, transparent 40%)">
    </div>
    <div class="absolute right-0 top-1/4 w-[600px] h-[600px] bg-mocca/10 rounded-full blur-[140px] animate-pulse-glow"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 grid lg:grid-cols-2 gap-20 items-center">
        <div class="animate-fade-in-up">
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-10 h-px bg-mocca/40"></span>
                <span class="text-mocca text-xs font-bold tracking-[0.3em] uppercase">The Elite Club</span>
            </div>
            <h1 class="font-display text-5xl md:text-7xl text-cream font-bold leading-tight mb-8">
                Elevate Your<br>
                <span class="text-mocca italic">Experience.</span>
            </h1>
            <p class="text-cream/50 text-base md:text-lg leading-relaxed mb-12 max-w-lg">
                Jadilah bagian dari komunitas pecinta kopi premium kami dan nikmati akses istimewa, reward menarik, serta pelayanan prioritas di setiap kunjungan Anda.
            </p>
            <div class="flex flex-wrap gap-5">
                <a href="#register-form" class="btn-mocca !px-10 !py-4 group">
                    <span>Daftar Sekarang</span>
                    <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>

        {{-- Visual Coffee Shop --}}
        <div class="hidden lg:block animate-fade-in-up" style="animation-delay: 0.2s">
            <div class="relative group">
                <div class="absolute -inset-6 bg-mocca/10 blur-[80px] rounded-full opacity-40 group-hover:opacity-60 transition-opacity"></div>
                <div class="relative rounded-[4rem] overflow-hidden border border-white/5 shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=2070&auto=format&fit=crop" alt="Premium Coffee Experience" class="w-full h-[600px] object-cover transition-transform duration-[3s] group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark/80 via-dark/20 to-transparent"></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     2. ABOUT MEMBERSHIP
     ═══════════════════════════════════════ --}}
<section class="py-32 bg-dark-deep">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-24 items-center">
            <div class="reveal">
                <p class="section-subtitle">Privileged Access</p>
                <h2 class="section-title mb-10">Reward Untuk <span class="text-mocca italic">Loyalitas Anda.</span></h2>
                <div class="space-y-8 text-cream/40 text-lg leading-relaxed">
                    <p>Membership Filo Coffee adalah program loyalitas yang dirancang khusus untuk mengapresiasi pelanggan setia kami. Melalui program ini, setiap transaksi yang Anda lakukan akan memberikan nilai lebih.</p>
                    <p>Bukan sekadar kartu diskon, ini adalah paspor Anda menuju pengalaman gaya hidup kopi yang lebih personal dan eksklusif. Kami memberikan penghargaan atas setiap tegukan kopi yang Anda nikmati bersama kami.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 reveal" style="transition-delay: 0.2s">
                @foreach([
                    ['title' => 'Sistem Point', 'desc' => 'Dapatkan point dari setiap transaksi untuk ditukarkan dengan berbagai reward menarik.'],
                    ['title' => 'Layanan Prioritas', 'desc' => 'Nikmati prioritas dalam reservasi meja dan booking PlayStation.'],
                    ['title' => 'Digital Card', 'desc' => 'Akses kartu member Anda kapan saja dan di mana saja melalui smartphone Anda.'],
                    ['title' => 'Eksklusif Event', 'desc' => 'Dapatkan undangan khusus untuk acara tasting kopi dan workshop barista.'],
                ] as $item)
                <div class="bg-warm border border-white/5 p-8 rounded-[2rem] hover:border-mocca/30 transition-all duration-500 shadow-xl group">
                    <h4 class="text-mocca font-bold mb-4 text-xl group-hover:text-mocca-light transition-colors">{{ $item['title'] }}</h4>
                    <p class="text-cream/30 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     3. TINGKATAN MEMBERSHIP
     ═══════════════════════════════════════ --}}
<section class="py-32 bg-dark relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-24 reveal">
            <p class="section-subtitle">Level Up Your Journey</p>
            <h2 class="section-title">Tingkatan Membership</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            {{-- Silver --}}
            <div class="bg-warm border border-white/5 rounded-[3rem] p-12 reveal overflow-hidden relative group hover:bg-warm-light transition-all duration-500 shadow-2xl">
                <div class="absolute -right-6 -top-6 text-[10rem] opacity-[0.03] transform group-hover:rotate-12 transition-transform duration-[2s]">🥈</div>
                <p class="text-cream/20 text-[0.7rem] font-bold uppercase tracking-[0.3em] mb-4">Tier 01</p>
                <h3 class="font-display text-4xl text-cream font-bold mb-8">Silver</h3>
                <div class="text-cream/40 text-base mb-12 pb-12 border-b border-white/[0.05]">
                    Level awal untuk memulai perjalanan kopi Anda bersama kami.
                </div>
                <ul class="space-y-6 mb-16">
                    @foreach(['Diskon 5% All Menu', 'Point x1.0 Reward', 'Birthday Special Offer'] as $benefit)
                    <li class="flex items-center gap-4 text-sm text-cream/50">
                        <svg class="w-5 h-5 text-mocca" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ $benefit }}
                    </li>
                    @endforeach
                </ul>
                <div class="mt-auto pt-8 border-t border-white/[0.05]">
                    <p class="text-[0.65rem] font-bold text-mocca uppercase tracking-[0.2em] mb-2">Syarat</p>
                    <p class="text-cream font-bold text-lg">Registrasi Baru (Gratis)</p>
                </div>
            </div>

            {{-- Gold --}}
            <div class="bg-warm-light border border-mocca/20 rounded-[3rem] p-12 reveal relative group transform lg:-translate-y-6 shadow-[0_30px_100px_rgba(0,0,0,0.4)]" style="transition-delay: 0.1s">
                <div class="absolute top-0 right-12 -translate-y-1/2 bg-mocca text-dark text-[0.7rem] font-bold px-6 py-2.5 rounded-2xl uppercase tracking-[0.2em] shadow-2xl shadow-mocca/30">Member Favorit</div>
                <div class="absolute -right-6 -top-6 text-[10rem] opacity-[0.05] transform group-hover:rotate-12 transition-transform duration-[2s]">🥇</div>
                <p class="text-mocca text-[0.7rem] font-bold uppercase tracking-[0.3em] mb-4">Tier 02</p>
                <h3 class="font-display text-4xl text-cream font-bold mb-8">Gold</h3>
                <div class="text-cream/50 text-base mb-12 pb-12 border-b border-white/[0.05]">
                    Tingkatkan status Anda untuk benefit yang lebih memuaskan.
                </div>
                <ul class="space-y-6 mb-16">
                    @foreach(['Diskon 10% All Menu', 'Point x1.5 Reward', 'Priority Room Booking', 'Free Voucher Bulanan'] as $benefit)
                    <li class="flex items-center gap-4 text-sm text-cream/70">
                        <svg class="w-5 h-5 text-mocca" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ $benefit }}
                    </li>
                    @endforeach
                </ul>
                <div class="mt-auto pt-8 border-t border-white/[0.05]">
                    <p class="text-[0.65rem] font-bold text-mocca uppercase tracking-[0.2em] mb-2">Syarat</p>
                    <p class="text-cream font-bold text-lg">Akumulasi Rp 2.000.000</p>
                </div>
            </div>

            {{-- Platinum --}}
            <div class="bg-warm border border-white/5 rounded-[3rem] p-12 reveal overflow-hidden relative group hover:bg-warm-light transition-all duration-500 shadow-2xl" style="transition-delay: 0.2s">
                <div class="absolute -right-6 -top-6 text-[10rem] opacity-[0.03] transform group-hover:rotate-12 transition-transform duration-[2s]">💎</div>
                <p class="text-cream/20 text-[0.7rem] font-bold uppercase tracking-[0.3em] mb-4">Tier 03</p>
                <h3 class="font-display text-4xl text-cream font-bold mb-8">Platinum</h3>
                <div class="text-cream/40 text-base mb-12 pb-12 border-b border-white/[0.05]">
                    Level tertinggi untuk pengalaman paling eksklusif.
                </div>
                <ul class="space-y-6 mb-16">
                    @foreach(['Diskon 15% All Menu', 'Point x2.0 Reward', 'VIP Table Guaranteed', 'Private Tasting Session'] as $benefit)
                    <li class="flex items-center gap-4 text-sm text-cream/50">
                        <svg class="w-5 h-5 text-mocca" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ $benefit }}
                    </li>
                    @endforeach
                </ul>
                <div class="mt-auto pt-8 border-t border-white/[0.05]">
                    <p class="text-[0.65rem] font-bold text-mocca uppercase tracking-[0.2em] mb-2">Syarat</p>
                    <p class="text-cream font-bold text-lg">Akumulasi Rp 5.000.000</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     4. DIGITAL CARD PREVIEW
     ═══════════════════════════════════════ --}}
<section class="py-32 bg-dark-deep relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-24 items-center">
            <div class="reveal">
                <p class="section-subtitle">Identity</p>
                <h2 class="section-title mb-10">Digital Member Card.</h2>
                <p class="text-cream/40 text-lg leading-relaxed mb-12">
                    Dapatkan kartu member digital yang dapat Anda akses langsung dari akun Filo Coffee Anda. Cukup scan QR code saat bertransaksi di outlet kami untuk mengumpulkan point dan mendapatkan diskon seketika.
                </p>
                <div class="space-y-8">
                    @foreach([
                        'Desain eksklusif sesuai tingkatan member.',
                        'Informasi point dan reward terupdate real-time.',
                        'Ramah lingkungan tanpa kartu plastik fisik.'
                    ] as $point)
                    <div class="flex items-center gap-6 group">
                        <div class="w-12 h-12 bg-warm border border-white/5 rounded-2xl flex items-center justify-center text-mocca group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-base text-cream/60 font-medium group-hover:text-cream transition-colors">{{ $point }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Mockup Card --}}
            <div class="flex justify-center reveal" style="transition-delay: 0.2s">
                <div class="relative w-full max-w-[500px] aspect-[1.6/1] rounded-[2.5rem] overflow-hidden shadow-[0_50px_100px_rgba(0,0,0,0.6)] group cursor-default">
                    {{-- Card Background --}}
                    <div class="absolute inset-0 bg-[#1e1c18]"></div>
                    <div class="absolute inset-0 bg-gradient-to-br from-mocca/30 via-transparent to-mocca/10 opacity-60"></div>
                    
                    {{-- Content --}}
                    <div class="relative h-full p-12 flex flex-col justify-between">
                        <div class="flex justify-between items-start">
                            <div>
                                <img src="{{ asset('images/logo.png') }}" class="h-10 w-auto mb-3 grayscale brightness-150 opacity-80" alt="Logo">
                                <p class="text-[0.6rem] font-bold text-mocca uppercase tracking-[0.4em]">Premium Identity</p>
                            </div>
                            <div class="text-right">
                                <span class="bg-mocca text-dark text-[0.7rem] font-bold px-5 py-2 rounded-xl uppercase tracking-widest shadow-xl shadow-mocca/20">GOLD MEMBER</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-end">
                            <div class="space-y-6">
                                <div>
                                    <p class="text-[0.55rem] text-cream/20 font-bold uppercase tracking-[0.3em] mb-2">Member Holder</p>
                                    <p class="text-2xl text-cream font-display font-bold tracking-wider">
                                        @auth {{ auth()->user()->name }} @else Your Name Here @endauth
                                    </p>
                                </div>
                                <div>
                                    <p class="text-[0.55rem] text-cream/20 font-bold uppercase tracking-[0.3em] mb-2">Member Code</p>
                                    <p class="text-sm text-cream/50 font-mono tracking-[0.2em]">FC-2024-8899-001</p>
                                </div>
                            </div>
                            
                            <div class="bg-white p-3 rounded-2xl shadow-2xl">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=FILO-MEMBER-GOLD" class="w-20 h-20 grayscale brightness-90" alt="QR Code">
                            </div>
                        </div>
                    </div>

                    {{-- Reflection --}}
                    <div class="absolute inset-0 bg-gradient-to-tr from-white/0 via-white/[0.03] to-white/0 transform translate-x-[-150%] group-hover:translate-x-[150%] transition-transform duration-[1.5s] ease-in-out"></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     5. REGISTRATION FORM
     ═══════════════════════════════════════ --}}
<section id="register-form" class="py-40 bg-dark">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-warm border border-white/[0.03] rounded-[4rem] p-12 md:p-20 relative reveal shadow-2xl">
            <div class="text-center mb-16">
                <p class="section-subtitle">Privilege Awaits</p>
                <h2 class="section-title">Form Registrasi</h2>
                <p class="text-cream/30 text-sm mt-4">Bergabunglah dan mulai kumpulkan poin dari setiap transaksi Anda.</p>
            </div>

            <form action="{{ route('member.register') }}" method="POST" class="space-y-10" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-3">
                        <label class="block text-[0.7rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Nama Lengkap *</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" required class="input-field" placeholder="Nama Lengkap">
                    </div>
                    <div class="space-y-3">
                        <label class="block text-[0.7rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Alamat Email *</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required class="input-field" placeholder="email@example.com">
                    </div>
                    <div class="space-y-3">
                        <label class="block text-[0.7rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Nomor WhatsApp *</label>
                        <input type="tel" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" required class="input-field" placeholder="08xxxxxxxxxx">
                    </div>
                    <div class="space-y-3">
                        <label class="block text-[0.7rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Tanggal Lahir *</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date') }}" required class="input-field">
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="block text-[0.7rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Alamat Domisili *</label>
                    <textarea name="address" rows="4" required class="input-field resize-none" placeholder="Masukkan alamat lengkap Anda">{{ old('address') }}</textarea>
                </div>

                <button type="submit" class="w-full btn-mocca justify-center !py-4 !text-base shadow-2xl shadow-mocca/20 mt-10 group">
                    <span>Daftar Membership Sekarang</span>
                    <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5M18 12H6"/></svg>
                </button>
            </form>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     6. FAQ SECTION
     ═══════════════════════════════════════ --}}
<section class="py-32 bg-dark-deep">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20 reveal">
            <p class="section-subtitle">FAQ</p>
            <h2 class="section-title">Pertanyaan Umum</h2>
        </div>

        <div class="space-y-6 reveal">
            @php
            $faqs = [
                ['q' => 'Apakah menjadi member Filo Coffee berbayar?', 'a' => 'Tidak. Pendaftaran membership Silver bersifat gratis. Anda hanya perlu melengkapi formulir registrasi untuk mulai mendapatkan keuntungan.'],
                ['q' => 'Bagaimana cara mendapatkan point reward?', 'a' => 'Setiap transaksi kelipatan Rp 10.000 akan mendapatkan 1 point. Point akan dikalikan sesuai dengan level membership Anda (Silver x1, Gold x1.5, Platinum x2).'],
                ['q' => 'Apakah point membership memiliki masa berlaku?', 'a' => 'Point berlaku selama 1 tahun sejak point tersebut didapatkan. Kami akan memberikan notifikasi melalui email sebelum point Anda hangus.'],
                ['q' => 'Bagaimana cara naik level ke Gold atau Platinum?', 'a' => 'Kenaikan level dilakukan secara otomatis berdasarkan total akumulasi transaksi Anda selama satu tahun. Gold minimal Rp 2.000.000 dan Platinum minimal Rp 5.000.000.'],
            ];
            @endphp

            @foreach($faqs as $i => $faq)
            <div x-data="{ open: false }" class="bg-warm border border-white/5 rounded-[2rem] overflow-hidden transition-all duration-500" :class="open ? 'border-mocca/40 bg-warm-light' : ''">
                <button @click="open = !open" class="w-full px-10 py-8 text-left flex justify-between items-center group">
                    <span class="text-cream font-bold text-lg group-hover:text-mocca transition-colors duration-300">{{ $faq['q'] }}</span>
                    <div class="w-8 h-8 rounded-full border border-mocca/20 flex items-center justify-center text-mocca transition-transform duration-500" :class="open ? 'rotate-180 bg-mocca text-dark border-mocca' : ''">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </button>
                <div x-show="open" x-collapse x-cloak>
                    <div class="px-10 pb-8 text-cream/40 text-base leading-relaxed">
                        {{ $faq['a'] }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
