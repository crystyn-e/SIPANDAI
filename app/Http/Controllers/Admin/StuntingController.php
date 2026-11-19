<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PemeriksaanAnak;
use App\Models\Anak;
use Illuminate\Http\Request;

class StuntingController extends Controller
{
    public function index()
    {
        // Ambil semua anak yang pernah berstatus stunting di pemeriksaan terakhirnya
        $anakStuntings = Anak::whereHas('pemeriksaans', function ($q) {
            $q->where('status_gizi', 'Stunting');
        })->with(['posyandu.desa', 'orangtua'])->get();

        return view('admin.stunting.index', compact('anakStuntings'));
    }
}
