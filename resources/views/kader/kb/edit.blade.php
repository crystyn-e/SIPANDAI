<x-app-layout>
    <div class="mb-6">
        <h2 class="font-bold text-2xl text-slate-800">Edit Peserta KB</h2>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 max-w-2xl">
        <form action="{{ route('kader.kb.update', $kb->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Peserta (Ibu)</label>
                <input type="text" name="nama_peserta" value="{{ $kb->nama_peserta }}" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Umur</label>
                    <input type="number" name="umur" value="{{ $kb->umur }}" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Suami</label>
                    <input type="text" name="nama_suami" value="{{ $kb->nama_suami }}" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Kontrasepsi</label>
                    <select name="jenis_kontrasepsi" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        <option value="Suntik 1 Bulan" {{ $kb->jenis_kontrasepsi == 'Suntik 1 Bulan' ? 'selected' : '' }}>Suntik 1 Bulan</option>
                        <option value="Suntik 3 Bulan" {{ $kb->jenis_kontrasepsi == 'Suntik 3 Bulan' ? 'selected' : '' }}>Suntik 3 Bulan</option>
                        <option value="Pil" {{ $kb->jenis_kontrasepsi == 'Pil' ? 'selected' : '' }}>Pil</option>
                        <option value="IUD" {{ $kb->jenis_kontrasepsi == 'IUD' ? 'selected' : '' }}>IUD</option>
                        <option value="Implant" {{ $kb->jenis_kontrasepsi == 'Implant' ? 'selected' : '' }}>Implant</option>
                        <option value="Kondom" {{ $kb->jenis_kontrasepsi == 'Kondom' ? 'selected' : '' }}>Kondom</option>
                        <option value="MOW/MOP" {{ $kb->jenis_kontrasepsi == 'MOW/MOP' ? 'selected' : '' }}>MOW/MOP</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" value="{{ $kb->tanggal_mulai }}" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('kader.kb.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold py-2 px-4 rounded-lg transition-colors">Batal</a>
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition-colors">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-app-layout>