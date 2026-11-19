<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\IbuHamil;
use Illuminate\Http\Request;

class DataWargaController extends Controller
{
    // 1. Menampilkan halaman Pusat Data Warga
    public function index()
    {
        $anak = Anak::with(['posyandu.desa', 'orangtua'])->latest()->get();
        $ibuHamil = IbuHamil::with(['posyandu.desa'])->latest()->get();

        return view('admin.data-warga.index', compact('anak', 'ibuHamil'));
    }

    // --- ANAK ---
    public function editAnak(Anak $anak)
    {
        return view('admin.data-warga.edit_anak', compact('anak'));
    }

    public function updateAnak(Request $request, Anak $anak)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:anaks,nik,' . $anak->id,
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $anak->update($request->all());

        return redirect()->route('admin.data-warga')->with('success', 'Data anak berhasil diperbarui.');
    }

    public function destroyAnak(Anak $anak)
    {
        $anak->delete();
        return redirect()->back()->with('success', 'Data anak berhasil dihapus.');
    }

    // --- IBU HAMIL ---
    public function editIbuHamil(IbuHamil $ibuHamil)
    {
        return view('admin.data-warga.edit_ibu', compact('ibuHamil'));
    }

    public function updateIbuHamil(Request $request, IbuHamil $ibuHamil)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:ibu_hamils,nik,' . $ibuHamil->id,
            'umur' => 'required|integer',
            'status_risiko' => 'required|string',
        ]);

        $ibuHamil->update($request->all());

        return redirect()->route('admin.data-warga')->with('success', 'Data ibu hamil berhasil diperbarui.');
    }

    public function destroyIbuHamil(IbuHamil $ibuHamil)
    {
        $ibuHamil->delete();
        return redirect()->back()->with('success', 'Data ibu hamil berhasil dihapus.');
    }
}
