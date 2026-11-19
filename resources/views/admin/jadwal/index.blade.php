<x-app-layout>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="font-bold text-2xl text-slate-800">Jadwal Posyandu</h2>
            <p class="text-slate-500">Kelola jadwal kegiatan untuk seluruh Posyandu di kecamatan.</p>
        </div>
        <a href="{{ route('admin.jadwal.create') }}" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition-colors">
            + Tambah Jadwal
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
                    <th class="p-4">Tanggal</th>
                    <th class="p-4">Posyandu / Desa</th>
                    <th class="p-4">Kegiatan</th>
                    <th class="p-4">Keterangan</th>
                    <th class="p-4">Aksi</th> <!-- Header Aksi -->
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($jadwals as $jadwal)
                    <tr class="hover:bg-slate-50">
                        <td class="p-4 font-medium text-slate-800">
                            {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d F Y') }}
                        </td>
                        <td class="p-4 text-slate-600">
                            {{ $jadwal->posyandu->nama }} <br>
                            <span class="text-xs text-slate-400">{{ $jadwal->posyandu->desa->nama }}</span>
                        </td>
                        <td class="p-4 text-slate-600">{{ $jadwal->kegiatan }}</td>
                        <td class="p-4 text-slate-600">{{ $jadwal->keterangan ?? '-' }}</td>
                        <td class="p-4"> <!-- Kolom Aksi -->
                            <div class="flex gap-3">
                                <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}" class="text-primary-600 hover:text-primary-800 font-medium text-sm">Edit</a>
                                
                                <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-slate-500">Belum ada jadwal Posyandu.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>