<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\PemeriksaanAnak;
use App\Models\Posyandu;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    // Tampilan halaman pusat laporan
    public function index()
    {
        $totalAnak = Anak::count();
        $totalStunting = PemeriksaanAnak::where('status_gizi', 'Stunting')->distinct('anak_id')->count('anak_id');
        $totalPosyandu = Posyandu::count();

        return view('admin.laporan.index', compact('totalAnak', 'totalStunting', 'totalPosyandu'));
    }

    // Fungsi untuk mengunduh PDF Laporan Stunting
    public function exportStuntingPdf()
    {
        $anakStuntings = Anak::whereHas('pemeriksaans', function ($q) {
            $q->where('status_gizi', 'Stunting');
        })->with(['posyandu.desa', 'orangtua'])->get();

        // Muat view khusus PDF dan kirimkan datanya
        $pdf = Pdf::loadView('admin.laporan.pdf_stunting', compact('anakStuntings'));

        // Atur ukuran kertas (A4)
        $pdf->setPaper('a4', 'portrait');

        // Download file dengan nama tertentu
        return $pdf->download('Laporan-Stunting-Kecamatan-' . date('Y-m-d') . '.pdf');
    }

    public function exportIbuHamilPdf()
    {
        // Ambil semua data ibu hamil beserta relasinya
        $ibuHamils = \App\Models\IbuHamil::with(['posyandu.desa'])->get();

        $pdf = Pdf::loadView('admin.laporan.pdf_ibu_hamil', compact('ibuHamils'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download('Laporan-Ibu-Hamil-' . date('Y-m-d') . '.pdf');
    }
}
