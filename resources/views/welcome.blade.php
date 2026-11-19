<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPANDAI - Sistem Informasi Posyandu Andalan Ibu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hero-bg {
            background: linear-gradient(135deg, #064e3b 0%, #059669 100%);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">
    
    <!-- NAVBAR -->
    <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 fixed w-full top-0 z-50 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="text-2xl font-extrabold text-primary-700 tracking-tighter">SIPANDAI</span>
            </div>
            
            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600">
                <a href="#beranda" class="hover:text-primary-600 transition-colors">Beranda</a>
                <a href="#statistik" class="hover:text-primary-600 transition-colors">Statistik</a>
                <a href="#layanan" class="hover:text-primary-600 transition-colors">Layanan</a>
                <a href="#warta" class="hover:text-primary-600 transition-colors">Warta</a>
            </nav>

            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-lg font-semibold shadow-sm transition-all hover:-translate-y-0.5">
                            Ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-600 hover:text-primary-600 font-semibold">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-lg font-semibold shadow-sm transition-all hover:-translate-y-0.5">
                                Daftar Akun
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section id="beranda" class="hero-bg pt-32 pb-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="text-white">
                <div class="inline-block bg-white/20 backdrop-blur-sm text-white px-4 py-1.5 rounded-full text-sm font-bold mb-6 border border-white/30">
                    Kecamatan Sukamaju
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
                    Sistem Informasi <br> <span class="text-emerald-300">Posyandu Andalan Ibu</span>
                </h1>
                <p class="text-lg text-emerald-50 mb-8 leading-relaxed opacity-90">
                    Platform terintegrasi untuk pencatatan Kesehatan Ibu dan Anak (KIA), pemantauan tumbuh kembang, deteksi stunting, serta pelayanan Posyandu di seluruh desa.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('login') }}" class="bg-white text-primary-700 hover:bg-slate-50 px-8 py-3.5 rounded-lg font-bold shadow-lg transition-all hover:-translate-y-0.5">
                        Mulai Masuk Sistem
                    </a>
                    <a href="#layanan" class="bg-transparent border border-white text-white hover:bg-white/10 px-8 py-3.5 rounded-lg font-bold transition-all">
                        Pelajari Fitur
                    </a>
                </div>
            </div>
            <div class="hidden md:flex justify-center">
                <!-- Ilustrasi vektor sederhana (bisa diganti gambar sendiri) -->
                <img src="https://illustrations.popsy.co/emerald/health-check.svg" alt="Ilustrasi Posyandu" class="w-full max-w-md drop-shadow-2xl">
            </div>
        </div>
    </section>

    <!-- STATISTIK SECTION -->
    <section id="statistik" class="py-16 bg-white border-b border-slate-200 relative -mt-8 mx-4 sm:mx-6 lg:mx-8 rounded-2xl shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center divide-y md:divide-y-0 md:divide-x divide-slate-100">
                <div class="p-6">
                    <p class="text-5xl font-extrabold text-primary-600 mb-2">10</p>
                    <p class="text-slate-500 font-bold uppercase tracking-wider text-sm">Desa Terdaftar</p>
                </div>
                <div class="p-6">
                    <p class="text-5xl font-extrabold text-primary-600 mb-2">25</p>
                    <p class="text-slate-500 font-bold uppercase tracking-wider text-sm">Posyandu Aktif</p>
                </div>
                <div class="p-6">
                    <p class="text-5xl font-extrabold text-primary-600 mb-2">1.240</p>
                    <p class="text-slate-500 font-bold uppercase tracking-wider text-sm">Anak Terpantau</p>
                </div>
            </div>
        </div>
    </section>

    <!-- LAYANAN SECTION -->
    <section id="layanan" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Layanan Terpadu SIPANDAI</h2>
                <p class="text-lg text-slate-600">Ekosistem digital untuk penguatan layanan Posyandu di tingkat desa, mendukung percepatan penurunan stunting.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Card 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:border-primary-200 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-primary-50 text-primary-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary-600 group-hover:text-white transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <h3 class="font-bold text-xl text-slate-800 mb-3">Kesehatan Ibu & Anak</h3>
                    <p class="text-slate-500 leading-relaxed">Pemeriksaan kehamilan, pemantauan ibu menyusui, pemberian vitamin, dan kelas ibu hamil.</p>
                </div>
                <!-- Card 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:border-primary-200 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-primary-50 text-primary-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary-600 group-hover:text-white transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <h3 class="font-bold text-xl text-slate-800 mb-3">Tumbuh Kembang</h3>
                    <p class="text-slate-500 leading-relaxed">Pemantauan berat badan, tinggi badan, lingkar kepala, serta deteksi dini stunting otomatis.</p>
                </div>
                <!-- Card 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:border-primary-200 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-primary-50 text-primary-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary-600 group-hover:text-white transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="font-bold text-xl text-slate-800 mb-3">Imunisasi</h3>
                    <p class="text-slate-500 leading-relaxed">Pencatatan jadwal imunisasi dasar lengkap dan pemantauan cakupan imunisasi desa.</p>
                </div>
                <!-- Card 4 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:border-primary-200 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-primary-50 text-primary-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary-600 group-hover:text-white transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="font-bold text-xl text-slate-800 mb-3">Pelayanan KB</h3>
                    <p class="text-slate-500 leading-relaxed">Pencatatan peserta KB, jenis kontrasepsi, dan jadwal ulang untuk mencegah dropout.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-slate-900 text-slate-400 py-12 text-center text-sm">
        <div class="max-w-7xl mx-auto px-4">
            <p class="text-xl font-bold text-white mb-4">SIPANDAI</p>
            <p class="mb-2">Sistem Informasi Posyandu Andalan Ibu</p>
            <p>&copy; {{ date('Y') }} Pemerintah Kecamatan Sukamaju. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

</body>
</html>