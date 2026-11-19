<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Stunting</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 18px; }
        .header p { margin: 5px 0 0 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>PUSKESMAS KECAMATAN SUKAMAJU</h1>
        <p>Sistem Informasi Posyandu Andalan Ibu (SIPANDAI)</p>
        <p>Laporan Kasus Stunting</p>
    </div>

    <p>Tanggal Cetak: {{ date('d F Y') }}</p>
    <p>Total Kasus Ditemukan: {{ $anakStuntings->count() }} Anak</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anak</th>
                <th>NIK</th>
                <th>Usia</th>
                <th>Desa</th>
                <th>Posyandu</th>
                <th>Nama Orang Tua</th>
            </tr>
        </thead>
        <tbody>
            @foreach($anakStuntings as $index => $anak)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $anak->nama }}</td>
                    <td>{{ $anak->nik }}</td>
                    <td>{{ \Carbon\Carbon::parse($anak->tanggal_lahir)->diffForHumans(null, true) }}</td>
                    <td>{{ $anak->posyandu->desa->nama ?? '-' }}</td>
                    <td>{{ $anak->posyandu->nama ?? '-' }}</td>
                    <td>{{ $anak->orangtua->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 40px; text-align: right;">
        <p>Mengetahui,</p>
        <br><br><br>
        <p><strong>Kepala Puskesmas</strong></p>
    </div>
</body>
</html>