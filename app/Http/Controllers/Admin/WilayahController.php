<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Posyandu;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    // 1. Menampilkan halaman Data Wilayah (INI YANG HILANG)
    public function index()
    {
        $kecamatans = Kecamatan::with('desas.posyandus')->get();
        return view('admin.wilayah.index', compact('kecamatans'));
    }

    // 2. Menampilkan form tambah wilayah
    public function create()
    {
        $kecamatans = Kecamatan::all();
        return view('admin.wilayah.create', compact('kecamatans'));
    }

    // 3. Menyimpan data wilayah baru
    public function store(Request $request)
    {
        $request->validate([
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'nama_desa' => 'required|string|max:255',
            'nama_posyandu' => 'required|string|max:255',
        ]);

        // Buat Desa baru
        $desa = Desa::create([
            'kecamatan_id' => $request->kecamatan_id,
            'nama' => $request->nama_desa,
        ]);

        // Buat Posyandu baru di bawah Desa tersebut
        Posyandu::create([
            'desa_id' => $desa->id,
            'nama' => $request->nama_posyandu,
        ]);

        return redirect()->route('admin.wilayah')->with('success', 'Data Wilayah (Desa & Posyandu) berhasil ditambahkan.');
    }

    // 4. Menampilkan form edit
    public function edit(Posyandu $posyandu)
    {
        $kecamatans = Kecamatan::all();
        return view('admin.wilayah.edit', compact('posyandu', 'kecamatans'));
    }

    // 5. Menyimpan perubahan data
    public function update(Request $request, Posyandu $posyandu)
    {
        $request->validate([
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'nama_desa' => 'required|string|max:255',
            'nama_posyandu' => 'required|string|max:255',
        ]);

        // Update Desa
        $posyandu->desa->update([
            'kecamatan_id' => $request->kecamatan_id,
            'nama' => $request->nama_desa,
        ]);

        // Update Posyandu
        $posyandu->update([
            'nama' => $request->nama_posyandu,
        ]);

        return redirect()->route('admin.wilayah')->with('success', 'Data Wilayah berhasil diperbarui.');
    }

    // 6. Menghapus data
    public function destroy(Posyandu $posyandu)
    {
        $desa = $posyandu->desa;
        $posyandu->delete();

        // Hapus desa jika tidak ada posyandu lain di desa tersebut
        if ($desa && $desa->posyandus()->count() == 0) {
            $desa->delete();
        }

        return redirect()->route('admin.wilayah')->with('success', 'Data Wilayah berhasil dihapus.');
    }
}
