<x-app-layout>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="font-bold text-2xl text-slate-800">
                Data Wilayah
            </h2>
            <p class="text-slate-500">Daftar Kecamatan, Desa, dan Posyandu terintegrasi.</p>
        </div>
        <!-- TOMBOL SUDAH DIUBAH MENJADI TAG <a> -->
        <a href="{{ route('admin.wilayah.create') }}" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition-colors">
            + Tambah Wilayah
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 text-sm font-medium">
                    <tr>
                        <th class="p-4">Kecamatan</th>
                        <th class="p-4">Desa</th>
                        <th class="p-4">Posyandu</th>
                        <th class="p-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($kecamatans as $kecamatan)
                        @foreach($kecamatan->desas as $desa)
                            @foreach($desa->posyandus as $posyandu)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="p-4 font-medium text-slate-800">{{ $kecamatan->nama }}</td>
                                    <td class="p-4 text-slate-600">{{ $desa->nama }}</td>
                                    <td class="p-4">
                                        <span class="bg-primary-100 text-primary-700 py-1 px-3 rounded-full text-sm font-semibold">
                                            {{ $posyandu->nama }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <div class="flex gap-3">
                                            <!-- TOMBOL EDIT SUDAH DIARAHKAN KE ROUTE -->
                                            <a href="{{ route('admin.wilayah.edit', $posyandu->id) }}" class="text-primary-600 hover:text-primary-800 font-medium text-sm">Edit</a>
                                            
                                            <!-- TOMBOL HAPUS -->
                                            <form action="{{ route('admin.wilayah.destroy', $posyandu->id) }}" method="POST" onsubmit="return confirm('Hapus data wilayah ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-slate-500">
                                Belum ada data wilayah. Silakan tambah data.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>