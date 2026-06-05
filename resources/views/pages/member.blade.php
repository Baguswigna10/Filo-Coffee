@extends('layouts.app')
@section('title', 'Filo Membership | The Elite Coffee Club')
@section('meta_description', 'Bergabunglah dengan Filo Coffee Membership dan nikmati berbagai keuntungan eksklusif, reward point, dan layanan premium.')

@section('content')

{{-- ═══════════════════════════════════════
     1. HERO SECTION
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[85vh] flex items-center bg-beige-50">
    {{-- Decorative Background --}}
    <div class="absolute inset-0 opacity-50 pointer-events-none"
         style="background-image: radial-gradient(circle at 15% 20%, #CFDAD0 0%, transparent 40%), radial-gradient(circle at 85% 80%, #E6DCCF 0%, transparent 40%)">
    </div>
    <div class="absolute right-0 top-1/4 w-[600px] h-[600px] bg-olive-200/25 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute left-[-5%] bottom-0 w-80 h-80 bg-beige-200/50 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="relative w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 grid lg:grid-cols-2 gap-16 items-center z-10">
        {{-- Text Column --}}
        <div class="animate-fade-in-up">
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-8 h-[1.5px] bg-olive-500"></span>
                <span class="text-olive-700 text-xs font-bold tracking-[0.25em] uppercase">The Elite Club</span>
            </div>
            <h1 class="font-display text-5xl md:text-7xl text-olive-900 font-bold leading-[1.05] mb-8">
                Elevate Your<br>
                <span class="text-beige-600 italic font-semibold">Experience.</span>
            </h1>
            <p class="text-olive-800/70 text-lg md:text-xl leading-relaxed mb-12 max-w-lg">
                Jadilah bagian dari komunitas pecinta kopi premium kami. Nikmati akses istimewa, reward menarik, serta pelayanan prioritas di setiap kunjungan Anda.
            </p>

            {{-- Quick Stats --}}
            <div class="grid grid-cols-3 gap-6 mb-12 pt-8 border-t border-olive-900/10 max-w-md">
                @foreach([
                    ['num' => '3', 'label' => 'Tier Membership'],
                    ['num' => '10%', 'label' => 'Avg. Diskon'],
                    ['num' => '2×', 'label' => 'Point Platinum'],
                ] as $stat)
                <div>
                    <div class="font-display text-2xl font-bold text-olive-800">{{ $stat['num'] }}</div>
                    <div class="text-olive-500 text-[0.65rem] font-bold tracking-widest uppercase mt-1">{{ $stat['label'] }}</div>
                </div>
                @endforeach
            </div>

            <a href="#register-form" class="bg-olive-800 text-beige-50 hover:bg-olive-900 px-8 py-4 rounded-2xl font-bold transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg shadow-olive-900/20 inline-flex items-center gap-2 group">
                <span>Daftar Sekarang — Gratis!</span>
                <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        {{-- Hero Image --}}
        <div class="hidden lg:block animate-fade-in-up" style="animation-delay: 0.2s">
            <div class="relative group">
                <div class="absolute -inset-6 bg-olive-200/30 blur-[80px] rounded-full opacity-60 pointer-events-none"></div>
                <div class="relative rounded-[2rem] overflow-hidden shadow-2xl shadow-olive-900/10 ring-1 ring-olive-900/5">
                    <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=2070&auto=format&fit=crop" alt="Premium Coffee Experience" class="w-full h-[560px] object-cover transition-transform duration-[3s] group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-olive-950/30 via-transparent to-transparent"></div>
                    {{-- Floating Card --}}
                    <div class="absolute bottom-8 left-8 right-8 bg-white/80 backdrop-blur-md border border-white/60 rounded-2xl p-5 shadow-lg">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-olive-800 rounded-xl flex items-center justify-center text-beige-50 text-xl shadow-lg">⭐</div>
                            <div>
                                <p class="text-olive-900 font-bold text-base">Filo Gold Member</p>
                                <p class="text-olive-500 text-xs">Diskon 10% · Priority Booking · Free Voucher</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     2. PERKS OVERVIEW
     ═══════════════════════════════════════ --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-20 items-center">
            <div class="reveal">
                <span class="inline-block text-olive-600 text-xs font-bold tracking-[0.25em] uppercase mb-4">Privileged Access</span>
                <h2 class="font-display text-4xl md:text-5xl text-olive-900 font-bold leading-tight mb-10">
                    Reward Untuk<br>
                    <span class="text-beige-600 italic">Loyalitas Anda.</span>
                </h2>
                <div class="space-y-5 text-olive-700/80 text-lg leading-relaxed">
                    <p>Membership Filo Coffee adalah program loyalitas yang dirancang khusus untuk mengapresiasi pelanggan setia kami. Melalui program ini, setiap transaksi yang Anda lakukan akan memberikan nilai lebih.</p>
                    <p>Bukan sekadar kartu diskon, ini adalah paspor Anda menuju pengalaman gaya hidup kopi yang lebih personal dan eksklusif.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 reveal" style="transition-delay: 0.2s">
                @foreach([
                    ['icon' => '⭐', 'title' => 'Sistem Point', 'desc' => 'Dapatkan point dari setiap transaksi untuk ditukarkan dengan berbagai reward menarik.'],
                    ['icon' => '🚀', 'title' => 'Layanan Prioritas', 'desc' => 'Nikmati prioritas dalam reservasi meja dan booking PlayStation.'],
                    ['icon' => '📱', 'title' => 'Digital Card', 'desc' => 'Akses kartu member Anda kapan saja melalui smartphone Anda.'],
                    ['icon' => '🎪', 'title' => 'Eksklusif Event', 'desc' => 'Dapatkan undangan khusus untuk acara tasting kopi dan workshop barista.'],
                ] as $item)
                <div class="bg-beige-50 border border-beige-200 p-7 rounded-2xl hover:border-olive-400 hover:bg-olive-50 hover:shadow-md transition-all duration-500 group">
                    <div class="w-12 h-12 bg-white border border-beige-200 rounded-xl flex items-center justify-center text-2xl mb-5 group-hover:bg-olive-800 group-hover:border-olive-800 transition-all shadow-sm">{{ $item['icon'] }}</div>
                    <h4 class="text-olive-900 font-bold text-lg mb-2 group-hover:text-olive-700 transition-colors">{{ $item['title'] }}</h4>
                    <p class="text-olive-600/80 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     3. MEMBERSHIP TIERS
     ═══════════════════════════════════════ --}}
<section class="py-28 bg-beige-50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20 reveal">
            <span class="inline-block text-olive-600 text-xs font-bold tracking-[0.25em] uppercase mb-4">Level Up Your Journey</span>
            <h2 class="font-display text-4xl md:text-5xl text-olive-900 font-bold">Tingkatan Membership</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- SILVER --}}
            <div class="bg-white border border-beige-200 rounded-[2rem] p-10 reveal overflow-hidden relative group hover:border-olive-300 hover:shadow-xl transition-all duration-500">
                <div class="absolute -right-6 -top-6 text-[9rem] opacity-[0.04] transform group-hover:rotate-12 transition-transform duration-[2s]">🥈</div>
                <p class="text-olive-400 text-[0.7rem] font-bold uppercase tracking-[0.3em] mb-4">Tier 01</p>
                <h3 class="font-display text-4xl text-olive-900 font-bold mb-6">Silver</h3>
                <p class="text-olive-600/80 text-sm mb-8 pb-8 border-b border-beige-200">Level awal untuk memulai perjalanan kopi Anda bersama kami.</p>
                <ul class="space-y-4 mb-10">
                    @foreach(['Diskon 5% All Menu', 'Point x1.0 Reward', 'Birthday Special Offer'] as $benefit)
                    <li class="flex items-center gap-3 text-sm text-olive-700">
                        <div class="w-5 h-5 rounded-full bg-olive-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3 text-olive-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        {{ $benefit }}
                    </li>
                    @endforeach
                </ul>
                <div class="pt-6 border-t border-beige-200">
                    <p class="text-olive-400 text-[0.65rem] font-bold uppercase tracking-[0.2em] mb-1">Syarat</p>
                    <p class="text-olive-900 font-bold text-lg">Registrasi Baru (Gratis)</p>
                </div>
            </div>

            {{-- GOLD (Featured) --}}
            <div class="bg-olive-800 border border-olive-700 rounded-[2.5rem] p-10 reveal relative overflow-hidden group lg:-translate-y-6 shadow-2xl shadow-olive-900/20" style="transition-delay: 0.1s">
                <div class="top-17 right-10 absolute translate-y-1/2 bg-beige-100 text-olive-900 text-[0.65rem] font-bold px-5 py-2 rounded-full uppercase tracking-[0.2em] shadow-xl">✦ Member Favorit</div>
                <p class="text-beige-300 text-[0.7rem] font-bold uppercase tracking-[0.3em] mb-4">Tier 02</p>
                <h3 class="font-display text-4xl text-beige-50 font-bold mb-6">Gold</h3>
                <p class="text-beige-100/60 text-sm mb-8 pb-8 border-b border-white/10">Tingkatkan status Anda untuk benefit yang lebih memuaskan.</p>
                <ul class="space-y-4 mb-10">
                    @foreach(['Diskon 10% All Menu', 'Point x1.5 Reward', 'Priority Room Booking', 'Free Voucher Bulanan'] as $benefit)
                    <li class="flex items-center gap-3 text-sm text-beige-100">
                        <div class="w-5 h-5 rounded-full bg-beige-100/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3 text-beige-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        {{ $benefit }}
                    </li>
                    @endforeach
                </ul>
                <div class="pt-6 border-t border-white/10">
                    <p class="text-beige-300 text-[0.65rem] font-bold uppercase tracking-[0.2em] mb-1">Syarat</p>
                    <p class="text-beige-50 font-bold text-lg">Akumulasi Rp 2.000.000</p>
                </div>
            </div>

            {{-- PLATINUM --}}
            <div class="bg-white border border-beige-200 rounded-[2.5rem] p-10 reveal overflow-hidden relative group hover:border-olive-300 hover:shadow-xl transition-all duration-500" style="transition-delay: 0.2s">
                <div class="absolute -right-6 -top-6 text-[9rem] opacity-[0.04] transform group-hover:rotate-12 transition-transform duration-[2s]">💎</div>
                <p class="text-olive-400 text-[0.7rem] font-bold uppercase tracking-[0.3em] mb-4">Tier 03</p>
                <h3 class="font-display text-4xl text-olive-900 font-bold mb-6">Platinum</h3>
                <p class="text-olive-600/80 text-sm mb-8 pb-8 border-b border-beige-200">Level tertinggi untuk pengalaman paling eksklusif bersama kami.</p>
                <ul class="space-y-4 mb-10">
                    @foreach(['Diskon 15% All Menu', 'Point x2.0 Reward', 'VIP Table Guaranteed', 'Private Tasting Session'] as $benefit)
                    <li class="flex items-center gap-3 text-sm text-olive-700">
                        <div class="w-5 h-5 rounded-full bg-olive-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3 text-olive-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        {{ $benefit }}
                    </li>
                    @endforeach
                </ul>
                <div class="pt-6 border-t border-beige-200">
                    <p class="text-olive-400 text-[0.65rem] font-bold uppercase tracking-[0.2em] mb-1">Syarat</p>
                    <p class="text-olive-900 font-bold text-lg">Akumulasi Rp 5.000.000</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     4. DIGITAL MEMBER CARD PREVIEW
     ═══════════════════════════════════════ --}}
<section class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-20 items-center">
            <div class="reveal">
                <span class="inline-block text-olive-600 text-xs font-bold tracking-[0.25em] uppercase mb-4">Digital Identity</span>
                <h2 class="font-display text-4xl md:text-5xl text-olive-900 font-bold leading-tight mb-8">
                    Digital Member Card.
                </h2>
                <p class="text-olive-700/70 text-lg leading-relaxed mb-10">
                    Dapatkan kartu member digital yang dapat Anda akses langsung dari akun Filo Coffee Anda. Cukup scan QR code saat bertransaksi di outlet kami untuk mengumpulkan point dan mendapatkan diskon seketika.
                </p>
                <div class="space-y-5">
                    @foreach([
                        'Desain eksklusif sesuai tingkatan member.',
                        'Informasi point dan reward terupdate real-time.',
                        'Ramah lingkungan tanpa kartu plastik fisik.'
                    ] as $point)
                    <div class="flex items-center gap-4 group">
                        <div class="w-10 h-10 bg-olive-50 border border-olive-200 rounded-xl flex items-center justify-center text-olive-600 group-hover:bg-olive-800 group-hover:text-beige-50 group-hover:border-olive-800 transition-all duration-500 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-olive-700 font-medium group-hover:text-olive-900 transition-colors">{{ $point }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Mockup Card --}}
            <div class="flex justify-center reveal" style="transition-delay: 0.2s">
                <div class="relative w-full max-w-[480px] cursor-default group" style="perspective: 1000px">
                    {{-- Card --}}
                    <div class="relative rounded-[2rem] overflow-hidden shadow-2xl shadow-olive-900/20 ring-1 ring-olive-900/10 transition-transform duration-700 group-hover:rotate-y-3"
                         style="background: linear-gradient(135deg, #344535 0%, #232F24 50%, #151C15 100%); aspect-ratio: 1.6/1;">
                        {{-- Noise texture --}}
                        <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('data:image/svg+xml,%3Csvg viewBox=\'0 0 256 256\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cfilter id=\'n\'%3E%3CfeTurbulence type=\'fractalNoise\' baseFrequency=\'0.9\' numOctaves=\'4\'/%3E%3C/filter%3E%3Crect width=\'100%25\' height=\'100%25\' filter=\'url(%23n)\'/%3E%3C/svg%3E')"></div>
                        {{-- Gradient sheen --}}
                        <div class="absolute inset-0 opacity-30" style="background: linear-gradient(135deg, rgba(207,218,208,0.2) 0%, transparent 50%, rgba(230,220,207,0.1) 100%)"></div>
                        {{-- Reflection sweep --}}
                        <div class="absolute inset-0 bg-gradient-to-tr from-white/0 via-white/[0.04] to-white/0 transform translate-x-[-150%] group-hover:translate-x-[150%] transition-transform duration-[1.5s] ease-in-out"></div>

                        {{-- Content --}}
                        <div class="relative h-full p-10 flex flex-col justify-between">
                            <div class="flex justify-between items-start">
                                <div>
                                    <img src="{{ asset('images/logo.png') }}" class="h-8 w-auto mb-2 grayscale brightness-200 opacity-80" alt="Logo" onerror="this.style.display='none'">
                                    <p class="text-[0.55rem] font-bold text-beige-300/70 uppercase tracking-[0.4em]">Premium Identity</p>
                                </div>
                                <span class="bg-beige-200/20 text-beige-100 text-[0.6rem] font-bold px-4 py-1.5 rounded-lg uppercase tracking-widest border border-beige-100/20">GOLD MEMBER</span>
                            </div>

                            <div class="flex justify-between items-end">
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-[0.5rem] text-beige-300/40 font-bold uppercase tracking-[0.3em] mb-1">Member Holder</p>
                                        <p class="text-xl text-beige-50 font-display font-bold tracking-wider">
                                            @auth {{ auth()->user()->name }} @else Your Name Here @endauth
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-[0.5rem] text-beige-300/40 font-bold uppercase tracking-[0.3em] mb-1">Member Code</p>
                                        <p class="text-xs text-beige-200/60 font-mono tracking-[0.2em]">FC-2024-8899-001</p>
                                    </div>
                                </div>
                                <div class="bg-white p-2.5 rounded-xl shadow-xl">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=FILO-MEMBER-GOLD" class="w-16 h-16" alt="QR Code">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     5. REGISTRATION FORM
     ═══════════════════════════════════════ --}}
<section id="register-form" class="py-28 bg-beige-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white border border-beige-200 rounded-[2rem] p-10 md:p-16 relative reveal shadow-xl shadow-olive-900/5">
            {{-- Decorative corner --}}
            <div class="absolute top-0 right-0 w-48 h-48 bg-olive-50 rounded-[3rem] opacity-60 -z-0 pointer-events-none" style="border-radius: 0 3rem 0 100%"></div>

            <div class="text-center mb-14 relative z-10">
                <span class="inline-block text-olive-600 text-xs font-bold tracking-[0.25em] uppercase mb-4">Privilege Awaits</span>
                <h2 class="font-display text-4xl md:text-5xl text-olive-900 font-bold mb-4">Form Registrasi</h2>
                <p class="text-olive-600/70 text-base">Bergabunglah dan mulai kumpulkan poin dari setiap transaksi Anda — sepenuhnya gratis!</p>
            </div>

            @if(session('success'))
            <div class="mb-8 p-5 bg-green-50 border border-green-200 rounded-2xl flex items-center gap-4 relative z-10">
                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center text-green-600 flex-shrink-0">✓</div>
                <p class="text-green-800 font-semibold text-sm">{{ session('success') }}</p>
            </div>
            @endif

            <form action="{{ route('member.register') }}" method="POST" class="space-y-8 relative z-10" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="block text-[0.7rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Nama Lengkap *</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" required
                               class="w-full bg-beige-50 border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 placeholder:text-olive-300 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium"
                               placeholder="Nama Lengkap">
                        @error('name')<span class="text-red-500 text-xs ml-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[0.7rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Alamat Email *</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required
                               class="w-full bg-beige-50 border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 placeholder:text-olive-300 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium"
                               placeholder="email@example.com">
                        @error('email')<span class="text-red-500 text-xs ml-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[0.7rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Nomor WhatsApp *</label>
                        <input type="tel" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" required
                               class="w-full bg-beige-50 border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 placeholder:text-olive-300 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium"
                               placeholder="08xxxxxxxxxx">
                        @error('phone')<span class="text-red-500 text-xs ml-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[0.7rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Tanggal Lahir *</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date') }}" required
                               class="w-full bg-beige-50 border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium">
                        @error('birth_date')<span class="text-red-500 text-xs ml-1">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-[0.7rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Alamat Domisili *</label>
                    <textarea name="address" rows="4" required
                              class="w-full bg-beige-50 border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 placeholder:text-olive-300 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium resize-none"
                              placeholder="Masukkan alamat lengkap Anda">{{ old('address') }}</textarea>
                    @error('address')<span class="text-red-500 text-xs ml-1">{{ $message }}</span>@enderror
                </div>

                <button type="submit" class="w-full bg-olive-800 text-beige-50 hover:bg-olive-900 py-4 rounded-2xl font-bold transition-all duration-300 hover:-translate-y-0.5 shadow-lg shadow-olive-900/20 flex items-center justify-center gap-3 group text-base mt-4">
                    <span>Daftar Membership Sekarang</span>
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5M18 12H6"/></svg>
                </button>
            </form>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     6. FAQ SECTION
     ═══════════════════════════════════════ --}}
<section class="py-24 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 reveal">
            <span class="inline-block text-olive-600 text-xs font-bold tracking-[0.25em] uppercase mb-4">FAQ</span>
            <h2 class="font-display text-4xl md:text-5xl text-olive-900 font-bold">Pertanyaan Umum</h2>
        </div>

        <div class="space-y-4 reveal">
            @php
            $faqs = [
                ['q' => 'Apakah menjadi member Filo Coffee berbayar?', 'a' => 'Tidak. Pendaftaran membership Silver bersifat gratis. Anda hanya perlu melengkapi formulir registrasi untuk mulai mendapatkan keuntungan.'],
                ['q' => 'Bagaimana cara mendapatkan point reward?', 'a' => 'Setiap transaksi kelipatan Rp 10.000 akan mendapatkan 1 point. Point akan dikalikan sesuai dengan level membership Anda (Silver x1, Gold x1.5, Platinum x2).'],
                ['q' => 'Apakah point membership memiliki masa berlaku?', 'a' => 'Point berlaku selama 1 tahun sejak point tersebut didapatkan. Kami akan memberikan notifikasi melalui email sebelum point Anda hangus.'],
                ['q' => 'Bagaimana cara naik level ke Gold atau Platinum?', 'a' => 'Kenaikan level dilakukan secara otomatis berdasarkan total akumulasi transaksi Anda selama satu tahun. Gold minimal Rp 2.000.000 dan Platinum minimal Rp 5.000.000.'],
            ];
            @endphp

            @foreach($faqs as $i => $faq)
            <div x-data="{ open: false }" class="bg-beige-50 border border-beige-200 rounded-2xl overflow-hidden transition-all duration-300" :class="open ? 'border-olive-400 bg-olive-50' : ''">
                <button @click="open = !open" class="w-full px-8 py-6 text-left flex justify-between items-center group">
                    <span class="text-olive-900 font-bold text-base group-hover:text-olive-700 transition-colors duration-300 pr-4">{{ $faq['q'] }}</span>
                    <div class="w-8 h-8 rounded-full border border-olive-200 flex items-center justify-center text-olive-600 transition-all duration-300 flex-shrink-0" :class="open ? 'rotate-180 bg-olive-800 text-beige-50 border-olive-800' : ''">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </button>
                <div x-show="open" x-collapse x-cloak>
                    <div class="px-8 pb-6 text-olive-700/80 text-sm leading-relaxed">
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
