<x-app-layout>
    @php
        $totalIbuHamil = $ibuHamils->count();
        $risikoTinggiCount = $ibuHamils->filter(function ($item) {
            return $item->status_risiko !== 'Normal';
        })->count();
        $hplDekatCount = $ibuHamils->filter(function ($item) {
            if (!$item->hpl) return false;
            $hplDate = \Carbon\Carbon::parse($item->hpl)->startOfDay();
            return $hplDate->gte(now()->startOfDay()) && $hplDate->lte(now()->addDays(30)->endOfDay());
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
                        Data Ibu Hamil
                    </h2>
                    <p class="text-sm sm:text-base text-slate-300 mt-1.5 max-w-2xl">
                        Pantau kesehatan kehamilan, Hari Perkiraan Lahir (HPL), serta deteksi dini faktor risiko ibu hamil di Posyandu Anda.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    {{-- Mini Summary Pill --}}
                    <div class="px-4 py-2.5 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-xs">
                        <p class="text-[11px] uppercase tracking-wider font-semibold text-slate-300">Total Sasaran</p>
                        <p class="text-xl font-extrabold text-white tabular-nums mt-0.5">
                            {{ $totalIbuHamil }} <span class="text-xs font-normal text-slate-300">Ibu Hamil</span>
                        </p>
                    </div>

                    <a href="{{ route('kader.ibu_hamil.create') }}"
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-slate-950 font-bold text-sm px-5 py-3.5 rounded-2xl shadow-md shadow-emerald-950/30 transition-all duration-200 hover:-translate-y-0.5">
                        <svg class="w-4 h-4 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Ibu Hamil
                    </a>
                </div>
            </div>
        </div>

        {{-- 2. ALERT NOTIFIKASI SUKSES & PERINGATAN RISIKO TINGGI --}}
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

        @if($risikoTinggiCount > 0)
            <div class="flex items-center gap-3 bg-gradient-to-r from-rose-50 via-amber-50/70 to-white border border-rose-200/90 px-5 py-4 rounded-2xl shadow-2xs">
                <div class="w-9 h-9 rounded-xl bg-rose-600 text-white flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-rose-800">Pemantauan Khusus Kehamilan</p>
                    <p class="text-sm text-slate-700">
                        Terdapat <strong class="font-bold text-rose-700">{{ $risikoTinggiCount }} ibu hamil</strong> dengan status risiko yang memerlukan pendampingan intensif bersama Bidan Desa.
                    </p>
                </div>
            </div>
        @endif

        {{-- 3. TABEL DATA IBU HAMIL MODERN --}}
        <div class="bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden">
            {{-- Toolbar & Pencarian Instan --}}
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/70 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-2.5">
                    <h3 class="font-bold text-slate-900">Daftar Sasaran Ibu Hamil</h3>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-primary-100 text-primary-800 tabular-nums">
                        {{ $totalIbuHamil }} Terdaftar
                    </span>
                    @if($hplDekatCount > 0)
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-amber-100 text-amber-800 tabular-nums">
                            {{ $hplDekatCount }} HPL ≤ 30 Hari
                        </span>
                    @endif
                </div>

                <div class="relative w-full sm:w-72">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <input type="text"
                           id="ibuHamilSearchInput"
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
                            <th class="py-3.5 px-6">HPL (Perkiraan Lahir)</th>
                            <th class="py-3.5 px-6">Status Risiko</th>
                            <th class="py-3.5 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($ibuHamils as $ibu)
                            @php
                                $hplDate = $ibu->hpl ? \Carbon\Carbon::parse($ibu->hpl) : null;
                                $isHplSoon = $hplDate && $hplDate->startOfDay()->gte(now()->startOfDay()) && $hplDate->startOfDay()->lte(now()->addDays(30)->endOfDay());
                            @endphp
                            <tr class="ibu-hamil-row group hover:bg-slate-50/90 transition-colors">
                                {{-- Nama Ibu + Avatar --}}
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3.5">
                                        <div class="w-10 h-10 rounded-xl {{ $ibu->status_risiko === 'Normal' ? 'bg-gradient-to-br from-emerald-100 to-primary-100 text-primary-800 border-primary-200/60' : 'bg-gradient-to-br from-rose-100 to-amber-100 text-rose-800 border-rose-200/70' }} font-bold text-xs flex items-center justify-center shrink-0 border">
                                            {{ strtoupper(substr($ibu->nama, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900 group-hover:text-primary-700 transition-colors">
                                                {{ $ibu->nama }}
                                            </p>
                                            <p class="text-xs text-slate-400 mt-0.5">Peserta Pemantauan KIA</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Umur --}}
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-semibold text-xs tabular-nums">
                                        {{ $ibu->umur }} Tahun
                                    </span>
                                </td>

                                {{-- HPL --}}
                                <td class="py-4 px-6 tabular-nums">
                                    @if($hplDate)
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-slate-800">
                                                {{ $hplDate->format('d/m/Y') }}
                                            </span>
                                            @if($isHplSoon)
                                                <span class="text-[11px] font-bold text-amber-700 mt-0.5">
                                                    {{ $hplDate->diffForHumans() }}
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-slate-400 text-xs">-</span>
                                    @endif
                                </td>

                                {{-- Status Risiko --}}
                                <td class="py-4 px-6">
                                    @if($ibu->status_risiko === 'Normal')
                                        <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-800 border border-emerald-200/90 px-3 py-1 rounded-full text-xs font-extrabold uppercase">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            NORMAL
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-800 border border-rose-200/90 px-3 py-1 rounded-full text-xs font-extrabold uppercase">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                            {{ $ibu->status_risiko }}
                                        </span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td class="py-4 px-6 text-center">
                                    <div class="inline-flex items-center justify-center gap-2">
                                        <a href="{{ route('kader.ibu_hamil.edit', $ibu->id) }}"
                                           class="inline-flex items-center gap-1 bg-amber-50 text-amber-800 hover:bg-amber-100 border border-amber-200/80 py-1.5 px-3 rounded-xl text-xs font-bold transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                                            </svg>
                                            Edit
                                        </a>

                                        <form action="{{ route('kader.ibu_hamil.destroy', $ibu->id) }}" method="POST" onsubmit="return confirm('Hapus data ibu hamil ini?');">
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
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                        </svg>
                                    </div>
                                    <p class="font-bold text-slate-800 text-sm">Belum Ada Data Ibu Hamil</p>
                                    <p class="text-xs text-slate-500 mt-1">Klik tombol "+ Tambah Ibu Hamil" di atas untuk menambahkan sasaran baru.</p>
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
            const searchInput = document.getElementById('ibuHamilSearchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    const keyword = this.value.toLowerCase().trim();
                    document.querySelectorAll('.ibu-hamil-row').forEach(row => {
                        row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
                    });
                });
            }
        });
    </script>
</x-app-layout>