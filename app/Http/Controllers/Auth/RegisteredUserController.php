<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Desa;
use App\Models\Posyandu;
use App\Notifications\PendaftaranBaruNotification; // <-- TAMBAHKAN INI
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        $desas = Desa::all();
        $posyandus = Posyandu::all();
        return view('auth.register', compact('desas', 'posyandus'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'no_hp' => ['required', 'string', 'max:15'],
            'desa_id' => ['required', 'exists:desas,id'],
            'posyandu_id' => ['required', 'exists:posyandus,id'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'desa_id' => $request->desa_id,
            'posyandu_id' => $request->posyandu_id,
            'password' => Hash::make($request->password),
            'status' => 'pending',
        ]);

        $user->assignRole('orangtua');

        // KIRIM NOTIFIKASI KE KADER DI POSYANDU TERSEBUT
        $kaders = User::role('kader')->where('posyandu_id', $request->posyandu_id)->get();
        foreach ($kaders as $kader) {
            $kader->notify(new PendaftaranBaruNotification($user->name)); // <-- SUDAH DIPERBAIKI
        }

        event(new Registered($user));

        return redirect()->route('login')->with('status', 'Pendaftaran berhasil! Akun Anda sedang menunggu verifikasi dari Kader Posyandu desa Anda.');
    }
}
