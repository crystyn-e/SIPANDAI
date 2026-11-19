<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Desa;
use App\Models\Posyandu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['roles', 'desa', 'posyandu'])->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::whereIn('name', ['kader', 'bidan', 'orangtua'])->get();
        $desas = Desa::all();
        $posyandus = Posyandu::all();
        return view('admin.users.create', compact('roles', 'desas', 'posyandus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|exists:roles,name',
            'no_hp' => 'nullable|string|max:15',
            'desa_id' => 'nullable|exists:desas,id',
            'posyandu_id' => 'nullable|exists:posyandus,id',
        ]);

        $desaId = $request->desa_id;
        $posyanduId = $request->posyandu_id;

        // Jika Kader, otomatis isi desa_id dari posyandu yang dipilih
        if ($request->role === 'kader' && $posyanduId) {
            $posyandu = Posyandu::find($posyanduId);
            $desaId = $posyandu->desa_id;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'desa_id' => $desaId,          // <-- Sekarang menyimpan desa_id untuk semua role
            'posyandu_id' => $posyanduId,  // <-- Sekarang menyimpan posyandu_id untuk semua role
            'status' => 'aktif',
        ]);

        $user->assignRole($request->role);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function verify(User $user)
    {
        $user->update(['status' => 'aktif']);
        return redirect()->back()->with('success', 'Akun ' . $user->name . ' berhasil diverifikasi dan diaktifkan.');
    }

    public function edit(User $user)
    {
        $roles = Role::whereIn('name', ['kader', 'bidan', 'orangtua', 'admin'])->get();
        $desas = Desa::all();
        $posyandus = Posyandu::all();
        return view('admin.users.edit', compact('user', 'roles', 'desas', 'posyandus'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|exists:roles,name',
            'no_hp' => 'nullable|string|max:15',
            'status' => 'required|in:aktif,pending',
            'desa_id' => 'nullable|exists:desas,id',
            'posyandu_id' => 'nullable|exists:posyandus,id',
        ]);

        $desaId = $request->desa_id;
        $posyanduId = $request->posyandu_id;

        if ($request->role === 'kader' && $posyanduId) {
            $posyandu = Posyandu::find($posyanduId);
            $desaId = $posyandu->desa_id;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'status' => $request->status,
            'desa_id' => $desaId,          // <-- Sekarang menyimpan desa_id untuk semua role
            'posyandu_id' => $posyanduId,  // <-- Sekarang menyimpan posyandu_id untuk semua role
        ]);

        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if (request()->user()->id === $user->id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus dari sistem.');
    }
}
