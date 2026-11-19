<x-app-layout>
    <div class="mb-6">
        <h2 class="font-bold text-2xl text-slate-800">Pemeriksaan: {{ $anak->nama }}</h2>
        <p class="text-slate-500">Input hasil penimbangan bulan ini.</p>
    </div>

    <!-- BLOK UNTUK MENAMPILKAN PESAN ERROR VALIDASI -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 max-w-2xl">
        <form action="{{ route('kader.pemeriksaan.store', $anak->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Periksa</label>
                <input type="date" name="tanggal_periksa" value="{{ date('Y-m-d') }}" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Berat Badan (kg)</label>
                    <input type="number" step="0.1" name="berat_badan" value="{{ old('berat_badan') }}" required placeholder="Cth: 9.5" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tinggi Badan (cm)</label>
                    <input type="number" step="0.1" name="tinggi_badan" value="{{ old('tinggi_badan') }}" required placeholder="Cth: 75.2" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Lingkar Kepala (cm) - Opsional</label>
                <input type="number" step="0.1" name="lingkar_kepala" value="{{ old('lingkar_kepala') }}" placeholder="Cth: 45" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-700 mb-1">Catatan Kader (Opsional)</label>
                <textarea name="catatan" rows="3" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">{{ old('catatan') }}</textarea>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('kader.anak.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold py-2 px-4 rounded-lg transition-colors">Batal</a>
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition-colors">Simpan Pemeriksaan</button>
            </div>
        </form>
    </div>
</x-app-layout>