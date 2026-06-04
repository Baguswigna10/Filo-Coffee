@extends('layouts.app')
@section('title', 'PlayStation Booking')
@section('meta_description', 'Main PS4 & PS5 sambil menikmati kopi premium di Filo Coffee. Pengalaman gaming & coffee yang sempurna!')

@section('content')

{{-- ═══════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[50vh] flex items-center bg-dark">
    {{-- Background layers --}}
    <div class="absolute inset-0 opacity-20"
         style="background-image: radial-gradient(circle at 10% 90%, #4f46e5 0%, transparent 40%), radial-gradient(circle at 90% 10%, #6B4226 0%, transparent 40%)">
    </div>
    <div class="absolute right-0 top-0 w-[500px] h-[500px] bg-indigo-500/10 rounded-full blur-[140px] animate-pulse-glow"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <div class="inline-flex items-center gap-3 mb-8 animate-fade-in-up">
            <span class="w-10 h-px bg-indigo-500/40"></span>
            <span class="text-indigo-400 text-xs font-bold tracking-[0.3em] uppercase">Premium Game Zone</span>
            <span class="w-10 h-px bg-indigo-500/40"></span>
        </div>
        <h1 class="font-display text-5xl md:text-7xl text-cream font-bold leading-tight mb-8 animate-fade-in-up" style="animation-delay: 0.1s">
            PlayStation <span class="text-mocca italic">Zone.</span>
        </h1>
        <p class="text-cream/50 text-base md:text-lg leading-relaxed max-w-2xl mx-auto animate-fade-in-up" style="animation-delay: 0.2s">
            Pengalaman gaming eksklusif dengan konsol terbaru PS5 & PS4 Pro, didukung visual 4K dan suasana coffee shop yang super cozy.
        </p>
    </div>
</section>

{{-- ═══════════════════════════════════════
     PRICING CONTENT
     ═══════════════════════════════════════ --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 pb-32">
    
    {{-- Pricing Cards --}}
    <div class="grid md:grid-cols-2 gap-10 mb-24">
        {{-- PS4 Card --}}
        <div class="card group p-10 text-center reveal">
            <div class="w-24 h-24 bg-dark rounded-[2rem] flex items-center justify-center mx-auto mb-8 group-hover:scale-110 group-hover:bg-mocca group-hover:text-dark transition-all duration-500 shadow-2xl">
                <span class="text-5xl">🎮</span>
            </div>
            <h3 class="font-display text-3xl text-cream font-bold mb-3">PlayStation 4 Pro</h3>
            <div class="flex items-center justify-center gap-2 mb-10">
                <span class="text-mocca font-bold text-4xl">Rp {{ number_format($ps4Price, 0, ',', '.') }}</span>
                <span class="text-cream/20 text-xs font-bold uppercase tracking-[0.2em]">/ Jam</span>
            </div>
            <ul class="space-y-6 mb-10 text-left max-w-[240px] mx-auto">
                @foreach([
                    'Controller DualShock 4 Pro',
                    '100+ Koleksi Game Populer',
                    'TV 4K HDR 50" Crystal Display',
                    'Free 1 Minuman Pilihan'
                ] as $feature)
                <li class="flex items-center gap-4 text-cream/40 text-sm font-medium">
                    <svg class="w-5 h-5 text-mocca" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    {{ $feature }}
                </li>
                @endforeach
            </ul>
        </div>

        {{-- PS5 Card --}}
        <div class="bg-indigo-950/20 border border-indigo-500/30 rounded-[3rem] p-10 text-center relative overflow-hidden group hover:bg-indigo-900/20 transition-all duration-500 reveal shadow-2xl" style="transition-delay: 0.1s">
            <div class="absolute top-8 right-8">
                <span class="badge bg-indigo-500 text-dark border-transparent uppercase tracking-[0.2em] font-bold !px-5 !py-2 shadow-xl shadow-indigo-500/20 animate-pulse">Ultimate</span>
            </div>
            
            <div class="w-24 h-24 bg-indigo-500/20 border border-indigo-500/30 rounded-[2rem] flex items-center justify-center mx-auto mb-8 group-hover:scale-110 group-hover:bg-indigo-500 group-hover:text-dark transition-all duration-500 shadow-2xl">
                <span class="text-5xl">🕹️</span>
            </div>
            <h3 class="font-display text-3xl text-cream font-bold mb-3">PlayStation 5</h3>
            <div class="flex items-center justify-center gap-2 mb-10">
                <span class="text-indigo-400 font-bold text-4xl">Rp {{ number_format($ps5Price, 0, ',', '.') }}</span>
                <span class="text-cream/20 text-xs font-bold uppercase tracking-[0.2em]">/ Jam</span>
            </div>
            <ul class="space-y-6 mb-10 text-left max-w-[240px] mx-auto">
                @foreach([
                    'Controller DualSense Next-Gen',
                    '50+ Game Eksklusif PS5',
                    'TV OLED 55" 120fps Ready',
                    'Free 1 Minuman + Snack'
                ] as $feature)
                <li class="flex items-center gap-4 text-cream/60 text-sm font-medium">
                    <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    {{ $feature }}
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- Booking Section --}}
    <div class="grid lg:grid-cols-12 gap-16 items-start">
        
        {{-- Booking Form Column --}}
        <div class="lg:col-span-7 reveal">
            <div class="bg-warm border border-white/[0.05] rounded-[3rem] p-8 md:p-14 shadow-2xl">
                <div class="flex items-center gap-6 mb-12">
                    <div class="w-16 h-16 bg-indigo-500/10 rounded-2xl flex items-center justify-center text-indigo-400 ring-1 ring-indigo-500/20 shadow-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <h2 class="font-display text-3xl text-cream font-bold">Booking Form</h2>
                        <p class="text-mocca text-[0.65rem] uppercase tracking-[0.2em] font-bold mt-1">Lengkapi Detail Bermain Anda</p>
                    </div>
                </div>

                @guest
                <div class="bg-indigo-500/[0.05] border border-indigo-500/10 rounded-2xl p-5 mb-10 flex items-center gap-4">
                    <div class="w-10 h-10 bg-indigo-500/20 rounded-xl flex items-center justify-center text-indigo-400 font-bold">!</div>
                    <p class="text-cream/50 text-sm">
                        <a href="{{ route('login') }}" class="text-indigo-400 font-bold underline hover:text-indigo-300">Login sekarang</a> untuk kemudahan tracking status booking Anda.
                    </p>
                </div>
                @endguest

                <form action="{{ route('playstation.store') }}" method="POST" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Nama Lengkap *</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()?->name) }}" required class="input-field" placeholder="Nama Anda">
                            @error('name')<span class="text-red-400 text-[0.65rem] font-medium ml-1">{{ $message }}</span>@enderror
                        </div>
                        <div class="space-y-3">
                            <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">No. WhatsApp *</label>
                            <input type="tel" name="phone" value="{{ old('phone', auth()->user()?->phone) }}" required class="input-field" placeholder="08xxxxxxxx">
                            @error('phone')<span class="text-red-400 text-[0.65rem] font-medium ml-1">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Pilihan Konsol *</label>
                        <select name="console_type" id="console_type" required class="input-field" onchange="calcPrice()">
                            <option value="PS5" {{ old('console_type', 'PS5') == 'PS5' ? 'selected' : '' }}>PlayStation 5 — Premium 4K</option>
                            <option value="PS4" {{ old('console_type') == 'PS4' ? 'selected' : '' }}>PlayStation 4 Pro — High Performance</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Tanggal Bermain *</label>
                            <input type="date" name="reservation_date" value="{{ old('reservation_date') }}" min="{{ date('Y-m-d') }}" required class="input-field">
                            @error('reservation_date')<span class="text-red-400 text-[0.65rem] font-medium ml-1">{{ $message }}</span>@enderror
                        </div>
                        <div class="space-y-3">
                            <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Jam Mulai *</label>
                            <select name="start_time" required class="input-field" onchange="calcPrice()">
                                <option value="">Pilih jam</option>
                                @for($h = 8; $h < 22; $h++)
                                <option value="{{ sprintf('%02d:00', $h) }}" {{ old('start_time') == sprintf('%02d:00', $h) ? 'selected' : '' }}>
                                    {{ sprintf('%02d:00', $h) }}:00 WIB
                                </option>
                                @endfor
                            </select>
                            @error('start_time')<span class="text-red-400 text-[0.65rem] font-medium ml-1">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Durasi Bermain *</label>
                            <select name="duration" id="duration" required class="input-field" onchange="calcPrice()">
                                @for($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ old('duration', 2) == $i ? 'selected' : '' }}>{{ $i }} Jam</option>
                                @endfor
                            </select>
                        </div>
                        
                        {{-- Price Preview --}}
                        <div class="bg-dark/40 border border-white/[0.05] rounded-2xl p-4 flex flex-col justify-center">
                            <span class="text-[0.6rem] font-bold uppercase tracking-[0.3em] text-cream/20 mb-1">Estimasi Total</span>
                            <div class="flex items-baseline gap-2">
                                <span id="price-preview" class="text-mocca font-bold text-2xl leading-none">—</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-[0.7rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Catatan (Opsional)</label>
                        <textarea name="notes" rows="3" class="input-field resize-none" placeholder="Misal: Request game FIFA, Spider-Man, dll.">{{ old('notes') }}</textarea>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-5 rounded-[1.5rem] hover:bg-indigo-500 transition-all duration-500 shadow-2xl shadow-indigo-600/20 flex items-center justify-center gap-4 group text-lg">
                            <span>Konfirmasi Booking</span>
                            <svg class="w-6 h-6 transition-transform duration-500 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Sidebar Column --}}
        <div class="lg:col-span-5 space-y-10 reveal" style="transition-delay: 0.1s">
            
            {{-- Info Card --}}
            <div class="bg-warm border border-white/[0.03] rounded-[2.5rem] p-10 relative overflow-hidden shadow-xl">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-500/5 rounded-full blur-3xl"></div>
                <h3 class="font-display text-2xl text-cream font-bold mb-8">Panduan Bermain</h3>
                <div class="space-y-8">
                    @foreach([
                        ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'text' => 'Game Zone operasional: 08:00 – 22:00 WIB'],
                        ['icon' => 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14', 'text' => 'Fasilitas PS4 Pro & PS5 dengan TV 4K'],
                        ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'text' => 'Wajib konfirmasi via WhatsApp sebelum datang'],
                        ['icon' => 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z', 'text' => 'Pembayaran aman di lokasi (Cash/QRIS)'],
                    ] as $info)
                    <div class="flex items-start gap-5 group">
                        <div class="w-10 h-10 bg-indigo-500/10 rounded-xl flex items-center justify-center text-indigo-400 flex-shrink-0 group-hover:scale-110 transition-all duration-300 shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $info['icon'] }}"/></svg>
                        </div>
                        <span class="text-cream/40 text-[0.85rem] mt-1.5 leading-relaxed group-hover:text-cream/70 transition-colors">{{ $info['text'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- My Bookings List --}}
            @auth
            @php
                $myPSBookings = \App\Models\PsReservation::where('user_id', auth()->id())->latest()->take(3)->get();
            @endphp
            @if($myPSBookings->isNotEmpty())
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h3 class="font-display text-2xl text-cream font-bold">Booking Terbaru</h3>
                    <span class="text-mocca/30 text-[0.6rem] font-bold uppercase tracking-[0.3em]">3 Terakhir</span>
                </div>
                @foreach($myPSBookings as $res)
                <div class="bg-warm border border-white/5 rounded-[2rem] p-8 hover:border-indigo-500/30 transition-all duration-500 shadow-xl group">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <p class="text-indigo-400 font-bold text-xs tracking-[0.2em] mb-1 uppercase">{{ $res->reservation_code }}</p>
                            <p class="text-cream font-bold text-lg">{{ $res->reservation_date->format('d M Y') }}</p>
                            <p class="text-cream/30 text-xs font-medium">{{ substr($res->start_time, 0, 5) }} WIB · {{ $res->duration }} Jam</p>
                        </div>
                        <span class="badge badge-status-{{ $res->status }}">{{ $res->status }}</span>
                    </div>
                    
                    <div class="pt-6 border-t border-white/[0.03] flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-cream font-bold text-base group-hover:text-mocca transition-colors">{{ $res->console_type }}</span>
                            <span class="text-mocca/40 text-[0.7rem] font-bold uppercase tracking-widest">Total: Rp {{ number_format($res->total_price, 0, ',', '.') }}</span>
                        </div>
                        
                        @if($res->status === 'Pending')
                        <form action="{{ route('playstation.cancel', $res) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" onclick="return confirm('Batalkan booking ini?')"
                                    class="text-red-400/40 hover:text-red-400 text-xs font-bold uppercase tracking-[0.2em] transition-colors">
                                Cancel
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            @endauth

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
const ps4Price = {{ $ps4Price }};
const ps5Price = {{ $ps5Price }};

function calcPrice() {
    const type     = document.getElementById('console_type').value;
    const duration = parseInt(document.getElementById('duration').value) || 0;
    const price    = type === 'PS5' ? ps5Price : ps4Price;
    const total    = price * duration;
    document.getElementById('price-preview').textContent = total > 0
        ? 'Rp ' + total.toLocaleString('id-ID')
        : '—';
}
calcPrice();
</script>
@endpush
