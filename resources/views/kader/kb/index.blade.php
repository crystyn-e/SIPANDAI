<x-app-layout>
    @php
        $totalKb = $kbs->count();
        $jadwalDekatCount = $kbs->filter(function ($item) {
            if (!$item->jadwal_ulang) return false;
            $jadwal = \Carbon\Carbon::parse($item->jadwal_ulang)->startOfDay();
            return $jadwal->lte(now()->addDays(7)->endOfDay());
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
                        <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                        {{ Auth::user()->posyandu->nama ?? 'Unit Layanan Posyandu' }}
                        @if(Auth::user()->posyandu?->desa)
                            • Desa {{ Auth::user()->posyandu->desa->nama }}
                        @endif
                    </div>
                    <h2 class="font-extrabold text-2xl sm:text-3xl tracking-tight text-white">
                        Data Peserta KB
                    </h2>
                    <p class="text-sm sm:text-base text-slate-300 mt-1.5 max-w-2xl">
                        Pantau kepesertaan Keluarga Berencana, jenis kontrasepsi, dan jadwal kontrol ulang warga di Posyandu Anda.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    {{-- Mini Summary Pill --}}
                    <div class="px-4 py-2.5 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-xs">
                        <p class="text-[11px] uppercase tracking-wider font-semibold text-slate-300">Peserta Aktif</p>
                        <p class="text-xl font-extrabold text-white tabular-nums mt-0.5">
                            {{ $totalKb }} <span class="text-xs font-normal text-slate-300">Akseptor</span>
                        </p>
                    </div>

                    <a href="{{ route('kader.kb.create') }}"
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-slate-950 font-bold text-sm px-5 py-3.5 rounded-2xl shadow-md shadow-emerald-950/30 transition-all duration-200 hover:-translate-y-0.5">
                        <svg class="w-4 h-4 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Peserta KB
                    </a>
                </div>
            </div>
        </div>

        {{-- 2. ALERT NOTIFIKASI SUKSES & PENGINGAT JADWAL ULANG --}}
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

        @if($jadwalDekatCount > 0)
            <div class="flex items-center gap-3 bg-gradient-to-r from-amber-50 via-orange-50/70 to-white border border-amber-200/90 px-5 py-4 rounded-2xl shadow-2xs">
                <div class="w-9 h-9 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-amber-800">Pengingat Kontrol Ulang</p>
                    <p class="text-sm text-slate-700">
                        Terdapat <strong class="font-bold text-slate-900">{{ $jadwalDekatCount }} peserta KB</strong> dengan jadwal kunjungan ulang dalam 7 hari ke depan atau sudah jatuh tempo.
                    </p>
                </div>
            </div>
        @endif

        {{-- 3. TABEL DATA PESERTA KB MODERN --}}
        <div class="bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden">
            {{-- Toolbar & Pencarian Instan --}}
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/70 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-2.5">
                    <h3 class="font-bold text-slate-900">Daftar Akseptor Keluarga Berencana</h3>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-primary-100 text-primary-800 tabular-nums">
                        {{ $totalKb }} Peserta
                    </span>
                </div>

                <div class="relative w-full sm:w-72">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <input type="text"
                           id="kbSearchInput"
                           placeholder="Cari nama peserta, kontrasepsi..."
                           class="w-full pl-10 pr-4 py-2 text-sm bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
                        <tr>
                            <th class="py-3.5 px-6">Nama Peserta</th>
                            <th class="py-3.5 px-6">Umur</th>
                            <th class="py-3.5 px-6">Jenis Kontrasepsi</th>
                            <th class="py-3.5 px-6">Tanggal Mulai</th>
                            <th class="py-3.5 px-6">Jadwal Ulang</th>
                            <th class="py-3.5 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($kbs as $kb)
                            @php
                                $jadwalUlang = $kb->jadwal_ulang ? \Carbon\Carbon::parse($kb->jadwal_ulang) : null;
                                $isDueSoon = $jadwalUlang && $jadwalUlang->startOfDay()->lte(now()->addDays(7)->endOfDay());
                                $isOverdue = $jadwalUlang && $jadwalUlang->startOfDay()->lt(now()->startOfDay());
                            @endphp
                            <tr class="kb-search-row group hover:bg-slate-50/90 transition-colors">
                                {{-- Nama Peserta + Avatar --}}
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3.5">
                                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-100 to-emerald-100 text-primary-800 font-bold text-xs flex items-center justify-center shrink-0 border border-primary-200/60">
                                            {{ strtoupper(substr($kb->nama_peserta, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900 group-hover:text-primary-700 transition-colors">
                                                {{ $kb->nama_peserta }}
                                            </p>
                                            <p class="text-xs text-slate-400 mt-0.5">Akseptor KB Aktif</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Umur --}}
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-semibold text-xs tabular-nums">
                                        {{ $kb->umur }} Thn
                                    </span>
                                </td>

                                {{-- Kontrasepsi --}}
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center gap-1.5 bg-primary-50 text-primary-800 border border-primary-200/80 px-3 py-1 rounded-full text-xs font-extrabold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-primary-600"></span>
                                        {{ $kb->jenis_kontrasepsi }}
                                    </span>
                                </td>

                                {{-- Tanggal Mulai --}}
                                <td class="py-4 px-6 text-slate-600 font-medium tabular-nums">
                                    {{ \Carbon\Carbon::parse($kb->tanggal_mulai)->format('d/m/Y') }}
                                </td>

                                {{-- Jadwal Ulang --}}
                                <td class="py-4 px-6 tabular-nums">
                                    @if($jadwalUlang)
                                        @if($isOverdue)
                                            <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-800 border border-rose-200/90 px-3 py-1 rounded-full text-xs font-bold">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                                {{ $jadwalUlang->format('d/m/Y') }}
                                            </span>
                                        @elseif($isDueSoon)
                                            <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-800 border border-amber-200/90 px-3 py-1 rounded-full text-xs font-bold">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                                {{ $jadwalUlang->format('d/m/Y') }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 text-slate-700 font-semibold">
                                                {{ $jadwalUlang->format('d/m/Y') }}
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-slate-400 text-xs">-</span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td class="py-4 px-6 text-center">
                                    <div class="inline-flex items-center justify-center gap-2">
                                        <a href="{{ route('kader.kb.edit', $kb->id) }}"
                                           class="inline-flex items-center gap-1 bg-amber-50 text-amber-800 hover:bg-amber-100 border border-amber-200/80 py-1.5 px-3 rounded-xl text-xs font-bold transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                                            </svg>
                                            Edit
                                        </a>

                                        <form action="{{ route('kader.kb.destroy', $kb->id) }}" method="POST" onsubmit="return confirm('Hapus data KB ini?');">
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
                                <td colspan="6" class="py-14 px-6 text-center">
                                    <div class="mx-auto w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25Z" />
                                        </svg>
                                    </div>
                                    <p class="font-bold text-slate-800 text-sm">Belum Ada Data Peserta KB</p>
                                    <p class="text-xs text-slate-500 mt-1">Klik tombol "+ Tambah Peserta KB" di atas untuk mendaftarkan peserta baru.</p>
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
            const searchInput = document.getElementById('kbSearchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    const keyword = this.value.toLowerCase().trim();
                    document.querySelectorAll('.kb-search-row').forEach(row => {
                        row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
                    });
                });
            }
        });
    </script>
</x-app-layout>