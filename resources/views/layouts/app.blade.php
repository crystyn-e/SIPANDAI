<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIPANDAI - Sistem Informasi Posyandu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 antialiased font-sans" x-data="{ mobileSidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">

        {{-- BACKDROP MOBILE SIDEBAR --}}
        <div x-show="mobileSidebarOpen"
             x-transition.opacity
             @click="mobileSidebarOpen = false"
             style="display: none;"
             class="fixed inset-0 z-40 bg-slate-950/60 backdrop-blur-xs md:hidden print:hidden"></div>

        {{-- SIDEBAR UTAMA (DESKTOP & MOBILE DRAWER) --}}
        <aside :class="mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-50 w-72 bg-gradient-to-b from-slate-900 via-primary-950 to-slate-950 text-white flex flex-col border-r border-primary-800/40 shadow-2xl transition-transform duration-300 ease-in-out md:static md:translate-x-0 shrink-0 print:hidden">

            {{-- Brand Header SIPANDAI --}}
            <div class="h-20 flex items-center justify-between px-6 border-b border-white/10">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 group">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-emerald-400 to-primary-500 text-slate-950 flex items-center justify-center shadow-md shadow-emerald-950/40 group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6 stroke-[2.2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-extrabold tracking-wider text-white leading-none">SIPANDAI</h1>
                        <p class="text-[11px] font-medium text-emerald-300/90 mt-1 tracking-wide">Posyandu & KIA Digital</p>
                    </div>
                </a>

                {{-- Tombol Tutup Mobile --}}
                <button @click="mobileSidebarOpen = false" class="md:hidden p-2 rounded-xl text-slate-400 hover:text-white hover:bg-white/10">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Navigasi Menu --}}
            <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
                <p class="px-3.5 text-[10px] font-bold uppercase tracking-widest text-slate-400/80 mb-2">
                    Menu Utama
                </p>

                {{-- Menu Dashboard (Semua Role) --}}
                <a href="{{ route('dashboard') }}"
                   class="group flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-emerald-500/20 to-primary-600/20 text-white border border-emerald-400/30 shadow-xs' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <span class="w-8 h-8 rounded-xl flex items-center justify-center transition-colors {{ request()->routeIs('dashboard') ? 'bg-emerald-500 text-slate-950' : 'bg-white/5 text-slate-400 group-hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>
                    </span>
                    <span>Dashboard</span>
                </a>

                {{-- ================= MENU KHUSUS ADMIN ================= --}}
                @if(Auth::user()->hasRole('admin'))
                    <div class="pt-4 pb-1">
                        <p class="px-3.5 text-[10px] font-bold uppercase tracking-widest text-emerald-400/80">
                            Administrasi Kecamatan
                        </p>
                    </div>

                    <a href="{{ route('admin.wilayah') }}"
                       class="group flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('admin.wilayah*') ? 'bg-gradient-to-r from-emerald-500/20 to-primary-600/20 text-white border border-emerald-400/30 shadow-xs' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        <span class="w-8 h-8 rounded-xl flex items-center justify-center transition-colors {{ request()->routeIs('admin.wilayah*') ? 'bg-emerald-500 text-slate-950' : 'bg-white/5 text-slate-400 group-hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                        </span>
                        <span>Data Wilayah</span>
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                       class="group flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-emerald-500/20 to-primary-600/20 text-white border border-emerald-400/30 shadow-xs' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        <span class="w-8 h-8 rounded-xl flex items-center justify-center transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-emerald-500 text-slate-950' : 'bg-white/5 text-slate-400 group-hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                        </span>
                        <span>Manajemen Pengguna</span>
                    </a>

                    <a href="{{ route('admin.stunting') }}"
                       class="group flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('admin.stunting') ? 'bg-gradient-to-r from-emerald-500/20 to-primary-600/20 text-white border border-emerald-400/30 shadow-xs' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        <span class="w-8 h-8 rounded-xl flex items-center justify-center transition-colors {{ request()->routeIs('admin.stunting') ? 'bg-emerald-500 text-slate-950' : 'bg-white/5 text-slate-400 group-hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                            </svg>
                        </span>
                        <span>Monitoring Stunting</span>
                    </a>

                    <a href="{{ route('admin.data-warga') }}"
                       class="group flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('admin.data-warga*') ? 'bg-gradient-to-r from-emerald-500/20 to-primary-600/20 text-white border border-emerald-400/30 shadow-xs' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        <span class="w-8 h-8 rounded-xl flex items-center justify-center transition-colors {{ request()->routeIs('admin.data-warga*') ? 'bg-emerald-500 text-slate-950' : 'bg-white/5 text-slate-400 group-hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                            </svg>
                        </span>
                        <span>Pusat Data Warga</span>
                    </a>

                    <a href="{{ route('admin.jadwal.index') }}"
                       class="group flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('admin.jadwal.*') ? 'bg-gradient-to-r from-emerald-500/20 to-primary-600/20 text-white border border-emerald-400/30 shadow-xs' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        <span class="w-8 h-8 rounded-xl flex items-center justify-center transition-colors {{ request()->routeIs('admin.jadwal.*') ? 'bg-emerald-500 text-slate-950' : 'bg-white/5 text-slate-400 group-hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                        </span>
                        <span>Jadwal Posyandu</span>
                    </a>

                    <a href="{{ route('admin.laporan.index') }}"
                       class="group flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('admin.laporan.*') ? 'bg-gradient-to-r from-emerald-500/20 to-primary-600/20 text-white border border-emerald-400/30 shadow-xs' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        <span class="w-8 h-8 rounded-xl flex items-center justify-center transition-colors {{ request()->routeIs('admin.laporan.*') ? 'bg-emerald-500 text-slate-950' : 'bg-white/5 text-slate-400 group-hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        </span>
                        <span>Pusat Laporan</span>
                    </a>
                @endif

                {{-- ================= MENU KHUSUS KADER ================= --}}
                @if(Auth::user()->hasRole('kader'))
                    <div class="pt-4 pb-1">
                        <p class="px-3.5 text-[10px] font-bold uppercase tracking-widest text-emerald-400/80">
                            Pelayanan Posyandu
                        </p>
                    </div>

                    <a href="{{ route('kader.anak.index') }}"
                       class="group flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('kader.anak.*') ? 'bg-gradient-to-r from-emerald-500/20 to-primary-600/20 text-white border border-emerald-400/30 shadow-xs' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        <span class="w-8 h-8 rounded-xl flex items-center justify-center transition-colors {{ request()->routeIs('kader.anak.*') ? 'bg-emerald-500 text-slate-950' : 'bg-white/5 text-slate-400 group-hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                            </svg>
                        </span>
                        <span>Data Anak</span>
                    </a>

                    <a href="{{ route('kader.ibu_hamil.index') }}"
                       class="group flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('kader.ibu_hamil.*') ? 'bg-gradient-to-r from-emerald-500/20 to-primary-600/20 text-white border border-emerald-400/30 shadow-xs' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        <span class="w-8 h-8 rounded-xl flex items-center justify-center transition-colors {{ request()->routeIs('kader.ibu_hamil.*') ? 'bg-emerald-500 text-slate-950' : 'bg-white/5 text-slate-400 group-hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </span>
                        <span>Data Ibu Hamil</span>
                    </a>

                    <a href="{{ route('kader.kb.index') }}"
                       class="group flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('kader.kb.*') ? 'bg-gradient-to-r from-emerald-500/20 to-primary-600/20 text-white border border-emerald-400/30 shadow-xs' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        <span class="w-8 h-8 rounded-xl flex items-center justify-center transition-colors {{ request()->routeIs('kader.kb.*') ? 'bg-emerald-500 text-slate-950' : 'bg-white/5 text-slate-400 group-hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25Z" />
                            </svg>
                        </span>
                        <span>Data KB</span>
                    </a>

                    <a href="{{ route('kader.verifikasi.index') }}"
                       class="group flex items-center justify-between px-3.5 py-3 rounded-2xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('kader.verifikasi.*') ? 'bg-gradient-to-r from-emerald-500/20 to-primary-600/20 text-white border border-emerald-400/30 shadow-xs' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        <div class="flex items-center gap-3.5">
                            <span class="w-8 h-8 rounded-xl flex items-center justify-center transition-colors {{ request()->routeIs('kader.verifikasi.*') ? 'bg-emerald-500 text-slate-950' : 'bg-white/5 text-slate-400 group-hover:text-white' }}">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </span>
                            <span>Verifikasi Akun</span>
                        </div>
                        @php
                            $pendingCount = \App\Models\User::where('status', 'pending')->where('posyandu_id', Auth::user()->posyandu_id)->count();
                        @endphp
                        @if($pendingCount > 0)
                            <span class="bg-rose-500 text-white text-xs font-extrabold px-2 py-0.5 rounded-full tabular-nums">{{ $pendingCount }}</span>
                        @endif
                    </a>
                @endif

                {{-- ================= MENU KHUSUS BIDAN ================= --}}
                @if(Auth::user()->hasRole('bidan'))
                    <div class="pt-4 pb-1">
                        <p class="px-3.5 text-[10px] font-bold uppercase tracking-widest text-emerald-400/80">
                            Pembinaan Desa
                        </p>
                    </div>

                    <a href="{{ route('bidan.kasus.index') }}"
                       class="group flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('bidan.kasus.*') ? 'bg-gradient-to-r from-emerald-500/20 to-primary-600/20 text-white border border-emerald-400/30 shadow-xs' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        <span class="w-8 h-8 rounded-xl flex items-center justify-center transition-colors {{ request()->routeIs('bidan.kasus.*') ? 'bg-emerald-500 text-slate-950' : 'bg-white/5 text-slate-400 group-hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </span>
                        <span>Daftar Rujukan</span>
                    </a>

                    <a href="{{ route('bidan.jadwal') }}"
                       class="group flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('bidan.jadwal') ? 'bg-gradient-to-r from-emerald-500/20 to-primary-600/20 text-white border border-emerald-400/30 shadow-xs' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        <span class="w-8 h-8 rounded-xl flex items-center justify-center transition-colors {{ request()->routeIs('bidan.jadwal') ? 'bg-emerald-500 text-slate-950' : 'bg-white/5 text-slate-400 group-hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                        </span>
                        <span>Jadwal Kegiatan</span>
                    </a>
                @endif
            </nav>

            {{-- Footer Sidebar & Tombol Log Out --}}
            <div class="p-4 border-t border-white/10 bg-slate-950/40">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-rose-500/15 hover:bg-rose-600 text-rose-200 hover:text-white border border-rose-500/30 hover:border-rose-600 rounded-2xl text-sm font-bold transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg>
                        Log Out
                    </button>
                </form>
            </div>
        </aside>

        {{-- MAIN CONTENT AREA --}}
        <div class="flex-1 flex flex-col h-screen overflow-hidden">

            {{-- TOP NAVBAR --}}
            <header class="h-20 bg-white/90 backdrop-blur-md border-b border-slate-200/80 flex items-center justify-between px-4 sm:px-8 relative z-30 shrink-0 print:hidden">
                <div class="flex items-center gap-3">
                    {{-- Tombol Hamburger Mobile --}}
                    <button @click="mobileSidebarOpen = true"
                            type="button"
                            class="md:hidden p-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>

                    <div>
                        <p class="text-xs text-slate-400 font-medium hidden sm:block">Sistem Informasi Posyandu & Buku KIA Digital</p>
                        <div class="text-sm sm:text-base text-slate-600 font-medium">
                            Selamat datang, <span class="text-slate-900 font-extrabold">{{ Auth::user()->name }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3 sm:gap-4">
                    {{-- ====== IKON LONCENG NOTIFIKASI ====== --}}
                    <div class="relative" x-data="{ notifOpen: false }">
                        <button @click="notifOpen = !notifOpen"
                                @click.outside="notifOpen = false"
                                type="button"
                                class="relative p-2.5 rounded-2xl bg-slate-50 hover:bg-primary-50 text-slate-500 hover:text-primary-700 border border-slate-200/80 transition-colors focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>

                            @if(Auth::user()->unreadNotifications->count() > 0)
                                <span class="absolute -top-1 -right-1 inline-flex items-center justify-center min-w-[20px] h-5 px-1.5 text-[11px] font-extrabold leading-none text-white bg-rose-600 rounded-full shadow-xs">
                                    {{ Auth::user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </button>

                        {{-- Dropdown Notifikasi --}}
                        <div x-show="notifOpen"
                             x-transition
                             style="display: none;"
                             class="absolute right-0 mt-2.5 w-80 sm:w-96 bg-white rounded-2xl shadow-xl border border-slate-200/90 overflow-hidden z-50">
                            <div class="px-5 py-3.5 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                                <span class="font-bold text-sm text-slate-900">Notifikasi Terbaru</span>
                                @if(Auth::user()->unreadNotifications->count() > 0)
                                    <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-primary-100 text-primary-800">
                                        {{ Auth::user()->unreadNotifications->count() }} Baru
                                    </span>
                                @endif
                            </div>
                            <div class="max-h-72 overflow-y-auto divide-y divide-slate-100">
                                @forelse(Auth::user()->unreadNotifications as $notif)
                                    <a href="{{ route('notifications.read', $notif->id) }}"
                                       class="block p-4 hover:bg-primary-50/40 transition-colors">
                                        <p class="font-bold text-sm text-primary-700">{{ $notif->data['judul'] }}</p>
                                        <p class="text-xs text-slate-600 mt-1 leading-relaxed">{{ $notif->data['pesan'] }}</p>
                                        <span class="text-[11px] font-medium text-slate-400 mt-2 block">{{ $notif->created_at->diffForHumans() }}</span>
                                    </a>
                                @empty
                                    <div class="py-8 px-4 text-center text-slate-500 text-sm">
                                        Tidak ada notifikasi baru.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{-- User Profile & Role Badge --}}
                    <div class="flex items-center gap-2.5 pl-2 sm:pl-3 border-l border-slate-200/80">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary-600 to-emerald-600 text-white font-extrabold text-xs flex items-center justify-center shadow-2xs">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <span class="bg-primary-50 text-primary-800 border border-primary-200/80 px-3 py-1 rounded-full text-xs font-extrabold uppercase tracking-wide">
                            {{ Auth::user()->getRoleNames()->first() ?? 'User' }}
                        </span>
                    </div>
                </div>
            </header>

            {{-- PAGE CONTENT --}}
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 print:p-0 print:overflow-visible">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    {{-- ================= GLOBAL CUSTOM DELETE CONFIRMATION MODAL ================= --}}
    <div x-data="{
            open: false,
            form: null,
            title: 'Konfirmasi Penghapusan',
            message: 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.'
         }"
         @open-delete-modal.window="
            open = true;
            form = $event.detail.form;
            title = $event.detail.title || 'Konfirmasi Penghapusan';
            message = $event.detail.message || 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.';
         "
         @keydown.escape.window="open = false"
         x-show="open"
         style="display: none;"
         class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 print:hidden"
         role="dialog"
         aria-modal="true">

        {{-- Backdrop Blur --}}
        <div x-show="open"
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="open = false"
             class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs transition-opacity"></div>

        {{-- Kartu Modal --}}
        <div x-show="open"
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95 translate-y-2"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-2"
             class="relative z-10 w-full max-w-md bg-white rounded-3xl shadow-2xl border border-slate-200/80 overflow-hidden p-6 sm:p-7">

            <div class="flex flex-col items-center text-center">
                {{-- Ikon Peringatan Hapus --}}
                <div class="w-14 h-14 rounded-2xl bg-rose-50 border border-rose-100 flex items-center justify-center text-rose-600 mb-4 shadow-xs">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </div>

                {{-- Judul & Pesan Dinamis --}}
                <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 tracking-tight" x-text="title"></h3>
                <p class="text-xs sm:text-sm text-slate-500 mt-2 leading-relaxed" x-text="message"></p>
            </div>

            {{-- Tombol Aksi Pill --}}
            <div class="grid grid-cols-2 gap-3 mt-6 pt-4 border-t border-slate-100">
                <button type="button"
                        @click="open = false"
                        class="w-full py-3 px-4 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs uppercase tracking-wider transition-all">
                    Batal
                </button>

                <button type="button"
                        @click="if(form) form.submit(); open = false;"
                        class="w-full py-3 px-4 rounded-full bg-gradient-to-r from-rose-600 to-red-700 hover:from-rose-700 hover:to-red-800 text-white font-extrabold text-xs uppercase tracking-wider shadow-md shadow-rose-600/25 transition-all hover:-translate-y-0.5">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    {{-- ================= GLOBAL FLOATING TOAST NOTIFICATION ================= --}}
    @if (session('success') || session('error'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 4500)"
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-3 sm:translate-y-0 sm:translate-x-4"
             x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed bottom-5 right-5 z-50 max-w-sm w-full bg-white rounded-2xl shadow-2xl border {{ session('success') ? 'border-emerald-200' : 'border-rose-200' }} p-4 flex items-start gap-3.5 print:hidden">
            @if (session('success'))
                <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
                <div class="flex-1 pt-0.5">
                    <p class="text-xs font-extrabold uppercase tracking-wider text-emerald-800">Berhasil</p>
                    <p class="text-xs text-slate-600 mt-0.5 leading-relaxed">{{ session('success') }}</p>
                </div>
            @else
                <div class="w-9 h-9 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                </div>
                <div class="flex-1 pt-0.5">
                    <p class="text-xs font-extrabold uppercase tracking-wider text-rose-800">Terjadi Kesalahan</p>
                    <p class="text-xs text-slate-600 mt-0.5 leading-relaxed">{{ session('error') }}</p>
                </div>
            @endif
            <button @click="show = false" class="text-slate-400 hover:text-slate-600 p-1">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    {{-- ================= OTOMATIS GANTI SEMUA confirm() BAWAAN BROWSER ================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Mengubah otomatis semua <form onsubmit="return confirm('...')"> menjadi custom modal SIPANDAI
            document.querySelectorAll('form[onsubmit*="confirm("]').forEach((form) => {
                const rawAttr = form.getAttribute('onsubmit') || '';
                const match = rawAttr.match(/confirm\(['"](.+?)['"]\)/);
                const customMsg = match ? match[1] : 'Apakah Anda yakin ingin menghapus data ini?';

                form.removeAttribute('onsubmit');
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    window.dispatchEvent(new CustomEvent('open-delete-modal', {
                        detail: {
                            form: form,
                            title: 'Konfirmasi Hapus Data',
                            message: customMsg
                        }
                    }));
                });
            });
        });
    </script>
</body>
</html>