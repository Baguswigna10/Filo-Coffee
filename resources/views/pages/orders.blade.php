@extends('layouts.app')
@section('title', 'Pesanan Saya')

@section('content')

{{-- ═══════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden py-16 md:py-24">
    <div class="absolute inset-0 bg-dark"></div>
    <div class="absolute inset-0 opacity-15"
         style="background-image: radial-gradient(circle at 50% 100%, #CCB196 0%, transparent 50%)">
    </div>
    <div class="absolute left-0 bottom-0 w-[400px] h-[400px] bg-mocca/[0.03] rounded-full blur-[100px]"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center gap-2 mb-5 animate-fade-in-up">
            <span class="w-8 h-px bg-mocca/50"></span>
            <span class="text-mocca text-xs font-semibold tracking-[0.2em] uppercase">Riwayat Belanja</span>
            <span class="w-8 h-px bg-mocca/50"></span>
        </div>
        <h1 class="font-display text-5xl md:text-6xl text-cream font-bold leading-tight mb-4 animate-fade-in-up" style="animation-delay: 0.1s">
            Pesanan <span class="text-mocca italic">Saya</span>
        </h1>
        <p class="text-cream/35 text-sm md:text-base leading-relaxed max-w-md mx-auto animate-fade-in-up" style="animation-delay: 0.2s">
            Lacak status pengiriman dan lihat detail pesanan menu serta kopi favorit Anda di sini.
        </p>
    </div>
</section>

{{-- ═══════════════════════════════════════
     ORDERS LIST
     ═══════════════════════════════════════ --}}
{{-- ═══════════════════════════════════════
     ORDERS LIST
     ═══════════════════════════════════════ --}}
<section class="py-20 bg-dark relative overflow-hidden">
    {{-- Background Blobs --}}
    <div class="absolute left-0 top-1/4 w-[500px] h-[500px] bg-mocca/[0.03] rounded-full blur-[120px] -translate-x-1/2"></div>
    <div class="absolute right-0 bottom-0 w-[400px] h-[400px] bg-mocca/[0.02] rounded-full blur-[100px] translate-x-1/3 translate-y-1/3"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        @if($orders->isEmpty())
        {{-- Empty State --}}
        <div class="max-w-xl mx-auto text-center py-20 reveal">
            <div class="w-28 h-28 bg-warm border border-white/5 rounded-[3rem] flex items-center justify-center mx-auto mb-10 text-cream/10 shadow-2xl relative group overflow-hidden">
                 <div class="absolute inset-0 bg-mocca opacity-0 group-hover:opacity-10 transition-opacity duration-700"></div>
                 <svg class="w-12 h-12 transition-transform duration-700 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                 </svg>
            </div>
            <h3 class="font-display text-3xl text-cream font-bold mb-4">Belum Ada Pesanan</h3>
            <p class="text-cream/30 text-lg leading-relaxed mb-12">Anda belum pernah melakukan pemesanan. Ingin mulai menjelajahi koleksi menu atau biji kopi terbaik kami?</p>
            <div class="flex flex-wrap justify-center items-center gap-6">
                <a href="{{ route('menu') }}" class="btn-mocca !px-10 !py-4 group">
                    <span>Pesan Menu</span>
                    <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="{{ route('shop') }}" class="btn-outline !px-10 !py-4 group">
                    <span>Beli Kopi</span>
                    <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
        @else
        
        <div class="space-y-6">
            <div class="flex items-center justify-between px-4 mb-4 reveal">
                <span class="text-mocca text-[0.625rem] font-bold uppercase tracking-[0.3em]">{{ $orders->total() }} Riwayat Pesanan</span>
                <div class="w-12 h-px bg-mocca/20"></div>
            </div>
    
            @foreach($orders as $i => $order)
            <div class="reveal" style="transition-delay: {{ ($i % 10) * 0.05 }}s">
                <a href="{{ route('orders.show', $order) }}" class="group block bg-warm border border-white/[0.03] rounded-[2.5rem] p-6 md:p-8 hover:border-mocca/30 hover:bg-warm-light transition-all duration-500 shadow-xl hover:shadow-2xl">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                        {{-- Order Basic Info --}}
                        <div class="flex items-center gap-6">
                            <div class="w-16 h-16 bg-dark/40 border border-white/5 rounded-2xl flex items-center justify-center text-mocca ring-1 ring-white/5 transition-all duration-500 group-hover:scale-110 group-hover:bg-mocca group-hover:text-dark">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            </div>
                            <div>
                                <div class="flex flex-wrap items-center gap-4 mb-2">
                                    <h4 class="font-display text-xl text-cream font-bold group-hover:text-mocca transition-colors">{{ $order->order_number }}</h4>
                                    <span class="badge badge-status-{{ $order->status }} !text-[0.6rem] !px-3 !py-1 uppercase tracking-widest">{{ $order->status }}</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-mocca/60 text-[0.65rem] font-bold uppercase tracking-widest">{{ $order->created_at->format('d M Y') }}</span>
                                    <span class="w-1 h-1 bg-white/10 rounded-full"></span>
                                    <span class="text-cream/20 text-[0.65rem] font-bold uppercase tracking-widest">{{ $order->items->count() }} Items</span>
                                </div>
                            </div>
                        </div>
        
                        {{-- Payment & Action Info --}}
                        <div class="flex items-center justify-between md:justify-end gap-12 border-t md:border-t-0 border-white/[0.03] pt-6 md:pt-0">
                            <div class="text-left md:text-right">
                                <div class="text-cream/10 text-[0.6rem] font-bold uppercase tracking-widest mb-1.5">Total Tagihan</div>
                                <div class="text-mocca font-bold text-2xl leading-none tracking-tight">{{ $order->formatted_total }}</div>
                            </div>
                            
                            <div class="w-12 h-12 rounded-full bg-dark/40 border border-white/5 flex items-center justify-center text-mocca transition-all duration-500 group-hover:bg-mocca group-hover:text-dark group-hover:scale-110">
                                <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </div>
    
                    {{-- Quick summary of items (optional, but adds premium feel) --}}
                    <div class="mt-6 pt-6 border-t border-white/[0.02] hidden md:flex items-center gap-4 opacity-0 group-hover:opacity-100 transition-opacity duration-700">
                        <p class="text-cream/10 text-[0.6rem] font-bold uppercase tracking-widest italic">Klik untuk melihat rincian pesanan dan status pengiriman secara detail.</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    
        {{-- Pagination Styling --}}
        <div class="mt-16 reveal flex justify-center">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</section>

@endsection
