<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\PemeriksaanAnak;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PemeriksaanController extends Controller
{
    public function create(Anak $anak)
    {
        return view('kader.pemeriksaan.create', compact('anak'));
    }

    public function store(Request $request, Anak $anak)
    {
        // 1. VALIDASI LOGIS
        $request->validate([
            'tanggal_periksa' => 'required|date',
            'berat_badan' => 'required|numeric|min:1|max:30',
            'tinggi_badan' => 'required|numeric|min:30|max:120',
            'lingkar_kepala' => 'nullable|numeric|min:30|max:60',
        ], [
            'berat_badan.min' => 'Berat badan tidak masuk akal (terlalu ringan).',
            'berat_badan.max' => 'Berat badan tidak masuk akal (terlalu berat untuk balita).',
            'tinggi_badan.min' => 'Tinggi badan tidak masuk akal (terlalu pendek).',
            'tinggi_badan.max' => 'Tinggi badan tidak masuk akal (terlalu tinggi untuk balita).',
            'lingkar_kepala.min' => 'Lingkar kepala tidak masuk akal (minimal 30 cm).',
            'lingkar_kepala.max' => 'Lingkar kepala tidak masuk akal (maksimal 60 cm).',
        ]);

        // 2. HITUNG USIA
        $tanggalLahir = Carbon::parse($anak->tanggal_lahir);
        $tanggalPeriksa = Carbon::parse($request->tanggal_periksa);
        $usiaBulan = $tanggalLahir->diffInMonths($tanggalPeriksa);

        // 3. LOGIKA STUNTING
        $tb = $request->tinggi_badan;
        $statusGizi = 'Normal';

        if ($usiaBulan >= 0 && $usiaBulan <= 6) {
            if ($tb < 55) $statusGizi = 'Stunting';
        } elseif ($usiaBulan > 6 && $usiaBulan <= 12) {
            if ($tb < 65) $statusGizi = 'Stunting';
        } elseif ($usiaBulan > 12 && $usiaBulan <= 24) {
            if ($tb < 75) $statusGizi = 'Stunting';
        } elseif ($usiaBulan > 24 && $usiaBulan <= 36) {
            if ($tb < 85) $statusGizi = 'Stunting';
        } elseif ($usiaBulan > 36 && $usiaBulan <= 60) {
            if ($tb < 95) $statusGizi = 'Stunting';
        } else {
            $statusGizi = 'Di Luar Rentang Balita';
        }

        // 4. SIMPAN DATA
        PemeriksaanAnak::create([
            'anak_id' => $anak->id,
            'tanggal_periksa' => $request->tanggal_periksa,
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'lingkar_kepala' => $request->lingkar_kepala,
            'status_gizi' => $statusGizi,
            'catatan' => $request->catatan,
        ]);

        // 5. REDIRECT DENGAN PESAN BERWARNA
        if ($statusGizi === 'Stunting') {
            return redirect()->route('kader.anak.index')->with('error', 'PERINGATAN: Anak terdeteksi STUNTING. Mohon berikan intervensi gizi lebih lanjut.');
        }

        return redirect()->route('kader.anak.index')->with('success', 'Data pemeriksaan berhasil disimpan. Status Gizi: ' . $statusGizi);
    }

    // --- TAMBAHAN FITUR EDIT & HAPUS ---

    public function edit(PemeriksaanAnak $pemeriksaan)
    {
        $anak = $pemeriksaan->anak;
        return view('kader.pemeriksaan.edit', compact('pemeriksaan', 'anak'));
    }

    public function update(Request $request, PemeriksaanAnak $pemeriksaan)
    {
        $request->validate([
            'tanggal_periksa' => 'required|date',
            'berat_badan' => 'required|numeric|min:1|max:30',
            'tinggi_badan' => 'required|numeric|min:30|max:120',
            'lingkar_kepala' => 'nullable|numeric|min:30|max:60',
        ]);

        // Hitung Ulang Usia & Status
        $anak = $pemeriksaan->anak;
        $tanggalLahir = Carbon::parse($anak->tanggal_lahir);
        $tanggalPeriksa = Carbon::parse($request->tanggal_periksa);
        $usiaBulan = $tanggalLahir->diffInMonths($tanggalPeriksa);

        $tb = $request->tinggi_badan;
        $statusGizi = 'Normal';

        if ($usiaBulan >= 0 && $usiaBulan <= 6) {
            if ($tb < 55) $statusGizi = 'Stunting';
        } elseif ($usiaBulan > 6 && $usiaBulan <= 12) {
            if ($tb < 65) $statusGizi = 'Stunting';
        } elseif ($usiaBulan > 12 && $usiaBulan <= 24) {
            if ($tb < 75) $statusGizi = 'Stunting';
        } elseif ($usiaBulan > 24 && $usiaBulan <= 36) {
            if ($tb < 85) $statusGizi = 'Stunting';
        } elseif ($usiaBulan > 36 && $usiaBulan <= 60) {
            if ($tb < 95) $statusGizi = 'Stunting';
        } else {
            $statusGizi = 'Di Luar Rentang Balita';
        }

        $pemeriksaan->update([
            'tanggal_periksa' => $request->tanggal_periksa,
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'lingkar_kepala' => $request->lingkar_kepala,
            'status_gizi' => $statusGizi,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('kader.anak.show', $anak->id)->with('success', 'Data pemeriksaan berhasil diperbarui.');
    }

    public function destroy(PemeriksaanAnak $pemeriksaan)
    {
        $pemeriksaan->delete();
        return redirect()->back()->with('success', 'Data pemeriksaan berhasil dihapus.');
    }
}
