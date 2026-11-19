<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk - SIPANDAI</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f4f8f6;
            color: #0f172a;
        }
    </style>
</head>
<body class="antialiased selection:bg-emerald-900 selection:text-emerald-100 min-h-screen relative overflow-x-hidden flex items-center justify-center p-4 sm:p-6 lg:p-8">

    {{-- DEKORASI BLOB LATAR BELAKANG (ADAPTASI SUDUT KIRI ATAS & KANAN BAWAH) --}}
    <div class="pointer-events-none fixed -left-24 -top-24 w-96 h-96 sm:w-[32rem] sm:h-[32rem] rounded-full bg-gradient-to-br from-emerald-800 via-emerald-600 to-teal-500 opacity-90 blur-2xl"></div>
    <div class="pointer-events-none fixed -right-24 -bottom-24 w-80 h-80 sm:w-[28rem] sm:h-[28rem] rounded-full bg-gradient-to-tl from-slate-900 via-emerald-900 to-teal-700 opacity-90 blur-2xl"></div>

    {{-- TOMBOL KEMBALI KE BERANDA (POJOK KIRI ATAS) --}}
    <a href="{{ url('/') }}"
       class="fixed top-5 left-5 z-20 inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/90 hover:bg-white text-slate-800 font-bold text-xs shadow-md backdrop-blur-xs border border-slate-200/80 transition-all hover:-translate-x-0.5">
        <svg class="w-3.5 h-3.5 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        Beranda SIPANDAI
    </a>

    {{-- KARTU UTAMA SPLIT-SCREEN --}}
    <div class="relative z-10 w-full max-w-5xl bg-white rounded-[2rem] shadow-2xl shadow-slate-900/15 border border-slate-200/80 overflow-hidden grid grid-cols-1 lg:grid-cols-12">

        {{-- KOLOM KIRI: PANEL ILUSTRASI & IDENTITAS CIVIC-TECH (6 KOLOM) --}}
        <div class="lg:col-span-6 relative bg-gradient-to-br from-emerald-50/90 via-teal-50/60 to-slate-50 p-8 sm:p-10 lg:p-12 flex flex-col justify-between overflow-hidden">
            {{-- Kurva Pembatas Organik Sisi Kanan (Desktop) --}}
            <div class="hidden lg:block pointer-events-none absolute -right-12 top-0 bottom-0 w-24 bg-white rounded-l-[100%]"></div>

            {{-- Brand Header Kiri --}}
            <div class="relative z-10 flex items-center justify-between">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-slate-900 via-emerald-950 to-emerald-800 flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-emerald-300 stroke-[2.2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-lg font-extrabold tracking-tight text-slate-900 leading-none">SIPANDAI</span>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-emerald-700 mt-0.5">E-Posyandu &amp; KIA Digital</span>
                    </div>
                </a>

                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-100/80 border border-amber-200 text-[11px] font-extrabold text-amber-800">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                    Akses Terpadu
                </span>
            </div>

            {{-- ILUSTRASI SVG KUSTOM (ADAPTASI GAYA SMARTPHONE + KUNCI + TAMAN + PERISAI KEAMANAN) --}}
            <div class="relative z-10 my-6 flex items-center justify-center">
                <svg viewBox="0 0 400 310" class="w-full max-w-sm h-auto drop-shadow-xs" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Ilustrasi Akses Aman Buku KIA Digital">
                    {{-- Latar Belakang Organik Lembut --}}
                    <path d="M68 182C42 132 76 64 138 48C200 32 272 52 316 102C360 152 350 232 292 260C234 288 94 232 68 182Z" fill="#d1fae5" fill-opacity="0.65" />
                    <circle cx="312" cy="76" r="22" fill="#fef3c7" />

                    {{-- Awan Dekoratif --}}
                    <rect x="64" y="92" width="74" height="22" rx="11" fill="#ffffff" fill-opacity="0.9" />
                    <circle cx="88" cy="90" r="14" fill="#ffffff" fill-opacity="0.9" />
                    <rect x="252" y="106" width="84" height="20" rx="10" fill="#a7f3d0" fill-opacity="0.7" />
                    <circle cx="282" cy="104" r="13" fill="#a7f3d0" fill-opacity="0.7" />

                    {{-- Perisai Keamanan Data KIA (Kiri) --}}
                    <path d="M84 134L102 141V155C102 167 94 176 84 180C74 176 66 167 66 155V141L84 134Z" fill="#064e3b" />
                    <circle cx="84" cy="154" r="3.5" fill="#34d399" />
                    <path d="M84 157V163" stroke="#34d399" stroke-width="2.2" stroke-linecap="round" />
                    <path d="M84 184V204H116" stroke="#6ee7b7" stroke-width="1.8" stroke-dasharray="4 4" />

                    {{-- Bingkai Smartphone / Kartu Portal KIA --}}
                    <rect x="122" y="52" width="136" height="218" rx="22" fill="#064e3b" />
                    <rect x="129" y="60" width="122" height="202" rx="16" fill="#ffffff" />
                    {{-- Speaker Notch --}}
                    <rect x="172" y="66" width="36" height="4" rx="2" fill="#cbd5e1" />

                    {{-- Avatar Pengguna (Ibu & Anak / Kader) --}}
                    <circle cx="190" cy="102" r="22" fill="#d1fae5" />
                    <circle cx="190" cy="97" r="8" fill="#064e3b" />
                    <path d="M175 117C177 109 183 106 190 106C197 106 203 109 205 117" fill="#10b981" />

                    {{-- Bar Input Simulasi di Layar --}}
                    <rect x="148" y="136" width="84" height="12" rx="6" fill="#e2e8f0" />
                    <circle cx="156" cy="142" r="2.5" fill="#10b981" />
                    <rect x="148" y="156" width="84" height="12" rx="6" fill="#cbd5e1" />
                    <circle cx="156" cy="162" r="2.5" fill="#064e3b" />

                    {{-- Lubang Kunci Akses --}}
                    <circle cx="190" cy="194" r="8" fill="#0f172a" />
                    <path d="M186 199L184 214H196L194 199H186Z" fill="#0f172a" />

                    {{-- Grafik Mini KMS di Bawah Layar --}}
                    <path d="M148 242C162 239 174 230 190 227C206 224 218 218 232 214" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" />

                    {{-- Tanaman Hias Pot (Kiri Bawah) --}}
                    <path d="M98 244H126L121 270H103L98 244Z" fill="#0f172a" />
                    <path d="M112 244C112 244 92 232 94 214C96 198 112 216 112 244Z" fill="#059669" />
                    <path d="M112 244C112 244 132 230 130 212C128 196 112 216 112 244Z" fill="#10b981" />
                    <path d="M112 244C112 244 104 218 112 202C120 218 112 244 112 244Z" fill="#34d399" />

                    {{-- Karakter Petugas / Pengguna Memegang Kunci Emas (Amber) --}}
                    {{-- Kaki & Sepatu --}}
                    <path d="M294 216L282 264H292L304 222" fill="#0f172a" />
                    <path d="M308 216L324 264H334L316 220" fill="#1e293b" />
                    <rect x="276" y="263" width="16" height="6" rx="3" fill="#f59e0b" />
                    <rect x="322" y="263" width="16" height="6" rx="3" fill="#f59e0b" />

                    {{-- Badan / Seragam Emerald --}}
                    <path d="M288 164C288 156 294 150 302 150H310C318 150 324 156 324 164V218H288V164Z" fill="#047857" />
                    {{-- Kepala --}}
                    <circle cx="306" cy="134" r="12" fill="#fed7aa" />
                    <path d="M295 131C295 123 302 119 310 120C316 121 319 126 318 132C314 128 302 128 295 131Z" fill="#0f172a" />

                    {{-- Kunci Akses Besar Warna Amber / Emas --}}
                    <g transform="rotate(-24 275 182)">
                        <rect x="218" y="177" width="106" height="10" rx="5" fill="#f59e0b" />
                        <rect x="224" y="185" width="7" height="11" rx="2" fill="#d97706" />
                        <rect x="236" y="185" width="7" height="9" rx="2" fill="#d97706" />
                        <circle cx="332" cy="182" r="17" stroke="#f59e0b" stroke-width="8" fill="#ffffff" />
                    </g>

                    {{-- Lengan Memegang Kunci --}}
                    <path d="M292 164L268 176L274 185L296 175" fill="#fed7aa" />

                    {{-- Garis Lantai --}}
                    <line x1="68" y1="270" x2="348" y2="270" stroke="#064e3b" stroke-width="3" stroke-linecap="round" />
                </svg>
            </div>

            {{-- Caption Bawah Panel Kiri --}}
            <div class="relative z-10 text-center lg:text-left">
                <p class="text-xs font-extrabold uppercase tracking-wider text-emerald-800">
                    Kader • Bidan • Orang Tua
                </p>
                <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                    Satu pintu akses layanan Posyandu untuk pemantauan tumbuh kembang anak dan kesehatan ibu hamil.
                </p>
            </div>
        </div>

        {{-- KOLOM KANAN: FORM LOGIN BERSIH (6 KOLOM) --}}
        <div class="lg:col-span-6 bg-white p-8 sm:p-12 lg:p-14 flex flex-col justify-center">
            <div class="w-full max-w-md mx-auto">
                {{-- Heading Sambutan --}}
                <div class="text-center mb-8">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
                        Selamat Datang!
                    </h1>
                    <p class="text-sm font-semibold text-emerald-700 mt-1.5">
                        Masuk ke Akun SIPANDAI Anda
                    </p>
                </div>

                {{-- Session Status --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />

                {{-- Alert Error Validasi --}}
                @if ($errors->any())
                    <div class="mb-5 rounded-2xl bg-rose-50 border border-rose-200 px-4 py-3 text-xs text-rose-800">
                        <p class="font-bold text-rose-900 mb-0.5">Gagal Masuk:</p>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    {{-- Input Email (Pill-Shaped dengan Ikon) --}}
                    <div>
                        <label for="email" class="sr-only">{{ __('Email') }}</label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25" />
                                </svg>
                            </div>
                            <input id="email"
                                   type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autofocus
                                   autocomplete="username"
                                   placeholder="Alamat Email Anda"
                                   class="w-full pl-12 pr-5 py-3.5 rounded-full bg-slate-50/80 border border-slate-200 text-slate-900 placeholder-slate-400 text-sm font-medium focus:bg-white focus:border-emerald-600 focus:ring-2 focus:ring-emerald-500/20 transition-all">
                        </div>
                    </div>

                    {{-- Input Password (Pill-Shaped dengan Ikon & Toggle Lihat Sandi) --}}
                    <div x-data="{ showPassword: false }">
                        <label for="password" class="sr-only">{{ __('Password') }}</label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </div>
                            <input id="password"
                                   :type="showPassword ? 'text' : 'password'"
                                   name="password"
                                   required
                                   autocomplete="current-password"
                                   placeholder="Kata Sandi"
                                   class="w-full pl-12 pr-12 py-3.5 rounded-full bg-slate-50/80 border border-slate-200 text-slate-900 placeholder-slate-400 text-sm font-medium focus:bg-white focus:border-emerald-600 focus:ring-2 focus:ring-emerald-500/20 transition-all">
                            <button type="button"
                                    @click="showPassword = !showPassword"
                                    aria-label="Tampilkan atau Sembunyikan Kata Sandi"
                                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-emerald-700 transition-colors">
                                <svg x-show="!showPassword" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg x-show="showPassword" style="display: none;" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Remember Me & Lupa Password --}}
                    <div class="flex items-center justify-between px-2 pt-1 text-xs">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me"
                                   type="checkbox"
                                   name="remember"
                                   class="rounded border-slate-300 text-emerald-700 shadow-2xs focus:ring-emerald-500">
                            <span class="ms-2 font-medium text-slate-600">{{ __('Ingat saya') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="font-bold text-emerald-700 hover:text-emerald-900 transition-colors">
                                Lupa Kata Sandi?
                            </a>
                        @endif
                    </div>

                    {{-- DUA TOMBOL PILL BERDAMPINGAN (MASUK & DAFTAR) --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-4">
                        <button type="submit"
                                class="w-full py-3.5 px-6 rounded-full bg-gradient-to-r from-slate-900 via-emerald-950 to-emerald-800 hover:from-emerald-900 hover:to-emerald-700 text-white font-extrabold text-xs uppercase tracking-wider shadow-md shadow-emerald-950/20 transition-all hover:-translate-y-0.5">
                            MASUK
                        </button>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="w-full py-3.5 px-6 rounded-full bg-white hover:bg-emerald-50 text-emerald-800 border-2 border-emerald-700 font-extrabold text-xs uppercase tracking-wider text-center transition-all hover:-translate-y-0.5">
                                DAFTAR AKUN
                            </a>
                        @endif
                    </div>
                </form>

                {{-- Footer Kecil Form --}}
                <div class="mt-8 pt-5 border-t border-slate-100 text-center">
                    <p class="text-xs text-slate-400">
                        Sistem Informasi Posyandu Andalan Ibu &bull; {{ date('Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>