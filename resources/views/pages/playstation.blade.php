@extends('layouts.app')
@section('title', 'PlayStation Booking | Filo Coffee')
@section('meta_description', 'Main PS4 & PS5 sambil menikmati kopi premium di Filo Coffee. Pengalaman gaming & coffee yang sempurna!')

@section('content')

{{-- ═══════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[50vh] flex items-center bg-beige-50">
    {{-- Decorative Background --}}
    <div class="absolute inset-0 opacity-40 pointer-events-none"
         style="background-image: radial-gradient(circle at 10% 90%, #CFDAD0 0%, transparent 40%), radial-gradient(circle at 90% 10%, #E6DCCF 0%, transparent 40%)">
    </div>
    <div class="absolute right-[-5%] top-0 w-[500px] h-[500px] bg-indigo-100/30 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="absolute left-[-5%] bottom-0 w-80 h-80 bg-beige-200/50 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 z-10">
        <div class="max-w-3xl animate-fade-in-up">
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-8 h-[1.5px] bg-olive-500"></span>
                <span class="text-olive-700 text-xs font-bold tracking-[0.25em] uppercase">Premium Game Zone</span>
            </div>
            <h1 class="font-display text-5xl md:text-7xl text-olive-900 font-bold leading-[1.05] mb-8">
                PlayStation<br>
                <span class="text-beige-600 italic font-semibold">Zone.</span>
            </h1>
            <p class="text-olive-800/70 text-lg md:text-xl leading-relaxed mb-12 max-w-2xl">
                Pengalaman gaming eksklusif dengan konsol terbaru PS5 & PS4 Pro, didukung visual 4K dan suasana coffee shop yang super cozy.
            </p>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     PRICING & BOOKING
     ═══════════════════════════════════════ --}}
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 pb-28">

        {{-- PRICING CARDS --}}
        <div class="grid md:grid-cols-2 gap-8 mb-20">
            {{-- PS4 Card --}}
            <div class="bg-beige-50 border border-beige-200 rounded-2xl p-10 text-center reveal group hover:border-olive-300 hover:shadow-xl transition-all duration-500">
                <div class="w-20 h-20 bg-white border border-beige-200 rounded-[1.5rem] flex items-center justify-center mx-auto mb-6 group-hover:bg-olive-800 group-hover:border-olive-800 transition-all duration-500 shadow-sm">
                    <span class="text-4xl">🎮</span>
                </div>
                <h3 class="font-display text-3xl text-olive-900 font-bold mb-3">PlayStation 4 Pro</h3>
                <div class="flex items-center justify-center gap-2 mb-8">
                    <span class="text-olive-800 font-bold text-3xl">Rp {{ number_format($ps4Price, 0, ',', '.') }}</span>
                    <span class="text-olive-400 text-xs font-bold uppercase tracking-[0.2em]">/ Jam</span>
                </div>
                <ul class="space-y-4 mb-8 text-left max-w-[250px] mx-auto">
                    @foreach([
                        'Controller DualShock 4 Pro',
                        '100+ Koleksi Game Populer',
                        'TV 4K HDR 50" Crystal Display',
                        'Free 1 Minuman Pilihan'
                    ] as $feature)
                    <li class="flex items-center gap-3 text-olive-700 text-sm">
                        <div class="w-5 h-5 rounded-full bg-olive-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3 text-olive-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        {{ $feature }}
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- PS5 Card (Featured) --}}
            <div class="bg-indigo-600 border border-indigo-500 rounded-2xl p-10 text-center relative overflow-hidden reveal group shadow-2xl shadow-indigo-600/15" style="transition-delay: 0.1s">
                <div class="absolute top-6 right-6">
                    <span class="bg-white text-indigo-700 text-[0.6rem] font-bold px-4 py-1.5 rounded-full uppercase tracking-[0.2em] shadow-lg animate-pulse">✦ Ultimate</span>
                </div>
                <div class="w-20 h-20 bg-white/20 border border-white/30 rounded-[1.5rem] flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-all duration-500">
                    <span class="text-4xl">🕹️</span>
                </div>
                <h3 class="font-display text-3xl text-white font-bold mb-3">PlayStation 5</h3>
                <div class="flex items-center justify-center gap-2 mb-8">
                    <span class="text-white font-bold text-3xl">Rp {{ number_format($ps5Price, 0, ',', '.') }}</span>
                    <span class="text-indigo-200 text-xs font-bold uppercase tracking-[0.2em]">/ Jam</span>
                </div>
                <ul class="space-y-4 mb-8 text-left max-w-[250px] mx-auto">
                    @foreach([
                        'Controller DualSense Next-Gen',
                        '50+ Game Eksklusif PS5',
                        'TV OLED 55" 120fps Ready',
                        'Free 1 Minuman + Snack'
                    ] as $feature)
                    <li class="flex items-center gap-3 text-indigo-100 text-sm">
                        <div class="w-5 h-5 rounded-full bg-white/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        {{ $feature }}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- BOOKING FORM + SIDEBAR --}}
        <div class="grid lg:grid-cols-12 gap-14 items-start">

            {{-- Booking Form --}}
            <div class="lg:col-span-7 reveal">
                <div class="bg-beige-50 border border-beige-200 rounded-2xl p-8 md:p-12 shadow-lg shadow-olive-900/5">
                    <div class="flex items-center gap-5 mb-10">
                        <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-indigo-600/20">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <h2 class="font-display text-2xl text-olive-900 font-bold">Booking Form</h2>
                            <p class="text-indigo-500 text-[0.65rem] uppercase tracking-[0.2em] font-bold mt-0.5">Lengkapi Detail Bermain Anda</p>
                        </div>
                    </div>

                    @if(session('success'))
                    <div class="mb-8 p-5 bg-green-50 border border-green-200 rounded-2xl flex items-center gap-4">
                        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center text-green-600 flex-shrink-0 font-bold">✓</div>
                        <p class="text-green-800 font-semibold text-sm">{{ session('success') }}</p>
                    </div>
                    @endif

                    @guest
                    <div class="bg-indigo-50 border border-indigo-200 rounded-2xl p-5 mb-8 flex items-center gap-4">
                        <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 font-bold flex-shrink-0">!</div>
                        <p class="text-indigo-700 text-sm">
                            <a href="{{ route('login') }}" class="text-indigo-800 font-bold underline decoration-indigo-300 underline-offset-2 hover:text-indigo-600">Login sekarang</a> untuk kemudahan tracking status booking Anda.
                        </p>
                    </div>
                    @endguest

                    <form action="{{ route('playstation.store') }}" method="POST" class="space-y-7">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Nama Lengkap *</label>
                                <input type="text" name="name" value="{{ old('name', auth()->user()?->name) }}" required
                                       class="w-full bg-white border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 placeholder:text-olive-300 focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all text-sm font-medium"
                                       placeholder="Nama Anda">
                                @error('name')<span class="text-red-500 text-xs font-medium ml-1">{{ $message }}</span>@enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">No. WhatsApp *</label>
                                <input type="tel" name="phone" value="{{ old('phone', auth()->user()?->phone) }}" required
                                       class="w-full bg-white border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 placeholder:text-olive-300 focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all text-sm font-medium"
                                       placeholder="08xxxxxxxx">
                                @error('phone')<span class="text-red-500 text-xs font-medium ml-1">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Pilihan Konsol *</label>
                            <select name="console_type" id="console_type" required onchange="calcPrice()"
                                    class="w-full bg-white border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all text-sm font-medium appearance-none cursor-pointer">
                                <option value="PS5" {{ old('console_type', 'PS5') == 'PS5' ? 'selected' : '' }}>PlayStation 5 — Premium 4K</option>
                                <option value="PS4" {{ old('console_type') == 'PS4' ? 'selected' : '' }}>PlayStation 4 Pro — High Performance</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Tanggal Bermain *</label>
                                <input type="date" name="reservation_date" value="{{ old('reservation_date') }}" min="{{ date('Y-m-d') }}" required
                                       class="w-full bg-white border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all text-sm font-medium">
                                @error('reservation_date')<span class="text-red-500 text-xs font-medium ml-1">{{ $message }}</span>@enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Jam Mulai *</label>
                                <select name="start_time" required onchange="calcPrice()"
                                        class="w-full bg-white border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all text-sm font-medium appearance-none cursor-pointer">
                                    <option value="">Pilih jam</option>
                                    @for($h = 8; $h < 22; $h++)
                                    <option value="{{ sprintf('%02d:00', $h) }}" {{ old('start_time') == sprintf('%02d:00', $h) ? 'selected' : '' }}>
                                        {{ sprintf('%02d:00', $h) }}:00 WIB
                                    </option>
                                    @endfor
                                </select>
                                @error('start_time')<span class="text-red-500 text-xs font-medium ml-1">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Durasi Bermain *</label>
                                <select name="duration" id="duration" required onchange="calcPrice()"
                                        class="w-full bg-white border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all text-sm font-medium appearance-none cursor-pointer">
                                    @for($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" {{ old('duration', 2) == $i ? 'selected' : '' }}>{{ $i }} Jam</option>
                                    @endfor
                                </select>
                            </div>
                            {{-- Price Preview --}}
                            <div class="bg-white border border-beige-200 rounded-xl p-4 flex flex-col justify-center">
                                <span class="text-olive-400 text-[0.6rem] font-bold uppercase tracking-[0.3em] mb-1">Estimasi Total</span>
                                <span id="price-preview" class="text-indigo-600 font-bold text-2xl leading-none">—</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Catatan (Opsional)</label>
                            <textarea name="notes" rows="3"
                                      class="w-full bg-white border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 placeholder:text-olive-300 focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all text-sm font-medium resize-none"
                                      placeholder="Misal: Request game FIFA, Spider-Man, dll.">{{ old('notes') }}</textarea>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-4 rounded-2xl hover:bg-indigo-700 transition-all duration-300 hover:-translate-y-0.5 shadow-lg shadow-indigo-600/20 flex items-center justify-center gap-3 group text-base">
                                <span>Konfirmasi Booking</span>
                                <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-5 space-y-8 reveal" style="transition-delay: 0.1s">
                {{-- Info Card --}}
                <div class="bg-beige-50 border border-beige-200 rounded-2xl p-8 relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-indigo-100/40 rounded-full blur-2xl pointer-events-none"></div>
                    <h3 class="font-display text-xl text-olive-900 font-bold mb-6 relative">Panduan Bermain</h3>
                    <div class="space-y-5 relative">
                        @foreach([
                            ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'text' => 'Game Zone operasional: 08:00 – 22:00 WIB'],
                            ['icon' => 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14', 'text' => 'Fasilitas PS4 Pro & PS5 dengan TV 4K'],
                            ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'text' => 'Wajib konfirmasi via WhatsApp sebelum datang'],
                            ['icon' => 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z', 'text' => 'Pembayaran aman di lokasi (Cash/QRIS)'],
                        ] as $info)
                        <div class="flex items-start gap-4 group">
                            <div class="w-8 h-8 bg-indigo-50 border border-indigo-200 rounded-lg flex items-center justify-center text-indigo-600 flex-shrink-0 group-hover:bg-indigo-600 group-hover:text-white group-hover:border-indigo-600 transition-all duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $info['icon'] }}"/></svg>
                            </div>
                            <span class="text-olive-700 text-sm mt-0.5 leading-relaxed group-hover:text-olive-900 transition-colors">{{ $info['text'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- My Bookings --}}
                @auth
                @php
                    $myPSBookings = \App\Models\PsReservation::where('user_id', auth()->id())->latest()->take(3)->get();
                @endphp
                @if($myPSBookings->isNotEmpty())
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="font-display text-xl text-olive-900 font-bold">Booking Terbaru</h3>
                        <span class="text-olive-400 text-[0.6rem] font-bold uppercase tracking-[0.3em]">3 Terakhir</span>
                    </div>
                    @foreach($myPSBookings as $res)
                    @php
                        $createdAt = $res->created_at;
                        $minutesSince = $createdAt->diffInMinutes(now());
                        $canEdit = $minutesSince < 20 && in_array($res->status, ['Pending', 'Confirmed']);
                        $editDeadline = $createdAt->addMinutes(20)->timestamp;
                    @endphp
                    <div class="bg-white border border-beige-200 rounded-2xl p-6 hover:border-indigo-300 hover:shadow-md transition-all duration-500 group">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-indigo-600 font-bold text-xs tracking-[0.15em] mb-1 uppercase">{{ $res->reservation_code }}</p>
                                <p class="text-olive-900 font-bold text-base">{{ $res->reservation_date->format('d M Y') }}</p>
                                <p class="text-olive-400 text-xs font-medium">{{ substr($res->start_time, 0, 5) }} WIB · {{ $res->duration }} Jam</p>
                            </div>
                            @php
                                $statusColors = [
                                    'Pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                                    'Confirmed' => 'bg-green-50 text-green-700 border-green-200',
                                    'Cancelled' => 'bg-red-50 text-red-700 border-red-200',
                                    'Completed' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                                ];
                                $statusClass = $statusColors[$res->status] ?? 'bg-beige-50 text-olive-700 border-beige-200';
                            @endphp
                            <span class="px-3 py-1 rounded-full text-[0.6rem] font-bold uppercase tracking-wider border {{ $statusClass }}">{{ $res->status }}</span>
                        </div>

                        {{-- Countdown Timer --}}
                        @if($canEdit)
                        <div class="mb-3 px-3 py-2 bg-amber-50 border border-amber-200 rounded-xl flex items-center gap-2">
                            <span class="text-amber-500 text-sm">⏱</span>
                            <span class="text-amber-700 text-xs font-medium">Bisa diubah selama: </span>
                            <span class="text-amber-800 font-bold text-xs tabular-nums" id="countdown-ps-{{ $res->id }}" data-deadline="{{ $editDeadline }}">--:--</span>
                        </div>
                        @endif

                        <div class="pt-4 border-t border-beige-100 flex items-center justify-between gap-3">
                            <div class="flex flex-col">
                                <span class="text-olive-900 font-bold text-sm group-hover:text-indigo-600 transition-colors">{{ $res->console_type }}</span>
                                <span class="text-olive-400 text-[0.65rem] font-bold uppercase tracking-widest">Total: Rp {{ number_format($res->total_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                @if($canEdit)
                                <button type="button"
                                    onclick="openPsModal({{ $res->id }}, {{ json_encode(['name'=>$res->name,'phone'=>$res->phone,'reservation_date'=>$res->reservation_date->format('Y-m-d'),'start_time'=>substr($res->start_time,0,5),'duration'=>$res->duration,'console_type'=>$res->console_type,'notes'=>$res->notes]) }})"
                                    class="text-indigo-600 hover:text-indigo-800 border border-indigo-200 hover:border-indigo-500 bg-white hover:bg-indigo-50 text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded-lg transition-all duration-200">
                                    ✏ Ubah Detail
                                </button>
                                @endif
                                @if($res->status === 'Pending')
                                <form action="{{ route('playstation.cancel', $res) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" onclick="return confirm('Batalkan booking ini?')"
                                            class="text-red-400 hover:text-red-600 text-xs font-bold uppercase tracking-widest transition-colors">
                                        Batalkan
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
                @endauth
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     RESCHEDULE MODAL (PlayStation Booking)
     ═══════════════════════════════════════ --}}
<div id="modal-ps-reschedule" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-indigo-950/60 backdrop-blur-sm" onclick="closePsModal()"></div>

    {{-- Modal Panel --}}
    <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        {{-- Header --}}
        <div class="sticky top-0 bg-white border-b border-beige-100 px-8 py-5 flex items-center justify-between rounded-t-3xl z-10">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <div>
                    <h2 class="font-display text-lg text-olive-900 font-bold">Ubah Detail Booking PS</h2>
                    <p class="text-olive-400 text-[0.62rem] font-bold uppercase tracking-widest">Sisa waktu: <span id="modal-countdown-ps" class="text-amber-600">--:--</span></p>
                </div>
            </div>
            <button onclick="closePsModal()" class="w-9 h-9 rounded-xl bg-beige-50 hover:bg-beige-100 flex items-center justify-center text-olive-500 hover:text-olive-800 transition-colors text-xl font-light">×</button>
        </div>

        {{-- Form --}}
        <form id="form-ps-reschedule" action="" method="POST" class="px-8 py-7 space-y-6">
            @csrf @method('PATCH')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-2">
                    <label class="block text-[0.62rem] font-bold uppercase tracking-[0.2em] text-olive-500">Nama Lengkap *</label>
                    <input type="text" name="name" id="ps-name" required
                           class="w-full bg-beige-50 border border-beige-200 rounded-xl px-4 py-3 text-olive-900 focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all text-sm font-medium">
                </div>
                <div class="space-y-2">
                    <label class="block text-[0.62rem] font-bold uppercase tracking-[0.2em] text-olive-500">No. WhatsApp *</label>
                    <input type="tel" name="phone" id="ps-phone" required
                           class="w-full bg-beige-50 border border-beige-200 rounded-xl px-4 py-3 text-olive-900 focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all text-sm font-medium">
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-[0.62rem] font-bold uppercase tracking-[0.2em] text-olive-500">Pilihan Konsol *</label>
                <select name="console_type" id="ps-console" required onchange="calcModalPrice()"
                        class="w-full bg-beige-50 border border-beige-200 rounded-xl px-4 py-3 text-olive-900 focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all text-sm font-medium appearance-none cursor-pointer">
                    <option value="PS5">PlayStation 5 — Premium 4K</option>
                    <option value="PS4">PlayStation 4 Pro — High Performance</option>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-2">
                    <label class="block text-[0.62rem] font-bold uppercase tracking-[0.2em] text-olive-500">Tanggal Bermain *</label>
                    <input type="date" name="reservation_date" id="ps-date" min="{{ date('Y-m-d') }}" required
                           class="w-full bg-beige-50 border border-beige-200 rounded-xl px-4 py-3 text-olive-900 focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all text-sm font-medium">
                </div>
                <div class="space-y-2">
                    <label class="block text-[0.62rem] font-bold uppercase tracking-[0.2em] text-olive-500">Jam Mulai *</label>
                    <select name="start_time" id="ps-time" required
                            class="w-full bg-beige-50 border border-beige-200 rounded-xl px-4 py-3 text-olive-900 focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all text-sm font-medium appearance-none cursor-pointer">
                        @for($h = 8; $h < 22; $h++)
                        <option value="{{ sprintf('%02d:00', $h) }}">{{ sprintf('%02d:00', $h) }}:00 WIB</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-2">
                    <label class="block text-[0.62rem] font-bold uppercase tracking-[0.2em] text-olive-500">Durasi Bermain *</label>
                    <select name="duration" id="ps-duration" required onchange="calcModalPrice()"
                            class="w-full bg-beige-50 border border-beige-200 rounded-xl px-4 py-3 text-olive-900 focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all text-sm font-medium appearance-none cursor-pointer">
                        @for($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}">{{ $i }} Jam</option>
                        @endfor
                    </select>
                </div>
                <div class="bg-white border border-beige-200 rounded-xl p-4 flex flex-col justify-center">
                    <span class="text-olive-400 text-[0.6rem] font-bold uppercase tracking-[0.3em] mb-1">Estimasi Total Baru</span>
                    <span id="ps-price-preview" class="text-indigo-600 font-bold text-2xl leading-none">—</span>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-[0.62rem] font-bold uppercase tracking-[0.2em] text-olive-500">Catatan (Opsional)</label>
                <textarea name="notes" id="ps-notes" rows="2"
                          class="w-full bg-beige-50 border border-beige-200 rounded-xl px-4 py-3 text-olive-900 placeholder:text-olive-300 focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all text-sm font-medium resize-none"
                          placeholder="Request game, dll."></textarea>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 rounded-xl transition-all duration-300 text-sm uppercase tracking-widest shadow-md shadow-indigo-600/20">
                    Simpan Perubahan
                </button>
                <button type="button" onclick="closePsModal()"
                        class="px-6 py-3.5 border border-beige-200 hover:border-indigo-300 bg-white hover:bg-indigo-50 text-olive-700 font-bold rounded-xl transition-all duration-200 text-sm">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
const ps4Price = {{ $ps4Price }};
const ps5Price = {{ $ps5Price }};

// ── Main booking form price ──
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

// ── Modal price preview ──
function calcModalPrice() {
    const type     = document.getElementById('ps-console').value;
    const duration = parseInt(document.getElementById('ps-duration').value) || 0;
    const price    = type === 'PS5' ? ps5Price : ps4Price;
    const total    = price * duration;
    document.getElementById('ps-price-preview').textContent = total > 0
        ? 'Rp ' + total.toLocaleString('id-ID')
        : '—';
}

document.addEventListener('DOMContentLoaded', () => {
    const revealItems = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('visible');
        });
    }, { threshold: 0.05 });
    revealItems.forEach(item => observer.observe(item));

    // ── Live Countdown Timers ──
    const countdownEls = document.querySelectorAll('[id^="countdown-ps-"]');
    countdownEls.forEach(el => {
        const deadline = parseInt(el.dataset.deadline) * 1000;
        const tick = () => {
            const remaining = deadline - Date.now();
            if (remaining <= 0) {
                el.textContent = 'Habis';
                el.closest('.bg-amber-50')?.remove();
                // Hide the edit button when timer expires
                const card = el.closest('.rounded-2xl');
                if (card) card.querySelector('[onclick^="openPsModal"]')?.remove();
                return;
            }
            const mins = String(Math.floor(remaining / 60000)).padStart(2, '0');
            const secs = String(Math.floor((remaining % 60000) / 1000)).padStart(2, '0');
            el.textContent = `${mins}:${secs}`;
        };
        tick();
        setInterval(tick, 1000);
    });
});

// ── Modal State ──
let psModalCountdownInterval = null;

function openPsModal(id, data) {
    const form = document.getElementById('form-ps-reschedule');
    form.action = `/playstation/${id}/reschedule`;

    document.getElementById('ps-name').value  = data.name  || '';
    document.getElementById('ps-phone').value = data.phone || '';
    document.getElementById('ps-notes').value = data.notes || '';
    document.getElementById('ps-date').value  = data.reservation_date || '';

    // Time
    const timeVal = data.start_time ? data.start_time.substring(0, 5) : '';
    document.getElementById('ps-time').value = timeVal;

    // Console type
    document.getElementById('ps-console').value = data.console_type || 'PS5';

    // Duration
    document.getElementById('ps-duration').value = data.duration || 1;

    // Update price preview
    calcModalPrice();

    // Find deadline from inline countdown
    const countdownEl = document.getElementById(`countdown-ps-${id}`);
    if (countdownEl) {
        const deadline = parseInt(countdownEl.dataset.deadline) * 1000;
        clearInterval(psModalCountdownInterval);
        const modalTimer = document.getElementById('modal-countdown-ps');
        const tick = () => {
            const remaining = deadline - Date.now();
            if (remaining <= 0) {
                modalTimer.textContent = 'Habis';
                closePsModal();
                return;
            }
            const mins = String(Math.floor(remaining / 60000)).padStart(2, '0');
            const secs = String(Math.floor((remaining % 60000) / 1000)).padStart(2, '0');
            modalTimer.textContent = `${mins}:${secs}`;
        };
        tick();
        psModalCountdownInterval = setInterval(tick, 1000);
    }

    // Show modal
    const modal = document.getElementById('modal-ps-reschedule');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.classList.add('overflow-hidden');
    if (window.lenis) window.lenis.stop();
}

function closePsModal() {
    clearInterval(psModalCountdownInterval);
    const modal = document.getElementById('modal-ps-reschedule');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.classList.remove('overflow-hidden');
    if (window.lenis) window.lenis.start();
}

// Close on Escape key
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closePsModal();
});
</script>
@endpush

