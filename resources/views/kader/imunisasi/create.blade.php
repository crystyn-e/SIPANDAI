<x-app-layout>
    <div class="mb-6">
        <h2 class="font-bold text-2xl text-slate-800">Imunisasi: {{ $anak->nama }}</h2>
        <p class="text-slate-500">Catat riwayat imunisasi anak.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Form Tambah Imunisasi -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h3 class="font-bold text-lg text-slate-800 mb-4">Tambah Imunisasi Baru</h3>
            <form action="{{ route('kader.imunisasi.store', $anak->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Imunisasi</label>
                    <select name="jenis_imunisasi" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        <option value="">-- Pilih Vaksin --</option>
                        <option value="HB-0">HB-0 (0 Bulan)</option>
                        <option value="BCG">BCG (1 Bulan)</option>
                        <option value="Polio 1">Polio 1</option>
                        <option value="DPT-HB-Hib 1">DPT-HB-Hib 1</option>
                        <option value="Polio 2">Polio 2</option>
                        <option value="DPT-HB-Hib 2">DPT-HB-Hib 2</option>
                        <option value="Polio 3">Polio 3</option>
                        <option value="DPT-HB-Hib 3">DPT-HB-Hib 3</option>
                        <option value="IPV">IPV</option>
                        <option value="Campak/MR">Campak/MR</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Imunisasi</label>
                    <input type="date" name="tanggal_imunisasi" value="{{ date('Y-m-d') }}" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Keterangan (Opsional)</label>
                    <textarea name="keterangan" rows="2" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"></textarea>
                </div>
                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition-colors">Simpan Imunisasi</button>
            </form>
        </div>

        <!-- Riwayat Imunisasi -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h3 class="font-bold text-lg text-slate-800 mb-4">Riwayat Imunisasi</h3>
            <div class="overflow-y-auto max-h-96">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-500 text-sm">
                        <tr>
                            <th class="p-3 border-b">Tanggal</th>
                            <th class="p-3 border-b">Vaksin</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($imunisasis as $imunisasi)
                            <tr>
                                <td class="p-3 text-slate-600">{{ \Carbon\Carbon::parse($imunisasi->tanggal_imunisasi)->format('d/m/Y') }}</td>
                                <td class="p-3 font-medium text-slate-800">{{ $imunisasi->jenis_imunisasi }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="p-6 text-center text-slate-500">Belum ada imunisasi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>