<x-app-layout>
    <div class="mb-6">
        <h2 class="font-bold text-2xl text-slate-800">Dashboard Admin Kecamatan</h2>
        <p class="text-slate-500">Ringkasan data kesehatan dan Posyandu hari ini.</p>
    </div>

    <!-- Kartu Statistik Atas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 border-l-4 border-l-primary-500">
            <h3 class="text-slate-500 text-sm font-medium">Total Anak Terdata</h3>
            <p class="text-3xl font-bold text-slate-800 mt-2">{{ $totalAnak }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 border-l-4 border-l-red-500">
            <h3 class="text-slate-500 text-sm font-medium">Kasus Stunting</h3>
            <p class="text-3xl font-bold text-slate-800 mt-2">{{ $totalStunting }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 border-l-4 border-l-blue-500">
            <h3 class="text-slate-500 text-sm font-medium">Ibu Hamil</h3>
            <p class="text-3xl font-bold text-slate-800 mt-2">{{ $totalIbuHamil }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 border-l-4 border-l-orange-500">
            <h3 class="text-slate-500 text-sm font-medium">Total Posyandu</h3>
            <p class="text-3xl font-bold text-slate-800 mt-2">{{ $totalPosyandu }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Tabel Laporan Terbaru -->
        <div class="md:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-200">
                <h3 class="font-bold text-lg text-slate-800">Aktivitas Posyandu Terbaru</h3>
            </div>
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-slate-500 text-sm">
                    <tr>
                        <th class="p-4">Nama Anak</th>
                        <th class="p-4">Posyandu</th>
                        <th class="p-4">Status Gizi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr>
                        <td class="p-4 font-medium">Budi Santoso</td>
                        <td class="p-4 text-slate-600">Posyandu Melati</td>
                        <td class="p-4"><span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold">NORMAL</span></td>
                    </tr>
                    <tr>
                        <td class="p-4 font-medium">Siti Aminah</td>
                        <td class="p-4 text-slate-600">Posyandu Mawar</td>
                        <td class="p-4"><span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-bold">STUNTING</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Statistik Pengguna -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h3 class="font-bold text-lg text-slate-800 mb-4">Tenaga Kesehatan</h3>
            <div class="flex justify-between items-center mb-3">
                <span class="text-slate-600">Total Kader</span>
                <span class="font-bold text-primary-600">{{ $totalKader }} Orang</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-600">Total Bidan</span>
                <span class="font-bold text-primary-600">{{ $totalBidan }} Orang</span>
            </div>
        </div>
    </div>
</x-app-layout>