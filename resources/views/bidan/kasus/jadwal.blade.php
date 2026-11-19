<x-app-layout>
    @php
        $totalJadwal = $jadwals->count();
        $mendatangCount = $jadwals->filter(function ($item) {
            return \Carbon\Carbon::parse($item->tanggal)->startOfDay()->gte(now()->startOfDay());
        })->count();
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
                        Desa: {{ Auth::user()->desa->nama ?? Auth::user()->posyandu?->desa?->nama ?? 'Wilayah Kerja Posyandu' }}
                    </div>
                    <h2 class="font-extrabold text-2xl sm:text-3xl tracking-tight text-white">
                        Jadwal Kegiatan Posyandu
                    </h2>
                    <p class="text-sm sm:text-base text-slate-300 mt-1.5 max-w-2xl">
                        Daftar jadwal penimbangan balita, layanan imunisasi, pemeriksaan ibu hamil, dan kegiatan penyuluhan di desa Anda.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    <div class="px-4 py-2.5 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-xs">
                        <p class="text-[11px] uppercase tracking-wider font-semibold text-slate-300">Agenda Mendatang</p>
                        <p class="text-xl font-extrabold text-emerald-300 tabular-nums mt-0.5">
                            {{ $mendatangCount }} <span class="text-xs font-normal text-slate-300">/ {{ $totalJadwal }} Kegiatan</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. TOOLBAR FILTER & PENCARIAN INSTAN --}}
        <div class="bg-white rounded-2xl shadow-2xs border border-slate-200/90 px-5 py-3.5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-2.5">
                <span class="w-8 h-8 rounded-xl bg-primary-50 text-primary-700 border border-primary-100 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                </span>
                <div>
                    <h3 class="font-bold text-sm text-slate-900">Agenda Pelayanan Desa</h3>
                    <p class="text-xs text-slate-500">Menampilkan {{ $totalJadwal }} jadwal kegiatan terdaftar</p>
                </div>
            </div>

            <div class="relative w-full sm:w-80">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
                <input type="text"
                       id="jadwalDesaSearchInput"
                       placeholder="Cari kegiatan, tanggal, atau Posyandu..."
                       class="w-full pl-10 pr-4 py-2 text-sm bg-slate-50/70 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
            </div>
        </div>

        {{-- 3. BENTO GRID KARTU JADWAL KEGIATAN --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($jadwals as $jadwal)
                @php
                    $tglKegiatan = \Carbon\Carbon::parse($jadwal->tanggal);
                    $isToday = $tglKegiatan->isToday();
                    $isUpcoming = $tglKegiatan->copy()->startOfDay()->gt(now()->startOfDay());
                @endphp

                <div class="jadwal-desa-card group relative overflow-hidden bg-white rounded-3xl shadow-xs border {{ $isToday ? 'border-emerald-300 ring-2 ring-emerald-500/15' : 'border-slate-200/90 hover:border-primary-300' }} p-6 flex flex-col justify-between transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
                    {{-- Accent Top Gradient Bar --}}
                    <div class="absolute inset-x-0 top-0 h-1.5 {{ $isToday ? 'bg-gradient-to-r from-emerald-500 to-teal-500' : ($isUpcoming ? 'bg-gradient-to-r from-primary-600 to-emerald-500' : 'bg-slate-200') }}"></div>

                    <div>
                        {{-- Tanggal & Status Badge --}}
                        <div class="flex items-center justify-between gap-2 mb-4 pt-1">
                            <span class="inline-flex items-center gap-1.5 bg-primary-50 text-primary-800 border border-primary-100 px-3 py-1 rounded-xl text-xs font-extrabold tabular-nums">
                                <svg class="w-3.5 h-3.5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>
                                {{ $tglKegiatan->format('d M Y') }}
                            </span>

                            @if($isToday)
                                <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200/90 px-2.5 py-1 rounded-full text-[11px] font-extrabold uppercase">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Hari Ini
                                </span>
                            @elseif($isUpcoming)
                                <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-800 border border-amber-200/90 px-2.5 py-1 rounded-full text-[11px] font-bold">
                                    Akan Datang
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold bg-slate-100 text-slate-500">
                                    Selesai
                                </span>
                            @endif
                        </div>

                        {{-- Judul Kegiatan --}}
                        <h3 class="font-extrabold text-lg text-slate-900 group-hover:text-primary-700 transition-colors leading-snug mb-2.5">
                            {{ $jadwal->kegiatan }}
                        </h3>

                        {{-- Lokasi Posyandu & Desa --}}
                        <div class="inline-flex items-center gap-2 text-xs font-semibold text-slate-600 bg-slate-50 border border-slate-200/70 px-3 py-1.5 rounded-xl mb-4">
                            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            <span>
                                {{ $jadwal->posyandu->nama }}
                                <span class="text-slate-400 font-normal">({{ $jadwal->posyandu->desa->nama }})</span>
                            </span>
                        </div>
                    </div>

                    {{-- Keterangan --}}
                    @if($jadwal->keterangan)
                        <div class="border-t border-slate-100 pt-3.5 mt-1">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1">Keterangan</p>
                            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                                {{ $jadwal->keterangan }}
                            </p>
                        </div>
                    @endif
                </div>
            @empty
                <div class="col-span-full bg-white py-16 px-6 rounded-3xl shadow-xs border border-slate-200/90 text-center">
                    <div class="mx-auto w-14 h-14 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mb-3.5">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>
                    </div>
                    <p class="font-extrabold text-slate-900 text-base">Belum Ada Jadwal Kegiatan</p>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-md mx-auto">
                        Belum ada jadwal kegiatan untuk desa Anda.
                    </p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- SCRIPT PENCARIAN INSTAN --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('jadwalDesaSearchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    const keyword = this.value.toLowerCase().trim();
                    document.querySelectorAll('.jadwal-desa-card').forEach(card => {
                        card.style.display = card.textContent.toLowerCase().includes(keyword) ? '' : 'none';
                    });
                });
            }
        });
    </script>
</x-app-layout>