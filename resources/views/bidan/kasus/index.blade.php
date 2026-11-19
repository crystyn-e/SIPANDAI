<x-app-layout>
    @php
        $totalStunting = $anakStunting->count();
        $totalIbuRisiko = $ibuHamilRisiko->count();
        $totalKasus = $totalStunting + $totalIbuRisiko;
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
                        Daftar Kasus & Rujukan
                    </h2>
                    <p class="text-sm sm:text-base text-slate-300 mt-1.5 max-w-2xl">
                        Pantauan kasus medis prioritas di desa binaan Anda untuk pemberian intervensi klinis, PMT, dan tindak lanjut rujukan.
                    </p>
                </div>

                {{-- Mini Ringkasan Prioritas --}}
                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    <div class="px-4 py-2.5 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-xs">
                        <p class="text-[11px] uppercase tracking-wider font-semibold text-slate-300">Total Kasus Aktif</p>
                        <p class="text-xl font-extrabold {{ $totalKasus > 0 ? 'text-amber-300' : 'text-emerald-300' }} tabular-nums mt-0.5">
                            {{ $totalKasus }} <span class="text-xs font-normal text-slate-300">({{ $totalStunting }} Anak • {{ $totalIbuRisiko }} Ibu)</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. ALERT NOTIFIKASI SUKSES --}}
        @if(session('success'))
            <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200/90 text-emerald-900 px-5 py-4 rounded-2xl shadow-2xs">
                <div class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-emerald-700">Berhasil Disimpan</p>
                    <p class="text-sm font-medium text-slate-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        {{-- 3. TABEL KASUS 1: ANAK TERDETEKSI STUNTING --}}
        <div class="bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden">
            {{-- Header Card + Search --}}
            <div class="px-6 py-5 border-b border-rose-200/70 bg-gradient-to-r from-rose-50/90 via-rose-50/40 to-white flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div class="flex items-start sm:items-center gap-3.5">
                    <div class="w-11 h-11 rounded-2xl bg-rose-600 text-white flex items-center justify-center shrink-0 shadow-sm shadow-rose-500/20">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex flex-wrap items-center gap-2">
                            <h3 class="font-extrabold text-lg text-rose-950">Anak Terdeteksi Stunting</h3>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-rose-100 text-rose-800 border border-rose-200/80 tabular-nums">
                                {{ $totalStunting }} Kasus
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm text-rose-700/90 mt-0.5">
                            Anak-anak ini membutuhkan intervensi gizi dan pemantauan lanjutan.
                        </p>
                    </div>
                </div>

                <div class="relative w-full lg:w-72">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <input type="text"
                           id="kasusAnakSearchInput"
                           placeholder="Cari nama anak, Posyandu, ortu..."
                           class="w-full pl-10 pr-4 py-2 text-sm bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
                        <tr>
                            <th class="py-3.5 px-6">Nama Anak</th>
                            <th class="py-3.5 px-6">Usia</th>
                            <th class="py-3.5 px-6">Posyandu</th>
                            <th class="py-3.5 px-6">Orang Tua</th>
                            <th class="py-3.5 px-6 text-right">Aksi Klinis</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($anakStunting as $anak)
                            <tr class="kasus-anak-row group hover:bg-slate-50/90 transition-colors">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3.5">
                                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-rose-100 to-amber-100 text-rose-800 border border-rose-200/70 font-bold text-xs flex items-center justify-center shrink-0">
                                            {{ strtoupper(substr($anak->nama, 0, 2)) }}
                                        </div>
                                        <div>
                                            <a href="{{ route('bidan.anak.show', $anak->id) }}"
                                               class="font-bold text-slate-900 group-hover:text-primary-700 transition-colors">
                                                {{ $anak->nama }}
                                            </a>
                                            <p class="text-xs text-rose-600 font-semibold mt-0.5">Prioritas Intervensi Gizi</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-semibold text-xs tabular-nums">
                                        {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->diffForHumans(null, true) }}
                                    </span>
                                </td>

                                <td class="py-4 px-6 font-medium text-slate-700">
                                    {{ $anak->posyandu->nama ?? '-' }}
                                </td>

                                <td class="py-4 px-6 font-medium text-slate-700">
                                    {{ $anak->orangtua->name ?? '-' }}
                                </td>

                                <td class="py-4 px-6 text-right">
                                    <div class="inline-flex items-center justify-end gap-2">
                                        <a href="{{ route('bidan.anak.show', $anak->id) }}"
                                           class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-700 hover:bg-slate-200 border border-slate-200/80 px-3 py-1.5 rounded-xl text-xs font-bold transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            Detail
                                        </a>

                                        <a href="{{ route('bidan.kasus.catatan-anak', $anak->id) }}"
                                           class="inline-flex items-center gap-1.5 bg-gradient-to-r from-primary-700 to-emerald-600 hover:from-primary-800 hover:to-emerald-700 text-white px-3.5 py-1.5 rounded-xl text-xs font-bold shadow-2xs transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                                            </svg>
                                            Beri Catatan
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 px-6 text-center">
                                    <div class="mx-auto w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-2.5">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                        </svg>
                                    </div>
                                    <p class="font-bold text-slate-800 text-sm">Tidak ada kasus stunting di desa ini.</p>
                                    <p class="text-xs text-slate-400 mt-0.5">Seluruh sasaran balita terpantau berada dalam status pertumbuhan normal.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- 4. TABEL KASUS 2: IBU HAMIL RISIKO TINGGI --}}
        <div class="bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden">
            {{-- Header Card + Search --}}
            <div class="px-6 py-5 border-b border-amber-200/70 bg-gradient-to-r from-amber-50/90 via-orange-50/40 to-white flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div class="flex items-start sm:items-center gap-3.5">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-amber-500 to-orange-600 text-white flex items-center justify-center shrink-0 shadow-sm shadow-amber-500/20">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex flex-wrap items-center gap-2">
                            <h3 class="font-extrabold text-lg text-amber-950">Ibu Hamil Risiko Tinggi</h3>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-amber-100 text-amber-900 border border-amber-200/80 tabular-nums">
                                {{ $totalIbuRisiko }} Kasus
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm text-amber-800/90 mt-0.5">
                            Ibu hamil dengan KEK (LILA kurang dari 23.5 cm) atau umur berisiko.
                        </p>
                    </div>
                </div>

                <div class="relative w-full lg:w-72">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <input type="text"
                           id="kasusIbuSearchInput"
                           placeholder="Cari nama ibu atau status risiko..."
                           class="w-full pl-10 pr-4 py-2 text-sm bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
                        <tr>
                            <th class="py-3.5 px-6">Nama Ibu</th>
                            <th class="py-3.5 px-6">Umur</th>
                            <th class="py-3.5 px-6">Status Risiko</th>
                            <th class="py-3.5 px-6 text-right">Aksi Klinis</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($ibuHamilRisiko as $ibu)
                            <tr class="kasus-ibu-row group hover:bg-slate-50/90 transition-colors">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3.5">
                                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-100 to-orange-100 text-amber-900 border border-amber-200/80 font-bold text-xs flex items-center justify-center shrink-0">
                                            {{ strtoupper(substr($ibu->nama, 0, 2)) }}
                                        </div>
                                        <div>
                                            <a href="{{ route('bidan.ibu.show', $ibu->id) }}"
                                               class="font-bold text-slate-900 group-hover:text-primary-700 transition-colors">
                                                {{ $ibu->nama }}
                                            </a>
                                            <p class="text-xs text-amber-700 font-semibold mt-0.5">Pengawasan Kehamilan</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-semibold text-xs tabular-nums">
                                        {{ $ibu->umur }} Tahun
                                    </span>
                                </td>

                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-800 border border-amber-200/90 px-3 py-1 rounded-full text-xs font-extrabold uppercase">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        {{ $ibu->status_risiko }}
                                    </span>
                                </td>

                                <td class="py-4 px-6 text-right">
                                    <div class="inline-flex items-center justify-end gap-2">
                                        <a href="{{ route('bidan.ibu.show', $ibu->id) }}"
                                           class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-700 hover:bg-slate-200 border border-slate-200/80 px-3 py-1.5 rounded-xl text-xs font-bold transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            Detail
                                        </a>

                                        <a href="{{ route('bidan.kasus.catatan-ibu', $ibu->id) }}"
                                           class="inline-flex items-center gap-1.5 bg-gradient-to-r from-primary-700 to-emerald-600 hover:from-primary-800 hover:to-emerald-700 text-white px-3.5 py-1.5 rounded-xl text-xs font-bold shadow-2xs transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                                            </svg>
                                            Beri Catatan
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 px-6 text-center">
                                    <div class="mx-auto w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-2.5">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                        </svg>
                                    </div>
                                    <p class="font-bold text-slate-800 text-sm">Tidak ada ibu hamil risiko tinggi di desa ini.</p>
                                    <p class="text-xs text-slate-400 mt-0.5">Seluruh ibu hamil terpantau berada dalam kondisi kehamilan normal.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- SCRIPT PENCARIAN INSTAN UNTUK MASING-MASING TABEL --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchAnak = document.getElementById('kasusAnakSearchInput');
            if (searchAnak) {
                searchAnak.addEventListener('input', function () {
                    const keyword = this.value.toLowerCase().trim();
                    document.querySelectorAll('.kasus-anak-row').forEach(row => {
                        row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
                    });
                });
            }

            const searchIbu = document.getElementById('kasusIbuSearchInput');
            if (searchIbu) {
                searchIbu.addEventListener('input', function () {
                    const keyword = this.value.toLowerCase().trim();
                    document.querySelectorAll('.kasus-ibu-row').forEach(row => {
                        row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
                    });
                });
            }
        });
    </script>
</x-app-layout>