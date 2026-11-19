<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrangtuaController extends Controller
{
    public function downloadKmsPdf(Anak $anak)
    {
        // Pastikan yang mengunduh adalah orang tuanya sendiri
        if ($anak->orangtua_id !== request()->user()->id) {
            abort(403, 'Anda tidak berhak mengunduh data ini.');
        }

        // Urutkan pemeriksaan dari yang terlama (untuk KMS)
        $pemeriksaans = $anak->pemeriksaans()->orderBy('tanggal_periksa', 'asc')->get();

        // Ambil data imunisasi anak (TAMBAHAN BARU)
        $imunisasis = $anak->imunisasis()->orderBy('tanggal_imunisasi', 'asc')->get();

        // Muat view PDF dan kirimkan data anak, pemeriksaan, DAN imunisasi
        $pdf = Pdf::loadView('orangtua.kms_pdf', compact('anak', 'pemeriksaans', 'imunisasis'));

        // Atur ukuran kertas (A4)
        $pdf->setPaper('a4', 'portrait');

        // Download file PDF
        return $pdf->download('KMS_' . $anak->nama . '.pdf');
    }
}
