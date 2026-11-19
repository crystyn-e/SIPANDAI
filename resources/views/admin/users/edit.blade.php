<x-app-layout>
    <div class="max-w-3xl mx-auto space-y-6">
        {{-- 1. BREADCRUMB & HEADER BANNER --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-primary-950 to-primary-900 p-6 sm:p-8 text-white shadow-lg border border-primary-800/50">
            <div class="pointer-events-none absolute -right-12 -top-12 h-52 w-52 rounded-full bg-emerald-400/15 blur-2xl"></div>
            <div class="pointer-events-none absolute right-24 -bottom-16 h-44 w-44 rounded-full bg-amber-400/15 blur-2xl"></div>

            <div class="relative">
                {{-- Breadcrumb Navigasi --}}
                <nav class="flex items-center gap-2 text-xs font-medium text-slate-300 mb-4">
                    <a href="{{ route('admin.users.index') }}" class="hover:text-emerald-300 transition-colors inline-flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        Manajemen Pengguna
                    </a>
                    <span class="text-slate-500">/</span>
                    <span class="text-emerald-300 font-semibold">Edit Pengguna</span>
                </nav>

                <div class="flex items-center gap-4">
                    {{-- Avatar Inisial Pengguna --}}
                    <div class="w-14 h-14 rounded-2xl bg-white/10 border border-white/20 backdrop-blur-xs text-emerald-300 font-extrabold text-lg flex items-center justify-center shrink-0 shadow-sm">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div>
                        <h2 class="font-extrabold text-2xl sm:text-[1.7rem] tracking-tight text-white">
                            Edit Pengguna
                        </h2>
                        <p class="text-sm text-slate-300 mt-0.5">
                            Perbarui profil akun, hak akses, dan penugasan wilayah untuk <strong class="text-white font-semibold">{{ $user->name }}</strong>.
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
                    <h3 class="font-bold text-slate-900">Formulir Pembaruan Akun</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Pastikan role dan wilayah penugasan sesuai dengan SK atau domisili pengguna.</p>
                </div>
                <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-primary-50 text-primary-700 border border-primary-100">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary-600"></span>
                    Mode Sunting
                </span>
            </div>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="p-6 sm:p-8 space-y-6">
                @csrf
                @method('PUT')

                {{-- Nama Lengkap --}}
                <div>
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                        Nama Lengkap <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name', $user->name) }}"
                               required
                               placeholder="Masukkan nama lengkap"
                               class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-medium text-sm focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                    </div>
                </div>

                {{-- Grid 2 Kolom: Email & No HP --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                            Email <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   value="{{ old('email', $user->email) }}"
                                   required
                                   placeholder="nama@email.com"
                                   class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-medium text-sm focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="no_hp" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                            No. HP / WhatsApp
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                </svg>
                            </div>
                            <input type="text"
                                   id="no_hp"
                                   name="no_hp"
                                   value="{{ old('no_hp', $user->no_hp) }}"
                                   placeholder="08xxxxxxxxxx"
                                   class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-medium text-sm tabular-nums focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                        </div>
                    </div>
                </div>

                {{-- Grid 2 Kolom: Role & Status --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2 border-t border-slate-100">
                    <div>
                        <label for="role" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                            Role / Hak Akses <span class="text-rose-500">*</span>
                        </label>
                        <select id="role"
                                name="role"
                                required
                                class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-semibold text-sm focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ old('role', $user->getRoleNames()->first()) == $role->name || $user->hasRole($role->name) ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="status" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                            Status Akun <span class="text-rose-500">*</span>
                        </label>
                        <select id="status"
                                name="status"
                                required
                                class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-slate-900 font-semibold text-sm focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                            <option value="aktif" {{ old('status', $user->status) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="pending" {{ old('status', $user->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>
                </div>

                {{-- Grid 2 Kolom: Penempatan Wilayah --}}
                <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-200/80 space-y-4">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-700">Penugasan Wilayah & Unit Pelayanan</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="desa_id" class="block text-xs font-bold text-slate-600 mb-1.5">
                                Desa <span class="text-slate-400 font-normal">(Untuk Bidan)</span>
                            </label>
                            <select id="desa_id"
                                    name="desa_id"
                                    class="w-full px-4 py-3 rounded-xl bg-white border border-slate-200 text-slate-900 font-medium text-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                                <option value="">-- Pilih Desa --</option>
                                @foreach($desas as $desa)
                                    <option value="{{ $desa->id }}" {{ old('desa_id', $user->desa_id) == $desa->id ? 'selected' : '' }}>
                                        {{ $desa->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="posyandu_id" class="block text-xs font-bold text-slate-600 mb-1.5">
                                Posyandu <span class="text-slate-400 font-normal">(Untuk Kader / Orang Tua)</span>
                            </label>
                            <select id="posyandu_id"
                                    name="posyandu_id"
                                    class="w-full px-4 py-3 rounded-xl bg-white border border-slate-200 text-slate-900 font-medium text-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                                <option value="">-- Pilih Posyandu --</option>
                                @foreach($posyandus as $posyandu)
                                    <option value="{{ $posyandu->id }}" {{ old('posyandu_id', $user->posyandu_id) == $posyandu->id ? 'selected' : '' }}>
                                        {{ $posyandu->nama }} (Desa {{ $posyandu->desa->nama }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Footer Tombol Aksi --}}
                <div class="pt-6 border-t border-slate-100 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3">
                    <a href="{{ route('admin.users.index') }}"
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