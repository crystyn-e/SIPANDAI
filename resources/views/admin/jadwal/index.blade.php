<x-app-layout>
    <div class="space-y-6">
        {{-- 1. HEADER BANNER CIVIC-TECH --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-primary-950 to-primary-900 p-6 sm:p-8 text-white shadow-lg border border-primary-800/50">
            <div class="pointer-events-none absolute -right-12 -top-12 h-56 w-56 rounded-full bg-emerald-400/15 blur-2xl"></div>
            <div class="pointer-events-none absolute right-28 -bottom-16 h-48 w-48 rounded-full bg-amber-400/15 blur-2xl"></div>

            <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 backdrop-blur-xs text-xs font-semibold text-emerald-300 mb-3">
                        <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                        Agenda Pelayanan Masyarakat
                    </div>
                    <h2 class="font-extrabold text-2xl sm:text-3xl tracking-tight text-white">
                        Jadwal Posyandu
                    </h2>
                    <p class="text-sm sm:text-base text-slate-300 mt-1.5 max-w-2xl">
                        Atur dan pantau jadwal pelaksanaan kegiatan Posyandu di seluruh desa wilayah kecamatan.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    <a href="{{ route('admin.jadwal.create') }}"
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-slate-950 font-bold text-sm px-5 py-3 rounded-2xl shadow-md shadow-emerald-950/30 transition-all duration-200 hover:-translate-y-0.5">
                        <svg class="w-4 h-4 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Jadwal
                    </a>
                </div>
            </div>
        </div>

        {{-- 2. ALERT NOTIFIKASI SUKSES --}}
        @if(session('success'))
            <div class="flex items-center justify-between gap-4 bg-emerald-50 border border-emerald-200/90 text-emerald-900 px-5 py-4 rounded-2xl shadow-2xs">
                <div class="flex items-center gap-3">
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
            </div>
        @endif

        {{-- 3. TABEL JADWAL MODERN --}}
        <div class="bg-white rounded-2xl shadow-xs border border-slate-200/90 overflow-hidden">
            {{-- Toolbar Tabel + Pencarian Cepat --}}
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/70 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-2.5">
                    <h3 class="font-bold text-slate-900">Daftar Agenda Kegiatan</h3>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-primary-100 text-primary-800 tabular-nums">
                        {{ $jadwals->count() }} Jadwal
                    </span>
                </div>

                <div class="relative w-full sm:w-72">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <input type="text"
                           id="jadwalSearchInput"
                           placeholder="Cari posyandu, desa, kegiatan..."
                           class="w-full pl-10 pr-4 py-2 text-sm bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
                        <tr>
                            <th class="py-3.5 px-6">Tanggal Pelaksanaan</th>
                            <th class="py-3.5 px-6">Posyandu / Desa</th>
                            <th class="py-3.5 px-6">Kegiatan</th>
                            <th class="py-3.5 px-6">Keterangan</th>
                            <th class="py-3.5 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($jadwals as $jadwal)
                            @php
                                $tgl = \Carbon\Carbon::parse($jadwal->tanggal);
                                $isUpcoming = $tgl->isToday() || $tgl->isFuture();
                            @endphp
                            <tr class="jadwal-row group hover:bg-slate-50/90 transition-colors">
                                {{-- Tanggal dengan Blok Kalender Mini --}}
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3.5">
                                        <div class="w-12 h-12 rounded-2xl {{ $isUpcoming ? 'bg-gradient-to-br from-primary-600 to-emerald-600 text-white shadow-xs' : 'bg-slate-100 text-slate-600 border border-slate-200' }} flex flex-col items-center justify-center shrink-0">
                                            <span class="text-base font-extrabold leading-none tabular-nums">{{ $tgl->format('d') }}</span>
                                            <span class="text-[10px] font-bold uppercase tracking-wider mt-0.5 opacity-90">{{ $tgl->format('M') }}</span>
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900 tabular-nums">{{ $tgl->format('d F Y') }}</p>
                                            @if($tgl->isToday())
                                                <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 mt-0.5">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Hari Ini
                                                </span>
                                            @elseif($tgl->isFuture())
                                                <span class="text-[11px] font-semibold text-primary-600 mt-0.5 block">Akan Datang</span>
                                            @else
                                                <span class="text-[11px] font-medium text-slate-400 mt-0.5 block">Terlaksana</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                {{-- Posyandu & Desa --}}
                                <td class="py-4 px-6">
                                    <p class="font-bold text-slate-800">{{ $jadwal->posyandu->nama }}</p>
                                    <p class="text-xs text-slate-400 mt-0.5">Desa {{ $jadwal->posyandu->desa->nama }}</p>
                                </td>

                                {{-- Kegiatan --}}
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-bold bg-primary-50 text-primary-800 border border-primary-100">
                                        {{ $jadwal->kegiatan }}
                                    </span>
                                </td>

                                {{-- Keterangan --}}
                                <td class="py-4 px-6 text-slate-600 max-w-xs">
                                    {{ $jadwal->keterangan ?? '-' }}
                                </td>

                                {{-- Kolom Aksi --}}
                                <td class="py-4 px-6 text-center">
                                    <div class="inline-flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}"
                                           class="inline-flex items-center gap-1 bg-amber-50 text-amber-800 hover:bg-amber-100 border border-amber-200/80 py-1.5 px-3 rounded-xl text-xs font-bold transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                                            </svg>
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center gap-1 bg-rose-50 text-rose-700 hover:bg-rose-100 border border-rose-200/80 py-1.5 px-3 rounded-xl text-xs font-bold transition-all">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-14 px-6 text-center">
                                    <div class="mx-auto w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                        </svg>
                                    </div>
                                    <p class="font-bold text-slate-800 text-sm">Belum Ada Jadwal Posyandu</p>
                                    <p class="text-xs text-slate-500 mt-1">Klik tombol "+ Tambah Jadwal" di atas untuk membuat agenda kegiatan baru.</p>
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
            const searchInput = document.getElementById('jadwalSearchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    const keyword = this.value.toLowerCase().trim();
                    document.querySelectorAll('.jadwal-row').forEach(row => {
                        row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
                    });
                });
            }
        });
    </script>
</x-app-layout>