<x-app-layout>
    <div class="mb-6">
        <h2 class="font-bold text-2xl text-slate-800">Dashboard Admin Kecamatan</h2>
        <p class="text-slate-500">Ringkasan data kesehatan dan Posyandu hari ini.</p>
    </div>

    <!-- Notifikasi Pending -->
    @if($pendingUsers->count() > 0)
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded-r-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="flex-shrink-0 text-yellow-400">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700 font-medium">
                            Ada <strong>{{ $pendingUsers->count() }}</strong> akun Orang Tua yang menunggu verifikasi.
                        </p>
                    </div>
                </div>
                <a href="{{ route('admin.users.index') }}" class="text-sm font-semibold text-yellow-700 hover:text-yellow-900 underline">Lihat Semua</a>
            </div>
        </div>
    @endif

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
        <!-- Tabel Laporan Stunting Terbaru -->
        <div class="md:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-200 flex justify-between items-center">
                <h3 class="font-bold text-lg text-slate-800">Temuan Stunting Terbaru</h3>
                <button class="text-sm font-semibold text-primary-600 hover:text-primary-800">Download Laporan</button>
            </div>
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-slate-500 text-sm">
                    <tr>
                        <th class="p-4">Nama Anak</th>
                        <th class="p-4">Posyandu / Desa</th>
                        <th class="p-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($anakStuntings as $periksa)
                        <tr>
                            <td class="p-4 font-medium text-slate-800">{{ $periksa->anak->nama }}</td>
                            <td class="p-4 text-slate-600 text-sm">
                                {{ $periksa->anak->posyandu->nama ?? '-' }} <br>
                                <span class="text-xs text-slate-400">{{ $periksa->anak->desa->nama ?? '-' }}</span>
                            </td>
                            <td class="p-4"><span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-bold">STUNTING</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-6 text-center text-slate-500">Belum ada temuan stunting terbaru.</td>
                        </tr>
                    @endforelse
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
            <div class="flex justify-between items-center mb-6">
                <span class="text-slate-600">Total Bidan</span>
                <span class="font-bold text-primary-600">{{ $totalBidan }} Orang</span>
            </div>
            
            <a href="{{ route('admin.users.create') }}" class="block text-center w-full bg-primary-50 text-primary-700 font-semibold py-2 rounded-lg border border-primary-200 hover:bg-primary-100 transition-colors">
                + Tambah Tenaga Kesehatan
            </a>
        </div>
                <a href="{{ route('admin.wilayah.create') }}" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition-colors">
            + Tambah Wilayah
        </a>
    </div>
</x-app-layout>