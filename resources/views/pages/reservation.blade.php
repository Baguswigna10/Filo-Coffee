@extends('layouts.app')
@section('title', 'Reservasi Meja | Filo Coffee')
@section('meta_description', 'Pesan meja favorit Anda di Filo Coffee. Tersedia area Indoor, Outdoor, Working Space, dan Private Room eksklusif.')

@section('content')

{{-- ═══════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[50vh] flex items-center bg-beige-50">
    {{-- Decorative Background --}}
    <div class="absolute inset-0 opacity-50 pointer-events-none"
         style="background-image: radial-gradient(circle at 80% 80%, #E6DCCF 0%, transparent 45%), radial-gradient(circle at 20% 20%, #CFDAD0 0%, transparent 45%)">
    </div>
    <div class="absolute right-[-5%] top-0 w-[450px] h-[450px] bg-olive-200/30 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute left-[-5%] bottom-0 w-80 h-80 bg-beige-200/40 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 z-10">
        <div class="max-w-3xl animate-fade-in-up">
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-8 h-[1.5px] bg-olive-500"></span>
                <span class="text-olive-700 text-xs font-bold tracking-[0.25em] uppercase">Private Booking</span>
            </div>
            <h1 class="font-display text-5xl md:text-7xl text-olive-900 font-bold leading-[1.05] mb-8">
                Reservasi<br>
                <span class="text-beige-600 italic font-semibold">Meja Anda.</span>
            </h1>
            <p class="text-olive-800/70 text-lg md:text-xl leading-relaxed mb-12 max-w-2xl">
                Pesan tempat favorit Anda sebelumnya untuk memastikan kenyamanan momen santai Anda di Filo Coffee.
            </p>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     BOOKING CONTENT
     ═══════════════════════════════════════ --}}
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid lg:grid-cols-12 gap-14 items-start">

            {{-- ═══════════════════════════════════
                 BOOKING FORM COLUMN
                 ═══════════════════════════════════ --}}
            <div class="lg:col-span-7 reveal">
                <div class="bg-beige-50 border border-beige-200 rounded-2xl p-8 md:p-12 shadow-lg shadow-olive-900/5">
                    {{-- Header --}}
                    <div class="flex items-center gap-5 mb-10">
                        <div class="w-14 h-14 bg-olive-800 rounded-2xl flex items-center justify-center text-beige-50 shadow-lg">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <h2 class="font-display text-2xl text-olive-900 font-bold">Lengkapi Data</h2>
                            <p class="text-olive-500 text-[0.65rem] uppercase tracking-[0.2em] font-bold mt-0.5">Konfirmasi Instan Untuk Kunjungan Anda</p>
                        </div>
                    </div>

                    {{-- Success/Error Messages --}}
                    @if(session('success'))
                    <div class="mb-8 p-5 bg-green-50 border border-green-200 rounded-2xl flex items-center gap-4">
                        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center text-green-600 flex-shrink-0 font-bold">✓</div>
                        <p class="text-green-800 font-semibold text-sm">{{ session('success') }}</p>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="mb-8 p-5 bg-red-50 border border-red-200 rounded-2xl flex items-center gap-4">
                        <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center text-red-600 flex-shrink-0 font-bold">!</div>
                        <p class="text-red-800 font-semibold text-sm">{{ session('error') }}</p>
                    </div>
                    @endif

                    {{-- Guest login notice --}}
                    @guest
                    <div class="bg-olive-50 border border-olive-200 rounded-2xl p-5 mb-8 flex items-center gap-4">
                        <div class="w-10 h-10 bg-olive-100 rounded-xl flex items-center justify-center text-olive-700 font-bold flex-shrink-0">!</div>
                        <p class="text-olive-700 text-sm">
                            <a href="{{ route('login') }}" class="text-olive-900 font-bold underline decoration-olive-400 underline-offset-2 hover:text-olive-700">Login sekarang</a> untuk mempermudah pelacakan status reservasi Anda secara real-time.
                        </p>
                    </div>
                    @endguest

                    {{-- FORM --}}
                    <form action="{{ route('reservation.store') }}" method="POST" class="space-y-7">
                        @csrf

                        {{-- Name + Phone --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Nama Lengkap *</label>
                                <input type="text" name="name" value="{{ old('name', auth()->user()?->name) }}" required
                                       class="w-full bg-white border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 placeholder:text-olive-300 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium"
                                       placeholder="Masukkan nama Anda">
                                @error('name')<span class="text-red-500 text-xs font-medium ml-1">{{ $message }}</span>@enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">No. Telepon *</label>
                                <input type="tel" name="phone" value="{{ old('phone', auth()->user()?->phone) }}" required
                                       class="w-full bg-white border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 placeholder:text-olive-300 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium"
                                       placeholder="08xxxxxxxx">
                                @error('phone')<span class="text-red-500 text-xs font-medium ml-1">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="space-y-2">
                            <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Alamat Email *</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()?->email) }}" required
                                   class="w-full bg-white border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 placeholder:text-olive-300 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium"
                                   placeholder="nama@email.com">
                            @error('email')<span class="text-red-500 text-xs font-medium ml-1">{{ $message }}</span>@enderror
                        </div>

                        {{-- Date + Time --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Tanggal Kunjungan *</label>
                                <input type="date" name="reservation_date" value="{{ old('reservation_date') }}" required
                                       min="{{ date('Y-m-d') }}"
                                       class="w-full bg-white border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium">
                                @error('reservation_date')<span class="text-red-500 text-xs font-medium ml-1">{{ $message }}</span>@enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Waktu Datang *</label>
                                <select name="reservation_time" required
                                        class="w-full bg-white border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium appearance-none cursor-pointer">
                                    <option value="">Pilih jam</option>
                                    @for($h = 8; $h < 22; $h++)
                                    <option value="{{ sprintf('%02d:00', $h) }}" {{ old('reservation_time') == sprintf('%02d:00', $h) ? 'selected' : '' }}>
                                        {{ sprintf('%02d:00', $h) }}:00 WIB
                                    </option>
                                    @endfor
                                </select>
                                @error('reservation_time')<span class="text-red-500 text-xs font-medium ml-1">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        {{-- Guest Count + Area --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Jumlah Tamu *</label>
                                <input type="number" name="guest_count" value="{{ old('guest_count', 2) }}" min="1" max="20" required
                                       class="w-full bg-white border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium">
                                @error('guest_count')<span class="text-red-500 text-xs font-medium ml-1">{{ $message }}</span>@enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Pilih Area / Tipe Ruang *</label>
                                <select name="area" id="area-select" required
                                        class="w-full bg-white border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium appearance-none cursor-pointer">
                                    <option value="">Pilih area/tipe ruang</option>
                                    <option value="Indoor" {{ old('area') == 'Indoor' ? 'selected' : '' }}>Indoor (AC)</option>
                                    <option value="Outdoor" {{ old('area') == 'Outdoor' ? 'selected' : '' }}>Outdoor (Nature)</option>
                                    <option value="Smoking" {{ old('area') == 'Smoking' ? 'selected' : '' }}>Smoking Area</option>
                                    <option value="Working Space" {{ old('area') == 'Working Space' ? 'selected' : '' }}>Working Space (Single/Group - AC)</option>
                                    <option value="Private Room" {{ old('area') == 'Private Room' ? 'selected' : '' }}>Private Room (VIP Room - AC)</option>
                                </select>
                                @error('area')<span class="text-red-500 text-xs font-medium ml-1">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        {{-- Table Number --}}
                        <div class="space-y-2">
                            <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Pilih Nomor Meja / Ruangan *</label>
                            <select name="table_number" id="table-select" required
                                    class="w-full bg-white border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium appearance-none cursor-pointer">
                                <option value="">Pilih area terlebih dahulu</option>
                            </select>
                            @error('table_number')<span class="text-red-500 text-xs font-medium ml-1">{{ $message }}</span>@enderror
                        </div>

                        {{-- Special Request --}}
                        <div class="space-y-2">
                            <label class="block text-[0.65rem] font-bold uppercase tracking-[0.2em] text-olive-500 ml-1">Permintaan Khusus (Opsional)</label>
                            <textarea name="special_request" rows="3"
                                      class="w-full bg-white border border-beige-200 rounded-xl px-5 py-3.5 text-olive-900 placeholder:text-olive-300 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium resize-none"
                                      placeholder="Misal: Rayakan ulang tahun, butuh kursi bayi, atau meja di pojok...">{{ old('special_request') }}</textarea>
                        </div>

                        {{-- Submit --}}
                        <div class="pt-4">
                            <button type="submit" class="w-full bg-olive-800 text-beige-50 hover:bg-olive-900 py-4 rounded-2xl font-bold transition-all duration-300 hover:-translate-y-0.5 shadow-lg shadow-olive-900/20 flex items-center justify-center gap-3 group text-base">
                                <span>Konfirmasi Reservasi</span>
                                <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ═══════════════════════════════════
                 SIDEBAR COLUMN
                 ═══════════════════════════════════ --}}
            <div class="lg:col-span-5 space-y-8 reveal" style="transition-delay: 0.1s">

                {{-- AREA INFO CARDS --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-1 gap-4">
                    @foreach([
                        ['emoji' => '🏠', 'name' => 'Indoor Space', 'desc' => 'Full AC dengan musik santai, cocok untuk bekerja.', 'bg' => 'bg-olive-50', 'border' => 'border-olive-200'],
                        ['emoji' => '🌿', 'name' => 'Outdoor Garden', 'desc' => 'Suasana terbuka yang asri dikelilingi pepohonan.', 'bg' => 'bg-green-50', 'border' => 'border-green-200'],
                        ['emoji' => '🚬', 'name' => 'Smoking Area', 'desc' => 'Ruang terbuka khusus dengan sirkulasi udara baik.', 'bg' => 'bg-beige-50', 'border' => 'border-beige-300'],
                        ['emoji' => '💻', 'name' => 'Working Space', 'desc' => 'Sudut tenang dengan high-speed WiFi, stopkontak melimpah.', 'bg' => 'bg-blue-50', 'border' => 'border-blue-200'],
                        ['emoji' => '🔑', 'name' => 'Private Room', 'desc' => 'Ruang VIP eksklusif dengan AC, TV Smart, kedap suara.', 'bg' => 'bg-amber-50', 'border' => 'border-amber-200'],
                    ] as $area)
                    <div class="bg-white border border-beige-200 rounded-2xl p-6 hover:border-olive-400 hover:shadow-md transition-all duration-500 group">
                        <div class="flex items-start gap-5">
                            <div class="w-14 h-14 {{ $area['bg'] }} {{ $area['border'] }} border rounded-2xl flex items-center justify-center text-2xl group-hover:scale-105 transition-transform duration-500 flex-shrink-0">
                                {{ $area['emoji'] }}
                            </div>
                            <div>
                                <h3 class="text-olive-900 font-bold text-base mb-1 group-hover:text-olive-700 transition-colors">{{ $area['name'] }}</h3>
                                <p class="text-olive-500 text-sm leading-relaxed">{{ $area['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- POLICY INFO --}}
                <div class="bg-beige-50 border border-beige-200 rounded-2xl p-8 relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-olive-100/50 rounded-full blur-2xl pointer-events-none"></div>
                    <h3 class="font-display text-xl text-olive-900 font-bold mb-6 relative">Panduan Reservasi</h3>
                    <div class="space-y-5 relative">
                        @foreach([
                            ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'text' => 'Jam operasional: 08:00 – 22:00 WIB'],
                            ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'text' => 'Reservasi dikonfirmasi otomatis via Email'],
                            ['icon' => 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'text' => 'Batas waktu tunggu keterlambatan: 15 menit'],
                            ['icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'text' => 'Pastikan WhatsApp Anda aktif untuk konfirmasi'],
                        ] as $info)
                        <div class="flex items-start gap-4 group">
                            <div class="w-8 h-8 bg-olive-100 border border-olive-200 rounded-lg flex items-center justify-center text-olive-600 flex-shrink-0 group-hover:bg-olive-800 group-hover:text-beige-50 group-hover:border-olive-800 transition-all duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $info['icon'] }}"/></svg>
                            </div>
                            <span class="text-olive-700 text-sm mt-0.5 leading-relaxed group-hover:text-olive-900 transition-colors">{{ $info['text'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- USER RECENT RESERVATIONS --}}
                @auth
                @php
                    $myReservations = \App\Models\TableReservation::where('user_id', auth()->id())->latest()->take(3)->get();
                @endphp
                @if($myReservations->isNotEmpty())
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="font-display text-xl text-olive-900 font-bold">Aktivitas Terbaru</h3>
                        <span class="text-olive-400 text-[0.6rem] font-bold uppercase tracking-[0.3em]">3 Terakhir</span>
                    </div>
                    @foreach($myReservations as $res)
                    @php
                        $createdAt = $res->created_at;
                        $minutesSince = $createdAt->diffInMinutes(now());
                        $canEdit = $minutesSince < 20 && in_array($res->status, ['Pending', 'Confirmed']);
                        $editDeadline = $createdAt->addMinutes(20)->timestamp;
                    @endphp
                    <div class="bg-white border border-beige-200 rounded-2xl p-6 hover:border-olive-300 hover:shadow-md transition-all duration-500 group">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-olive-600 font-bold text-xs tracking-[0.15em] mb-1 uppercase">{{ $res->reservation_code }}</p>
                                <p class="text-olive-900 font-bold text-base">{{ $res->reservation_date->format('d M Y') }}</p>
                                <p class="text-olive-400 text-xs font-medium">{{ substr($res->reservation_time, 0, 5) }} WIB · {{ $res->area }} · {{ $res->table_number ?? '-' }}</p>
                            </div>
                            @php
                                $statusColors = [
                                    'Pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                                    'Confirmed' => 'bg-green-50 text-green-700 border-green-200',
                                    'Cancelled' => 'bg-red-50 text-red-700 border-red-200',
                                    'Completed' => 'bg-olive-50 text-olive-700 border-olive-200',
                                ];
                                $statusClass = $statusColors[$res->status] ?? 'bg-beige-50 text-olive-700 border-beige-200';
                            @endphp
                            <span class="px-3 py-1 rounded-full text-[0.6rem] font-bold uppercase tracking-wider border {{ $statusClass }}">{{ $res->status }}</span>
                        </div>

                        {{-- Countdown Timer (only shown if editable) --}}
                        @if($canEdit)
                        <div class="mb-3 px-3 py-2 bg-amber-50 border border-amber-200 rounded-xl flex items-center gap-2">
                            <span class="text-amber-500 text-sm">⏱</span>
                            <span class="text-amber-700 text-xs font-medium">Bisa diubah selama: </span>
                            <span class="text-amber-800 font-bold text-xs tabular-nums" id="countdown-tbl-{{ $res->id }}" data-deadline="{{ $editDeadline }}">--:--</span>
                        </div>
                        @endif

                        <div class="pt-4 border-t border-beige-100 flex items-center justify-between gap-3">
                            <span class="text-olive-300 text-[0.7rem] font-bold uppercase tracking-widest">{{ $res->guest_count }} Orang</span>
                            <div class="flex items-center gap-3">
                                @if($canEdit)
                                <button type="button"
                                    onclick="openTableModal({{ $res->id }}, {{ json_encode($res->only(['name','phone','email','reservation_date','reservation_time','guest_count','area','table_number','special_request'])) }})"
                                    class="text-olive-700 hover:text-olive-900 border border-olive-300 hover:border-olive-600 bg-white hover:bg-olive-50 text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded-lg transition-all duration-200">
                                    ✏ Ubah Detail
                                </button>
                                @endif
                                @if($res->status === 'Pending')
                                <form action="{{ route('reservation.cancel', $res) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" onclick="return confirm('Batalkan reservasi ini?')"
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
     TABLE JS LOGIC
     ═══════════════════════════════════════ --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const areaSelect = document.getElementById('area-select');
    const tableSelect = document.getElementById('table-select');

    const tablesList = @json(\App\Models\TableReservation::getTablesList());
    const oldTableNumber = "{{ old('table_number') }}";

    function updateTables() {
        const area = areaSelect.value;
        tableSelect.innerHTML = '';

        if (!area || !tablesList[area]) {
            const opt = document.createElement('option');
            opt.value = '';
            opt.textContent = '-- Pilih area terlebih dahulu --';
            tableSelect.appendChild(opt);
            return;
        }

        const optDefault = document.createElement('option');
        optDefault.value = '';
        optDefault.textContent = 'Pilih nomor meja / ruangan';
        tableSelect.appendChild(optDefault);

        tablesList[area].forEach(function (table) {
            const opt = document.createElement('option');
            opt.value = table;
            opt.textContent = table;
            if (oldTableNumber === table) {
                opt.selected = true;
            }
            tableSelect.appendChild(opt);
        });
    }

    areaSelect.addEventListener('change', updateTables);

    if (areaSelect.value) {
        updateTables();
    }
});
</script>

{{-- ═══════════════════════════════════════
     RESCHEDULE MODAL (Table Reservation)
     ═══════════════════════════════════════ --}}
<div id="modal-table-reschedule" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-olive-950/60 backdrop-blur-sm" onclick="closeTableModal()"></div>

    {{-- Modal Panel --}}
    <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto animate-fade-in-up">
        {{-- Header --}}
        <div class="sticky top-0 bg-white border-b border-beige-100 px-8 py-5 flex items-center justify-between rounded-t-3xl z-10">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-olive-100 rounded-xl flex items-center justify-center text-olive-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <div>
                    <h2 class="font-display text-lg text-olive-900 font-bold">Ubah Detail Reservasi</h2>
                    <p class="text-olive-400 text-[0.62rem] font-bold uppercase tracking-widest">Sisa waktu: <span id="modal-countdown-tbl" class="text-amber-600">--:--</span></p>
                </div>
            </div>
            <button onclick="closeTableModal()" class="w-9 h-9 rounded-xl bg-beige-50 hover:bg-beige-100 flex items-center justify-center text-olive-500 hover:text-olive-800 transition-colors text-xl font-light">×</button>
        </div>

        {{-- Form --}}
        <form id="form-table-reschedule" action="" method="POST" class="px-8 py-7 space-y-6">
            @csrf @method('PATCH')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-2">
                    <label class="block text-[0.62rem] font-bold uppercase tracking-[0.2em] text-olive-500">Nama Lengkap *</label>
                    <input type="text" name="name" id="tbl-name" required
                           class="w-full bg-beige-50 border border-beige-200 rounded-xl px-4 py-3 text-olive-900 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium">
                </div>
                <div class="space-y-2">
                    <label class="block text-[0.62rem] font-bold uppercase tracking-[0.2em] text-olive-500">No. Telepon *</label>
                    <input type="tel" name="phone" id="tbl-phone" required
                           class="w-full bg-beige-50 border border-beige-200 rounded-xl px-4 py-3 text-olive-900 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium">
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-[0.62rem] font-bold uppercase tracking-[0.2em] text-olive-500">Alamat Email *</label>
                <input type="email" name="email" id="tbl-email" required
                       class="w-full bg-beige-50 border border-beige-200 rounded-xl px-4 py-3 text-olive-900 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-2">
                    <label class="block text-[0.62rem] font-bold uppercase tracking-[0.2em] text-olive-500">Tanggal Kunjungan *</label>
                    <input type="date" name="reservation_date" id="tbl-date" min="{{ date('Y-m-d') }}" required
                           class="w-full bg-beige-50 border border-beige-200 rounded-xl px-4 py-3 text-olive-900 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium">
                </div>
                <div class="space-y-2">
                    <label class="block text-[0.62rem] font-bold uppercase tracking-[0.2em] text-olive-500">Waktu Datang *</label>
                    <select name="reservation_time" id="tbl-time" required
                            class="w-full bg-beige-50 border border-beige-200 rounded-xl px-4 py-3 text-olive-900 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium appearance-none cursor-pointer">
                        @for($h = 8; $h < 22; $h++)
                        <option value="{{ sprintf('%02d:00', $h) }}">{{ sprintf('%02d:00', $h) }}:00 WIB</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-2">
                    <label class="block text-[0.62rem] font-bold uppercase tracking-[0.2em] text-olive-500">Jumlah Tamu *</label>
                    <input type="number" name="guest_count" id="tbl-guests" min="1" max="20" required
                           class="w-full bg-beige-50 border border-beige-200 rounded-xl px-4 py-3 text-olive-900 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium">
                </div>
                <div class="space-y-2">
                    <label class="block text-[0.62rem] font-bold uppercase tracking-[0.2em] text-olive-500">Pilih Area *</label>
                    <select name="area" id="tbl-area" required onchange="updateModalTables()"
                            class="w-full bg-beige-50 border border-beige-200 rounded-xl px-4 py-3 text-olive-900 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium appearance-none cursor-pointer">
                        <option value="Indoor">Indoor (AC)</option>
                        <option value="Outdoor">Outdoor (Nature)</option>
                        <option value="Smoking">Smoking Area</option>
                        <option value="Working Space">Working Space (AC)</option>
                        <option value="Private Room">Private Room (VIP - AC)</option>
                    </select>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-[0.62rem] font-bold uppercase tracking-[0.2em] text-olive-500">Nomor Meja / Ruangan *</label>
                <select name="table_number" id="tbl-table" required
                        class="w-full bg-beige-50 border border-beige-200 rounded-xl px-4 py-3 text-olive-900 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium appearance-none cursor-pointer">
                </select>
            </div>

            <div class="space-y-2">
                <label class="block text-[0.62rem] font-bold uppercase tracking-[0.2em] text-olive-500">Permintaan Khusus (Opsional)</label>
                <textarea name="special_request" id="tbl-special" rows="2"
                          class="w-full bg-beige-50 border border-beige-200 rounded-xl px-4 py-3 text-olive-900 placeholder:text-olive-300 focus:outline-none focus:border-olive-500 focus:ring-2 focus:ring-olive-100 transition-all text-sm font-medium resize-none"
                          placeholder="Misal: Kursi sudut, dekorasi ulang tahun..."></textarea>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="flex-1 bg-olive-800 hover:bg-olive-900 text-beige-50 font-bold py-3.5 rounded-xl transition-all duration-300 text-sm uppercase tracking-widest shadow-md">
                    Simpan Perubahan
                </button>
                <button type="button" onclick="closeTableModal()"
                        class="px-6 py-3.5 border border-beige-200 hover:border-olive-300 bg-white hover:bg-beige-50 text-olive-700 font-bold rounded-xl transition-all duration-200 text-sm">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

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

        // ── Live Countdown Timers ──
        const countdownEls = document.querySelectorAll('[id^="countdown-tbl-"]');
        countdownEls.forEach(el => {
            const deadline = parseInt(el.dataset.deadline) * 1000;
            const tick = () => {
                const remaining = deadline - Date.now();
                if (remaining <= 0) {
                    el.textContent = 'Habis';
                    el.closest('.bg-amber-50')?.remove();
                    // Hide the edit button when time expires
                    const card = el.closest('.rounded-2xl');
                    if (card) card.querySelector('[onclick^="openTableModal"]')?.remove();
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

    // ── Tables List from PHP ──
    const tablesList = @json(\App\Models\TableReservation::getTablesList());

    // ── Modal State ──
    let activeDeadline = null;
    let modalCountdownInterval = null;

    function updateModalTables(selectedTable = '') {
        const area = document.getElementById('tbl-area').value;
        const tableSelect = document.getElementById('tbl-table');
        tableSelect.innerHTML = '';
        if (!area || !tablesList[area]) return;
        tablesList[area].forEach(t => {
            const opt = document.createElement('option');
            opt.value = t;
            opt.textContent = t;
            if (t === selectedTable) opt.selected = true;
            tableSelect.appendChild(opt);
        });
    }

    function openTableModal(id, data) {
        const form = document.getElementById('form-table-reschedule');
        form.action = `/reservation/${id}/reschedule`;

        document.getElementById('tbl-name').value    = data.name    || '';
        document.getElementById('tbl-phone').value   = data.phone   || '';
        document.getElementById('tbl-email').value   = data.email   || '';
        document.getElementById('tbl-guests').value  = data.guest_count || 2;
        document.getElementById('tbl-special').value = data.special_request || '';

        // Date (format from PHP is Y-m-d)
        const dateVal = data.reservation_date ? data.reservation_date.split('T')[0] : '';
        document.getElementById('tbl-date').value = dateVal;

        // Time (strip seconds if present)
        const timeVal = data.reservation_time ? data.reservation_time.substring(0, 5) : '';
        document.getElementById('tbl-time').value = timeVal;

        // Area & Table
        document.getElementById('tbl-area').value = data.area || 'Indoor';
        updateModalTables(data.table_number || '');

        // Start modal countdown
        const cardEl = document.querySelector(`[data-deadline]`);
        // find the matching card's deadline from the inline countdown
        const countdownEls = document.querySelectorAll('[id^="countdown-tbl-"]');
        let deadline = null;
        countdownEls.forEach(el => {
            if (el.id === `countdown-tbl-${id}`) {
                deadline = parseInt(el.dataset.deadline) * 1000;
            }
        });

        if (deadline) {
            clearInterval(modalCountdownInterval);
            const modalTimer = document.getElementById('modal-countdown-tbl');
            const tick = () => {
                const remaining = deadline - Date.now();
                if (remaining <= 0) {
                    modalTimer.textContent = 'Habis';
                    closeTableModal();
                    return;
                }
                const mins = String(Math.floor(remaining / 60000)).padStart(2, '0');
                const secs = String(Math.floor((remaining % 60000) / 1000)).padStart(2, '0');
                modalTimer.textContent = `${mins}:${secs}`;
            };
            tick();
            modalCountdownInterval = setInterval(tick, 1000);
        }

        // Show modal
        const modal = document.getElementById('modal-table-reschedule');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
        if (window.lenis) window.lenis.stop();
    }

    function closeTableModal() {
        clearInterval(modalCountdownInterval);
        const modal = document.getElementById('modal-table-reschedule');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
        if (window.lenis) window.lenis.start();
    }

    // Close modal on Escape key
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeTableModal();
    });
</script>
@endpush
