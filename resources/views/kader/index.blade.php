<x-app-layout>
    <div class="mb-6">
        <h2 class="font-bold text-2xl text-slate-800">Dashboard Kader</h2>
        <p class="text-slate-500">Selamat datang, <span class="font-semibold text-primary-600">{{ Auth::user()->name }}</span>. Berikut ringkasan tugas Anda di Posyandu.</p>
    </div>

    <!-- Kartu Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 border-l-4 border-l-primary-500">
            <h3 class="text-slate-500 text-sm font-medium">Total Anak di Posyandu Anda</h3>
            <p class="text-4xl font-bold text-slate-800 mt-2">{{ $totalAnak }} <span class="text-lg font-normal text-slate-500">Anak</span></p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 border-l-4 border-l-red-500">
            <h3 class="text-slate-500 text-sm font-medium">Belum Ditimbang Bulan Ini</h3>
            <p class="text-4xl font-bold text-red-600 mt-2">{{ $anakBelumDitimbang->count() }} <span class="text-lg font-normal text-slate-500">Anak</span></p>
        </div>
    </div>

    <!-- Tabel Tugas -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
            <div>
                <h3 class="font-bold text-lg text-slate-800">Daftar Tunggu Penimbangan</h3>
                <p class="text-sm text-slate-500">Anak-anak yang belum diperiksa bulan ini.</p>
            </div>
            <a href="{{ route('kader.anak.index') }}" class="text-primary-600 hover:text-primary-800 font-semibold text-sm">
                Lihat Semua Anak &rarr;
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-white border-b border-slate-200 text-slate-500 text-sm font-medium">
                    <tr>
                        <th class="p-4">Nama Anak</th>
                        <th class="p-4">Usia</th>
                        <th class="p-4">Orang Tua</th>
                        <th class="p-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($anakBelumDitimbang as $anak)
                        <tr class="hover:bg-slate-50">
                            <td class="p-4 font-medium text-slate-800">{{ $anak->nama }}</td>
                            <td class="p-4 text-slate-600">
                                {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->diffForHumans(null, true) }}
                            </td>
                            <td class="p-4 text-slate-600">{{ $anak->orangtua->name ?? '-' }}</td>
                            <td class="p-4">
                                <a href="{{ route('kader.pemeriksaan.create', $anak->id) }}" class="bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold py-1.5 px-4 rounded-lg shadow-sm transition-colors">
                                    Timbang Sekarang
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-slate-500">
                                Hebat! Semua anak di Posyandu Anda sudah ditimbang bulan ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>