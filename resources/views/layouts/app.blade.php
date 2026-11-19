<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIPANDAI - Sistem Informasi Posyandu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 antialiased font-sans">
    <div class="flex h-screen overflow-hidden">
        
        <!-- SIDEBAR -->
        <aside class="w-64 bg-primary-800 text-white flex-col hidden md:flex">
            <div class="h-16 flex items-center justify-center border-b border-primary-700">
                <h1 class="text-2xl font-bold tracking-wider">SIPANDAI</h1>
            </div>
            
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <!-- Menu Dashboard (Semua Role) -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-primary-700' : 'hover:bg-primary-700 text-primary-100' }} rounded-lg transition-colors">
                    <span>Dashboard</span>
                </a>

                <!-- MENU KHUSUS ADMIN -->
                @if(Auth::user()->hasRole('admin'))
                    <a href="{{ route('admin.wilayah') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.wilayah') ? 'bg-primary-700' : 'hover:bg-primary-700 text-primary-100' }} rounded-lg transition-colors">
                        <span>Data Wilayah</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.users.*') ? 'bg-primary-700' : 'hover:bg-primary-700 text-primary-100' }} rounded-lg transition-colors">
                        <span>Manajemen Pengguna</span>
                    </a>
                    <a href="{{ route('admin.stunting') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.stunting') ? 'bg-primary-700' : 'hover:bg-primary-700 text-primary-100' }} rounded-lg transition-colors">
                        <span>Monitoring Stunting</span>
                    </a>
                    <a href="{{ route('admin.data-warga') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.data-warga') ? 'bg-primary-700' : 'hover:bg-primary-700 text-primary-100' }} rounded-lg transition-colors">
                        <span>Pusat Data Warga</span>
                    </a>
                    <a href="{{ route('admin.jadwal.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.jadwal.*') ? 'bg-primary-700' : 'hover:bg-primary-700 text-primary-100' }} rounded-lg transition-colors">
                        <span>Jadwal Posyandu</span>
                    </a>
                    <a href="{{ route('admin.laporan.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.laporan.*') ? 'bg-primary-700' : 'hover:bg-primary-700 text-primary-100' }} rounded-lg transition-colors">
                        <span>Pusat Laporan</span>
                    </a>
                @endif

                <!-- MENU KHUSUS KADER -->
                @if(Auth::user()->hasRole('kader'))
                    <a href="{{ route('kader.anak.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('kader.anak.*') ? 'bg-primary-700' : 'hover:bg-primary-700 text-primary-100' }} rounded-lg transition-colors">
                        <span>Data Anak</span>
                    </a>
                    <a href="{{ route('kader.ibu_hamil.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('kader.ibu_hamil.*') ? 'bg-primary-700' : 'hover:bg-primary-700 text-primary-100' }} rounded-lg transition-colors">
                        <span>Data Ibu Hamil</span>
                    </a>
                    <a href="{{ route('kader.kb.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('kader.kb.*') ? 'bg-primary-700' : 'hover:bg-primary-700 text-primary-100' }} rounded-lg transition-colors">
                        <span>Data KB</span>
                    </a>
                    <a href="{{ route('kader.verifikasi.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('kader.verifikasi.*') ? 'bg-primary-700' : 'hover:bg-primary-700 text-primary-100' }} rounded-lg transition-colors">
                        <span>Verifikasi Akun</span>
                        @php
                            $pendingCount = \App\Models\User::where('status', 'pending')->where('posyandu_id', Auth::user()->posyandu_id)->count();
                        @endphp
                        @if($pendingCount > 0)
                            <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingCount }}</span>
                        @endif
                    </a>
                @endif

                <!-- MENU KHUSUS BIDAN -->
                @if(Auth::user()->hasRole('bidan'))
                    <a href="{{ route('bidan.kasus.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('bidan.kasus.*') ? 'bg-primary-700' : 'hover:bg-primary-700 text-primary-100' }} rounded-lg transition-colors">
                        <span>Daftar Rujukan</span>
                    </a>
                    <a href="{{ route('bidan.jadwal') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('bidan.jadwal') ? 'bg-primary-700' : 'hover:bg-primary-700 text-primary-100' }} rounded-lg transition-colors">
                        <span>Jadwal Kegiatan</span>
                    </a>
                @endif
                
            </nav>

            <div class="p-4 border-t border-primary-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 bg-red-500 hover:bg-red-600 rounded-lg text-white font-medium transition-colors">
                        Log Out
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            
            <!-- NAVBAR -->
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 relative z-50">
                <div class="text-slate-500 font-medium">
                    Selamat datang, <span class="text-primary-600 font-bold">{{ Auth::user()->name }}</span>
                </div>
                <div class="flex items-center gap-4">
                    
                    <!-- ====== IKON LONCENG NOTIFIKASI ====== -->
                    <div class="relative group">
                        <button class="relative p-2 text-slate-400 hover:text-primary-600 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            
                            @if(Auth::user()->unreadNotifications->count() > 0)
                                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                                    {{ Auth::user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </button>

                        <!-- Dropdown Notifikasi (Bisa Diklik) -->
                        <div class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-slate-200 hidden group-hover:block z-50">
                            <div class="p-4 border-b border-slate-100 font-bold text-slate-800">
                                Notifikasi Terbaru
                            </div>
                            <div class="max-h-64 overflow-y-auto">
                                @forelse(Auth::user()->unreadNotifications as $notif)
                                    <!-- MENGGUNAKAN ROUTE notifications.read AGAR OTOMATIS TERHAPUS -->
                                    <a href="{{ route('notifications.read', $notif->id) }}" class="block p-4 border-b border-slate-50 hover:bg-slate-50 transition-colors">
                                        <p class="font-semibold text-sm text-primary-600">{{ $notif->data['judul'] }}</p>
                                        <p class="text-xs text-slate-600 mt-1">{{ $notif->data['pesan'] }}</p>
                                        <span class="text-[10px] text-slate-400 mt-2 block">{{ $notif->created_at->diffForHumans() }}</span>
                                    </a>
                                @empty
                                    <div class="p-4 text-center text-slate-500 text-sm">Tidak ada notifikasi baru.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <!-- ====== AKHIR IKON LONCENG ====== -->

                    <!-- Badge Role -->
                    <span class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                        {{ Auth::user()->getRoleNames()->first() ?? 'User' }}
                    </span>
                </div>
            </header>

            <!-- PAGE CONTENT -->
            <main class="flex-1 overflow-y-auto p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>