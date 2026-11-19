<x-app-layout>
    <div class="max-w-3xl mx-auto space-y-6">
        {{-- 1. BREADCRUMB & EXECUTIVE HEADER BANNER --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-primary-950 to-primary-900 p-6 sm:p-8 text-white shadow-lg border border-primary-800/50">
            <div class="pointer-events-none absolute -right-12 -top-12 h-52 w-52 rounded-full bg-emerald-400/15 blur-2xl"></div>
            <div class="pointer-events-none absolute right-24 -bottom-16 h-44 w-44 rounded-full bg-amber-400/15 blur-2xl"></div>

            <div class="relative">
                {{-- Breadcrumb Navigasi --}}
                <nav class="flex items-center gap-2 text-xs font-medium text-slate-300 mb-4">
                    <a href="{{ route('kader.kb.index') }}" class="hover:text-emerald-300 transition-colors inline-flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        Data Peserta KB
                    </a>
                    <span class="text-slate-500">/</span>
                    <span class="text-emerald-300 font-semibold">Edit Peserta KB</span>
                </nav>

                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-white/10 border border-white/20 backdrop-blur-xs text-emerald-300 font-extrabold text-lg flex items-center justify-center shrink-0 shadow-sm">
                        {{ strtoupper(substr($kb->nama_peserta, 0, 2)) }}
                    </div>
                    <div>
                        <div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full bg-white/10 border border-white/15 text-[11px] font-semibold text-amber-300 mb-1.5">
                            <span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>
                            Pembaruan Data Akseptor
                        </div>
                        <h2 class="font-extrabold text-2xl sm:text-[1.7rem] tracking-tight text-white">
                            Edit Peserta KB
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-300 mt-0.5">
                            Perbarui profil kepesertaan dan metode kontrasepsi untuk <strong class="text-white font-semibold">{{ $kb->nama_peserta }}</strong>.
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
                    <h3 class="font-bold text-slate-900">Formulir Data Akseptor KB</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Pastikan jenis kontrasepsi dan tanggal mulai tercatat sesuai kartu KB peserta.</p>
                </div>
                <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-primary-50 text-primary-700 border border-primary-100">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary-600"></span>
                    Mode Sunting
                </span>
            </div>

            <form action="{{ route('kader.kb.update', $kb->id) }}" method="POST" class="p-6 sm:p-8 space-y-6">
                @csrf
                @method('PUT')

                {{-- Nama Peserta (Ibu) --}}
                <div>
                    <label for="nama_peserta" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                        Nama Peserta (Ibu) <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                        <input type="text"
                               id="nama_peserta"
                               name="nama_peserta"
                               value="{{ old('nama_peserta', $kb->nama_peserta) }}"
                               required
                               placeholder="Masukkan nama lengkap ibu"
                               class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-medium text-sm focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                    </div>
                </div>

                {{-- Grid 2 Kolom: Umur & Nama Suami --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2 border-t border-slate-100">
                    <div>
                        <label for="umur" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                            Umur <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number"
                                   id="umur"
                                   name="umur"
                                   value="{{ old('umur', $kb->umur) }}"
                                   required
                                   placeholder="Cth: 28"
                                   class="w-full pl-4 pr-16 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-bold text-sm tabular-nums focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-xs font-extrabold uppercase text-slate-400">
                                Tahun
                            </span>
                        </div>
                    </div>

                    <div>
                        <label for="nama_suami" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                            Nama Suami <span class="text-slate-400 font-normal normal-case">(Opsional)</span>
                        </label>
                        <input type="text"
                               id="nama_suami"
                               name="nama_suami"
                               value="{{ old('nama_suami', $kb->nama_suami) }}"
                               placeholder="Masukkan nama suami"
                               class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-medium text-sm focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                    </div>
                </div>

                {{-- Grid 2 Kolom: Jenis Kontrasepsi & Tanggal Mulai --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2 border-t border-slate-100">
                    <div>
                        <label for="jenis_kontrasepsi" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                            Jenis Kontrasepsi <span class="text-rose-500">*</span>
                        </label>
                        <select id="jenis_kontrasepsi"
                                name="jenis_kontrasepsi"
                                required
                                class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-semibold text-sm focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                            @php $selectedKb = old('jenis_kontrasepsi', $kb->jenis_kontrasepsi); @endphp
                            <option value="Suntik 1 Bulan" {{ $selectedKb == 'Suntik 1 Bulan' ? 'selected' : '' }}>Suntik 1 Bulan</option>
                            <option value="Suntik 3 Bulan" {{ $selectedKb == 'Suntik 3 Bulan' ? 'selected' : '' }}>Suntik 3 Bulan</option>
                            <option value="Pil" {{ $selectedKb == 'Pil' ? 'selected' : '' }}>Pil</option>
                            <option value="IUD" {{ $selectedKb == 'IUD' ? 'selected' : '' }}>IUD</option>
                            <option value="Implant" {{ $selectedKb == 'Implant' ? 'selected' : '' }}>Implant</option>
                            <option value="Kondom" {{ $selectedKb == 'Kondom' ? 'selected' : '' }}>Kondom</option>
                            <option value="MOW/MOP" {{ $selectedKb == 'MOW/MOP' ? 'selected' : '' }}>MOW/MOP</option>
                        </select>
                    </div>

                    <div>
                        <label for="tanggal_mulai" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                            Tanggal Mulai <span class="text-rose-500">*</span>
                        </label>
                        <input type="date"
                               id="tanggal_mulai"
                               name="tanggal_mulai"
                               value="{{ old('tanggal_mulai', $kb->tanggal_mulai) }}"
                               required
                               class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-semibold text-sm focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                    </div>
                </div>

                {{-- Footer Tombol Aksi --}}
                <div class="pt-6 border-t border-slate-100 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3">
                    <a href="{{ route('kader.kb.index') }}"
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