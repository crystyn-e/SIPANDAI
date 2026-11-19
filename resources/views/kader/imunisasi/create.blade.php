<x-app-layout>
    <div class="space-y-6">
        {{-- 1. BREADCRUMB & EXECUTIVE HEADER BANNER --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-primary-950 to-primary-900 p-6 sm:p-8 text-white shadow-lg border border-primary-800/50">
            <div class="pointer-events-none absolute -right-12 -top-12 h-56 w-56 rounded-full bg-emerald-400/15 blur-2xl"></div>
            <div class="pointer-events-none absolute right-28 -bottom-16 h-48 w-48 rounded-full bg-amber-400/15 blur-2xl"></div>

            <div class="relative">
                {{-- Breadcrumb --}}
                <nav class="flex items-center gap-2 text-xs font-medium text-slate-300 mb-4">
                    <a href="{{ route('kader.anak.index') }}" class="hover:text-emerald-300 transition-colors inline-flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        Data Anak Posyandu
                    </a>
                    <span class="text-slate-500">/</span>
                    <span class="text-emerald-300 font-semibold">Layanan Imunisasi</span>
                </nav>

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-white/10 border border-white/20 backdrop-blur-xs text-emerald-300 font-extrabold text-lg flex items-center justify-center shrink-0 shadow-sm">
                            {{ strtoupper(substr($anak->nama, 0, 2)) }}
                        </div>
                        <div>
                            <div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full bg-white/10 border border-white/15 text-[11px] font-semibold text-emerald-300 mb-1.5">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                Pencatatan Vaksinasi Balita
                            </div>
                            <h2 class="font-extrabold text-2xl sm:text-3xl tracking-tight text-white">
                                Imunisasi: {{ $anak->nama }}
                            </h2>
                            <p class="text-xs sm:text-sm text-slate-300 mt-1">
                                Usia saat ini: <strong class="text-white font-semibold">{{ \Carbon\Carbon::parse($anak->tanggal_lahir)->diffForHumans(null, true) }}</strong>
                                @if($anak->orangtua)
                                    • Orang Tua: <strong class="text-white font-semibold">{{ $anak->orangtua->name }}</strong>
                                @endif
                            </p>
                        </div>
                    </div>

                    {{-- Ringkasan Total Imunisasi --}}
                    <div class="px-4 py-3 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-xs shrink-0">
                        <p class="text-[11px] uppercase tracking-wider font-semibold text-slate-300">Riwayat Tercatat</p>
                        <p class="text-2xl font-extrabold text-emerald-300 tabular-nums mt-0.5">
                            {{ $imunisasis->count() }} <span class="text-xs font-normal text-slate-300">Dosis Vaksin</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. ALERT NOTIFIKASI SUKSES & VALIDASI ERROR --}}
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

        @if ($errors->any())
            <div class="bg-rose-50 border border-rose-200/90 text-rose-900 px-5 py-4 rounded-2xl shadow-2xs">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-xl bg-rose-600 text-white flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-rose-700">Periksa Kembali Input Anda</p>
                        <ul class="mt-1 text-sm list-disc list-inside space-y-0.5 text-rose-800">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- 3. GRID 2 KOLOM: FORM TAMBAH IMUNISASI & RIWAYAT IMUNISASI --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            {{-- KOLOM KIRI (5 KOLOM): FORM TAMBAH IMUNISASI --}}
            <div class="lg:col-span-5 bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/70 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-slate-900">Tambah Imunisasi Baru</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Pilih jenis vaksin dan tanggal pemberian.</p>
                    </div>
                    <span class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200/80 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </span>
                </div>

                <form action="{{ route('kader.imunisasi.store', $anak->id) }}" method="POST" class="p-6 space-y-5">
                    @csrf

                    {{-- Jenis Imunisasi --}}
                    <div>
                        <label for="jenis_imunisasi" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                            Jenis Imunisasi <span class="text-rose-500">*</span>
                        </label>
                        <select id="jenis_imunisasi"
                                name="jenis_imunisasi"
                                required
                                class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-semibold text-sm focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                            <option value="">-- Pilih Vaksin --</option>
                            <option value="HB-0" {{ old('jenis_imunisasi') === 'HB-0' ? 'selected' : '' }}>HB-0 (0 Bulan)</option>
                            <option value="BCG" {{ old('jenis_imunisasi') === 'BCG' ? 'selected' : '' }}>BCG (1 Bulan)</option>
                            <option value="Polio 1" {{ old('jenis_imunisasi') === 'Polio 1' ? 'selected' : '' }}>Polio 1</option>
                            <option value="DPT-HB-Hib 1" {{ old('jenis_imunisasi') === 'DPT-HB-Hib 1' ? 'selected' : '' }}>DPT-HB-Hib 1</option>
                            <option value="Polio 2" {{ old('jenis_imunisasi') === 'Polio 2' ? 'selected' : '' }}>Polio 2</option>
                            <option value="DPT-HB-Hib 2" {{ old('jenis_imunisasi') === 'DPT-HB-Hib 2' ? 'selected' : '' }}>DPT-HB-Hib 2</option>
                            <option value="Polio 3" {{ old('jenis_imunisasi') === 'Polio 3' ? 'selected' : '' }}>Polio 3</option>
                            <option value="DPT-HB-Hib 3" {{ old('jenis_imunisasi') === 'DPT-HB-Hib 3' ? 'selected' : '' }}>DPT-HB-Hib 3</option>
                            <option value="IPV" {{ old('jenis_imunisasi') === 'IPV' ? 'selected' : '' }}>IPV</option>
                            <option value="Campak/MR" {{ old('jenis_imunisasi') === 'Campak/MR' ? 'selected' : '' }}>Campak/MR</option>
                        </select>
                    </div>

                    {{-- Tanggal Imunisasi --}}
                    <div>
                        <label for="tanggal_imunisasi" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                            Tanggal Imunisasi <span class="text-rose-500">*</span>
                        </label>
                        <input type="date"
                               id="tanggal_imunisasi"
                               name="tanggal_imunisasi"
                               value="{{ old('tanggal_imunisasi', date('Y-m-d')) }}"
                               required
                               class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-medium text-sm focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                    </div>

                    {{-- Keterangan --}}
                    <div>
                        <label for="keterangan" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                            Keterangan <span class="text-slate-400 font-normal normal-case">(Opsional)</span>
                        </label>
                        <textarea id="keterangan"
                                  name="keterangan"
                                  rows="2"
                                  placeholder="Nomor batch vaksin, reaksi KIPI, atau catatan petugas..."
                                  class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-medium text-sm focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">{{ old('keterangan') }}</textarea>
                    </div>

                    <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-primary-700 via-primary-600 to-emerald-600 hover:from-primary-800 hover:to-emerald-700 text-white font-bold text-sm py-3 px-5 rounded-xl shadow-sm transition-all hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        Simpan Imunisasi
                    </button>
                </form>
            </div>

            {{-- KOLOM KANAN (7 KOLOM): RIWAYAT IMUNISASI --}}
            <div class="lg:col-span-7 bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/70 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-slate-900">Riwayat Imunisasi Tercatat</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Daftar vaksinasi yang sudah diterima oleh {{ $anak->nama }}.</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-extrabold bg-primary-50 text-primary-800 border border-primary-100 tabular-nums">
                        {{ $imunisasis->count() }} Catatan
                    </span>
                </div>

                <div class="overflow-x-auto max-h-[28rem] overflow-y-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider sticky top-0 z-10">
                            <tr>
                                <th class="py-3.5 px-6">Tanggal</th>
                                <th class="py-3.5 px-6">Jenis Vaksin</th>
                                <th class="py-3.5 px-6">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($imunisasis as $imunisasi)
                                <tr class="hover:bg-slate-50/90 transition-colors">
                                    <td class="py-4 px-6 whitespace-nowrap">
                                        <span class="inline-flex items-center gap-1.5 text-slate-700 font-semibold tabular-nums">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($imunisasi->tanggal_imunisasi)->format('d/m/Y') }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-800 border border-emerald-200/90 px-3 py-1 rounded-full text-xs font-extrabold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            {{ $imunisasi->jenis_imunisasi }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-xs text-slate-500">
                                        {{ $imunisasi->keterangan ?: '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-14 px-6 text-center">
                                        <div class="mx-auto w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25Z" />
                                            </svg>
                                        </div>
                                        <p class="font-bold text-slate-800 text-sm">Belum Ada Riwayat Imunisasi</p>
                                        <p class="text-xs text-slate-500 mt-1">Gunakan formulir di sebelah kiri untuk mencatat vaksinasi pertama.</p>
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