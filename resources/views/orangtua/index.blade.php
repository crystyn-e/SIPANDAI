<x-app-layout>
    <div class="mb-8">
        <h2 class="font-bold text-2xl text-slate-800">Buku KIA Digital</h2>
        <p class="text-slate-500">Pantau tumbuh kembang anak Anda langsung dari sini.</p>
    </div>

    @forelse($anaks as $anak)
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8">
            <!-- HEADER KARTU ANAK -->
            <div class="flex justify-between items-start border-b border-slate-100 pb-4 mb-6">
                <div>
                    <h3 class="text-xl font-bold text-primary-700">{{ $anak->nama }}</h3>
                    <p class="text-slate-500 text-sm mt-1">{{ $anak->nik }} | {{ $anak->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                </div>
                <a href="{{ route('orangtua.kms.pdf', $anak->id) }}" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-semibold text-sm shadow-sm transition-colors">
                    Download KMS PDF
                </a>
            </div>

            <!-- GRAFIK PERTUMBUHAN -->
            <h4 class="font-bold text-slate-800 mb-4">Grafik Pertumbuhan</h4>
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 mb-8 h-64">
                <canvas id="chart-{{ $anak->id }}"></canvas>
            </div>

            <!-- RIWAYAT PENIMBANGAN -->
            <h4 class="font-bold text-slate-800 mb-3">Riwayat Penimbangan</h4>
            <div class="overflow-x-auto mb-8">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-500 text-sm">
                        <tr>
                            <th class="p-3 border-b">Tanggal Periksa</th>
                            <th class="p-3 border-b">Berat (kg)</th>
                            <th class="p-3 border-b">Tinggi (cm)</th>
                            <th class="p-3 border-b">Status Gizi</th>
                            <th class="p-3 border-b">Catatan Medis</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($anak->pemeriksaans as $periksa)
                            <tr>
                                <td class="p-3 text-slate-800">{{ \Carbon\Carbon::parse($periksa->tanggal_periksa)->format('d/m/Y') }}</td>
                                <td class="p-3 text-slate-600">{{ $periksa->berat_badan }} kg</td>
                                <td class="p-3 text-slate-600">{{ $periksa->tinggi_badan }} cm</td>
                                <td class="p-3">
                                    @if($periksa->status_gizi === 'Normal')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">NORMAL</span>
                                    @elseif($periksa->status_gizi === 'Stunting')
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">STUNTING</span>
                                    @else
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">{{ strtoupper($periksa->status_gizi) }}</span>
                                    @endif
                                </td>
                                <td class="p-3 text-slate-600 text-sm">{{ $periksa->catatan ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="p-6 text-center text-slate-500">Belum ada riwayat.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- RIWAYAT IMUNISASI -->
            <h4 class="font-bold text-slate-800 mb-3">Riwayat Imunisasi</h4>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-blue-50 text-blue-600 text-sm">
                        <tr>
                            <th class="p-3 border-b">Tanggal</th>
                            <th class="p-3 border-b">Jenis Imunisasi</th>
                            <th class="p-3 border-b">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($anak->imunisasis as $imunisasi)
                            <tr>
                                <td class="p-3 text-slate-800">{{ \Carbon\Carbon::parse($imunisasi->tanggal_imunisasi)->format('d/m/Y') }}</td>
                                <td class="p-3 font-medium text-slate-800">{{ $imunisasi->jenis_imunisasi }}</td>
                                <td class="p-3 text-slate-600 text-sm">{{ $imunisasi->keterangan ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="p-6 text-center text-slate-500">Belum ada riwayat imunisasi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SCRIPT CHART JS -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('chart-{{ $anak->id }}').getContext('2d');
                const labels = {!! json_encode($anak->pemeriksaans->map(fn($p) => \Carbon\Carbon::parse($p->tanggal_periksa)->format('M Y'))) !!};
                const dataBerat = {!! json_encode($anak->pemeriksaans->pluck('berat_badan')) !!};
                const dataTinggi = {!! json_encode($anak->pemeriksaans->pluck('tinggi_badan')) !!};

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [
                            { label: 'Berat Badan (kg)', data: dataBerat, borderColor: '#10b981', tension: 0.3, yAxisID: 'y' },
                            { label: 'Tinggi Badan (cm)', data: dataTinggi, borderColor: '#3b82f6', tension: 0.3, yAxisID: 'y1' }
                        ]
                    },
                    options: {
                        responsive: true, maintainAspectRatio: false,
                        scales: {
                            y: { type: 'linear', display: true, position: 'left', title: { display: true, text: 'Berat (kg)' } },
                            y1: { type: 'linear', display: true, position: 'right', title: { display: true, text: 'Tinggi (cm)' }, grid: { drawOnChartArea: false } }
                        }
                    }
                });
            });
        </script>
    @empty
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 text-center mb-8">
            <p class="text-slate-500">Anda belum mendaftarkan data anak.</p>
        </div>
    @endforelse

    <!-- RIWAYAT KB (DI LUAR PERULANGAN ANAK) -->
    @if(isset($kbs) && $kbs->count() > 0)
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8 mt-8">
            <h3 class="text-xl font-bold text-primary-700 mb-4">Riwayat Keluarga Berencana (KB)</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-500 text-sm">
                        <tr>
                            <th class="p-3 border-b">Tanggal Mulai</th>
                            <th class="p-3 border-b">Jenis Kontrasepsi</th>
                            <th class="p-3 border-b">Jadwal Ulang</th>
                            <th class="p-3 border-b">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($kbs as $kb)
                            <tr>
                                <td class="p-3 text-slate-800">{{ \Carbon\Carbon::parse($kb->tanggal_mulai)->format('d/m/Y') }}</td>
                                <td class="p-3 text-slate-600">{{ $kb->jenis_kontrasepsi }}</td>
                                <td class="p-3 text-slate-600">{{ $kb->jadwal_ulang ? \Carbon\Carbon::parse($kb->jadwal_ulang)->format('d/m/Y') : '-' }}</td>
                                <td class="p-3">
                                    @if($kb->jadwal_ulang && \Carbon\Carbon::parse($kb->jadwal_ulang)->isPast())
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">JADWAL ULANG TERLEWAT</span>
                                    @else
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">AKTIF</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</x-app-layout>