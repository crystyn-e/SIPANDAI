<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\IbuHamil;
use App\Models\JadwalPosyandu;
use Illuminate\Http\Request;

class KasusController extends Controller
{
    // 1. Menampilkan halaman Daftar Kasus
    public function index()
    {
        $user = request()->user();
        $desaId = $user->desa_id;

        // Ambil anak stunting di desa bidan tersebut
        $anakStunting = Anak::where('desa_id', $desaId)
            ->whereHas('pemeriksaans', function ($q) {
                $q->where('status_gizi', 'Stunting');
            })->with(['posyandu', 'orangtua'])->get();

        // Ambil ibu hamil dengan risiko tinggi di desa tersebut
        $ibuHamilRisiko = IbuHamil::where('desa_id', $desaId)
            ->where('status_risiko', '!=', 'Normal')
            ->get();

        return view('bidan.kasus.index', compact('anakStunting', 'ibuHamilRisiko'));
    }

    // 2. Menampilkan Form Catatan Medis Anak
    public function createCatatanAnak(Anak $anak)
    {
        return view('bidan.kasus.catatan_anak', compact('anak'));
    }

    // 3. Menyimpan Catatan Medis Anak
    public function storeCatatanAnak(Request $request, Anak $anak)
    {
        $request->validate([
            'catatan_medis' => 'required|string',
        ]);

        $pemeriksaanTerakhir = $anak->pemeriksaans()->latest('tanggal_periksa')->first();
        if ($pemeriksaanTerakhir) {
            $pemeriksaanTerakhir->update(['catatan' => $request->catatan_medis]);
        }

        return redirect()->route('bidan.kasus.index')->with('success', 'Catatan medis berhasil ditambahkan.');
    }

    // 4. Menampilkan Form Catatan Medis Ibu Hamil
    public function createCatatanIbu(IbuHamil $ibuHamil)
    {
        return view('bidan.kasus.catatan_ibu', compact('ibuHamil'));
    }

    // 5. Menyimpan Catatan Medis Ibu Hamil
    public function storeCatatanIbu(Request $request, IbuHamil $ibuHamil)
    {
        $request->validate([
            'catatan_medis' => 'required|string',
        ]);

        $ibuHamil->update([
            'catatan_bidan' => $request->catatan_medis
        ]);

        return redirect()->route('bidan.kasus.index')->with('success', 'Catatan medis ibu hamil berhasil ditambahkan.');
    }

    public function showIbu(IbuHamil $ibuHamil)
    {
        // Pastikan ibu hamil ini ada di desa binaan bidan
        if ($ibuHamil->desa_id !== request()->user()->desa_id) {
            abort(403);
        }

        return view('bidan.kasus.show_ibu', compact('ibuHamil'));
    }

    // 6. Menampilkan Jadwal Kegiatan Bidan
    public function jadwal()
    {
        $user = request()->user();
        $desaId = $user->desa_id;

        // Ambil jadwal Posyandu yang ada di desa Bidan tersebut
        $jadwals = JadwalPosyandu::whereHas('posyandu', function ($q) use ($desaId) {
            $q->where('desa_id', $desaId);
        })->orderBy('tanggal', 'asc')->get();

        return view('bidan.jadwal', compact('jadwals'));
    }

    public function show(Anak $anak)
    {
        // Pastikan anak ini ada di desa binaan bidan
        if ($anak->desa_id !== request()->user()->desa_id) {
            abort(403);
        }

        $pemeriksaans = $anak->pemeriksaans()->orderBy('tanggal_periksa', 'asc')->get();
        $imunisasis = $anak->imunisasis()->orderBy('tanggal_imunisasi', 'asc')->get();

        return view('bidan.kasus.show', compact('anak', 'pemeriksaans', 'imunisasis'));
    }
}
