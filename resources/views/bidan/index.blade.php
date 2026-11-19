<x-app-layout>
    @php
        $totalKasus = ($totalStunting ?? 0) + ($totalIbuRisiko ?? 0);
    @endphp

    <div class="space-y-6">
        {{-- 1. EXECUTIVE HEADER BANNER --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-primary-950 to-primary-900 p-6 sm:p-8 text-white shadow-lg border border-primary-800/50">
            <div class="pointer-events-none absolute -right-12 -top-12 h-56 w-56 rounded-full bg-emerald-400/15 blur-2xl"></div>
            <div class="pointer-events-none absolute right-28 -bottom-16 h-48 w-48 rounded-full bg-amber-400/15 blur-2xl"></div>

            <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 backdrop-blur-xs text-xs font-semibold text-emerald-300 mb-3">
                        <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Desa Binaan: {{ Auth::user()->desa->nama ?? 'Wilayah Kerja Bidan' }}
                    </div>
                    <h2 class="font-extrabold text-2xl sm:text-3xl tracking-tight text-white">
                        Dashboard Bidan
                    </h2>
                    <p class="text-sm sm:text-base text-slate-300 mt-1.5 max-w-2xl">
                        Pantauan klinis kesehatan ibu dan anak, deteksi dini kasus stunting, serta tindak lanjut rujukan medis desa binaan.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    {{-- Mini Counter Prioritas --}}
                    <div class="px-4 py-2.5 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-xs">
                        <p class="text-[11px] uppercase tracking-wider font-semibold text-slate-300">Perlu Tindak Lanjut</p>
                        <p class="text-xl font-extrabold {{ $totalKasus > 0 ? 'text-amber-300' : 'text-emerald-300' }} tabular-nums mt-0.5">
                            {{ $totalKasus }} <span class="text-xs font-normal text-slate-300">Kasus Prioritas</span>
                        </p>
                    </div>

                    <a href="{{ route('bidan.kasus.index') }}"
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-slate-950 font-bold text-sm px-5 py-3.5 rounded-2xl shadow-md shadow-emerald-950/30 transition-all duration-200 hover:-translate-y-0.5">
                        <svg class="w-4 h-4 stroke-[2.4]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25Z" />
                        </svg>
                        Buka Daftar Kasus
                    </a>
                </div>
            </div>
        </div>

        {{-- 2. BENTO KPI CARDS (PANTAUAN KLINIS DESA) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- KPI 1: Anak Terdeteksi Stunting --}}
            <div class="group relative overflow-hidden bg-white rounded-3xl p-6 sm:p-7 shadow-xs border border-slate-200/90 hover:border-rose-300 transition-all">
                <div class="pointer-events-none absolute -right-8 -top-8 h-32 w-32 rounded-full bg-rose-500/10 blur-2xl"></div>

                <div class="relative flex items-start justify-between gap-4">
                    <div>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-extrabold uppercase tracking-wider bg-rose-50 text-rose-700 border border-rose-200/80">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 {{ $totalStunting > 0 ? 'animate-pulse' : '' }}"></span>
                            Intervensi Gizi Balita
                        </span>
                        <h3 class="text-slate-600 text-sm font-bold mt-3">
                            Anak Terdeteksi Stunting
                        </h3>
                        <p class="text-4xl sm:text-5xl font-extrabold text-slate-900 tabular-nums mt-2">
                            {{ $totalStunting }}
                            <span class="text-base font-semibold text-slate-400">Anak</span>
                        </p>
                        <p class="text-xs text-slate-500 mt-2">
                            Balita dengan indikator TB/U di bawah standar yang memerlukan pemantauan klinis.
                        </p>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-rose-500 to-red-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-rose-500/20">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- KPI 2: Ibu Hamil Risiko Tinggi --}}
            <div class="group relative overflow-hidden bg-white rounded-3xl p-6 sm:p-7 shadow-xs border border-slate-200/90 hover:border-amber-300 transition-all">
                <div class="pointer-events-none absolute -right-8 -top-8 h-32 w-32 rounded-full bg-amber-500/10 blur-2xl"></div>

                <div class="relative flex items-start justify-between gap-4">
                    <div>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-extrabold uppercase tracking-wider bg-amber-50 text-amber-800 border border-amber-200/80">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 {{ $totalIbuRisiko > 0 ? 'animate-pulse' : '' }}"></span>
                            Pengawasan Maternal
                        </span>
                        <h3 class="text-slate-600 text-sm font-bold mt-3">
                            Ibu Hamil Risiko Tinggi
                        </h3>
                        <p class="text-4xl sm:text-5xl font-extrabold text-slate-900 tabular-nums mt-2">
                            {{ $totalIbuRisiko }}
                            <span class="text-base font-semibold text-slate-400">Ibu</span>
                        </p>
                        <p class="text-xs text-slate-500 mt-2">
                            Ibu hamil dengan faktor risiko kehamilan (KEK, usia risiko, atau riwayat obstetri).
                        </p>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-500 to-orange-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-amber-500/20">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. PANEL TINDAK LANJUT MEDIS & KONSULTASI --}}
        <div class="bg-white rounded-3xl shadow-xs border border-slate-200/90 p-6 sm:p-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-primary-50 text-primary-700 border border-primary-100 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-lg text-slate-900">Tindak Lanjut Medis & Advis Klinis</h3>
                        <p class="text-sm text-slate-500 mt-1 max-w-2xl">
                            Tinjau rincian hasil penimbangan balita stunting maupun ibu hamil berisiko tinggi, kemudian berikan catatan medis, rekomendasi PMT, atau instruksi rujukan Puskesmas.
                        </p>
                    </div>
                </div>

                <a href="{{ route('bidan.kasus.index') }}"
                   class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-primary-700 via-primary-600 to-emerald-600 hover:from-primary-800 hover:to-emerald-700 text-white font-bold text-sm py-3 px-6 rounded-xl shadow-sm transition-all hover:-translate-y-0.5 shrink-0">
                    <span>Buka Daftar Kasus</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>