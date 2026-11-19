<x-app-layout>
    <div class="mb-6">
        <h2 class="font-bold text-2xl text-slate-800">Edit Data Ibu Hamil</h2>
        <p class="text-slate-500">Perbarui data untuk {{ $ibuHamil->nama }}.</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 max-w-2xl">
        <form action="{{ route('admin.data-warga.update-ibu', $ibuHamil->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Ibu</label>
                <input type="text" name="nama" value="{{ $ibuHamil->nama }}" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">NIK</label>
                <input type="text" name="nik" value="{{ $ibuHamil->nik }}" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Umur</label>
                    <input type="number" name="umur" value="{{ $ibuHamil->umur }}" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Status Risiko</label>
                    <select name="status_risiko" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        <option value="Normal" {{ $ibuHamil->status_risiko == 'Normal' ? 'selected' : '' }}>Normal</option>
                        <option value="Risiko Tinggi (KEK)" {{ $ibuHamil->status_risiko == 'Risiko Tinggi (KEK)' ? 'selected' : '' }}>Risiko Tinggi (KEK)</option>
                        <option value="Risiko Tinggi (Umur)" {{ $ibuHamil->status_risiko == 'Risiko Tinggi (Umur)' ? 'selected' : '' }}>Risiko Tinggi (Umur)</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.data-warga') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold py-2 px-4 rounded-lg transition-colors">Batal</a>
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition-colors">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-app-layout>