<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\WilayahController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\StuntingController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\DataWargaController;
use App\Http\Controllers\Kader\AnakController;
use App\Http\Controllers\Kader\PemeriksaanController;
use App\Http\Controllers\Kader\IbuHamilController;
use App\Http\Controllers\Bidan\KasusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrangtuaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// --- GRUP RUTE UNTUK USER YANG SUDAH LOGIN ---
Route::middleware('auth')->group(function () {

    // 1. PINTU GERBANG UTAMA SETELAH LOGIN (Redirect berdasarkan Role)
    Route::get('/dashboard', function () {
        $user = request()->user();

        if ($user->hasRole('admin')) return redirect()->route('dashboard.admin');
        if ($user->hasRole('kader')) return redirect()->route('dashboard.kader');
        if ($user->hasRole('bidan')) return redirect()->route('dashboard.bidan');
        if ($user->hasRole('orangtua')) return redirect()->route('dashboard.orangtua');

        return redirect('/');
    })->name('dashboard');

    // ==========================================================
    // RUTE UNIVERSAL UNTUK MEMBACA NOTIFIKASI (SEMUA ROLE)
    // ==========================================================
    Route::get('/notifications/{id}/read', function ($id) {
        $notification = request()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        $url = $notification->data['url'] ?? '/dashboard';
        return redirect($url);
    })->name('notifications.read');

    // 2. RUTE MASING-MASING DASHBOARD
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('/kader/dashboard', [DashboardController::class, 'kader'])->name('dashboard.kader');
    Route::get('/bidan/dashboard', [DashboardController::class, 'bidan'])->name('dashboard.bidan');
    Route::get('/orangtua/dashboard', [DashboardController::class, 'orangtua'])->name('dashboard.orangtua');

    // 3. RUTE PROFIL BAWAAN BREEZE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 4. RUTE KHUSUS ADMIN
    Route::middleware(['role:admin'])->group(function () {
        // Manajemen Pengguna
        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::patch('/admin/users/{user}/verify', [UserController::class, 'verify'])->name('admin.users.verify');
        Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

        // Data Wilayah
        Route::get('/admin/wilayah', [WilayahController::class, 'index'])->name('admin.wilayah');
        Route::get('/admin/wilayah/create', [WilayahController::class, 'create'])->name('admin.wilayah.create');
        Route::post('/admin/wilayah', [WilayahController::class, 'store'])->name('admin.wilayah.store');
        Route::get('/admin/wilayah/{posyandu}/edit', [WilayahController::class, 'edit'])->name('admin.wilayah.edit');
        Route::put('/admin/wilayah/{posyandu}', [WilayahController::class, 'update'])->name('admin.wilayah.update');
        Route::delete('/admin/wilayah/{posyandu}', [WilayahController::class, 'destroy'])->name('admin.wilayah.destroy');

        // Monitoring Stunting
        Route::get('/admin/stunting', [StuntingController::class, 'index'])->name('admin.stunting');

        // Pusat Data Warga
        Route::get('/admin/data-warga', [DataWargaController::class, 'index'])->name('admin.data-warga');
        Route::delete('/admin/data-warga/anak/{anak}', [DataWargaController::class, 'destroyAnak'])->name('admin.data-warga.destroy-anak');
        Route::delete('/admin/data-warga/ibu/{ibuHamil}', [DataWargaController::class, 'destroyIbuHamil'])->name('admin.data-warga.destroy-ibu');
        Route::get('/admin/data-warga/anak/{anak}/edit', [DataWargaController::class, 'editAnak'])->name('admin.data-warga.edit-anak');
        Route::put('/admin/data-warga/anak/{anak}', [DataWargaController::class, 'updateAnak'])->name('admin.data-warga.update-anak');
        Route::get('/admin/data-warga/ibu/{ibuHamil}/edit', [DataWargaController::class, 'editIbuHamil'])->name('admin.data-warga.edit-ibu');
        Route::put('/admin/data-warga/ibu/{ibuHamil}', [DataWargaController::class, 'updateIbuHamil'])->name('admin.data-warga.update-ibu');

        // Jadwal Posyandu
        Route::get('/admin/jadwal', [JadwalController::class, 'index'])->name('admin.jadwal.index');
        Route::get('/admin/jadwal/create', [JadwalController::class, 'create'])->name('admin.jadwal.create');
        Route::post('/admin/jadwal', [JadwalController::class, 'store'])->name('admin.jadwal.store');
        Route::get('/admin/jadwal/{jadwal}/edit', [JadwalController::class, 'edit'])->name('admin.jadwal.edit');
        Route::put('/admin/jadwal/{jadwal}', [JadwalController::class, 'update'])->name('admin.jadwal.update');
        Route::delete('/admin/jadwal/{jadwal}', [JadwalController::class, 'destroy'])->name('admin.jadwal.destroy');

        // Laporan
        Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');
        Route::get('/admin/laporan/stunting/pdf', [LaporanController::class, 'exportStuntingPdf'])->name('admin.laporan.stunting.pdf');
        Route::get('/admin/laporan/ibu-hamil/pdf', [LaporanController::class, 'exportIbuHamilPdf'])->name('admin.laporan.ibu-hamil.pdf');
    });

    // 5. RUTE KHUSUS KADER
    Route::middleware(['role:kader'])->group(function () {
        // Anak
        Route::get('/kader/anak', [AnakController::class, 'index'])->name('kader.anak.index');
        Route::get('/kader/anak/create', [AnakController::class, 'create'])->name('kader.anak.create');
        Route::post('/kader/anak', [AnakController::class, 'store'])->name('kader.anak.store');

        // Detail Anak (Harus di atas edit/destroy agar tidak bentrok)
        Route::get('/kader/anak/{anak}', [AnakController::class, 'show'])->name('kader.anak.show');

        // Edit & Hapus Anak
        Route::get('/kader/anak/{anak}/edit', [AnakController::class, 'edit'])->name('kader.anak.edit');
        Route::put('/kader/anak/{anak}', [AnakController::class, 'update'])->name('kader.anak.update');
        Route::delete('/kader/anak/{anak}', [AnakController::class, 'destroy'])->name('kader.anak.destroy');

        // Pemeriksaan
        Route::get('/kader/anak/{anak}/periksa', [PemeriksaanController::class, 'create'])->name('kader.pemeriksaan.create');
        Route::post('/kader/anak/{anak}/periksa', [PemeriksaanController::class, 'store'])->name('kader.pemeriksaan.store');
        Route::get('/kader/pemeriksaan/{pemeriksaan}/edit', [PemeriksaanController::class, 'edit'])->name('kader.pemeriksaan.edit');
        Route::put('/kader/pemeriksaan/{pemeriksaan}', [PemeriksaanController::class, 'update'])->name('kader.pemeriksaan.update');
        Route::delete('/kader/pemeriksaan/{pemeriksaan}', [PemeriksaanController::class, 'destroy'])->name('kader.pemeriksaan.destroy');

        // Ibu Hamil
        Route::get('/kader/ibu-hamil', [IbuHamilController::class, 'index'])->name('kader.ibu_hamil.index');
        Route::get('/kader/ibu-hamil/create', [IbuHamilController::class, 'create'])->name('kader.ibu_hamil.create');
        Route::post('/kader/ibu-hamil', [IbuHamilController::class, 'store'])->name('kader.ibu_hamil.store');
        Route::get('/kader/ibu-hamil/{ibuHamil}/edit', [IbuHamilController::class, 'edit'])->name('kader.ibu_hamil.edit');
        Route::put('/kader/ibu-hamil/{ibuHamil}', [IbuHamilController::class, 'update'])->name('kader.ibu_hamil.update');
        Route::delete('/kader/ibu-hamil/{ibuHamil}', [IbuHamilController::class, 'destroy'])->name('kader.ibu_hamil.destroy');

        // Imunisasi
        Route::get('/kader/anak/{anak}/imunisasi', [\App\Http\Controllers\Kader\ImunisasiController::class, 'create'])->name('kader.imunisasi.create');
        Route::post('/kader/anak/{anak}/imunisasi', [\App\Http\Controllers\Kader\ImunisasiController::class, 'store'])->name('kader.imunisasi.store');

        // KB
        Route::get('/kader/kb', [\App\Http\Controllers\Kader\KbController::class, 'index'])->name('kader.kb.index');
        Route::get('/kader/kb/create', [\App\Http\Controllers\Kader\KbController::class, 'create'])->name('kader.kb.create');
        Route::post('/kader/kb', [\App\Http\Controllers\Kader\KbController::class, 'store'])->name('kader.kb.store');
        Route::get('/kader/kb/{kb}/edit', [\App\Http\Controllers\Kader\KbController::class, 'edit'])->name('kader.kb.edit');
        Route::put('/kader/kb/{kb}', [\App\Http\Controllers\Kader\KbController::class, 'update'])->name('kader.kb.update');
        Route::delete('/kader/kb/{kb}', [\App\Http\Controllers\Kader\KbController::class, 'destroy'])->name('kader.kb.destroy');

        // Verifikasi Akun
        Route::get('/kader/verifikasi', [\App\Http\Controllers\Kader\VerifikasiController::class, 'index'])->name('kader.verifikasi.index');
        Route::patch('/kader/verifikasi/{user}', [\App\Http\Controllers\Kader\VerifikasiController::class, 'verify'])->name('kader.verifikasi.verify');
    });

    // 6. RUTE KHUSUS BIDAN
    Route::middleware(['role:bidan'])->group(function () {
        Route::get('/bidan/kasus', [KasusController::class, 'index'])->name('bidan.kasus.index');
        Route::get('/bidan/anak/{anak}/catatan', [KasusController::class, 'createCatatanAnak'])->name('bidan.kasus.catatan-anak');
        Route::post('/bidan/anak/{anak}/catatan', [KasusController::class, 'storeCatatanAnak'])->name('bidan.kasus.store-catatan-anak');
        Route::get('/bidan/ibu/{ibuHamil}/catatan', [KasusController::class, 'createCatatanIbu'])->name('bidan.kasus.catatan-ibu');
        Route::post('/bidan/ibu/{ibuHamil}/catatan', [KasusController::class, 'storeCatatanIbu'])->name('bidan.kasus.store-catatan-ibu');
        Route::get('/bidan/jadwal', [KasusController::class, 'jadwal'])->name('bidan.jadwal');
        Route::get('/bidan/anak/{anak}', [KasusController::class, 'show'])->name('bidan.anak.show');
        Route::get('/bidan/ibu/{ibuHamil}', [KasusController::class, 'showIbu'])->name('bidan.ibu.show');
    });

    // 7. RUTE KHUSUS ORANG TUA
    Route::middleware(['role:orangtua'])->group(function () {
        Route::get('/orangtua/anak/{anak}/kms-pdf', [OrangtuaController::class, 'downloadKmsPdf'])->name('orangtua.kms.pdf');
    });
    Route::middleware(['role:orangtua'])->group(function () {
        Route::get('/orangtua/anak/{anak}/kms-pdf', [OrangtuaController::class, 'downloadKmsPdf'])->name('orangtua.kms.pdf');
    });
});


require __DIR__ . '/auth.php';
