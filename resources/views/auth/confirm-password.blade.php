<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Konfirmasi Kata Sandi - SIPANDAI</title>

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

    {{-- DEKORASI BLOB LATAR BELAKANG --}}
    <div class="pointer-events-none fixed -left-24 -top-24 w-96 h-96 sm:w-[32rem] sm:h-[32rem] rounded-full bg-gradient-to-br from-emerald-800 via-emerald-600 to-teal-500 opacity-90 blur-2xl"></div>
    <div class="pointer-events-none fixed -right-24 -bottom-24 w-80 h-80 sm:w-[28rem] sm:h-[28rem] rounded-full bg-gradient-to-tl from-slate-900 via-emerald-900 to-teal-700 opacity-90 blur-2xl"></div>

    {{-- TOMBOL KEMBALI KE DASHBOARD --}}
    <a href="{{ url('/dashboard') }}"
       class="fixed top-5 left-5 z-20 inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/90 hover:bg-white text-slate-800 font-bold text-xs shadow-md backdrop-blur-xs border border-slate-200/80 transition-all hover:-translate-x-0.5">
        <svg class="w-3.5 h-3.5 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        Kembali ke Dashboard
    </a>

    {{-- KARTU UTAMA SPLIT-SCREEN --}}
    <div class="relative z-10 w-full max-w-5xl bg-white rounded-[2rem] shadow-2xl shadow-slate-900/15 border border-slate-200/80 overflow-hidden grid grid-cols-1 lg:grid-cols-12">

        {{-- KOLOM KIRI: PANEL ILUSTRASI KEAMANAN AREA TERLINDUNGI (6 KOLOM) --}}
        <div class="lg:col-span-6 relative bg-gradient-to-br from-emerald-50/90 via-teal-50/60 to-slate-50 p-8 sm:p-10 lg:p-12 flex flex-col justify-between overflow-hidden">
            {{-- Kurva Pembatas Organik Sisi Kanan (Desktop) --}}
            <div class="hidden lg:block pointer-events-none absolute -right-12 top-0 bottom-0 w-24 bg-white rounded-l-[100%]"></div>

            {{-- Brand Header Kiri --}}
            <div class="relative z-10 flex items-center justify-between gap-2">
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
                    Area Aman
                </span>
            </div>

            {{-- ILUSTRASI SVG KUSTOM (PERLINDUNGAN DATA MEDIS & KONFIRMASI IDENTITAS) --}}
            <div class="relative z-10 my-6 flex items-center justify-center">
                <svg viewBox="0 0 400 310" class="w-full max-w-sm h-auto drop-shadow-xs" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Ilustrasi Konfirmasi Keamanan Akun SIPANDAI">
                    {{-- Latar Belakang Organik Lembut --}}
                    <path d="M68 182C42 132 76 64 138 48C200 32 272 52 316 102C360 152 350 232 292 260C234 288 94 232 68 182Z" fill="#d1fae5" fill-opacity="0.65" />
                    <circle cx="312" cy="76" r="22" fill="#fef3c7" />

                    {{-- Awan Dekoratif --}}
                    <rect x="64" y="92" width="74" height="22" rx="11" fill="#ffffff" fill-opacity="0.9" />
                    <circle cx="88" cy="90" r="14" fill="#ffffff" fill-opacity="0.9" />
                    <rect x="252" y="106" width="84" height="20" rx="10" fill="#a7f3d0" fill-opacity="0.7" />
                    <circle cx="282" cy="104" r="13" fill="#a7f3d0" fill-opacity="0.7" />

                    {{-- Lencana Kunci Terkunci (Kiri) --}}
                    <path d="M84 130L104 138V154C104 167 95 177 84 181C73 177 64 167 64 154V138L84 130Z" fill="#064e3b" />
                    <circle cx="84" cy="153" r="4" fill="#f59e0b" />
                    <path d="M84 157V164" stroke="#f59e0b" stroke-width="2.4" stroke-linecap="round" />
                    <path d="M84 185V204H116" stroke="#6ee7b7" stroke-width="1.8" stroke-dasharray="4 4" />

                    {{-- Bingkai Smartphone / Kartu Verifikasi Sesi --}}
                    <rect x="122" y="52" width="136" height="218" rx="22" fill="#064e3b" />
                    <rect x="129" y="60" width="122" height="202" rx="16" fill="#ffffff" />
                    <rect x="172" y="66" width="36" height="4" rx="2" fill="#cbd5e1" />

                    {{-- Ikon Gembok Utama di Layar --}}
                    <circle cx="190" cy="108" r="25" fill="#ecfdf5" stroke="#a7f3d0" stroke-width="2" />
                    <path d="M182 105V99C182 94.5817 185.582 91 190 91C194.418 91 198 94.5817 198 99V105" stroke="#047857" stroke-width="2.6" stroke-linecap="round" />
                    <rect x="178" y="105" width="24" height="18" rx="5" fill="#064e3b" />
                    <circle cx="190" cy="113" r="2.5" fill="#34d399" />

                    {{-- Info Sesi Pengguna --}}
                    <rect x="150" y="146" width="80" height="7" rx="3.5" fill="#064e3b" />
                    <rect x="160" y="158" width="60" height="5" rx="2.5" fill="#94a3b8" />

                    {{-- Simulasi Input Sandi Verifikasi --}}
                    <rect x="146" y="174" width="88" height="16" rx="8" fill="#f1f5f9" stroke="#10b981" stroke-width="1.5" />
                    <circle cx="160" cy="182" r="2.5" fill="#064e3b" />
                    <circle cx="168" cy="182" r="2.5" fill="#064e3b" />
                    <circle cx="176" cy="182" r="2.5" fill="#064e3b" />
                    <circle cx="184" cy="182" r="2.5" fill="#064e3b" />
                    <circle cx="192" cy="182" r="2.5" fill="#064e3b" />
                    <circle cx="200" cy="182" r="2.5" fill="#064e3b" />

                    {{-- Tombol Konfirmasi di Layar --}}
                    <rect x="152" y="202" width="76" height="22" rx="11" fill="#047857" />
                    <rect x="170" y="210.5" width="40" height="5" rx="2.5" fill="#ffffff" />

                    {{-- Tanaman Hias Pot (Kiri Bawah) --}}
                    <path d="M98 244H126L121 270H103L98 244Z" fill="#0f172a" />
                    <path d="M112 244C112 244 92 232 94 214C96 198 112 216 112 244Z" fill="#059669" />
                    <path d="M112 244C112 244 132 230 130 212C128 196 112 216 112 244Z" fill="#10b981" />
                    <path d="M112 244C112 244 104 218 112 202C120 218 112 244 112 244Z" fill="#34d399" />

                    {{-- Karakter Memegang Kunci Verifikasi (Amber) --}}
                    <path d="M294 216L282 264H292L304 222" fill="#0f172a" />
                    <path d="M308 216L324 264H334L316 220" fill="#1e293b" />
                    <rect x="276" y="263" width="16" height="6" rx="3" fill="#f59e0b" />
                    <rect x="322" y="263" width="16" height="6" rx="3" fill="#f59e0b" />

                    <path d="M288 164C288 156 294 150 302 150H310C318 150 324 156 324 164V218H288V164Z" fill="#047857" />
                    <circle cx="306" cy="134" r="12" fill="#fed7aa" />
                    <path d="M295 131C295 123 302 119 310 120C316 121 319 126 318 132C314 128 302 128 295 131Z" fill="#0f172a" />

                    <g transform="rotate(-24 275 182)">
                        <rect x="218" y="177" width="106" height="10" rx="5" fill="#f59e0b" />
                        <rect x="224" y="185" width="7" height="11" rx="2" fill="#d97706" />
                        <rect x="236" y="185" width="7" height="9" rx="2" fill="#d97706" />
                        <circle cx="332" cy="182" r="17" stroke="#f59e0b" stroke-width="8" fill="#ffffff" />
                    </g>

                    <path d="M292 164L268 176L274 185L296 175" fill="#fed7aa" />

                    {{-- Garis Lantai --}}
                    <line x1="68" y1="270" x2="348" y2="270" stroke="#064e3b" stroke-width="3" stroke-linecap="round" />
                </svg>
            </div>

            {{-- Informasi Keamanan --}}
            <div class="relative z-10 bg-white/80 backdrop-blur-xs border border-emerald-200/70 rounded-2xl p-4">
                <p class="text-[11px] font-extrabold uppercase tracking-wider text-emerald-800 mb-1">
                    Perlindungan Data Kesehatan
                </p>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Verifikasi ulang kata sandi diperlukan sebelum Anda mengakses atau mengubah pengaturan sensitif pada akun SIPANDAI.
                </p>
            </div>
        </div>

        {{-- KOLOM KANAN: FORM KONFIRMASI KATA SANDI (6 KOLOM) --}}
        <div class="lg:col-span-6 bg-white p-8 sm:p-12 lg:p-14 flex flex-col justify-center">
            <div class="w-full max-w-md mx-auto">
                {{-- Heading --}}
                <div class="text-center mb-6">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
                        Konfirmasi Sandi
                    </h1>
                    <p class="text-sm font-semibold text-emerald-700 mt-1.5">
                        Verifikasi identitas Anda untuk melanjutkan
                    </p>
                </div>

                {{-- Penjelasan Area Aman --}}
                <div class="mb-6 rounded-2xl bg-amber-50/80 border border-amber-200/80 px-4 py-3.5 text-xs sm:text-sm text-amber-950 leading-relaxed flex items-start gap-2.5">
                    <svg class="w-4 h-4 text-amber-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                    <span>
                        Ini adalah area aman aplikasi SIPANDAI. Silakan konfirmasi kata sandi Anda terlebih dahulu sebelum melanjutkan.
                    </span>
                </div>

                {{-- Alert Error Validasi --}}
                @if ($errors->any())
                    <div class="mb-5 rounded-2xl bg-rose-50 border border-rose-200 px-4 py-3 text-xs text-rose-800">
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4" x-data="{ showPass: false }">
                    @csrf

                    {{-- Input Password --}}
                    <div>
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5 pl-3">
                            Kata Sandi Saat Ini
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </div>
                            <input id="password"
                                   :type="showPass ? 'text' : 'password'"
                                   name="password"
                                   required
                                   autofocus
                                   autocomplete="current-password"
                                   placeholder="Masukkan kata sandi Anda"
                                   class="w-full pl-12 pr-12 py-3.5 rounded-full bg-slate-50/80 border border-slate-200 text-slate-900 placeholder-slate-400 text-sm font-medium focus:bg-white focus:border-emerald-600 focus:ring-2 focus:ring-emerald-500/20 transition-all">
                            <button type="button"
                                    @click="showPass = !showPass"
                                    aria-label="Tampilkan atau Sembunyikan Kata Sandi"
                                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-emerald-700 transition-colors">
                                <svg x-show="!showPass" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg x-show="showPass" style="display: none;" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1.5 pl-3 text-xs" />
                    </div>

                    {{-- DUA TOMBOL PILL BERDAMPINGAN (KONFIRMASI & BATALKAN) --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-4">
                        <button type="submit"
                                class="w-full py-3.5 px-6 rounded-full bg-gradient-to-r from-slate-900 via-emerald-950 to-emerald-800 hover:from-emerald-900 hover:to-emerald-700 text-white font-extrabold text-xs uppercase tracking-wider shadow-md shadow-emerald-950/20 transition-all hover:-translate-y-0.5">
                            KONFIRMASI
                        </button>

                        <a href="{{ url('/dashboard') }}"
                           class="w-full py-3.5 px-6 rounded-full bg-white hover:bg-emerald-50 text-emerald-800 border-2 border-emerald-700 font-extrabold text-xs uppercase tracking-wider text-center transition-all hover:-translate-y-0.5">
                            BATALKAN
                        </a>
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