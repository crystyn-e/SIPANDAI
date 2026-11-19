<x-app-layout>
    <!-- HEADER DENGAN TOMBOL EDIT & HAPUS ANAK -->
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="font-bold text-2xl text-slate-800">Detail Anak: {{ $anak->nama }}</h2>
            <p class="text-slate-500">NIK: {{ $anak->nik }} | Usia: {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->diffForHumans(null, true) }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('kader.anak.edit', $anak->id) }}" class="bg-amber-100 text-amber-700 hover:bg-amber-200 px-4 py-2 rounded-lg font-semibold text-sm transition-colors">
                Edit Data Anak
            </a>
            <form action="{{ route('kader.anak.destroy', $anak->id) }}" method="POST" onsubmit="return confirm('Hapus data anak ini? Semua riwayat pemeriksaan juga akan terhapus.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-100 text-red-700 hover:bg-red-200 px-4 py-2 rounded-lg font-semibold text-sm transition-colors">
                    Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- RIWAYAT PENIMBANGAN -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h3 class="font-bold text-lg text-slate-800 mb-4">Riwayat Penimbangan</h3>
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-slate-500 text-sm">
                    <tr>
                        <th class="p-3 border-b">Tanggal</th>
                        <th class="p-3 border-b">BB (kg)</th>
                        <th class="p-3 border-b">TB (cm)</th>
                        <th class="p-3 border-b">Status</th>
                        <th class="p-3 border-b text-center">Aksi</th> 
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pemeriksaans as $periksa)
                        <tr>
                            <td class="p-3 text-slate-800">{{ \Carbon\Carbon::parse($periksa->tanggal_periksa)->format('d/m/Y') }}</td>
                            <td class="p-3 text-slate-600">{{ $periksa->berat_badan }}</td>
                            <td class="p-3 text-slate-600">{{ $periksa->tinggi_badan }}</td>
                            <td class="p-3">
                                @if($periksa->status_gizi === 'Normal')
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold">NORMAL</span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-bold">{{ strtoupper($periksa->status_gizi) }}</span>
                                @endif
                            </td>
                            <td class="p-3 text-center">
                                <div class="flex gap-2 justify-center">
                                    <a href="{{ route('kader.pemeriksaan.edit', $periksa->id) }}" class="text-amber-600 hover:text-amber-800 text-xs font-bold">Edit</a>
                                    <form action="{{ route('kader.pemeriksaan.destroy', $periksa->id) }}" method="POST" onsubmit="return confirm('Hapus data pemeriksaan ini?');">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-bold">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="p-6 text-center text-slate-500">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- RIWAYAT IMUNISASI -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h3 class="font-bold text-lg text-slate-800 mb-4">Riwayat Imunisasi</h3>
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-slate-500 text-sm">
                    <tr>
                        <th class="p-3 border-b">Tanggal</th>
                        <th class="p-3 border-b">Vaksin</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($imunisasis as $imunisasi)
                        <tr>
                            <td class="p-3 text-slate-800">{{ \Carbon\Carbon::parse($imunisasi->tanggal_imunisasi)->format('d/m/Y') }}</td>
                            <td class="p-3 text-slate-600">{{ $imunisasi->jenis_imunisasi }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="p-6 text-center text-slate-500">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>