<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\Imunisasi;
use Illuminate\Http\Request;

class ImunisasiController extends Controller
{
    public function create(Anak $anak)
    {
        $imunisasis = $anak->imunisasis()->orderBy('tanggal_imunisasi', 'desc')->get();
        return view('kader.imunisasi.create', compact('anak', 'imunisasis'));
    }

    public function store(Request $request, Anak $anak)
    {
        $request->validate([
            'jenis_imunisasi' => 'required|string',
            'tanggal_imunisasi' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $anak->imunisasis()->create([
            'jenis_imunisasi' => $request->jenis_imunisasi,
            'tanggal_imunisasi' => $request->tanggal_imunisasi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('kader.imunisasi.create', $anak->id)->with('success', 'Data imunisasi berhasil disimpan.');
    }
}
