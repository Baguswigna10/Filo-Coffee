<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') | Filo Coffee Admin</title>
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
        body {
            font-family: 'Poppins', sans-serif;
            background: #141210;
            color: #F5F0EB;
        }

        /* ── Sidebar ── */
        .sidebar {
            background: rgba(26, 24, 21, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem 1rem;
            border-radius: 0.75rem;
            font-size: 0.8125rem;
            font-weight: 500;
            letter-spacing: 0.01em;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .sidebar-link::before {
            content: '';
            position: absolute;
            left: 0; top: 0;
            width: 3px; height: 100%;
            background: #CCB196;
            border-radius: 0 4px 4px 0;
            transform: scaleY(0);
            transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-link.active {
            background: rgba(204, 177, 150, 0.12);
            color: #CCB196;
        }

        .sidebar-link.active::before {
            transform: scaleY(1);
        }

        .sidebar-link:not(.active) {
            color: rgba(237, 237, 237, 0.45);
        }

        .sidebar-link:not(.active):hover {
            color: #EDEDED;
            background: rgba(255, 255, 255, 0.04);
        }

        /* ── Cards ── */
        .admin-card {
            background: rgba(255, 255, 255, 0.025);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .admin-card:hover {
            border-color: rgba(204, 177, 150, 0.15);
        }

        /* ── Stat Card ── */
        .stat-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 1.5rem;
            padding: 1.25rem;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #CCB196, transparent);
            opacity: 0;
            transition: opacity 0.35s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            border-color: rgba(204, 177, 150, 0.2);
            box-shadow: 0 8px 32px rgba(204, 177, 150, 0.06);
        }

        .stat-card:hover::after {
            opacity: 1;
        }

        /* ── Inputs ── */
        .input-field {
            width: 100%;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            padding: 0.625rem 1rem;
            color: #EDEDED;
            font-size: 0.875rem;
            transition: all 0.25s ease;
        }

        .input-field::placeholder {
            color: rgba(255, 255, 255, 0.25);
        }

        .input-field:focus {
            outline: none;
            border-color: #CCB196;
            background: rgba(255, 255, 255, 0.06);
            box-shadow: 0 0 0 3px rgba(204, 177, 150, 0.08);
        }

        /* ── Buttons ── */
        .btn-mocca {
            background: #CCB196;
            color: #242422;
            font-weight: 600;
            font-size: 0.8125rem;
            padding: 0.5rem 1.25rem;
            border-radius: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            letter-spacing: 0.01em;
        }

        .btn-mocca:hover {
            background: #b8996a;
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(204, 177, 150, 0.2);
        }

        .btn-mocca:active {
            transform: translateY(0);
        }

        .btn-outline-mocca {
            background: transparent;
            color: rgba(237, 237, 237, 0.5);
            font-weight: 500;
            font-size: 0.8125rem;
            padding: 0.5rem 1.25rem;
            border-radius: 0.75rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.25s ease;
        }

        .btn-outline-mocca:hover {
            color: #EDEDED;
            border-color: rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.04);
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.08);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.2);
            font-weight: 500;
            font-size: 0.8125rem;
            padding: 0.5rem 1.25rem;
            border-radius: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.25s ease;
        }

        .btn-danger:hover {
            background: rgba(239, 68, 68, 0.15);
        }

        /* ── Badges ── */
        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.6875rem;
            font-weight: 600;
            letter-spacing: 0.02em;
            text-transform: uppercase;
        }

        .badge-Pending { background: rgba(234, 179, 8, 0.12); color: #facc15; border: 1px solid rgba(234, 179, 8, 0.2); }
        .badge-Confirmed, .badge-Paid { background: rgba(34, 197, 94, 0.12); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.2); }
        .badge-Cancelled { background: rgba(239, 68, 68, 0.12); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.2); }
        .badge-Shipped { background: rgba(168, 85, 247, 0.12); color: #c084fc; border: 1px solid rgba(168, 85, 247, 0.2); }
        .badge-Completed { background: rgba(59, 130, 246, 0.12); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.2); }
        .badge-Processing { background: rgba(99, 102, 241, 0.12); color: #818cf8; border: 1px solid rgba(99, 102, 241, 0.2); }

        /* ── Table ── */
        .admin-table th {
            font-size: 0.6875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: rgba(237, 237, 237, 0.3);
            padding: 0.875rem 1.5rem;
        }

        .admin-table td {
            padding: 1rem 1.5rem;
            font-size: 0.8125rem;
        }

        .admin-table tbody tr {
            transition: background 0.2s ease;
        }

        .admin-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(204, 177, 150, 0.3); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(204, 177, 150, 0.5); }

        /* ── Animations ── */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(-8px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .animate-slide-in {
            animation: slideInRight 0.3s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        /* Stagger children */
        .stagger-children > * {
            opacity: 0;
            animation: fadeInUp 0.4s cubic-bezier(0.4,0,0.2,1) forwards;
        }
        .stagger-children > *:nth-child(1) { animation-delay: 0.05s; }
        .stagger-children > *:nth-child(2) { animation-delay: 0.1s; }
        .stagger-children > *:nth-child(3) { animation-delay: 0.15s; }
        .stagger-children > *:nth-child(4) { animation-delay: 0.2s; }
        .stagger-children > *:nth-child(5) { animation-delay: 0.25s; }
        .stagger-children > *:nth-child(6) { animation-delay: 0.3s; }

        /* ── Flash messages ── */
        .flash-toast {
            animation: fadeInUp 0.4s ease forwards;
        }

        /* ── Pagination ── */
        .pagination-wrapper nav span, .pagination-wrapper nav a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2rem;
            height: 2rem;
            padding: 0 0.5rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .pagination-wrapper nav a {
            color: rgba(237,237,237,0.4);
            border: 1px solid rgba(255,255,255,0.06);
        }

        .pagination-wrapper nav a:hover {
            color: #CCB196;
            border-color: rgba(204,177,150,0.3);
            background: rgba(204,177,150,0.05);
        }

        .pagination-wrapper nav span[aria-current="page"] span {
            background: rgba(204,177,150,0.15);
            color: #CCB196;
            border: 1px solid rgba(204,177,150,0.3);
        }

        /* ── Select styling ── */
        select.input-field {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='rgba(237,237,237,0.3)' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            padding-right: 2.5rem;
        }

        select.input-field option {
            background: #2e2e2b;
            color: #EDEDED;
        }

        /* ── Tooltip / Dropdown ── */
        .dropdown-panel {
            background: #2e2e2b;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 0.75rem;
            box-shadow: 0 16px 48px rgba(0,0,0,0.4);
        }
    </style>
</head>
<body class="min-h-screen flex">

    {{-- Sidebar --}}
    <aside class="sidebar w-64 flex-shrink-0 border-r border-white/[0.06] min-h-screen sticky top-0 overflow-y-auto flex flex-col">
        {{-- Logo --}}
        <div class="p-6 border-b border-white/[0.06]">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('images/logo.png') }}" alt="Filo Coffee Logo" class="h-10 w-auto transition-transform duration-300 group-hover:scale-105">
                <div>
                    <div class="text-cream/30 text-[0.65rem] font-medium uppercase tracking-widest">Admin Panel</div>
                </div>
            </a>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 p-4 space-y-1.5 overflow-y-auto">
            <div class="text-cream/20 text-[0.6rem] font-bold px-3 py-2 uppercase tracking-[0.2em] mb-1">Overview</div>

            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <div class="text-cream/20 text-[0.6rem] font-bold px-3 py-2 uppercase tracking-[0.2em] mt-6 mb-1">Katalog</div>

            <a href="{{ route('admin.menus.index') }}" class="sidebar-link {{ request()->routeIs('admin.menus.*') ? 'active' : '' }}">
                <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Manajemen Menu
            </a>

            <a href="{{ route('admin.products.index') }}" class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                Produk Biji Kopi
            </a>

            <div class="text-cream/20 text-[0.6rem] font-bold px-3 py-2 uppercase tracking-[0.2em] mt-6 mb-1">Pesanan</div>

            <a href="{{ route('admin.orders.index') }}" class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                Manajemen Pesanan
            </a>

            <div class="text-cream/20 text-[0.6rem] font-bold px-3 py-2 uppercase tracking-[0.2em] mt-6 mb-1">Reservasi</div>

            <a href="{{ route('admin.reservations.tables') }}" class="sidebar-link {{ request()->routeIs('admin.reservations.tables*') ? 'active' : '' }}">
                <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Reservasi Meja
            </a>

            <a href="{{ route('admin.reservations.ps') }}" class="sidebar-link {{ request()->routeIs('admin.reservations.ps*') ? 'active' : '' }}">
                <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/></svg>
                Booking PS
            </a>

            <div class="text-cream/20 text-[0.6rem] font-bold px-3 py-2 uppercase tracking-[0.2em] mt-6 mb-1">Pengaturan</div>

            <a href="{{ route('admin.pages.index') }}" class="sidebar-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6m-6 4h1"/></svg>
                Manajemen Halaman
            </a>

            <div class="text-cream/20 text-[0.6rem] font-bold px-3 py-2 uppercase tracking-[0.2em] mt-6 mb-1">Kasir</div>

            <a href="{{ route('admin.pos.index') }}" class="sidebar-link {{ request()->routeIs('admin.pos.*') ? 'active' : '' }}">
                <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                Kasir Mode (POS)
            </a>
        </nav>

        {{-- User card --}}
        <div class="p-4 border-t border-white/[0.06]">
            <div class="flex items-center gap-3 px-3 py-3 rounded-xl bg-white/[0.03]">
                <div class="w-9 h-9 bg-gradient-to-br from-mocca/30 to-mocca/10 rounded-full flex items-center justify-center ring-1 ring-mocca/20">
                    <span class="text-mocca text-sm font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-cream text-sm font-medium truncate">{{ auth()->user()->name }}</div>
                    <div class="text-cream/25 text-[0.65rem] font-medium">Administrator</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="w-full sidebar-link text-red-400/60 hover:text-red-400 hover:bg-red-500/[0.06]">
                    <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 min-w-0 bg-[#0c0b0a]">
        {{-- Top bar --}}
        <header class="sticky top-0 z-30 border-b border-white/[0.04] px-8 py-5 flex items-center justify-between" style="background: rgba(20,18,16,0.8); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);">
            <div>
                <h1 class="font-display text-xl text-cream font-bold tracking-tight">@yield('page-title', 'Dashboard')</h1>
                <p class="text-cream/20 text-[0.7rem] font-medium uppercase tracking-[0.15em] mt-1">@yield('page-subtitle', '')</p>
            </div>
            <div class="flex items-center gap-4">
                {{-- Flash messages --}}
                @if(session('success'))
                <div class="flash-toast flex items-center gap-2 bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-2 rounded-xl text-sm">
                    <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg>
                    {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                <div class="flash-toast flex items-center gap-2 bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-2 rounded-xl text-sm">
                    {{ session('error') }}
                </div>
                @endif

                {{-- View site link --}}
                @php
                    $logoRoute = in_array('home', $visiblePages ?? []) ? 'home' : (count($visiblePages ?? []) > 0 ? ($visiblePages[0] ?? 'home') : 'home');
                @endphp
                <a href="{{ route($logoRoute) }}" class="flex items-center gap-2 text-cream/30 hover:text-mocca text-xs font-medium transition-colors duration-200 group">
                    <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    View Site
                </a>
            </div>
        </header>

        <main class="p-8">
            @yield('content')
        </main>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        // Auto-dismiss flash toasts
        setTimeout(() => {
            document.querySelectorAll('.flash-toast').forEach(el => {
                el.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                el.style.opacity = '0';
                el.style.transform = 'translateY(-4px)';
                setTimeout(() => el.remove(), 400);
            });
        }, 4000);
    </script>
    @stack('scripts')
</body>
</html>
