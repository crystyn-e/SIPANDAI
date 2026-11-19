<x-app-layout>
    <div class="mb-6">
        <h2 class="font-bold text-2xl text-slate-800">Daftar Kasus & Rujukan</h2>
        <p class="text-slate-500">Pantauan kasus medis di desa binaan Anda.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Anak Stunting -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="p-6 border-b border-slate-200 bg-red-50">
            <h3 class="font-bold text-lg text-red-800">Anak Terdeteksi Stunting</h3>
            <p class="text-sm text-red-600">Anak-anak ini membutuhkan intervensi gizi dan pemantauan lanjutan.</p>
        </div>
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 text-slate-500 text-sm">
                <tr>
                    <th class="p-4">Nama Anak</th>
                    <th class="p-4">Usia</th>
                    <th class="p-4">Posyandu</th>
                    <th class="p-4">Orang Tua</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($anakStunting as $anak)
                    <tr>
                        <td class="p-4 font-medium text-slate-800">{{ $anak->nama }}</td>
                        <td class="p-4 text-slate-600">{{ \Carbon\Carbon::parse($anak->tanggal_lahir)->diffForHumans(null, true) }}</td>
                        <td class="p-4 text-slate-600">{{ $anak->posyandu->nama ?? '-' }}</td>
                        <td class="p-4 text-slate-600">{{ $anak->orangtua->name ?? '-' }}</td>
                        <td class="p-4">
                            <div class="flex gap-2">
                                <a href="{{ route('bidan.anak.show', $anak->id) }}" class="bg-slate-100 text-slate-700 hover:bg-slate-200 px-3 py-1 rounded-lg text-sm font-semibold transition-colors">Detail</a>
                                <a href="{{ route('bidan.kasus.catatan-anak', $anak->id) }}" class="bg-primary-100 text-primary-700 hover:bg-primary-200 px-3 py-1 rounded-lg text-sm font-semibold transition-colors">Beri Catatan</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-8 text-center text-slate-500">Tidak ada kasus stunting di desa ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tabel Ibu Hamil Risiko Tinggi -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-200 bg-orange-50">
            <h3 class="font-bold text-lg text-orange-800">Ibu Hamil Risiko Tinggi</h3>
            <p class="text-sm text-orange-600">Ibu hamil dengan KEK (LILA < 23.5) atau umur berisiko.</p>
        </div>
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 text-slate-500 text-sm">
                <tr>
                    <th class="p-4">Nama Ibu</th>
                    <th class="p-4">Umur</th>
                    <th class="p-4">Status Risiko</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($ibuHamilRisiko as $ibu)
                    <tr>
                        <td class="p-4 font-medium text-slate-800">{{ $ibu->nama }}</td>
                        <td class="p-4 text-slate-600">{{ $ibu->umur }} Tahun</td>
                        <td class="p-4">
                            <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-bold">{{ $ibu->status_risiko }}</span>
                        </td>
                        <td class="p-4">
                            <div class="flex gap-2">
                                <!-- TOMBOL DETAIL IBU HAMIL BARU -->
                                <a href="{{ route('bidan.ibu.show', $ibu->id) }}" class="bg-slate-100 text-slate-700 hover:bg-slate-200 px-3 py-1 rounded-lg text-sm font-semibold transition-colors">Detail</a>
                                <a href="{{ route('bidan.kasus.catatan-ibu', $ibu->id) }}" class="bg-primary-100 text-primary-700 hover:bg-primary-200 px-3 py-1 rounded-lg text-sm font-semibold transition-colors">Beri Catatan</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="p-8 text-center text-slate-500">Tidak ada ibu hamil risiko tinggi di desa ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>