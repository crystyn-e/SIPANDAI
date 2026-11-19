<x-app-layout>
    <div class="mb-6">
        <h2 class="font-bold text-2xl text-slate-800">Tambah Peserta KB</h2>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 max-w-2xl">
        <form action="{{ route('kader.kb.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Peserta (Ibu)</label>
                <input type="text" name="nama_peserta" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Umur</label>
                    <input type="number" name="umur" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Suami</label>
                    <input type="text" name="nama_suami" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Kontrasepsi</label>
                    <select name="jenis_kontrasepsi" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        <option value="">-- Pilih --</option>
                        <option value="Suntik 1 Bulan">Suntik 1 Bulan</option>
                        <option value="Suntik 3 Bulan">Suntik 3 Bulan</option>
                        <option value="Pil">Pil</option>
                        <option value="IUD">IUD</option>
                        <option value="Implant">Implant</option>
                        <option value="Kondom">Kondom</option>
                        <option value="MOW/MOP">MOW/MOP</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('kader.kb.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold py-2 px-4 rounded-lg transition-colors">Batal</a>
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition-colors">Simpan Data</button>
            </div>
        </form>
    </div>
</x-app-layout>