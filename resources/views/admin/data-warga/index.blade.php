<x-app-layout>
    <div class="mb-6">
        <h2 class="font-bold text-2xl text-slate-800">Pusat Data Warga</h2>
        <p class="text-slate-500">Pantau seluruh data Anak dan Ibu Hamil dari semua Posyandu.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Navigasi Tab -->
    <div class="mb-6 border-b border-slate-200">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg text-primary-600 border-primary-600" id="anak-tab" data-tabs-target="#anak" type="button" role="tab" aria-controls="anak" aria-selected="true">Data Anak (Balita)</button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-slate-600 hover:border-slate-300" id="ibu-tab" data-tabs-target="#ibu" type="button" role="tab" aria-controls="ibu" aria-selected="false">Data Ibu Hamil</button>
            </li>
        </ul>
    </div>

    <!-- Konten Tab -->
    <div id="myTabContent">
        <!-- Tab Anak -->
        <div class="p-4 rounded-lg bg-white border border-slate-200 shadow-sm" id="anak" role="tabpanel" aria-labelledby="anak-tab">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-500 text-sm">
                        <tr>
                            <th class="p-4 border-b">Nama Anak</th>
                            <th class="p-4 border-b">Tgl Lahir</th>
                            <th class="p-4 border-b">Desa / Posyandu</th>
                            <th class="p-4 border-b">Orang Tua</th>
                            <th class="p-4 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($anak as $a)
                            <tr>
                                <td class="p-4 font-medium text-slate-800">{{ $a->nama }}</td>
                                <td class="p-4 text-slate-600">{{ \Carbon\Carbon::parse($a->tanggal_lahir)->format('d/m/Y') }}</td>
                                <td class="p-4 text-slate-600">
                                    {{ $a->posyandu->desa->nama ?? '-' }} <br>
                                    <span class="text-xs text-slate-400">{{ $a->posyandu->nama ?? '-' }}</span>
                                </td>
                                <td class="p-4 text-slate-600">{{ $a->orangtua->name ?? '-' }}</td>
                                <td class="p-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <!-- Tombol Edit Anak -->
                                        <a href="{{ route('admin.data-warga.edit-anak', $a->id) }}" class="bg-amber-100 text-amber-700 hover:bg-amber-200 py-1 px-3 rounded-lg text-xs font-bold transition-colors">Edit</a>
                                        
                                        <!-- Tombol Hapus Anak -->
                                        <form action="{{ route('admin.data-warga.destroy-anak', $a->id) }}" method="POST" onsubmit="return confirm('Hapus data anak ini? Data pemeriksaannya juga akan terhapus.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-100 text-red-700 hover:bg-red-200 py-1 px-3 rounded-lg text-xs font-bold transition-colors">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="p-6 text-center text-slate-500">Belum ada data anak.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tab Ibu Hamil -->
        <div class="hidden p-4 rounded-lg bg-white border border-slate-200 shadow-sm" id="ibu" role="tabpanel" aria-labelledby="ibu-tab">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-500 text-sm">
                        <tr>
                            <th class="p-4 border-b">Nama Ibu</th>
                            <th class="p-4 border-b">Umur</th>
                            <th class="p-4 border-b">Desa / Posyandu</th>
                            <th class="p-4 border-b">Status Risiko</th>
                            <th class="p-4 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($ibuHamil as $ibu)
                            <tr>
                                <td class="p-4 font-medium text-slate-800">{{ $ibu->nama }}</td>
                                <td class="p-4 text-slate-600">{{ $ibu->umur }} Tahun</td>
                                <td class="p-4 text-slate-600">
                                    {{ $ibu->posyandu->desa->nama ?? '-' }} <br>
                                    <span class="text-xs text-slate-400">{{ $ibu->posyandu->nama ?? '-' }}</span>
                                </td>
                                <td class="p-4">
                                    @if($ibu->status_risiko === 'Normal')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">NORMAL</span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">{{ $ibu->status_risiko }}</span>
                                    @endif
                                </td>
                                <td class="p-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <!-- Tombol Edit Ibu Hamil -->
                                        <a href="{{ route('admin.data-warga.edit-ibu', $ibu->id) }}" class="bg-amber-100 text-amber-700 hover:bg-amber-200 py-1 px-3 rounded-lg text-xs font-bold transition-colors">Edit</a>
                                        
                                        <!-- Tombol Hapus Ibu Hamil -->
                                        <form action="{{ route('admin.data-warga.destroy-ibu', $ibu->id) }}" method="POST" onsubmit="return confirm('Hapus data ibu hamil ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-100 text-red-700 hover:bg-red-200 py-1 px-3 rounded-lg text-xs font-bold transition-colors">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="p-6 text-center text-slate-500">Belum ada data ibu hamil.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Script Sederhana untuk Tab (Vanilla JS) -->
    <script>
        const tabButtons = document.querySelectorAll('[data-tabs-target]');
        const tabPanes = document.querySelectorAll('[role="tabpanel"]');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                tabButtons.forEach(btn => {
                    btn.classList.remove('text-primary-600', 'border-primary-600');
                    btn.classList.add('border-transparent', 'hover:text-slate-600', 'hover:border-slate-300');
                });
                tabPanes.forEach(pane => pane.classList.add('hidden'));

                button.classList.remove('border-transparent', 'hover:text-slate-600', 'hover:border-slate-300');
                button.classList.add('text-primary-600', 'border-primary-600');
                
                const target = document.querySelector(button.dataset.tabsTarget);
                if(target) target.classList.remove('hidden');
            });
        });
    </script>
</x-app-layout>