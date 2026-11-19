<x-app-layout>
    <div class="mb-6">
        <h2 class="font-bold text-2xl text-slate-800">Catatan Medis Bidan</h2>
        <p class="text-slate-500">Berikan intervensi medis untuk <strong>{{ $anak->nama }}</strong>.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 max-w-2xl">
        <form action="{{ route('bidan.kasus.store-catatan-anak', $anak->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Catatan Medis / Intervensi</label>
                <textarea name="catatan_medis" rows="5" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500" placeholder="Contoh: Diberikan PMT Tambahan, jadwal kontrol 2 minggu lagi..."></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <a href="{{ route('bidan.kasus.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold py-2 px-4 rounded-lg transition-colors">Batal</a>
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition-colors">Simpan Catatan</button>
            </div>
        </form>
    </div>
</x-app-layout>