<x-app-layout>
    <div class="max-w-4xl mx-auto space-y-6">
        {{-- 1. BREADCRUMB & EXECUTIVE HEADER BANNER --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-primary-950 to-primary-900 p-6 sm:p-8 text-white shadow-lg border border-primary-800/50">
            <div class="pointer-events-none absolute -right-12 -top-12 h-56 w-56 rounded-full bg-emerald-400/15 blur-2xl"></div>
            <div class="pointer-events-none absolute right-28 -bottom-16 h-48 w-48 rounded-full bg-amber-400/15 blur-2xl"></div>

            <div class="relative">
                {{-- Breadcrumb Navigasi --}}
                <nav class="flex items-center gap-2 text-xs font-medium text-slate-300 mb-4">
                    <a href="{{ route('kader.ibu_hamil.index') }}" class="hover:text-emerald-300 transition-colors inline-flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        Data Ibu Hamil
                    </a>
                    <span class="text-slate-500">/</span>
                    <span class="text-emerald-300 font-semibold">Edit Data Ibu Hamil</span>
                </nav>

                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-white/10 border border-white/20 backdrop-blur-xs text-emerald-300 font-extrabold text-lg flex items-center justify-center shrink-0 shadow-sm">
                        {{ strtoupper(substr($ibuHamil->nama, 0, 2)) }}
                    </div>
                    <div>
                        <div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full bg-white/10 border border-white/15 text-[11px] font-semibold text-amber-300 mb-1.5">
                            <span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>
                            Pembaruan Data Sasaran KIA
                        </div>
                        <h2 class="font-extrabold text-2xl sm:text-[1.7rem] tracking-tight text-white">
                            Edit Data Ibu Hamil
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-300 mt-0.5">
                            Perbarui profil kehamilan, riwayat obstetri, dan antropometri untuk <strong class="text-white font-semibold">{{ $ibuHamil->nama }}</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. ALERT VALIDASI ERROR --}}
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

        {{-- 3. FORM CARD TERSTRUKTUR --}}
        <div class="bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden">
            <div class="px-6 sm:px-8 py-5 border-b border-slate-100 bg-slate-50/70 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-slate-900">Formulir Pembaruan Data Ibu Hamil</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Perubahan pada HPHT, Tinggi Badan, atau LILA akan menyesuaikan kalkulasi HPL dan status risiko.</p>
                </div>
                <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-primary-50 text-primary-700 border border-primary-100">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary-600"></span>
                    Mode Sunting
                </span>
            </div>

            <form action="{{ route('kader.ibu_hamil.update', $ibuHamil->id) }}" method="POST" class="p-6 sm:p-8 space-y-8">
                @csrf
                @method('PUT')

                {{-- SEKSI A: IDENTITAS & KONTAK --}}
                <div class="space-y-5">
                    <div class="flex items-center gap-2.5 pb-2 border-b border-slate-100">
                        <span class="w-6 h-6 rounded-lg bg-primary-100 text-primary-800 font-extrabold text-xs flex items-center justify-center">1</span>
                        <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-700">Identitas Ibu & Keluarga</h4>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="nik" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                                NIK Ibu <span class="text-rose-500">*</span>
                            </label>
                            <input type="text"
                                   id="nik"
                                   name="nik"
                                   value="{{ old('nik', $ibuHamil->nik) }}"
                                   maxlength="16"
                                   required
                                   placeholder="16 digit Nomor Induk Kependudukan"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-semibold text-sm tabular-nums focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                        </div>

                        <div>
                            <label for="nama" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                                Nama Lengkap Ibu <span class="text-rose-500">*</span>
                            </label>
                            <input type="text"
                                   id="nama"
                                   name="nama"
                                   value="{{ old('nama', $ibuHamil->nama) }}"
                                   required
                                   placeholder="Masukkan nama lengkap sesuai KTP"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-medium text-sm focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <div>
                            <label for="umur" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                                Umur <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number"
                                       id="umur"
                                       name="umur"
                                       value="{{ old('umur', $ibuHamil->umur) }}"
                                       required
                                       placeholder="Cth: 27"
                                       class="w-full pl-4 pr-16 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-bold text-sm tabular-nums focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-xs font-extrabold uppercase text-slate-400">
                                    Tahun
                                </span>
                            </div>
                        </div>

                        <div>
                            <label for="nama_suami" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                                Nama Suami
                            </label>
                            <input type="text"
                                   id="nama_suami"
                                   name="nama_suami"
                                   value="{{ old('nama_suami', $ibuHamil->nama_suami) }}"
                                   placeholder="Nama lengkap suami"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-medium text-sm focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                        </div>

                        <div>
                            <label for="no_hp" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                                No. HP / WhatsApp
                            </label>
                            <input type="text"
                                   id="no_hp"
                                   name="no_hp"
                                   value="{{ old('no_hp', $ibuHamil->no_hp) }}"
                                   placeholder="08xxxxxxxxxx"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-medium text-sm tabular-nums focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                        </div>
                    </div>
                </div>

                {{-- SEKSI B: RIWAYAT OBSTETRI (GPA) --}}
                <div class="space-y-5">
                    <div class="flex items-center gap-2.5 pb-2 border-b border-slate-100">
                        <span class="w-6 h-6 rounded-lg bg-amber-100 text-amber-800 font-extrabold text-xs flex items-center justify-center">2</span>
                        <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-700">Riwayat Kehamilan (Gravida / Para / Abortus)</h4>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <div>
                            <label for="gravida" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                                Gravida (Kehamilan ke-)
                            </label>
                            <input type="number"
                                   id="gravida"
                                   name="gravida"
                                   value="{{ old('gravida', $ibuHamil->gravida ?? 1) }}"
                                   min="1"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-bold text-sm tabular-nums focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                        </div>

                        <div>
                            <label for="para" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                                Para (Anak Lahir)
                            </label>
                            <input type="number"
                                   id="para"
                                   name="para"
                                   value="{{ old('para', $ibuHamil->para ?? 0) }}"
                                   min="0"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-bold text-sm tabular-nums focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                        </div>

                        <div>
                            <label for="abortus" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                                Abortus (Keguguran)
                            </label>
                            <input type="number"
                                   id="abortus"
                                   name="abortus"
                                   value="{{ old('abortus', $ibuHamil->abortus ?? 0) }}"
                                   min="0"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-bold text-sm tabular-nums focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                        </div>
                    </div>
                </div>

                {{-- SEKSI C: USIA KEHAMILAN & ANTROPOMETRI --}}
                <div class="space-y-5">
                    <div class="flex items-center gap-2.5 pb-2 border-b border-slate-100">
                        <span class="w-6 h-6 rounded-lg bg-emerald-100 text-emerald-800 font-extrabold text-xs flex items-center justify-center">3</span>
                        <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-700">HPHT & Pengukuran Fisik</h4>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <div>
                            <label for="hpht" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                                HPHT <span class="text-slate-400 font-normal normal-case">(Haid Terakhir)</span>
                            </label>
                            <input type="date"
                                   id="hpht"
                                   name="hpht"
                                   value="{{ old('hpht', $ibuHamil->hpht) }}"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-semibold text-sm focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                        </div>

                        <div>
                            <label for="tinggi_badan" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                                Tinggi Badan
                            </label>
                            <div class="relative">
                                <input type="number"
                                       step="0.1"
                                       id="tinggi_badan"
                                       name="tinggi_badan"
                                       value="{{ old('tinggi_badan', $ibuHamil->tinggi_badan) }}"
                                       placeholder="Cth: 156.5"
                                       class="w-full pl-4 pr-12 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-bold text-sm tabular-nums focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-xs font-extrabold uppercase text-slate-400">
                                    cm
                                </span>
                            </div>
                        </div>

                        <div>
                            <label for="lingkar_lengan_atas" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                                LILA <span class="text-slate-400 font-normal normal-case">(Lingkar Lengan)</span>
                            </label>
                            <div class="relative">
                                <input type="number"
                                       step="0.1"
                                       id="lingkar_lengan_atas"
                                       name="lingkar_lengan_atas"
                                       value="{{ old('lingkar_lengan_atas', $ibuHamil->lingkar_lengan_atas) }}"
                                       placeholder="Cth: 24.5"
                                       class="w-full pl-4 pr-12 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-bold text-sm tabular-nums focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-xs font-extrabold uppercase text-slate-400">
                                    cm
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FOOTER TOMBOL AKSI --}}
                <div class="pt-6 border-t border-slate-100 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3">
                    <a href="{{ route('kader.ibu_hamil.index') }}"
                       class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-sm transition-all">
                        Batal
                    </a>
                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl bg-gradient-to-r from-primary-700 via-primary-600 to-emerald-600 hover:from-primary-800 hover:to-emerald-700 text-white font-bold text-sm shadow-sm transition-all hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>