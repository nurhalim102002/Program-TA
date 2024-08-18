<!-- cetak_perangkingan.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Tabel Perangkingan Karyawan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
            position: relative;
        }
        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            max-width: 80px;
        }
        h2, h4 {
            margin: 10px 0;
            color: #333;
        }
        h2 {
            font-size: 24px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .no-print {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            margin-right: 10px; /* Add space between buttons */
        }
        .btn-back {
            background-color: #dc3545; /* Red color for back button */
        }
        .btn-back:hover {
            background-color: #c82333;
        }
        .btn-print {
            background-color: #007bff; /* Blue color for print button */
        }
        .btn-print:hover {
            background-color: #0056b3;
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
            .no-print {
                display: none;
            }
            body {
                margin: 0;
                padding: 0;
            }
            .container {
                box-shadow: none;
                border-radius: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ url('assets/images/minamas.png') }}" alt="Logo Perusahaan" class="logo">
        <h2>MINAMAS PLANTATION</h2>
        <h4>PT LANGGENG MUARA MAKMUR</h4>
        <h4>LANTING ESTATE</h4><br><br>
        <h2>Tabel Perangkingan Karyawan</h2>
        <table>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Nilai Akhir</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rank = 1;
                @endphp
                @foreach ($rasio as $karyawan)
                <tr>
                    <td>{{ $rank++ }}</td>
                    <td>{{ $karyawan->karyawan->nik }}</td>
                    <td>{{ $karyawan->karyawan->nama }}</td>
                    <td>{{ $karyawan->nilai_akhir }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="signature-section">
            <div class="signature">
                <img src="{{ url('assets/images/ttd.png') }}" alt="Tanda Tangan"> <!-- Gambar tanda tangan -->
                <div class="signature-name">Agus Setiawan</div>
                <div>Estate Manager</div>
            </div>
        </div>
        <button class="no-print btn-back" onclick="window.history.back()">Kembali</button>
        <button class="no-print btn-print" onclick="window.print()">Cetak</button>
    </div>
</body>
</html>
