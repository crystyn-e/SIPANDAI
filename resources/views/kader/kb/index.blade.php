<x-app-layout>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="font-bold text-2xl text-slate-800">Data Peserta KB</h2>
            <p class="text-slate-500">Daftar peserta Keluarga Berencana di Posyandu Anda.</p>
        </div>
        <a href="{{ route('kader.kb.create') }}" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition-colors">
            + Tambah Peserta KB
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
                    <th class="p-4">Nama Peserta</th>
                    <th class="p-4">Umur</th>
                    <th class="p-4">Kontrasepsi</th>
                    <th class="p-4">Tanggal Mulai</th>
                    <th class="p-4">Jadwal Ulang</th>
                    <th class="p-4">Aksi</th> <!-- TAMBAHAN KOLOM AKSI -->
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($kbs as $kb)
                    <tr class="hover:bg-slate-50">
                        <td class="p-4 font-medium text-slate-800">{{ $kb->nama_peserta }}</td>
                        <td class="p-4 text-slate-600">{{ $kb->umur }} Thn</td>
                        <td class="p-4">
                            <span class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-xs font-bold">{{ $kb->jenis_kontrasepsi }}</span>
                        </td>
                        <td class="p-4 text-slate-600">{{ \Carbon\Carbon::parse($kb->tanggal_mulai)->format('d/m/Y') }}</td>
                        <td class="p-4 text-slate-600">
                            @if($kb->jadwal_ulang)
                                {{ \Carbon\Carbon::parse($kb->jadwal_ulang)->format('d/m/Y') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="p-4"> <!-- TAMBAHAN KOLOM AKSI -->
                            <div class="flex gap-3">
                                <a href="{{ route('kader.kb.edit', $kb->id) }}" class="text-primary-600 hover:text-primary-800 font-medium text-sm">Edit</a>
                                
                                <form action="{{ route('kader.kb.destroy', $kb->id) }}" method="POST" onsubmit="return confirm('Hapus data KB ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-8 text-center text-slate-500">Belum ada data peserta KB.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>