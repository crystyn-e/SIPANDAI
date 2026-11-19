<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\Kb;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KbController extends Controller
{
    public function index()
    {
        $posyanduId = request()->user()->posyandu_id;
        $kbs = Kb::where('posyandu_id', $posyanduId)->orderBy('tanggal_mulai', 'desc')->get();

        return view('kader.kb.index', compact('kbs'));
    }

    public function create()
    {
        return view('kader.kb.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_peserta' => 'required|string|max:255',
            'umur' => 'required|integer',
            'jenis_kontrasepsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
        ]);

        $kader = request()->user();
        $jadwalUlang = $this->hitungJadwalUlang($request->jenis_kontrasepsi, $request->tanggal_mulai);

        Kb::create([
            'posyandu_id' => $kader->posyandu_id,
            'desa_id' => $kader->posyandu->desa_id,
            'nama_peserta' => $request->nama_peserta,
            'umur' => $request->umur,
            'nama_suami' => $request->nama_suami,
            'jenis_kontrasepsi' => $request->jenis_kontrasepsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'jadwal_ulang' => $jadwalUlang,
        ]);

        return redirect()->route('kader.kb.index')->with('success', 'Data Peserta KB berhasil ditambahkan.');
    }

    // --- TAMBAHAN FITUR EDIT & HAPUS ---

    public function edit(Kb $kb)
    {
        // Pastikan kader hanya bisa edit data di posyandunya sendiri
        if ($kb->posyandu_id !== request()->user()->posyandu_id) {
            abort(403);
        }
        return view('kader.kb.edit', compact('kb'));
    }

    public function update(Request $request, Kb $kb)
    {
        if ($kb->posyandu_id !== request()->user()->posyandu_id) {
            abort(403);
        }

        $request->validate([
            'nama_peserta' => 'required|string|max:255',
            'umur' => 'required|integer',
            'jenis_kontrasepsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
        ]);

        $jadwalUlang = $this->hitungJadwalUlang($request->jenis_kontrasepsi, $request->tanggal_mulai);

        $kb->update([
            'nama_peserta' => $request->nama_peserta,
            'umur' => $request->umur,
            'nama_suami' => $request->nama_suami,
            'jenis_kontrasepsi' => $request->jenis_kontrasepsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'jadwal_ulang' => $jadwalUlang,
        ]);

        return redirect()->route('kader.kb.index')->with('success', 'Data Peserta KB berhasil diperbarui.');
    }

    public function destroy(Kb $kb)
    {
        if ($kb->posyandu_id !== request()->user()->posyandu_id) {
            abort(403);
        }

        $kb->delete();
        return redirect()->route('kader.kb.index')->with('success', 'Data Peserta KB berhasil dihapus.');
    }

    // Fungsi bantuan untuk menghitung jadwal ulang
    private function hitungJadwalUlang($jenisKontrasepsi, $tanggalMulai)
    {
        $tanggal = Carbon::parse($tanggalMulai);

        if ($jenisKontrasepsi == 'Suntik 1 Bulan') {
            return $tanggal->addMonth()->format('Y-m-d');
        } elseif ($jenisKontrasepsi == 'Suntik 3 Bulan') {
            return $tanggal->addMonths(3)->format('Y-m-d');
        } elseif ($jenisKontrasepsi == 'Pil') {
            return $tanggal->addMonth()->format('Y-m-d');
        }

        return null;
    }
}
