<x-app-layout>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="font-bold text-2xl text-slate-800">Manajemen Pengguna</h2>
            <p class="text-slate-500">Kelola akun Kader, Bidan, dan Orang Tua.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition-colors">
            + Tambah Pengguna
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 text-sm font-medium">
                <tr>
                    <th class="p-4">Nama</th>
                    <th class="p-4">Role</th>
                    <th class="p-4">Wilayah</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($users as $user)
                    <tr class="hover:bg-slate-50">
                        <td class="p-4">
                            <div class="font-medium text-slate-800">{{ $user->name }}</div>
                            <div class="text-sm text-slate-500">{{ $user->email }} | {{ $user->no_hp ?? '-' }}</div>
                        </td>
                        <td class="p-4">
                            <span class="bg-primary-100 text-primary-700 py-1 px-3 rounded-full text-sm font-semibold uppercase">
                                {{ $user->getRoleNames()->first() ?? 'User' }}
                            </span>
                        </td>
                        <td class="p-4 text-slate-600 text-sm">
                            @if($user->posyandu_id)
                                {{ $user->posyandu->nama }} <br> ({{ $user->posyandu->desa->nama }})
                            @elseif($user->desa_id)
                                {{ $user->desa->nama }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="p-4">
                            @if($user->status === 'pending')
                                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-bold uppercase">Pending</span>
                            @else
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-bold uppercase">Aktif</span>
                            @endif
                        </td>
                        <td class="p-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                @if($user->status === 'pending')
                                    <form action="{{ route('admin.users.verify', $user->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white text-xs font-bold py-1.5 px-3 rounded-lg transition-colors">
                                            Verifikasi
                                        </button>
                                    </form>
                                @endif

                                <!-- Tombol Edit -->
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-amber-100 text-amber-700 hover:bg-amber-200 py-1.5 px-3 rounded-lg text-xs font-bold transition-colors">
                                    Edit
                                </a>

                                <!-- Tombol Hapus (Kecuali diri sendiri) -->
                                @if(auth()->id() !== $user->id)
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-100 text-red-700 hover:bg-red-200 py-1.5 px-3 rounded-lg text-xs font-bold transition-colors">
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-slate-500">
                            Belum ada pengguna terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>