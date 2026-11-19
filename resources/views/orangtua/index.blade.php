<x-app-layout>
    <div class="space-y-8">
        {{-- 1. EXECUTIVE HEADER BANNER --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-primary-950 to-primary-900 p-6 sm:p-8 text-white shadow-lg border border-primary-800/50">
            <div class="pointer-events-none absolute -right-12 -top-12 h-56 w-56 rounded-full bg-emerald-400/15 blur-2xl"></div>
            <div class="pointer-events-none absolute right-28 -bottom-16 h-48 w-48 rounded-full bg-amber-400/15 blur-2xl"></div>

            <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 backdrop-blur-xs text-xs font-semibold text-emerald-300 mb-3">
                        <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Layanan Kesehatan Ibu & Anak (KIA) Digital
                    </div>
                    <h2 class="font-extrabold text-2xl sm:text-3xl tracking-tight text-white">
                        Buku KIA Digital
                    </h2>
                    <p class="text-sm sm:text-base text-slate-300 mt-1.5 max-w-2xl">
                        Pantau kurva pertumbuhan balita, riwayat penimbangan berkala, capaian imunisasi dasar, serta catatan medis Bidan secara terpadu.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    <div class="px-4 py-2.5 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-xs">
                        <p class="text-[11px] uppercase tracking-wider font-semibold text-slate-300">Anak Terdaftar</p>
                        <p class="text-xl font-extrabold text-emerald-300 tabular-nums mt-0.5">
                            {{ $anaks->count() }} <span class="text-xs font-normal text-slate-300">Balita</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. DAFTAR KARTU BUKU KIA PER ANAK --}}
        @forelse($anaks as $anak)
            @php
                $latestPeriksa = $anak->pemeriksaans->sortByDesc('tanggal_periksa')->first();
                $usiaText = $anak->tanggal_lahir ? \Carbon\Carbon::parse($anak->tanggal_lahir)->diffForHumans(null, true) : null;
            @endphp

            <div class="bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden">
                {{-- HEADER PROFIL ANAK + TOMBOL DOWNLOAD KMS PDF --}}
                <div class="px-6 sm:px-8 py-6 border-b border-slate-100 bg-gradient-to-r from-slate-50/90 via-primary-50/30 to-white flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-start sm:items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl {{ $anak->jenis_kelamin === 'L' ? 'bg-gradient-to-br from-sky-100 to-primary-100 text-primary-800 border-primary-200/70' : 'bg-gradient-to-br from-rose-100 to-amber-100 text-rose-800 border-rose-200/70' }} border font-extrabold text-lg flex items-center justify-center shrink-0 shadow-2xs">
                            {{ strtoupper(substr($anak->nama, 0, 2)) }}
                        </div>
                        <div>
                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ $anak->jenis_kelamin === 'L' ? 'bg-sky-50 text-sky-700 border border-sky-200/80' : 'bg-rose-50 text-rose-700 border border-rose-200/80' }}">
                                    {{ $anak->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                                @if($usiaText)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-primary-50 text-primary-700 border border-primary-100">
                                        Usia: {{ $usiaText }}
                                    </span>
                                @endif
                            </div>
                            <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">
                                {{ $anak->nama }}
                            </h3>
                            <p class="text-xs font-mono font-semibold text-slate-500 tabular-nums mt-0.5">
                                NIK: {{ $anak->nik }}
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('orangtua.kms.pdf', $anak->id) }}"
                       class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-primary-700 via-primary-600 to-emerald-600 hover:from-primary-800 hover:to-emerald-700 text-white px-5 py-3 rounded-2xl font-bold text-xs sm:text-sm shadow-sm transition-all hover:-translate-y-0.5 shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        Download KMS PDF
                    </a>
                </div>

                <div class="p-6 sm:p-8 space-y-8">
                    {{-- SNAPSHOT MINI BENTO (4 KARTU RINGKASAN) --}}
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="rounded-2xl bg-slate-50/80 border border-slate-200/70 p-4">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Berat Terakhir</p>
                            <p class="text-xl font-extrabold text-slate-900 tabular-nums mt-1">
                                {{ $latestPeriksa ? $latestPeriksa->berat_badan : '-' }}
                                @if($latestPeriksa) <span class="text-xs font-semibold text-slate-500">kg</span> @endif
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-50/80 border border-slate-200/70 p-4">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Tinggi Terakhir</p>
                            <p class="text-xl font-extrabold text-slate-900 tabular-nums mt-1">
                                {{ $latestPeriksa ? $latestPeriksa->tinggi_badan : '-' }}
                                @if($latestPeriksa) <span class="text-xs font-semibold text-slate-500">cm</span> @endif
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-50/80 border border-slate-200/70 p-4">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Status Gizi</p>
                            <div class="mt-1.5">
                                @if(!$latestPeriksa)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-200/70 text-slate-600">
                                        BELUM ADA DATA
                                    </span>
                                @elseif($latestPeriksa->status_gizi === 'Normal')
                                    <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-800 border border-emerald-200/90 px-2.5 py-0.5 rounded-full text-xs font-extrabold uppercase">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        NORMAL
                                    </span>
                                @elseif($latestPeriksa->status_gizi === 'Stunting')
                                    <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-800 border border-rose-200/90 px-2.5 py-0.5 rounded-full text-xs font-extrabold uppercase">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                        STUNTING
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-800 border border-amber-200/90 px-2.5 py-0.5 rounded-full text-xs font-extrabold uppercase">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        {{ strtoupper($latestPeriksa->status_gizi) }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="rounded-2xl bg-slate-50/80 border border-slate-200/70 p-4">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Imunisasi Tercatat</p>
                            <p class="text-xl font-extrabold text-primary-700 tabular-nums mt-1">
                                {{ $anak->imunisasis->count() }} <span class="text-xs font-semibold text-slate-500">Dosis</span>
                            </p>
                        </div>
                    </div>

                    {{-- GRAFIK PERTUMBUHAN --}}
                    <div>
                        <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                            <div>
                                <h4 class="font-extrabold text-base text-slate-900">Grafik Kurva Pertumbuhan</h4>
                                <p class="text-xs text-slate-500">Perkembangan berat badan (kg) dan tinggi badan (cm) dari waktu ke waktu.</p>
                            </div>
                            <div class="flex items-center gap-4 text-xs font-semibold">
                                <span class="inline-flex items-center gap-1.5 text-emerald-700">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Berat (kg)
                                </span>
                                <span class="inline-flex items-center gap-1.5 text-sky-700">
                                    <span class="w-2.5 h-2.5 rounded-full bg-sky-500"></span> Tinggi (cm)
                                </span>
                            </div>
                        </div>
                        <div class="bg-slate-50/80 p-4 sm:p-5 rounded-2xl border border-slate-200/70 h-72">
                            <canvas id="chart-{{ $anak->id }}"></canvas>
                        </div>
                    </div>

                    {{-- RIWAYAT PENIMBANGAN --}}
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <h4 class="font-extrabold text-base text-slate-900">Riwayat Penimbangan</h4>
                                <p class="text-xs text-slate-500">Rekap hasil pemeriksaan rutin Posyandu dan catatan Bidan.</p>
                            </div>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-700 tabular-nums">
                                {{ $anak->pemeriksaans->count() }} Kali
                            </span>
                        </div>

                        <div class="overflow-x-auto rounded-2xl border border-slate-200/80">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
                                    <tr>
                                        <th class="py-3.5 px-5">Tanggal Periksa</th>
                                        <th class="py-3.5 px-5">Berat (kg)</th>
                                        <th class="py-3.5 px-5">Tinggi (cm)</th>
                                        <th class="py-3.5 px-5">Status Gizi</th>
                                        <th class="py-3.5 px-5">Catatan Medis</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm">
                                    @forelse($anak->pemeriksaans as $periksa)
                                        <tr class="hover:bg-slate-50/90 transition-colors">
                                            <td class="py-3.5 px-5 font-semibold text-slate-800 tabular-nums whitespace-nowrap">
                                                {{ \Carbon\Carbon::parse($periksa->tanggal_periksa)->format('d/m/Y') }}
                                            </td>
                                            <td class="py-3.5 px-5 font-bold text-slate-700 tabular-nums">
                                                {{ $periksa->berat_badan }} kg
                                            </td>
                                            <td class="py-3.5 px-5 font-bold text-slate-700 tabular-nums">
                                                {{ $periksa->tinggi_badan }} cm
                                            </td>
                                            <td class="py-3.5 px-5">
                                                @if($periksa->status_gizi === 'Normal')
                                                    <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-800 border border-emerald-200/90 px-3 py-1 rounded-full text-xs font-extrabold uppercase">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                        NORMAL
                                                    </span>
                                                @elseif($periksa->status_gizi === 'Stunting')
                                                    <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-800 border border-rose-200/90 px-3 py-1 rounded-full text-xs font-extrabold uppercase">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                                        STUNTING
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-800 border border-amber-200/90 px-3 py-1 rounded-full text-xs font-extrabold uppercase">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                        {{ strtoupper($periksa->status_gizi) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-3.5 px-5 text-slate-600 text-xs sm:text-sm max-w-md leading-relaxed">
                                                @if($periksa->catatan)
                                                    <div class="bg-slate-50 border border-slate-200/70 rounded-xl px-3 py-1.5 text-slate-700">
                                                        {{ $periksa->catatan }}
                                                    </div>
                                                @else
                                                    <span class="text-slate-400">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="py-10 px-6 text-center text-slate-500 text-sm">
                                                Belum ada riwayat penimbangan.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- RIWAYAT IMUNISASI --}}
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <h4 class="font-extrabold text-base text-slate-900">Riwayat Imunisasi</h4>
                                <p class="text-xs text-slate-500">Daftar vaksinasi yang telah diberikan di Posyandu atau fasilitas kesehatan.</p>
                            </div>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-sky-50 text-sky-800 border border-sky-200/80 tabular-nums">
                                {{ $anak->imunisasis->count() }} Vaksin
                            </span>
                        </div>

                        <div class="overflow-x-auto rounded-2xl border border-slate-200/80">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-sky-50/80 border-b border-sky-100 text-sky-900 text-[11px] font-bold uppercase tracking-wider">
                                    <tr>
                                        <th class="py-3.5 px-5">Tanggal</th>
                                        <th class="py-3.5 px-5">Jenis Imunisasi</th>
                                        <th class="py-3.5 px-5">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm">
                                    @forelse($anak->imunisasis as $imunisasi)
                                        <tr class="hover:bg-slate-50/90 transition-colors">
                                            <td class="py-3.5 px-5 font-semibold text-slate-800 tabular-nums whitespace-nowrap">
                                                {{ \Carbon\Carbon::parse($imunisasi->tanggal_imunisasi)->format('d/m/Y') }}
                                            </td>
                                            <td class="py-3.5 px-5">
                                                <span class="inline-flex items-center gap-1.5 bg-sky-50 text-sky-800 border border-sky-200/90 px-3 py-1 rounded-full text-xs font-extrabold">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                                                    {{ $imunisasi->jenis_imunisasi }}
                                                </span>
                                            </td>
                                            <td class="py-3.5 px-5 text-slate-600 text-xs sm:text-sm">
                                                {{ $imunisasi->keterangan ?? '-' }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-10 px-6 text-center text-slate-500 text-sm">
                                                Belum ada riwayat imunisasi.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SCRIPT CHART.JS --}}
            @once
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            @endonce
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const ctx = document.getElementById('chart-{{ $anak->id }}').getContext('2d');
                    const labels = {!! json_encode($anak->pemeriksaans->map(fn($p) => \Carbon\Carbon::parse($p->tanggal_periksa)->format('M Y'))) !!};
                    const dataBerat = {!! json_encode($anak->pemeriksaans->pluck('berat_badan')) !!};
                    const dataTinggi = {!! json_encode($anak->pemeriksaans->pluck('tinggi_badan')) !!};

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
        @empty
            <div class="bg-white py-16 px-6 rounded-3xl shadow-xs border border-slate-200/90 text-center">
                <div class="mx-auto w-14 h-14 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mb-3.5">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
                <p class="font-extrabold text-slate-900 text-base">Belum Ada Data Anak Terdaftar</p>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-md mx-auto">
                    Anda belum mendaftarkan data anak. Hubungi Kader Posyandu setempat untuk menghubungkan akun Anda dengan data balita.
                </p>
            </div>
        @endforelse

        {{-- 3. RIWAYAT KELUARGA BERENCANA (KB) --}}
        @if(isset($kbs) && $kbs->count() > 0)
            <div class="bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden">
                <div class="px-6 sm:px-8 py-5 border-b border-slate-100 bg-slate-50/70 flex flex-wrap items-center justify-between gap-3">
                    <div class="flex items-center gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-primary-100 text-primary-800 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-extrabold text-slate-900">Riwayat Keluarga Berencana (KB)</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Catatan kepesertaan kontrasepsi dan pengingat jadwal kunjungan ulang.</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-extrabold bg-primary-50 text-primary-800 border border-primary-100 tabular-nums">
                        {{ $kbs->count() }} Riwayat
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
                            <tr>
                                <th class="py-3.5 px-6">Tanggal Mulai</th>
                                <th class="py-3.5 px-6">Jenis Kontrasepsi</th>
                                <th class="py-3.5 px-6">Jadwal Ulang</th>
                                <th class="py-3.5 px-6">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @foreach($kbs as $kb)
                                @php
                                    $isOverdue = $kb->jadwal_ulang && \Carbon\Carbon::parse($kb->jadwal_ulang)->isPast();
                                @endphp
                                <tr class="hover:bg-slate-50/90 transition-colors">
                                    <td class="py-4 px-6 font-semibold text-slate-800 tabular-nums">
                                        {{ \Carbon\Carbon::parse($kb->tanggal_mulai)->format('d/m/Y') }}
                                    </td>
                                    <td class="py-4 px-6 font-bold text-slate-700">
                                        {{ $kb->jenis_kontrasepsi }}
                                    </td>
                                    <td class="py-4 px-6 font-semibold {{ $isOverdue ? 'text-rose-600' : 'text-slate-700' }} tabular-nums">
                                        {{ $kb->jadwal_ulang ? \Carbon\Carbon::parse($kb->jadwal_ulang)->format('d/m/Y') : '-' }}
                                    </td>
                                    <td class="py-4 px-6">
                                        @if($isOverdue)
                                            <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-800 border border-rose-200/90 px-3 py-1 rounded-full text-xs font-extrabold uppercase">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                                JADWAL ULANG TERLEWAT
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-800 border border-emerald-200/90 px-3 py-1 rounded-full text-xs font-extrabold uppercase">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                AKTIF
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>