@extends('layouts.app')
@section('title', 'Keranjang Belanja | Filo Coffee')

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
                <span class="text-olive-700 text-xs font-bold tracking-[0.25em] uppercase">Your Cart</span>
            </div>
            <h1 class="font-display text-5xl md:text-7xl text-olive-900 font-bold leading-[1.05] mb-8">
                Keranjang
                <span class="text-beige-600 italic font-semibold">Belanja.</span>
            </h1>
            <p class="text-olive-800/70 text-lg md:text-xl leading-relaxed mb-12 max-w-2xl">
                Pesanan Anda — dari kopi premium hingga menu favorit kami, siap untuk dinikmati.
            </p>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     CART CONTENT
     ═══════════════════════════════════════ --}}
<section class="py-16 bg-beige-50 relative overflow-hidden">
    {{-- Background Blobs --}}
    <div class="absolute left-0 top-1/4 w-[500px] h-[500px] bg-olive-100/20 rounded-full blur-[120px] -translate-x-1/2 pointer-events-none"></div>
    <div class="absolute right-0 bottom-0 w-[400px] h-[400px] bg-olive-100/10 rounded-full blur-[100px] translate-x-1/3 translate-y-1/3 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        @if($cartItems->isEmpty())
        {{-- Empty State --}}
        <div class="max-w-xl mx-auto text-center py-20 reveal">
            <div class="w-28 h-28 bg-white border border-olive-900/5 rounded-[3rem] flex items-center justify-center mx-auto mb-10 text-olive-650 shadow-xl relative group overflow-hidden">
                 <div class="absolute inset-0 bg-olive-100 opacity-0 group-hover:opacity-35 transition-opacity duration-700"></div>
                 <svg class="w-12 h-12 transition-transform duration-700 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                 </svg>
            </div>
            <h3 class="font-display text-3xl text-olive-900 font-bold mb-4">Keranjang Anda Kosong</h3>
            <p class="text-olive-800/60 text-lg leading-relaxed mb-12">Sepertinya Anda belum menemukan menu favorit. Ingin mencoba koleksi terbaik kami?</p>
            <div class="flex flex-wrap justify-center items-center gap-6">
                <a href="{{ route('menu') }}" class="bg-olive-800 text-beige-50 hover:bg-olive-900 px-10 py-4 rounded-2xl font-bold transition-all duration-300 shadow-xl shadow-olive-900/10 group flex items-center gap-2">
                    <span>Lihat Menu</span>
                    <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="{{ route('shop') }}" class="border-2 border-olive-800 text-olive-900 hover:bg-olive-800 hover:text-beige-50 px-10 py-3.5 rounded-2xl font-bold transition-all duration-300 group flex items-center gap-2">
                    <span>Beli Biji Kopi</span>
                    <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
        @else
        
        <div class="grid lg:grid-cols-12 gap-12 items-start">
            {{-- Items List --}}
            <div class="lg:col-span-8 space-y-6 reveal">
                <div class="flex items-center justify-between px-4 mb-4">
                    <span class="text-olive-700 text-[0.65rem] font-bold uppercase tracking-[0.3em]">{{ $cartItems->count() }} Item Terpilih</span>
                    <div class="flex gap-6">
                        <a href="{{ route('menu') }}" class="text-olive-700/50 hover:text-olive-900 text-[0.65rem] font-bold uppercase tracking-[0.3em] transition-colors">← Menu</a>
                        <a href="{{ route('shop') }}" class="text-olive-700/50 hover:text-olive-900 text-[0.65rem] font-bold uppercase tracking-[0.3em] transition-colors">Beans Shop →</a>
                    </div>
                </div>
    
                @foreach($cartItems as $item)
                @php
                    $isMenu = (bool)$item->menu_id;
                    $object = $isMenu ? $item->menu : $item->product;
                @endphp
                <div class="group bg-white border border-olive-900/5 rounded-[2.5rem] p-5 md:p-8 flex flex-col md:flex-row gap-8 items-center hover:border-olive-900/15 hover:bg-beige-100/40 transition-all duration-500 shadow-xl shadow-olive-900/5" id="cart-row-{{ $item->id }}">
                    {{-- Product Image --}}
                    <div class="w-24 h-24 md:w-32 md:h-32 flex-shrink-0 bg-beige-50 border border-olive-900/5 rounded-3xl overflow-hidden shadow-sm relative group-hover:scale-103 transition-transform duration-700">
                        @if($object->image)
                            <img src="{{ $object->image_url }}" alt="{{ $object->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center opacity-20 text-4xl">
                                {{ $isMenu ? '☕' : '🫘' }}
                            </div>
                        @endif
                    </div>
    
                    {{-- Details --}}
                    <div class="flex-1 text-center md:text-left min-w-0">
                        <div class="flex flex-wrap justify-center md:justify-start gap-3 mb-3">
                            <span class="text-[0.6rem] font-bold uppercase tracking-widest text-olive-850 bg-olive-100 px-3 py-1 rounded-lg border border-olive-900/10 shadow-sm">
                                {{ $isMenu ? $object->category : $object->roast_level }}
                            </span>
                        </div>
                        <h4 class="font-display text-2xl text-olive-900 font-bold truncate mb-2 group-hover:text-olive-750 transition-colors leading-snug">{{ $object->name }}</h4>
                        @if(!$isMenu)
                            <p class="text-olive-700/40 text-[0.65rem] font-bold uppercase tracking-widest">{{ $object->origin }} · {{ $object->weight_grams }}G</p>
                        @else
                            <p class="text-olive-700/40 text-[0.65rem] font-bold uppercase tracking-widest">Minuman Spesial</p>
                        @endif
                        <div class="mt-4 text-olive-750 font-bold text-lg leading-none tracking-tight">{{ $object->formatted_price }}</div>
                    </div>
    
                    {{-- Quantity & Subtotal --}}
                    <div class="flex flex-col md:flex-row items-center gap-8 md:gap-12 w-full md:w-auto pt-6 md:pt-0 border-t md:border-t-0 border-olive-900/5">
                        {{-- Quantity Selector --}}
                        <div class="flex items-center bg-beige-50 rounded-2xl border border-olive-900/10 p-1.5 shadow-sm">
                            <button onclick="updateCart({{ $item->id }}, {{ $item->quantity - 1 }})"
                                    class="w-10 h-10 flex items-center justify-center text-olive-500 hover:text-olive-900 hover:bg-olive-100/50 rounded-xl transition-all group/btn">
                                <span class="text-xl leading-none group-active/btn:scale-90 transition-transform">−</span>
                            </button>
                            <span id="qty-{{ $item->id }}" class="w-10 text-center text-olive-900 font-bold text-sm">{{ $item->quantity }}</span>
                            <button onclick="updateCart({{ $item->id }}, {{ $item->quantity + 1 }})"
                                    class="w-10 h-10 flex items-center justify-center text-olive-500 hover:text-olive-900 hover:bg-olive-100/50 rounded-xl transition-all group/btn">
                                <span class="text-xl leading-none group-active/btn:scale-90 transition-transform">+</span>
                            </button>
                        </div>
    
                        {{-- Subtotal --}}
                        <div class="text-center md:text-right w-32 flex-shrink-0">
                            <div class="text-[0.6rem] font-bold uppercase tracking-widest text-olive-700/30 mb-1.5">Subtotal</div>
                            <div id="sub-{{ $item->id }}" class="text-olive-900 font-bold text-base tracking-tight">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </div>
                        </div>
    
                        {{-- Delete Action --}}
                        <button onclick="removeCart({{ $item->id }})" class="w-12 h-12 flex items-center justify-center text-red-500/30 hover:text-red-650 hover:bg-red-50 rounded-2xl transition-all duration-500 border border-transparent hover:border-red-200/50 group/del">
                            <svg class="w-5 h-5 transition-transform group-hover/del:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
    
            {{-- Side Summary --}}
            <div class="lg:col-span-4 reveal" style="transition-delay: 0.1s">
                <div class="bg-white border border-olive-900/5 rounded-[3rem] p-10 sticky top-32 shadow-xl shadow-olive-900/5 overflow-hidden relative">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-olive-200/10 rounded-full blur-2xl pointer-events-none"></div>
                    
                    <h3 class="font-display text-2xl text-olive-900 font-bold mb-10">Ringkasan Order</h3>
                    
                    <div class="space-y-6 mb-10">
                        <div class="flex justify-between items-center">
                            <span class="text-olive-700/40 text-[0.65rem] font-bold uppercase tracking-widest">Total Belanja</span>
                            <span id="cart-total" class="text-olive-900 font-bold text-base">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-olive-700/40 text-[0.65rem] font-bold uppercase tracking-widest">Biaya Kirim</span>
                            <span class="text-olive-700/60 font-bold text-[0.6rem] uppercase tracking-widest bg-olive-100 px-3 py-1 rounded-lg border border-olive-900/5 shadow-sm">Kalkulasi saat Checkout</span>
                        </div>
                    </div>
    
                    <div class="border-t border-olive-900/5 pt-8 mb-12">
                        <div class="flex justify-between items-baseline mb-3">
                            <span class="text-olive-700/40 text-[0.65rem] font-bold uppercase tracking-[0.2em]">Estimasi Total</span>
                            <span id="cart-estimated-total" class="text-olive-850 font-display font-bold text-4xl leading-none tracking-tighter">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <p class="text-olive-700/20 text-[0.55rem] text-right italic font-bold uppercase tracking-widest">* Belum termasuk pajak & ongkos pengiriman</p>
                    </div>
    
                    <div class="space-y-4">
                        <a href="{{ route('checkout') }}" class="w-full bg-olive-800 hover:bg-olive-900 text-beige-50 font-bold py-4 rounded-xl transition-all shadow-xl shadow-olive-900/10 group flex items-center justify-center gap-3 text-base">
                            <span>Proceed to Checkout</span>
                            <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <a href="{{ route('shop') }}" class="flex items-center justify-center gap-3 text-olive-700/40 hover:text-olive-900 text-[0.65rem] font-bold uppercase tracking-[0.2em] py-4 transition-all group">
                            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Lanjut Belanja
                        </a>
                    </div>
    
                    {{-- Trust badges --}}
                    <div class="mt-16 pt-10 border-t border-olive-900/5 grid grid-cols-2 gap-6">
                        <div class="flex flex-col items-center text-center gap-3">
                            <div class="w-10 h-10 bg-beige-50 border border-olive-900/5 rounded-xl flex items-center justify-center text-olive-800 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            <span class="text-[0.55rem] font-bold uppercase tracking-widest text-olive-750/30 leading-relaxed">Pembayaran<br>Aman</span>
                        </div>
                        <div class="flex flex-col items-center text-center gap-3">
                            <div class="w-10 h-10 bg-beige-50 border border-olive-900/5 rounded-xl flex items-center justify-center text-olive-800 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="text-[0.55rem] font-bold uppercase tracking-widest text-olive-750/30 leading-relaxed">Kualitas<br>Premium</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

@endsection

@push('scripts')
<script>
const headers = { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content };

async function updateCart(cartId, qty) {
    if(qty < 1) return; // UI handles removal separately or just keep at 1

    const res = await fetch(`/cart/${cartId}`, {
        method: 'PATCH',
        headers: { ...headers, 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify({ quantity: qty })
    });
    const data = await res.json();
    if (data.success) {
        document.getElementById(`qty-${cartId}`).textContent = qty;
        
        // Find subtotal field for this item
        const subElement = document.getElementById(`sub-${cartId}`);
        
        if (data.total !== undefined) {
             const formattedTotal = 'Rp ' + data.total.toLocaleString('id-ID');
             document.getElementById('cart-total').textContent = formattedTotal;
             document.getElementById('cart-estimated-total').textContent = formattedTotal;
        }
        
        // Better UX: reload for accuracy and to sync with session/database correctly
        location.reload(); 
    }
}

async function removeCart(cartId) {
    if(!confirm('Hapus item ini dari keranjang?')) return;
    
    const res = await fetch(`/cart/${cartId}`, {
        method: 'DELETE',
        headers: { ...headers, 'Accept': 'application/json' }
    });
    const data = await res.json();
    if (data.success) {
        document.getElementById(`cart-row-${cartId}`)?.classList.add('opacity-0', 'scale-95');
        setTimeout(() => {
            location.reload();
        }, 300);
    }
}
</script>
@endpush
