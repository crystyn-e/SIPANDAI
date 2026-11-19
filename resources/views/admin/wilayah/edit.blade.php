<x-app-layout>
    <div class="max-w-3xl mx-auto space-y-6">
        {{-- 1. BREADCRUMB & HEADER BANNER --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-primary-950 to-primary-900 p-6 sm:p-8 text-white shadow-lg border border-primary-800/50">
            <div class="pointer-events-none absolute -right-12 -top-12 h-52 w-52 rounded-full bg-emerald-400/15 blur-2xl"></div>
            <div class="pointer-events-none absolute right-24 -bottom-16 h-44 w-44 rounded-full bg-amber-400/15 blur-2xl"></div>

            <div class="relative">
                {{-- Breadcrumb Navigasi --}}
                <nav class="flex items-center gap-2 text-xs font-medium text-slate-300 mb-4">
                    <a href="{{ route('admin.wilayah') }}" class="hover:text-emerald-300 transition-colors inline-flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        Data Wilayah & Posyandu
                    </a>
                    <span class="text-slate-500">/</span>
                    <span class="text-emerald-300 font-semibold">Edit Wilayah</span>
                </nav>

                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-white/10 border border-white/20 backdrop-blur-xs text-emerald-300 flex items-center justify-center shrink-0 shadow-sm">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-extrabold text-2xl sm:text-[1.7rem] tracking-tight text-white">
                            Edit Wilayah
                        </h2>
                        <p class="text-sm text-slate-300 mt-0.5">
                            Perbarui data wilayah administrasi Desa dan unit <strong class="text-white font-semibold">{{ $posyandu->nama }}</strong>.
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
                    <h3 class="font-bold text-slate-900">Formulir Pembaruan Desa & Posyandu</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Pastikan hierarki Kecamatan, Desa, dan nama unit Posyandu sudah tepat.</p>
                </div>
                <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-primary-50 text-primary-700 border border-primary-100">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary-600"></span>
                    Mode Sunting
                </span>
            </div>

            <form action="{{ route('admin.wilayah.update', $posyandu->id) }}" method="POST" class="p-6 sm:p-8 space-y-6">
                @csrf
                @method('PUT')

                {{-- Pilih Kecamatan --}}
                <div>
                    <label for="kecamatan_id" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                        Pilih Kecamatan <span class="text-rose-500">*</span>
                    </label>
                    <select id="kecamatan_id"
                            name="kecamatan_id"
                            required
                            class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-semibold text-sm focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                        @foreach($kecamatans as $kecamatan)
                            <option value="{{ $kecamatan->id }}" {{ old('kecamatan_id', $posyandu->desa->kecamatan_id) == $kecamatan->id ? 'selected' : '' }}>
                                {{ $kecamatan->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Grid 2 Kolom: Nama Desa & Nama Posyandu --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2 border-t border-slate-100">
                    <div>
                        <label for="nama_desa" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                            Nama Desa / Kelurahan <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                            </div>
                            <input type="text"
                                   id="nama_desa"
                                   name="nama_desa"
                                   value="{{ old('nama_desa', $posyandu->desa->nama) }}"
                                   required
                                   placeholder="Contoh: Desa Sukamaju"
                                   class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-medium text-sm focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="nama_posyandu" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                            Nama Unit Posyandu <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                                </svg>
                            </div>
                            <input type="text"
                                   id="nama_posyandu"
                                   name="nama_posyandu"
                                   value="{{ old('nama_posyandu', $posyandu->nama) }}"
                                   required
                                   placeholder="Contoh: Posyandu Melati"
                                   class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-medium text-sm focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                        </div>
                    </div>
                </div>

                {{-- Footer Tombol Aksi --}}
                <div class="pt-6 border-t border-slate-100 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3">
                    <a href="{{ route('admin.wilayah') }}"
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