@extends('layouts.app')
@section('title', 'Detail Pesanan #' . $order->order_number . ' | Filo Coffee')

@section('content')

{{-- ═══════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden py-16 md:py-20 flex items-center bg-beige-50">
    {{-- Decorative Background --}}
    <div class="absolute inset-0 opacity-50 pointer-events-none"
         style="background-image: radial-gradient(circle at 15% 15%, #CFDAD0 0%, transparent 40%), radial-gradient(circle at 85% 85%, #E6DCCF 0%, transparent 40%)">
    </div>
    <div class="absolute right-[-5%] top-0 w-[500px] h-[500px] bg-olive-200/30 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="absolute left-[-5%] bottom-0 w-80 h-80 bg-beige-200/50 rounded-full blur-[100px] pointer-events-none"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
            <div class="animate-fade-in-up">
                <a href="{{ route('orders.index') }}" class="inline-flex items-center gap-2 text-olive-700/60 hover:text-olive-900 text-[0.65rem] font-bold uppercase tracking-[0.2em] transition-colors mb-6 group">
                     <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l-7 7m-7 7h18"/></svg>
                     Kembali ke Daftar Pesanan
                </a>
                <div class="flex flex-wrap items-center gap-4 mb-3">
                    <h1 class="font-display text-3xl md:text-4xl text-olive-900 font-bold leading-none">{{ $order->order_number }}</h1>
                    <span class="badge badge-status-{{ $order->status }} !text-[0.65rem] py-1 px-3.5 uppercase tracking-wider shadow-sm">{{ $order->status }}</span>
                </div>
                <p class="text-olive-700/50 text-[0.65rem] font-bold uppercase tracking-widest">Dipesan pada {{ $order->created_at->format('d M Y, H:i') }} WIB</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     ORDER CONTENT
     ═══════════════════════════════════════ --}}
<div class="bg-beige-50 min-h-[60vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pb-28">
        
        <div class="grid lg:grid-cols-12 gap-10 items-start">
            
            {{-- Item Details Column --}}
            <div class="lg:col-span-8 space-y-8 reveal">
                
                {{-- Order Items Card --}}
                <div class="bg-white border border-olive-800/20 rounded-[2rem] overflow-hidden">
                    <div class="px-8 py-6 border-b border-olive-900/5 bg-beige-50/30">
                        <h3 class="font-display text-xl text-olive-900 font-bold">Item Pesanan</h3>
                    </div>
                    
                    <div class="divide-y divide-olive-900/5">
                        @foreach($order->items as $item)
                        @php
                            $isMenu = (bool)$item->menu_id;
                            $object = $isMenu ? $item->menu : $item->product;
                        @endphp
                        <div class="flex items-center gap-6 p-8 group hover:bg-beige-50/20 transition-colors">
                            <div class="w-16 h-16 bg-beige-50 border border-olive-900/5 rounded-2xl flex items-center justify-center text-olive-800 ring-1 ring-olive-900/5 transition-transform group-hover:scale-105 flex-shrink-0 relative">
                                 @if($object?->image)
                                    <img src="{{ $object->image_url }}" class="w-full h-full object-cover rounded-xl">
                                 @else
                                    <div class="opacity-40 text-sm font-semibold">{{ $isMenu ? '☕' : '🫘' }}</div>
                                 @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-olive-900 font-bold group-hover:text-olive-750 transition-colors truncate">{{ $item->product_name }}</h4>
                                <p class="text-olive-700/40 text-[0.75rem] font-bold uppercase tracking-widest mt-1">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <span class="text-olive-900 font-bold text-sm">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="bg-beige-50/30 p-8 space-y-4 border-t border-olive-900/5">
                        <div class="flex justify-between items-center">
                            <span class="text-olive-700/50 text-xs font-semibold uppercase tracking-widest">Subtotal Item</span>
                            <span class="text-olive-800/80 font-bold text-sm">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-olive-700/50 text-xs font-semibold uppercase tracking-widest">Ongkos Kirim</span>
                            <span class="text-olive-800/80 font-bold text-sm">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-5 border-t border-olive-900/10">
                            <span class="text-olive-700/60 text-[0.65rem] font-bold uppercase tracking-[0.2em]">Total Tagihan</span>
                            <span class="text-olive-850 font-display font-bold text-2xl leading-none">{{ $order->formatted_total }}</span>
                        </div>
                    </div>
                </div>

                {{-- Payment Action: Bank Transfer --}}
                @if($order->status === 'Pending' && $order->payment_method === 'Transfer')
                <div class="bg-olive-50 border border-olive-900/5 rounded-[2.5rem] p-8 md:p-10 shadow-xl shadow-olive-900/5">
                    <div class="flex flex-col md:flex-row gap-8 items-center">
                        <div class="flex-1 text-center md:text-left w-full">
                            <h3 class="font-display text-2xl text-olive-900 font-bold mb-2">Konfirmasi Pembayaran</h3>
                            <p class="text-olive-750/70 text-xs font-bold uppercase tracking-widest mb-6">Silakan upload bukti transfer bank Anda</p>
                            
                            <div class="bg-white rounded-2xl p-6 border border-olive-900/5 space-y-4 mb-8 shadow-sm">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-olive-100 rounded-xl flex items-center justify-center text-olive-800">🏦</div>
                                    <div>
                                        <p class="text-olive-700/40 text-[0.625rem] font-bold uppercase tracking-widest">Bank Central Asia (BCA)</p>
                                        <p class="text-olive-900 font-bold text-lg tracking-wider">1234567890</p>
                                        <p class="text-olive-700/60 text-[0.625rem] font-bold uppercase tracking-widest mt-0.5">a/n Filo Coffee Warehouse</p>
                                    </div>
                                </div>
                            </div>

                            @if($order->payment_proof)
                                <div class="flex items-center gap-3 text-green-700 bg-green-50 px-4 py-3 rounded-xl border border-green-200 inline-flex shadow-sm">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span class="text-xs font-bold uppercase tracking-widest">Bukti Pembayaran Sudah Diupload</span>
                                </div>
                            @else
                                <form action="{{ route('orders.proof', $order) }}" method="POST" enctype="multipart/form-data" class="space-y-4 max-w-md">
                                    @csrf
                                    <div class="relative group">
                                        <input type="file" name="payment_proof" accept="image/*" required 
                                               class="absolute inset-0 opacity-0 cursor-pointer z-10 w-full"
                                               onchange="this.nextElementSibling.querySelector('#filename').textContent = this.files[0].name">
                                        <div class="bg-white border border-olive-900/10 rounded-xl px-4 py-3.5 flex items-center gap-3 transition-all group-hover:border-olive-500 shadow-sm">
                                            <svg class="w-5 h-5 text-olive-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                            <span id="filename" class="text-olive-700/50 text-xs font-bold uppercase tracking-widest overflow-hidden truncate">Pilih Foto Bukti Transfer</span>
                                        </div>
                                    </div>
                                    <button type="submit" class="w-full bg-olive-800 hover:bg-olive-900 text-beige-50 font-bold py-4 rounded-xl transition-all shadow-xl shadow-olive-900/10 group flex items-center justify-center gap-3">
                                        <span>Upload Bukti Sekarang</span>
                                        <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </button>
                                </form>
                            @endif
                        </div>

                        @if($order->payment_proof)
                        <div class="w-full md:w-64 flex-shrink-0">
                            <div class="relative group aspect-square rounded-3xl overflow-hidden border border-olive-900/10 shadow-2xl">
                                 <img src="{{ asset('storage/' . $order->payment_proof) }}" class="w-full h-full object-cover opacity-70 group-hover:opacity-100 transition-all duration-700">
                                 <div class="absolute inset-0 flex items-center justify-center bg-olive-900/20 opacity-100 group-hover:bg-transparent transition-all">
                                      <span class="text-[0.625rem] font-bold uppercase tracking-widest bg-olive-950/80 px-4 py-1.5 rounded-full text-beige-50 border border-olive-700/20">Lihat Bukti</span>
                                 </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                {{-- Payment Action: Midtrans QRIS --}}
                @if($order->status === 'Pending' && $order->payment_method === 'Midtrans')
                @php
                    $hasQrisUrl = $order->midtrans_token && str_starts_with($order->midtrans_token, 'http');
                @endphp
                <div class="bg-white border border-olive-800/20 rounded-[2rem] p-8 md:p-10" id="midtrans-section">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 bg-amber-500/10 rounded-2xl flex items-center justify-center text-2xl ring-1 ring-amber-500/20">
                            📱
                        </div>
                        <div>
                            <h3 class="font-display text-2xl text-olive-900 font-bold">Bayar Instan dengan QRIS</h3>
                            <p class="text-amber-800/80 text-xs font-semibold tracking-widest">Scan QR Code dengan aplikasi e-wallet apapun</p>
                        </div>
                    </div>

                    {{-- Supported wallets --}}
                    <div class="flex flex-wrap gap-3 mb-8">
                        @foreach([asset('images/payments/gopay.webp'), asset('images/payments/dana.webp'), asset('images/payments/shopeepay.webp'), asset('images/payments/bri.webp'), asset('images/payments/bca.webp'), asset('images/payments/mandiri.webp'), asset('images/payments/bni.webp')] as $pm)
                        <img src="{{ $pm }}" class="h-5">
                        @endforeach
                    </div>

                    {{-- Tombol Generate QR --}}
                    <div id="qris-generate-area" class="{{ $hasQrisUrl ? 'hidden' : '' }}">
                        <button id="midtrans-pay-btn"
                                data-pay-url="{{ route('midtrans.pay', $order) }}"
                                class="flex items-center gap-3 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold px-8 py-4 rounded-2xl transition-all duration-300 shadow-xl shadow-amber-500/10 hover:shadow-amber-500/20 hover:-translate-y-0.5 group">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                            <span>Bayar Sekarang</span>
                        </button>
                        <div class="flex items-center gap-2 text-olive-700/40 text-[0.6rem] font-bold uppercase tracking-widest mt-4">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            <span>SSL Secured by Midtrans</span>
                        </div>
                    </div>

                    {{-- Loading state --}}
                    <div id="midtrans-loading" class="hidden mt-4 flex items-center gap-3 text-amber-700/80 text-xs font-bold uppercase tracking-widest">
                        <svg class="w-5 h-5 animate-spin text-amber-600" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 12 0 12 12z"></path></svg>
                        <span>Membuat QRIS...</span>
                    </div>

                    {{-- Error state --}}
                    <div id="midtrans-error" class="hidden mt-4 p-4 bg-red-50 border border-red-200 rounded-2xl">
                        <p id="midtrans-error-msg" class="text-red-700 text-xs font-bold uppercase tracking-widest"></p>
                    </div>

                    {{-- QRIS Display Area --}}
                    <div id="qris-display" class="{{ $hasQrisUrl ? '' : 'hidden' }} mt-6">
                        <div class="bg-white border border-olive-800/20 rounded-[2rem] p-6 md:p-8 flex flex-col md:flex-row gap-8 items-center">
                            {{-- QR Code --}}
                            <div class="flex flex-col items-center gap-4 flex-shrink-0">
                                <div class="bg-white p-3 border border-olive-800/20 rounded-[2rem]">
                                    <img id="qris-image" src="{{ $hasQrisUrl ? $order->midtrans_token : '' }}" alt="QRIS Payment Code"
                                         class="w-56 h-56 md:w-64 md:h-64 object-contain rounded-xl">
                                </div>
                                <div id="qris-countdown" class="flex items-center gap-2 text-amber-700 text-xs font-bold uppercase tracking-widest">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span id="countdown-text">Berlaku 15:00</span>

                                </div>
                            </div>

                            {{-- Instructions --}}
                            <div class="flex-1 space-y-5">
                                <div>
                                    <h4 class="font-display text-xl text-olive-900 font-bold mb-1">Cara Bayar QRIS</h4>
                                    <p class="text-olive-700/50 text-xs font-bold uppercase tracking-widest">Total: <span class="text-olive-900 text-base font-bold">{{ $order->formatted_total }}</span></p>
                                </div>
                                <div class="space-y-4">
                                    @foreach([
                                        ['🔓', 'Buka aplikasi e-wallet Anda', 'GoPay, OVO, Dana, ShopeePay, dll.'],
                                        ['📷', 'Pilih menu Scan / QRIS', 'Arahkan kamera ke QR Code di atas'],
                                        ['✅', 'Konfirmasi & selesaikan pembayaran', 'Pastikan nominal sesuai tagihan'],
                                    ] as [$icon, $title, $desc])
                                    <div class="flex gap-4 items-start">
                                        <div class="w-10 h-10 bg-amber-50 border border-amber-200/50 rounded-xl flex items-center justify-center text-lg flex-shrink-0">{{ $icon }}</div>
                                        <div>
                                            <p class="text-olive-900 font-bold text-sm">{{ $title }}</p>
                                            <p class="text-olive-700/50 text-xs mt-0.5">{{ $desc }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                {{-- Auto polling indicator --}}
                                <div id="polling-status" class="flex items-center gap-2 text-olive-700/40 text-[0.6rem] font-bold uppercase tracking-widest pt-4 border-t border-olive-900/5">
                                    <span class="inline-block w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                                    <span>Menunggu konfirmasi pembayaran otomatis...</span>
                                </div>

                                {{-- Paid success indicator (hidden) --}}
                                <div id="payment-success" class="hidden flex items-center gap-3 text-green-700 bg-green-50 border border-green-200 rounded-xl px-4 py-3">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span class="text-xs font-bold uppercase tracking-widest">Pembayaran Berhasil! Halaman akan dimuat ulang...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            {{-- Sidebar Info Column --}}
            <div class="lg:col-span-4 space-y-8 reveal" style="transition-delay: 0.1s">
                
                {{-- Delivery Info Card --}}
                <div class="bg-white border border-olive-800/20 rounded-[2rem] p-8 relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-olive-200/10 rounded-full blur-2xl"></div>
                    <h3 class="font-display text-xl text-olive-900 font-bold mb-8">Informasi Pengiriman</h3>
                    
                    <div class="space-y-6">
                        <div class="flex flex-col gap-1">
                            <span class="text-olive-700/40 text-[0.625rem] font-bold uppercase tracking-widest">Penerima</span>
                            <span class="text-olive-900 text-sm font-bold">{{ $order->recipient_name }}</span>
                            <span class="text-olive-700/60 text-xs tracking-wider font-semibold">{{ $order->recipient_phone }}</span>
                        </div>

                        <div class="flex flex-col gap-1">
                            <span class="text-olive-700/40 text-[0.625rem] font-bold uppercase tracking-widest">Alamat Tujuan</span>
                            <p class="text-olive-800/70 text-sm leading-relaxed">{{ $order->shipping_address }}</p>
                            <p class="text-olive-800/60 text-sm italic font-medium">{{ $order->shipping_city }}, {{ $order->shipping_province }} {{ $order->shipping_zip }}</p>
                        </div>
                    </div>
                </div>

                {{-- Summary Sidebar --}}
                <div class="bg-white border border-olive-800/20 rounded-[2rem] p-8 overflow-hidden">
                    <h3 class="font-display text-xl text-olive-900 font-bold mb-8">Informasi Pesanan</h3>
                    
                    <div class="space-y-4 text-xs font-bold uppercase tracking-widest">
                        <div class="flex justify-between items-center py-3 border-b border-olive-900/5">
                            <span class="text-olive-700/40">Metode Bayar</span>
                            <span class="text-olive-850/80">{{ $order->payment_method }}</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-olive-900/5">
                            <span class="text-olive-700/40">Tanggal Pesan</span>
                            <span class="text-olive-850/80">{{ $order->created_at->format('d M Y') }}</span>
                        </div>
                        @if($order->paid_at)
                        <div class="flex justify-between items-center py-3 border-b border-olive-900/5">
                            <span class="text-olive-700/40">Tanggal Bayar</span>
                            <span class="text-green-700">{{ $order->paid_at->format('d M Y') }}</span>
                        </div>
                        @endif
                    </div>

                    <div class="mt-8">
                         <div class="p-4 bg-olive-55 border border-olive-900/5 rounded-2xl flex items-center gap-3 group">
                            <div class="w-8 h-8 rounded-lg bg-olive-100 flex items-center justify-center text-olive-850 group-hover:scale-105 transition-transform">
                                 <svg class="w-4 h-4 text-olive-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <p class="text-olive-700/60 text-[0.55rem] uppercase tracking-widest font-bold leading-relaxed flex-1">Admin akan memproses pesanan Anda setelah pembayaran terkonfirmasi.</p>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
@if($order->status === 'Pending' && $order->payment_method === 'Midtrans')
<script>
(function() {
    const payBtn         = document.getElementById('midtrans-pay-btn');
    const loadingEl      = document.getElementById('midtrans-loading');
    const errorEl        = document.getElementById('midtrans-error');
    const errorMsgEl     = document.getElementById('midtrans-error-msg');
    const qrisDisplay    = document.getElementById('qris-display');
    const qrisImage      = document.getElementById('qris-image');
    const generateArea   = document.getElementById('qris-generate-area');
    const countdownText  = document.getElementById('countdown-text');
    const pollingStatus  = document.getElementById('polling-status');
    const paymentSuccess = document.getElementById('payment-success');

    let countdownInterval = null;
    let pollingInterval   = null;

    // ── Helper: show error ──
    function showError(msg) {
        loadingEl.classList.add('hidden');
        errorEl.classList.remove('hidden');
        errorMsgEl.textContent = msg;
        if (payBtn) {
            payBtn.disabled = false;
            payBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        }
    }

    // ── Countdown timer (15 minutes) ──
    function startCountdown(seconds) {
        let remaining = seconds;
        function tick() {
            const m = Math.floor(remaining / 60).toString().padStart(2, '0');
            const s = (remaining % 60).toString().padStart(2, '0');
            countdownText.textContent = `Berlaku ${m}:${s}`;
            if (remaining <= 0) {
                clearInterval(countdownInterval);
                countdownText.textContent = 'QRIS Kadaluarsa';
                countdownText.closest('#qris-countdown').classList.replace('text-amber-700', 'text-red-600');
                stopPolling();
            }
            remaining--;
        }
        tick();
        countdownInterval = setInterval(tick, 1000);
    }

    // ── Poll payment status ──
    function startPolling(payUrl) {
        // Poll every 5 seconds
        pollingInterval = setInterval(async () => {
            try {
                const resp = await fetch(payUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ check_status: true }),
                });
                const data = await resp.json();

                // If server says already paid (redirect flag)
                if (!resp.ok && data.redirect) {
                    stopPolling();
                    pollingStatus.classList.add('hidden');
                    paymentSuccess.classList.remove('hidden');
                    setTimeout(() => window.location.reload(), 2000);
                }
            } catch (e) {
                // Ignore polling errors silently
            }
        }, 5000);
    }

    function stopPolling() {
        if (pollingInterval) clearInterval(pollingInterval);
    }

    // ── Show QRIS UI ──
    function showQris(qrCodeUrl) {
        // Hide generate button, show QR
        generateArea.classList.add('hidden');
        loadingEl.classList.add('hidden');
        qrisImage.src = qrCodeUrl;
        qrisDisplay.classList.remove('hidden');

        // Start 15-minute countdown
        startCountdown(15 * 60);

        // Start polling for payment status
        if (payBtn) startPolling(payBtn.dataset.payUrl);
    }

    // ── Button click: generate QRIS ──
    if (payBtn) {
        payBtn.addEventListener('click', async function() {
            payBtn.disabled = true;
            payBtn.classList.add('opacity-50', 'cursor-not-allowed');
            loadingEl.classList.remove('hidden');
            errorEl.classList.add('hidden');

            try {
                const response = await fetch(payBtn.dataset.payUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                });

                const data = await response.json();

                if (!response.ok) {
                    if (data.redirect) {
                        alert(data.error);
                        window.location.reload();
                        return;
                    }
                    throw new Error(data.error || 'Terjadi kesalahan.');
                }

                if (data.qr_code_url) {
                    showQris(data.qr_code_url);
                } else {
                    throw new Error('QRIS tidak tersedia. Silakan coba lagi.');
                }

            } catch (err) {
                showError(err.message || 'Gagal menghubungi server. Coba lagi.');
            }
        });
    }

    // Auto-load countdown/polling if QRIS URL already loaded on page load
    const hasQrisUrl = {{ $hasQrisUrl ? 'true' : 'false' }};
    if (hasQrisUrl) {
        const createdAt = new Date("{{ $order->created_at->toIso8601String() }}");
        const now = new Date();
        const diffSeconds = Math.floor((now - createdAt) / 1000);
        const remainingSeconds = Math.max(0, 15 * 60 - diffSeconds);
        
        if (remainingSeconds > 0) {
            startCountdown(remainingSeconds);
            if (payBtn) startPolling(payBtn.dataset.payUrl);
        } else {
            countdownText.textContent = 'QRIS Kadaluarsa';
            countdownText.closest('#qris-countdown').classList.replace('text-amber-700', 'text-red-600');
        }
    }
})();
</script>
@endif
@endpush
