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
                        Basis Data Sasaran Posyandu
                    </div>
                    <h2 class="font-extrabold text-2xl sm:text-3xl tracking-tight text-white">
                        Pusat Data Warga
                    </h2>
                    <p class="text-sm sm:text-base text-slate-300 mt-1.5 max-w-2xl">
                        Kelola dan pantau seluruh data sasaran Balita serta Ibu Hamil lintas Posyandu dan Desa.
                    </p>
                </div>

                {{-- Mini Summary Pill di Header --}}
                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    <div class="px-4 py-3 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-xs">
                        <p class="text-[11px] uppercase tracking-wider font-semibold text-slate-300">Total Balita</p>
                        <p class="text-xl font-extrabold text-white tabular-nums mt-0.5">{{ $anak->count() }} <span class="text-xs font-normal text-slate-300">Anak</span></p>
                    </div>
                    <div class="px-4 py-3 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-xs">
                        <p class="text-[11px] uppercase tracking-wider font-semibold text-slate-300">Total Ibu Hamil</p>
                        <p class="text-xl font-extrabold text-emerald-300 tabular-nums mt-0.5">{{ $ibuHamil->count() }} <span class="text-xs font-normal text-slate-300">Orang</span></p>
                    </div>
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

        {{-- 3. CONTROL BAR: SEGMENTED PILL TABS + PENCARIAN INSTAN --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-3 rounded-2xl border border-slate-200/90 shadow-2xs">
            {{-- Segmented Pill Tabs --}}
            <div class="inline-flex p-1 rounded-xl bg-slate-100/90 border border-slate-200/60" id="myTab" role="tablist">
                <button id="anak-tab"
                        data-tabs-target="#anak"
                        type="button"
                        role="tab"
                        aria-controls="anak"
                        aria-selected="true"
                        class="tab-btn active-tab inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-bold transition-all duration-200 bg-white text-primary-800 shadow-xs">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                    </svg>
                    Data Anak (Balita)
                    <span class="tab-badge ml-1 px-2 py-0.5 rounded-full text-xs font-extrabold bg-primary-100 text-primary-800 tabular-nums">
                        {{ $anak->count() }}
                    </span>
                </button>

                <button id="ibu-tab"
                        data-tabs-target="#ibu"
                        type="button"
                        role="tab"
                        aria-controls="ibu"
                        aria-selected="false"
                        class="tab-btn inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-bold transition-all duration-200 text-slate-600 hover:text-slate-900">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                    Data Ibu Hamil
                    <span class="tab-badge ml-1 px-2 py-0.5 rounded-full text-xs font-extrabold bg-slate-200/80 text-slate-700 tabular-nums">
                        {{ $ibuHamil->count() }}
                    </span>
                </button>
            </div>

            {{-- Search Input Instan --}}
            <div class="relative w-full md:w-72">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
                <input type="text"
                       id="tableSearchInput"
                       placeholder="Cari nama, desa, atau posyandu..."
                       class="w-full pl-10 pr-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
            </div>
        </div>

        {{-- 4. KONTEN TAB --}}
        <div id="myTabContent">
            {{-- TAB 1: DATA ANAK (BALITA) --}}
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden" id="anak" role="tabpanel" aria-labelledby="anak-tab">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/60 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-slate-900">Daftar Balita Terdaftar</h3>
                        <p class="text-xs text-slate-500">Data anak yang terdaftar pada unit Posyandu di wilayah kecamatan.</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
                            <tr>
                                <th class="py-3.5 px-6">Nama Anak</th>
                                <th class="py-3.5 px-6">Tanggal Lahir</th>
                                <th class="py-3.5 px-6">Desa / Posyandu</th>
                                <th class="py-3.5 px-6">Orang Tua</th>
                                <th class="py-3.5 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($anak as $a)
                                <tr class="searchable-row group hover:bg-slate-50/90 transition-colors">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary-100 to-emerald-100 text-primary-800 font-bold text-xs flex items-center justify-center shrink-0 border border-primary-200/60">
                                                {{ strtoupper(substr($a->nama, 0, 2)) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-slate-900 group-hover:text-primary-700 transition-colors">{{ $a->nama }}</p>
                                                <p class="text-xs text-slate-400">Balita</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center gap-1.5 text-slate-700 font-medium tabular-nums">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($a->tanggal_lahir)->format('d/m/Y') }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <p class="font-semibold text-slate-800">{{ $a->posyandu->desa->nama ?? '-' }}</p>
                                        <p class="text-xs text-slate-400 mt-0.5">{{ $a->posyandu->nama ?? '-' }}</p>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="text-slate-700 font-medium">{{ $a->orangtua->name ?? '-' }}</span>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="inline-flex items-center justify-center gap-2">
                                            {{-- Tombol Edit Anak --}}
                                            <a href="{{ route('admin.data-warga.edit-anak', $a->id) }}"
                                               class="inline-flex items-center gap-1 bg-amber-50 text-amber-800 hover:bg-amber-100 border border-amber-200/80 py-1.5 px-3 rounded-xl text-xs font-bold transition-all">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                                                </svg>
                                                Edit
                                            </a>

                                            {{-- Tombol Hapus Anak --}}
                                            <form action="{{ route('admin.data-warga.destroy-anak', $a->id) }}" method="POST" onsubmit="return confirm('Hapus data anak ini? Data pemeriksaannya juga akan terhapus.');">
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
                                    <td colspan="5" class="py-12 px-6 text-center">
                                        <p class="font-bold text-slate-800 text-sm">Belum Ada Data Anak</p>
                                        <p class="text-xs text-slate-500 mt-1">Data balita yang didaftarkan oleh kader atau orang tua akan muncul di sini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- TAB 2: DATA IBU HAMIL --}}
            <div class="hidden bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden" id="ibu" role="tabpanel" aria-labelledby="ibu-tab">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/60 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-slate-900">Daftar Ibu Hamil Terdaftar</h3>
                        <p class="text-xs text-slate-500">Pantauan usia kehamilan serta klasifikasi faktor risiko ibu hamil.</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
                            <tr>
                                <th class="py-3.5 px-6">Nama Ibu</th>
                                <th class="py-3.5 px-6">Umur</th>
                                <th class="py-3.5 px-6">Desa / Posyandu</th>
                                <th class="py-3.5 px-6">Status Risiko</th>
                                <th class="py-3.5 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($ibuHamil as $ibu)
                                <tr class="searchable-row group hover:bg-slate-50/90 transition-colors">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-amber-100 to-orange-100 text-amber-800 font-bold text-xs flex items-center justify-center shrink-0 border border-amber-200/60">
                                                {{ strtoupper(substr($ibu->nama, 0, 2)) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-slate-900 group-hover:text-primary-700 transition-colors">{{ $ibu->nama }}</p>
                                                <p class="text-xs text-slate-400">Ibu Hamil</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-semibold text-xs tabular-nums">
                                            {{ $ibu->umur }} Tahun
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <p class="font-semibold text-slate-800">{{ $ibu->posyandu->desa->nama ?? '-' }}</p>
                                        <p class="text-xs text-slate-400 mt-0.5">{{ $ibu->posyandu->nama ?? '-' }}</p>
                                    </td>
                                    <td class="py-4 px-6">
                                        @if($ibu->status_risiko === 'Normal')
                                            <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200/90 px-3 py-1 rounded-full text-xs font-bold">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                NORMAL
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-700 border border-rose-200/90 px-3 py-1 rounded-full text-xs font-bold">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                                {{ strtoupper($ibu->status_risiko) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="inline-flex items-center justify-center gap-2">
                                            {{-- Tombol Edit Ibu Hamil --}}
                                            <a href="{{ route('admin.data-warga.edit-ibu', $ibu->id) }}"
                                               class="inline-flex items-center gap-1 bg-amber-50 text-amber-800 hover:bg-amber-100 border border-amber-200/80 py-1.5 px-3 rounded-xl text-xs font-bold transition-all">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                                                </svg>
                                                Edit
                                            </a>

                                            {{-- Tombol Hapus Ibu Hamil --}}
                                            <form action="{{ route('admin.data-warga.destroy-ibu', $ibu->id) }}" method="POST" onsubmit="return confirm('Hapus data ibu hamil ini?');">
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
                                    <td colspan="5" class="py-12 px-6 text-center">
                                        <p class="font-bold text-slate-800 text-sm">Belum Ada Data Ibu Hamil</p>
                                        <p class="text-xs text-slate-500 mt-1">Data ibu hamil yang didaftarkan oleh kader atau bidan akan muncul di sini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT TAB SWITCHER & LIVE SEARCH --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabButtons = document.querySelectorAll('[data-tabs-target]');
            const tabPanes = document.querySelectorAll('[role="tabpanel"]');
            const searchInput = document.getElementById('tableSearchInput');

            // 1. Logika Tab Switcher Modern
            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    tabButtons.forEach(btn => {
                        btn.classList.remove('bg-white', 'text-primary-800', 'shadow-xs');
                        btn.classList.add('text-slate-600', 'hover:text-slate-900');
                        const badge = btn.querySelector('.tab-badge');
                        if (badge) {
                            badge.classList.remove('bg-primary-100', 'text-primary-800');
                            badge.classList.add('bg-slate-200/80', 'text-slate-700');
                        }
                    });

                    tabPanes.forEach(pane => pane.classList.add('hidden'));

                    button.classList.remove('text-slate-600', 'hover:text-slate-900');
                    button.classList.add('bg-white', 'text-primary-800', 'shadow-xs');
                    const activeBadge = button.querySelector('.tab-badge');
                    if (activeBadge) {
                        activeBadge.classList.remove('bg-slate-200/80', 'text-slate-700');
                        activeBadge.classList.add('bg-primary-100', 'text-primary-800');
                    }

                    const target = document.querySelector(button.dataset.tabsTarget);
                    if (target) target.classList.remove('hidden');
                });
            });

            // 2. Logika Pencarian Instan di Kedua Tab
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    const keyword = this.value.toLowerCase().trim();
                    const rows = document.querySelectorAll('.searchable-row');

                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(keyword) ? '' : 'none';
                    });
                });
            }
        });
    </script>
</x-app-layout>