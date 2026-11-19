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
                    <a href="{{ route('kader.anak.index') }}" class="hover:text-emerald-300 transition-colors inline-flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        Data Anak Posyandu
                    </a>
                    <span class="text-slate-500">/</span>
                    <span class="text-emerald-300 font-semibold">Buku KIA Digital</span>
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
                                {{ $anak->nama }}
                            </h2>

                            <p class="text-xs sm:text-sm text-slate-300 mt-1">
                                Lahir <strong class="text-white font-semibold tabular-nums">{{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d M Y') }}</strong>
                                (<strong class="text-emerald-300 font-semibold">{{ \Carbon\Carbon::parse($anak->tanggal_lahir)->diffForHumans(null, true) }}</strong>)
                                @if($anak->orangtua)
                                    • Orang Tua: <strong class="text-white font-semibold">{{ $anak->orangtua->name }}</strong>
                                @endif
                            </p>
                        </div>
                    </div>

                    {{-- Aksi Manajemen Data Anak --}}
                    <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                        <a href="{{ route('kader.anak.edit', $anak->id) }}"
                           class="inline-flex items-center gap-1.5 bg-amber-400 hover:bg-amber-300 text-slate-950 px-4 py-2.5 rounded-xl font-bold text-xs sm:text-sm shadow-sm transition-all hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                            </svg>
                            Edit Data Anak
                        </a>

                        <form action="{{ route('kader.anak.destroy', $anak->id) }}" method="POST" onsubmit="return confirm('Hapus data anak ini? Semua riwayat pemeriksaan juga akan terhapus.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center gap-1.5 bg-rose-500/20 hover:bg-rose-500/30 border border-rose-400/40 text-rose-200 hover:text-white px-4 py-2.5 rounded-xl font-bold text-xs sm:text-sm transition-all">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. BENTO SUMMARY CARDS (SNAPSHOT TERAKHIR) --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Berat Badan Terakhir</p>
                <p class="text-2xl font-extrabold text-slate-900 tabular-nums mt-1">
                    {{ $latestPeriksa ? $latestPeriksa->berat_badan : '-' }}
                    @if($latestPeriksa) <span class="text-xs font-semibold text-slate-500">kg</span> @endif
                </p>
                <p class="text-xs text-slate-400 mt-1">
                    {{ $latestPeriksa ? \Carbon\Carbon::parse($latestPeriksa->tanggal_periksa)->format('d M Y') : 'Belum diperiksa' }}
                </p>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Tinggi Badan Terakhir</p>
                <p class="text-2xl font-extrabold text-slate-900 tabular-nums mt-1">
                    {{ $latestPeriksa ? $latestPeriksa->tinggi_badan : '-' }}
                    @if($latestPeriksa) <span class="text-xs font-semibold text-slate-500">cm</span> @endif
                </p>
                <p class="text-xs text-slate-400 mt-1">
                    {{ $latestPeriksa && $latestPeriksa->lingkar_kepala ? 'LK: ' . $latestPeriksa->lingkar_kepala . ' cm' : 'Antropometri dasar' }}
                </p>
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
                <p class="text-xs text-slate-400 mt-1.5">{{ $pemeriksaans->count() }} kali kunjungan</p>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Capaian Imunisasi</p>
                <p class="text-2xl font-extrabold text-primary-700 tabular-nums mt-1">
                    {{ $imunisasis->count() }} <span class="text-xs font-semibold text-slate-500">Dosis</span>
                </p>
                <p class="text-xs text-slate-400 mt-1">Vaksinasi tercatat</p>
            </div>
        </div>

        {{-- 3. ALERT NOTIFIKASI SUKSES (JIKA ADA REDIRECT UPDATE/HAPUS) --}}
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

        {{-- 4. GRID 2 KOLOM: RIWAYAT PENIMBANGAN & RIWAYAT IMUNISASI --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            {{-- KOLOM KIRI (7 KOLOM): RIWAYAT PENIMBANGAN --}}
            <div class="lg:col-span-7 bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/70 flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h3 class="font-bold text-slate-900">Riwayat Penimbangan</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Catatan berat badan, tinggi badan, dan status gizi berkala.</p>
                    </div>
                    <a href="{{ route('kader.pemeriksaan.create', $anak->id) }}"
                       class="inline-flex items-center gap-1.5 bg-gradient-to-r from-primary-700 to-emerald-600 hover:from-primary-800 hover:to-emerald-700 text-white px-3.5 py-2 rounded-xl text-xs font-bold shadow-2xs transition-all">
                        <svg class="w-3.5 h-3.5 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Input Periksa
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
                            <tr>
                                <th class="py-3.5 px-5">Tanggal</th>
                                <th class="py-3.5 px-4">BB (kg)</th>
                                <th class="py-3.5 px-4">TB (cm)</th>
                                <th class="py-3.5 px-4">Status</th>
                                <th class="py-3.5 px-5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($pemeriksaans as $periksa)
                                <tr class="hover:bg-slate-50/90 transition-colors">
                                    <td class="py-3.5 px-5 font-semibold text-slate-800 tabular-nums whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($periksa->tanggal_periksa)->format('d/m/Y') }}
                                    </td>
                                    <td class="py-3.5 px-4 font-bold text-slate-700 tabular-nums">
                                        {{ $periksa->berat_badan }}
                                    </td>
                                    <td class="py-3.5 px-4 font-bold text-slate-700 tabular-nums">
                                        {{ $periksa->tinggi_badan }}
                                    </td>
                                    <td class="py-3.5 px-4">
                                        @if($periksa->status_gizi === 'Normal')
                                            <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-800 border border-emerald-200/90 px-2.5 py-0.5 rounded-full text-[11px] font-extrabold uppercase">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                NORMAL
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 bg-rose-50 text-rose-800 border border-rose-200/90 px-2.5 py-0.5 rounded-full text-[11px] font-extrabold uppercase">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                                {{ strtoupper($periksa->status_gizi) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-5 text-center">
                                        <div class="inline-flex items-center justify-center gap-2">
                                            <a href="{{ route('kader.pemeriksaan.edit', $periksa->id) }}"
                                               class="bg-amber-50 text-amber-800 hover:bg-amber-100 border border-amber-200/80 px-2.5 py-1 rounded-lg text-xs font-bold transition-colors">
                                                Edit
                                            </a>
                                            <form action="{{ route('kader.pemeriksaan.destroy', $periksa->id) }}" method="POST" onsubmit="return confirm('Hapus data pemeriksaan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="bg-rose-50 text-rose-700 hover:bg-rose-100 border border-rose-200/80 px-2.5 py-1 rounded-lg text-xs font-bold transition-colors">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 px-6 text-center">
                                        <p class="font-bold text-slate-700 text-sm">Belum ada riwayat penimbangan</p>
                                        <p class="text-xs text-slate-400 mt-1">Klik tombol "+ Input Periksa" untuk menambahkan pengukuran pertama.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- KOLOM KANAN (5 KOLOM): RIWAYAT IMUNISASI --}}
            <div class="lg:col-span-5 bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/70 flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h3 class="font-bold text-slate-900">Riwayat Imunisasi</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Daftar vaksinasi yang telah diberikan.</p>
                    </div>
                    <a href="{{ route('kader.imunisasi.create', $anak->id) }}"
                       class="inline-flex items-center gap-1.5 bg-sky-50 hover:bg-sky-100 text-sky-800 border border-sky-200/80 px-3.5 py-2 rounded-xl text-xs font-bold transition-all">
                        <svg class="w-3.5 h-3.5 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Catat Vaksin
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
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
                                        <p class="font-bold text-slate-700 text-sm">Belum ada riwayat imunisasi</p>
                                        <p class="text-xs text-slate-400 mt-1">Klik tombol "+ Catat Vaksin" untuk menambah riwayat imunisasi.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>