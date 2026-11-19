<x-app-layout>
    <div class="mb-6">
        <h2 class="font-bold text-2xl text-slate-800">Edit Jadwal Posyandu</h2>
        <p class="text-slate-500">Perbarui jadwal kegiatan Posyandu.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 max-w-2xl">
        <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Pilih Posyandu</label>
                <select name="posyandu_id" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    @foreach($posyandus as $posyandu)
                        <option value="{{ $posyandu->id }}" {{ $jadwal->posyandu_id == $posyandu->id ? 'selected' : '' }}>
                            {{ $posyandu->nama }} ({{ $posyandu->desa->nama }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Kegiatan</label>
                    <input type="date" name="tanggal" value="{{ $jadwal->tanggal }}" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Kegiatan</label>
                    <input type="text" name="kegiatan" value="{{ $jadwal->kegiatan }}" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-700 mb-1">Keterangan (Opsional)</label>
                <textarea name="keterangan" rows="3" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">{{ $jadwal->keterangan }}</textarea>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.jadwal.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold py-2 px-4 rounded-lg transition-colors">Batal</a>
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition-colors">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-app-layout>