<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\User;

class VerifikasiController extends Controller
{
    public function index()
    {
        // Ambil akun pending yang posyandunya sama dengan kader yang login
        $posyanduId = request()->user()->posyandu_id;
        $pendingUsers = User::where('status', 'pending')
            ->where('posyandu_id', $posyanduId)
            ->get();

        return view('kader.verifikasi.index', compact('pendingUsers'));
    }

    public function verify(User $user)
    {
        // Pastikan kader hanya bisa memverifikasi user di posyandunya
        if ($user->posyandu_id !== request()->user()->posyandu_id) {
            abort(403);
        }

        $user->update(['status' => 'aktif']);
        return redirect()->back()->with('success', 'Akun ' . $user->name . ' berhasil diverifikasi.');
    }
}
