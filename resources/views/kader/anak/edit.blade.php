<x-app-layout>
    <div class="max-w-3xl mx-auto space-y-6">
        {{-- 1. BREADCRUMB & EXECUTIVE HEADER BANNER --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-primary-950 to-primary-900 p-6 sm:p-8 text-white shadow-lg border border-primary-800/50">
            <div class="pointer-events-none absolute -right-12 -top-12 h-52 w-52 rounded-full bg-emerald-400/15 blur-2xl"></div>
            <div class="pointer-events-none absolute right-24 -bottom-16 h-44 w-44 rounded-full bg-amber-400/15 blur-2xl"></div>

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
                    <span class="text-emerald-300 font-semibold">Edit Data Anak</span>
                </nav>

                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-white/10 border border-white/20 backdrop-blur-xs text-emerald-300 font-extrabold text-lg flex items-center justify-center shrink-0 shadow-sm">
                        {{ strtoupper(substr($anak->nama, 0, 2)) }}
                    </div>
                    <div>
                        <div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full bg-white/10 border border-white/15 text-[11px] font-semibold text-amber-300 mb-1.5">
                            <span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>
                            Pembaruan Profil Balita
                        </div>
                        <h2 class="font-extrabold text-2xl sm:text-[1.7rem] tracking-tight text-white">
                            Edit Data Anak
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-300 mt-0.5">
                            Perbarui identitas kependudukan dan relasi akun orang tua untuk <strong class="text-white font-semibold">{{ $anak->nama }}</strong>.
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

        {{-- 3. FORM CARD UTAMA --}}
        <div class="bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden">
            <div class="px-6 sm:px-8 py-5 border-b border-slate-100 bg-slate-50/70 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-slate-900">Formulir Pembaruan Data Balita & KIA</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Perubahan pada tanggal lahir atau jenis kelamin akan menyesuaikan standar kurva pertumbuhan.</p>
                </div>
                <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-primary-50 text-primary-700 border border-primary-100">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary-600"></span>
                    Mode Sunting
                </span>
            </div>

            <form action="{{ route('kader.anak.update', $anak->id) }}" method="POST" class="p-6 sm:p-8 space-y-6">
                @csrf
                @method('PUT')

                {{-- Pilih Orang Tua --}}
                <div>
                    <label for="orangtua_id" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                        Pilih Orang Tua (Ibu/Ayah) <span class="text-rose-500">*</span>
                    </label>
                    <select id="orangtua_id"
                            name="orangtua_id"
                            required
                            class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-semibold text-sm focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                        @php $selectedOrangtua = old('orangtua_id', $anak->orangtua_id); @endphp
                        @foreach($orangtuas as $orangtua)
                            <option value="{{ $orangtua->id }}" {{ $selectedOrangtua == $orangtua->id ? 'selected' : '' }}>
                                {{ $orangtua->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Grid 2 Kolom: Nama Lengkap Anak & NIK Anak --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2 border-t border-slate-100">
                    <div>
                        <label for="nama" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                            Nama Lengkap Anak <span class="text-rose-500">*</span>
                        </label>
                        <input type="text"
                               id="nama"
                               name="nama"
                               value="{{ old('nama', $anak->nama) }}"
                               required
                               placeholder="Masukkan nama lengkap balita"
                               class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-medium text-sm focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                    </div>

                    <div>
                        <label for="nik" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                            NIK Anak <span class="text-rose-500">*</span>
                        </label>
                        <input type="text"
                               id="nik"
                               name="nik"
                               value="{{ old('nik', $anak->nik) }}"
                               maxlength="16"
                               required
                               placeholder="16 digit NIK sesuai KK/KIA"
                               class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-semibold text-sm tabular-nums focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                    </div>
                </div>

                {{-- Grid 2 Kolom: Tanggal Lahir & Jenis Kelamin --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2 border-t border-slate-100">
                    <div>
                        <label for="tanggal_lahir" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                            Tanggal Lahir <span class="text-rose-500">*</span>
                        </label>
                        <input type="date"
                               id="tanggal_lahir"
                               name="tanggal_lahir"
                               value="{{ old('tanggal_lahir', $anak->tanggal_lahir) }}"
                               required
                               class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-semibold text-sm focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                    </div>

                    <div>
                        <label for="jenis_kelamin" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                            Jenis Kelamin <span class="text-rose-500">*</span>
                        </label>
                        <select id="jenis_kelamin"
                                name="jenis_kelamin"
                                required
                                class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-semibold text-sm focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                            @php $selectedJk = old('jenis_kelamin', $anak->jenis_kelamin); @endphp
                            <option value="L" {{ $selectedJk == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $selectedJk == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                {{-- Footer Tombol Aksi --}}
                <div class="pt-6 border-t border-slate-100 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3">
                    <a href="{{ route('kader.anak.index') }}"
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