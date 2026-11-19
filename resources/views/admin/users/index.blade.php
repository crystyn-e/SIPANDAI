<x-app-layout>
    @php
        // Kelompokkan user berdasarkan role langsung di Blade (tanpa perlu ubah controller)
        $adminUsers = $users->filter(fn($u) => strtolower($u->getRoleNames()->first() ?? '') === 'admin');
        $bidanUsers = $users->filter(fn($u) => strtolower($u->getRoleNames()->first() ?? '') === 'bidan');
        $kaderUsers = $users->filter(fn($u) => strtolower($u->getRoleNames()->first() ?? '') === 'kader');
        $orangtuaUsers = $users->filter(fn($u) => strtolower($u->getRoleNames()->first() ?? '') === 'orangtua');
        $pendingCount = $users->where('status', 'pending')->count();
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
                        Otoritas & Struktur Pengguna
                    </div>
                    <h2 class="font-extrabold text-2xl sm:text-3xl tracking-tight text-white">
                        Manajemen Pengguna
                    </h2>
                    <p class="text-sm sm:text-base text-slate-300 mt-1.5 max-w-2xl">
                        Kelola akun petugas kesehatan dan masyarakat secara terpisah berdasarkan peran masing-masing.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    <div class="px-4 py-2.5 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-xs">
                        <p class="text-[11px] uppercase tracking-wider font-semibold text-slate-300">Total Terdaftar</p>
                        <p class="text-xl font-extrabold text-white tabular-nums mt-0.5">
                            {{ $users->count() }} <span class="text-xs font-normal text-slate-300">Akun</span>
                        </p>
                    </div>

                    <a href="{{ route('admin.users.create') }}"
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-slate-950 font-bold text-sm px-5 py-3.5 rounded-2xl shadow-md shadow-emerald-950/30 transition-all duration-200 hover:-translate-y-0.5">
                        <svg class="w-4 h-4 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                        Tambah Pengguna
                    </a>
                </div>
            </div>
        </div>

        {{-- 2. ALERT NOTIFIKASI SUKSES, ERROR & ANTREAN PENDING --}}
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

        @if(session('error'))
            <div class="flex items-center gap-3 bg-rose-50 border border-rose-200/90 text-rose-900 px-5 py-4 rounded-2xl shadow-2xs">
                <div class="w-9 h-9 rounded-xl bg-rose-600 text-white flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-rose-700">Terjadi Kesalahan</p>
                    <p class="text-sm font-medium text-slate-800">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        @if($pendingCount > 0)
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-gradient-to-r from-amber-50 via-orange-50/70 to-white border border-amber-200/90 px-5 py-4 rounded-2xl shadow-2xs">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-amber-800">Menunggu Persetujuan</p>
                        <p class="text-sm text-slate-700">
                            Ada <strong class="font-bold text-slate-900">{{ $pendingCount }} akun Orang Tua</strong> berstatus pending di tab <strong class="text-amber-900">Orang Tua</strong>.
                        </p>
                    </div>
                </div>
                <button type="button" onclick="switchRoleTab('orangtua')"
                        class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold transition-all shrink-0">
                    Buka Tab Orang Tua
                </button>
            </div>
        @endif

        {{-- 3. CONTROL BAR: TAB ROLE TERPISAH + LIVE SEARCH --}}
        <div class="flex flex-col xl:flex-row xl:items-center justify-between gap-4 bg-white p-3 rounded-2xl border border-slate-200/90 shadow-2xs">
            {{-- 4 Tab Role --}}
            <div class="flex flex-wrap items-center gap-1.5 p-1 rounded-xl bg-slate-100/90 border border-slate-200/60" role="tablist">
                <button type="button" id="tab-bidan" onclick="switchRoleTab('bidan')"
                        class="role-tab-btn inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-xs sm:text-sm font-bold transition-all bg-white text-emerald-800 shadow-xs">
                    <span>Bidan</span>
                    <span class="role-badge px-2 py-0.5 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-800 tabular-nums">
                        {{ $bidanUsers->count() }}
                    </span>
                </button>

                <button type="button" id="tab-kader" onclick="switchRoleTab('kader')"
                        class="role-tab-btn inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-xs sm:text-sm font-bold transition-all text-slate-600 hover:text-slate-900">
                    <span>Kader</span>
                    <span class="role-badge px-2 py-0.5 rounded-full text-xs font-extrabold bg-slate-200/80 text-slate-700 tabular-nums">
                        {{ $kaderUsers->count() }}
                    </span>
                </button>

                <button type="button" id="tab-orangtua" onclick="switchRoleTab('orangtua')"
                        class="role-tab-btn inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-xs sm:text-sm font-bold transition-all text-slate-600 hover:text-slate-900">
                    <span>Orang Tua</span>
                    <span class="role-badge px-2 py-0.5 rounded-full text-xs font-extrabold bg-slate-200/80 text-slate-700 tabular-nums">
                        {{ $orangtuaUsers->count() }}
                    </span>
                    @if($pendingCount > 0)
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse" title="{{ $pendingCount }} pending"></span>
                    @endif
                </button>

                <button type="button" id="tab-admin" onclick="switchRoleTab('admin')"
                        class="role-tab-btn inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-xs sm:text-sm font-bold transition-all text-slate-600 hover:text-slate-900">
                    <span>Admin</span>
                    <span class="role-badge px-2 py-0.5 rounded-full text-xs font-extrabold bg-slate-200/80 text-slate-700 tabular-nums">
                        {{ $adminUsers->count() }}
                    </span>
                </button>
            </div>

            {{-- Search Input Instan --}}
            <div class="relative w-full xl:w-72">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
                <input type="text"
                       id="userSearchInput"
                       placeholder="Cari nama, email, no HP, wilayah..."
                       class="w-full pl-10 pr-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
            </div>
        </div>

        {{-- 4. PANEL TABEL TERPISAH PER ROLE --}}

        {{-- ================= PANEL 1: TABEL BIDAN ================= --}}
        <div id="panel-bidan" class="role-tab-panel bg-white rounded-2xl shadow-xs border border-slate-200/90 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-emerald-50/40 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-slate-900">Daftar Bidan Pembina Desa</h3>
                    <p class="text-xs text-slate-500">Tenaga medis pembina kesehatan ibu dan anak di tingkat desa.</p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">Role: Bidan</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
                        <tr>
                            <th class="py-3.5 px-6">Nama & Kontak Bidan</th>
                            <th class="py-3.5 px-6">Desa Binaan</th>
                            <th class="py-3.5 px-6">Status Akun</th>
                            <th class="py-3.5 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($bidanUsers as $user)
                            <tr class="user-search-row group hover:bg-slate-50/90 transition-colors">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3.5">
                                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-100 to-teal-100 text-emerald-800 font-bold text-xs flex items-center justify-center shrink-0 border border-emerald-200/60">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900 group-hover:text-emerald-700 transition-colors">{{ $user->name }}</p>
                                            <p class="text-xs text-slate-500 mt-0.5">{{ $user->email }} <span class="mx-1 text-slate-300">•</span> <span class="tabular-nums">{{ $user->no_hp ?? '-' }}</span></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <p class="font-semibold text-slate-800">{{ $user->desa ? 'Desa ' . $user->desa->nama : '-' }}</p>
                                </td>
                                <td class="py-4 px-6">
                                    @if($user->status === 'pending')
                                        <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-800 border border-amber-200/90 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Pending
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200/90 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="inline-flex items-center justify-center gap-2">
                                        @if($user->status === 'pending')
                                            <form action="{{ route('admin.users.verify', $user->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold py-1.5 px-3 rounded-xl transition-all">Verifikasi</button>
                                            </form>
                                        @endif
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-amber-50 text-amber-800 hover:bg-amber-100 border border-amber-200/80 py-1.5 px-3 rounded-xl text-xs font-bold transition-all">Edit</a>
                                        @if(auth()->id() !== $user->id)
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="bg-rose-50 text-rose-700 hover:bg-rose-100 border border-rose-200/80 py-1.5 px-3 rounded-xl text-xs font-bold transition-all">Hapus</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 px-6 text-center text-slate-500">Belum ada akun Bidan terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ================= PANEL 2: TABEL KADER ================= --}}
        <div id="panel-kader" class="role-tab-panel hidden bg-white rounded-2xl shadow-xs border border-slate-200/90 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-primary-50/40 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-slate-900">Daftar Kader Posyandu</h3>
                    <p class="text-xs text-slate-500">Petugas pelaksana pencatatan dan penimbangan di masing-masing unit Posyandu.</p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-primary-100 text-primary-800">Role: Kader</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
                        <tr>
                            <th class="py-3.5 px-6">Nama & Kontak Kader</th>
                            <th class="py-3.5 px-6">Unit Posyandu & Desa</th>
                            <th class="py-3.5 px-6">Status Akun</th>
                            <th class="py-3.5 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($kaderUsers as $user)
                            <tr class="user-search-row group hover:bg-slate-50/90 transition-colors">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3.5">
                                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-100 to-sky-100 text-primary-800 font-bold text-xs flex items-center justify-center shrink-0 border border-primary-200/60">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900 group-hover:text-primary-700 transition-colors">{{ $user->name }}</p>
                                            <p class="text-xs text-slate-500 mt-0.5">{{ $user->email }} <span class="mx-1 text-slate-300">•</span> <span class="tabular-nums">{{ $user->no_hp ?? '-' }}</span></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    @if($user->posyandu_id)
                                        <p class="font-semibold text-slate-800">{{ $user->posyandu->nama }}</p>
                                        <p class="text-xs text-slate-400 mt-0.5">Desa {{ $user->posyandu->desa->nama }}</p>
                                    @else
                                        <span class="text-slate-400 text-xs">Belum ditugaskan</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    @if($user->status === 'pending')
                                        <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-800 border border-amber-200/90 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Pending
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200/90 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="inline-flex items-center justify-center gap-2">
                                        @if($user->status === 'pending')
                                            <form action="{{ route('admin.users.verify', $user->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white text-xs font-bold py-1.5 px-3 rounded-xl transition-all">Verifikasi</button>
                                            </form>
                                        @endif
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-amber-50 text-amber-800 hover:bg-amber-100 border border-amber-200/80 py-1.5 px-3 rounded-xl text-xs font-bold transition-all">Edit</a>
                                        @if(auth()->id() !== $user->id)
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="bg-rose-50 text-rose-700 hover:bg-rose-100 border border-rose-200/80 py-1.5 px-3 rounded-xl text-xs font-bold transition-all">Hapus</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 px-6 text-center text-slate-500">Belum ada akun Kader terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ================= PANEL 3: TABEL ORANG TUA ================= --}}
        <div id="panel-orangtua" class="role-tab-panel hidden bg-white rounded-2xl shadow-xs border border-slate-200/90 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-amber-50/40 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-slate-900">Daftar Akun Orang Tua / Wali</h3>
                    <p class="text-xs text-slate-500">Akun masyarakat untuk mengakses Buku KIA Digital dan memantau grafik tumbuh kembang anak.</p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-900">Role: Orang Tua</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
                        <tr>
                            <th class="py-3.5 px-6">Nama & Kontak Orang Tua</th>
                            <th class="py-3.5 px-6">Domisili Posyandu / Desa</th>
                            <th class="py-3.5 px-6">Status Verifikasi</th>
                            <th class="py-3.5 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($orangtuaUsers as $user)
                            <tr class="user-search-row group hover:bg-slate-50/90 transition-colors {{ $user->status === 'pending' ? 'bg-amber-50/30' : '' }}">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3.5">
                                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-100 to-orange-100 text-amber-800 font-bold text-xs flex items-center justify-center shrink-0 border border-amber-200/60">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900 group-hover:text-amber-800 transition-colors">{{ $user->name }}</p>
                                            <p class="text-xs text-slate-500 mt-0.5">{{ $user->email }} <span class="mx-1 text-slate-300">•</span> <span class="tabular-nums">{{ $user->no_hp ?? '-' }}</span></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    @if($user->posyandu_id)
                                        <p class="font-semibold text-slate-800">{{ $user->posyandu->nama }}</p>
                                        <p class="text-xs text-slate-400 mt-0.5">Desa {{ $user->posyandu->desa->nama }}</p>
                                    @elseif($user->desa_id)
                                        <p class="font-semibold text-slate-800">Desa {{ $user->desa->nama }}</p>
                                    @else
                                        <span class="text-slate-400 text-xs">-</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    @if($user->status === 'pending')
                                        <span class="inline-flex items-center gap-1.5 bg-amber-100 text-amber-900 border border-amber-300/90 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-600 animate-pulse"></span> Pending
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200/90 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="inline-flex items-center justify-center gap-2">
                                        @if($user->status === 'pending')
                                            <form action="{{ route('admin.users.verify', $user->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="inline-flex items-center gap-1 bg-gradient-to-r from-primary-600 to-emerald-600 hover:from-primary-700 hover:to-emerald-700 text-white text-xs font-bold py-1.5 px-3 rounded-xl shadow-2xs transition-all">
                                                    Verifikasi
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-amber-50 text-amber-800 hover:bg-amber-100 border border-amber-200/80 py-1.5 px-3 rounded-xl text-xs font-bold transition-all">Edit</a>
                                        @if(auth()->id() !== $user->id)
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="bg-rose-50 text-rose-700 hover:bg-rose-100 border border-rose-200/80 py-1.5 px-3 rounded-xl text-xs font-bold transition-all">Hapus</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 px-6 text-center text-slate-500">Belum ada akun Orang Tua terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ================= PANEL 4: TABEL ADMIN ================= --}}
        <div id="panel-admin" class="role-tab-panel hidden bg-white rounded-2xl shadow-xs border border-slate-200/90 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-100/70 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-slate-900">Daftar Administrator Kecamatan</h3>
                    <p class="text-xs text-slate-500">Pengelola utama sistem dengan hak akses penuh di tingkat kecamatan.</p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-900 text-white">Role: Admin</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
                        <tr>
                            <th class="py-3.5 px-6">Nama & Kontak Admin</th>
                            <th class="py-3.5 px-6">Otoritas Wilayah</th>
                            <th class="py-3.5 px-6">Status Akun</th>
                            <th class="py-3.5 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($adminUsers as $user)
                            <tr class="user-search-row group hover:bg-slate-50/90 transition-colors">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3.5">
                                        <div class="w-10 h-10 rounded-xl bg-slate-900 text-white font-bold text-xs flex items-center justify-center shrink-0">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <p class="font-bold text-slate-900">{{ $user->name }}</p>
                                                @if(auth()->id() === $user->id)
                                                    <span class="px-2 py-0.5 rounded-md bg-primary-100 text-primary-800 text-[10px] font-bold">Akun Anda</span>
                                                @endif
                                            </div>
                                            <p class="text-xs text-slate-500 mt-0.5">{{ $user->email }} <span class="mx-1 text-slate-300">•</span> <span class="tabular-nums">{{ $user->no_hp ?? '-' }}</span></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="font-semibold text-slate-700">Admin Tingkat Kecamatan</span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200/90 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="inline-flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-amber-50 text-amber-800 hover:bg-amber-100 border border-amber-200/80 py-1.5 px-3 rounded-xl text-xs font-bold transition-all">Edit</a>
                                        @if(auth()->id() !== $user->id)
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="bg-rose-50 text-rose-700 hover:bg-rose-100 border border-rose-200/80 py-1.5 px-3 rounded-xl text-xs font-bold transition-all">Hapus</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 px-6 text-center text-slate-500">Belum ada akun Admin terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- SCRIPT TAB SWITCHER PER ROLE & PENCARIAN INSTAN --}}
    <script>
        function switchRoleTab(roleName) {
            // Sembunyikan semua panel
            document.querySelectorAll('.role-tab-panel').forEach(panel => {
                panel.classList.add('hidden');
            });

            // Reset semua style tombol tab
            document.querySelectorAll('.role-tab-btn').forEach(btn => {
                btn.classList.remove('bg-white', 'text-emerald-800', 'text-primary-800', 'text-amber-900', 'text-slate-900', 'shadow-xs');
                btn.classList.add('text-slate-600', 'hover:text-slate-900');

                const badge = btn.querySelector('.role-badge');
                if (badge) {
                    badge.className = 'role-badge px-2 py-0.5 rounded-full text-xs font-extrabold bg-slate-200/80 text-slate-700 tabular-nums';
                }
            });

            // Tampilkan panel yang dipilih
            const activePanel = document.getElementById('panel-' + roleName);
            if (activePanel) activePanel.classList.remove('hidden');

            // Aktifkan tombol tab yang dipilih
            const activeBtn = document.getElementById('tab-' + roleName);
            if (activeBtn) {
                activeBtn.classList.remove('text-slate-600', 'hover:text-slate-900');
                activeBtn.classList.add('bg-white', 'shadow-xs');

                const badge = activeBtn.querySelector('.role-badge');
                if (roleName === 'bidan') {
                    activeBtn.classList.add('text-emerald-800');
                    if (badge) badge.className = 'role-badge px-2 py-0.5 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-800 tabular-nums';
                } else if (roleName === 'kader') {
                    activeBtn.classList.add('text-primary-800');
                    if (badge) badge.className = 'role-badge px-2 py-0.5 rounded-full text-xs font-extrabold bg-primary-100 text-primary-800 tabular-nums';
                } else if (roleName === 'orangtua') {
                    activeBtn.classList.add('text-amber-900');
                    if (badge) badge.className = 'role-badge px-2 py-0.5 rounded-full text-xs font-extrabold bg-amber-100 text-amber-900 tabular-nums';
                } else {
                    activeBtn.classList.add('text-slate-900');
                    if (badge) badge.className = 'role-badge px-2 py-0.5 rounded-full text-xs font-extrabold bg-slate-900 text-white tabular-nums';
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('userSearchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    const keyword = this.value.toLowerCase().trim();
                    document.querySelectorAll('.user-search-row').forEach(row => {
                        row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
                    });
                });
            }
        });
    </script>
</x-app-layout>