@extends('layouts.app')
@section('title', 'Reservasi Meja')
@section('meta_description', 'Pesan meja favorit Anda di Filo Coffee. Tersedia area Indoor, Outdoor, dan Smoking Area yang cozy.')

@section('content')

{{-- ═══════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[40vh] flex items-center bg-dark">
    {{-- Background layers --}}
    <div class="absolute inset-0 opacity-20"
         style="background-image: radial-gradient(circle at 80% 80%, #CCB196 0%, transparent 45%), radial-gradient(circle at 20% 20%, #6B4226 0%, transparent 45%)">
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <div class="inline-flex items-center gap-3 mb-6 animate-fade-in-up">
            <span class="w-10 h-px bg-mocca/40"></span>
            <span class="text-mocca text-xs font-bold tracking-[0.3em] uppercase">Private Booking</span>
            <span class="w-10 h-px bg-mocca/40"></span>
        </div>
        <h1 class="font-display text-5xl md:text-7xl text-cream font-bold leading-tight mb-6 animate-fade-in-up" style="animation-delay: 0.1s">
            Reservasi <span class="text-mocca italic">Meja.</span>
        </h1>
        <p class="text-cream/50 text-base md:text-lg leading-relaxed max-w-2xl mx-auto animate-fade-in-up" style="animation-delay: 0.2s">
            Pesan tempat favorit Anda sebelumnya untuk memastikan kenyamanan momen santai Anda di Filo Coffee.
        </p>
    </div>
</section>

{{-- ═══════════════════════════════════════
     BOOKING CONTENT
     ═══════════════════════════════════════ --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="grid lg:grid-cols-12 gap-16 items-start">

        {{-- Booking Form Column --}}
        <div class="lg:col-span-7 reveal">
            <div class="bg-warm border border-white/[0.05] rounded-[2.5rem] p-8 md:p-12 shadow-2xl shadow-black/20">
                <div class="flex items-center gap-6 mb-12">
                    <div class="w-16 h-16 bg-dark rounded-2xl flex items-center justify-center text-mocca shadow-xl ring-1 ring-mocca/20">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <h2 class="font-display text-3xl text-cream font-bold">Lengkapi Data</h2>
                        <p class="text-mocca text-[0.65rem] uppercase tracking-[0.2em] font-bold mt-1">Konfirmasi Instan Untuk Kunjungan Anda</p>
                    </div>
                </div>

                @guest
                <div class="bg-mocca/[0.05] border border-mocca/10 rounded-2xl p-5 mb-10 flex items-center gap-4">
                    <div class="w-10 h-10 bg-mocca/20 rounded-xl flex items-center justify-center text-mocca font-bold">!</div>
                    <p class="text-cream/50 text-sm">
                        <a href="{{ route('login') }}" class="text-mocca font-bold underline hover:text-mocca-light">Login sekarang</a> untuk mempermudah pelacakan status reservasi Anda secara real-time.
                    </p>
                </div>
                @endguest

                <form action="{{ route('reservation.store') }}" method="POST" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Nama Lengkap *</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()?->name) }}" required class="input-field" placeholder="Masukkan nama Anda">
                            @error('name')<span class="text-red-400 text-[0.65rem] font-medium ml-1">{{ $message }}</span>@enderror
                        </div>
                        <div class="space-y-3">
                            <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">No. Telepon *</label>
                            <input type="tel" name="phone" value="{{ old('phone', auth()->user()?->phone) }}" required class="input-field" placeholder="08xxxxxxxx">
                            @error('phone')<span class="text-red-400 text-[0.65rem] font-medium ml-1">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Alamat Email *</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()?->email) }}" required class="input-field" placeholder="nama@email.com">
                        @error('email')<span class="text-red-400 text-[0.65rem] font-medium ml-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Tanggal Kunjungan *</label>
                            <input type="date" name="reservation_date" value="{{ old('reservation_date') }}" required
                                   min="{{ date('Y-m-d') }}" class="input-field">
                            @error('reservation_date')<span class="text-red-400 text-[0.65rem] font-medium ml-1">{{ $message }}</span>@enderror
                        </div>
                        <div class="space-y-3">
                            <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Waktu Datang *</label>
                            <select name="reservation_time" required class="input-field">
                                <option value="">Pilih jam</option>
                                @for($h = 8; $h < 22; $h++)
                                <option value="{{ sprintf('%02d:00', $h) }}" {{ old('reservation_time') == sprintf('%02d:00', $h) ? 'selected' : '' }}>
                                    {{ sprintf('%02d:00', $h) }}:00 WIB
                                </option>
                                @endfor
                            </select>
                            @error('reservation_time')<span class="text-red-400 text-[0.65rem] font-medium ml-1">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Jumlah Tamu *</label>
                            <input type="number" name="guest_count" value="{{ old('guest_count', 2) }}" min="1" max="20" required class="input-field">
                            @error('guest_count')<span class="text-red-400 text-[0.65rem] font-medium ml-1">{{ $message }}</span>@enderror
                        </div>
                        <div class="space-y-3">
                            <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Pilih Area *</label>
                            <select name="area" required class="input-field">
                                <option value="Indoor" {{ old('area') == 'Indoor' ? 'selected' : '' }}>Indoor (AC)</option>
                                <option value="Outdoor" {{ old('area') == 'Outdoor' ? 'selected' : '' }}>Outdoor (Nature)</option>
                                <option value="Smoking" {{ old('area') == 'Smoking' ? 'selected' : '' }}>Smoking Area</option>
                            </select>
                            @error('area')<span class="text-red-400 text-[0.65rem] font-medium ml-1">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-cream/30 ml-1">Permintaan Khusus (Opsional)</label>
                        <textarea name="special_request" rows="4" class="input-field resize-none" placeholder="Misal: Rayakan ulang tahun, butuh kursi bayi, atau meja di pojok...">{{ old('special_request') }}</textarea>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="btn-mocca w-full justify-center !py-5 !text-lg shadow-2xl shadow-mocca/20 group">
                            <span>Konfirmasi Reservasi</span>
                            <svg class="w-6 h-6 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Sidebar Column --}}
        <div class="lg:col-span-5 space-y-10 reveal" style="transition-delay: 0.1s">
            
            {{-- Areas Info Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-1 gap-5">
                @foreach([
                    ['emoji' => '🏠', 'name' => 'Indoor Space', 'desc' => 'Full AC dengan musik santai, cocok untuk bekerja.', 'color' => 'bg-coffee/10'],
                    ['emoji' => '🌿', 'name' => 'Outdoor Garden', 'desc' => 'Suasana terbuka yang asri dikelilingi pepohonan.', 'color' => 'bg-green-900/10'],
                    ['emoji' => '🚬', 'name' => 'Smoking Area', 'desc' => 'Ruang terbuka khusus dengan sirkulasi udara baik.', 'color' => 'bg-warm-light'],
                ] as $area)
                <div class="card group p-8 hover:border-mocca/30 transition-all duration-500">
                    <div class="flex items-start gap-6">
                        <div class="w-16 h-16 {{ $area['color'] }} rounded-2xl flex items-center justify-center text-3xl group-hover:scale-110 transition-transform duration-500">
                            {{ $area['emoji'] }}
                        </div>
                        <div>
                            <h3 class="font-display text-xl text-cream font-bold mb-2">{{ $area['name'] }}</h3>
                            <p class="text-cream/30 text-sm leading-relaxed">{{ $area['desc'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Policy Info --}}
            <div class="bg-dark-deep border border-mocca/10 rounded-[2rem] p-10 relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-mocca/5 rounded-full blur-3xl"></div>
                <h3 class="font-display text-2xl text-cream font-bold mb-8">Panduan Reservasi</h3>
                <div class="space-y-6">
                    @foreach([
                        ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'text' => 'Jam operasional kami: 08:00 – 22:00 WIB'],
                        ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'text' => 'Reservasi akan dikonfirmasi otomatis via Email'],
                        ['icon' => 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'text' => 'Batas waktu tunggu keterlambatan adalah 15 menit'],
                        ['icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'text' => 'Pastikan nomor WhatsApp Anda aktif untuk konfirmasi'],
                    ] as $info)
                    <div class="flex items-start gap-4 group">
                        <div class="w-8 h-8 bg-mocca/10 rounded-xl flex items-center justify-center text-mocca flex-shrink-0 group-hover:scale-110 transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $info['icon'] }}"/></svg>
                        </div>
                        <span class="text-cream/40 text-[0.8rem] mt-1 leading-relaxed">{{ $info['text'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- User Recent Reservations --}}
            @auth
            @php
                $myReservations = \App\Models\TableReservation::where('user_id', auth()->id())->latest()->take(3)->get();
            @endphp
            @if($myReservations->isNotEmpty())
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h3 class="font-display text-2xl text-cream font-bold">Aktivitas Terbaru</h3>
                    <span class="text-mocca/30 text-[0.6rem] font-bold uppercase tracking-widest">3 Terakhir</span>
                </div>
                @foreach($myReservations as $res)
                <div class="bg-warm border border-white/5 rounded-3xl p-6 hover:border-mocca/20 transition-all duration-500">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <p class="text-mocca font-bold text-xs tracking-[0.15em] mb-1 uppercase">{{ $res->reservation_code }}</p>
                            <p class="text-cream font-bold text-lg">{{ $res->reservation_date->format('d M Y') }}</p>
                            <p class="text-cream/30 text-xs font-medium">{{ substr($res->reservation_time, 0, 5) }} WIB · {{ $res->area }}</p>
                        </div>
                        <span class="badge badge-status-{{ $res->status }}">{{ $res->status }}</span>
                    </div>
                    
                    <div class="pt-4 border-t border-white/[0.03] flex items-center justify-between">
                        <span class="text-cream/15 text-[0.7rem] font-bold uppercase tracking-widest">{{ $res->guest_count }} People</span>
                        @if($res->status === 'Pending')
                        <form action="{{ route('reservation.cancel', $res) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" onclick="return confirm('Batalkan reservasi ini?')"
                                    class="text-red-400/40 hover:text-red-400 text-xs font-bold uppercase tracking-widest transition-colors">
                                Cancel Booking
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
