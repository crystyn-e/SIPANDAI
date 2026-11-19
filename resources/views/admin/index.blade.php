<x-app-layout>
    <div class="space-y-6">
        {{-- 1. EXECUTIVE HEADER & QUICK ACTION --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-primary-950 to-primary-900 p-6 sm:p-8 text-white shadow-lg border border-primary-800/50">
            {{-- Dekorasi Latar Abstrak Civic-Tech --}}
            <div class="pointer-events-none absolute -right-12 -top-12 h-56 w-56 rounded-full bg-emerald-400/15 blur-2xl"></div>
            <div class="pointer-events-none absolute right-24 -bottom-16 h-48 w-48 rounded-full bg-amber-400/15 blur-2xl"></div>

            <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 backdrop-blur-xs text-xs font-semibold text-emerald-300 mb-3">
                        <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Sistem Informasi Posyandu & Kesehatan Terpadu
                    </div>
                    <h2 class="font-extrabold text-2xl sm:text-3xl tracking-tight text-white">
                        Dashboard Admin Kecamatan
                    </h2>
                    <p class="text-sm sm:text-base text-slate-300 mt-1.5 max-w-2xl">
                        Pantau indikator tumbuh kembang balita, deteksi dini stunting, dan sebaran layanan Posyandu secara real-time.
                    </p>
                </div>

                {{-- Tombol Aksi Utama (Dipindahkan dari grid bawah agar simetris) --}}
                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    <a href="{{ route('admin.wilayah.create') }}"
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-slate-950 font-bold text-sm px-5 py-3 rounded-2xl shadow-md shadow-emerald-950/30 transition-all duration-200 hover:-translate-y-0.5">
                        <svg class="w-4 h-4 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Wilayah
                    </a>
                </div>
            </div>
        </div>

        {{-- 2. NOTIFIKASI PENDING VERIFIKASI --}}
        @if($pendingUsers->count() > 0)
            <div class="relative overflow-hidden bg-gradient-to-r from-amber-50 via-orange-50/70 to-white border border-amber-200/90 rounded-2xl p-4 sm:px-6 shadow-xs">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-start sm:items-center gap-3.5">
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 text-white flex items-center justify-center shadow-sm">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold uppercase tracking-wider text-amber-700">Perlu Tindakan</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-amber-200/80 text-amber-950">
                                    {{ $pendingUsers->count() }} Antrean
                                </span>
                            </div>
                            <p class="text-sm text-slate-700 mt-0.5">
                                Terdapat <strong class="font-bold text-slate-900">{{ $pendingUsers->count() }} akun Orang Tua</strong> baru yang menunggu persetujuan akses Buku KIA Digital.
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('admin.users.index') }}"
                       class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs sm:text-sm font-bold shadow-xs transition-all shrink-0">
                        Verifikasi Sekarang
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        @endif

        {{-- 3. KARTU STATISTIK UTAMA (4 BENTO KPI CARDS) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
            {{-- KPI 1: Total Anak --}}
            <div class="group relative overflow-hidden bg-white p-6 rounded-2xl border border-slate-200/90 shadow-xs hover:shadow-md hover:border-primary-300 transition-all duration-200 hover:-translate-y-0.5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Anak Terdata</p>
                        <p class="text-3xl font-extrabold text-slate-900 tabular-nums tracking-tight mt-2">
                            {{ $totalAnak }}
                        </p>
                    </div>
                    <div class="w-11 h-11 rounded-2xl bg-primary-50 text-primary-700 border border-primary-100 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                    <span class="text-slate-500">Sasaran balita terdaftar</span>
                    <span class="font-semibold text-primary-700">Aktif</span>
                </div>
            </div>

            {{-- KPI 2: Kasus Stunting --}}
            <div class="group relative overflow-hidden bg-white p-6 rounded-2xl border border-slate-200/90 shadow-xs hover:shadow-md hover:border-rose-300 transition-all duration-200 hover:-translate-y-0.5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Kasus Stunting</p>
                        <p class="text-3xl font-extrabold text-rose-600 tabular-nums tracking-tight mt-2">
                            {{ $totalStunting }}
                        </p>
                    </div>
                    <div class="w-11 h-11 rounded-2xl bg-rose-50 text-rose-600 border border-rose-100 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                    <span class="text-slate-500">Prioritas intervensi gizi</span>
                    <span class="inline-flex items-center gap-1 font-semibold text-rose-600">
                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Pantauan
                    </span>
                </div>
            </div>

            {{-- KPI 3: Ibu Hamil --}}
            <div class="group relative overflow-hidden bg-white p-6 rounded-2xl border border-slate-200/90 shadow-xs hover:shadow-md hover:border-emerald-300 transition-all duration-200 hover:-translate-y-0.5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Ibu Hamil</p>
                        <p class="text-3xl font-extrabold text-emerald-700 tabular-nums tracking-tight mt-2">
                            {{ $totalIbuHamil }}
                        </p>
                    </div>
                    <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                    <span class="text-slate-500">Pemantauan kehamilan</span>
                    <span class="font-semibold text-emerald-600">Tercatat</span>
                </div>
            </div>

            {{-- KPI 4: Total Posyandu --}}
            <div class="group relative overflow-hidden bg-white p-6 rounded-2xl border border-slate-200/90 shadow-xs hover:shadow-md hover:border-amber-300 transition-all duration-200 hover:-translate-y-0.5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Posyandu</p>
                        <p class="text-3xl font-extrabold text-amber-700 tabular-nums tracking-tight mt-2">
                            {{ $totalPosyandu }}
                        </p>
                    </div>
                    <div class="w-11 h-11 rounded-2xl bg-amber-50 text-amber-600 border border-amber-100 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                    <span class="text-slate-500">Unit pelayanan desa</span>
                    <span class="font-semibold text-amber-700">Beroperasi</span>
                </div>
            </div>
        </div>

        {{-- 4. GRID KONTEN UTAMA (TABEL STUNTING & PANEL SDM KESEHATAN) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            {{-- Kolom Kiri (2/3): Tabel Laporan Stunting Terbaru --}}
            <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-200/80 bg-slate-50/70 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="font-bold text-lg text-slate-900">Temuan Stunting Terbaru</h3>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-100 text-rose-700">
                                Terkini
                            </span>
                        </div>
                        <p class="text-xs text-slate-500 mt-0.5">Daftar balita hasil pemeriksaan terakhir dengan indikasi stunting.</p>
                    </div>

                    <a href="{{ route('admin.laporan.stunting.pdf') }}"
                       class="inline-flex items-center justify-center gap-2 text-xs sm:text-sm font-bold text-slate-800 bg-white hover:bg-slate-50 border border-slate-300/90 px-4 py-2.5 rounded-xl shadow-2xs transition-all shrink-0">
                        <svg class="w-4 h-4 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        Download Laporan
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
                            <tr>
                                <th class="py-3.5 px-6">Identitas Anak</th>
                                <th class="py-3.5 px-6">Posyandu & Desa</th>
                                <th class="py-3.5 px-6 text-right">Status Gizi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($anakStuntings as $periksa)
                                <tr class="group hover:bg-slate-50/90 transition-colors">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            {{-- Avatar Inisial Otomatis --}}
                                            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary-100 to-emerald-100 text-primary-800 font-bold text-xs flex items-center justify-center shrink-0 border border-primary-200/60">
                                                {{ strtoupper(substr($periksa->anak->nama, 0, 2)) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-slate-900 group-hover:text-primary-700 transition-colors">
                                                    {{ $periksa->anak->nama }}
                                                </p>
                                                <p class="text-xs text-slate-400">Balita Terdaftar</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <p class="font-semibold text-slate-700">{{ $periksa->anak->posyandu->nama ?? '-' }}</p>
                                        <p class="text-xs text-slate-400 mt-0.5">Desa {{ $periksa->anak->desa->nama ?? '-' }}</p>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-700 border border-rose-200/90 px-3 py-1 rounded-full text-xs font-bold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                            STUNTING
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-12 px-6 text-center">
                                        <div class="mx-auto w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-3">
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </div>
                                        <p class="font-bold text-slate-800 text-sm">Tidak Ada Temuan Stunting Terbaru</p>
                                        <p class="text-xs text-slate-500 mt-1">Seluruh data pemeriksaan terbaru dalam kondisi terpantau baik.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Kolom Kanan (1/3): Tenaga Kesehatan & Manajemen SDM --}}
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs p-6">
                <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-100">
                    <div>
                        <h3 class="font-bold text-lg text-slate-900">Tenaga Kesehatan</h3>
                        <p class="text-xs text-slate-500 mt-0.5">SDM pelaksana layanan Posyandu</p>
                    </div>
                    <div class="w-9 h-9 rounded-xl bg-primary-50 text-primary-700 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                    </div>
                </div>

                <div class="space-y-3.5 mb-6">
                    {{-- Item Kader --}}
                    <div class="flex items-center justify-between p-4 rounded-2xl bg-gradient-to-r from-primary-50/80 to-emerald-50/50 border border-primary-100">
                        <div class="flex items-center gap-3">
                            <span class="w-2.5 h-2.5 rounded-full bg-primary-600"></span>
                            <div>
                                <p class="text-sm font-bold text-slate-800">Total Kader</p>
                                <p class="text-[11px] text-slate-500">Relawan aktif desa</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 rounded-xl bg-white text-primary-800 font-extrabold text-sm shadow-2xs border border-primary-100 tabular-nums">
                            {{ $totalKader }} Orang
                        </span>
                    </div>

                    {{-- Item Bidan --}}
                    <div class="flex items-center justify-between p-4 rounded-2xl bg-gradient-to-r from-amber-50/80 to-orange-50/40 border border-amber-100">
                        <div class="flex items-center gap-3">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                            <div>
                                <p class="text-sm font-bold text-slate-800">Total Bidan</p>
                                <p class="text-[11px] text-slate-500">Tenaga medis pembina</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 rounded-xl bg-white text-amber-800 font-extrabold text-sm shadow-2xs border border-amber-100 tabular-nums">
                            {{ $totalBidan }} Orang
                        </span>
                    </div>
                </div>

                <a href="{{ route('admin.users.create') }}"
                   class="w-full inline-flex items-center justify-center gap-2 bg-slate-900 hover:bg-primary-900 text-white font-semibold text-sm py-3 px-4 rounded-xl shadow-xs transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                    </svg>
                    Tambah Tenaga Kesehatan
                </a>
            </div>
        </div>
    </div>
</x-app-layout>