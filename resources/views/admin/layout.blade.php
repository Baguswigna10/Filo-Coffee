<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') | Filo Coffee Admin</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Source+Serif+Pro:ital,wght@0,300;0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'dark':        '#1a1815',
                    'dark-deep':   '#141210',
                    'dark-card':   '#211e1a',
                    'cream':       '#F5F0EB',
                    'cream-dark':  '#E8DFD5',
                    'mocca':       '#C9A87C',
                    'mocca-dark':  '#A68B5B',
                    'mocca-light': '#DECCB0',
                    'coffee':      '#6B4226',
                    'coffee-light':'#8B6040',
                    'warm':        '#2a2520',
                    'warm-light':  '#352f28',
                    'olive': {
                        50: '#F4F6F4',
                        100: '#E7ECE7',
                        200: '#CFDAD0',
                        300: '#A4B8A5',
                        400: '#7B967D',
                        500: '#5C7A5E',
                        600: '#465D48',
                        700: '#344535',
                        800: '#232F24',
                        900: '#151C15',
                    },
                    'beige': {
                        50: '#FAF8F5',
                        100: '#F2EDE4',
                        200: '#E6DCCF',
                        300: '#D7C7B5',
                        400: '#C7B198',
                        500: '#B4997A',
                        600: '#9C7F5F',
                        700: '#7E644A',
                        800: '#5B4835',
                        900: '#3D2F23',
                    },
                    // Semantic colors mapped to user theme (Dominant White / Light)
                    'background': '#FAF8F5', // beige-50
                    'on-background': '#151C15', // olive-900
                    'surface': '#ffffff', // pure white
                    'surface-container': '#F2EDE4', // beige-100
                    'surface-container-high': '#E6DCCF', // beige-200
                    'surface-container-low': '#FAF8F5', // beige-50
                    'primary': '#465D48', // olive-600
                    'primary-container': '#CFDAD0', // olive-200
                    'secondary': '#C9A87C', // mocca
                    'secondary-container': '#E6DCCF', // beige-200
                    'tertiary': '#6B4226', // coffee
                    'tertiary-container': '#D7C7B5', // beige-300
                    'error': '#ba1a1a',
                    'error-container': '#ffdad6',
                    'on-primary': '#ffffff',
                    'on-secondary': '#1a1815',
                    'on-surface': '#151C15',
                },
                borderRadius: {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "12px",
                    "2xl": "1rem",
                    "3xl": "1.25rem",
                    "4xl": "1.5rem",
                    "full": "9999px"
                },
                spacing: {
                    "margin-desktop": "64px",
                    "xl": "80px",
                    "base": "8px",
                    "md": "24px",
                    "margin-mobile": "16px",
                    "gutter": "24px",
                    "lg": "48px",
                    "xs": "4px",
                    "sm": "12px",
                    "container-padding": "32px",
                    "sidebar-width": "280px"
                },
                fontFamily: {
                    display: ['"Source Serif Pro"', 'Georgia', 'serif'],
                    body: ['"Poppins"', 'system-ui', 'sans-serif'],
                }
            }
        }
    }
    </script>
    
    <style>
        body { font-family: 'Poppins', system-ui, sans-serif; background-color: #FAF8F5; }
        .font-display { font-family: 'Source Serif Pro', Georgia, serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        
        /* ── Mocca Custom Scrollbar ── */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #FAF8F5; }
        ::-webkit-scrollbar-thumb { background: #C7B198; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #B4997A; }

        /* ── Input Fields ── */
        .input-field {
            width: 100%;
            background: #ffffff;
            border: 1.5px solid rgba(70, 93, 72, 0.15); /* olive-700 translucent */
            border-radius: 0.875rem;
            padding: 0.625rem 1rem;
            color: #151C15;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }
        .input-field::placeholder { color: rgba(21, 28, 21, 0.35); }
        .input-field:focus {
            outline: none;
            border-color: #465D48; /* primary/olive-600 */
            box-shadow: 0 0 0 4px rgba(70, 93, 72, 0.1);
        }

        /* ── Buttons ── */
        .btn-mocca {
            background: linear-gradient(135deg, #C9A87C 0%, #A68B5B 100%);
            color: #ffffff;
            font-weight: 600;
            font-size: 0.8125rem;
            padding: 0.625rem 1.25rem;
            border-radius: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        .btn-mocca:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(201, 168, 124, 0.25);
        }

        .btn-outline-mocca {
            background: transparent;
            color: #C9A87C;
            border: 1.5px solid rgba(201, 168, 124, 0.35);
            font-weight: 600;
            font-size: 0.8125rem;
            padding: 0.625rem 1.25rem;
            border-radius: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.25s ease;
        }
        .btn-outline-mocca:hover {
            background: rgba(201, 168, 124, 0.05);
            border-color: #C9A87C;
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.08);
            color: #dc2626;
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
            background: rgba(239, 68, 68, 0.12);
        }

        /* ── Tables ── */
        .admin-table th {
            font-size: 0.6875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #465D48;
            opacity: 0.7;
            padding: 0.875rem 1.5rem;
        }
        .admin-table td {
            padding: 1rem 1.5rem;
            font-size: 0.8125rem;
            color: #232F24;
        }
        .admin-table tbody tr {
            transition: background 0.2s ease;
        }
        .admin-table tbody tr:hover {
            background: rgba(70, 93, 72, 0.03); /* olive translucent */
        }

        /* ── Select Options ── */
        select.input-field {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23465D48' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            padding-right: 2.5rem;
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
            color: #465D48;
            border: 1px solid rgba(70, 93, 72, 0.15);
        }
        .pagination-wrapper nav a:hover {
            color: #C9A87C;
            border-color: #C9A87C;
            background: rgba(201, 168, 124, 0.05);
        }
        .pagination-wrapper nav span[aria-current="page"] span {
            background: rgba(70, 93, 72, 0.1);
            color: #465D48;
            border: 1px solid rgba(70, 93, 72, 0.3);
        }

        /* ── Status Badges ── */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.6875rem;
            font-weight: 600;
            letter-spacing: 0.02em;
            text-transform: uppercase;
        }
        .badge-Pending { background: #fef3c7; color: #d97706; border: 1px solid rgba(217, 119, 6, 0.2); }
        .badge-Confirmed, .badge-Paid { background: #d1fae5; color: #059669; border: 1px solid rgba(5, 150, 105, 0.2); }
        .badge-Cancelled { background: #fee2e2; color: #dc2626; border: 1px solid rgba(220, 38, 38, 0.2); }
        .badge-Shipped { background: #f3e8ff; color: #7c3aed; border: 1px solid rgba(124, 58, 237, 0.2); }
        .badge-Completed { background: #dbeafe; color: #2563eb; border: 1px solid rgba(37, 99, 235, 0.2); }
        .badge-Processing { background: #e0e7ff; color: #4f46e5; border: 1px solid rgba(79, 70, 229, 0.2); }

        /* ── Dropdown / Tooltip Panels ── */
        .dropdown-panel {
            background: #ffffff;
            border: 1px solid rgba(70, 93, 72, 0.15);
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        /* ── Toast Alerts ── */
        .flash-toast {
            animation: fadeInUp 0.4s ease forwards;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-[#FAF8F5] text-[#151C15] overflow-x-hidden selection:bg-olive-100 selection:text-olive-900 min-h-screen">

    @php
        $logoRoute = in_array('home', $visiblePages ?? []) ? 'home' : (count($visiblePages ?? []) > 0 ? ($visiblePages[0] ?? 'home') : 'home');
    @endphp

    <!-- Sidebar Navigation -->
    <aside class="fixed left-0 top-0 h-full w-[280px] bg-white border-r border-olive-900/5 z-50 flex flex-col py-8 shadow-sm">
        <div class="px-8 mb-12 flex items-center gap-3">
            <a href="{{ route($logoRoute) }}" class="flex items-center gap-3 group">
                <img src="{{ asset('images/logo.png') }}" alt="Filo Coffee Logo" class="h-10 w-auto transition-transform duration-300 group-hover:scale-105">
                <div>
                    <h1 class="font-display text-lg font-bold text-olive-900 tracking-tight leading-none mb-1">Filo Coffee</h1>
                    <p class="text-[9px] text-olive-800/40 uppercase tracking-widest font-bold font-sans">Admin Panel</p>
                </div>
            </a>
        </div>

        <nav class="flex-1 flex flex-col space-y-1">
            <a class="{{ request()->routeIs('admin.dashboard') ? 'bg-olive-50 border-r-4 border-olive-600 text-olive-800 font-semibold' : 'text-olive-900/50 hover:bg-olive-50/50 hover:text-olive-900' }} px-8 py-4 flex items-center gap-4 transition-all duration-300" href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-sm font-medium">Dashboard</span>
            </a>

            <a class="{{ request()->routeIs('admin.menus.*') ? 'bg-olive-50 border-r-4 border-olive-600 text-olive-800 font-semibold' : 'text-olive-900/50 hover:bg-olive-50/50 hover:text-olive-900' }} px-8 py-4 flex items-center gap-4 transition-all duration-300" href="{{ route('admin.menus.index') }}">
                <span class="material-symbols-outlined">restaurant_menu</span>
                <span class="text-sm font-medium">Manajemen Menu</span>
            </a>

            <a class="{{ request()->routeIs('admin.products.*') ? 'bg-olive-50 border-r-4 border-olive-600 text-olive-800 font-semibold' : 'text-olive-900/50 hover:bg-olive-50/50 hover:text-olive-900' }} px-8 py-4 flex items-center gap-4 transition-all duration-300" href="{{ route('admin.products.index') }}">
                <span class="material-symbols-outlined">coffee_maker</span>
                <span class="text-sm font-medium">Produk Biji Kopi</span>
            </a>

            <a class="{{ request()->routeIs('admin.orders.*') ? 'bg-olive-50 border-r-4 border-olive-600 text-olive-800 font-semibold' : 'text-olive-900/50 hover:bg-olive-50/50 hover:text-olive-900' }} px-8 py-4 flex items-center gap-4 transition-all duration-300" href="{{ route('admin.orders.index') }}">
                <span class="material-symbols-outlined">receipt_long</span>
                <span class="text-sm font-medium">Manajemen Pesanan</span>
            </a>

            <a class="{{ request()->routeIs('admin.reservations.tables*') ? 'bg-olive-50 border-r-4 border-olive-600 text-olive-800 font-semibold' : 'text-olive-900/50 hover:bg-olive-50/50 hover:text-olive-900' }} px-8 py-4 flex items-center gap-4 transition-all duration-300" href="{{ route('admin.reservations.tables') }}">
                <span class="material-symbols-outlined">table_restaurant</span>
                <span class="text-sm font-medium">Reservasi Meja</span>
            </a>

            <a class="{{ request()->routeIs('admin.reservations.ps*') ? 'bg-olive-50 border-r-4 border-olive-600 text-olive-800 font-semibold' : 'text-olive-900/50 hover:bg-olive-50/50 hover:text-olive-900' }} px-8 py-4 flex items-center gap-4 transition-all duration-300" href="{{ route('admin.reservations.ps') }}">
                <span class="material-symbols-outlined">sports_esports</span>
                <span class="text-sm font-medium">Booking PS</span>
            </a>

            <a class="{{ request()->routeIs('admin.pages.*') ? 'bg-olive-50 border-r-4 border-olive-600 text-olive-800 font-semibold' : 'text-olive-900/50 hover:bg-olive-50/50 hover:text-olive-900' }} px-8 py-4 flex items-center gap-4 transition-all duration-300" href="{{ route('admin.pages.index') }}">
                <span class="material-symbols-outlined">web</span>
                <span class="text-sm font-medium">Manajemen Halaman</span>
            </a>

            <a class="{{ request()->routeIs('admin.pos.*') ? 'bg-olive-50 border-r-4 border-olive-600 text-olive-800 font-semibold' : 'text-olive-900/50 hover:bg-olive-50/50 hover:text-olive-900' }} px-8 py-4 flex items-center gap-4 transition-all duration-300" href="{{ route('admin.pos.index') }}">
                <span class="material-symbols-outlined">point_of_sale</span>
                <span class="text-sm font-medium">Kasir Mode (POS)</span>
            </a>
        </nav>

        <!-- User profile section -->
        <div class="mt-auto px-6 pt-6 border-t border-olive-900/5">
            <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-olive-50/50 cursor-pointer transition-colors">
                <div class="w-10 h-10 bg-gradient-to-br from-mocca/30 to-mocca/10 rounded-full flex items-center justify-center ring-2 ring-mocca/20">
                    <span class="text-olive-900 text-sm font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-olive-900 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-olive-800/40 truncate">Administrator</p>
                </div>
            </div>
            
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold text-red-500 hover:bg-red-50 transition-colors">
                    <span class="material-symbols-outlined text-sm">logout</span>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <main class="ml-[280px] min-h-screen">
        <!-- Top Navigation Bar -->
        <header class="h-20 fixed top-0 right-0 w-[calc(100%-280px)] bg-white/80 backdrop-blur-md z-40 flex items-center justify-between px-8 border-b border-olive-900/5">
            <div class="flex items-center gap-4 flex-1 max-w-lg">
                <div class="relative w-full">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-olive-900/30 text-sm">search</span>
                    <input class="w-full pl-12 pr-4 py-2.5 bg-olive-50/40 border-none rounded-2xl text-sm focus:ring-2 focus:ring-olive-950/5 transition-all text-olive-900 placeholder-olive-900/35" placeholder="Search orders, stock, or reports..." type="text"/>
                </div>
            </div>
            
            <div class="flex items-center gap-6">
                <!-- Notifications/Alerts -->
                <div class="flex items-center gap-3">
                    @if(session('success'))
                    <div class="flash-toast flex items-center gap-2 bg-green-500/10 border border-green-500/25 text-green-700 px-4 py-2 rounded-xl text-xs font-medium">
                        <span class="material-symbols-outlined text-sm">check_circle</span>
                        {{ session('success') }}
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="flash-toast flex items-center gap-2 bg-red-500/10 border border-red-500/25 text-red-700 px-4 py-2 rounded-xl text-xs font-medium">
                        <span class="material-symbols-outlined text-sm">error</span>
                        {{ session('error') }}
                    </div>
                    @endif
                </div>

                <a href="{{ route($logoRoute) }}" class="flex items-center gap-2 text-olive-900/40 hover:text-olive-900 text-xs font-semibold transition-colors duration-200 group">
                    <span class="material-symbols-outlined text-sm transition-transform duration-200 group-hover:-translate-x-0.5">arrow_back</span>
                    View Site
                </a>

                <a href="{{ route('admin.pos.index') }}" class="bg-olive-800 hover:bg-olive-900 text-beige-50 px-6 py-2.5 rounded-2xl font-semibold flex items-center gap-2 transition-all hover:shadow-lg active:scale-95 text-xs">
                    <span class="material-symbols-outlined text-sm">point_of_sale</span>
                    Buka Kasir
                </a>
            </div>
        </header>

        <!-- Content Area -->
        <div class="pt-28 px-8 pb-12">
            @yield('content')
        </div>
    </main>

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
