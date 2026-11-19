<x-app-layout>
    @php
        $latestPeriksa = $pemeriksaans->first();
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
                    <span class="text-emerald-300 font-semibold">Rekam Medis & Pertumbuhan Anak</span>
                </nav>

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    {{-- Identitas Anak --}}
                    <div class="flex items-start sm:items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-white/10 border border-white/20 backdrop-blur-xs text-emerald-300 font-extrabold text-xl flex items-center justify-center shrink-0 shadow-sm">
                            {{ strtoupper(substr($anak->nama, 0, 2)) }}
                        </div>
                        <div>
                            <div class="flex flex-wrap items-center gap-2 mb-1.5">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-white/10 border border-white/15 text-[11px] font-semibold text-emerald-300">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                    {{ $anak->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-white/10 border border-white/15 text-[11px] font-mono font-semibold text-slate-200 tabular-nums">
                                    NIK: {{ $anak->nik }}
                                </span>
                            </div>

                            <h2 class="font-extrabold text-2xl sm:text-3xl tracking-tight text-white">
                                Detail Anak: {{ $anak->nama }}
                            </h2>

                            <p class="text-xs sm:text-sm text-slate-300 mt-1">
                                Usia: <strong class="text-emerald-300 font-semibold">{{ \Carbon\Carbon::parse($anak->tanggal_lahir)->diffForHumans(null, true) }}</strong>
                                @if($anak->tanggal_lahir)
                                    ({{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d M Y') }})
                                @endif
                                @if($anak->orangtua)
                                    • Orang Tua: <strong class="text-white font-semibold">{{ $anak->orangtua->name }}</strong>
                                @endif
                            </p>
                        </div>
                    </div>

                    {{-- CTA Beri Catatan Medis --}}
                    <div class="shrink-0">
                        <a href="{{ route('bidan.kasus.catatan-anak', $anak->id) }}"
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

        {{-- 2. BENTO SUMMARY CARDS (SNAPSHOT KLINIS TERAKHIR) --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Berat Badan Terakhir</p>
                <p class="text-2xl font-extrabold text-slate-900 tabular-nums mt-1">
                    {{ $latestPeriksa ? $latestPeriksa->berat_badan : '-' }}
                    @if($latestPeriksa) <span class="text-xs font-semibold text-slate-500">kg</span> @endif
                </p>
                <p class="text-xs text-slate-400 mt-1">
                    {{ $latestPeriksa ? \Carbon\Carbon::parse($latestPeriksa->tanggal_periksa)->format('d M Y') : 'Belum ada data' }}
                </p>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Tinggi Badan Terakhir</p>
                <p class="text-2xl font-extrabold text-slate-900 tabular-nums mt-1">
                    {{ $latestPeriksa ? $latestPeriksa->tinggi_badan : '-' }}
                    @if($latestPeriksa) <span class="text-xs font-semibold text-slate-500">cm</span> @endif
                </p>
                <p class="text-xs text-slate-400 mt-1">Pengukuran antropometri</p>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Status Gizi Terkini</p>
                <div class="mt-2">
                    @if(!$latestPeriksa)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600">
                            BELUM ADA DATA
                        </span>
                    @elseif($latestPeriksa->status_gizi === 'Normal')
                        <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-800 border border-emerald-200/90 px-3 py-1 rounded-full text-xs font-extrabold uppercase">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            NORMAL
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-800 border border-rose-200/90 px-3 py-1 rounded-full text-xs font-extrabold uppercase">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                            {{ strtoupper($latestPeriksa->status_gizi) }}
                        </span>
                    @endif
                </div>
                <p class="text-xs text-slate-400 mt-1.5">{{ $pemeriksaans->count() }} riwayat penimbangan</p>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Capaian Imunisasi</p>
                <p class="text-2xl font-extrabold text-primary-700 tabular-nums mt-1">
                    {{ $imunisasis->count() }} <span class="text-xs font-semibold text-slate-500">Dosis</span>
                </p>
                <p class="text-xs text-slate-400 mt-1">Vaksinasi tercatat</p>
            </div>
        </div>

        {{-- 3. ALERT NOTIFIKASI SUKSES (JIKA ADA) --}}
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

        {{-- 4. GRID 2 KOLOM: GRAFIK PERTUMBUHAN & RIWAYAT IMUNISASI --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
            {{-- Grafik Pertumbuhan (7 Kolom) --}}
            <div class="lg:col-span-7 bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden flex flex-col">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/70 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-slate-900">Grafik Kurva Pertumbuhan</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Tren kenaikan berat badan (kg) dan tinggi badan (cm) berkala.</p>
                    </div>
                    <div class="hidden sm:flex items-center gap-3 text-xs font-semibold">
                        <span class="inline-flex items-center gap-1.5 text-emerald-700">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> BB (kg)
                        </span>
                        <span class="inline-flex items-center gap-1.5 text-sky-700">
                            <span class="w-2.5 h-2.5 rounded-full bg-sky-500"></span> TB (cm)
                        </span>
                    </div>
                </div>
                <div class="p-6 flex-1 flex items-center">
                    <div class="w-full bg-slate-50/80 p-4 rounded-2xl border border-slate-100 h-72">
                        <canvas id="chart-bidan-{{ $anak->id }}"></canvas>
                    </div>
                </div>
            </div>

            {{-- Riwayat Imunisasi (5 Kolom) --}}
            <div class="lg:col-span-5 bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden flex flex-col">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/70 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-slate-900">Riwayat Imunisasi</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Daftar vaksin yang telah diterima.</p>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-sky-50 text-sky-800 border border-sky-200/80 tabular-nums">
                        {{ $imunisasis->count() }} Dosis
                    </span>
                </div>

                <div class="overflow-y-auto max-h-80 flex-1">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider sticky top-0 z-10">
                            <tr>
                                <th class="py-3.5 px-6">Tanggal</th>
                                <th class="py-3.5 px-6">Jenis Vaksin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($imunisasis as $imunisasi)
                                <tr class="hover:bg-slate-50/90 transition-colors">
                                    <td class="py-3.5 px-6 font-semibold text-slate-700 tabular-nums whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($imunisasi->tanggal_imunisasi)->format('d/m/Y') }}
                                    </td>
                                    <td class="py-3.5 px-6">
                                        <span class="inline-flex items-center gap-1.5 bg-sky-50 text-sky-800 border border-sky-200/90 px-3 py-1 rounded-full text-xs font-extrabold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                                            {{ $imunisasi->jenis_imunisasi }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="py-12 px-6 text-center">
                                        <p class="font-bold text-slate-700 text-sm">Belum Ada Riwayat Imunisasi</p>
                                        <p class="text-xs text-slate-400 mt-1">Data imunisasi akan tampil setelah diinput oleh Kader Posyandu.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- 5. TABEL RIWAYAT PENIMBANGAN & CATATAN BIDAN --}}
        <div class="bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/70 flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h3 class="font-bold text-slate-900">Riwayat Penimbangan & Catatan Klinis</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Rekapitulasi hasil pengukuran antropometri dan instruksi intervensi Bidan.</p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-extrabold bg-primary-50 text-primary-800 border border-primary-100 tabular-nums">
                    {{ $pemeriksaans->count() }} Kunjungan
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
                        <tr>
                            <th class="py-3.5 px-6">Tanggal Periksa</th>
                            <th class="py-3.5 px-6">Berat Badan</th>
                            <th class="py-3.5 px-6">Tinggi Badan</th>
                            <th class="py-3.5 px-6">Status Gizi</th>
                            <th class="py-3.5 px-6">Catatan Medis Bidan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($pemeriksaans as $periksa)
                            <tr class="hover:bg-slate-50/90 transition-colors">
                                <td class="py-4 px-6 font-semibold text-slate-800 tabular-nums whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($periksa->tanggal_periksa)->format('d/m/Y') }}
                                </td>
                                <td class="py-4 px-6 font-bold text-slate-700 tabular-nums">
                                    {{ $periksa->berat_badan }} <span class="text-xs font-normal text-slate-400">kg</span>
                                </td>
                                <td class="py-4 px-6 font-bold text-slate-700 tabular-nums">
                                    {{ $periksa->tinggi_badan }} <span class="text-xs font-normal text-slate-400">cm</span>
                                </td>
                                <td class="py-4 px-6">
                                    @if($periksa->status_gizi === 'Normal')
                                        <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-800 border border-emerald-200/90 px-3 py-1 rounded-full text-xs font-extrabold uppercase">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            NORMAL
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-800 border border-rose-200/90 px-3 py-1 rounded-full text-xs font-extrabold uppercase">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                            {{ strtoupper($periksa->status_gizi) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-slate-600 text-xs sm:text-sm max-w-md leading-relaxed">
                                    @if($periksa->catatan)
                                        <div class="bg-slate-50 border border-slate-200/70 rounded-xl px-3.5 py-2 text-slate-700">
                                            {{ $periksa->catatan }}
                                        </div>
                                    @else
                                        <span class="text-slate-400 italic text-xs">Belum ada catatan medis</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 px-6 text-center">
                                    <p class="font-bold text-slate-700 text-sm">Belum Ada Riwayat Penimbangan</p>
                                    <p class="text-xs text-slate-400 mt-1">Data penimbangan balita akan tampil di sini setelah diinput di Posyandu.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- SCRIPT CHART.JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('chart-bidan-{{ $anak->id }}').getContext('2d');
            const labels = {!! json_encode($pemeriksaans->map(fn($p) => \Carbon\Carbon::parse($p->tanggal_periksa)->format('M Y'))) !!};
            const dataBerat = {!! json_encode($pemeriksaans->pluck('berat_badan')) !!};
            const dataTinggi = {!! json_encode($pemeriksaans->pluck('tinggi_badan')) !!};

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Berat Badan (kg)',
                            data: dataBerat,
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.12)',
                            borderWidth: 2.5,
                            pointBackgroundColor: '#10b981',
                            pointRadius: 4,
                            fill: true,
                            tension: 0.35,
                            yAxisID: 'y'
                        },
                        {
                            label: 'Tinggi Badan (cm)',
                            data: dataTinggi,
                            borderColor: '#0284c7',
                            backgroundColor: 'rgba(2, 132, 199, 0.08)',
                            borderWidth: 2.5,
                            pointBackgroundColor: '#0284c7',
                            pointRadius: 4,
                            tension: 0.35,
                            yAxisID: 'y1'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 16,
                                font: { size: 12, weight: '600' }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false }
                        },
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            title: { display: true, text: 'Berat (kg)', font: { size: 11, weight: '700' } },
                            grid: { color: 'rgba(148, 163, 184, 0.15)' }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            title: { display: true, text: 'Tinggi (cm)', font: { size: 11, weight: '700' } },
                            grid: { drawOnChartArea: false }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>