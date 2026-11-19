<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Akun Orang Tua - SIPANDAI</title>

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

    {{-- TOMBOL KEMBALI KE BERANDA --}}
    <a href="{{ url('/') }}"
       class="fixed top-5 left-5 z-20 inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/90 hover:bg-white text-slate-800 font-bold text-xs shadow-md backdrop-blur-xs border border-slate-200/80 transition-all hover:-translate-x-0.5">
        <svg class="w-3.5 h-3.5 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        Beranda SIPANDAI
    </a>

    {{-- KARTU UTAMA SPLIT-SCREEN --}}
    <div class="relative z-10 w-full max-w-6xl bg-white rounded-[2rem] shadow-2xl shadow-slate-900/15 border border-slate-200/80 overflow-hidden grid grid-cols-1 lg:grid-cols-12 my-10 lg:my-0">

        {{-- KOLOM KIRI: PANEL ILUSTRASI & ALUR PENDAFTARAN (5 KOLOM) --}}
        <div class="lg:col-span-5 relative bg-gradient-to-br from-emerald-50/90 via-teal-50/60 to-slate-50 p-8 sm:p-10 flex flex-col justify-between overflow-hidden">
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
                    Registrasi Baru
                </span>
            </div>

            {{-- ILUSTRASI SVG KUSTOM (REGISTRASI KELUARGA & VERIFIKASI KADER) --}}
            <div class="relative z-10 my-6 flex items-center justify-center">
                <svg viewBox="0 0 380 300" class="w-full max-w-xs sm:max-w-sm h-auto drop-shadow-xs" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Ilustrasi Pendaftaran Akun Orang Tua SIPANDAI">
                    {{-- Latar Belakang Organik --}}
                    <path d="M58 175C34 125 68 58 128 44C188 30 258 48 300 96C342 144 332 222 276 250C220 278 82 225 58 175Z" fill="#d1fae5" fill-opacity="0.65" />
                    <circle cx="298" cy="70" r="20" fill="#fef3c7" />

                    {{-- Awan Lembut --}}
                    <rect x="52" y="86" width="68" height="20" rx="10" fill="#ffffff" fill-opacity="0.9" />
                    <circle cx="74" cy="84" r="13" fill="#ffffff" fill-opacity="0.9" />
                    <rect x="244" y="102" width="76" height="18" rx="9" fill="#a7f3d0" fill-opacity="0.7" />
                    <circle cx="270" cy="100" r="12" fill="#a7f3d0" fill-opacity="0.7" />

                    {{-- Kartu Registrasi Digital (Smartphone / Tablet) --}}
                    <rect x="112" y="46" width="144" height="218" rx="22" fill="#064e3b" />
                    <rect x="119" y="54" width="130" height="202" rx="16" fill="#ffffff" />
                    <rect x="166" y="60" width="36" height="4" rx="2" fill="#cbd5e1" />

                    {{-- Avatar Keluarga (Ayah/Ibu & Anak) --}}
                    <circle cx="184" cy="96" r="22" fill="#d1fae5" />
                    <circle cx="179" cy="92" r="6.5" fill="#064e3b" />
                    <circle cx="192" cy="95" r="4.5" fill="#047857" />
                    <path d="M168 111C170 104 175 101 180 101C185 101 188 104 189 111" fill="#10b981" />
                    <path d="M186 111C187 106 190 104 193 104C196 104 199 106 200 111" fill="#34d399" />

                    {{-- Bar Formulir Pendaftaran --}}
                    <rect x="138" y="128" width="92" height="11" rx="5.5" fill="#e2e8f0" />
                    <circle cx="146" cy="133.5" r="2.5" fill="#10b981" />

                    <rect x="138" y="146" width="92" height="11" rx="5.5" fill="#e2e8f0" />
                    <circle cx="146" cy="151.5" r="2.5" fill="#10b981" />

                    <rect x="138" y="164" width="92" height="11" rx="5.5" fill="#cbd5e1" />
                    <circle cx="146" cy="169.5" r="2.5" fill="#064e3b" />

                    {{-- Tombol Daftar di Layar --}}
                    <rect x="148" y="188" width="72" height="22" rx="11" fill="#047857" />
                    <rect x="166" y="196.5" width="36" height="5" rx="2.5" fill="#ffffff" />

                    {{-- Lencana Verifikasi Kader (Kiri Tengah) --}}
                    <rect x="52" y="132" width="74" height="54" rx="14" fill="#ffffff" stroke="#a7f3d0" stroke-width="2" />
                    <circle cx="89" cy="151" r="11" fill="#fef3c7" />
                    <path d="M84.5 151.2L87.5 154.2L94 147.8" stroke="#d97706" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round" />
                    <rect x="68" y="168" width="42" height="5" rx="2.5" fill="#064e3b" />
                    <rect x="74" y="176" width="30" height="4" rx="2" fill="#6ee7b7" />

                    {{-- Tanaman Hias Pot (Kiri Bawah) --}}
                    <path d="M88 238H116L111 264H93L88 238Z" fill="#0f172a" />
                    <path d="M102 238C102 238 82 226 84 208C86 192 102 210 102 238Z" fill="#059669" />
                    <path d="M102 238C102 238 122 224 120 206C118 190 102 210 102 238Z" fill="#10b981" />

                    {{-- Karakter Ibu/Orang Tua dengan Kartu KMS (Kanan Bawah) --}}
                    <path d="M282 210L272 258H282L292 216" fill="#0f172a" />
                    <path d="M296 210L310 258H320L304 214" fill="#1e293b" />
                    <rect x="266" y="257" width="15" height="6" rx="3" fill="#f59e0b" />
                    <rect x="308" y="257" width="15" height="6" rx="3" fill="#f59e0b" />

                    <path d="M276 160C276 152 282 146 290 146H298C306 146 312 152 312 160V212H276V160Z" fill="#047857" />
                    <circle cx="294" cy="130" r="12" fill="#fed7aa" />
                    <path d="M283 128C283 120 290 115 298 116C304 117 307 122 306 129C302 125 290 125 283 128Z" fill="#0f172a" />

                    {{-- Kartu KMS Hijau di Tangan --}}
                    <rect x="236" y="156" width="44" height="32" rx="7" transform="rotate(-12 236 156)" fill="#10b981" stroke="#ffffff" stroke-width="2" />
                    <path d="M244 173L254 167L262 169L272 161" stroke="#ffffff" stroke-width="2" stroke-linecap="round" />

                    {{-- Garis Lantai --}}
                    <line x1="60" y1="264" x2="336" y2="264" stroke="#064e3b" stroke-width="3" stroke-linecap="round" />
                </svg>
            </div>

            {{-- Langkah Singkat Verifikasi Akun --}}
            <div class="relative z-10 bg-white/80 backdrop-blur-xs border border-emerald-200/70 rounded-2xl p-4 space-y-2">
                <p class="text-[11px] font-extrabold uppercase tracking-wider text-emerald-800">
                    Alur Aktivasi Akun Orang Tua
                </p>
                <div class="flex items-start gap-2.5 text-xs text-slate-600">
                    <span class="w-5 h-5 rounded-full bg-emerald-700 text-white font-bold text-[11px] flex items-center justify-center shrink-0 mt-0.5">1</span>
                    <span>Lengkapi data diri, kontak WhatsApp, serta pilih Desa &amp; Posyandu tempat anak terdaftar.</span>
                </div>
                <div class="flex items-start gap-2.5 text-xs text-slate-600">
                    <span class="w-5 h-5 rounded-full bg-amber-500 text-slate-950 font-bold text-[11px] flex items-center justify-center shrink-0 mt-0.5">2</span>
                    <span>Kader Posyandu desa Anda akan memverifikasi dan menautkan data Buku KIA anak.</span>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: FORM REGISTRASI BERSIH (7 KOLOM) --}}
        <div class="lg:col-span-7 bg-white p-7 sm:p-10 lg:p-12 flex flex-col justify-center">
            <div class="w-full max-w-lg mx-auto">
                {{-- Heading Sambutan --}}
                <div class="text-center mb-7">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
                        Daftar Akun Orang Tua
                    </h1>
                    <p class="text-xs sm:text-sm font-semibold text-emerald-700 mt-1.5">
                        Akun akan diverifikasi oleh Kader desa Anda sebelum terhubung ke Buku KIA.
                    </p>
                </div>

                {{-- Alert Error Validasi Global --}}
                @if ($errors->any())
                    <div class="mb-5 rounded-2xl bg-rose-50 border border-rose-200 px-4 py-3 text-xs text-rose-800">
                        <p class="font-bold text-rose-900 mb-0.5">Periksa Kembali Data Pendaftaran:</p>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    {{-- Nama Lengkap --}}
                    <div>
                        <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5 pl-3">
                            Nama Lengkap (Ayah/Ibu) <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                            <input id="name"
                                   type="text"
                                   name="name"
                                   value="{{ old('name') }}"
                                   required
                                   autofocus
                                   autocomplete="name"
                                   placeholder="Contoh: Siti Aminah"
                                   class="w-full pl-11 pr-5 py-3 rounded-full bg-slate-50/80 border border-slate-200 text-slate-900 placeholder-slate-400 text-sm font-medium focus:bg-white focus:border-emerald-600 focus:ring-2 focus:ring-emerald-500/20 transition-all">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-1.5 pl-3 text-xs" />
                    </div>

                    {{-- Grid 2 Kolom: Email & Nomor WhatsApp --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5 pl-3">
                                Alamat Email <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25" />
                                    </svg>
                                </div>
                                <input id="email"
                                       type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required
                                       autocomplete="username"
                                       placeholder="nama@email.com"
                                       class="w-full pl-11 pr-4 py-3 rounded-full bg-slate-50/80 border border-slate-200 text-slate-900 placeholder-slate-400 text-sm font-medium focus:bg-white focus:border-emerald-600 focus:ring-2 focus:ring-emerald-500/20 transition-all">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-1.5 pl-3 text-xs" />
                        </div>

                        {{-- Nomor WhatsApp --}}
                        <div>
                            <label for="no_hp" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5 pl-3">
                                Nomor WhatsApp <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                    </svg>
                                </div>
                                <input id="no_hp"
                                       type="text"
                                       name="no_hp"
                                       value="{{ old('no_hp') }}"
                                       required
                                       placeholder="0812xxxxxxxx"
                                       class="w-full pl-11 pr-4 py-3 rounded-full bg-slate-50/80 border border-slate-200 text-slate-900 placeholder-slate-400 text-sm font-medium tabular-nums focus:bg-white focus:border-emerald-600 focus:ring-2 focus:ring-emerald-500/20 transition-all">
                            </div>
                            <x-input-error :messages="$errors->get('no_hp')" class="mt-1.5 pl-3 text-xs" />
                        </div>
                    </div>

                    {{-- Grid 2 Kolom: Pilih Desa & Pilih Posyandu --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Desa --}}
                        <div>
                            <label for="desa_id" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5 pl-3">
                                Pilih Desa Anda <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                </div>
                                <select id="desa_id"
                                        name="desa_id"
                                        required
                                        class="w-full pl-11 pr-9 py-3 rounded-full bg-slate-50/80 border border-slate-200 text-slate-900 text-sm font-medium focus:bg-white focus:border-emerald-600 focus:ring-2 focus:ring-emerald-500/20 transition-all">
                                    <option value="">-- Pilih Desa --</option>
                                    @foreach($desas as $desa)
                                        <option value="{{ $desa->id }}" {{ old('desa_id') == $desa->id ? 'selected' : '' }}>
                                            {{ $desa->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('desa_id')" class="mt-1.5 pl-3 text-xs" />
                        </div>

                        {{-- Posyandu --}}
                        <div>
                            <label for="posyandu_id" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5 pl-3">
                                Pilih Posyandu <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                                    </svg>
                                </div>
                                <select id="posyandu_id"
                                        name="posyandu_id"
                                        required
                                        class="w-full pl-11 pr-9 py-3 rounded-full bg-slate-50/80 border border-slate-200 text-slate-900 text-sm font-medium focus:bg-white focus:border-emerald-600 focus:ring-2 focus:ring-emerald-500/20 transition-all">
                                    <option value="">-- Pilih Posyandu --</option>
                                    @foreach($posyandus as $posyandu)
                                        <option value="{{ $posyandu->id }}"
                                                data-desa-id="{{ $posyandu->desa_id }}"
                                                {{ old('posyandu_id') == $posyandu->id ? 'selected' : '' }}>
                                            {{ $posyandu->nama }} ({{ $posyandu->desa->nama }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('posyandu_id')" class="mt-1.5 pl-3 text-xs" />
                        </div>
                    </div>

                    {{-- Grid 2 Kolom: Password & Konfirmasi Password --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" x-data="{ showPass: false }">
                        {{-- Password --}}
                        <div>
                            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5 pl-3">
                                Kata Sandi <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                    </svg>
                                </div>
                                <input id="password"
                                       :type="showPass ? 'text' : 'password'"
                                       name="password"
                                       required
                                       autocomplete="new-password"
                                       placeholder="Min. 8 karakter"
                                       class="w-full pl-11 pr-10 py-3 rounded-full bg-slate-50/80 border border-slate-200 text-slate-900 placeholder-slate-400 text-sm font-medium focus:bg-white focus:border-emerald-600 focus:ring-2 focus:ring-emerald-500/20 transition-all">
                                <button type="button"
                                        @click="showPass = !showPass"
                                        aria-label="Lihat Kata Sandi"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-emerald-700">
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

                        {{-- Konfirmasi Password --}}
                        <div>
                            <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5 pl-3">
                                Ulangi Sandi <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                                    </svg>
                                </div>
                                <input id="password_confirmation"
                                       :type="showPass ? 'text' : 'password'"
                                       name="password_confirmation"
                                       required
                                       autocomplete="new-password"
                                       placeholder="Ulangi kata sandi"
                                       class="w-full pl-11 pr-4 py-3 rounded-full bg-slate-50/80 border border-slate-200 text-slate-900 placeholder-slate-400 text-sm font-medium focus:bg-white focus:border-emerald-600 focus:ring-2 focus:ring-emerald-500/20 transition-all">
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5 pl-3 text-xs" />
                        </div>
                    </div>

                    {{-- DUA TOMBOL PILL BERDAMPINGAN (DAFTAR & SUDAH PUNYA AKUN) --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-4">
                        <button type="submit"
                                class="w-full py-3.5 px-6 rounded-full bg-gradient-to-r from-slate-900 via-emerald-950 to-emerald-800 hover:from-emerald-900 hover:to-emerald-700 text-white font-extrabold text-xs uppercase tracking-wider shadow-md shadow-emerald-950/20 transition-all hover:-translate-y-0.5">
                            DAFTAR SEKARANG
                        </button>

                        <a href="{{ route('login') }}"
                           class="w-full py-3.5 px-6 rounded-full bg-white hover:bg-emerald-50 text-emerald-800 border-2 border-emerald-700 font-extrabold text-xs uppercase tracking-wider text-center transition-all hover:-translate-y-0.5">
                            SUDAH PUNYA AKUN
                        </a>
                    </div>
                </form>

                {{-- Footer Kecil Form --}}
                <div class="mt-7 pt-4 border-t border-slate-100 text-center">
                    <p class="text-xs text-slate-400">
                        Sistem Informasi Posyandu Andalan Ibu &bull; {{ date('Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT FILTER POSYANDU OTOMATIS BERDASARKAN DESA YANG DIPILIH --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const desaSelect = document.getElementById('desa_id');
            const posyanduSelect = document.getElementById('posyandu_id');

            if (desaSelect && posyanduSelect) {
                const allOptions = Array.from(posyanduSelect.querySelectorAll('option[data-desa-id]'));

                function filterPosyandu() {
                    const selectedDesa = desaSelect.value;
                    allOptions.forEach(opt => {
                        const match = !selectedDesa || opt.dataset.desaId === selectedDesa;
                        opt.hidden = !match;
                        opt.disabled = !match;
                    });

                    const currentOpt = posyanduSelect.selectedOptions[0];
                    if (currentOpt && currentOpt.dataset.desaId && selectedDesa && currentOpt.dataset.desaId !== selectedDesa) {
                        posyanduSelect.value = '';
                    }
                }

                desaSelect.addEventListener('change', filterPosyandu);
                filterPosyandu();
            }
        });
    </script>

</body>
</html>