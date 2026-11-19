<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnakController extends Controller
{
    public function index()
    {
        $posyanduId = Auth::user()->posyandu_id;
        $anaks = Anak::with('orangtua')->where('posyandu_id', $posyanduId)->get();
        return view('kader.anak.index', compact('anaks'));
    }

    public function create()
    {
        $posyanduId = Auth::user()->posyandu_id;
        $orangtuas = User::role('orangtua')->where('posyandu_id', $posyanduId)->get();
        return view('kader.anak.create', compact('orangtuas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'orangtua_id' => 'required|exists:users,id',
            'nik' => 'required|string|max:16|unique:anaks',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $kader = Auth::user();

        Anak::create([
            'posyandu_id' => $kader->posyandu_id,
            'desa_id' => $kader->posyandu->desa_id,
            'orangtua_id' => $request->orangtua_id,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->route('kader.anak.index')->with('success', 'Data anak berhasil ditambahkan.');
    }

    // --- FITUR DETAIL (RIWAYAT PEMERIKSAAN & IMUNISASI) ---
    public function show(Anak $anak)
    {
        if ($anak->posyandu_id !== request()->user()->posyandu_id) {
            abort(403);
        }

        $pemeriksaans = $anak->pemeriksaans()->orderBy('tanggal_periksa', 'desc')->get();
        $imunisasis = $anak->imunisasis()->orderBy('tanggal_imunisasi', 'desc')->get();

        return view('kader.anak.show', compact('anak', 'pemeriksaans', 'imunisasis'));
    }

    // --- FITUR EDIT & HAPUS ---
    public function edit(Anak $anak)
    {
        if ($anak->posyandu_id !== request()->user()->posyandu_id) {
            abort(403);
        }

        $orangtuas = User::role('orangtua')->where('posyandu_id', request()->user()->posyandu_id)->get();

        return view('kader.anak.edit', compact('anak', 'orangtuas'));
    }

    public function update(Request $request, Anak $anak)
    {
        if ($anak->posyandu_id !== request()->user()->posyandu_id) {
            abort(403);
        }

        $request->validate([
            'orangtua_id' => 'required|exists:users,id',
            'nik' => 'required|string|max:16|unique:anaks,nik,' . $anak->id,
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $anak->update($request->all());

        return redirect()->route('kader.anak.index')->with('success', 'Data anak berhasil diperbarui.');
    }

    public function destroy(Anak $anak)
    {
        if ($anak->posyandu_id !== request()->user()->posyandu_id) {
            abort(403);
        }

        $anak->delete();
        return redirect()->route('kader.anak.index')->with('success', 'Data anak berhasil dihapus.');
    }
}
