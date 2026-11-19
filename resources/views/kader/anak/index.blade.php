<x-app-layout>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="font-bold text-2xl text-slate-800">Data Anak Posyandu</h2>
            <p class="text-slate-500">Daftar anak yang terdaftar di Posyandu Anda.</p>
        </div>
        <a href="{{ route('kader.anak.create') }}" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition-colors">
            + Tambah Anak
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
                    <th class="p-4">Nama Anak</th>
                    <th class="p-4">NIK</th>
                    <th class="p-4">Tgl Lahir / Usia</th>
                    <th class="p-4">L/P</th>
                    <th class="p-4">Orang Tua</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($anaks as $anak)
                    <tr class="hover:bg-slate-50">
                        <td class="p-4 font-medium text-slate-800">{{ $anak->nama }}</td>
                        <td class="p-4 text-slate-600">{{ $anak->nik }}</td>
                        <td class="p-4 text-slate-600">
                            {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d/m/Y') }} <br>
                            <span class="text-xs text-primary-600 font-bold">{{ \Carbon\Carbon::parse($anak->tanggal_lahir)->diffForHumans(null, true) }}</span>
                        </td>
                        <td class="p-4 text-slate-600">{{ $anak->jenis_kelamin }}</td>
                        <td class="p-4 text-slate-600">{{ $anak->orangtua->name ?? '-' }}</td>
                        
                        <!-- KOLOM AKSI LENGKAP -->
                        <td class="p-4">
                            <div class="flex flex-wrap gap-2">
                                <!-- TOMBOL DETAIL (BARU) -->
                                <a href="{{ route('kader.anak.show', $anak->id) }}" class="bg-slate-100 text-slate-700 hover:bg-slate-200 px-3 py-1 rounded-lg text-xs font-semibold transition-colors">
                                    Detail
                                </a>

                                <a href="{{ route('kader.pemeriksaan.create', $anak->id) }}" class="bg-primary-100 text-primary-700 hover:bg-primary-200 px-3 py-1 rounded-lg text-xs font-semibold transition-colors">
                                    Periksa
                                </a>
                                
                                <a href="{{ route('kader.imunisasi.create', $anak->id) }}" class="bg-blue-100 text-blue-700 hover:bg-blue-200 px-3 py-1 rounded-lg text-xs font-semibold transition-colors">
                                    Imunisasi
                                </a>

                                <a href="{{ route('kader.anak.edit', $anak->id) }}" class="bg-amber-100 text-amber-700 hover:bg-amber-200 px-3 py-1 rounded-lg text-xs font-semibold transition-colors">
                                    Edit
                                </a>

                                <form action="{{ route('kader.anak.destroy', $anak->id) }}" method="POST" onsubmit="return confirm('Hapus data anak ini? Semua riwayat pemeriksaan juga akan terhapus.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-100 text-red-700 hover:bg-red-200 px-3 py-1 rounded-lg text-xs font-semibold transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-500">
                            Belum ada data anak. Silakan tambah data.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>