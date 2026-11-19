<x-app-layout>
    @php
        $belumCount = $anakBelumDitimbang->count();
        $sudahCount = max(0, $totalAnak - $belumCount);
        $persentaseCapaian = $totalAnak > 0 ? round(($sudahCount / $totalAnak) * 100) : 100;
    @endphp

    <div class="space-y-6">
        {{-- 1. EXECUTIVE HEADER BANNER KADER --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-primary-950 to-primary-900 p-6 sm:p-8 text-white shadow-lg border border-primary-800/50">
            <div class="pointer-events-none absolute -right-12 -top-12 h-56 w-56 rounded-full bg-emerald-400/15 blur-2xl"></div>
            <div class="pointer-events-none absolute right-28 -bottom-16 h-48 w-48 rounded-full bg-amber-400/15 blur-2xl"></div>

            <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 backdrop-blur-xs text-xs font-semibold text-emerald-300 mb-3">
                        <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        {{ Auth::user()->posyandu->nama ?? 'Unit Layanan Posyandu' }}
                        @if(Auth::user()->posyandu?->desa)
                            • Desa {{ Auth::user()->posyandu->desa->nama }}
                        @endif
                    </div>
                    <h2 class="font-extrabold text-2xl sm:text-3xl tracking-tight text-white">
                        Dashboard Kader
                    </h2>
                    <p class="text-sm sm:text-base text-slate-300 mt-1.5 max-w-2xl">
                        Selamat datang, <strong class="text-white font-semibold">{{ Auth::user()->name }}</strong>. Pantau target penimbangan bulanan dan status pemeriksaan balita di Posyandu Anda.
                    </p>
                </div>

                {{-- Mini Progress Card di Banner --}}
                <div class="bg-white/10 border border-white/15 backdrop-blur-xs rounded-2xl p-4 sm:min-w-[240px] shrink-0">
                    <div class="flex items-center justify-between text-xs font-semibold text-slate-200 mb-2">
                        <span>Capaian Bulan Ini</span>
                        <span class="text-emerald-300 font-extrabold tabular-nums">{{ $persentaseCapaian }}%</span>
                    </div>
                    <div class="w-full h-2.5 bg-slate-900/60 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-emerald-400 to-teal-300 rounded-full transition-all duration-500"
                             style="width: {{ $persentaseCapaian }}%"></div>
                    </div>
                    <p class="text-[11px] text-slate-300 mt-2 tabular-nums">
                        {{ $sudahCount }} dari {{ $totalAnak }} anak sudah ditimbang
                    </p>
                </div>
            </div>
        </div>

        {{-- 2. KARTU STATISTIK BENTO --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Total Anak --}}
            <div class="bg-white p-6 rounded-3xl shadow-xs border border-slate-200/90 flex items-start justify-between hover:border-primary-300 transition-colors">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Anak di Posyandu Anda</p>
                    <p class="text-4xl font-extrabold text-slate-900 mt-2 tabular-nums">
                        {{ $totalAnak }} <span class="text-base font-semibold text-slate-400">Anak</span>
                    </p>
                    <p class="text-xs text-emerald-700 font-semibold mt-2 inline-flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        {{ $sudahCount }} anak sudah diperiksa bulan ini
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-primary-50 border border-primary-100 text-primary-700 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                    </svg>
                </div>
            </div>

            {{-- Belum Ditimbang Bulan Ini --}}
            <div class="bg-white p-6 rounded-3xl shadow-xs border {{ $belumCount > 0 ? 'border-rose-200/90 hover:border-rose-300' : 'border-emerald-200/90' }} flex items-start justify-between transition-colors">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider {{ $belumCount > 0 ? 'text-rose-700' : 'text-emerald-700' }}">
                        Belum Ditimbang Bulan Ini
                    </p>
                    <p class="text-4xl font-extrabold {{ $belumCount > 0 ? 'text-rose-600' : 'text-emerald-600' }} mt-2 tabular-nums">
                        {{ $belumCount }} <span class="text-base font-semibold text-slate-400">Anak</span>
                    </p>
                    <p class="text-xs text-slate-500 mt-2">
                        {{ $belumCount > 0 ? 'Menunggu pemeriksaan antropometri & gizi' : 'Seluruh sasaran balita telah terlayani' }}
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl {{ $belumCount > 0 ? 'bg-rose-50 border-rose-200/80 text-rose-600' : 'bg-emerald-50 border-emerald-200/80 text-emerald-600' }} border flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- 3. TABEL DAFTAR TUNGGU PENIMBANGAN --}}
        <div class="bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden">
            {{-- Header Tabel + Search & Link Semua Anak --}}
            <div class="p-6 border-b border-slate-100 bg-slate-50/70 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2.5">
                        <h3 class="font-bold text-lg text-slate-900">Daftar Tunggu Penimbangan</h3>
                        @if($belumCount > 0)
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-rose-100 text-rose-800 tabular-nums">
                                {{ $belumCount }} Antrean
                            </span>
                        @endif
                    </div>
                    <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Daftar balita yang belum dilakukan penimbangan pada bulan berjalan.</p>
                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                    {{-- Pencarian Cepat --}}
                    <div class="relative w-full sm:w-64">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>
                        <input type="text"
                               id="kaderQueueSearchInput"
                               placeholder="Cari nama anak / orang tua..."
                               class="w-full pl-10 pr-4 py-2 text-sm bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                    </div>

                    <a href="{{ route('kader.anak.index') }}"
                       class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-xl bg-white hover:bg-primary-50 text-primary-700 border border-slate-200 hover:border-primary-200 font-bold text-sm transition-all shrink-0">
                        <span>Lihat Semua Anak</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
                        <tr>
                            <th class="py-3.5 px-6">Nama Anak</th>
                            <th class="py-3.5 px-6">Usia</th>
                            <th class="py-3.5 px-6">Orang Tua / Wali</th>
                            <th class="py-3.5 px-6 text-right">Aksi Pelayanan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($anakBelumDitimbang as $anak)
                            <tr class="kader-queue-row group hover:bg-slate-50/90 transition-colors">
                                {{-- Nama Anak + Avatar Inisial --}}
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3.5">
                                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-100 to-emerald-100 text-primary-800 font-bold text-xs flex items-center justify-center shrink-0 border border-primary-200/60">
                                            {{ strtoupper(substr($anak->nama, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900 group-hover:text-primary-700 transition-colors">
                                                {{ $anak->nama }}
                                            </p>
                                            <p class="text-xs text-amber-700 font-medium mt-0.5">Belum ditimbang bulan ini</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Usia --}}
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-semibold text-xs tabular-nums">
                                        {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->diffForHumans(null, true) }}
                                    </span>
                                </td>

                                {{-- Orang Tua --}}
                                <td class="py-4 px-6 text-slate-700 font-medium">
                                    {{ $anak->orangtua->name ?? '-' }}
                                </td>

                                {{-- Tombol Aksi --}}
                                <td class="py-4 px-6 text-right">
                                    <a href="{{ route('kader.pemeriksaan.create', $anak->id) }}"
                                       class="inline-flex items-center justify-center gap-1.5 bg-gradient-to-r from-primary-700 via-primary-600 to-emerald-600 hover:from-primary-800 hover:to-emerald-700 text-white text-xs sm:text-sm font-bold py-2 px-4 rounded-xl shadow-xs transition-all hover:-translate-y-0.5">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                        Timbang Sekarang
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-14 px-6 text-center">
                                    <div class="mx-auto w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-200/80 flex items-center justify-center mb-3">
                                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </div>
                                    <p class="font-extrabold text-slate-900 text-base">Hebat! Target Penimbangan Tercapai</p>
                                    <p class="text-xs sm:text-sm text-slate-500 mt-1">Semua anak terdaftar di Posyandu Anda sudah ditimbang bulan ini.</p>
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
            const searchInput = document.getElementById('kaderQueueSearchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    const keyword = this.value.toLowerCase().trim();
                    document.querySelectorAll('.kader-queue-row').forEach(row => {
                        row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
                    });
                });
            }
        });
    </script>
</x-app-layout>