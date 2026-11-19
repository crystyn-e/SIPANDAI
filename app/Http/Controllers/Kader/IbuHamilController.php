<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\IbuHamil;
use Illuminate\Http\Request;
use Carbon\Carbon;

class IbuHamilController extends Controller
{
    public function index()
    {
        // Ganti auth()->user() menjadi request()->user()
        $posyanduId = request()->user()->posyandu_id;
        $ibuHamils = IbuHamil::where('posyandu_id', $posyanduId)->get();

        return view('kader.ibu_hamil.index', compact('ibuHamils'));
    }

    public function create()
    {
        return view('kader.ibu_hamil.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|max:16|unique:ibu_hamils',
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer',
            'hpht' => 'nullable|date',
            'tinggi_badan' => 'nullable|numeric',
            'lingkar_lengan_atas' => 'nullable|numeric',
        ]);

        // Ganti auth()->user() menjadi request()->user()
        $kader = request()->user();

        // Hitung HPL (HPHT + 280 hari)
        $hpl = null;
        if ($request->hpht) {
            $hpl = Carbon::parse($request->hpht)->addDays(280)->format('Y-m-d');
        }

        // Logika Sederhana Deteksi Risiko (Misal: LILA < 23.5 cm = Risiko KEK)
        $statusRisiko = 'Normal';
        if ($request->lingkar_lengan_atas && $request->lingkar_lengan_atas < 23.5) {
            $statusRisiko = 'Risiko Tinggi (KEK)';
        } elseif ($request->umur < 20 || $request->umur > 35) {
            $statusRisiko = 'Risiko Tinggi (Umur)';
        }

        IbuHamil::create([
            'posyandu_id' => $kader->posyandu_id,
            'desa_id' => $kader->posyandu->desa_id,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'umur' => $request->umur,
            'nama_suami' => $request->nama_suami,
            'no_hp' => $request->no_hp,
            'hpht' => $request->hpht,
            'hpl' => $hpl,
            'gravida' => $request->gravida ?? 0,
            'para' => $request->para ?? 0,
            'abortus' => $request->abortus ?? 0,
            'tinggi_badan' => $request->tinggi_badan,
            'lingkar_lengan_atas' => $request->lingkar_lengan_atas,
            'status_risiko' => $statusRisiko,
        ]);

        return redirect()->route('kader.ibu_hamil.index')->with('success', 'Data Ibu Hamil berhasil ditambahkan.');
    }

    public function edit(IbuHamil $ibuHamil)
    {
        // Pastikan kader hanya bisa edit data di posyandunya sendiri
        if ($ibuHamil->posyandu_id !== request()->user()->posyandu_id) {
            abort(403);
        }
        return view('kader.ibu_hamil.edit', compact('ibuHamil'));
    }

    public function update(Request $request, IbuHamil $ibuHamil)
    {
        if ($ibuHamil->posyandu_id !== request()->user()->posyandu_id) {
            abort(403);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:ibu_hamils,nik,' . $ibuHamil->id,
            'umur' => 'required|integer',
            'hpht' => 'nullable|date',
            'tinggi_badan' => 'nullable|numeric',
            'lingkar_lengan_atas' => 'nullable|numeric',
        ]);

        $hpl = null;
        if ($request->hpht) {
            $hpl = Carbon::parse($request->hpht)->addDays(280)->format('Y-m-d');
        }

        $statusRisiko = 'Normal';
        if ($request->lingkar_lengan_atas && $request->lingkar_lengan_atas < 23.5) {
            $statusRisiko = 'Risiko Tinggi (KEK)';
        } elseif ($request->umur < 20 || $request->umur > 35) {
            $statusRisiko = 'Risiko Tinggi (Umur)';
        }

        $ibuHamil->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'umur' => $request->umur,
            'nama_suami' => $request->nama_suami,
            'no_hp' => $request->no_hp,
            'hpht' => $request->hpht,
            'hpl' => $hpl,
            'gravida' => $request->gravida ?? 0,
            'para' => $request->para ?? 0,
            'abortus' => $request->abortus ?? 0,
            'tinggi_badan' => $request->tinggi_badan,
            'lingkar_lengan_atas' => $request->lingkar_lengan_atas,
            'status_risiko' => $statusRisiko,
        ]);

        return redirect()->route('kader.ibu_hamil.index')->with('success', 'Data Ibu Hamil berhasil diperbarui.');
    }

    public function destroy(IbuHamil $ibuHamil)
    {
        if ($ibuHamil->posyandu_id !== request()->user()->posyandu_id) {
            abort(403);
        }

        $ibuHamil->delete();
        return redirect()->route('kader.ibu_hamil.index')->with('success', 'Data Ibu Hamil berhasil dihapus.');
    }
}
