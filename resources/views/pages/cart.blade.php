@extends('layouts.app')
@section('title', 'Keranjang Belanja')

@section('content')

{{-- ═══════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden py-16 md:py-24">
    <div class="absolute inset-0 bg-dark"></div>
    <div class="absolute inset-0 opacity-15"
         style="background-image: radial-gradient(circle at 10% 85%, #CCB196 0%, transparent 45%), radial-gradient(circle at 90% 15%, #6B4226 0%, transparent 45%)">
    </div>
    <div class="absolute right-0 top-0 w-[400px] h-[400px] bg-mocca/[0.03] rounded-full blur-[100px]"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center gap-2 mb-5 animate-fade-in-up">
            <span class="w-8 h-px bg-mocca/50"></span>
            <span class="text-mocca text-xs font-semibold tracking-[0.2em] uppercase">Tas Belanja Anda</span>
            <span class="w-8 h-px bg-mocca/50"></span>
        </div>
        <h1 class="font-display text-5xl md:text-6xl text-cream font-bold leading-tight mb-4 animate-fade-in-up" style="animation-delay: 0.1s">
            Keranjang <span class="text-mocca italic">Belanja</span>
        </h1>
        <p class="text-cream/35 text-sm md:text-base leading-relaxed max-w-md mx-auto animate-fade-in-up" style="animation-delay: 0.2s">
            Pesanan Anda — dari kopi premium hingga menu favorit kami, siap untuk dinikmati.
        </p>
    </div>
</section>

{{-- ═══════════════════════════════════════
     CART CONTENT
     ═══════════════════════════════════════ --}}
<section class="py-16 bg-dark relative overflow-hidden">
    {{-- Background Blobs --}}
    <div class="absolute left-0 top-1/4 w-[500px] h-[500px] bg-mocca/[0.02] rounded-full blur-[120px] -translate-x-1/2"></div>
    <div class="absolute right-0 bottom-0 w-[400px] h-[400px] bg-mocca/[0.03] rounded-full blur-[100px] translate-x-1/3 translate-y-1/3"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        @if($cartItems->isEmpty())
        {{-- Empty State --}}
        <div class="max-w-xl mx-auto text-center py-20 reveal">
            <div class="w-28 h-28 bg-warm border border-white/5 rounded-[3rem] flex items-center justify-center mx-auto mb-10 text-cream/10 shadow-2xl relative group overflow-hidden">
                 <div class="absolute inset-0 bg-mocca opacity-0 group-hover:opacity-10 transition-opacity duration-700"></div>
                 <svg class="w-12 h-12 transition-transform duration-700 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                 </svg>
            </div>
            <h3 class="font-display text-3xl text-cream font-bold mb-4">Keranjang Anda Kosong</h3>
            <p class="text-cream/30 text-lg leading-relaxed mb-12">Sepertinya Anda belum menemukan menu favorit. Ingin mencoba koleksi terbaik kami?</p>
            <div class="flex flex-wrap justify-center items-center gap-6">
                <a href="{{ route('menu') }}" class="btn-mocca !px-10 !py-4 group">
                    <span>Lihat Menu</span>
                    <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="{{ route('shop') }}" class="btn-outline !px-10 !py-4 group">
                    <span>Beli Biji Kopi</span>
                    <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
        @else
        
        <div class="grid lg:grid-cols-12 gap-12">
            {{-- Items List --}}
            <div class="lg:col-span-8 space-y-6 reveal">
                <div class="flex items-center justify-between px-4 mb-4">
                    <span class="text-mocca text-[0.625rem] font-bold uppercase tracking-[0.3em]">{{ $cartItems->count() }} Item Terpilih</span>
                    <div class="flex gap-6">
                        <a href="{{ route('menu') }}" class="text-cream/20 hover:text-mocca text-[0.625rem] font-bold uppercase tracking-[0.3em] transition-colors">← Menu</a>
                        <a href="{{ route('shop') }}" class="text-cream/20 hover:text-mocca text-[0.625rem] font-bold uppercase tracking-[0.3em] transition-colors">Shop →</a>
                    </div>
                </div>
    
                @foreach($cartItems as $item)
                @php
                    $isMenu = (bool)$item->menu_id;
                    $object = $isMenu ? $item->menu : $item->product;
                @endphp
                <div class="group bg-warm border border-white/[0.03] rounded-[2.5rem] p-5 md:p-8 flex flex-col md:flex-row gap-8 items-center hover:border-mocca/30 hover:bg-warm-light transition-all duration-500 shadow-xl" id="cart-row-{{ $item->id }}">
                    {{-- Product Image --}}
                    <div class="w-24 h-24 md:w-32 md:h-32 flex-shrink-0 bg-dark/40 rounded-3xl overflow-hidden ring-1 ring-white/5 relative group-hover:scale-105 transition-transform duration-700 shadow-inner">
                        @if($object->image)
                            <img src="{{ $object->image_url }}" alt="{{ $object->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center opacity-10 text-4xl">
                                {{ $isMenu ? '☕' : '🫘' }}
                            </div>
                        @endif
                    </div>
    
                    {{-- Details --}}
                    <div class="flex-1 text-center md:text-left min-w-0">
                        <div class="flex flex-wrap justify-center md:justify-start gap-3 mb-3">
                            <span class="text-[0.6rem] font-bold uppercase tracking-widest text-mocca bg-mocca/10 px-3 py-1 rounded-lg border border-mocca/20">
                                {{ $isMenu ? $object->category : $object->roast_level }}
                            </span>
                        </div>
                        <h4 class="font-display text-2xl text-cream font-bold truncate mb-2 group-hover:text-mocca transition-colors">{{ $object->name }}</h4>
                        @if(!$isMenu)
                            <p class="text-cream/20 text-[0.65rem] font-bold uppercase tracking-widest">{{ $object->origin }} · {{ $object->weight_grams }}G</p>
                        @else
                            <p class="text-cream/20 text-[0.65rem] font-bold uppercase tracking-widest">Handcrafted Drink</p>
                        @endif
                        <div class="mt-4 text-mocca font-bold text-lg leading-none tracking-tight">{{ $object->formatted_price }}</div>
                    </div>
    
                    {{-- Quantity & Subtotal --}}
                    <div class="flex flex-col md:flex-row items-center gap-8 md:gap-12 w-full md:w-auto pt-6 md:pt-0 border-t md:border-t-0 border-white/[0.03]">
                        {{-- Quantity Selector --}}
                        <div class="flex items-center bg-dark/60 rounded-2xl border border-white/5 p-1.5 shadow-inner">
                            <button onclick="updateCart({{ $item->id }}, {{ $item->quantity - 1 }})"
                                    class="w-10 h-10 flex items-center justify-center text-cream/20 hover:text-mocca hover:bg-white/[0.03] rounded-xl transition-all group/btn">
                                <span class="text-xl leading-none group-active/btn:scale-90 transition-transform">−</span>
                            </button>
                            <span id="qty-{{ $item->id }}" class="w-10 text-center text-cream font-bold text-sm">{{ $item->quantity }}</span>
                            <button onclick="updateCart({{ $item->id }}, {{ $item->quantity + 1 }})"
                                    class="w-10 h-10 flex items-center justify-center text-cream/20 hover:text-mocca hover:bg-white/[0.03] rounded-xl transition-all group/btn">
                                <span class="text-xl leading-none group-active/btn:scale-90 transition-transform">+</span>
                            </button>
                        </div>
    
                        {{-- Subtotal --}}
                        <div class="text-center md:text-right w-32 flex-shrink-0">
                            <div class="text-[0.6rem] font-bold uppercase tracking-widest text-cream/10 mb-1.5">Subtotal</div>
                            <div id="sub-{{ $item->id }}" class="text-cream font-bold text-base tracking-tight">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </div>
                        </div>
    
                        {{-- Delete Action --}}
                        <button onclick="removeCart({{ $item->id }})" class="w-12 h-12 flex items-center justify-center text-red-400/20 hover:text-red-400 hover:bg-red-500/10 rounded-2xl transition-all duration-500 border border-transparent hover:border-red-500/20 group/del">
                            <svg class="w-5 h-5 transition-transform group-hover/del:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
    
            {{-- Side Summary --}}
            <div class="lg:col-span-4 reveal" style="transition-delay: 0.1s">
                <div class="bg-warm border border-white/[0.03] rounded-[3rem] p-10 sticky top-32 shadow-2xl overflow-hidden relative">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-mocca/[0.05] rounded-full blur-2xl"></div>
                    
                    <h3 class="font-display text-2xl text-cream font-bold mb-10">Ringkasan Order</h3>
                    
                    <div class="space-y-6 mb-10">
                        <div class="flex justify-between items-center">
                            <span class="text-cream/20 text-[0.65rem] font-bold uppercase tracking-widest">Total Belanja</span>
                            <span id="cart-total" class="text-cream font-bold text-base">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-cream/20 text-[0.65rem] font-bold uppercase tracking-widest">Biaya Kirim</span>
                            <span class="text-mocca/60 font-bold text-[0.6rem] uppercase tracking-widest bg-mocca/5 px-3 py-1 rounded-lg">Calculated at Checkout</span>
                        </div>
                    </div>
    
                    <div class="border-t border-white/[0.05] pt-8 mb-12">
                        <div class="flex justify-between items-baseline mb-3">
                            <span class="text-cream/30 text-[0.65rem] font-bold uppercase tracking-[0.2em]">Estimasi Total</span>
                            <span id="cart-estimated-total" class="text-mocca font-bold text-4xl leading-none tracking-tighter">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <p class="text-cream/10 text-[0.55rem] text-right italic font-bold uppercase tracking-widest">* Belum termasuk pajak pengiriman</p>
                    </div>
    
                    <div class="space-y-4">
                        <a href="{{ route('checkout') }}" class="btn-mocca w-full justify-center !py-4 shadow-xl shadow-mocca/10 font-bold group !text-base">
                            <span>Proceed to Checkout</span>
                            <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <a href="{{ route('shop') }}" class="flex items-center justify-center gap-3 text-cream/20 hover:text-mocca text-[0.65rem] font-bold uppercase tracking-[0.2em] py-4 transition-all group">
                            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Lanjut Belanja
                        </a>
                    </div>
    
                    {{-- Trust badges --}}
                    <div class="mt-16 pt-10 border-t border-white/[0.02] grid grid-cols-2 gap-6">
                        <div class="flex flex-col items-center text-center gap-3">
                            <div class="w-10 h-10 bg-dark/40 border border-white/5 rounded-xl flex items-center justify-center text-mocca shadow-inner">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            <span class="text-[0.55rem] font-bold uppercase tracking-widest text-cream/15 leading-relaxed">Secure<br>Payment</span>
                        </div>
                        <div class="flex flex-col items-center text-center gap-3">
                            <div class="w-10 h-10 bg-dark/40 border border-white/5 rounded-xl flex items-center justify-center text-mocca shadow-inner">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="text-[0.55rem] font-bold uppercase tracking-widest text-cream/15 leading-relaxed">Premium<br>Quality</span>
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
        // We calculate locally or wait for backend update. 
        // Best practice: backend returns individual subtotals. Assuming backend returns it.
        // If not in data, we reload or calculate. Let's assume we need to reload page or just update total.
        
        if (data.total !== undefined) {
             const formattedTotal = 'Rp ' + data.total.toLocaleString('id-ID');
             document.getElementById('cart-total').textContent = formattedTotal;
             document.getElementById('cart-estimated-total').textContent = formattedTotal;
             
             // Optimistic subtotal update if not provided in response
             // (Assuming price * qty logic)
        }
        
        // Better UX: reload for accuracy if sync is complex, or refresh UI fragments.
        // For now, let's trigger a full page data refresh if possible, or just individual elements.
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
