<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kasir Mode — Filo Coffee</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    dark: '#1a1815',
                    'dark-deep': '#141210',
                    'dark-light': '#24221f',
                    cream: '#F5F0EB',
                    mocca: '#CCB196',
                    'mocca-dark': '#b0947a',
                    warm: '#2a2723',
                },
                fontFamily: {
                    display: ['"Source Serif 4"', 'serif'],
                    body: ['"Poppins"', 'sans-serif'],
                }
            }
        }
    }
    </script>
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body { background: #141210; color: #F5F0EB; overflow: hidden; height: 100vh; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(204,177,150,0.2); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(204,177,150,0.4); }

        /* Category pills */
        .cat-btn {
            padding: 0.5rem 1.25rem;
            border-radius: 1rem;
            border: 1px solid rgba(255,255,255,0.04);
            color: rgba(245,240,235,0.3);
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            white-space: nowrap;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255,255,255,0.02);
        }
        .cat-btn:hover { color: #CCB196; border-color: rgba(204,177,150,0.2); background: rgba(204,177,150,0.05); }
        .cat-btn.active { background: #CCB196; color: #141210; border-color: #CCB196; box-shadow: 0 4px 12px rgba(204,177,150,0.2); }

        /* Menu card */
        .menu-card {
            background: rgba(255,255,255,0.02);
            border: 1px solid rgba(255,255,255,0.04);
            border-radius: 1.5rem;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        .menu-card:hover {
            border-color: rgba(204,177,150,0.35);
            background: rgba(204,177,150,0.04);
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }
        .menu-card:active { transform: scale(0.97); }
        .menu-card .add-hint {
            position: absolute;
            inset: 0;
            background: rgba(204,177,150,0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        .menu-card:hover .add-hint { opacity: 1; }

        /* Cart item */
        .cart-item {
            background: rgba(255,255,255,0.025);
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 0.875rem;
            padding: 0.75rem;
            transition: all 0.2s ease;
        }
        .cart-item:hover { border-color: rgba(204,177,150,0.15); }

        /* Qty controls */
        .qty-btn {
            width: 26px; height: 26px;
            border-radius: 6px;
            background: rgba(255,255,255,0.06);
            color: rgba(237,237,237,0.7);
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; font-weight: 700;
            transition: all 0.2s ease;
            border: 1px solid rgba(255,255,255,0.08);
        }
        .qty-btn:hover { background: rgba(204,177,150,0.15); color: #CCB196; border-color: rgba(204,177,150,0.3); }

        /* Input */
        .cash-input {
            width: 100%;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 0.875rem;
            padding: 0.875rem 1rem 0.875rem 3rem;
            color: #EDEDED;
            font-size: 1.25rem;
            font-weight: 700;
            transition: all 0.25s ease;
        }
        .cash-input::placeholder { color: rgba(237,237,237,0.2); }
        .cash-input:focus {
            outline: none;
            border-color: #CCB196;
            background: rgba(255,255,255,0.06);
            box-shadow: 0 0 0 3px rgba(204,177,150,0.1);
        }
        /* Chrome/Safari — hide number arrows */
        .cash-input::-webkit-outer-spin-button,
        .cash-input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
        .cash-input[type=number] { -moz-appearance: textfield; }

        /* Pay button */
        .pay-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #CCB196 0%, #b8996a 100%);
            color: #242422;
            border-radius: 0.875rem;
            font-weight: 700;
            font-size: 0.9375rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 20px rgba(204,177,150,0.2);
        }
        .pay-btn:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: 0 8px 32px rgba(204,177,150,0.3);
            filter: brightness(1.05);
        }
        .pay-btn:active:not(:disabled) { transform: translateY(0); }
        .pay-btn:disabled { opacity: 0.35; cursor: not-allowed; box-shadow: none; }

        /* Divider */
        .dashed-divider { border-top: 1px dashed rgba(255,255,255,0.08); }

        /* Flash animation on add to cart */
        @{{ '' }}keyframes addFlash {
            0% { background: rgba(204,177,150,0.25); }
            100% { background: rgba(255,255,255,0.025); }
        }
        .flash { animation: addFlash 0.4s ease-out; }

        /* Modal backdrop */
        .modal-backdrop {
            background: rgba(10,10,9,0.75);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        /* Receipt modal */
        .receipt-modal {
            background: linear-gradient(160deg, #2e2e2b 0%, #242422 100%);
            border: 1px solid rgba(204,177,150,0.15);
            border-radius: 1.5rem;
            box-shadow: 0 40px 80px rgba(0,0,0,0.6);
        }

        /* Pulse dot */
        @{{ '' }}keyframes pulse-dot {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }
        .pulse-dot { animation: pulse-dot 1.5s infinite ease-in-out; }

        /* Sidebar separator */
        .sidebar-sep {
            border-left: 1px solid rgba(255,255,255,0.06);
        }
    </style>
</head>
<body>

<div class="flex flex-col h-screen overflow-hidden">

    {{-- ═══ TOP BAR ═══ --}}
    <header style="background: rgba(20,18,16,0.8); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);"
            class="flex-shrink-0 border-b border-white/[0.04] px-8 py-4 flex items-center justify-between z-20">

        {{-- Brand --}}
        <div class="flex items-center gap-5">
            <img src="{{ asset('images/logo.png') }}" alt="Filo Coffee" class="h-10 w-auto" onerror="this.style.display='none'">
            <div>
                <h1 class="font-display text-lg text-cream font-bold leading-none tracking-tight">KASIR MODE</h1>
                <p class="text-cream/20 text-[0.6rem] uppercase tracking-[0.2em] font-bold mt-1">Point of Sale System</p>
            </div>
            <span class="ml-2 flex items-center gap-2 px-3 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-widest bg-emerald-500/5 text-emerald-400 border border-emerald-500/10">
                <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full pulse-dot shadow-[0_0_8px_rgba(52,211,153,0.4)]"></span>
                System Active
            </span>
        </div>

        {{-- Clock & Actions --}}
        <div class="flex items-center gap-6">
            <div class="text-right hidden sm:block">
                <div id="clock-time" class="text-cream font-bold text-base font-mono tabular-nums tracking-wider"></div>
                <div id="clock-date" class="text-cream/20 text-[0.65rem] font-bold uppercase tracking-widest mt-0.5"></div>
            </div>
            <div class="w-px h-10 bg-white/[0.04]"></div>
            <a href="{{ route('admin.pos.history') }}"
               class="flex items-center gap-2.5 px-5 py-2.5 rounded-1.5xl border border-white/[0.06] text-cream/40 hover:text-mocca hover:border-mocca/30 transition-all text-xs font-bold uppercase tracking-wider">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Riwayat
            </a>
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-2.5 px-5 py-2.5 rounded-1.5xl border border-red-500/10 text-red-400/50 hover:text-red-400 hover:bg-red-500/[0.05] transition-all text-xs font-bold uppercase tracking-wider">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Keluar
            </a>
        </div>
    </header>

    {{-- ═══ MAIN AREA ═══ --}}
    <div class="flex flex-1 overflow-hidden">

        {{-- ── LEFT: Menu Panel ── --}}
        <div class="flex-1 flex flex-col overflow-hidden bg-dark">
            {{-- Category Filter --}}
            <div class="flex-shrink-0 px-6 pt-5 pb-4 border-b border-white/[0.05]">
                <div class="flex gap-2 overflow-x-auto pb-1 scrollbar-none" style="-ms-overflow-style:none; scrollbar-width:none;">
                    <button class="cat-btn active" data-category="all">Semua</button>
                    @php $categories = $menus->pluck('category')->unique(); @endphp
                    @foreach($categories as $category)
                    <button class="cat-btn" data-category="{{ $category }}">{{ $category }}</button>
                    @endforeach
                </div>
            </div>

            {{-- Menu Grid --}}
            <div class="flex-1 overflow-y-auto p-8">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-5">
                    @foreach($menus as $menu)
                    <div class="menu-card group"
                         data-category="{{ $menu->category }}"
                         onclick="addToCart({{ $menu->id }}, '{{ addslashes($menu->name) }}', {{ $menu->price }}, '{{ $menu->image_url }}', this)">
                        <div class="relative aspect-[4/5] bg-dark-light overflow-hidden">
                            <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}"
                                 class="w-full h-full object-cover opacity-60 group-hover:opacity-100 group-hover:scale-110 transition-all duration-700">
                            <div class="add-hint">
                                <div class="w-12 h-12 rounded-2xl bg-mocca flex items-center justify-center shadow-2xl shadow-mocca/40">
                                    <svg class="w-6 h-6 text-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                </div>
                            </div>
                            <div class="absolute top-3 right-3">
                                <span class="px-2 py-1 bg-dark/60 backdrop-blur-md rounded-lg text-[0.6rem] font-bold text-cream/60 border border-white/10 uppercase tracking-widest">{{ $menu->category }}</span>
                            </div>
                        </div>
                        <div class="p-4 bg-dark-light/40 border-t border-white/[0.04]">
                            <h3 class="font-display text-cream text-xs font-bold leading-tight truncate mb-1 group-hover:text-mocca transition-colors">{{ $menu->name }}</h3>
                            <p class="text-mocca text-xs font-bold font-mono tracking-tight">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ── RIGHT: Cart & Payment ── --}}
        <div class="w-[420px] flex-shrink-0 sidebar-sep flex flex-col" style="background: #141210;">

            {{-- Cart Header --}}
            <div class="flex-shrink-0 px-8 py-6 border-b border-white/[0.04] flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 bg-mocca/10 border border-mocca/20 rounded-2xl flex items-center justify-center shadow-inner">
                        <svg class="w-5 h-5 text-mocca" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                    <div>
                        <h2 class="font-display text-cream text-lg font-bold leading-none tracking-tight">Keranjang</h2>
                        <p id="cart-count" class="text-cream/20 text-[0.65rem] font-bold uppercase tracking-[0.15em] mt-1.5">0 item</p>
                    </div>
                </div>
                <button onclick="clearCart()"
                        class="text-[0.65rem] text-red-400/30 hover:text-red-400 transition-all font-bold uppercase tracking-widest hover:tracking-[0.1em]">
                    Clear All
                </button>
            </div>

            {{-- Cart Items --}}
            <div id="cart-items" class="flex-1 overflow-y-auto p-6 space-y-4">
                {{-- Empty state --}}
                <div id="empty-cart" class="flex flex-col items-center justify-center h-full py-12 text-center select-none opacity-50">
                    <div class="w-20 h-20 rounded-3xl bg-white/[0.02] border border-white/[0.04] flex items-center justify-center mb-6 mx-auto">
                        <svg class="w-8 h-8 text-cream/10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <p class="font-display text-cream text-base font-bold tracking-tight">Your Cart is Empty</p>
                    <p class="text-cream/20 text-[0.7rem] font-medium uppercase tracking-widest mt-2">Pilih menu untuk memulai pesanan</p>
                </div>
                {{-- Cart rows rendered by JS --}}
                <div id="cart-list" class="space-y-3"></div>
            </div>

            {{-- Summary & Payment --}}
            <div class="flex-shrink-0 border-t border-white/[0.04] p-8 space-y-6" style="background: rgba(255,255,255,0.01);">
                {{-- Totals --}}
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-cream/20 text-[0.65rem] uppercase font-bold tracking-[0.2em]">Subtotal</span>
                        <span id="subtotal-display" class="text-cream/60 text-sm font-bold font-mono">Rp 0</span>
                    </div>
                    <div class="dashed-divider pt-4 flex justify-between items-center">
                        <span class="text-cream text-sm font-bold uppercase tracking-[0.15em]">Grand Total</span>
                        <span id="total-display" class="font-display text-mocca text-2xl font-bold tracking-tight">Rp 0</span>
                    </div>
                </div>

                {{-- Cash Input --}}
                <div>
                    <label class="block text-cream/20 text-[0.65rem] font-bold uppercase tracking-[0.2em] mb-3">Amount Received (Tunai)</label>
                    <div class="relative group">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-mocca/40 text-sm font-bold pointer-events-none transition-colors group-focus-within:text-mocca">Rp</span>
                        <input type="number" id="cash-received" oninput="calculateChange()"
                               class="w-full bg-white/[0.02] border border-white/[0.08] rounded-2xl py-4.5 pl-14 pr-6 text-cream font-display text-xl font-bold focus:outline-none focus:border-mocca focus:bg-white/[0.04] transition-all placeholder:text-cream/5" placeholder="0">
                    </div>
                </div>

                {{-- Change --}}
                <div class="flex items-center justify-between px-6 py-4 rounded-2xl bg-mocca/5 border border-mocca/10 shadow-inner">
                    <span class="text-mocca/40 text-[0.65rem] font-bold uppercase tracking-[0.2em]">Change</span>
                    <span id="change-display" class="text-mocca font-bold text-xl font-mono tabular-nums">Rp 0</span>
                </div>

                {{-- Pay button --}}
                <button id="pay-button" onclick="processPayment()" disabled class="w-full py-5 bg-mocca text-dark-deep rounded-2xl font-bold uppercase tracking-[0.15em] text-sm shadow-2xl shadow-mocca/20 hover:-translate-y-1 active:translate-y-0 transition-all duration-300 disabled:opacity-20 disabled:grayscale disabled:pointer-events-none">
                    Complete Order
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ═══ RECEIPT MODAL ═══ --}}
<div id="receipt-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden modal-backdrop p-4">
    <div class="bg-dark-light border border-white/[0.04] max-w-sm w-full rounded-[3rem] p-10 shadow-2xl relative overflow-hidden">
        {{-- Decoration --}}
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-mocca/5 rounded-full blur-3xl"></div>

        {{-- Success Icon --}}
        <div class="text-center mb-8">
            <div class="w-20 h-20 rounded-[2rem] bg-mocca/10 border border-mocca/20 flex items-center justify-center mx-auto mb-6 shadow-xl">
                <svg class="w-10 h-10 text-mocca" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="font-display text-2xl text-cream font-bold tracking-tight">Transaksi Sukses</h3>
            <p id="receipt-number" class="text-cream/20 text-[0.7rem] mt-2 font-bold uppercase tracking-widest"></p>
        </div>

        {{-- Receipt Lines --}}
        <div class="space-y-4 py-8 border-y border-dashed border-white/[0.1] mb-8">
            <div class="flex justify-between items-center">
                <span class="text-cream/30 text-[0.65rem] uppercase tracking-[0.2em] font-bold">Total Bill</span>
                <span id="receipt-total" class="text-cream text-lg font-bold font-mono"></span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-cream/30 text-[0.65rem] uppercase tracking-[0.2em] font-bold">Cash</span>
                <span id="receipt-cash" class="text-cream/60 text-base font-bold font-mono"></span>
            </div>
            <div class="flex justify-between items-center pt-4 border-t border-white/[0.04]">
                <span class="text-mocca/40 text-[0.65rem] uppercase tracking-[0.2em] font-bold">Change</span>
                <span id="receipt-change" class="text-mocca font-bold text-xl font-mono"></span>
            </div>
        </div>

        <button onclick="closeReceipt()" class="w-full py-5 bg-mocca text-dark-deep rounded-2xl font-bold uppercase tracking-[0.15em] text-xs shadow-xl shadow-mocca/10 hover:-translate-y-1 transition-all">
            Next Transaction
        </button>
    </div>
</div>

<script>
    let cart = [];
    let totalPrice = 0;

    // ── Clock ──
    function updateClock() {
        const now = new Date();
        document.getElementById('clock-time').textContent = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false });
        document.getElementById('clock-date').textContent = now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
    }
    setInterval(updateClock, 1000);
    updateClock();

    // ── Category Filter ──
    document.querySelectorAll('.cat-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const cat = btn.dataset.category;
            document.querySelectorAll('.menu-card').forEach(card => {
                card.style.display = (cat === 'all' || card.dataset.category === cat) ? '' : 'none';
            });
        });
    });

    // ── Cart Functions ──
    function addToCart(id, name, price, image, el) {
        const existing = cart.find(i => i.id === id);
        if (existing) {
            existing.quantity += 1;
        } else {
            cart.push({ id, name, price, image, quantity: 1 });
        }
        // Flash feedback on the card
        if (el) { el.classList.remove('flash'); void el.offsetWidth; el.classList.add('flash'); }
        renderCart();
    }

    function updateQuantity(id, delta) {
        const item = cart.find(i => i.id === id);
        if (!item) return;
        item.quantity += delta;
        if (item.quantity <= 0) cart = cart.filter(i => i.id !== id);
        renderCart();
    }

    function clearCart() {
        if (cart.length === 0) return;
        cart = [];
        renderCart();
    }

    function renderCart() {
        const container = document.getElementById('cart-items');
        const emptyEl   = document.getElementById('empty-cart');
        const listEl    = document.getElementById('cart-list');
        const countEl   = document.getElementById('cart-count');

        const totalItems = cart.reduce((s, i) => s + i.quantity, 0);
        countEl.textContent = totalItems + ' item';

        if (cart.length === 0) {
            emptyEl.style.display = 'flex';
            listEl.innerHTML = '';
            totalPrice = 0;
        } else {
            emptyEl.style.display = 'none';
            listEl.innerHTML = cart.map(item => `
                <div class="flex items-center gap-4 p-4 rounded-2xl bg-white/[0.02] border border-white/[0.04] group hover:bg-white/[0.04] transition-all">
                    <img src="${item.image}" class="w-12 h-12 object-cover rounded-xl flex-shrink-0 ring-1 ring-white/10 shadow-lg">
                    <div class="flex-1 min-w-0">
                        <p class="text-cream text-xs font-bold truncate leading-tight group-hover:text-mocca transition-colors">${item.name}</p>
                        <p class="text-cream/30 text-[0.65rem] font-bold mt-1">Rp ${new Intl.NumberFormat('id-ID').format(item.price)}</p>
                    </div>
                    <div class="flex items-center gap-2 flex-shrink-0">
                        <button onclick="updateQuantity(${item.id}, -1)" class="w-7 h-7 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-cream/40 hover:text-red-400 hover:border-red-400/30 transition-all font-bold">−</button>
                        <span class="text-cream text-xs font-bold w-6 text-center tabular-nums">${item.quantity}</span>
                        <button onclick="updateQuantity(${item.id}, 1)" class="w-7 h-7 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-cream/40 hover:text-mocca hover:border-mocca/30 transition-all font-bold">+</button>
                    </div>
                    <div class="text-right flex-shrink-0 min-w-[70px]">
                        <p class="text-mocca text-xs font-bold font-mono">Rp ${new Intl.NumberFormat('id-ID').format(item.price * item.quantity)}</p>
                    </div>
                </div>
            `).join('');
            totalPrice = cart.reduce((s, i) => s + (i.price * i.quantity), 0);
        }

        document.getElementById('subtotal-display').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalPrice);
        document.getElementById('total-display').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalPrice);
        calculateChange();
    }

    function calculateChange() {
        const cash = parseFloat(document.getElementById('cash-received').value) || 0;
        const change = cash - totalPrice;
        const display = document.getElementById('change-display');
        const payBtn = document.getElementById('pay-button');

        if (change >= 0 && totalPrice > 0) {
            display.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(change);
            display.style.color = '#CCB196';
            payBtn.disabled = false;
        } else {
            display.textContent = 'Rp 0';
            display.style.color = 'rgba(204,177,150,0.7)';
            if (cash > 0 && cash < totalPrice) display.style.color = '#f87171';
            payBtn.disabled = true;
        }
    }

    async function processPayment() {
        const cash = parseFloat(document.getElementById('cash-received').value);
        if (isNaN(cash) || cash < totalPrice || totalPrice === 0) return;

        const payBtn = document.getElementById('pay-button');
        payBtn.disabled = true;
        payBtn.innerHTML = `<svg class="animate-spin h-5 w-5 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>`;

        try {
            const response = await fetch('{{ route("admin.pos.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    cart: cart,
                    total_price: totalPrice,
                    cash_received: cash,
                    cash_change: cash - totalPrice,
                    notes: ''
                })
            });

            const result = await response.json();
            if (result.success) {
                document.getElementById('receipt-number').textContent = result.transaction.transaction_number;
                document.getElementById('receipt-total').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalPrice);
                document.getElementById('receipt-cash').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(cash);
                document.getElementById('receipt-change').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(cash - totalPrice);
                document.getElementById('receipt-modal').classList.remove('hidden');
            } else {
                alert('Gagal: ' + result.message);
                payBtn.disabled = false;
                payBtn.textContent = 'Proses Pembayaran';
            }
        } catch (err) {
            alert('Terjadi kesalahan koneksi.');
            payBtn.disabled = false;
            payBtn.textContent = 'Proses Pembayaran';
        }
    }

    function closeReceipt() {
        document.getElementById('receipt-modal').classList.add('hidden');
        cart = [];
        document.getElementById('cash-received').value = '';
        renderCart();
        document.getElementById('pay-button').textContent = 'Proses Pembayaran';
    }
</script>
</body>
</html>
