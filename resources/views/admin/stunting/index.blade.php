<x-app-layout>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="font-bold text-2xl text-slate-800">Monitoring Stunting</h2>
            <p class="text-slate-500">Daftar anak dengan status gizi Stunting di seluruh desa.</p>
        </div>
        <button onclick="window.print()" class="bg-slate-800 hover:bg-slate-900 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition-colors">
            Cetak Laporan
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 text-sm font-medium">
                <tr>
                    <th class="p-4">Nama Anak</th>
                    <th class="p-4">Usia</th>
                    <th class="p-4">Desa / Posyandu</th>
                    <th class="p-4">Orang Tua</th>
                    <th class="p-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($anakStuntings as $anak)
                    <tr class="hover:bg-slate-50">
                        <td class="p-4 font-medium text-slate-800">{{ $anak->nama }}</td>
                        <td class="p-4 text-slate-600">{{ \Carbon\Carbon::parse($anak->tanggal_lahir)->diffForHumans(null, true) }}</td>
                        <td class="p-4 text-slate-600">
                            {{ $anak->posyandu->desa->nama ?? '-' }} <br>
                            <span class="text-sm text-slate-400">{{ $anak->posyandu->nama ?? '-' }}</span>
                        </td>
                        <td class="p-4 text-slate-600">{{ $anak->orangtua->name ?? '-' }}</td>
                        <td class="p-4"><span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">STUNTING</span></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-slate-500">Tidak ada data stunting ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>