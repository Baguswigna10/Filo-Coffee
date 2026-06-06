<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kasir Mode - Filo Coffee</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    olive:      '#465D48',
                    'olive-light': '#5a7a5c',
                    'olive-dark':  '#354638',
                    mocca:      '#C9A87C',
                    'mocca-dark': '#b8906a',
                    cream:      '#FAF8F5',
                    'cream-2':  '#F0EBE3',
                    beige:      '#E8DDD0',
                    stone:      '#9B8E82',
                    ink:        '#2C2416',
                },
                fontFamily: {
                    display: ['"Source Serif 4"', 'serif'],
                    body:    ['"Poppins"', 'sans-serif'],
                }
            }
        }
    }
    </script>
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body { background: #FAF8F5; color: #2C2416; overflow: hidden; height: 100vh; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(70,93,72,0.2); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(70,93,72,0.35); }

        /* Category pills */
        .cat-btn {
            padding: 0.45rem 1.1rem;
            border-radius: 2rem;
            border: 1.5px solid #E8DDD0;
            color: #9B8E82;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            white-space: nowrap;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            background: #fff;
        }
        .cat-btn:hover {
            color: #465D48;
            border-color: #465D48;
            background: rgba(70,93,72,0.05);
        }
        .cat-btn.active {
            background: #465D48;
            color: #fff;
            border-color: #465D48;
            box-shadow: 0 3px 10px rgba(70,93,72,0.22);
        }

        /* Menu card */
        .menu-card {
            background: #fff;
            border: 1.5px solid #E8DDD0;
            border-radius: 1.25rem;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        .menu-card:hover {
            border-color: #C9A87C;
            box-shadow: 0 8px 28px rgba(44,36,22,0.10);
            transform: translateY(-3px);
        }
        .menu-card:active { transform: scale(0.97); }
        .menu-card .add-hint {
            position: absolute;
            inset: 0;
            background: rgba(70,93,72,0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        .menu-card:hover .add-hint { opacity: 1; }

        /* Cart item */
        .cart-item {
            background: #fff;
            border: 1.5px solid #E8DDD0;
            border-radius: 0.875rem;
            padding: 0.75rem;
            transition: all 0.2s ease;
        }
        .cart-item:hover { border-color: #C9A87C; }

        /* Input */
        .cash-input {
            width: 100%;
            background: #fff;
            border: 1.5px solid #E8DDD0;
            border-radius: 0.875rem;
            padding: 0.875rem 1rem 0.875rem 3rem;
            color: #2C2416;
            font-size: 1.2rem;
            font-weight: 700;
            transition: all 0.25s ease;
        }
        .cash-input::placeholder { color: #C9B8A5; }
        .cash-input:focus {
            outline: none;
            border-color: #465D48;
            box-shadow: 0 0 0 3px rgba(70,93,72,0.12);
        }
        .cash-input::-webkit-outer-spin-button,
        .cash-input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
        .cash-input[type=number] { -moz-appearance: textfield; }

        /* Pay button */
        .pay-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #465D48 0%, #354638 100%);
            color: #fff;
            border-radius: 0.875rem;
            font-weight: 700;
            font-size: 0.875rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 16px rgba(70,93,72,0.22);
        }
        .pay-btn:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: 0 8px 28px rgba(70,93,72,0.28);
            filter: brightness(1.05);
        }
        .pay-btn:active:not(:disabled) { transform: translateY(0); }
        .pay-btn:disabled { opacity: 0.35; cursor: not-allowed; box-shadow: none; }

        /* Divider */
        .dashed-divider { border-top: 1.5px dashed #E8DDD0; }

        /* Flash animation on add to cart */
        @{{ '' }}keyframes addFlash {
            0%   { background: rgba(201,168,124,0.25); }
            100% { background: #fff; }
        }
        .flash { animation: addFlash 0.4s ease-out; }

        /* Modal backdrop */
        .modal-backdrop {
            background: rgba(44,36,22,0.45);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        /* Pulse dot */
        @{{ '' }}keyframes pulse-dot {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0.3; }
        }
        .pulse-dot { animation: pulse-dot 1.5s infinite ease-in-out; }

        /* Sidebar separator */
        .sidebar-sep {
            border-left: 1.5px solid #E8DDD0;
        }

        /* Payment method toggle */
        .pay-method-btn {
            flex: 1;
            padding: 0.6rem 0;
            border-radius: 0.5rem;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            transition: all 0.25s ease;
            border: none;
        }
        .pay-method-btn.active-cash {
            background: #465D48;
            color: #fff;
            box-shadow: 0 2px 10px rgba(70,93,72,0.22);
        }
        .pay-method-btn.active-qris {
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            color: #fff;
            box-shadow: 0 2px 14px rgba(109,40,217,0.30);
        }
        .pay-method-btn.inactive {
            background: transparent;
            color: #9B8E82;
        }
        .pay-method-btn.inactive:hover {
            color: #2C2416;
            background: rgba(44,36,22,0.04);
        }

        /* QRIS spinner */
        .qris-loading-spinner {
            width: 38px; height: 38px;
            border: 3px solid rgba(70,93,72,0.15);
            border-top-color: #465D48;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin: 0 auto;
        }
        @{{ '' }}keyframes spin { to { transform: rotate(360deg); } }

        #snap-qris-container { display: none; }

        /* Sidebar summary area */
        .summary-area {
            background: #F0EBE3;
            border-top: 1.5px solid #E8DDD0;
        }
    </style>
</head>
<body>

<div class="flex flex-col h-screen overflow-hidden">

    {{-- ═══ TOP BAR ═══ --}}
    <header class="flex-shrink-0 bg-white border-b border-beige px-8 py-3.5 flex items-center justify-between z-20 shadow-sm">

        {{-- Brand --}}
        <div class="flex items-center gap-5">
            <img src="{{ asset('images/logo.png') }}" alt="Filo Coffee" class="h-9 w-auto" onerror="this.style.display='none'">
            <div>
                <h1 class="font-display text-base text-olive font-bold leading-none tracking-tight">Kasir</h1>
                <p class="text-stone text-[0.6rem] uppercase tracking-[0.18em] font-semibold mt-0.5">Filo Coffee</p>
            </div>
            <span class="ml-2 flex items-center gap-2 px-3 py-1 rounded-full text-[0.62rem] font-bold uppercase tracking-widest bg-olive/8 text-olive border border-olive/20">
                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full pulse-dot shadow-[0_0_6px_rgba(16,185,129,0.5)]"></span>
                System Active
            </span>
        </div>

        {{-- Clock & Actions --}}
        <div class="flex items-center gap-5">
            <div class="text-right hidden sm:block">
                <div id="clock-time" class="text-ink font-bold text-base font-mono tabular-nums tracking-wider"></div>
                <div id="clock-date" class="text-stone text-[0.62rem] font-semibold uppercase tracking-widest mt-0.5"></div>
            </div>
            <div class="w-px h-9 bg-beige"></div>
            <a href="{{ route('admin.pos.history') }}"
               class="flex items-center gap-2 px-4 py-2 rounded-lg border border-beige text-stone hover:text-olive hover:border-olive/40 hover:bg-olive/5 transition-all text-xs font-semibold uppercase tracking-wider">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Riwayat
            </a>
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-2 px-4 py-2 rounded-lg border border-red-200 text-red-400 hover:bg-red-50 hover:border-red-300 transition-all text-xs font-semibold uppercase tracking-wider">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Keluar
            </a>
        </div>
    </header>

    {{-- ═══ MAIN AREA ═══ --}}
    <div class="flex flex-1 overflow-hidden">

        {{-- ── LEFT: Menu Panel ── --}}
        <div class="flex-1 flex flex-col overflow-hidden bg-cream">
            {{-- Category Filter --}}
            <div class="flex-shrink-0 px-6 pt-4 pb-4 bg-white border border-olive-800/20">
                <div class="flex gap-2 overflow-x-auto pb-1 scrollbar-none" style="-ms-overflow-style:none; scrollbar-width:none;">
                    <button class="cat-btn active" data-category="all">Semua Menu</button>
                    @php $categories = $menus->pluck('category')->unique(); @endphp
                    @foreach($categories as $category)
                    <button class="cat-btn" data-category="{{ $category }}">{{ $category }}</button>
                    @endforeach
                </div>
            </div>

            {{-- Menu Grid --}}
            <div class="flex-1 overflow-y-auto p-6">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                    @foreach($menus as $menu)
                    <div class="menu-card group"
                         data-category="{{ $menu->category }}"
                         onclick="addToCart({{ $menu->id }}, '{{ addslashes($menu->name) }}', {{ $menu->price }}, '{{ $menu->image_url }}', this)">
                        <div class="relative aspect-[4/5] bg-cream-2 overflow-hidden">
                            <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}"
                                 class="w-full h-full object-cover opacity-85 group-hover:opacity-100 group-hover:scale-105 transition-all duration-600">
                            <div class="add-hint">
                                <div class="w-11 h-11 rounded-2xl bg-olive flex items-center justify-center shadow-xl">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                </div>
                            </div>
                            <div class="absolute top-2.5 right-2.5">
                                <span class="px-2 py-0.5 bg-white/80 backdrop-blur-sm rounded-md text-[0.58rem] font-bold text-olive-900 border border-olive-900 uppercase tracking-widest">{{ $menu->category }}</span>
                            </div>
                        </div>
                        <div class="p-3.5 border-t border-olive">
                            <h3 class="font-display text-olive-900 text-xs font-bold leading-snug truncate mb-1 group-hover:text-olive transition-colors">{{ $menu->name }}</h3>
                            <p class="text-olive-900 text-xs font-bold tracking-tight">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ── RIGHT: Cart & Payment ── --}}
        <div class="w-[400px] flex-shrink-0 sidebar-sep flex flex-col bg-white">

            {{-- Cart Header --}}
            <div class="flex-shrink-0 px-6 py-5 border-b border-beige flex items-center justify-between bg-white">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-olive/10 border border-olive/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-olive" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                    <div>
                        <h2 class="font-display text-ink text-base font-bold leading-none tracking-tight">Keranjang</h2>
                        <p id="cart-count" class="text-stone text-[0.62rem] font-semibold uppercase tracking-widest mt-1">0 item</p>
                    </div>
                </div>
                <button onclick="clearCart()"
                        class="text-[0.65rem] text-red-400/60 hover:text-red-500 transition-all font-bold uppercase tracking-widest px-2 py-1 rounded-md hover:bg-red-50">
                    Hapus Semua
                </button>
            </div>

            {{-- Cart Items --}}
            <div id="cart-items" class="flex-1 overflow-y-auto p-5 space-y-3 bg-cream/40">
                {{-- Empty state --}}
                <div id="empty-cart" class="flex flex-col items-center justify-center h-full py-12 text-center select-none">
                    <div class="w-16 h-16 rounded-2xl bg-beige flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-8 h-8 text-stone/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <p class="font-display text-ink text-sm font-bold tracking-tight">Keranjang Kosong</p>
                    <p class="text-stone text-[0.7rem] font-medium mt-1.5">Pilih menu untuk memulai pesanan</p>
                </div>
                {{-- Cart rows rendered by JS --}}
                <div id="cart-list" class="space-y-2.5"></div>
            </div>

            {{-- Summary & Payment --}}
            <div class="flex-shrink-0 summary-area p-5 space-y-4">
                {{-- Totals --}}
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="text-stone text-[0.65rem] uppercase font-semibold tracking-[0.18em]">Subtotal</span>
                        <span id="subtotal-display" class="text-stone text-sm font-bold">Rp 0</span>
                    </div>
                    <div class="dashed-divider pt-3 flex justify-between items-center">
                        <span class="text-ink text-sm font-bold uppercase tracking-[0.12em]">Grand Total</span>
                        <span id="total-display" class="font-display text-olive text-2xl font-bold tracking-tight">Rp 0</span>
                    </div>
                </div>

                {{-- ── PAYMENT METHOD TOGGLE ── --}}
                <div class="p-1.5 rounded-xl flex gap-1.5 bg-cream-2 border border-beige">
                    <button id="btn-tunai" class="pay-method-btn active-cash" onclick="setPaymentMethod('tunai')">
                        💵 Tunai
                    </button>
                    <button id="btn-qris" class="pay-method-btn inactive" onclick="setPaymentMethod('qris')">
                        📱 Non-Tunai (QRIS)
                    </button>
                </div>

                {{-- ── CASH PANEL ── --}}
                <div id="panel-tunai" class="space-y-3">
                    <div>
                        <label class="block text-stone text-[0.63rem] font-semibold uppercase tracking-[0.18em] mb-2">Uang Diterima</label>
                        <div class="relative group">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-mocca text-sm font-bold pointer-events-none transition-colors group-focus-within:text-olive">Rp</span>
                            <input type="number" id="cash-received" oninput="calculateChange()"
                                   class="cash-input" placeholder="0">
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-3.5 rounded-xl bg-white border border-beige shadow-sm">
                        <span class="text-stone text-[0.63rem] font-semibold uppercase tracking-[0.18em]">Kembalian</span>
                        <span id="change-display" class="text-olive font-bold text-xl font-mono tabular-nums">Rp 0</span>
                    </div>
                    <button id="pay-button-cash" onclick="processPaymentCash()" disabled
                            class="pay-btn w-full py-4 rounded-xl font-bold uppercase tracking-[0.12em] text-sm shadow-md hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 disabled:opacity-25 disabled:grayscale disabled:pointer-events-none">
                        Proses Pembayaran Tunai
                    </button>
                </div>

                {{-- ── QRIS PANEL ── --}}
                <div id="panel-qris" class="hidden space-y-3">
                    <div class="rounded-xl p-4 text-center bg-violet-50 border border-violet-200">
                        <div class="w-9 h-9 mx-auto mb-2.5 rounded-lg flex items-center justify-center bg-gradient-to-br from-violet-600 to-indigo-600">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"/></svg>
                        </div>
                        <p class="text-violet-700 text-xs font-medium leading-relaxed">Pembayaran via QRIS melalui Midtrans.<br>Klik tombol di bawah untuk generate kode QR.</p>
                    </div>
                    <button id="pay-button-qris" onclick="processPaymentQris()" disabled
                            class="w-full py-4 rounded-xl font-bold uppercase tracking-[0.12em] text-sm transition-all duration-200 disabled:opacity-25 disabled:grayscale disabled:pointer-events-none"
                            style="background: linear-gradient(135deg, #7c3aed, #4f46e5); color: #fff; box-shadow: 0 4px 18px rgba(109,40,217,0.25);">
                        Generate QRIS &amp; Bayar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ═══ RECEIPT MODAL (Cash) ═══ --}}
<div id="receipt-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden modal-backdrop p-4">
    <div class="bg-white border border-beige max-w-sm w-full rounded-3xl p-8 shadow-2xl relative overflow-hidden">
        <div class="absolute -top-8 -right-8 w-36 h-36 bg-olive/5 rounded-full blur-3xl"></div>

        <div class="text-center mb-7">
            <div class="w-16 h-16 rounded-2xl bg-olive/10 border border-olive/20 flex items-center justify-center mx-auto mb-5 shadow-sm">
                <svg class="w-8 h-8 text-olive" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="font-display text-2xl text-ink font-bold tracking-tight">Transaksi Sukses</h3>
            <p id="receipt-number" class="text-stone text-[0.68rem] mt-2 font-semibold uppercase tracking-widest"></p>
            <p id="receipt-method-badge" class="mt-2 inline-block px-3 py-1 rounded-full text-[0.62rem] font-bold uppercase tracking-widest bg-olive/10 text-olive border border-olive/20"></p>
        </div>

        <div class="mb-4">
            <p class="text-stone text-[0.62rem] uppercase tracking-wider font-semibold mb-2">Item yang Dibeli:</p>
            <div id="receipt-items-list" class="max-h-36 overflow-y-auto space-y-2 pr-1 border-b border-beige pb-3"></div>
        </div>

        <div class="space-y-3.5 py-5 border-b border-dashed border-beige mb-6">
            <div class="flex justify-between items-center">
                <span class="text-stone text-[0.63rem] uppercase tracking-[0.18em] font-semibold">Total Bill</span>
                <span id="receipt-total" class="text-ink text-base font-bold font-mono"></span>
            </div>
            <div id="receipt-cash-row" class="flex justify-between items-center">
                <span class="text-stone text-[0.63rem] uppercase tracking-[0.18em] font-semibold">Cash</span>
                <span id="receipt-cash" class="text-ink text-sm font-bold font-mono"></span>
            </div>
            <div id="receipt-change-row" class="flex justify-between items-center pt-3 border-t border-beige">
                <span class="text-stone text-[0.63rem] uppercase tracking-[0.18em] font-semibold">Kembalian</span>
                <span id="receipt-change" class="text-olive font-bold text-xl font-mono"></span>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <button onclick="printReceipt()" class="w-full py-3.5 bg-cream-2 border border-beige text-olive rounded-xl font-bold uppercase tracking-[0.1em] text-xs hover:bg-olive/10 hover:border-olive/30 transition-all flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Cetak Struk
            </button>
            <button onclick="closeReceipt()" class="w-full py-3.5 bg-olive text-white rounded-xl font-bold uppercase tracking-[0.1em] text-xs shadow-md hover:bg-olive-light hover:-translate-y-0.5 transition-all">
                Selesai
            </button>
        </div>
    </div>
</div>

{{-- ═══ QRIS PAYMENT MODAL ═══ --}}
<div id="qris-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden modal-backdrop p-4">
    <div class="max-w-md w-full rounded-2xl p-7 shadow-2xl relative bg-white border border-violet-200">

        {{-- Decoration --}}
        <div class="absolute -top-6 -right-6 w-28 h-28 rounded-full blur-3xl bg-violet-100 opacity-60"></div>
        <div class="absolute -bottom-6 -left-6 w-28 h-28 rounded-full blur-3xl bg-indigo-100 opacity-50"></div>

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-gradient-to-br from-violet-600 to-indigo-600">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <div>
                    <h3 class="font-display text-ink text-base font-bold tracking-tight">Pembayaran QRIS</h3>
                    <p id="qris-amount-label" class="text-stone text-xs font-semibold mt-0.5"></p>
                </div>
            </div>
            <button onclick="cancelQrisPayment()" class="w-8 h-8 rounded-lg flex items-center justify-center text-stone hover:text-red-500 hover:bg-red-50 transition-all text-base font-bold border border-beige">✕</button>
        </div>

        {{-- Loading State --}}
        <div id="qris-loading" class="py-10 text-center">
            <div class="qris-loading-spinner mb-4"></div>
            <p class="text-stone text-sm font-medium">Memproses transaksi &amp; membuka QRIS...</p>
        </div>

        {{-- Waiting State --}}
        <div id="qris-waiting" class="hidden py-5 text-center space-y-4">
            <!-- QRIS Image container -->
            <div class="relative mx-auto w-64 h-64 bg-white p-3 border border-violet-100 rounded-2xl shadow-inner flex items-center justify-center">
                <img id="qris-image-element" src="" alt="QRIS Code" class="w-full h-full object-contain">
            </div>

            <div class="p-3.5 rounded-xl bg-violet-50/50 border border-violet-100">
                <p class="text-ink text-xs font-bold mb-1">Pindai Kode QR di Atas</p>
                <p class="text-stone text-[0.68rem] leading-relaxed">Tunjukkan kode QR kepada pelanggan untuk discan menggunakan GoPay, OVO, Dana, LinkAja, atau Mobile Banking.</p>
            </div>

            {{-- Polling Status --}}
            <div class="flex items-center justify-center gap-2 text-stone text-xs">
                <div class="w-1.5 h-1.5 rounded-full bg-violet-500 pulse-dot"></div>
                <span id="qris-polling-text">Menunggu pembayaran...</span>
            </div>

            {{-- Manual Confirm --}}
            <p class="text-stone text-[0.65rem]">Atau konfirmasi manual jika sudah terbayar:</p>
            <button onclick="confirmQrisManual()" id="qris-confirm-btn"
                    class="w-full py-3 rounded-xl font-bold uppercase tracking-widest text-xs transition-all text-white"
                    style="background: linear-gradient(135deg, #7c3aed, #4f46e5);">
                ✓ Konfirmasi Sudah Dibayar
            </button>
        </div>

        {{-- Success State --}}
        <div id="qris-success" class="hidden py-5 text-center space-y-4">
            <div class="w-14 h-14 mx-auto rounded-2xl flex items-center justify-center" style="background: linear-gradient(135deg, #7c3aed, #4f46e5); box-shadow: 0 6px 24px rgba(109,40,217,0.35);">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h4 class="font-display text-xl text-ink font-bold">Pembayaran Diterima!</h4>
            <p id="qris-tx-number" class="text-stone text-xs font-bold uppercase tracking-widest"></p>
            <div class="grid grid-cols-2 gap-3 mt-4">
                <button onclick="printReceiptQris()" class="py-3 rounded-xl font-bold text-xs uppercase tracking-widest border border-violet-300 text-violet-600 hover:bg-violet-50 transition-all flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    Cetak Struk
                </button>
                <button onclick="closeQrisModal()" class="py-3 rounded-xl font-bold text-xs uppercase tracking-widest text-white transition-all" style="background: linear-gradient(135deg, #7c3aed, #4f46e5);">
                    Selesai
                </button>
            </div>
        </div>
    </div>
</div>



<script>
    let cart = [];
    let totalPrice = 0;
    let paymentMethod = 'tunai'; // 'tunai' or 'qris'
    let currentQrisTransactionId = null;
    let currentQrisTxNumber = null;
    let qrisPollingInterval = null;
    let lastReceiptData = null; // for print

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

    // ── Payment Method Toggle ──
    function setPaymentMethod(method) {
        paymentMethod = method;
        const btnTunai  = document.getElementById('btn-tunai');
        const btnQris   = document.getElementById('btn-qris');
        const panelTunai = document.getElementById('panel-tunai');
        const panelQris  = document.getElementById('panel-qris');

        if (method === 'tunai') {
            btnTunai.className = 'pay-method-btn active-cash';
            btnQris.className  = 'pay-method-btn inactive';
            panelTunai.classList.remove('hidden');
            panelQris.classList.add('hidden');
        } else {
            btnTunai.className = 'pay-method-btn inactive';
            btnQris.className  = 'pay-method-btn active-qris';
            panelTunai.classList.add('hidden');
            panelQris.classList.remove('hidden');
        }
    }

    // ── Cart Functions ──
    function addToCart(id, name, price, image, el) {
        const existing = cart.find(i => i.id === id);
        if (existing) {
            existing.quantity += 1;
        } else {
            cart.push({ id, name, price, image, quantity: 1 });
        }
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
        const emptyEl = document.getElementById('empty-cart');
        const listEl  = document.getElementById('cart-list');
        const countEl = document.getElementById('cart-count');
        const totalItems = cart.reduce((s, i) => s + i.quantity, 0);
        countEl.textContent = totalItems + ' item';

        if (cart.length === 0) {
            emptyEl.style.display = 'flex';
            listEl.innerHTML = '';
            totalPrice = 0;
        } else {
            emptyEl.style.display = 'none';
            listEl.innerHTML = cart.map(item => `
                <div class="flex items-center gap-3 p-3.5 rounded-xl bg-white border border-beige group hover:border-mocca transition-all shadow-sm">
                    <img src="${item.image}" class="w-11 h-11 object-cover rounded-lg flex-shrink-0 border border-beige" onerror="this.style.display='none'">
                    <div class="flex-1 min-w-0">
                        <p class="text-ink text-xs font-bold truncate leading-tight group-hover:text-olive transition-colors">${item.name}</p>
                        <p class="text-stone text-[0.63rem] font-semibold mt-0.5">Rp ${new Intl.NumberFormat('id-ID').format(item.price)}</p>
                    </div>
                    <div class="flex items-center gap-1.5 flex-shrink-0">
                        <button onclick="updateQuantity(${item.id}, -1)" class="w-6 h-6 rounded-md bg-cream-2 border border-beige flex items-center justify-center text-stone hover:text-red-500 hover:border-red-200 transition-all font-bold text-sm">−</button>
                        <span class="text-ink text-xs font-bold w-5 text-center tabular-nums">${item.quantity}</span>
                        <button onclick="updateQuantity(${item.id}, 1)" class="w-6 h-6 rounded-md bg-cream-2 border border-beige flex items-center justify-center text-stone hover:text-olive hover:border-olive/30 transition-all font-bold text-sm">+</button>
                    </div>
                    <div class="text-right flex-shrink-0 min-w-[64px]">
                        <p class="text-mocca text-xs font-bold">Rp ${new Intl.NumberFormat('id-ID').format(item.price * item.quantity)}</p>
                    </div>
                </div>
            `).join('');
            totalPrice = cart.reduce((s, i) => s + (i.price * i.quantity), 0);
        }

        document.getElementById('subtotal-display').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalPrice);
        document.getElementById('total-display').textContent    = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalPrice);

        // Update button states
        const qrisBtn = document.getElementById('pay-button-qris');
        if (qrisBtn) qrisBtn.disabled = (totalPrice === 0);
        calculateChange();
    }

    function calculateChange() {
        const cash   = parseFloat(document.getElementById('cash-received').value) || 0;
        const change = cash - totalPrice;
        const display = document.getElementById('change-display');
        const payBtn  = document.getElementById('pay-button-cash');

        if (change >= 0 && totalPrice > 0) {
            display.textContent  = 'Rp ' + new Intl.NumberFormat('id-ID').format(change);
            display.style.color  = '#465D48';
            payBtn.disabled      = false;
        } else {
            display.textContent  = 'Rp 0';
            display.style.color  = '#9B8E82';
            if (cash > 0 && cash < totalPrice) display.style.color = '#f87171';
            payBtn.disabled = true;
        }
    }

    // ── CASH Payment ──
    async function processPaymentCash() {
        const cash = parseFloat(document.getElementById('cash-received').value);
        if (isNaN(cash) || cash < totalPrice || totalPrice === 0) return;

        const payBtn = document.getElementById('pay-button-cash');
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
                lastReceiptData = {
                    method: 'Tunai',
                    txNumber: result.transaction.transaction_number,
                    total: totalPrice,
                    cash: cash,
                    change: cash - totalPrice,
                    items: [...cart]
                };
                showReceiptModal(lastReceiptData);
            } else {
                alert('Gagal: ' + result.message);
                payBtn.disabled = false;
                payBtn.textContent = 'Proses Pembayaran Tunai';
            }
        } catch (err) {
            alert('Terjadi kesalahan koneksi.');
            payBtn.disabled = false;
            payBtn.textContent = 'Proses Pembayaran Tunai';
        }
    }

    // ── QRIS Payment ──
    async function processPaymentQris() {
        if (totalPrice === 0) return;

        const qrisBtn = document.getElementById('pay-button-qris');
        qrisBtn.disabled = true;
        qrisBtn.textContent = 'Memproses...';

        // Show QRIS modal in loading state
        document.getElementById('qris-amount-label').textContent = 'Total: Rp ' + new Intl.NumberFormat('id-ID').format(totalPrice);
        document.getElementById('qris-loading').classList.remove('hidden');
        document.getElementById('qris-waiting').classList.add('hidden');
        document.getElementById('qris-success').classList.add('hidden');
        document.getElementById('qris-modal').classList.remove('hidden');

        try {
            const response = await fetch('{{ route("admin.pos.qris") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    cart: cart,
                    total_price: totalPrice,
                    notes: ''
                })
            });

            const result = await response.json();

            if (!result.success) {
                alert('Gagal: ' + result.message);
                document.getElementById('qris-modal').classList.add('hidden');
                qrisBtn.disabled = false;
                qrisBtn.textContent = 'Generate QRIS & Bayar';
                return;
            }

            currentQrisTransactionId = result.transaction_id;
            currentQrisTxNumber      = result.transaction_number;
            lastReceiptData = {
                method: 'QRIS / Non-Tunai',
                txNumber: result.transaction_number,
                total: totalPrice,
                cash: null,
                change: null,
                items: [...cart]
            };

            // Set QR code image source
            document.getElementById('qris-image-element').src = result.qr_code_url;

            // Switch to waiting state
            document.getElementById('qris-loading').classList.add('hidden');
            document.getElementById('qris-waiting').classList.remove('hidden');

            // Start checking status in background
            startQrisPolling();

        } catch (err) {
            alert('Terjadi kesalahan koneksi.');
            document.getElementById('qris-modal').classList.add('hidden');
            qrisBtn.disabled = false;
            qrisBtn.textContent = 'Generate QRIS & Bayar';
        }
    }

    function startQrisPolling() {
        clearQrisPolling();
        let attempts = 0;
        const maxAttempts = 120; // 2 minutes max
        const pollStatusUrl = '{{ route("admin.pos.qris.status", ":id") }}'.replace(':id', currentQrisTransactionId);

        qrisPollingInterval = setInterval(async () => {
            attempts++;
            if (attempts > maxAttempts) {
                clearQrisPolling();
                document.getElementById('qris-polling-text').textContent = 'Waktu habis. Cek manual.';
                return;
            }

            try {
                const res  = await fetch(pollStatusUrl, { headers: { 'Accept': 'application/json' }});
                const data = await res.json();
                if (data.paid) {
                    clearQrisPolling();
                    showQrisSuccess(currentQrisTxNumber);
                } else {
                    const secs = attempts;
                    document.getElementById('qris-polling-text').textContent = `Menunggu pembayaran... (${secs}s)`;
                }
            } catch(e) {
                // silently ignore network errors during polling
            }
        }, 3000);
    }

    function clearQrisPolling() {
        if (qrisPollingInterval) {
            clearInterval(qrisPollingInterval);
            qrisPollingInterval = null;
        }
    }

    function showQrisSuccess(txNumber) {
        document.getElementById('qris-waiting').classList.add('hidden');
        document.getElementById('qris-success').classList.remove('hidden');
        document.getElementById('qris-tx-number').textContent = txNumber;
    }

    function confirmQrisManual() {
        clearQrisPolling();
        showQrisSuccess(currentQrisTxNumber);
    }

    function cancelQrisPayment() {
        clearQrisPolling();
        document.getElementById('qris-modal').classList.add('hidden');
        const qrisBtn = document.getElementById('pay-button-qris');
        qrisBtn.disabled = false;
        qrisBtn.textContent = 'Generate QRIS & Bayar';
    }

    function closeQrisModal() {
        clearQrisPolling();
        document.getElementById('qris-modal').classList.add('hidden');
        cart = [];
        document.getElementById('cash-received').value = '';
        renderCart();
        const qrisBtn = document.getElementById('pay-button-qris');
        qrisBtn.disabled = true;
        qrisBtn.textContent = 'Generate QRIS & Bayar';
        currentQrisTransactionId = null;
        currentQrisTxNumber = null;
    }

    // ── Receipt Modal ──
    function showReceiptModal(data) {
        const itemsHtml = data.items.map(item => `
            <div class="flex justify-between text-[11px] text-stone font-mono">
                <span>${item.name} (x${item.quantity})</span>
                <span>Rp ${new Intl.NumberFormat('id-ID').format(item.price * item.quantity)}</span>
            </div>
        `).join('');
        document.getElementById('receipt-items-list').innerHTML = itemsHtml;
        document.getElementById('receipt-number').textContent = data.txNumber;
        document.getElementById('receipt-method-badge').textContent = data.method;
        document.getElementById('receipt-total').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.total);

        const cashRow   = document.getElementById('receipt-cash-row');
        const changeRow = document.getElementById('receipt-change-row');

        if (data.cash !== null) {
            cashRow.style.display   = '';
            changeRow.style.display = '';
            document.getElementById('receipt-cash').textContent   = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.cash);
            document.getElementById('receipt-change').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.change);
        } else {
            cashRow.style.display   = 'none';
            changeRow.style.display = 'none';
        }

        document.getElementById('receipt-modal').classList.remove('hidden');
    }

    function closeReceipt() {
        document.getElementById('receipt-modal').classList.add('hidden');
        cart = [];
        document.getElementById('cash-received').value = '';
        renderCart();
        document.getElementById('pay-button-cash').textContent = 'Proses Pembayaran Tunai';
        lastReceiptData = null;
    }

    function printReceiptQris() {
        if (lastReceiptData) printReceiptData(lastReceiptData);
    }

    function printReceipt() {
        if (lastReceiptData) printReceiptData(lastReceiptData);
    }

    function printReceiptData(data) {
        const cashLine = data.cash !== null
            ? `<div class="item-row"><span>Bayar (${data.method})</span><span>Rp ${new Intl.NumberFormat('id-ID').format(data.cash)}</span></div>
               <div class="item-row"><span>Kembali</span><span>Rp ${new Intl.NumberFormat('id-ID').format(data.change)}</span></div>`
            : `<div class="item-row"><span>Metode Bayar</span><span>${data.method}</span></div>`;

        const iframe = document.createElement('iframe');
        iframe.style.cssText = 'position:fixed;right:0;bottom:0;width:0;height:0;border:0;';
        document.body.appendChild(iframe);

        const doc = iframe.contentWindow.document;
        doc.open();
        doc.write(`
            <html>
            <head>
                <title>Struk Pembayaran - Filo Coffee</title>
                <style>
                    @page { size: 80mm auto; margin: 0; }
                    body { font-family: 'Courier New', Courier, monospace; width: 72mm; margin: 0 auto; padding: 5mm 0; color: #000; font-size: 11px; line-height: 1.4; }
                    .text-center { text-align: center; }
                    .header { margin-bottom: 5mm; }
                    .header h2 { margin: 0; font-size: 16px; font-weight: bold; }
                    .header p { margin: 2px 0; font-size: 10px; }
                    .divider { border-top: 1px dashed #000; margin: 4px 0; }
                    .item-row { display: flex; justify-content: space-between; margin: 2px 0; }
                    .totals-row { display: flex; justify-content: space-between; font-weight: bold; margin: 3px 0; font-size: 13px; }
                    .footer { margin-top: 6mm; font-size: 9px; }
                </style>
            </head>
            <body>
                <div class="header text-center">
                    <h2>FILO COFFEE</h2>
                    <p>Jl. Nusa Indah No. 45, Denpasar</p>
                    <p>Telp: 0812-3456-7890</p>
                    <div class="divider"></div>
                    <p>No: ${data.txNumber}</p>
                    <p>${new Date().toLocaleString('id-ID')}</p>
                </div>
                <div class="divider"></div>
                <div>
                    ${data.items.map(item => `
                        <div class="item-row">
                            <span>${item.name} x${item.quantity}</span>
                            <span>Rp ${new Intl.NumberFormat('id-ID').format(item.price * item.quantity)}</span>
                        </div>
                    `).join('')}
                </div>
                <div class="divider"></div>
                <div>
                    <div class="totals-row"><span>TOTAL</span><span>Rp ${new Intl.NumberFormat('id-ID').format(data.total)}</span></div>
                    <div class="divider"></div>
                    ${cashLine}
                </div>
                <div class="divider"></div>
                <div class="footer text-center">
                    <p>Terima Kasih Atas Kunjungan Anda</p>
                    <p>Powered by Filo Coffee POS</p>
                </div>
                <script>
                    window.onload = function() {
                        window.print();
                        setTimeout(() => { window.frameElement.remove(); }, 100);
                    };
                <\/script>
            </body>
            </html>
        `);
        doc.close();
    }
</script>
</body>
</html>
