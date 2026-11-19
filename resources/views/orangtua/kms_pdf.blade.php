<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>KMS - {{ $anak->nama }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #059669; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 20px; color: #059669; }
        .header p { margin: 5px 0 0 0; font-size: 14px; }
        .info-box { margin-bottom: 20px; }
        .info-table { width: 100%; }
        .info-table td { padding: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .status-normal { color: green; font-weight: bold; }
        .status-stunting { color: red; font-weight: bold; }
        .footer { margin-top: 40px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h1>BUKU KIA DIGITAL (KMS)</h1>
        <p>Sistem Informasi Posyandu Andalan Ibu (SIPANDAI)</p>
    </div>

    <div class="info-box">
        <table class="info-table">
            <tr>
                <td width="20%"><strong>Nama Anak</strong></td>
                <td width="30%">: {{ $anak->nama }}</td>
                <td width="20%"><strong>NIK</strong></td>
                <td width="30%">: {{ $anak->nik }}</td>
            </tr>
            <tr>
                <td><strong>Tgl Lahir</strong></td>
                <td>: {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d/m/Y') }}</td>
                <td><strong>Jenis Kelamin</strong></td>
                <td>: {{ $anak->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td><strong>Posyandu</strong></td>
                <td>: {{ $anak->posyandu->nama ?? '-' }}</td>
                <td><strong>Desa</strong></td>
                <td>: {{ $anak->desa->nama ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <!-- TABEL PENIMBANGAN -->
    <h3>Riwayat Penimbangan</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Berat (kg)</th>
                <th>Tinggi (cm)</th>
                <th>Status Gizi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pemeriksaans as $index => $periksa)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($periksa->tanggal_periksa)->format('d/m/Y') }}</td>
                    <td>{{ $periksa->berat_badan }}</td>
                    <td>{{ $periksa->tinggi_badan }}</td>
                    <td class="{{ $periksa->status_gizi === 'Normal' ? 'status-normal' : 'status-stunting' }}">
                        {{ strtoupper($periksa->status_gizi) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- TABEL IMUNISASI (TAMBAHAN BARU) -->
    <h3>Riwayat Imunisasi</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jenis Imunisasi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($imunisasis as $index => $imunisasi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($imunisasi->tanggal_imunisasi)->format('d/m/Y') }}</td>
                    <td>{{ $imunisasi->jenis_imunisasi }}</td>
                    <td>{{ $imunisasi->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Belum ada riwayat imunisasi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ date('d F Y') }}</p>
        <br><br>
        <p>Petugas Kesehatan</p>
    </div>
</body>
</html>