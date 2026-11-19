<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalPosyandu;
use App\Models\Posyandu;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        // Ambil semua jadwal urut dari yang terdekat
        $jadwals = JadwalPosyandu::with('posyandu.desa')->orderBy('tanggal', 'asc')->get();
        return view('admin.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $posyandus = Posyandu::with('desa')->get();
        return view('admin.jadwal.create', compact('posyandus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'posyandu_id' => 'required|exists:posyandus,id',
            'tanggal' => 'required|date',
            'kegiatan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        JadwalPosyandu::create([
            'posyandu_id' => $request->posyandu_id,
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan,
            'keterangan' => $request->keterangan,
        ]);

        

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal Posyandu berhasil ditambahkan.');
    }

    public function edit(JadwalPosyandu $jadwal)
    {
        $posyandus = Posyandu::with('desa')->get();
        return view('admin.jadwal.edit', compact('jadwal', 'posyandus'));
    }

    public function update(Request $request, JadwalPosyandu $jadwal)
    {
        $request->validate([
            'posyandu_id' => 'required|exists:posyandus,id',
            'tanggal' => 'required|date',
            'kegiatan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $jadwal->update([
            'posyandu_id' => $request->posyandu_id,
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(JadwalPosyandu $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
