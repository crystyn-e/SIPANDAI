<x-app-layout>
    <div class="mb-6">
        <h2 class="font-bold text-2xl text-slate-800">Dashboard Bidan</h2>
        <p class="text-slate-500">Pantauan medis desa binaan: <strong>{{ Auth::user()->desa->nama ?? '-' }}</strong></p>
    </div>

    <!-- Kartu Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 border-l-4 border-l-red-500">
            <h3 class="text-slate-500 text-sm font-medium">Anak Terdeteksi Stunting</h3>
            <p class="text-4xl font-bold text-slate-800 mt-2">{{ $totalStunting }} <span class="text-lg font-normal text-slate-500">Anak</span></p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 border-l-4 border-l-orange-500">
            <h3 class="text-slate-500 text-sm font-medium">Ibu Hamil Risiko Tinggi</h3>
            <p class="text-4xl font-bold text-slate-800 mt-2">{{ $totalIbuRisiko }} <span class="text-lg font-normal text-slate-500">Ibu</span></p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 text-center">
        <h3 class="font-bold text-lg text-slate-800 mb-2">Tindak Lanjut Medis</h3>
        <p class="text-slate-500 mb-4">Lihat detail kasus dan berikan catatan medis untuk pasien Anda.</p>
        <a href="{{ route('bidan.kasus.index') }}" class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-6 rounded-lg shadow-sm transition-colors">
            Buka Daftar Kasus
        </a>
    </div>
</x-app-layout>