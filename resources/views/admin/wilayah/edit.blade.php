<x-app-layout>
    <div class="mb-6">
        <h2 class="font-bold text-2xl text-slate-800">Edit Wilayah</h2>
        <p class="text-slate-500">Perbarui data Desa atau Posyandu.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 max-w-2xl">
        <form action="{{ route('admin.wilayah.update', $posyandu->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Pilih Kecamatan</label>
                <select name="kecamatan_id" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    @foreach($kecamatans as $kecamatan)
                        <option value="{{ $kecamatan->id }}" {{ $posyandu->desa->kecamatan_id == $kecamatan->id ? 'selected' : '' }}>
                            {{ $kecamatan->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Desa</label>
                <input type="text" name="nama_desa" value="{{ $posyandu->desa->nama }}" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Posyandu</label>
                <input type="text" name="nama_posyandu" value="{{ $posyandu->nama }}" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.wilayah') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold py-2 px-4 rounded-lg transition-colors">Batal</a>
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition-colors">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-app-layout>