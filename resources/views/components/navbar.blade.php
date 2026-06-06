<nav
    x-data="{
        open: false,
        scrolled: false
    }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
    :class="scrolled ? 'h-16 py-0 border-b border-beige-200' : 'h-20 py-2 border-b border-transparent'"
    class="sticky top-0 z-40 bg-white/95 backdrop-blur-xl transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)]">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
        <div class="flex items-center justify-between h-full">

            <!-- Logo -->
            @php
                $logoRoute = in_array('home', $visiblePages ?? []) ? 'home' : (count($visiblePages ?? []) > 0 ? ($visiblePages[0] ?? 'home') : 'home');
            @endphp
            <a href="{{ route($logoRoute) }}" class="flex items-center gap-3 group transition-all duration-500">
                <img src="{{ asset('images/logo.png') }}"
                     alt="Filo Coffee Logo"
                     :class="scrolled ? 'h-9' : 'h-12'"
                     class="w-auto object-contain transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)]">
            </a>

            <!-- Desktop Nav -->
            <div class="hidden lg:flex items-center gap-0.5">
                @foreach([
                    ['route' => 'home',              'label' => 'Home'],
                    ['route' => 'about',             'label' => 'About Filo'],
                    ['route' => 'menu',              'label' => 'Menu'],
                    ['route' => 'shop',              'label' => 'Shop Beans'],
                    ['route' => 'services',          'label' => 'Services'],
                    ['route' => 'news',              'label' => 'News'],
                    ['route' => 'member',            'label' => 'Member'],
                    ['route' => 'reservation.index', 'label' => 'Reservasi'],
                    ['route' => 'playstation.index', 'label' => 'PlayStation'],
                    ['route' => 'contact',           'label' => 'Contact'],
                ] as $nav)
                @php
                    $routeBase = explode('.', $nav['route'])[0];
                    $isActive  = request()->routeIs($nav['route']) || request()->routeIs($routeBase . '.*');
                @endphp
                @if(in_array($nav['route'], $visiblePages ?? []))
                <a href="{{ route($nav['route']) }}"
                   class="relative px-3 py-2 rounded-xl text-[0.8rem] font-semibold transition-all duration-300 group
                          {{ $isActive
                             ? 'text-olive-700 bg-olive-50'
                             : 'text-olive-800/55 hover:text-olive-900 hover:bg-olive-50/70' }}">
                    {{ $nav['label'] }}
                    {{-- Active underline indicator --}}
                    @if($isActive)
                    <span class="absolute bottom-0.5 left-1/2 -translate-x-1/2 w-4 h-0.5 bg-gradient-to-r from-olive-600 to-olive-500 rounded-full"></span>
                    @endif
                </a>
                @endif
                @endforeach
            </div>

            <!-- Right Actions -->
            <div class="flex items-center gap-2">

                @auth
                    <!-- Cart -->
                    <a href="{{ route('cart') }}" class="relative p-2.5 text-olive-600/50 hover:text-olive-700 transition-all duration-300 group rounded-xl hover:bg-olive-50">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        @php $cartCount = app(\App\Services\CartService::class)->getCount(); @endphp
                        <span id="cart-badge" class="{{ $cartCount > 0 ? 'flex' : 'hidden' }} absolute -top-0.5 -right-0.5 w-5 h-5 bg-olive-700 text-white text-[0.6rem] font-bold rounded-full items-center justify-center ring-2 ring-white">
                            {{ $cartCount }}
                        </span>
                    </a>

                    <!-- User Menu -->
                    <div class="relative" x-data="{ userOpen: false }">
                        <button @click="userOpen = !userOpen" class="flex items-center gap-2 px-2.5 py-1.5 rounded-xl hover:bg-olive-50 transition-all duration-300 border border-transparent hover:border-beige-200">
                            <div class="w-8 h-8 bg-olive-100 rounded-full flex items-center justify-center ring-1 ring-olive-200">
                                <span class="text-olive-700 text-sm font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                            <span class="hidden lg:block text-sm text-olive-700/70 font-semibold">{{ auth()->user()->name }}</span>
                            <svg class="w-3.5 h-3.5 text-olive-400 transition-transform duration-300" :class="userOpen && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>

                        <div x-show="userOpen" @click.away="userOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 top-12 w-56 bg-white border border-beige-200 rounded-2xl shadow-xl shadow-olive-900/10 overflow-hidden">
                            @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-olive-700 hover:bg-olive-50 transition-colors duration-200 font-semibold">
                                <svg class="w-4 h-4 text-olive-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                Admin Panel
                            </a>
                            <div class="border-t border-beige-100"></div>
                            @endif
                            <a href="{{ route('orders.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-olive-700/70 hover:text-olive-900 hover:bg-olive-50 transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                Pesanan Saya
                            </a>
                            <div class="border-t border-beige-100"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-500/70 hover:text-red-600 hover:bg-red-50 transition-colors duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-olive-700/60 hover:text-olive-900 px-3 py-2 transition-colors duration-300 font-semibold rounded-xl hover:bg-olive-50">Login</a>
                    <a href="{{ route('register') }}" class="text-sm bg-olive-700 text-white hover:bg-olive-800 px-5 py-2 rounded-xl font-semibold transition-all duration-300 hover:-translate-y-0.5 shadow-sm shadow-olive-900/15">Register</a>
                @endauth

                <!-- Mobile menu button -->
                <button @click="open = !open" class="lg:hidden p-2.5 text-olive-600/50 hover:text-olive-800 transition-all duration-300 rounded-xl hover:bg-olive-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="lg:hidden border-t border-beige-100 bg-white">
        <div class="px-4 py-5 space-y-1 max-h-[70vh] overflow-y-auto">
            @foreach([
                ['route' => 'home',              'label' => 'Home'],
                ['route' => 'about',             'label' => 'About Filo'],
                ['route' => 'menu',              'label' => 'Menu'],
                ['route' => 'shop',              'label' => 'Shop Beans'],
                ['route' => 'services',          'label' => 'Services'],
                ['route' => 'news',              'label' => 'News'],
                ['route' => 'member',            'label' => 'Member'],
                ['route' => 'reservation.index', 'label' => 'Reservasi'],
                ['route' => 'playstation.index', 'label' => 'PlayStation'],
                ['route' => 'contact',           'label' => 'Contact'],
            ] as $nav)
            @php
                $routeBase = explode('.', $nav['route'])[0];
                $isActive  = request()->routeIs($nav['route']) || request()->routeIs($routeBase . '.*');
            @endphp
            @if(in_array($nav['route'], $visiblePages ?? []))
            <a href="{{ route($nav['route']) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ $isActive ? 'text-olive-700 bg-olive-50 border border-olive-200' : 'text-olive-700/60 hover:text-olive-900 hover:bg-olive-50' }}">
                @if($isActive)
                <span class="w-1.5 h-1.5 bg-olive-600 rounded-full"></span>
                @endif
                {{ $nav['label'] }}
            </a>
            @endif
            @endforeach
        </div>
    </div>
</nav>

<script src="//unpkg.com/alpinejs" defer></script>
