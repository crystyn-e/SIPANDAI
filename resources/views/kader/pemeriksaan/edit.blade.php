<x-app-layout>
    <div class="mb-6">
        <h2 class="font-bold text-2xl text-slate-800">Edit Pemeriksaan: {{ $anak->nama }}</h2>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 max-w-2xl">
        <form action="{{ route('kader.pemeriksaan.update', $pemeriksaan->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Periksa</label>
                <input type="date" name="tanggal_periksa" value="{{ $pemeriksaan->tanggal_periksa }}" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Berat Badan (kg)</label>
                    <input type="number" step="0.1" name="berat_badan" value="{{ $pemeriksaan->berat_badan }}" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tinggi Badan (cm)</label>
                    <input type="number" step="0.1" name="tinggi_badan" value="{{ $pemeriksaan->tinggi_badan }}" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Lingkar Kepala (cm)</label>
                <input type="number" step="0.1" name="lingkar_kepala" value="{{ $pemeriksaan->lingkar_kepala }}" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-700 mb-1">Catatan</label>
                <textarea name="catatan" rows="3" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">{{ $pemeriksaan->catatan }}</textarea>
            </div>
            <div class="flex justify-end gap-3">
                <a href="{{ route('kader.anak.show', $anak->id) }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold py-2 px-4 rounded-lg transition-colors">Batal</a>
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition-colors">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-app-layout>