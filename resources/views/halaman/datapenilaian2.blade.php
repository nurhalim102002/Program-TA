<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Minamas - Data Penilaian</title>
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
                                    <h4 class="page-title">Data Penilaian</h4>
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
                                        </div>

                                        <table id="datatable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th> NIK </th>
                                                    <th> Nama </th>
                                                    <th> Periode </th>
                                                    <th> Nilai Rata-rata </th>
                                                    <th style="width: 150px;"> Aksi </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($rasio as $item)
                                                <tr>
                                                    <td>{{ $item->karyawan->nik ?? 'N/A' }}</td>
                                                    <td>{{ $item->karyawan->nama ?? 'N/A' }}</td>
                                                    <td>{{ $item->periode }}</td>
                                                    <td>{{ $item->rata_rata }}</td>
                                                    <td>
                                                        
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
                                                                            <div class="col-md-4">Kemampuan</div>
                                                                            <div class="col-md-8">: {{ $item->kemampuan }}</div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-4">Tanggung Jawab</div>
                                                                            <div class="col-md-8">: {{ $item->tanggung_jawab }}</div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-4">Prestasi Kerja</div>
                                                                            <div class="col-md-8">: {{ $item->prestasi_kerja }}</div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-4">Kejujuran</div>
                                                                            <div class="col-md-8">: {{ $item->kejujuran }}</div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-4">Disiplin</div>
                                                                            <div class="col-md-8">: {{ $item->disiplin }}</div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-4">Loyalitas</div>
                                                                            <div class="col-md-8">: {{ $item->loyalitas }}</div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-4">Kerja Keras</div>
                                                                            <div class="col-md-8">: {{ $item->kerja_keras }}</div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-4">Rasa Memiliki</div>
                                                                            <div class="col-md-8">: {{ $item->rasa_memiliki }}</div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-4">Nilai Rata-rata</div>
                                                                            <div class="col-md-8">: {{ $item->rata_rata }}</div>
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

    @include('tools.scripttambahan')
</body>
</html>
