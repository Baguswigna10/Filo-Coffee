@extends('layouts.app')
@section('title', 'Pesanan Saya | Riwayat Belanja Filo Coffee')

@section('content')

{{-- ═══════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[50vh] flex items-center bg-beige-50">
    {{-- Decorative subtle background shapes --}}
    <div class="absolute inset-0 opacity-50 pointer-events-none"
         style="background-image: radial-gradient(circle at 15% 15%, #CFDAD0 0%, transparent 40%), radial-gradient(circle at 85% 85%, #E6DCCF 0%, transparent 40%)">
    </div>
    <div class="absolute right-[-5%] top-1/4 w-[500px] h-[500px] bg-olive-200/30 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute left-[-5%] bottom-0 w-80 h-80 bg-beige-200/50 rounded-full blur-[100px] pointer-events-none"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 z-10">
        <div class="max-w-3xl animate-fade-in-up">
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-8 h-[1.5px] bg-olive-500"></span>
                <span class="text-olive-700 text-xs font-bold tracking-[0.25em] uppercase">Riwayat Belanja</span>
            </div>
            <h1 class="font-display text-5xl md:text-7xl text-olive-900 font-bold leading-[1.05] mb-8">
                Pesanan
                <span class="text-beige-600 italic font-semibold">Saya.</span>
            </h1>
            <p class="text-olive-800/70 text-lg md:text-xl leading-relaxed mb-12 max-w-2xl">
                Lacak status pengiriman dan lihat detail pesanan menu serta kopi favorit Anda di sini.
            </p>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     ORDERS LIST SECTION
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-[50vh] flex items-center bg-beige-50">
    {{-- Decorative Background --}}
    <div class="absolute inset-0 opacity-50 pointer-events-none"
         style="background-image: radial-gradient(circle at 15% 15%, #CFDAD0 0%, transparent 40%), radial-gradient(circle at 85% 85%, #E6DCCF 0%, transparent 40%)">
    </div>
    <div class="absolute right-[-5%] top-0 w-[500px] h-[500px] bg-olive-200/30 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="absolute left-[-5%] bottom-0 w-80 h-80 bg-beige-200/50 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 z-10">
        @if($orders->isEmpty())
        {{-- Empty State --}}
        <div class="max-w-xl mx-auto text-center py-20 reveal">
            <div class="w-28 h-28 bg-white border border-olive-900/5 rounded-[3rem] flex items-center justify-center mx-auto mb-10 text-olive-650 shadow-xl relative group overflow-hidden">
                 <div class="absolute inset-0 bg-olive-100 opacity-0 group-hover:opacity-30 transition-opacity duration-700"></div>
                 <svg class="w-12 h-12 transition-transform duration-700 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                 </svg>
            </div>
            <h3 class="font-display text-3xl text-olive-900 font-bold mb-4">Belum Ada Pesanan</h3>
            <p class="text-olive-800/60 text-lg leading-relaxed mb-12">Anda belum pernah melakukan pemesanan. Ingin mulai menjelajahi koleksi menu atau biji kopi terbaik kami?</p>
            <div class="flex flex-wrap items-center gap-4 mb-14">
                <a href="{{ route('menu') }}" class="bg-olive-800 text-beige-50 hover:bg-olive-900 px-10 py-4 rounded-2xl font-bold transition-all duration-300 shadow-xl shadow-olive-900/10 group flex items-center gap-2">
                    <span>Pesan Menu</span>
                    <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="{{ route('shop') }}" class="border border-olive-800/30 text-olive-900 hover:bg-olive-800 hover:text-beige-50 px-8 py-3 rounded-2xl font-bold transition-all duration-300 inline-flex items-center gap-2">
                    <span>Beli Kopi</span>
                    <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
        @else
        
        <div class="space-y-6">
            <div class="flex items-center justify-between px-4 mb-4 reveal">
                <span class="text-olive-700 text-[0.65rem] font-bold uppercase tracking-[0.3em]">{{ $orders->total() }} Riwayat Pesanan</span>
                <div class="w-12 h-[1px] bg-olive-900/10"></div>
            </div>
    
            @foreach($orders as $i => $order)
            <div class="reveal" style="transition-delay: {{ ($i % 10) * 0.05 }}s">
                <a href="{{ route('orders.show', $order) }}" class="group block bg-white border border-olive-900/5 rounded-[2.5rem] p-6 md:p-8 hover:border-olive-900/15 hover:bg-beige-100/40 transition-all duration-500 shadow-lg hover:shadow-xl shadow-olive-900/5">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                        {{-- Order Basic Info --}}
                        <div class="flex items-center gap-6">
                            <div class="w-16 h-16 bg-beige-50 border border-olive-900/5 rounded-2xl flex items-center justify-center text-olive-850 ring-1 ring-olive-900/5 transition-all duration-500 group-hover:scale-105 group-hover:bg-olive-800 group-hover:text-beige-50 shadow-sm">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            </div>
                            <div>
                                <div class="flex flex-wrap items-center gap-4 mb-2">
                                    <h4 class="font-display text-xl text-olive-900 font-bold group-hover:text-olive-750 transition-colors">{{ $order->order_number }}</h4>
                                    <span class="badge badge-status-{{ $order->status }} !text-[0.6rem] !px-3 !py-1 uppercase tracking-widest shadow-sm">{{ $order->status }}</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-olive-700/60 text-[0.65rem] font-bold uppercase tracking-widest">{{ $order->created_at->format('d M Y') }}</span>
                                    <span class="w-1.5 h-1.5 bg-olive-200 rounded-full"></span>
                                    <span class="text-olive-700/40 text-[0.65rem] font-bold uppercase tracking-widest">{{ $order->items->count() }} Item</span>
                                </div>
                            </div>
                        </div>
        
                        {{-- Payment & Action Info --}}
                        <div class="flex items-center justify-between md:justify-end gap-12 border-t md:border-t-0 border-olive-900/5 pt-6 md:pt-0">
                            <div class="text-left md:text-right">
                                <div class="text-olive-750/30 text-[0.6rem] font-bold uppercase tracking-widest mb-1.5">Total Tagihan</div>
                                <div class="text-olive-900 font-bold text-2xl leading-none tracking-tight">{{ $order->formatted_total }}</div>
                            </div>
                            
                            <div class="w-12 h-12 rounded-full bg-beige-50 border border-olive-900/5 flex items-center justify-center text-olive-850 transition-all duration-500 group-hover:bg-olive-800 group-hover:text-beige-50 group-hover:scale-105 shadow-sm">
                                <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </div>
    
                    {{-- Quick summary of items (adds premium feel) --}}
                    <div class="mt-6 pt-6 border-t border-olive-900/5 hidden md:flex items-center gap-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <p class="text-olive-700/30 text-[0.6rem] font-bold uppercase tracking-widest italic">Klik untuk melihat rincian pesanan dan status pengiriman secara detail.</p>
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
