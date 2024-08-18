<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Cetak Hasil Penilaian</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />

    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <link href="{{ asset('assets/css/bootstrap-material-design.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">

    <style>
        body {
            background: white;
            color: black;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            position: relative;
        }
        .header-title {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }
        .btn-print {
            display: block;
            width: 100%;
            margin: 20px 0;
            padding: 10px;
            background: #007bff;
            color: white;
            text-align: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-print:hover {
            background: #0056b3;
        }
        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 100px;
            height: auto;
        }
        .signature-section {
            margin-top: 40px;
            text-align: right;
        }
        .signature {
            display: inline-block;
            margin-top: 40px;
            text-align: center;
        }
        .signature img {
            width: 200px; /* Sesuaikan ukuran gambar tanda tangan */
            height: auto;
        }
        .signature-name {
            margin-top: 10px;
            font-weight: bold;
        }
        @media print {
            body {
                background: white;
                color: black;
            }
            .container {
                border: none;
                box-shadow: none;
            }
            .btn-print {
                display: none;
            }
            .logo {
                display: block; /* Pastikan logo tetap ditampilkan saat mencetak */
            }
            .signature img {
                display: block; /* Pastikan tanda tangan tetap ditampilkan saat mencetak */
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="{{ url('assets/images/minamas.png') }}" alt="Logo Perusahaan" class="logo">
        <h1 class="header-title">MINAMAS PLANTATION</h1>
        <h2 class="header-title">PT LANGGENG MUARA MAKMUR</h2>
        <h4 class="header-title">LANTING ESTATE</h4>
        <h4 class="header-title">Hasil Penilaian Karyawan</h4>
        <table>
            <tbody>
                <tr>
                    <th>NIK</th>
                    <td>{{ $karyawan->nik }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $karyawan->nama }}</td>
                </tr>
                <tr>
                    <th>Periode</th>
                    <td>{{ $periode }}</td>
                </tr>
                <tr>
                    <th>Riwayat Penugasan (K1)</th>
                    <td>{{ $nilai_penugasan }}</td>
                </tr>
                <tr>
                    <th>Absensi (K2)</th>
                    <td>{{ $nilai_absensi }}</td>
                </tr>
                <tr>
                    <th>Surat Peringatan (K3)</th>
                    <td>{{ $nilai_peringatan }}</td>
                </tr>
                <tr>
                    <th>Nilai Evaluasi (K4)</th>
                    <td>{{ $nilai_evaluasi }}</td>
                </tr>
                <tr>
                    <th>Nilai Akhir (N)</th>
                    <td>{{ $nilai_akhir }}</td>
                </tr>
                <tr>
                    <th>Rekomendasi</th>
                    <td>{{ $rekomendasi }}</td>
                </tr>
            </tbody>
        </table>
        <div class="signature-section">
            <div class="signature">
                <img src="{{ url('assets/images/ttd.png') }}" alt="Tanda Tangan"> <!-- Gambar tanda tangan -->
                <div class="signature-name">Agus Setiawan</div>
                <div>Estate Manager</div>
            </div>
        </div>
        <button class="btn-print" onclick="window.print()">Cetak</button>
    </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-material-design.js') }}"></script>
</body>
</html>
