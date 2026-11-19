<x-app-layout>
    <div class="space-y-6">
        {{-- 1. EXECUTIVE HEADER BANNER --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-primary-950 to-primary-900 p-6 sm:p-8 text-white shadow-lg border border-primary-800/50">
            <div class="pointer-events-none absolute -right-12 -top-12 h-56 w-56 rounded-full bg-emerald-400/15 blur-2xl"></div>
            <div class="pointer-events-none absolute right-28 -bottom-16 h-48 w-48 rounded-full bg-amber-400/15 blur-2xl"></div>

            <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 backdrop-blur-xs text-xs font-semibold text-emerald-300 mb-3">
                        <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                        Arsip & Pelaporan Resmi Kecamatan
                    </div>
                    <h2 class="font-extrabold text-2xl sm:text-3xl tracking-tight text-white">
                        Pusat Laporan & Rekapitulasi
                    </h2>
                    <p class="text-sm sm:text-base text-slate-300 mt-1.5 max-w-2xl">
                        Pantau ringkasan indikator kesehatan ibu dan anak serta unduh dokumen rekapitulasi resmi dalam format PDF siap cetak.
                    </p>
                </div>

                <div class="shrink-0">
                    <div class="inline-flex items-center gap-2.5 px-4 py-2.5 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-xs text-xs font-semibold text-slate-200">
                        <svg class="w-4 h-4 text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                        Format Standar DomPDF (A4)
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. KARTU STATISTIK RINGKAS (BENTO KPI CARDS) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            {{-- Total Anak --}}
            <div class="bg-white rounded-3xl shadow-xs border border-slate-200/90 p-6 flex items-start justify-between hover:border-primary-300 transition-colors">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Anak Terdaftar</p>
                    <p class="text-3xl font-extrabold text-slate-900 mt-2 tabular-nums">{{ $totalAnak }}</p>
                    <p class="text-xs text-slate-500 mt-1.5">Seluruh balita aktif di sistem</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-primary-50 border border-primary-100 text-primary-700 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                    </svg>
                </div>
            </div>

            {{-- Total Stunting --}}
            <div class="bg-white rounded-3xl shadow-xs border border-amber-200/90 p-6 flex items-start justify-between hover:border-amber-300 transition-colors">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-amber-800">Kasus Stunting Terdeteksi</p>
                    <p class="text-3xl font-extrabold text-amber-700 mt-2 tabular-nums">{{ $totalStunting }}</p>
                    <p class="text-xs text-slate-500 mt-1.5">Anak dengan riwayat status gizi stunting</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-200/80 text-amber-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                </div>
            </div>

            {{-- Total Posyandu --}}
            <div class="bg-white rounded-3xl shadow-xs border border-slate-200/90 p-6 flex items-start justify-between hover:border-emerald-300 transition-colors">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-emerald-800">Total Posyandu Aktif</p>
                    <p class="text-3xl font-extrabold text-emerald-700 mt-2 tabular-nums">{{ $totalPosyandu }}</p>
                    <p class="text-xs text-slate-500 mt-1.5">Unit posyandu terdaftar di kecamatan</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- 3. DAFTAR UNDUHAN LAPORAN PDF --}}
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-lg text-slate-900">Dokumen Laporan Resmi (PDF)</h3>
                    <p class="text-xs text-slate-500">Pilih jenis rekapitulasi yang ingin diunduh untuk keperluan arsip dan pelaporan.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Card PDF Stunting --}}
                <div class="group bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden flex flex-col justify-between hover:border-amber-300/90 hover:shadow-md transition-all duration-200">
                    <div class="p-6 sm:p-7">
                        <div class="flex items-start justify-between gap-4 mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-50 to-orange-100/80 border border-amber-200/80 text-amber-700 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                            </div>
                            <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-900 border border-amber-200/90 px-3 py-1 rounded-full text-xs font-extrabold tracking-wide">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                DOKUMEN PDF
                            </span>
                        </div>

                        <h4 class="text-lg font-extrabold text-slate-900 group-hover:text-amber-800 transition-colors">
                            Laporan Anak Stunting
                        </h4>
                        <p class="text-slate-600 text-sm leading-relaxed mt-2">
                            Rekapitulasi data balita yang terindikasi stunting lengkap dengan identitas orang tua, posyandu, serta desa.
                        </p>
                    </div>

                    <div class="px-6 sm:px-7 py-4 bg-slate-50/80 border-t border-slate-100 flex items-center justify-between gap-4">
                        <span class="text-xs font-semibold text-slate-500">Siap unduh & cetak</span>
                        <a href="{{ route('admin.laporan.stunting.pdf') }}"
                           class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-xs transition-all hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                            Download Laporan Stunting
                        </a>
                    </div>
                </div>

                {{-- Card PDF Ibu Hamil --}}
                <div class="group bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden flex flex-col justify-between hover:border-emerald-300/90 hover:shadow-md transition-all duration-200">
                    <div class="p-6 sm:p-7">
                        <div class="flex items-start justify-between gap-4 mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-50 to-primary-100/80 border border-emerald-200/80 text-emerald-700 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                            </div>
                            <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-900 border border-emerald-200/90 px-3 py-1 rounded-full text-xs font-extrabold tracking-wide">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                DOKUMEN PDF
                            </span>
                        </div>

                        <h4 class="text-lg font-extrabold text-slate-900 group-hover:text-emerald-800 transition-colors">
                            Laporan Data Ibu Hamil
                        </h4>
                        <p class="text-slate-600 text-sm leading-relaxed mt-2">
                            Rekapitulasi seluruh data ibu hamil yang terdaftar pada masing-masing unit posyandu dan wilayah desa.
                        </p>
                    </div>

                    <div class="px-6 sm:px-7 py-4 bg-slate-50/80 border-t border-slate-100 flex items-center justify-between gap-4">
                        <span class="text-xs font-semibold text-slate-500">Siap unduh & cetak</span>
                        <a href="{{ route('admin.laporan.ibu-hamil.pdf') }}"
                           class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-primary-700 via-primary-600 to-emerald-600 hover:from-primary-800 hover:to-emerald-700 text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-xs transition-all hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                            Download Laporan Ibu Hamil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>