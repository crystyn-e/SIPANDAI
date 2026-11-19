<x-app-layout>
    @php
        $latestPeriksa = $anak->pemeriksaans?->sortByDesc('tanggal_periksa')->first();
    @endphp

    <div class="max-w-3xl mx-auto space-y-6">
        {{-- 1. BREADCRUMB & EXECUTIVE HEADER BANNER --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-primary-950 to-primary-900 p-6 sm:p-8 text-white shadow-lg border border-primary-800/50">
            <div class="pointer-events-none absolute -right-12 -top-12 h-52 w-52 rounded-full bg-emerald-400/15 blur-2xl"></div>
            <div class="pointer-events-none absolute right-24 -bottom-16 h-44 w-44 rounded-full bg-amber-400/15 blur-2xl"></div>

            <div class="relative">
                {{-- Breadcrumb Navigasi --}}
                <nav class="flex items-center gap-2 text-xs font-medium text-slate-300 mb-4">
                    <a href="{{ route('bidan.kasus.index') }}" class="hover:text-emerald-300 transition-colors inline-flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        Daftar Kasus Prioritas
                    </a>
                    <span class="text-slate-500">/</span>
                    <span class="text-emerald-300 font-semibold">Catatan Medis Anak</span>
                </nav>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-white/10 border border-white/20 backdrop-blur-xs text-rose-300 font-extrabold text-lg flex items-center justify-center shrink-0 shadow-sm">
                            {{ strtoupper(substr($anak->nama, 0, 2)) }}
                        </div>
                        <div>
                            <div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full bg-white/10 border border-white/15 text-[11px] font-semibold text-rose-300 mb-1.5">
                                <span class="h-1.5 w-1.5 rounded-full bg-rose-400 animate-pulse"></span>
                                Advis Klinis & Intervensi Gizi Balita
                            </div>
                            <h2 class="font-extrabold text-2xl sm:text-[1.7rem] tracking-tight text-white">
                                Catatan Medis Bidan
                            </h2>
                            <p class="text-xs sm:text-sm text-slate-300 mt-1">
                                Pasien: <strong class="text-white font-semibold">{{ $anak->nama }}</strong>
                                @if($anak->tanggal_lahir)
                                    • Usia: <strong class="text-white font-semibold">{{ \Carbon\Carbon::parse($anak->tanggal_lahir)->diffForHumans(null, true) }}</strong>
                                @endif
                                @if($anak->orangtua)
                                    • Orang Tua: <strong class="text-emerald-300 font-semibold">{{ $anak->orangtua->name }}</strong>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. RINGKASAN ANTROPOMETRI TERAKHIR (JIKA TERSEDIA) --}}
        @if($latestPeriksa)
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white rounded-2xl p-4 border border-slate-200/90 shadow-2xs">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Berat Badan Terakhir</p>
                    <p class="text-base font-extrabold text-slate-900 tabular-nums mt-1">
                        {{ $latestPeriksa->berat_badan }} kg
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-4 border border-slate-200/90 shadow-2xs">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Tinggi Badan Terakhir</p>
                    <p class="text-base font-extrabold text-slate-900 tabular-nums mt-1">
                        {{ $latestPeriksa->tinggi_badan }} cm
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-4 border border-slate-200/90 shadow-2xs">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Status Gizi Terkini</p>
                    <div class="mt-1">
                        @if($latestPeriksa->status_gizi === 'Normal')
                            <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-800 border border-emerald-200/90 px-2.5 py-0.5 rounded-full text-xs font-extrabold uppercase">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                NORMAL
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-800 border border-rose-200/90 px-2.5 py-0.5 rounded-full text-xs font-extrabold uppercase">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                {{ strtoupper($latestPeriksa->status_gizi) }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        {{-- 3. ALERT VALIDASI ERROR --}}
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

        {{-- 4. FORM INPUT CATATAN MEDIS --}}
        <div class="bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden">
            <div class="px-6 sm:px-8 py-5 border-b border-slate-100 bg-slate-50/70 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-slate-900">Formulir Intervensi & Advis Medis Balita</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Rekomendasi klinis ini akan diteruskan sebagai panduan tindak lanjut Kader Posyandu dan orang tua.</p>
                </div>
                <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/80">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Rekam Klinis Bidan
                </span>
            </div>

            <form action="{{ route('bidan.kasus.store-catatan-anak', $anak->id) }}" method="POST" class="p-6 sm:p-8 space-y-6">
                @csrf

                <div>
                    <label for="catatan_medis" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                        Catatan Medis / Intervensi <span class="text-rose-500">*</span>
                    </label>
                    <textarea id="catatan_medis"
                              name="catatan_medis"
                              rows="6"
                              required
                              placeholder="Contoh: Diberikan PMT Tambahan tinggi protein hewani selama 30 hari, edukasi MP-ASI bergizi seimbang, jadwal kontrol ulang 2 minggu lagi..."
                              class="w-full px-4 py-3.5 rounded-2xl bg-slate-50/70 border border-slate-200 text-slate-900 font-medium text-sm leading-relaxed focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">{{ old('catatan_medis', $anak->catatan_medis ?? '') }}</textarea>
                    <p class="text-xs text-slate-400 mt-2">
                        Cantumkan jenis pemberian makanan tambahan (PMT), vitamin/suplemen, jadwal evaluasi berat/tinggi badan, atau rujukan Puskesmas jika diperlukan.
                    </p>
                </div>

                {{-- Footer Tombol Aksi --}}
                <div class="pt-6 border-t border-slate-100 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3">
                    <a href="{{ route('bidan.kasus.index') }}"
                       class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-sm transition-all">
                        Batal
                    </a>
                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl bg-gradient-to-r from-primary-700 via-primary-600 to-emerald-600 hover:from-primary-800 hover:to-emerald-700 text-white font-bold text-sm shadow-sm transition-all hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        Simpan Catatan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>