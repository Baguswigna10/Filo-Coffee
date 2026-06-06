<footer class="bg-olive-900 pt-20 pb-10 relative overflow-hidden">
    {{-- Decorative Elements --}}
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-olive-800/40 rounded-full blur-[160px] -translate-y-1/3 translate-x-1/4 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-olive-950/50 rounded-full blur-[120px] translate-y-1/2 -translate-x-1/4 pointer-events-none"></div>
    <div class="absolute inset-0 opacity-[0.03] bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCI+PGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMSIgZmlsbD0id2hpdGUiLz48L3N2Zz4=')] pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-14 lg:gap-8 mb-16">

            {{-- Brand Column --}}
            <div class="lg:col-span-1">
                @php
                    $logoRoute = in_array('home', $visiblePages ?? []) ? 'home' : (count($visiblePages ?? []) > 0 ? ($visiblePages[0] ?? 'home') : 'home');
                @endphp
                <a href="{{ route($logoRoute) }}" class="inline-block mb-6">
                    <img src="{{ asset('images/logo1.png') }}" alt="Filo Coffee" class="h-20 w-auto object-contain transition-transform duration-500 hover:scale-105">
                </a>
                <p class="text-olive-200/50 text-sm leading-relaxed mb-8 max-w-xs">
                    Pengalaman kopi premium dari biji pilihan Nusantara. Diracik dengan presisi, disajikan dengan kehangatan.
                </p>
                <div class="flex gap-3">
                    @foreach(['facebook', 'instagram', 'twitter', 'youtube'] as $social)
                    <a href="#" class="w-10 h-10 rounded-xl bg-olive-800/60 border border-olive-700/40 flex items-center justify-center text-olive-300/50 hover:bg-mocca hover:text-olive-900 hover:border-mocca transition-all duration-400 group">
                        <span class="sr-only">{{ ucfirst($social) }}</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            @if($social == 'facebook') <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                            @elseif($social == 'instagram') <path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16.4a4.238 4.238 0 110-8.476 4.238 4.238 0 010 8.476zm7.82-10.306a1.44 1.44 0 11-2.88 0 1.44 1.44 0 012.88 0z"/>
                            @elseif($social == 'twitter') <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            @elseif($social == 'youtube') <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                            @endif
                        </svg>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-olive-100 text-xs font-bold mb-7 uppercase tracking-[0.2em]">Navigasi</h4>
                <ul class="space-y-3.5">
                    @foreach([
                        ['route' => 'home',     'label' => 'Home'],
                        ['route' => 'about',    'label' => 'About Filo'],
                        ['route' => 'menu',     'label' => 'Menu'],
                        ['route' => 'shop',     'label' => 'Shop Beans'],
                        ['route' => 'news',     'label' => 'News'],
                        ['route' => 'member',   'label' => 'Member'],
                    ] as $link)
                    @if(in_array($link['route'], $visiblePages ?? []))
                    <li>
                        <a href="{{ route($link['route']) }}" class="text-olive-200/40 hover:text-mocca text-sm transition-all duration-300 flex items-center gap-2.5 group font-medium">
                            <span class="w-1 h-1 rounded-full bg-olive-600 group-hover:bg-mocca group-hover:scale-150 transition-all duration-300"></span>
                            {{ $link['label'] }}
                        </a>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>

            {{-- Contact Info --}}
            <div>
                <h4 class="text-olive-100 text-xs font-bold mb-7 uppercase tracking-[0.2em]">Lokasi &amp; Kontak</h4>
                <ul class="space-y-5">
                    <li class="flex items-start gap-4">
                        <div class="w-9 h-9 rounded-xl bg-olive-800/60 border border-olive-700/30 flex items-center justify-center flex-shrink-0 text-mocca/70">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <p class="text-olive-200/40 text-sm leading-relaxed pt-1">Jl. Kopi Nusantara No. 12,<br>Jakarta Selatan, Indonesia</p>
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="w-9 h-9 rounded-xl bg-olive-800/60 border border-olive-700/30 flex items-center justify-center flex-shrink-0 text-mocca/70">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <p class="text-olive-200/40 text-sm">+62 812-3456-7890</p>
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="w-9 h-9 rounded-xl bg-olive-800/60 border border-olive-700/30 flex items-center justify-center flex-shrink-0 text-mocca/70">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-olive-200/40 text-sm">Setiap Hari: 12:00 – 23:00</p>
                    </li>
                </ul>
            </div>

            {{-- Newsletter --}}
            <div>
                <h4 class="text-olive-100 text-xs font-bold mb-7 uppercase tracking-[0.2em]">Newsletter</h4>
                <p class="text-olive-200/40 text-sm mb-5 leading-relaxed">Berlangganan untuk mendapatkan update menu baru dan promo eksklusif.</p>
                <form action="#" class="space-y-3">
                    <div class="relative">
                        <input type="email" placeholder="Email Anda"
                               class="w-full bg-olive-800/50 border border-olive-700/40 rounded-xl px-4 py-3.5 text-sm text-olive-100 placeholder:text-olive-400/40 focus:outline-none focus:border-mocca/50 focus:bg-olive-800/70 transition-all">
                        <button type="submit" class="absolute right-2 top-2 bottom-2 bg-mocca text-olive-900 px-4 rounded-lg hover:bg-mocca-dark transition-colors font-bold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="pt-10 border-t border-olive-800/60 flex flex-col md:flex-row items-center justify-between gap-6">
            <p class="text-olive-400/40 text-xs font-semibold uppercase tracking-[0.2em]">
                &copy; {{ date('Y') }} Filo Coffee. Crafted with Passion.
            </p>
            <div class="flex items-center gap-8">
                <a href="#" class="text-olive-400/30 hover:text-mocca text-[0.65rem] font-bold uppercase tracking-widest transition-colors">Privacy Policy</a>
                <a href="#" class="text-olive-400/30 hover:text-mocca text-[0.65rem] font-bold uppercase tracking-widest transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
