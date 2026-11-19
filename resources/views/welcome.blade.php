<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPANDAI - Sistem Informasi Posyandu Andalan Ibu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f4f8f6;
            color: #0f172a;
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 26px 26px;
        }

        /* Animasi Melayang Halus */
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        @keyframes floatDelayed {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }
        @keyframes marqueeScroll {
            0% { transform: translateX(0%); }
            100% { transform: translateX(-50%); }
        }
        @keyframes pulseGlow {
            0%, 100% { opacity: 0.45; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.06); }
        }

        .animate-float {
            animation: floatSlow 5s ease-in-out infinite;
        }
        .animate-float-delayed {
            animation: floatDelayed 6s ease-in-out 1.5s infinite;
        }
        .animate-glow {
            animation: pulseGlow 7s ease-in-out infinite;
        }
        .animate-marquee {
            display: flex;
            width: max-content;
            animation: marqueeScroll 32s linear infinite;
        }
        .animate-marquee:hover {
            animation-play-state: paused;
        }

        /* Scroll Reveal Utility */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="antialiased selection:bg-emerald-900 selection:text-emerald-100 overflow-x-hidden">

    {{-- 1. STICKY CIVIC-TECH NAVBAR --}}
    <header x-data="{ mobileMenuOpen: false }" class="sticky top-0 z-50 bg-slate-900/95 backdrop-blur-md text-white border-b border-emerald-800/40 shadow-lg">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 h-20 flex items-center justify-between gap-6">
            {{-- Brand Logo --}}
            <a href="#beranda" class="flex items-center gap-3 shrink-0 group focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-400 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-400 to-teal-600 flex items-center justify-center shadow-md shadow-emerald-500/25 group-hover:scale-105 group-hover:rotate-3 transition-all">
                    <svg class="w-5 h-5 text-slate-950 stroke-[2.4]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                </div>
                <div>
                    <span class="block text-xl font-extrabold tracking-tight text-white leading-none">SIPANDAI</span>
                    <span class="block text-[10px] font-semibold tracking-wider uppercase text-emerald-300 mt-0.5">E-Posyandu &amp; KIA</span>
                </div>
            </a>

            {{-- Navigasi Desktop --}}
            <nav aria-label="Navigasi Utama" class="hidden lg:flex items-center gap-7 text-sm font-semibold text-slate-300">
                <a href="#beranda" class="py-2 hover:text-emerald-300 transition-colors">Beranda</a>
                <a href="#alur-posyandu" class="py-2 hover:text-emerald-300 transition-colors">Alur 5 Meja</a>
                <a href="#layanan" class="py-2 hover:text-emerald-300 transition-colors">Layanan</a>
                <a href="#edukasi-kia" class="py-2 hover:text-emerald-300 transition-colors">Panduan KIA</a>
                <a href="#peran" class="py-2 hover:text-emerald-300 transition-colors">Ekosistem Peran</a>
                <a href="#faq" class="py-2 hover:text-emerald-300 transition-colors">FAQ</a>
            </nav>

            {{-- Aksi Auth Desktop & Mobile Toggle --}}
            <div class="flex items-center gap-3 shrink-0">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-slate-950 px-5 py-2.5 rounded-xl text-sm font-extrabold shadow-md shadow-emerald-500/20 transition-all hover:-translate-y-0.5">
                            <span>Ke Dashboard</span>
                            <svg class="w-4 h-4 stroke-[2.4]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="hidden sm:inline-flex text-slate-200 hover:text-white px-4 py-2.5 rounded-xl text-sm font-bold transition-colors">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="inline-flex items-center gap-1.5 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-slate-950 px-5 py-2.5 rounded-xl text-sm font-extrabold shadow-md shadow-emerald-500/20 transition-all hover:-translate-y-0.5">
                                Daftar Akun
                            </a>
                        @endif
                    @endauth
                @endif

                {{-- Hamburger Button Mobile --}}
                <button type="button"
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        aria-label="Buka Menu Navigasi"
                        class="lg:hidden inline-flex items-center justify-center p-2.5 rounded-xl bg-white/10 hover:bg-white/15 text-slate-200 transition-colors">
                    <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg x-show="mobileMenuOpen" style="display: none;" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Dropdown Menu Mobile --}}
        <div x-show="mobileMenuOpen"
             x-transition
             style="display: none;"
             class="lg:hidden bg-slate-900 border-t border-slate-800 px-5 py-4 space-y-2">
            <a @click="mobileMenuOpen = false" href="#beranda" class="block px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-200 hover:bg-white/10">Beranda</a>
            <a @click="mobileMenuOpen = false" href="#alur-posyandu" class="block px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-200 hover:bg-white/10">Alur 5 Meja Posyandu</a>
            <a @click="mobileMenuOpen = false" href="#layanan" class="block px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-200 hover:bg-white/10">Layanan Terpadu</a>
            <a @click="mobileMenuOpen = false" href="#edukasi-kia" class="block px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-200 hover:bg-white/10">Panduan KIA &amp; Gizi</a>
            <a @click="mobileMenuOpen = false" href="#peran" class="block px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-200 hover:bg-white/10">Ekosistem Peran</a>
            <a @click="mobileMenuOpen = false" href="#faq" class="block px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-200 hover:bg-white/10">Tanya Jawab (FAQ)</a>
            @guest
                @if (Route::has('login'))
                    <div class="pt-2 border-t border-slate-800">
                        <a href="{{ route('login') }}" class="block text-center w-full py-2.5 rounded-xl bg-white/10 text-white text-sm font-bold">
                            Masuk ke Akun
                        </a>
                    </div>
                @endif
            @endguest
        </div>
    </header>

    {{-- PITA INFORMASI POSYANDU BERJALAN (LIVE TICKER) --}}
    <div class="bg-emerald-950 text-emerald-100 border-b border-emerald-800/60 py-2.5 overflow-hidden text-xs font-semibold">
        <div class="animate-marquee flex items-center gap-10">
            <span class="inline-flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                <strong class="text-amber-300">INFO POSYANDU:</strong> Bawa selalu Buku KIA atau akses KMS Digital saat jadwal penimbangan bulanan balita.
            </span>
            <span class="text-emerald-600">&bull;</span>
            <span class="inline-flex items-center gap-2">
                <strong class="text-emerald-300">CEGAH STUNTING:</strong> Pantau kenaikan berat badan (BB/U) &amp; tinggi badan (TB/U) anak setiap bulan secara rutin.
            </span>
            <span class="text-emerald-600">&bull;</span>
            <span class="inline-flex items-center gap-2">
                <strong class="text-amber-300">IMUNISASI LENGKAP:</strong> Lindungi buah hati dengan imunisasi dasar lengkap (HB-0, BCG, Polio, DPT-HB-Hib, Campak/MR).
            </span>
            <span class="text-emerald-600">&bull;</span>
            <span class="inline-flex items-center gap-2">
                <strong class="text-emerald-300">IBU HAMIL SEHAT:</strong> Periksa kehamilan minimal 6 kali &amp; konsumsi Tablet Tambah Darah (TTD) sesuai anjuran Bidan.
            </span>
            {{-- Duplikasi untuk loop mulus --}}
            <span class="text-emerald-600">&bull;</span>
            <span class="inline-flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                <strong class="text-amber-300">INFO POSYANDU:</strong> Bawa selalu Buku KIA atau akses KMS Digital saat jadwal penimbangan bulanan balita.
            </span>
            <span class="text-emerald-600">&bull;</span>
            <span class="inline-flex items-center gap-2">
                <strong class="text-emerald-300">CEGAH STUNTING:</strong> Pantau kenaikan berat badan (BB/U) &amp; tinggi badan (TB/U) anak setiap bulan secara rutin.
            </span>
        </div>
    </div>

    {{-- 2. HERO SECTION DINAMIS DENGAN FLOATING WIDGETS --}}
    <section id="beranda" class="relative pt-8 pb-14 sm:pt-12 sm:pb-16 px-5 sm:px-8">
        {{-- Ambient Glow Background --}}
        <div class="pointer-events-none absolute top-10 left-1/4 w-96 h-96 bg-emerald-400/15 rounded-full blur-3xl animate-glow"></div>
        <div class="pointer-events-none absolute bottom-0 right-1/4 w-96 h-96 bg-amber-300/15 rounded-full blur-3xl animate-glow"></div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
            {{-- Panel Utama Kiri (7 Kolom) --}}
            <div class="lg:col-span-7 relative overflow-hidden bg-white/95 backdrop-blur-xs border border-slate-200/90 rounded-3xl p-7 sm:p-11 lg:p-12 shadow-xl shadow-slate-900/5 flex flex-col justify-between">
                <div class="pointer-events-none absolute -right-16 -top-16 h-64 w-64 rounded-full bg-emerald-400/15 blur-3xl"></div>
                <div class="pointer-events-none absolute right-24 -bottom-20 h-56 w-56 rounded-full bg-amber-400/15 blur-3xl"></div>

                <div class="relative">
                    <div class="inline-flex items-center gap-2 bg-amber-50 text-amber-800 border border-amber-200/80 px-3.5 py-1.5 rounded-full text-xs font-extrabold tracking-wide mb-6 shadow-2xs">
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                        Transformasi Digital Posyandu &amp; Kesehatan Keluarga
                    </div>

                    <h1 class="text-3xl sm:text-5xl lg:text-[3.2rem] font-extrabold tracking-tight leading-[1.12] text-slate-900 mb-5">
                        Sistem Informasi <br>
                        <span class="bg-gradient-to-r from-emerald-700 via-teal-600 to-emerald-500 bg-clip-text text-transparent">
                            Posyandu Andalan Ibu
                        </span>
                    </h1>

                    <p class="text-base sm:text-lg text-slate-600 leading-relaxed max-w-2xl mb-7">
                        Platform terintegrasi untuk pencatatan Kesehatan Ibu dan Anak (KIA), grafik KMS digital otomatis, deteksi dini risiko stunting, serta pemantauan klinis Bidan Desa secara real-time.
                    </p>

                    {{-- Highlight Fitur Cepat (Pills) --}}
                    <div class="flex flex-wrap gap-2.5 mb-8">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-50 text-emerald-800 border border-emerald-200/70 text-xs font-bold">
                            <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                            Grafik KMS Interaktif
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-teal-50 text-teal-800 border border-teal-200/70 text-xs font-bold">
                            <svg class="w-3.5 h-3.5 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                            Deteksi Stunting WHO Z-Score
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-amber-50 text-amber-800 border border-amber-200/70 text-xs font-bold">
                            <svg class="w-3.5 h-3.5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                            Cetak PDF Buku KIA
                        </span>
                    </div>
                </div>

                <div class="relative flex flex-wrap items-center gap-3.5 pt-2">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="inline-flex items-center gap-2 bg-gradient-to-r from-slate-900 via-emerald-950 to-emerald-800 hover:from-emerald-900 hover:to-emerald-700 text-white px-7 py-3.5 rounded-2xl text-sm sm:text-base font-bold shadow-lg shadow-emerald-950/20 transition-all hover:-translate-y-0.5">
                            <span>Buka Dashboard Anda</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center gap-2 bg-gradient-to-r from-slate-900 via-emerald-950 to-emerald-800 hover:from-emerald-900 hover:to-emerald-700 text-white px-7 py-3.5 rounded-2xl text-sm sm:text-base font-bold shadow-lg shadow-emerald-950/20 transition-all hover:-translate-y-0.5">
                            <span>Mulai Masuk Sistem</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    @endauth

                    <a href="#alur-posyandu"
                       class="inline-flex items-center gap-2 bg-slate-50 hover:bg-emerald-50/80 text-slate-800 hover:text-emerald-900 border border-slate-200 hover:border-emerald-300 px-6 py-3.5 rounded-2xl text-sm sm:text-base font-bold transition-all">
                        Lihat Alur Posyandu
                    </a>
                </div>
            </div>

            {{-- Panel Pendamping Kanan dengan Ilustrasi & Floating Cards (5 Kolom) --}}
            <div class="lg:col-span-5 relative overflow-hidden bg-gradient-to-br from-slate-900 via-emerald-950 to-emerald-900 text-white rounded-3xl p-7 sm:p-8 flex flex-col justify-between shadow-xl border border-emerald-800/50">
                <div class="pointer-events-none absolute -right-10 -top-10 h-44 w-44 rounded-full bg-emerald-400/20 blur-2xl"></div>
                <div class="pointer-events-none absolute -left-10 -bottom-10 h-40 w-40 rounded-full bg-amber-400/15 blur-2xl"></div>

                <div class="relative flex items-center justify-between gap-2 mb-3">
                    <span class="inline-flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-emerald-300 bg-white/10 border border-white/15 px-3 py-1 rounded-full">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Buku KIA Digital
                    </span>
                    <span class="text-xs font-bold text-amber-300">KMS &amp; Maternal</span>
                </div>

                {{-- ILUSTRASI SVG INTERAKTIF + FLOATING BADGES --}}
                <div class="relative my-2">
                    {{-- Floating Badge Kiri Atas --}}
                    <div class="animate-float hidden sm:flex items-center gap-2.5 bg-white text-slate-900 px-3.5 py-2 rounded-2xl shadow-lg border border-emerald-100 absolute -left-2 top-3 z-20">
                        <span class="w-7 h-7 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-extrabold text-xs">
                            +0.8
                        </span>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 leading-none">BB Balita Bulan Ini</p>
                            <p class="text-xs font-extrabold text-emerald-700 mt-0.5">Naik (N) &bull; Gizi Baik</p>
                        </div>
                    </div>

                    {{-- Floating Badge Kanan Bawah --}}
                    <div class="animate-float-delayed hidden sm:flex items-center gap-2.5 bg-slate-900/95 text-white px-3.5 py-2 rounded-2xl shadow-lg border border-emerald-500/40 absolute -right-1 bottom-3 z-20">
                        <span class="w-7 h-7 rounded-xl bg-amber-400/20 text-amber-300 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </span>
                        <div>
                            <p class="text-[10px] font-bold text-emerald-300 leading-none">Status Imunisasi</p>
                            <p class="text-xs font-extrabold text-white mt-0.5">DPT-HB-Hib 3 Selesai</p>
                        </div>
                    </div>

                    {{-- SVG Utama --}}
                    <div class="relative bg-gradient-to-b from-emerald-50 to-white rounded-2xl p-4 flex items-center justify-center shadow-inner border border-emerald-100/80">
                        <svg viewBox="0 0 360 230" class="w-full h-48 sm:h-52" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Ilustrasi Pemantauan Kesehatan Ibu dan Anak">
                            <circle cx="180" cy="115" r="92" fill="#d1fae5" fill-opacity="0.55" />
                            <circle cx="272" cy="54" r="24" fill="#fef3c7" />
                            <circle cx="84" cy="168" r="18" fill="#a7f3d0" fill-opacity="0.6" />

                            {{-- Kartu Utama Buku KIA --}}
                            <rect x="64" y="32" width="212" height="154" rx="18" fill="#ffffff" stroke="#a7f3d0" stroke-width="2.5" />
                            <rect x="82" y="48" width="92" height="10" rx="5" fill="#064e3b" />
                            <rect x="82" y="64" width="60" height="7" rx="3.5" fill="#6ee7b7" />

                            {{-- Badge Status Normal --}}
                            <rect x="196" y="47" width="62" height="22" rx="11" fill="#ecfdf5" stroke="#10b981" stroke-width="1.5" />
                            <circle cx="208" cy="58" r="3.5" fill="#10b981" />
                            <rect x="216" y="55" width="32" height="6" rx="3" fill="#047857" />

                            {{-- Area Grafik KMS --}}
                            <rect x="82" y="84" width="176" height="84" rx="12" fill="#f8fafc" stroke="#e2e8f0" stroke-width="1.5" />
                            <line x1="94" y1="104" x2="246" y2="104" stroke="#e2e8f0" stroke-dasharray="3 3" />
                            <line x1="94" y1="126" x2="246" y2="126" stroke="#e2e8f0" stroke-dasharray="3 3" />
                            <line x1="94" y1="148" x2="246" y2="148" stroke="#e2e8f0" stroke-dasharray="3 3" />

                            {{-- Area Arsiran Hijau di Bawah Kurva --}}
                            <path d="M98 148 C122 143, 136 128, 158 122 C180 116, 198 103, 238 94 L238 156 L98 156 Z" fill="#10b981" fill-opacity="0.12" />

                            {{-- Kurva Pertumbuhan Anak --}}
                            <path d="M98 148 C122 143, 136 128, 158 122 C180 116, 198 103, 238 94" stroke="#10b981" stroke-width="3.5" stroke-linecap="round" />
                            <circle cx="98" cy="148" r="4.5" fill="#ffffff" stroke="#10b981" stroke-width="2.5" />
                            <circle cx="158" cy="122" r="4.5" fill="#ffffff" stroke="#10b981" stroke-width="2.5" />
                            <circle cx="238" cy="94" r="6" fill="#10b981" stroke="#ffffff" stroke-width="2.5" />

                            {{-- Kartu Melayang Maternal --}}
                            <rect x="218" y="132" width="92" height="64" rx="14" fill="#064e3b" />
                            <circle cx="244" cy="164" r="14" fill="#10b981" fill-opacity="0.25" />
                            <path d="M244 171.5C244 171.5 235 166.1 235 160.4C235 157.8 237 155.8 239.5 155.8C241.1 155.8 242.6 156.6 244 158C245.4 156.6 246.9 155.8 248.5 155.8C251 155.8 253 157.8 253 160.4C253 166.1 244 171.5 244 171.5Z" fill="#34d399" />
                            <rect x="266" y="155" width="32" height="7" rx="3.5" fill="#ffffff" />
                            <rect x="266" y="167" width="22" height="6" rx="3" fill="#a7f3d0" />

                            {{-- Kartu Melayang Vitamin & PMT --}}
                            <rect x="44" y="142" width="78" height="46" rx="12" fill="#ffffff" stroke="#cbd5e1" stroke-width="1.5" />
                            <circle cx="64" cy="165" r="10" fill="#fef3c7" />
                            <path d="M60 165.2L62.8 168L68.5 162.3" stroke="#d97706" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
                            <rect x="80" y="159" width="30" height="5.5" rx="2.75" fill="#334155" />
                            <rect x="80" y="168" width="22" height="4.5" rx="2.25" fill="#94a3b8" />
                        </svg>
                    </div>
                </div>

                <div class="relative pt-4 mt-2 border-t border-white/15 flex items-center justify-between gap-4">
                    <div>
                        <p class="text-[11px] font-bold uppercase tracking-widest text-emerald-300 mb-0.5">Cakupan Pelayanan Terpadu</p>
                        <p class="text-sm font-bold text-white leading-snug">
                            Pemantauan Balita, Ibu Hamil Risti, Imunisasi &amp; KB
                        </p>
                    </div>
                    <span class="shrink-0 w-10 h-10 rounded-xl bg-white/10 border border-white/15 flex items-center justify-center text-amber-300 font-extrabold text-xs">
                        24/7
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. STATISTIK INTERAKTIF DENGAN COUNTER ANIMATION --}}
    <section id="statistik" aria-labelledby="heading-statistik" class="pb-16 sm:pb-20 px-5 sm:px-8 reveal">
        <div class="max-w-7xl mx-auto">
            <h2 id="heading-statistik" class="sr-only">Statistik Layanan Posyandu</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Stat 1 --}}
                <div class="group bg-white border border-slate-200/90 hover:border-emerald-400 rounded-3xl p-6 sm:p-7 shadow-xs hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-5">
                        <span class="text-xs font-extrabold uppercase tracking-widest text-slate-400">01 / Wilayah</span>
                        <span class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-700 border border-emerald-100 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white group-hover:scale-110 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </span>
                    </div>
                    <p class="text-4xl font-extrabold tracking-tight text-slate-900 tabular-nums mb-1">
                        <span class="counter" data-target="10">0</span>
                    </p>
                    <p class="text-sm font-bold text-emerald-800">Desa Terintegrasi</p>
                    <p class="text-xs text-slate-500 mt-1">Pelaporan terpusat lintas desa</p>
                </div>

                {{-- Stat 2 --}}
                <div class="group bg-white border border-slate-200/90 hover:border-teal-400 rounded-3xl p-6 sm:p-7 shadow-xs hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-5">
                        <span class="text-xs font-extrabold uppercase tracking-widest text-slate-400">02 / Posyandu</span>
                        <span class="w-11 h-11 rounded-2xl bg-teal-50 text-teal-700 border border-teal-100 flex items-center justify-center group-hover:bg-teal-600 group-hover:text-white group-hover:scale-110 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </span>
                    </div>
                    <p class="text-4xl font-extrabold tracking-tight text-slate-900 tabular-nums mb-1">
                        <span class="counter" data-target="25">0</span>
                    </p>
                    <p class="text-sm font-bold text-teal-800">Posyandu Aktif</p>
                    <p class="text-xs text-slate-500 mt-1">Didampingi Kader &amp; Bidan Desa</p>
                </div>

                {{-- Stat 3 --}}
                <div class="group bg-white border border-slate-200/90 hover:border-amber-400 rounded-3xl p-6 sm:p-7 shadow-xs hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-5">
                        <span class="text-xs font-extrabold uppercase tracking-widest text-slate-400">03 / Cakupan Vaksin</span>
                        <span class="w-11 h-11 rounded-2xl bg-amber-50 text-amber-700 border border-amber-100 flex items-center justify-center group-hover:bg-amber-500 group-hover:text-white group-hover:scale-110 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </span>
                    </div>
                    <p class="text-4xl font-extrabold tracking-tight text-slate-900 tabular-nums mb-1">
                        <span class="counter" data-target="96">0</span>%
                    </p>
                    <p class="text-sm font-bold text-amber-800">Imunisasi Dasar</p>
                    <p class="text-xs text-slate-500 mt-1">Tercatat &amp; terjadwal otomatis</p>
                </div>

                {{-- Stat 4 (Highlight Card) --}}
                <div class="relative overflow-hidden bg-gradient-to-br from-emerald-800 via-emerald-700 to-teal-700 text-white border border-emerald-700 rounded-3xl p-6 sm:p-7 shadow-lg hover:-translate-y-1 transition-all duration-300">
                    <div class="pointer-events-none absolute -right-8 -bottom-8 h-36 w-36 rounded-full bg-white/10 blur-2xl"></div>
                    <div class="relative flex items-center justify-between mb-5">
                        <span class="text-xs font-extrabold uppercase tracking-widest text-emerald-100">04 / Sasaran KIA</span>
                        <span class="w-11 h-11 rounded-2xl bg-white/15 border border-white/20 text-white flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </span>
                    </div>
                    <p class="relative text-4xl font-extrabold tracking-tight text-white tabular-nums mb-1">
                        <span class="counter" data-target="1240">0</span>+
                    </p>
                    <p class="relative text-sm font-bold text-emerald-100">Anak &amp; Ibu Terpantau</p>
                    <p class="relative text-xs text-emerald-200/90 mt-1">Kurva KMS &amp; riwayat digital</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. ALUR SISTEM 5 MEJA POSYANDU DIGITAL --}}
    <section id="alur-posyandu" aria-labelledby="heading-alur" class="py-16 sm:py-24 px-5 sm:px-8 bg-slate-900 text-white relative overflow-hidden reveal">
        <div class="pointer-events-none absolute -top-24 -right-24 w-96 h-96 rounded-full bg-emerald-500/10 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-teal-500/10 blur-3xl"></div>

        <div class="max-w-7xl mx-auto relative">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <span class="inline-flex items-center gap-1.5 text-xs font-extrabold uppercase tracking-widest text-amber-300 bg-white/10 border border-white/15 px-3.5 py-1 rounded-full mb-3">
                    Standar Pelayanan Posyandu
                </span>
                <h2 id="heading-alur" class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white mb-3">
                    Digitalisasi Alur 5 Meja Posyandu
                </h2>
                <p class="text-sm sm:text-base text-slate-300 leading-relaxed">
                    Seluruh tahapan pelayanan di hari buka Posyandu tercatat sistematis dari pendaftaran hingga rujukan klinis Bidan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-5">
                {{-- Meja 1 --}}
                <div class="group bg-white/5 hover:bg-white/10 border border-white/10 hover:border-emerald-400/60 rounded-3xl p-6 transition-all duration-300 hover:-translate-y-1.5">
                    <div class="w-11 h-11 rounded-2xl bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 font-extrabold text-sm flex items-center justify-center mb-5 group-hover:bg-emerald-500 group-hover:text-slate-950 transition-colors">
                        01
                    </div>
                    <h3 class="font-extrabold text-base text-white mb-2">Meja Pendaftaran</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Registrasi kehadiran balita, ibu hamil, dan pasangan usia subur (PUS) berbasis NIK atau akun keluarga.
                    </p>
                </div>

                {{-- Meja 2 --}}
                <div class="group bg-white/5 hover:bg-white/10 border border-white/10 hover:border-emerald-400/60 rounded-3xl p-6 transition-all duration-300 hover:-translate-y-1.5">
                    <div class="w-11 h-11 rounded-2xl bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 font-extrabold text-sm flex items-center justify-center mb-5 group-hover:bg-emerald-500 group-hover:text-slate-950 transition-colors">
                        02
                    </div>
                    <h3 class="font-extrabold text-base text-white mb-2">Penimbangan &amp; Ukur</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Pengukuran berat badan (BB), panjang/tinggi badan (TB), lingkar kepala, serta LILA ibu hamil.
                    </p>
                </div>

                {{-- Meja 3 --}}
                <div class="group bg-white/5 hover:bg-white/10 border border-white/10 hover:border-emerald-400/60 rounded-3xl p-6 transition-all duration-300 hover:-translate-y-1.5">
                    <div class="w-11 h-11 rounded-2xl bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 font-extrabold text-sm flex items-center justify-center mb-5 group-hover:bg-emerald-500 group-hover:text-slate-950 transition-colors">
                        03
                    </div>
                    <h3 class="font-extrabold text-base text-white mb-2">Pencatatan KMS</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Plotting otomatis ke grafik kurva KMS digital untuk mendeteksi status Naik (N), Tidak Naik (T), atau risiko stunting.
                    </p>
                </div>

                {{-- Meja 4 --}}
                <div class="group bg-white/5 hover:bg-white/10 border border-white/10 hover:border-emerald-400/60 rounded-3xl p-6 transition-all duration-300 hover:-translate-y-1.5">
                    <div class="w-11 h-11 rounded-2xl bg-amber-400/20 border border-amber-300/30 text-amber-300 font-extrabold text-sm flex items-center justify-center mb-5 group-hover:bg-amber-400 group-hover:text-slate-950 transition-colors">
                        04
                    </div>
                    <h3 class="font-extrabold text-base text-white mb-2">Penyuluhan &amp; PMT</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Edukasi MP-ASI bergizi seimbang, ASI eksklusif, dan distribusi Pemberian Makanan Tambahan (PMT) pemulihan.
                    </p>
                </div>

                {{-- Meja 5 --}}
                <div class="group bg-white/5 hover:bg-white/10 border border-white/10 hover:border-emerald-400/60 rounded-3xl p-6 transition-all duration-300 hover:-translate-y-1.5">
                    <div class="w-11 h-11 rounded-2xl bg-teal-400/20 border border-teal-300/30 text-teal-300 font-extrabold text-sm flex items-center justify-center mb-5 group-hover:bg-teal-400 group-hover:text-slate-950 transition-colors">
                        05
                    </div>
                    <h3 class="font-extrabold text-base text-white mb-2">Pelayanan Medis</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Pemberian imunisasi dasar, vitamin A, tablet tambah darah, layanan KB, dan konsultasi langsung Bidan Desa.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. LAYANAN TERPADU SECTION --}}
    <section id="layanan" aria-labelledby="heading-layanan" class="py-16 sm:py-24 px-5 sm:px-8 bg-white border-b border-slate-200/80 reveal">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-end mb-12">
                <div class="lg:col-span-7">
                    <span class="inline-flex items-center gap-1.5 text-xs font-extrabold uppercase tracking-widest text-emerald-700 bg-emerald-50 border border-emerald-200/80 px-3 py-1 rounded-full mb-3">
                        Modul Utama Sistem
                    </span>
                    <h2 id="heading-layanan" class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-900">
                        Layanan Terpadu SIPANDAI
                    </h2>
                </div>
                <div class="lg:col-span-5">
                    <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                        Digitalisasi pencatatan layanan Posyandu untuk mempercepat deteksi dini risiko kesehatan dan mendukung pencegahan stunting di tingkat desa.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Card 1 --}}
                <article class="group bg-[#f6f9f7] hover:bg-white border border-slate-200/90 hover:border-emerald-400 rounded-3xl p-6 sm:p-7 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-950/5 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <span class="text-xs font-extrabold text-emerald-800 bg-emerald-100/90 px-3 py-1 rounded-full">01</span>
                            <span class="w-11 h-11 rounded-2xl bg-white border border-slate-200/80 text-emerald-700 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white group-hover:rotate-6 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </span>
                        </div>
                        <h3 class="font-extrabold text-lg text-slate-900 mb-2.5">Kesehatan Ibu &amp; Anak</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Pendataan ibu hamil, penghitungan HPL otomatis, skrining LILA/KEK, dan pengawasan kehamilan risiko tinggi.
                        </p>
                    </div>
                    <div class="mt-7 pt-4 border-t border-slate-200/80 flex items-center justify-between text-xs font-bold text-emerald-800">
                        <span>KIA &amp; Skrining Maternal</span>
                        <span class="w-2 h-2 rounded-full bg-emerald-500 group-hover:scale-150 transition-transform"></span>
                    </div>
                </article>

                {{-- Card 2 --}}
                <article class="group bg-[#f6f9f7] hover:bg-white border border-slate-200/90 hover:border-emerald-400 rounded-3xl p-6 sm:p-7 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-950/5 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <span class="text-xs font-extrabold text-emerald-800 bg-emerald-100/90 px-3 py-1 rounded-full">02</span>
                            <span class="w-11 h-11 rounded-2xl bg-white border border-slate-200/80 text-emerald-700 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white group-hover:rotate-6 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            </span>
                        </div>
                        <h3 class="font-extrabold text-lg text-slate-900 mb-2.5">Tumbuh Kembang</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Pemantauan berat badan, tinggi badan, grafik kurva KMS interaktif, serta deteksi dini stunting otomatis.
                        </p>
                    </div>
                    <div class="mt-7 pt-4 border-t border-slate-200/80 flex items-center justify-between text-xs font-bold text-emerald-800">
                        <span>KMS Digital &amp; Antropometri</span>
                        <span class="w-2 h-2 rounded-full bg-emerald-500 group-hover:scale-150 transition-transform"></span>
                    </div>
                </article>

                {{-- Card 3 --}}
                <article class="group bg-[#f6f9f7] hover:bg-white border border-slate-200/90 hover:border-emerald-400 rounded-3xl p-6 sm:p-7 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-950/5 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <span class="text-xs font-extrabold text-emerald-800 bg-emerald-100/90 px-3 py-1 rounded-full">03</span>
                            <span class="w-11 h-11 rounded-2xl bg-white border border-slate-200/80 text-emerald-700 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white group-hover:rotate-6 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </span>
                        </div>
                        <h3 class="font-extrabold text-lg text-slate-900 mb-2.5">Imunisasi Dasar</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Pencatatan riwayat vaksinasi anak lengkap dengan pengingat jadwal serta laporan cetak KMS siap unduh.
                        </p>
                    </div>
                    <div class="mt-7 pt-4 border-t border-slate-200/80 flex items-center justify-between text-xs font-bold text-emerald-800">
                        <span>Riwayat Vaksin &amp; PDF KMS</span>
                        <span class="w-2 h-2 rounded-full bg-emerald-500 group-hover:scale-150 transition-transform"></span>
                    </div>
                </article>

                {{-- Card 4 --}}
                <article class="group bg-[#f6f9f7] hover:bg-white border border-slate-200/90 hover:border-emerald-400 rounded-3xl p-6 sm:p-7 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-950/5 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <span class="text-xs font-extrabold text-emerald-800 bg-emerald-100/90 px-3 py-1 rounded-full">04</span>
                            <span class="w-11 h-11 rounded-2xl bg-white border border-slate-200/80 text-emerald-700 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white group-hover:rotate-6 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </span>
                        </div>
                        <h3 class="font-extrabold text-lg text-slate-900 mb-2.5">Pelayanan KB</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Pencatatan akseptor Keluarga Berencana, jenis kontrasepsi, dan pemantauan jadwal kontrol ulang.
                        </p>
                    </div>
                    <div class="mt-7 pt-4 border-t border-slate-200/80 flex items-center justify-between text-xs font-bold text-emerald-800">
                        <span>Kontrasepsi &amp; Kontrol Ulang</span>
                        <span class="w-2 h-2 rounded-full bg-emerald-500 group-hover:scale-150 transition-transform"></span>
                    </div>
                </article>
            </div>
        </div>
    </section>

    {{-- 6. PANDUAN INTERAKTIF KIA & JADWAL IMUNISASI (ALPINE TABS) --}}
    <section id="edukasi-kia" aria-labelledby="heading-edukasi" class="py-16 sm:py-24 px-5 sm:px-8 reveal" x-data="{ activeTab: 'imunisasi' }">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-10">
                <div>
                    <span class="inline-flex items-center gap-1.5 text-xs font-extrabold uppercase tracking-widest text-teal-800 bg-teal-50 border border-teal-200/80 px-3 py-1 rounded-full mb-3">
                        Referensi Kesehatan Keluarga
                    </span>
                    <h2 id="heading-edukasi" class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-900">
                        Panduan Praktis Buku KIA &amp; Gizi Balita
                    </h2>
                </div>

                {{-- Tombol Tab Interaktif --}}
                <div class="inline-flex flex-wrap gap-2 bg-white p-1.5 rounded-2xl border border-slate-200 shadow-2xs">
                    <button type="button"
                            @click="activeTab = 'imunisasi'"
                            :class="activeTab === 'imunisasi' ? 'bg-emerald-800 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900'"
                            class="px-4 py-2.5 rounded-xl text-xs font-extrabold transition-all">
                        Jadwal Imunisasi Dasar
                    </button>
                    <button type="button"
                            @click="activeTab = 'gizi'"
                            :class="activeTab === 'gizi' ? 'bg-emerald-800 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900'"
                            class="px-4 py-2.5 rounded-xl text-xs font-extrabold transition-all">
                        Indikator Pita Warna KMS
                    </button>
                    <button type="button"
                            @click="activeTab = 'bumil'"
                            :class="activeTab === 'bumil' ? 'bg-emerald-800 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900'"
                            class="px-4 py-2.5 rounded-xl text-xs font-extrabold transition-all">
                        Pemeriksaan Ibu Hamil
                    </button>
                </div>
            </div>

            {{-- Konten Tab 1: Jadwal Imunisasi --}}
            <div x-show="activeTab === 'imunisasi'" x-transition.opacity class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-sm">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div class="p-5 rounded-2xl bg-emerald-50/70 border border-emerald-200/70">
                        <span class="inline-block px-2.5 py-1 rounded-lg bg-emerald-700 text-white text-[11px] font-extrabold mb-3">Usia 0 Bulan</span>
                        <h3 class="font-extrabold text-slate-900 text-base mb-1">Hepatitis B (HB-0)</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">Diberikan segera setelah bayi lahir (&lt; 24 jam) untuk mencegah penularan Hepatitis B.</p>
                    </div>
                    <div class="p-5 rounded-2xl bg-teal-50/70 border border-teal-200/70">
                        <span class="inline-block px-2.5 py-1 rounded-lg bg-teal-700 text-white text-[11px] font-extrabold mb-3">Usia 1 Bulan</span>
                        <h3 class="font-extrabold text-slate-900 text-base mb-1">BCG &amp; Polio Tetes 1</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">Perlindungan dini terhadap Tuberkulosis (TBC) berat dan virus Polio.</p>
                    </div>
                    <div class="p-5 rounded-2xl bg-sky-50/70 border border-sky-200/70">
                        <span class="inline-block px-2.5 py-1 rounded-lg bg-sky-700 text-white text-[11px] font-extrabold mb-3">Usia 2 - 4 Bulan</span>
                        <h3 class="font-extrabold text-slate-900 text-base mb-1">DPT-HB-Hib &amp; Polio 2-4</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">Mencegah Difteri, Pertusis, Tetanus, Hepatitis B, Pneumonia, serta Meningitis.</p>
                    </div>
                    <div class="p-5 rounded-2xl bg-amber-50/70 border border-amber-200/70">
                        <span class="inline-block px-2.5 py-1 rounded-lg bg-amber-600 text-white text-[11px] font-extrabold mb-3">Usia 9 Bulan</span>
                        <h3 class="font-extrabold text-slate-900 text-base mb-1">Campak / Rubella (MR)</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">Vaksinasi penting untuk kekebalan tubuh anak terhadap penyakit Campak dan Rubella.</p>
                    </div>
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200">
                        <span class="inline-block px-2.5 py-1 rounded-lg bg-slate-800 text-white text-[11px] font-extrabold mb-3">Usia 18 Bulan</span>
                        <h3 class="font-extrabold text-slate-900 text-base mb-1">Imunisasi Lanjutan</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">Dosis penguat (booster) DPT-HB-Hib dan Campak-Rubella untuk proteksi jangka panjang.</p>
                    </div>
                </div>
            </div>

            {{-- Konten Tab 2: Indikator Warna KMS --}}
            <div x-show="activeTab === 'gizi'" style="display: none;" x-transition.opacity class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-6 rounded-2xl bg-emerald-50 border border-emerald-200">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="w-4 h-4 rounded-full bg-emerald-600"></span>
                            <h3 class="font-extrabold text-emerald-950 text-base">Pita Hijau (Pertumbuhan Normal)</h3>
                        </div>
                        <p class="text-xs sm:text-sm text-emerald-900/80 leading-relaxed">
                            Berat badan anak berada pada jalur pertumbuhan normal sesuai usia dan jenis kelamin. Pertahankan pola makan bergizi seimbang dan pemantauan rutin.
                        </p>
                    </div>
                    <div class="p-6 rounded-2xl bg-amber-50 border border-amber-200">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="w-4 h-4 rounded-full bg-amber-500"></span>
                            <h3 class="font-extrabold text-amber-950 text-base">Pita Kuning (Waspada Gizi Kurang)</h3>
                        </div>
                        <p class="text-xs sm:text-sm text-amber-900/80 leading-relaxed">
                            Berat badan berada di ambang batas bawah normal. Memerlukan edukasi MP-ASI tinggi protein hewani dan pemantauan lebih ketat oleh Kader.
                        </p>
                    </div>
                    <div class="p-6 rounded-2xl bg-rose-50 border border-rose-200">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="w-4 h-4 rounded-full bg-rose-600"></span>
                            <h3 class="font-extrabold text-rose-950 text-base">Di Bawah Garis Merah (BGM)</h3>
                        </div>
                        <p class="text-xs sm:text-sm text-rose-900/80 leading-relaxed">
                            Indikasi risiko gizi buruk atau gangguan pertumbuhan serius. Sistem SIPANDAI otomatis menandai kasus ini untuk rujukan segera ke Bidan/Puskesmas.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Konten Tab 3: Pemeriksaan Ibu Hamil --}}
            <div x-show="activeTab === 'bumil'" style="display: none;" x-transition.opacity class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200">
                        <span class="text-xs font-extrabold text-emerald-700 uppercase tracking-wider">Trimester 1 (0 - 12 Minggu)</span>
                        <h3 class="font-extrabold text-slate-900 text-base mt-1 mb-2">Minimal 1x Pemeriksaan</h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Deteksi dini kehamilan, pencatatan HPHT, pengukuran LILA (Lingkar Lengan Atas &ge; 23,5 cm), serta skrining awal faktor risiko.
                        </p>
                    </div>
                    <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200">
                        <span class="text-xs font-extrabold text-emerald-700 uppercase tracking-wider">Trimester 2 (13 - 27 Minggu)</span>
                        <h3 class="font-extrabold text-slate-900 text-base mt-1 mb-2">Minimal 2x Pemeriksaan</h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Pemantauan kenaikan berat badan ibu, tekanan darah, denyut jantung janin, imunisasi TT, dan kepatuhan konsumsi Tablet Tambah Darah.
                        </p>
                    </div>
                    <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200">
                        <span class="text-xs font-extrabold text-emerald-700 uppercase tracking-wider">Trimester 3 (28 - 40 Minggu)</span>
                        <h3 class="font-extrabold text-slate-900 text-base mt-1 mb-2">Minimal 3x Pemeriksaan</h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Persiapan persalinan aman di fasilitas kesehatan, pemantauan posisi janin, dan pengawasan tanda bahaya menjelang Hari Perkiraan Lahir (HPL).
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 7. EKOSISTEM PERAN PENGGUNA --}}
    <section id="peran" aria-labelledby="heading-peran" class="py-16 sm:py-20 px-5 sm:px-8 bg-white border-y border-slate-200/80 reveal">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="inline-flex items-center gap-1.5 text-xs font-extrabold uppercase tracking-widest text-amber-800 bg-amber-50 border border-amber-200/80 px-3 py-1 rounded-full mb-3">
                    Kolaborasi Lintas Peran
                </span>
                <h2 id="heading-peran" class="text-2xl sm:text-4xl font-extrabold tracking-tight text-slate-900">
                    Satu Platform untuk Semua Pemangku Kepentingan
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="group bg-[#f6f9f7] hover:bg-white rounded-3xl p-7 border border-slate-200/90 hover:border-emerald-400 shadow-2xs hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-5">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-800">
                            Kader Posyandu
                        </span>
                        <span class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-extrabold text-xs">01</span>
                    </div>
                    <h3 class="font-extrabold text-lg text-slate-900 mb-2">Pencatatan Lapangan Cepat</h3>
                    <p class="text-sm text-slate-600 leading-relaxed mb-4">
                        Input hasil penimbangan balita, vaksinasi, data ibu hamil, dan layanan KB langsung saat hari buka Posyandu.
                    </p>
                    <ul class="space-y-1.5 text-xs font-semibold text-slate-700 border-t border-slate-200/80 pt-4">
                        <li>&bull; Input penimbangan &amp; antropometri instan</li>
                        <li>&bull; Verifikasi akun orang tua di desa binaan</li>
                    </ul>
                </div>

                <div class="group bg-[#f6f9f7] hover:bg-white rounded-3xl p-7 border border-slate-200/90 hover:border-amber-400 shadow-2xs hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-5">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-amber-100 text-amber-800">
                            Bidan Desa
                        </span>
                        <span class="w-10 h-10 rounded-xl bg-amber-500 text-slate-950 flex items-center justify-center font-extrabold text-xs">02</span>
                    </div>
                    <h3 class="font-extrabold text-lg text-slate-900 mb-2">Intervensi Klinis Terarah</h3>
                    <p class="text-sm text-slate-600 leading-relaxed mb-4">
                        Pantau otomatis daftar kasus stunting dan ibu hamil risiko tinggi untuk pemberian advis medis dan PMT.
                    </p>
                    <ul class="space-y-1.5 text-xs font-semibold text-slate-700 border-t border-slate-200/80 pt-4">
                        <li>&bull; Radar deteksi balita BGM &amp; ibu hamil KEK</li>
                        <li>&bull; Rekapitulasi laporan bulanan desa otomatis</li>
                    </ul>
                </div>

                <div class="group bg-[#f6f9f7] hover:bg-white rounded-3xl p-7 border border-slate-200/90 hover:border-sky-400 shadow-2xs hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-5">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-sky-100 text-sky-800">
                            Orang Tua / Keluarga
                        </span>
                        <span class="w-10 h-10 rounded-xl bg-sky-600 text-white flex items-center justify-center font-extrabold text-xs">03</span>
                    </div>
                    <h3 class="font-extrabold text-lg text-slate-900 mb-2">Buku KIA Digital di Genggaman</h3>
                    <p class="text-sm text-slate-600 leading-relaxed mb-4">
                        Akses kurva pertumbuhan anak, jadwal Posyandu desa, catatan Bidan, dan unduh dokumen KMS PDF kapan saja.
                    </p>
                    <ul class="space-y-1.5 text-xs font-semibold text-slate-700 border-t border-slate-200/80 pt-4">
                        <li>&bull; Grafik KMS &amp; riwayat vaksinasi anak</li>
                        <li>&bull; Pengingat jadwal buka Posyandu terdekat</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- 8. FAQ (TANYA JAWAB INTERAKTIF) --}}
    <section id="faq" aria-labelledby="heading-faq" class="py-16 sm:py-20 px-5 sm:px-8 reveal" x-data="{ openFaq: 1 }">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-10">
                <span class="inline-flex items-center gap-1.5 text-xs font-extrabold uppercase tracking-widest text-emerald-800 bg-emerald-50 border border-emerald-200/80 px-3 py-1 rounded-full mb-3">
                    Pusat Bantuan
                </span>
                <h2 id="heading-faq" class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
                    Pertanyaan yang Sering Diajukan
                </h2>
            </div>

            <div class="space-y-3.5">
                {{-- FAQ 1 --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-2xs">
                    <button type="button" @click="openFaq = openFaq === 1 ? null : 1" class="w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-bold text-sm sm:text-base text-slate-900 hover:bg-slate-50 transition-colors">
                        <span>Bagaimana cara orang tua mendapatkan akses ke Buku KIA Digital anak?</span>
                        <svg :class="openFaq === 1 ? 'rotate-180 text-emerald-700' : 'text-slate-400'" class="w-5 h-5 shrink-0 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 1" x-transition class="px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Orang tua cukup mendaftar melalui tombol <strong>Daftar Akun</strong> dengan memilih Desa dan Posyandu sesuai domisili. Setelah akun diverifikasi oleh Kader Posyandu setempat, data riwayat penimbangan dan imunisasi anak akan langsung terhubung di dashboard Anda.
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-2xs">
                    <button type="button" @click="openFaq = openFaq === 2 ? null : 2" class="w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-bold text-sm sm:text-base text-slate-900 hover:bg-slate-50 transition-colors">
                        <span>Apakah grafik KMS di SIPANDAI sudah sesuai standar Kementerian Kesehatan?</span>
                        <svg :class="openFaq === 2 ? 'rotate-180 text-emerald-700' : 'text-slate-400'" class="w-5 h-5 shrink-0 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 2" style="display: none;" x-transition class="px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Ya. Kurva Kartu Menuju Sehat (KMS) dan indikator status gizi (BB/U, TB/U, BB/TB) pada SIPANDAI mengacu pada standar antropometri WHO dan Buku KIA Kementerian Kesehatan RI, dibedakan berdasarkan jenis kelamin laki-laki dan perempuan.
                    </div>
                </div>

                {{-- FAQ 3 --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-2xs">
                    <button type="button" @click="openFaq = openFaq === 3 ? null : 3" class="w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-bold text-sm sm:text-base text-slate-900 hover:bg-slate-50 transition-colors">
                        <span>Bisakah laporan KMS atau riwayat pemeriksaan dicetak untuk keperluan sekolah atau rujukan?</span>
                        <svg :class="openFaq === 3 ? 'rotate-180 text-emerald-700' : 'text-slate-400'" class="w-5 h-5 shrink-0 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 3" style="display: none;" x-transition class="px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Bisa. Orang tua maupun Kader dapat mengunduh ringkasan Kartu Menuju Sehat (KMS) dan catatan riwayat imunisasi dasar lengkap dalam format PDF siap cetak kapan saja.
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 9. CTA BANNER SECTION --}}
    <section id="warta" aria-labelledby="heading-warta" class="pb-16 sm:pb-24 px-5 sm:px-8 reveal">
        <div class="max-w-7xl mx-auto relative overflow-hidden bg-gradient-to-br from-slate-900 via-emerald-950 to-emerald-900 text-white rounded-3xl p-8 sm:p-12 shadow-xl border border-emerald-800/50 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
            <div class="pointer-events-none absolute -right-12 -top-12 h-56 w-56 rounded-full bg-emerald-400/20 blur-2xl"></div>
            <div class="pointer-events-none absolute right-32 -bottom-16 h-48 w-48 rounded-full bg-amber-400/15 blur-2xl"></div>

            <div class="relative max-w-2xl">
                <span class="inline-flex items-center gap-1.5 text-xs font-extrabold uppercase tracking-widest text-amber-300 bg-white/10 border border-white/15 px-3 py-1 rounded-full mb-4">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-ping"></span>
                    Portal Layanan Digital
                </span>
                <h2 id="heading-warta" class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white mb-2.5">
                    Mulai Digitalisasi Posyandu &amp; Pantau Tumbuh Kembang Anak
                </h2>
                <p class="text-sm sm:text-base text-slate-300 leading-relaxed">
                    Masuk ke akun Anda untuk mengakses pencatatan kegiatan, jadwal Posyandu, dan rekap perkembangan kesehatan keluarga secara terpadu.
                </p>
            </div>

            <div class="relative flex flex-wrap gap-3.5 shrink-0">
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-slate-950 px-7 py-3.5 rounded-2xl text-sm font-extrabold shadow-lg transition-all hover:-translate-y-0.5">
                        Ke Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-slate-950 px-7 py-3.5 rounded-2xl text-sm font-extrabold shadow-lg transition-all hover:-translate-y-0.5">
                        Masuk ke Sistem
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center justify-center bg-white/10 hover:bg-white/15 text-white border border-white/20 px-7 py-3.5 rounded-2xl text-sm font-bold transition-colors">
                            Daftar Akun
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </section>

    {{-- 10. FOOTER DENGAN IDENTITAS PROJEK MATA KULIAH E-BISNIS MI-5B --}}
    <footer class="bg-slate-950 text-slate-400 pt-14 pb-10 text-sm border-t border-slate-800/80">
        <div class="max-w-7xl mx-auto px-5 sm:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 pb-10 border-b border-slate-800/80">
                {{-- Kolom Brand --}}
                <div class="md:col-span-5">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center">
                            <svg class="w-5 h-5 text-slate-950 stroke-[2.4]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </div>
                        <p class="text-xl font-extrabold tracking-tight text-white">SIPANDAI</p>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-400 leading-relaxed max-w-md">
                        Sistem Informasi Posyandu Andalan Ibu — Solusi digitalisasi pelayanan kesehatan ibu dan anak, pemantauan KMS, serta pencegahan stunting terpadu.
                    </p>
                </div>

                {{-- Kolom Navigasi Cepat --}}
                <div class="md:col-span-3">
                    <p class="text-xs font-extrabold uppercase tracking-wider text-white mb-3">Navigasi Cepat</p>
                    <ul class="space-y-2 text-xs text-slate-400">
                        <li><a href="#beranda" class="hover:text-emerald-400 transition-colors">Beranda Utama</a></li>
                        <li><a href="#alur-posyandu" class="hover:text-emerald-400 transition-colors">Alur 5 Meja Posyandu</a></li>
                        <li><a href="#layanan" class="hover:text-emerald-400 transition-colors">Layanan Terpadu</a></li>
                        <li><a href="#edukasi-kia" class="hover:text-emerald-400 transition-colors">Panduan Buku KIA</a></li>
                        <li><a href="#faq" class="hover:text-emerald-400 transition-colors">Tanya Jawab (FAQ)</a></li>
                    </ul>
                </div>

                {{-- Kolom Identitas Projek Akademik --}}
                <div class="md:col-span-4">
                    <div class="bg-slate-900/90 border border-emerald-800/40 rounded-2xl p-4 sm:p-5">
                        <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-widest text-amber-300 bg-amber-400/10 border border-amber-400/20 px-2.5 py-0.5 rounded-full mb-2.5">
                            Informasi Pengembangan
                        </span>
                        <p class="text-xs sm:text-sm font-bold text-white leading-snug">
                            Projek Mata Kuliah E-Bisnis — Kelas MI-5B
                        </p>
                        <p class="text-xs text-emerald-300 font-semibold mt-1">
                            Program Studi Manajemen Informatika
                        </p>
                        <p class="text-xs text-slate-400 mt-0.5">
                            Jurusan Teknik Komputer dan Informatika
                        </p>
                    </div>
                </div>
            </div>

            {{-- Bottom Bar Copyright & Akademik --}}
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500 text-center sm:text-left">
                <p>
                    &copy; {{ date('Y') }} <strong class="text-slate-300">SIPANDAI</strong>. Hak Cipta Dilindungi.
                </p>
                <p class="text-slate-400 font-medium">
                    Projek Mata Kuliah E-Bisnis MI-5B &bull; Jurusan Teknik Komputer dan Informatika &bull; Prodi Manajemen Informatika
                </p>
            </div>
        </div>
    </footer>

    {{-- SCRIPT ANIMASI SCROLL REVEAL & COUNTER STATISTIK --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Scroll Reveal Animation
            const revealElements = document.querySelectorAll('.reveal');
            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12 });

            revealElements.forEach(el => revealObserver.observe(el));

            // 2. Animated Number Counter
            const counters = document.querySelectorAll('.counter');
            const counterObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const target = +entry.target.getAttribute('data-target');
                        const duration = 1400;
                        const stepTime = 20;
                        const steps = duration / stepTime;
                        const increment = target / steps;
                        let current = 0;

                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= target) {
                                entry.target.textContent = target.toLocaleString('id-ID');
                                clearInterval(timer);
                            } else {
                                entry.target.textContent = Math.floor(current).toLocaleString('id-ID');
                            }
                        }, stepTime);

                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.3 });

            counters.forEach(counter => counterObserver.observe(counter));
        });
    </script>

</body>
</html>