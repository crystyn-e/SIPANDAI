<x-app-layout>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="font-bold text-2xl text-slate-800">Detail Ibu Hamil: {{ $ibuHamil->nama }}</h2>
            <p class="text-slate-500">NIK: {{ $ibuHamil->nik }} | Umur: {{ $ibuHamil->umur }} Tahun</p>
        </div>
        <a href="{{ route('bidan.kasus.catatan-ibu', $ibuHamil->id) }}" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-semibold text-sm transition-colors">
            Beri Catatan Medis
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        <h3 class="font-bold text-lg text-slate-800 mb-4">Informasi Kehamilan</h3>
        <table class="w-full text-left border-collapse">
            <tbody class="divide-y divide-slate-100">
                <tr>
                    <td class="p-3 font-medium text-slate-600 w-1/3">Status Risiko</td>
                    <td class="p-3">
                        @if($ibuHamil->status_risiko === 'Normal')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">NORMAL</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">{{ $ibuHamil->status_risiko }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="p-3 font-medium text-slate-600">HPHT (Hari Pertama Haid Terakhir)</td>
                    <td class="p-3 text-slate-800">{{ $ibuHamil->hpht ? \Carbon\Carbon::parse($ibuHamil->hpht)->format('d F Y') : '-' }}</td>
                </tr>
                <tr>
                    <td class="p-3 font-medium text-slate-600">HPL (Hari Perkiraan Lahir)</td>
                    <td class="p-3 text-slate-800">{{ $ibuHamil->hpl ? \Carbon\Carbon::parse($ibuHamil->hpl)->format('d F Y') : '-' }}</td>
                </tr>
                <tr>
                    <td class="p-3 font-medium text-slate-600">Gravida / Para / Abortus</td>
                    <td class="p-3 text-slate-800">{{ $ibuHamil->gravida }} / {{ $ibuHamil->para }} / {{ $ibuHamil->abortus }}</td>
                </tr>
                <tr>
                    <td class="p-3 font-medium text-slate-600">LILA (Lingkar Lengan Atas)</td>
                    <td class="p-3 text-slate-800">{{ $ibuHamil->lingkar_lengan_atas ? $ibuHamil->lingkar_lengan_atas . ' cm' : '-' }}</td>
                </tr>
                <tr>
                    <td class="p-3 font-medium text-slate-600">Tinggi Badan</td>
                    <td class="p-3 text-slate-800">{{ $ibuHamil->tinggi_badan ? $ibuHamil->tinggi_badan . ' cm' : '-' }}</td>
                </tr>
                <tr>
                    <td class="p-3 font-medium text-slate-600">No. HP</td>
                    <td class="p-3 text-slate-800">{{ $ibuHamil->no_hp ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="p-3 font-medium text-slate-600">Nama Suami</td>
                    <td class="p-3 text-slate-800">{{ $ibuHamil->nama_suami ?? '-' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>