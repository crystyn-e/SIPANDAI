<x-app-layout>
    <div class="mb-6">
        <h2 class="font-bold text-2xl text-slate-800">Verifikasi Akun Orang Tua</h2>
        <p class="text-slate-500">Daftar warga yang mendaftar mandiri dan menunggu verifikasi Anda.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 text-sm font-medium">
                <tr>
                    <th class="p-4">Nama</th>
                    <th class="p-4">Email / No. HP</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($pendingUsers as $user)
                    <tr class="hover:bg-slate-50">
                        <td class="p-4 font-medium text-slate-800">{{ $user->name }}</td>
                        <td class="p-4 text-slate-600">
                            {{ $user->email }} <br>
                            <span class="text-sm text-slate-400">{{ $user->no_hp ?? '-' }}</span>
                        </td>
                        <td class="p-4">
                            <form action="{{ route('kader.verifikasi.verify', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold py-1.5 px-4 rounded-lg transition-colors">
                                    Verifikasi Sekarang
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-8 text-center text-slate-500">
                            Tidak ada akun yang menunggu verifikasi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>