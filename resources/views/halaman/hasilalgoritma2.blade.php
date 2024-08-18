<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Minamas - Hasil</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Stylesheets -->
    <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap-material-design.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">

    @include('tools.head')
    @include('tools.headtambahan')

    <!-- Inline Styles -->
    <style>
        .wadah-filter {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-top: 10px;
        }

        .formulir-filter {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .formulir-filter select {
            width: 200px;
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: border-color 0.3s;
        }

        .formulir-filter select:focus {
            border-color: #007bff;
        }

        .formulir-filter button {
            padding: 5px 15px;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            border: none;
            transition: background-color 0.3s;
        }

        .formulir-filter button:hover {
            background-color: #0056b3;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 2px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        .header-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-print {
            padding: 5px 15px;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            border: none;
            transition: background-color 0.3s;
        }

        .btn-print:hover {
            background-color: #0056b3;
        }

        .status-tervalidasi {
            color: white;
            background-color: green;
            padding: 5px;
            border-radius: 5px;
        }

        .status-belum-tervalidasi {
            color: black;
            background-color: yellow;
            padding: 5px;
            border-radius: 5px;
        }
    </style>
    <!-- End Inline Styles -->
</head>

<body class="fixed-left">
    <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

    <div id="wrapper">
        <!-- Include Sidebar and Topbar here -->
        @include('tools.sidebar2')
        <div class="content-page">
            <div class="content">
                @include('tools.topbar')
                <div class="page-content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <div class="btn-group float-right">
                                        <ol class="breadcrumb hide-phone p-0 m-0">
                                            <li class="breadcrumb-item"><a href="#">Urora</a></li>
                                            <li class="breadcrumb-item"><a href="#">Tables</a></li>
                                            <li class="breadcrumb-item active">Datatable</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Hasil</h4>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <!-- Card Tabel Data Penilaian Karyawan -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="wadah-filter">
                                            <h4 class="mt-0 header-title">Tabel Data Penilaian Karyawan</h4>
                                            <div class="formulir-filter">
                                                <form method="GET" action="" class="d-flex align-items-center gap-3">
                                                    <div class="form-group">
                                                        <select id="periode" name="periode" class="form-control">
                                                            @foreach ($periodeOptions as $value => $label)
                                                                <option value="{{ $value }}" {{ request('periode') == $value ? 'selected' : '' }}>
                                                                    {{ $label }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Periode</button>
                                                </form>
                                            </div>
                                        </div>

                                        <table id="datatable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th> Rank </th>
                                                    <th> NIK </th>
                                                    <th> Nama </th>
                                                    <th> Periode </th>
                                                    <th> Nilai Akhir (N) </th>
                                                    <th> Rekomendasi </th>
                                                    <th> Status Validasi </th>
                                                    <th> Aksi </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($rasio as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $item->karyawan->nik ?? 'N/A' }}</td>
                                                    <td>{{ $item->karyawan->nama ?? 'N/A' }}</td>
                                                    <td>{{ $item->periode }}</td>
                                                    <td>{{ $item->nilai_akhir }}</td>
                                                    <td>{{ $item->rekomendasi }}</td>
                                                    <td>
                                                        @if($item->status_validasi == 'Tervalidasi')
                                                            <span class="status-tervalidasi">{{ $item->status_validasi }}</span>
                                                        @elseif($item->status_validasi == 'Belum Tervalidasi')
                                                            <span class="status-belum-tervalidasi">{{ $item->status_validasi }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($item->status_validasi == 'Belum Tervalidasi')
                                                            <form method="POST" action="{{ url('/validasihasil/' . $item->id) }}">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success btn-sm">Validasi</button>
                                                            </form>
                                                        @elseif($item->status_validasi == 'Tervalidasi')
                                                            <form method="POST" action="{{ url('/batalkanvalidasihasil/' . $item->id) }}">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger btn-sm">Batalkan Validasi</button>
                                                            </form>
                                                        @endif
                                                        <button type="button" class="btn btn-raised btn-sm btn-info" data-toggle="modal" data-target="#modal-detail-{{ $item->id }}">
                                                                Detail
                                                        </button>
                                                    </td>
                                                </tr>

                                                <!-- MODAL -->
                                                <div class="modal fade" id="modal-detail-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Data Lengkap</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="col-md-4">NIK</div>
                                                                            <div class="col-md-8">: {{ $item->karyawan->nik }}</div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-4">Nama</div>
                                                                            <div class="col-md-8">: {{ $item->karyawan->nama }}</div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-4">Periode</div>
                                                                            <div class="col-md-8">: {{ $item->periode }}</div>
                                                                        </div><br>
                                                                        <div class="row">
                                                                            <div class="col-md-4">Penugasan (K1)</div>
                                                                            <div class="col-md-8">: {{ $item->nilai_penugasan }}</div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-4">Absensi (K2)</div>
                                                                            <div class="col-md-8">: {{ $item->nilai_absensi }}</div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-4">Surat Peringatan (K3)</div>
                                                                            <div class="col-md-8">: {{ $item->nilai_peringatan }}</div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-4">Nilai Evaluasi</div>
                                                                            <div class="col-md-8">: {{ $item->nilai_evaluasi }}</div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-4">Nilai Akhir (N)</div>
                                                                            <div class="col-md-8">: {{ $item->nilai_akhir }}</div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-4">Rekomendasi</div>
                                                                            <div class="col-md-8">: {{ $item->rekomendasi }}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-raised btn-danger ml-2" data-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end MODAL -->
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <footer class="footer">
                    © 2018 Urora by Mannatthemes.
                </footer>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.nicescroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables/jszip.min.js"></script>
    <script src="assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script src="assets/pages/datatables.init.js"></script>
    <script src="assets/js/app.js"></script>

    @Include('tools.scripttambahan')
</body>
</html>
