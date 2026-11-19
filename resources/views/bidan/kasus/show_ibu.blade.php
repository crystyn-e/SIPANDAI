<x-app-layout>
    @php
        $isNormal = $ibuHamil->status_risiko === 'Normal';
        $hplDate = $ibuHamil->hpl ? \Carbon\Carbon::parse($ibuHamil->hpl) : null;
        $hphtDate = $ibuHamil->hpht ? \Carbon\Carbon::parse($ibuHamil->hpht) : null;
        $isKek = $ibuHamil->lingkar_lengan_atas && $ibuHamil->lingkar_lengan_atas < 23.5;
        $isShortStature = $ibuHamil->tinggi_badan && $ibuHamil->tinggi_badan < 145;
    @endphp

    <div class="space-y-6">
        {{-- 1. BREADCRUMB & EXECUTIVE HEADER BANNER --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-primary-950 to-primary-900 p-6 sm:p-8 text-white shadow-lg border border-primary-800/50">
            <div class="pointer-events-none absolute -right-12 -top-12 h-56 w-56 rounded-full bg-emerald-400/15 blur-2xl"></div>
            <div class="pointer-events-none absolute right-28 -bottom-16 h-48 w-48 rounded-full bg-amber-400/15 blur-2xl"></div>

            <div class="relative">
                {{-- Breadcrumb Navigasi --}}
                <nav class="flex items-center gap-2 text-xs font-medium text-slate-300 mb-4">
                    <a href="{{ route('bidan.kasus.index') }}" class="hover:text-emerald-300 transition-colors inline-flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        Daftar Kasus Prioritas
                    </a>
                    <span class="text-slate-500">/</span>
                    <span class="text-emerald-300 font-semibold">Rekam Medis Ibu Hamil</span>
                </nav>

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    {{-- Identitas Pasien --}}
                    <div class="flex items-start sm:items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-white/10 border border-white/20 backdrop-blur-xs {{ $isNormal ? 'text-emerald-300' : 'text-amber-300' }} font-extrabold text-xl flex items-center justify-center shrink-0 shadow-sm">
                            {{ strtoupper(substr($ibuHamil->nama, 0, 2)) }}
                        </div>
                        <div>
                            <div class="flex flex-wrap items-center gap-2 mb-1.5">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-white/10 border border-white/15 text-[11px] font-semibold {{ $isNormal ? 'text-emerald-300' : 'text-amber-300' }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $isNormal ? 'bg-emerald-400' : 'bg-amber-400 animate-pulse' }}"></span>
                                    {{ $isNormal ? 'Kehamilan Normal' : 'Pengawasan Risiko Maternal' }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-white/10 border border-white/15 text-[11px] font-mono font-semibold text-slate-200 tabular-nums">
                                    NIK: {{ $ibuHamil->nik }}
                                </span>
                            </div>

                            <h2 class="font-extrabold text-2xl sm:text-3xl tracking-tight text-white">
                                Detail Ibu Hamil: {{ $ibuHamil->nama }}
                            </h2>

                            <p class="text-xs sm:text-sm text-slate-300 mt-1">
                                Umur: <strong class="text-white font-semibold tabular-nums">{{ $ibuHamil->umur }} Tahun</strong>
                                @if($ibuHamil->nama_suami)
                                    • Suami: <strong class="text-white font-semibold">{{ $ibuHamil->nama_suami }}</strong>
                                @endif
                                @if($ibuHamil->no_hp)
                                    • Kontak: <strong class="text-emerald-300 font-semibold tabular-nums">{{ $ibuHamil->no_hp }}</strong>
                                @endif
                            </p>
                        </div>
                    </div>

                    {{-- CTA Beri Catatan Medis --}}
                    <div class="shrink-0">
                        <a href="{{ route('bidan.kasus.catatan-ibu', $ibuHamil->id) }}"
                           class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-slate-950 font-bold text-sm px-5 py-3.5 rounded-2xl shadow-md shadow-emerald-950/30 transition-all duration-200 hover:-translate-y-0.5">
                            <svg class="w-4 h-4 stroke-[2.4]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                            </svg>
                            Beri Catatan Medis
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. ALERT NOTIFIKASI SUKSES (JIKA ADA) --}}
        @if(session('success'))
            <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200/90 text-emerald-900 px-5 py-4 rounded-2xl shadow-2xs">
                <div class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-emerald-700">Berhasil</p>
                    <p class="text-sm font-medium text-slate-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        {{-- 3. BENTO SUMMARY CARDS (SNAPSHOT KLINIS KEHAMILAN) --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            {{-- Status Risiko --}}
            <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Status Risiko</p>
                <div class="mt-2">
                    @if($isNormal)
                        <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-800 border border-emerald-200/90 px-3 py-1 rounded-full text-xs font-extrabold uppercase">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            NORMAL
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-800 border border-rose-200/90 px-3 py-1 rounded-full text-xs font-extrabold uppercase">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                            {{ $ibuHamil->status_risiko }}
                        </span>
                    @endif
                </div>
                <p class="text-xs text-slate-400 mt-2">Klasifikasi faktor risiko KIA</p>
            </div>

            {{-- HPL --}}
            <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Perkiraan Lahir (HPL)</p>
                <p class="text-lg sm:text-xl font-extrabold text-slate-900 tabular-nums mt-1">
                    {{ $hplDate ? $hplDate->format('d M Y') : '-' }}
                </p>
                <p class="text-xs {{ $hplDate && $hplDate->isFuture() ? 'text-primary-600 font-semibold' : 'text-slate-400' }} mt-1">
                    {{ $hplDate ? $hplDate->diffForHumans() : 'HPHT belum dicatat' }}
                </p>
            </div>

            {{-- Status Obstetri (GPA) --}}
            <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Status Obstetri (GPA)</p>
                <p class="text-xl sm:text-2xl font-extrabold text-primary-800 tabular-nums mt-1">
                    G{{ $ibuHamil->gravida ?? 0 }} P{{ $ibuHamil->para ?? 0 }} A{{ $ibuHamil->abortus ?? 0 }}
                </p>
                <p class="text-xs text-slate-400 mt-1">Gravida • Para • Abortus</p>
            </div>

            {{-- LILA --}}
            <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Lingkar Lengan (LILA)</p>
                <p class="text-xl sm:text-2xl font-extrabold {{ $isKek ? 'text-rose-600' : 'text-slate-900' }} tabular-nums mt-1">
                    {{ $ibuHamil->lingkar_lengan_atas ? $ibuHamil->lingkar_lengan_atas : '-' }}
                    @if($ibuHamil->lingkar_lengan_atas) <span class="text-xs font-semibold text-slate-500">cm</span> @endif
                </p>
                <p class="text-xs {{ $isKek ? 'text-rose-600 font-bold' : 'text-slate-400' }} mt-1">
                    {{ $isKek ? 'Indikasi KEK (< 23.5 cm)' : 'Ambang normal ≥ 23.5 cm' }}
                </p>
            </div>
        </div>

        {{-- 4. DETAIL INFORMASI KEHAMILAN & KELUARGA (2 KOLOM) --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            {{-- Kolom Kiri (7 Kolom): Data Klinis & Antropometri --}}
            <div class="lg:col-span-7 bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/70 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-slate-900">Informasi Klinis Kehamilan</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Data riwayat obstetri, hari perkiraan lahir, dan pengukuran fisik.</p>
                    </div>
                    <span class="w-9 h-9 rounded-xl bg-primary-50 text-primary-700 border border-primary-100 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </span>
                </div>

                <div class="divide-y divide-slate-100 text-sm">
                    <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Status Risiko</span>
                        <div>
                            @if($isNormal)
                                <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-800 border border-emerald-200/90 px-3 py-1 rounded-full text-xs font-extrabold uppercase">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    NORMAL
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-800 border border-rose-200/90 px-3 py-1 rounded-full text-xs font-extrabold uppercase">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                    {{ $ibuHamil->status_risiko }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">HPHT (Hari Pertama Haid Terakhir)</span>
                        <span class="font-bold text-slate-900 tabular-nums">
                            {{ $hphtDate ? $hphtDate->format('d F Y') : '-' }}
                        </span>
                    </div>

                    <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">HPL (Hari Perkiraan Lahir)</span>
                        <span class="font-bold text-primary-700 tabular-nums">
                            {{ $hplDate ? $hplDate->format('d F Y') : '-' }}
                        </span>
                    </div>

                    <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Gravida / Para / Abortus</span>
                        <span class="font-extrabold text-slate-900 tabular-nums">
                            {{ $ibuHamil->gravida }} / {{ $ibuHamil->para }} / {{ $ibuHamil->abortus }}
                        </span>
                    </div>

                    <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">LILA (Lingkar Lengan Atas)</span>
                        <span class="font-bold {{ $isKek ? 'text-rose-600' : 'text-slate-900' }} tabular-nums">
                            {{ $ibuHamil->lingkar_lengan_atas ? $ibuHamil->lingkar_lengan_atas . ' cm' : '-' }}
                        </span>
                    </div>

                    <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Tinggi Badan</span>
                        <span class="font-bold {{ $isShortStature ? 'text-amber-700' : 'text-slate-900' }} tabular-nums">
                            {{ $ibuHamil->tinggi_badan ? $ibuHamil->tinggi_badan . ' cm' : '-' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan (5 Kolom): Identitas Keluarga & Catatan Bidan --}}
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/70">
                        <h3 class="font-bold text-slate-900">Identitas & Kontak Pendamping</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Informasi komunikasi keluarga untuk tindak lanjut.</p>
                    </div>

                    <div class="divide-y divide-slate-100 text-sm">
                        <div class="px-6 py-4 flex items-center justify-between gap-4">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Nama Suami</span>
                            <span class="font-bold text-slate-900 text-right">{{ $ibuHamil->nama_suami ?? '-' }}</span>
                        </div>

                        <div class="px-6 py-4 flex items-center justify-between gap-4">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-500">No. HP / WhatsApp</span>
                            <span class="font-bold text-slate-900 tabular-nums text-right">{{ $ibuHamil->no_hp ?? '-' }}</span>
                        </div>

                        <div class="px-6 py-4 flex items-center justify-between gap-4">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-500">NIK Ibu</span>
                            <span class="font-mono text-xs font-semibold text-slate-700 tabular-nums">{{ $ibuHamil->nik }}</span>
                        </div>
                    </div>
                </div>

                {{-- Panel Catatan Medis Terakhir (jika kolom catatan_medis tersedia pada model) --}}
                <div class="bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/70 flex items-center justify-between">
                        <div>
                            <h3 class="font-bold text-slate-900">Catatan Intervensi Bidan</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Advis klinis terakhir yang tercatat.</p>
                        </div>
                    </div>
                    <div class="p-6">
                        @if(!empty($ibuHamil->catatan_medis))
                            <div class="bg-emerald-50/60 border border-emerald-200/80 rounded-2xl p-4 text-sm text-slate-800 leading-relaxed">
                                {{ $ibuHamil->catatan_medis }}
                            </div>
                        @else
                            <div class="text-center py-4">
                                <p class="text-xs text-slate-400 italic">Belum ada catatan medis yang ditambahkan untuk pasien ini.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>