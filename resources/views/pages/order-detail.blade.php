@extends('layouts.app')
@section('title', 'Detail Pesanan')

@section('content')

{{-- ═══════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden py-16 md:py-20">
    <div class="absolute inset-0 bg-dark"></div>
    <div class="absolute inset-0 opacity-15"
         style="background-image: radial-gradient(circle at 10% 20%, #CCB196 0%, transparent 40%), radial-gradient(circle at 90% 80%, #6B4226 0%, transparent 40%)">
    </div>
    <div class="absolute right-0 top-0 w-[400px] h-[400px] bg-mocca/[0.03] rounded-full blur-[100px]"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
            <div class="animate-fade-in-up">
                <a href="{{ route('orders.index') }}" class="inline-flex items-center gap-2 text-mocca/40 hover:text-mocca text-[0.625rem] font-bold uppercase tracking-[0.2em] transition-colors mb-6 group">
                     <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                     Kembali ke Daftar
                </a>
                <div class="flex flex-wrap items-center gap-4 mb-2">
                    <h1 class="font-display text-4xl text-cream font-bold leading-none">{{ $order->order_number }}</h1>
                    <span class="badge badge-status-{{ $order->status }} !text-[0.625rem] py-0.5 px-3 uppercase tracking-wider">{{ $order->status }}</span>
                </div>
                <p class="text-cream/20 text-[0.625rem] font-bold uppercase tracking-widest">Dipesan pada {{ $order->created_at->format('d M Y, H:i') }} WIB</p>
            </div>
            
            <div class="flex items-center gap-8 animate-fade-in-up" style="animation-delay: 0.1s">
                <div class="text-right">
                    <div class="text-cream/15 text-[0.625rem] font-bold uppercase tracking-widest mb-1">Total Pembayaran</div>
                    <div class="text-mocca font-bold text-3xl leading-none">{{ $order->formatted_total }}</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     ORDER CONTENT
     ═══════════════════════════════════════ --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 pb-28">
    
    <div class="grid lg:grid-cols-12 gap-10 items-start">
        
        {{-- Item Details Column --}}
        <div class="lg:col-span-8 space-y-8 reveal">
            
            {{-- Order Items --}}
            <div class="bg-white/[0.02] border border-white/[0.05] rounded-[2.5rem] overflow-hidden">
                <div class="px-8 py-6 border-b border-white/[0.05] bg-white/[0.01]">
                    <h3 class="font-display text-xl text-cream font-bold">Item Pesanan</h3>
                </div>
                
                <div class="divide-y divide-white/[0.03]">
                    @foreach($order->items as $item)
                    @php
                        $isMenu = (bool)$item->menu_id;
                        $object = $isMenu ? $item->menu : $item->product;
                    @endphp
                    <div class="flex items-center gap-6 p-8 group">
                        <div class="w-16 h-16 bg-gradient-to-br from-white/[0.02] to-mocca/[0.05] rounded-2xl flex items-center justify-center text-mocca ring-1 ring-white/5 transition-transform group-hover:scale-105 flex-shrink-0 relative">
                             @if($object?->image)
                                <img src="{{ $object->image_url }}" class="w-full h-full object-cover">
                             @else
                                <div class="opacity-30 text-xs">{{ $isMenu ? '☕' : '🫘' }}</div>
                             @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-cream font-bold group-hover:text-mocca transition-colors truncate">{{ $item->product_name }}</h4>
                            <p class="text-cream/20 text-[0.75rem] font-bold uppercase tracking-widest mt-1">{{ $item->quantity }} x {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <span class="text-cream font-bold text-sm">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="bg-white/[0.01] p-8 space-y-4 border-t border-white/[0.05]">
                    <div class="flex justify-between items-center">
                        <span class="text-cream/30 text-xs font-semibold uppercase tracking-widest">Subtotal Item</span>
                        <span class="text-cream/60 font-bold text-sm">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-cream/30 text-xs font-semibold uppercase tracking-widest">Ongkos Kirim</span>
                        <span class="text-cream/60 font-bold text-sm">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t border-white/[0.03]">
                        <span class="text-cream/40 text-[0.625rem] font-bold uppercase tracking-[0.2em]">Total Tagihan</span>
                        <span class="text-mocca font-bold text-2xl leading-none">{{ $order->formatted_total }}</span>
                    </div>
                </div>
            </div>

            {{-- Payment Action --}}
            @if($order->status === 'Pending' && $order->payment_method === 'Transfer')
            <div class="bg-indigo-500/[0.03] border border-indigo-500/10 rounded-[2.5rem] p-8 md:p-10">
                <div class="flex flex-col md:flex-row gap-8 items-center">
                    <div class="flex-1 text-center md:text-left">
                        <h3 class="font-display text-2xl text-cream font-bold mb-2">Konfirmasi Pembayaran</h3>
                        <p class="text-indigo-400/60 text-xs font-medium uppercase tracking-widest mb-6">Silakan upload bukti transfer bank Anda</p>
                        
                        <div class="bg-dark/40 rounded-2xl p-6 border border-white/5 space-y-4 mb-8">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-indigo-500/10 rounded-xl flex items-center justify-center text-indigo-400">🏦</div>
                                <div>
                                    <p class="text-cream/20 text-[0.625rem] font-bold uppercase tracking-widest">Bank Central Asia (BCA)</p>
                                    <p class="text-cream font-bold text-lg tracking-wider">1234567890</p>
                                    <p class="text-cream/40 text-[0.625rem] font-bold uppercase tracking-widest mt-0.5">a/n Filo Coffee Warehouse</p>
                                </div>
                            </div>
                        </div>

                        @if($order->payment_proof)
                            <div class="flex items-center gap-3 text-green-400 bg-green-400/5 px-4 py-3 rounded-xl border border-green-400/10 inline-flex">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-xs font-bold uppercase tracking-widest">Bukti Pembayaran Sudah Diupload</span>
                            </div>
                        @else
                            <form action="{{ route('orders.proof', $order) }}" method="POST" enctype="multipart/form-data" class="space-y-4 max-w-md">
                                @csrf
                                <div class="relative group">
                                    <input type="file" name="payment_proof" accept="image/*" required 
                                           class="absolute inset-0 opacity-0 cursor-pointer z-10 w-full"
                                           onchange="this.nextElementSibling.querySelector('#filename').textContent = this.files[0].name">
                                    <div class="bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 flex items-center gap-3 transition-all group-hover:border-indigo-500/40">
                                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                        <span id="filename" class="text-cream/20 text-xs font-bold uppercase tracking-widest overflow-hidden truncate">Pilih Foto Bukti Transfer</span>
                                    </div>
                                </div>
                                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-4 rounded-xl transition-all shadow-xl shadow-indigo-600/10 group flex items-center justify-center gap-3">
                                    <span>Upload Bukti Sekarang</span>
                                    <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </button>
                            </form>
                        @endif
                    </div>

                    @if($order->payment_proof)
                    <div class="w-full md:w-64 flex-shrink-0">
                        <div class="relative group aspect-square rounded-3xl overflow-hidden ring-1 ring-white/10 shadow-2xl">
                             <img src="{{ asset('storage/' . $order->payment_proof) }}" class="w-full h-full object-cover grayscale opacity-50 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700">
                             <div class="absolute inset-0 flex items-center justify-center opacity-40 group-hover:opacity-10 transition-opacity">
                                  <span class="text-[0.625rem] font-bold uppercase tracking-widest bg-dark/80 px-3 py-1 rounded-full text-cream border border-white/10">Lihat Bukti</span>
                             </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

        {{-- Sidebar Info Column --}}
        <div class="lg:col-span-4 space-y-8 reveal" style="transition-delay: 0.1s">
            
            {{-- Delivery Info --}}
            <div class="bg-white/[0.02] border border-white/[0.05] rounded-[2.5rem] p-8 relative overflow-hidden">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-mocca/[0.03] rounded-full blur-2xl"></div>
                <h3 class="font-display text-xl text-cream font-bold mb-8">Informasi Pengiriman</h3>
                
                <div class="space-y-6">
                    <div class="flex flex-col gap-1">
                        <span class="text-cream/15 text-[0.625rem] font-bold uppercase tracking-widest">Penerima</span>
                        <span class="text-cream text-sm font-bold">{{ $order->recipient_name }}</span>
                        <span class="text-cream/40 text-xs tracking-wider">{{ $order->recipient_phone }}</span>
                    </div>

                    <div class="flex flex-col gap-1">
                        <span class="text-cream/15 text-[0.625rem] font-bold uppercase tracking-widest">Alamat Tujuan</span>
                        <p class="text-cream/60 text-sm leading-relaxed">{{ $order->shipping_address }}</p>
                        <p class="text-cream/60 text-sm italic">{{ $order->shipping_city }}, {{ $order->shipping_province }} {{ $order->shipping_zip }}</p>
                    </div>
                </div>
            </div>

            {{-- Summary Sidebar --}}
            <div class="bg-white/[0.02] border border-white/[0.05] rounded-[2.5rem] p-8">
                <h3 class="font-display text-xl text-cream font-bold mb-8">Informasi Pesanan</h3>
                
                <div class="space-y-4 text-xs font-bold uppercase tracking-widest">
                    <div class="flex justify-between items-center py-3 border-b border-white/[0.03]">
                        <span class="text-cream/20">Metode Bayar</span>
                        <span class="text-cream/60">{{ $order->payment_method }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-white/[0.03]">
                        <span class="text-cream/20">Tanggal Pesan</span>
                        <span class="text-cream/60">{{ $order->created_at->format('d M Y') }}</span>
                    </div>
                    @if($order->paid_at)
                    <div class="flex justify-between items-center py-3 border-b border-white/[0.03]">
                        <span class="text-cream/20">Tanggal Bayar</span>
                        <span class="text-green-400/60">{{ $order->paid_at->format('d M Y') }}</span>
                    </div>
                    @endif
                </div>

                <div class="mt-8">
                     <div class="p-4 bg-white/[0.03] border border-white/5 rounded-2xl flex items-center gap-3 group">
                        <div class="w-8 h-8 rounded-lg bg-mocca/10 flex items-center justify-center text-mocca group-hover:scale-110 transition-transform">
                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-cream/15 text-[0.5rem] uppercase tracking-widest font-bold leading-relaxed">Admin akan memproses pesanan Anda setelah pembayaran terkonfirmasi.</p>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
