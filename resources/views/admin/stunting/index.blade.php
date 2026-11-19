<x-app-layout>
    <div class="space-y-6">
        {{-- 1. EXECUTIVE HEADER BANNER --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-primary-950 to-primary-900 p-6 sm:p-8 text-white shadow-lg border border-primary-800/50 print:bg-white print:text-slate-900 print:shadow-none print:border-slate-300">
            <div class="pointer-events-none absolute -right-12 -top-12 h-56 w-56 rounded-full bg-rose-500/15 blur-2xl print:hidden"></div>
            <div class="pointer-events-none absolute right-28 -bottom-16 h-48 w-48 rounded-full bg-amber-400/15 blur-2xl print:hidden"></div>

            <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 backdrop-blur-xs text-xs font-semibold text-rose-300 mb-3 print:hidden">
                        <span class="h-2 w-2 rounded-full bg-rose-400 animate-pulse"></span>
                        Pengawasan Prioritas Gizi
                    </div>
                    <h2 class="font-extrabold text-2xl sm:text-3xl tracking-tight text-white print:text-slate-900">
                        Monitoring Stunting
                    </h2>
                    <p class="text-sm sm:text-base text-slate-300 mt-1.5 max-w-2xl print:text-slate-600">
                        Daftar balita dengan indikasi status gizi stunting di seluruh unit Posyandu dan desa wilayah kecamatan.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    {{-- Ringkasan Kasus --}}
                    <div class="px-4 py-2.5 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-xs print:border-slate-300">
                        <p class="text-[11px] uppercase tracking-wider font-semibold text-slate-300 print:text-slate-500">Total Kasus</p>
                        <p class="text-xl font-extrabold text-rose-300 tabular-nums mt-0.5 print:text-rose-700">
                            {{ $anakStuntings->count() }} <span class="text-xs font-normal text-slate-300 print:text-slate-500">Anak</span>
                        </p>
                    </div>

                    {{-- Tombol Cetak Laporan --}}
                    <button onclick="window.print()"
                            class="print:hidden inline-flex items-center gap-2 bg-white hover:bg-slate-100 text-slate-900 font-bold text-sm px-5 py-3.5 rounded-2xl shadow-md transition-all duration-200 hover:-translate-y-0.5">
                        <svg class="w-4 h-4 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                        </svg>
                        Cetak Laporan
                    </button>
                </div>
            </div>
        </div>

        {{-- 2. TABEL DATA STUNTING --}}
        <div class="bg-white rounded-2xl shadow-xs border border-slate-200/90 overflow-hidden print:shadow-none print:border-slate-300">
            {{-- Toolbar Pencarian Instan --}}
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/70 flex flex-col sm:flex-row sm:items-center justify-between gap-4 print:hidden">
                <div class="flex items-center gap-2.5">
                    <h3 class="font-bold text-slate-900">Daftar Balita Terindikasi Stunting</h3>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-rose-100 text-rose-800 tabular-nums">
                        {{ $anakStuntings->count() }} Data
                    </span>
                </div>

                <div class="relative w-full sm:w-72">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <input type="text"
                           id="stuntingSearchInput"
                           placeholder="Cari nama anak, desa, orang tua..."
                           class="w-full pl-10 pr-4 py-2 text-sm bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
                        <tr>
                            <th class="py-3.5 px-6">Nama Anak</th>
                            <th class="py-3.5 px-6">Usia</th>
                            <th class="py-3.5 px-6">Desa / Posyandu</th>
                            <th class="py-3.5 px-6">Orang Tua</th>
                            <th class="py-3.5 px-6 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($anakStuntings as $anak)
                            <tr class="stunting-row group hover:bg-slate-50/90 transition-colors">
                                {{-- Nama Anak + Avatar Inisial --}}
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-rose-100 to-amber-100 text-rose-800 font-bold text-xs flex items-center justify-center shrink-0 border border-rose-200/60 print:hidden">
                                            {{ strtoupper(substr($anak->nama, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900 group-hover:text-primary-700 transition-colors">
                                                {{ $anak->nama }}
                                            </p>
                                            <p class="text-xs text-slate-400">Sasaran Intervensi</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Usia --}}
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-semibold text-xs tabular-nums">
                                        {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->diffForHumans(null, true) }}
                                    </span>
                                </td>

                                {{-- Desa & Posyandu --}}
                                <td class="py-4 px-6">
                                    <p class="font-semibold text-slate-800">{{ $anak->posyandu->desa->nama ?? '-' }}</p>
                                    <p class="text-xs text-slate-400 mt-0.5">{{ $anak->posyandu->nama ?? '-' }}</p>
                                </td>

                                {{-- Orang Tua --}}
                                <td class="py-4 px-6 text-slate-700 font-medium">
                                    {{ $anak->orangtua->name ?? '-' }}
                                </td>

                                {{-- Status --}}
                                <td class="py-4 px-6 text-right">
                                    <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-700 border border-rose-200/90 px-3 py-1 rounded-full text-xs font-bold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse print:hidden"></span>
                                        STUNTING
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-14 px-6 text-center">
                                    <div class="mx-auto w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-3">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </div>
                                    <p class="font-bold text-slate-800 text-sm">Tidak Ada Data Stunting Ditemukan</p>
                                    <p class="text-xs text-slate-500 mt-1">Seluruh balita terpantau berada dalam status gizi non-stunting.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- SCRIPT PENCARIAN INSTAN --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('stuntingSearchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    const keyword = this.value.toLowerCase().trim();
                    document.querySelectorAll('.stunting-row').forEach(row => {
                        row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
                    });
                });
            }
        });
    </script>
</x-app-layout>