<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Posyandu;
use App\Models\Anak;
use App\Models\PemeriksaanAnak;
use App\Models\IbuHamil;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // 1. Dashboard untuk Admin
    public function admin()
    {
        $totalKader = User::role('kader')->count();
        $totalBidan = User::role('bidan')->count();
        $totalPosyandu = Posyandu::count();

        $totalAnak = Anak::count();
        $totalIbuHamil = IbuHamil::count();
        $totalStunting = PemeriksaanAnak::where('status_gizi', 'Stunting')->distinct('anak_id')->count('anak_id');

        $pendingUsers = User::where('status', 'pending')->take(5)->get();
        $anakStuntings = PemeriksaanAnak::with(['anak.desa', 'anak.posyandu'])
            ->where('status_gizi', 'Stunting')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.index', compact(
            'totalKader',
            'totalBidan',
            'totalPosyandu',
            'totalAnak',
            'totalStunting',
            'totalIbuHamil',
            'pendingUsers',
            'anakStuntings'
        ));
    }

    // 2. Dashboard untuk Kader
    public function kader()
    {
        $user = request()->user();
        $posyanduId = $user->posyandu_id;

        $totalAnak = Anak::where('posyandu_id', $posyanduId)->count();

        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        $anakBelumDitimbang = Anak::where('posyandu_id', $posyanduId)
            ->whereDoesntHave('pemeriksaans', function ($query) use ($bulanIni, $tahunIni) {
                $query->whereMonth('tanggal_periksa', $bulanIni)
                    ->whereYear('tanggal_periksa', $tahunIni);
            })->get();

        return view('kader.index', compact('totalAnak', 'anakBelumDitimbang'));
    }

    // 3. Dashboard untuk Bidan
    public function bidan()
    {
        $user = request()->user();
        $desaId = $user->desa_id;

        $totalStunting = \App\Models\Anak::where('desa_id', $desaId)
            ->whereHas('pemeriksaans', function ($q) {
                $q->where('status_gizi', 'Stunting');
            })->count();

        $totalIbuRisiko = \App\Models\IbuHamil::where('desa_id', $desaId)
            ->where('status_risiko', '!=', 'Normal')
            ->count();

        return view('bidan.index', compact('totalStunting', 'totalIbuRisiko'));
    }

    // 4. Dashboard untuk Orang Tua (SUDAH DIPERBAIKI, TIDAK DOBEL LAGI)
    public function orangtua()
    {
        $user = request()->user();

        // Ambil semua anak milik orang tua ini
        $anaks = \App\Models\Anak::where('orangtua_id', $user->id)
            ->with(['pemeriksaans' => function ($query) {
                $query->orderBy('tanggal_periksa', 'asc'); // Urutkan dari yang terlama untuk grafik
            }])
            ->get();

        // Ambil data KB berdasarkan nama peserta (atau NIK jika Anda menambahkannya)
        $kbs = \App\Models\Kb::where('nama_peserta', $user->name)->orderBy('tanggal_mulai', 'desc')->get();

        return view('orangtua.index', compact('anaks', 'kbs'));
    }
}
