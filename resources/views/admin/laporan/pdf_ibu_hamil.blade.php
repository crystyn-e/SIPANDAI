<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Ibu Hamil</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 18px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
        .text-red { color: red; font-weight: bold; }
        .text-green { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>PUSKESMAS KECAMATAN SUKAMAJU</h1>
        <p>Sistem Informasi Posyandu Andalan Ibu (SIPANDAI)</p>
        <p>Laporan Data Ibu Hamil</p>
    </div>

    <p>Tanggal Cetak: {{ date('d F Y') }}</p>
    <p>Total Ibu Hamil: {{ $ibuHamils->count() }} Orang</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Ibu</th>
                <th>NIK</th>
                <th>Umur</th>
                <th>Desa / Posyandu</th>
                <th>Status Risiko</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ibuHamils as $index => $ibu)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $ibu->nama }}</td>
                    <td>{{ $ibu->nik }}</td>
                    <td>{{ $ibu->umur }} Thn</td>
                    <td>{{ $ibu->posyandu->desa->nama ?? '-' }} / {{ $ibu->posyandu->nama ?? '-' }}</td>
                    <td class="{{ $ibu->status_risiko === 'Normal' ? 'text-green' : 'text-red' }}">
                        {{ $ibu->status_risiko }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>