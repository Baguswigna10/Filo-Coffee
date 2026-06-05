@extends('layouts.app')
@section('title', 'Masuk Akun | Filo Coffee')

@section('content')
<main class="min-h-[90vh] flex items-center justify-center px-4 py-20 relative overflow-hidden bg-beige-50">
    {{-- Background Accents --}}
    <div class="absolute inset-0 opacity-30 pointer-events-none"
         style="background-image: radial-gradient(circle at 10% 20%, #CFDAD0 0%, transparent 40%), radial-gradient(circle at 90% 80%, #E6DCCF 0%, transparent 40%)">
    </div>

    <div class="relative z-10 w-full max-w-5xl animate-fade-in-up">
        <div class="grid md:grid-cols-2 bg-white border border-olive-500/60 rounded-[2rem] overflow-hidden">
            
            <!-- Left Panel: Form -->
            <div class="p-8 md:p-12 lg:p-16 flex flex-col justify-center bg-white">
                <!-- Header -->
                <div class="mb-10">
                    <div class="inline-flex items-center gap-3 mb-4">
                        <span class="w-8 h-[1.5px] bg-olive-500"></span>
                        <span class="text-olive-700 text-[0.65rem] font-bold tracking-[0.2rem] uppercase">Filo Coffee</span>
                    </div>
                    <h1 class="text-4xl font-display font-bold text-olive-900 mb-3">Selamat <span class="text-beige-600 italic font-semibold">Datang.</span></h1>
                    <p class="text-olive-800/60 text-sm leading-relaxed">Masuk ke akun Anda untuk pengalaman kopi yang lebih personal.</p>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="block text-[0.625rem] font-bold uppercase tracking-widest text-olive-700/50 ml-1">Alamat Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-olive-700/30 group-focus-within:text-olive-700 transition-colors">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/>
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" required value="{{ old('email') }}"
                                   class="bg-beige-50 border border-olive-900/10 rounded-2xl pl-12 pr-4 py-3.5 text-olive-900 text-sm focus:ring-2 focus:ring-olive-500/20 focus:border-olive-500 focus:outline-none w-full transition-all placeholder-olive-700/30"
                                   placeholder="nama@email.com">
                        </div>
                        @error('email')
                            <p class="mt-2 text-[0.625rem] font-medium text-red-600 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-2" x-data="{ show: false }">
                        <div class="flex items-center justify-between ml-1">
                            <label for="password" class="block text-[0.625rem] font-bold uppercase tracking-widest text-olive-700/50">Kata Sandi</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-[0.625rem] font-bold uppercase tracking-widest text-olive-700/40 hover:text-olive-900 transition-colors">Lupa?</a>
                            @endif
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-olive-700/30 group-focus-within:text-olive-700 transition-colors">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input id="password" name="password" :type="show ? 'text' : 'password'" required
                                   class="bg-beige-50 border border-olive-900/10 rounded-2xl pl-12 pr-12 py-3.5 text-olive-900 text-sm focus:ring-2 focus:ring-olive-500/20 focus:border-olive-500 focus:outline-none w-full transition-all placeholder-olive-700/30"
                                   placeholder="••••••••">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-olive-700/30 hover:text-olive-950 transition-colors">
                                <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center ml-1">
                        <input id="remember" name="remember" type="checkbox" 
                               class="w-4 h-4 rounded border-olive-900/10 bg-beige-50 text-olive-800 focus:ring-olive-500 transition-all cursor-pointer">
                        <label for="remember" class="ml-2 block text-[0.625rem] font-bold uppercase tracking-widest text-olive-700/50 cursor-pointer hover:text-olive-900 transition-colors">
                            Ingat saya di perangkat ini
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" 
                                class="w-full py-4 bg-olive-800 hover:bg-olive-900 text-beige-50 font-bold rounded-2xl transition-all duration-300 transform hover:-translate-y-0.5 active:scale-[0.98] flex items-center justify-center gap-2 group">
                            <span>Masuk Ke Akun</span>
                            <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>

                    <!-- Footnote -->
                    <p class="text-center text-[0.7rem] tracking-widest text-olive-750/30 mt-8">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-olive-800 uppercase hover:text-olive-950 hover:underline transition-colors ml-1 font-bold">Daftar Sekarang</a>
                    </p>
                </form>
            </div>

            <!-- Right Panel: Image & Promo -->
            <div class="hidden md:block relative overflow-hidden bg-olive-900">
                <div class="absolute inset-0">
                    <img src="{{ asset('images/auth-bg.jpg') }}" alt="Cozy Coffee" class="w-full h-full object-cover opacity-30 group-hover:scale-103 transition-transform duration-1000">
                    <div class="absolute inset-0 bg-gradient-to-t from-olive-950 via-olive-900/40 to-transparent"></div>
                </div>
                
                <div class="absolute inset-0 p-12 lg:p-16 flex flex-col justify-end">
                    <div class="relative z-10 space-y-4 text-beige-50">
                        <h2 class="font-display text-3xl font-bold text-beige-50 leading-tight">Mulai Hari Anda di <br> <span class="text-beige-300 italic font-semibold">Filo Coffee</span></h2>
                        <p class="text-beige-100/60 text-sm leading-relaxed max-w-sm">Dapatkan poin eksklusif dan promo menarik setiap pembelian melalui akun member kami.</p>
                    </div>
                </div>

                {{-- Decorative element --}}
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-olive-800/20 rounded-full blur-3xl pointer-events-none"></div>
            </div>
        </div>

        {{-- Back home link --}}
        <div class="text-center mt-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-olive-700/40 hover:text-olive-900 transition-colors text-[0.625rem] font-bold uppercase tracking-[0.2em] group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali Ke Beranda
            </a>
        </div>
    </div>
</main>
@endsection
