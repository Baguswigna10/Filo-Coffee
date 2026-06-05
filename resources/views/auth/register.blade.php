@extends('layouts.app')
@section('title', 'Daftar Akun | Filo Coffee')

@section('content')
<main class="min-h-[90vh] flex items-center justify-center px-4 py-20 relative overflow-hidden bg-beige-50">
    {{-- Background Accents --}}
    <div class="absolute inset-0 opacity-30 pointer-events-none"
         style="background-image: radial-gradient(circle at 90% 20%, #CFDAD0 0%, transparent 40%), radial-gradient(circle at 10% 80%, #E6DCCF 0%, transparent 40%)">
    </div>

    <div class="relative z-10 w-full max-w-5xl animate-fade-in-up">
        <div class="grid md:grid-cols-2 bg-white border border-olive-500/60 rounded-[2rem] overflow-hidden">
            
            <!-- Left Panel: Form -->
            <div class="p-8 md:p-12 lg:p-16 flex flex-col justify-center bg-white order-2 md:order-1">
                <!-- Header -->
                <div class="mb-8">
                    <div class="inline-flex items-center gap-3 mb-4">
                        <span class="w-8 h-[1.5px] bg-olive-500"></span>
                        <span class="text-olive-700 text-[0.65rem] font-bold tracking-[0.2em] uppercase">Join Our Journey</span>
                    </div>
                    <h1 class="text-4xl font-display font-bold text-olive-900 mb-3">Buat <span class="text-beige-600 italic font-semibold">Akun.</span></h1>
                    <p class="text-olive-800/60 text-sm leading-relaxed">Jadilah bagian dari komunitas Filo Coffee dan dapatkan manfaat eksklusif.</p>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div class="space-y-1.5">
                        <label for="name" class="block text-[0.625rem] font-bold uppercase tracking-widest text-olive-700/50 ml-1">Nama Lengkap</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-olive-700/30 group-focus-within:text-olive-700 transition-colors">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input id="name" name="name" type="text" required value="{{ old('name') }}"
                                   class="bg-beige-50 border border-olive-900/10 rounded-2xl pl-11 pr-4 py-3 text-olive-900 text-sm focus:ring-2 focus:ring-olive-500/20 focus:border-olive-500 focus:outline-none w-full transition-all placeholder-olive-700/30"
                                   placeholder="Masukkan nama lengkap">
                        </div>
                        @error('name')<p class="mt-1 text-[0.625rem] font-medium text-red-650 ml-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-1.5">
                        <label for="email" class="block text-[0.625rem] font-bold uppercase tracking-widest text-olive-700/50 ml-1">Alamat Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-olive-700/30 group-focus-within:text-olive-700 transition-colors">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/>
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" required value="{{ old('email') }}"
                                   class="bg-beige-50 border border-olive-900/10 rounded-2xl pl-11 pr-4 py-3 text-olive-900 text-sm focus:ring-2 focus:ring-olive-500/20 focus:border-olive-500 focus:outline-none w-full transition-all placeholder-olive-700/30"
                                   placeholder="nama@email.com">
                        </div>
                        @error('email')<p class="mt-1 text-[0.625rem] font-medium text-red-650 ml-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-1.5">
                        <label for="password" class="block text-[0.625rem] font-bold uppercase tracking-widest text-olive-700/50 ml-1">Kata Sandi</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-olive-700/30 group-focus-within:text-olive-700 transition-colors">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input id="password" name="password" type="password" required
                                   class="bg-beige-50 border border-olive-900/10 rounded-2xl pl-11 pr-4 py-3 text-olive-900 text-sm focus:ring-2 focus:ring-olive-500/20 focus:border-olive-500 focus:outline-none w-full transition-all placeholder-olive-700/30"
                                   placeholder="Min. 8 Karakter">
                        </div>
                        @error('password')<p class="mt-1 text-[0.625rem] font-medium text-red-650 ml-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div class="space-y-1.5">
                        <label for="password_confirmation" class="block text-[0.625rem] font-bold uppercase tracking-widest text-olive-700/50 ml-1">Konfirmasi Kata Sandi</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-olive-700/30 group-focus-within:text-olive-700 transition-colors">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                   class="bg-beige-50 border border-olive-900/10 rounded-2xl pl-11 pr-4 py-3 text-olive-900 text-sm focus:ring-2 focus:ring-olive-500/20 focus:border-olive-500 focus:outline-none w-full transition-all placeholder-olive-700/30"
                                   placeholder="Ulangi kata sandi">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6">
                        <button type="submit" 
                                class="w-full py-4 bg-olive-800 hover:bg-olive-900 text-beige-50 font-bold rounded-2xl transition-all duration-300 transform hover:-translate-y-0.5 active:scale-[0.98] flex items-center justify-center gap-2 group">
                            <span>Daftar Sekarang</span>
                            <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>

                    <!-- Footnote -->
                    <p class="text-center text-[0.7rem] tracking-widest text-olive-750/30 mt-8">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-olive-800 uppercase hover:text-olive-955 hover:underline transition-colors ml-1 font-bold">Masuk Di Sini</a>
                    </p>
                </form>
            </div>

            <!-- Right Panel: Image & Benefits -->
            <div class="hidden md:block relative overflow-hidden bg-olive-900 order-1 md:order-2">
                <div class="absolute inset-0">
                    <img src="{{ asset('images/auth-bg.jpg') }}" alt="Cozy Coffee" class="w-full h-full object-cover opacity-35 group-hover:scale-103 transition-transform duration-1000 rotate-180">
                    <div class="absolute inset-0 bg-gradient-to-t from-olive-950 via-olive-900/40 to-transparent"></div>
                </div>
                
                <div class="absolute inset-0 p-12 lg:p-16 flex flex-col justify-end">
                    <div class="relative z-10 space-y-6 text-beige-50">
                        <h2 class="font-display text-3xl font-bold text-beige-50 leading-tight">Mulai Perjalanan Kopi Anda <span class="text-beige-300 italic font-semibold">Bersama Kami.</span></h2>
                    </div>
                </div>

                {{-- Decorative element --}}
                <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-olive-800/20 rounded-full blur-3xl pointer-events-none"></div>
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
