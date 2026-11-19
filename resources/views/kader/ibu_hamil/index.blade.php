<x-app-layout>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="font-bold text-2xl text-slate-800">Data Ibu Hamil</h2>
            <p class="text-slate-500">Daftar ibu hamil di Posyandu Anda.</p>
        </div>
        <a href="{{ route('kader.ibu_hamil.create') }}" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition-colors">
            + Tambah Ibu Hamil
        </a>
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
                    <th class="p-4">Nama Ibu</th>
                    <th class="p-4">Umur</th>
                    <th class="p-4">HPL (Perkiraan Lahir)</th>
                    <th class="p-4">Status Risiko</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($ibuHamils as $ibu)
                    <tr class="hover:bg-slate-50">
                        <td class="p-4 font-medium text-slate-800">{{ $ibu->nama }}</td>
                        <td class="p-4 text-slate-600">{{ $ibu->umur }} Tahun</td>
                        <td class="p-4 text-slate-600">{{ $ibu->hpl ? \Carbon\Carbon::parse($ibu->hpl)->format('d/m/Y') : '-' }}</td>
                        <td class="p-4">
                            @if($ibu->status_risiko === 'Normal')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">NORMAL</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">{{ $ibu->status_risiko }}</span>
                            @endif
                        </td>
                        <td class="p-4">
                            <div class="flex gap-3">
                                <a href="{{ route('kader.ibu_hamil.edit', $ibu->id) }}" class="text-primary-600 hover:text-primary-800 font-medium text-sm">Edit</a>
                                
                                <form action="{{ route('kader.ibu_hamil.destroy', $ibu->id) }}" method="POST" onsubmit="return confirm('Hapus data ibu hamil ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-slate-500">Belum ada data ibu hamil.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>