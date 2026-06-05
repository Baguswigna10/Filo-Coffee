<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Filo Coffee') | Filo Coffee</title>
    <meta name="description" content="@yield('meta_description', 'Filo Coffee - Simplicity of Taste')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="../images/logo1.png" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Source+Serif+Pro:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
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
                },
                fontFamily: {
                    'display': ['"Source Serif Pro"', 'Georgia', 'serif'],
                    'body':    ['"Poppins"', 'system-ui', 'sans-serif'],
                },
                borderRadius: {
                    '2xl': '1rem',
                    '3xl': '1.25rem',
                    '4xl': '1.5rem',
                },
                transitionDuration: {
                    '400': '400ms',
                    '600': '600ms',
                },
            }
        }
    }
    </script>
    <style>
        /* ══════════════════════════════════
           DESIGN SYSTEM — Filo Coffee
           ══════════════════════════════════ */

        * { box-sizing: border-box; }

        body {
            font-family: 'Poppins', system-ui, sans-serif;
            background: #FAF8F5;
            color: #2C2416;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }
        .font-display { font-family: 'Source Serif Pro', Georgia, serif; }

        /* ── Premium Buttons ── */
        .btn-mocca {
            background: linear-gradient(135deg, #C9A87C 0%, #A68B5B 100%);
            color: #1a1815;
            font-weight: 600;
            padding: 0.8rem 1.75rem;
            border-radius: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            letter-spacing: 0.02em;
            font-size: 0.9375rem;
            position: relative;
            overflow: hidden;
        }
        .btn-mocca::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transition: left 0.5s ease;
        }
        .btn-mocca:hover::before { left: 100%; }
        .btn-mocca:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(201, 168, 124, 0.3);
        }
        .btn-mocca:active { transform: translateY(0); }

        .btn-outline {
            border: 1.5px solid rgba(201, 168, 124, 0.35);
            color: #C9A87C;
            font-weight: 600;
            padding: 0.8rem 1.75rem;
            border-radius: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.9375rem;
            background: transparent;
        }
        .btn-outline:hover {
            background: linear-gradient(135deg, #C9A87C 0%, #A68B5B 100%);
            color: #1a1815;
            border-color: #C9A87C;
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(201, 168, 124, 0.2);
        }

        /* ── Premium Cards ── */
        .card {
            background: linear-gradient(145deg, rgba(42, 37, 32, 0.8) 0%, rgba(33, 30, 26, 0.6) 100%);
            border: 1px solid rgba(201, 168, 124, 0.08);
            border-radius: 1.25rem;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        .card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 1.25rem;
            padding: 1px;
            background: linear-gradient(145deg, rgba(201,168,124,0.15), transparent 40%);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.5s ease;
        }
        .card:hover::before { opacity: 1; }
        .card:hover {
            border-color: rgba(201, 168, 124, 0.2);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(201, 168, 124, 0.08);
            transform: translateY(-4px);
        }

        /* ── Inputs ── */
        .input-field {
            width: 100%;
            background: rgba(42, 37, 32, 0.6);
            border: 1.5px solid rgba(201, 168, 124, 0.12);
            border-radius: 0.875rem;
            padding: 0.8rem 1.1rem;
            color: #F5F0EB;
            font-size: 0.9375rem;
            transition: all 0.3s ease;
        }
        .input-field::placeholder { color: rgba(245, 240, 235, 0.3); }
        .input-field:focus {
            outline: none;
            border-color: #C9A87C;
            background: rgba(42, 37, 32, 0.8);
            box-shadow: 0 0 0 4px rgba(201, 168, 124, 0.1), 0 4px 16px rgba(0,0,0,0.2);
        }

        /* ── Typography ── */
        .section-title {
            font-family: 'Source Serif Pro', Georgia, serif;
            font-size: clamp(1.875rem, 4vw, 2.75rem);
            color: #F5F0EB;
            font-weight: 700;
            margin-bottom: 0.5rem;
            line-height: 1.15;
            letter-spacing: -0.01em;
        }
        .section-subtitle {
            color: #C9A87C;
            font-weight: 600;
            letter-spacing: 0.18em;
            font-size: 0.75rem;
            text-transform: uppercase;
            margin-bottom: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
        }
        .section-subtitle::before {
            content: '';
            width: 2rem;
            height: 1px;
            background: rgba(201, 168, 124, 0.4);
        }

        /* ── Badges ── */
        .badge { padding: 0.3rem 0.85rem; border-radius: 9999px; font-size: 0.6875rem; font-weight: 600; letter-spacing: 0.03em; }
        .badge-status-Pending { background: rgba(234,179,8,0.12); color: #facc15; border: 1px solid rgba(234,179,8,0.25); }
        .badge-status-Confirmed, .badge-status-Paid { background: rgba(34,197,94,0.12); color: #4ade80; border: 1px solid rgba(34,197,94,0.25); }
        .badge-status-Cancelled { background: rgba(239,68,68,0.12); color: #f87171; border: 1px solid rgba(239,68,68,0.25); }
        .badge-status-Shipped { background: rgba(168,85,247,0.12); color: #c084fc; border: 1px solid rgba(168,85,247,0.25); }
        .badge-status-Completed { background: rgba(59,130,246,0.12); color: #60a5fa; border: 1px solid rgba(59,130,246,0.25); }
        .badge-status-Processing { background: rgba(99,102,241,0.12); color: #818cf8; border: 1px solid rgba(99,102,241,0.25); }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #F0EBE3; }
        ::-webkit-scrollbar-thumb { background: rgba(70, 93, 72, 0.25); border-radius: 6px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(70, 93, 72, 0.45); }

        /* ── Animations ── */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            25% { transform: translateY(-12px) rotate(0.5deg); }
            75% { transform: translateY(-6px) rotate(-0.3deg); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-fade-in {
            animation: fadeIn 0.6s ease forwards;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        .animate-shimmer {
            background: linear-gradient(90deg, transparent 0%, rgba(201,168,124,0.06) 50%, transparent 100%);
            background-size: 200% 100%;
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 20px rgba(201,168,124,0.1); }
            50% { box-shadow: 0 0 40px rgba(201,168,124,0.2); }
        }
        .animate-pulse-glow { animation: pulseGlow 4s ease-in-out infinite; }

        /* Scroll-triggered reveal */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ── Gradients ── */
        .gradient-mocca { background: linear-gradient(135deg, #C9A87C 0%, #A68B5B 100%); }
        .gradient-dark { background: linear-gradient(145deg, #1a1815 0%, #141210 100%); }
        .gradient-warm { background: linear-gradient(180deg, #2a2520 0%, #1a1815 100%); }

        /* ── Glass ── */
        .glass {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(24px) saturate(150%);
            -webkit-backdrop-filter: blur(24px) saturate(150%);
        }

        /* ── Section Divider ── */
        .section-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201,168,124,0.15), transparent);
        }

        /* ── Select ── */
        select.input-field {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='rgba(245,240,235,0.3)' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            padding-right: 2.5rem;
        }
        select.input-field option { background: #2a2520; color: #F5F0EB; }

        /* ── Flash Message ── */
        .flash-toast {
            animation: fadeInUp 0.4s ease forwards;
        }

        /* ── Decorative Noise ── */
        .noise-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            pointer-events: none;
            opacity: 0.015;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen">



    <!-- Navbar -->
    @include('components.navbar')

    <!-- Flash Messages -->
    <div class="fixed top-20 right-4 z-50 space-y-2" id="flash-messages">
        @if(session('success'))
        <div class="flash-toast bg-white border border-green-200 text-green-700 px-5 py-3 rounded-2xl shadow-xl shadow-green-900/8 flex items-center gap-3" role="alert">
            <svg class="w-5 h-5 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <span class="text-sm font-semibold">{{ session('success') }}</span>
        </div>
        @endif
        @if(session('error'))
        <div class="flash-toast bg-white border border-red-200 text-red-600 px-5 py-3 rounded-2xl shadow-xl shadow-red-900/8 flex items-center gap-3" role="alert">
            <svg class="w-5 h-5 flex-shrink-0 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
            <span class="text-sm font-semibold">{{ session('error') }}</span>
        </div>
        @endif
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/{{ config('app.whatsapp_number', '6281234567890') }}?text=Halo+Filo+Coffee!"
       target="_blank"
       class="fixed bottom-6 right-6 z-50 group"
       title="Chat via WhatsApp">
        <div class="relative">
            <div class="absolute inset-0 bg-green-500 rounded-full animate-ping opacity-20"></div>
            <div class="relative bg-green-500 hover:bg-green-600 text-white rounded-full p-4 shadow-2xl transition-all duration-300 group-hover:scale-110 group-hover:shadow-green-500/20">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                </svg>
            </div>
        </div>
    </a>

    <script>
        // Auto-dismiss flash messages
        setTimeout(() => {
            document.querySelectorAll('#flash-messages > div').forEach(el => {
                el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                el.style.opacity = '0';
                el.style.transform = 'translateY(-8px)';
                setTimeout(() => el.remove(), 500);
            });
        }, 4000);

        // Cart count update helper
        window.updateCartBadge = function(count) {
            const badge = document.getElementById('cart-badge');
            if (badge) {
                badge.textContent = count;
                badge.style.display = count > 0 ? 'flex' : 'none';
            }
        };

        // Scroll-triggered reveal animation
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -50px 0px' });

        document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));
    </script>
    @stack('scripts')
    <!-- Smooth Scroll (Lenis) -->
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.33/dist/lenis.min.js"></script>
    <script>
        window.lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            direction: 'vertical',
            gestureDirection: 'vertical',
            smooth: true,
            mouseMultiplier: 1,
            smoothTouch: false,
            touchMultiplier: 2,
            infinite: false,
        })

        function raf(time) {
            window.lenis.raf(time)
            requestAnimationFrame(raf)
        }

        requestAnimationFrame(raf)

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                lenis.scrollTo(this.getAttribute('href'))
            });
        });

        // Re-observe reveal elements after DOM is ready
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));
        });
    </script>

    {{-- Page-specific scripts injected via @push('scripts') --}}
    @stack('scripts')
</body>
</html>

