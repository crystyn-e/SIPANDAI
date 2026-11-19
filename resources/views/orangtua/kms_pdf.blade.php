<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>KMS - {{ $anak->nama }}</title>
    <style>
        @page {
            margin: 28px 34px;
        }
        * {
            box-sizing: border-box;
        }
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #1e293b;
            margin: 0;
            padding: 0;
            line-height: 1.45;
        }

        /* 1. EXECUTIVE CIVIC-TECH HEADER */
        .header-banner {
            background-color: #0f172a;
            color: #ffffff;
            padding: 18px 22px;
            border-radius: 10px;
            border-bottom: 4px solid #10b981;
            margin-bottom: 18px;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-table td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }
        .brand-pill {
            display: inline-block;
            background-color: #064e3b;
            color: #6ee7b7;
            border: 1px solid #059669;
            font-size: 8.5px;
            font-weight: bold;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            padding: 3px 8px;
            border-radius: 4px;
            margin-bottom: 6px;
        }
        .header-title {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            color: #ffffff;
            letter-spacing: 0.3px;
        }
        .header-subtitle {
            margin: 3px 0 0 0;
            font-size: 10.5px;
            color: #cbd5e1;
        }
        .header-doc-meta {
            text-align: right;
            font-size: 9.5px;
            color: #94a3b8;
        }
        .header-doc-meta strong {
            display: block;
            font-size: 11px;
            color: #fbbf24;
            margin-bottom: 2px;
        }

        /* 2. KARTU IDENTITAS BALITA */
        .identity-card {
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            border-left: 4px solid #047857;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 18px;
        }
        .identity-title {
            font-size: 9.5px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            color: #047857;
            margin: 0 0 8px 0;
            padding-bottom: 5px;
            border-bottom: 1px solid #e2e8f0;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            border: none;
            padding: 3.5px 4px;
            font-size: 10.5px;
            vertical-align: top;
        }
        .info-label {
            color: #64748b;
            font-weight: bold;
            width: 18%;
        }
        .info-value {
            color: #0f172a;
            font-weight: bold;
            width: 32%;
        }

        /* 3. RINGKASAN SNAPSHOT (3 KOLOM) */
        .summary-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 8px 0;
            margin: 0 -8px 18px -8px;
        }
        .summary-card {
            background-color: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 10px 12px;
            width: 33.33%;
            vertical-align: top;
        }
        .summary-label {
            font-size: 8.5px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            margin-bottom: 4px;
        }
        .summary-val {
            font-size: 13px;
            font-weight: bold;
            color: #0f172a;
        }

        /* 4. SECTION HEADER & DATA TABLES */
        .section-header {
            margin: 18px 0 8px 0;
            padding-bottom: 5px;
            border-bottom: 2px solid #0f172a;
        }
        .section-header h3 {
            margin: 0;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #0f172a;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }
        table.data-table thead th {
            background-color: #0f172a;
            color: #ffffff;
            font-size: 9.5px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 10px;
            border: 1px solid #0f172a;
            text-align: left;
        }
        table.data-table thead th.text-center {
            text-align: center;
        }
        table.data-table tbody td {
            padding: 7.5px 10px;
            border: 1px solid #cbd5e1;
            font-size: 10.5px;
            color: #1e293b;
        }
        table.data-table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .text-center {
            text-align: center;
        }
        .font-bold {
            font-weight: bold;
        }

        /* STATUS BADGES */
        .badge-normal {
            display: inline-block;
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-stunting {
            display: inline-block;
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-vaksin {
            display: inline-block;
            background-color: #e0f2fe;
            color: #075985;
            border: 1px solid #bae6fd;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 9.5px;
            font-weight: bold;
        }

        /* 5. FOOTER & TANDA TANGAN */
        .footer-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 28px;
            page-break-inside: avoid;
        }
        .footer-table td {
            border: none;
            padding: 0;
            vertical-align: top;
        }
        .footer-note {
            font-size: 9px;
            color: #64748b;
            width: 60%;
            padding-right: 20px;
        }
        .signature-box {
            width: 40%;
            text-align: center;
            font-size: 10.5px;
            color: #1e293b;
        }
        .signature-space {
            height: 54px;
        }
        .signature-line {
            border-top: 1px solid #334155;
            width: 170px;
            margin: 0 auto 3px auto;
        }
    </style>
</head>
<body>
    @php
        $latestPeriksa = $pemeriksaans->last();
    @endphp

    {{-- 1. HEADER BANNER --}}
    <div class="header-banner">
        <table class="header-table">
            <tr>
                <td width="70%">
                    <div class="brand-pill">DOKUMEN RESMI KESEHATAN IBU &amp; ANAK</div>
                    <h1 class="header-title">BUKU KIA DIGITAL (KMS)</h1>
                    <p class="header-subtitle">Sistem Informasi Posyandu Andalan Ibu (SIPANDAI)</p>
                </td>
                <td width="30%" class="header-doc-meta">
                    <strong>KARTU MENUJU SEHAT</strong>
                    <div>Unit: {{ $anak->posyandu->nama ?? 'Posyandu' }}</div>
                    <div>Desa: {{ $anak->desa->nama ?? '-' }}</div>
                </td>
            </tr>
        </table>
    </div>

    {{-- 2. IDENTITAS ANAK --}}
    <div class="identity-card">
        <div class="identity-title">Identitas Sasaran Balita</div>
        <table class="info-table">
            <tr>
                <td class="info-label">Nama Anak</td>
                <td class="info-value">: {{ $anak->nama }}</td>
                <td class="info-label">NIK</td>
                <td class="info-value">: {{ $anak->nik }}</td>
            </tr>
            <tr>
                <td class="info-label">Tanggal Lahir</td>
                <td class="info-value">: {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($anak->tanggal_lahir)->diffForHumans(null, true) }})</td>
                <td class="info-label">Jenis Kelamin</td>
                <td class="info-value">: {{ $anak->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td class="info-label">Posyandu</td>
                <td class="info-value">: {{ $anak->posyandu->nama ?? '-' }}</td>
                <td class="info-label">Desa / Kel.</td>
                <td class="info-value">: {{ $anak->desa->nama ?? '-' }}</td>
            </tr>
        </table>
    </div>

    {{-- 3. RINGKASAN KLINIS TERAKHIR --}}
    <table class="summary-table">
        <tr>
            <td class="summary-card">
                <div class="summary-label">Pengukuran Terakhir</div>
                <div class="summary-val">
                    {{ $latestPeriksa ? $latestPeriksa->berat_badan . ' kg / ' . $latestPeriksa->tinggi_badan . ' cm' : 'Belum ada data' }}
                </div>
            </td>
            <td class="summary-card">
                <div class="summary-label">Status Gizi Terkini</div>
                <div class="summary-val">
                    @if(!$latestPeriksa)
                        -
                    @elseif($latestPeriksa->status_gizi === 'Normal')
                        <span class="badge-normal">NORMAL</span>
                    @else
                        <span class="badge-stunting">{{ strtoupper($latestPeriksa->status_gizi) }}</span>
                    @endif
                </div>
            </td>
            <td class="summary-card">
                <div class="summary-label">Capaian Imunisasi</div>
                <div class="summary-val">{{ $imunisasis->count() }} Dosis Vaksin</div>
            </td>
        </tr>
    </table>

    {{-- 4. TABEL PENIMBANGAN --}}
    <div class="section-header">
        <h3>I. Riwayat Penimbangan &amp; Status Gizi</h3>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="7%" class="text-center">No</th>
                <th width="20%">Tanggal Periksa</th>
                <th width="20%" class="text-center">Berat Badan (kg)</th>
                <th width="20%" class="text-center">Tinggi Badan (cm)</th>
                <th width="33%" class="text-center">Status Gizi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pemeriksaans as $index => $periksa)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="font-bold">{{ \Carbon\Carbon::parse($periksa->tanggal_periksa)->format('d/m/Y') }}</td>
                    <td class="text-center font-bold">{{ $periksa->berat_badan }} kg</td>
                    <td class="text-center font-bold">{{ $periksa->tinggi_badan }} cm</td>
                    <td class="text-center">
                        @if($periksa->status_gizi === 'Normal')
                            <span class="badge-normal">NORMAL</span>
                        @else
                            <span class="badge-stunting">{{ strtoupper($periksa->status_gizi) }}</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center" style="color: #64748b; padding: 14px;">Belum ada riwayat penimbangan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- 5. TABEL IMUNISASI --}}
    <div class="section-header">
        <h3>II. Riwayat Imunisasi Dasar</h3>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="7%" class="text-center">No</th>
                <th width="20%">Tanggal</th>
                <th width="33%">Jenis Imunisasi</th>
                <th width="40%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($imunisasis as $index => $imunisasi)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="font-bold">{{ \Carbon\Carbon::parse($imunisasi->tanggal_imunisasi)->format('d/m/Y') }}</td>
                    <td><span class="badge-vaksin">{{ $imunisasi->jenis_imunisasi }}</span></td>
                    <td>{{ $imunisasi->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center" style="color: #64748b; padding: 14px;">Belum ada riwayat imunisasi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- 6. FOOTER & PENGESAHAN --}}
    <table class="footer-table">
        <tr>
            <td class="footer-note">
                <strong>Catatan Sistem:</strong><br>
                Dokumen Kartu Menuju Sehat (KMS) ini dicetak secara otomatis melalui layanan SIPANDAI berdasarkan rekam pemeriksaan Posyandu terkini. Simpan dokumen ini sebagai arsip pendamping Buku KIA fisik.
            </td>
            <td class="signature-box">
                <div>{{ $anak->desa->nama ?? 'Posyandu' }}, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
                <div class="font-bold">Petugas Kesehatan / Bidan Desa</div>
                <div class="signature-space"></div>
                <div class="signature-line"></div>
                <div style="font-size: 9px; color: #64748b;">NIP / STR Petugas</div>
            </td>
        </tr>
    </table>
</body>
</html>