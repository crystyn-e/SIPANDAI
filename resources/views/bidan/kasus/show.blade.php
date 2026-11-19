<x-app-layout>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="font-bold text-2xl text-slate-800">Detail Anak: {{ $anak->nama }}</h2>
            <p class="text-slate-500">NIK: {{ $anak->nik }} | Usia: {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->diffForHumans(null, true) }}</p>
        </div>
        <a href="{{ route('bidan.kasus.catatan-anak', $anak->id) }}" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-semibold text-sm transition-colors">
            Beri Catatan Medis
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Grafik Pertumbuhan -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h3 class="font-bold text-lg text-slate-800 mb-4">Grafik Pertumbuhan</h3>
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 h-64">
                <canvas id="chart-bidan-{{ $anak->id }}"></canvas>
            </div>
        </div>

        <!-- Riwayat Imunisasi -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h3 class="font-bold text-lg text-slate-800 mb-4">Riwayat Imunisasi</h3>
            <div class="overflow-y-auto max-h-64">
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
                                <td class="p-3 text-slate-800">{{ \Carbon\Carbon::parse($imunisasi->tanggal_imunisasi)->format('d/m/Y') }}</td>
                                <td class="p-3 text-slate-600">{{ $imunisasi->jenis_imunisasi }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="p-6 text-center text-slate-500">Belum ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tabel Riwayat Penimbangan -->
    <div class="mt-6 bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        <h3 class="font-bold text-lg text-slate-800 mb-4">Riwayat Penimbangan</h3>
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 text-slate-500 text-sm">
                <tr>
                    <th class="p-3 border-b">Tanggal</th>
                    <th class="p-3 border-b">BB (kg)</th>
                    <th class="p-3 border-b">TB (cm)</th>
                    <th class="p-3 border-b">Status</th>
                    <th class="p-3 border-b">Catatan Bidan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($pemeriksaans as $periksa)
                    <tr>
                        <td class="p-3 text-slate-800">{{ \Carbon\Carbon::parse($periksa->tanggal_periksa)->format('d/m/Y') }}</td>
                        <td class="p-3 text-slate-600">{{ $periksa->berat_badan }}</td>
                        <td class="p-3 text-slate-600">{{ $periksa->tinggi_badan }}</td>
                        <td class="p-3">
                            @if($periksa->status_gizi === 'Normal')
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold">NORMAL</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-bold">{{ strtoupper($periksa->status_gizi) }}</span>
                            @endif
                        </td>
                        <td class="p-3 text-slate-600 text-sm">{{ $periksa->catatan ?? '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-6 text-center text-slate-500">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('chart-bidan-{{ $anak->id }}').getContext('2d');
            const labels = {!! json_encode($pemeriksaans->map(fn($p) => \Carbon\Carbon::parse($p->tanggal_periksa)->format('M Y'))) !!};
            const dataBerat = {!! json_encode($pemeriksaans->pluck('berat_badan')) !!};
            const dataTinggi = {!! json_encode($pemeriksaans->pluck('tinggi_badan')) !!};

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
</x-app-layout>