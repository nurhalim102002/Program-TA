<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Minamas - Form Penilaian</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/plugins/timepicker/tempusdominus-bootstrap-4.css" rel="stylesheet" />
    <link href="assets/plugins/timepicker/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <link href="assets/plugins/clockpicker/jquery-clockpicker.min.css" rel="stylesheet" />
    <link href="assets/plugins/colorpicker/asColorPicker.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" /> 
    <link href="assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap-material-design.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    
    <style>
        .input-group-text {
            white-space: nowrap;
        }
        .absensi-input {
            width: 80px; /* Adjust the width as needed */
        }
    </style>
</head>

<body class="fixed-left">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        @include('tools.sidebar2')
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <!-- Top Bar Start -->
                @include('tools.topbar')
                <!-- Top Bar End -->

                <!-- Page content Wrapper -->
                <div class="page-content-wrapper">
                    <div class="container-fluid">
                        <!-- Page title and breadcrumb -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <div class="btn-group float-right">
                                        <ol class="breadcrumb hide-phone p-0 m-0">
                                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Form Penilaian</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Form Penilaian</h4>
                                </div>
                            </div>
                        </div>

                        <!-- Form Start -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card m-b-30">
                                    <div class="card-body bootstrap-select-1">
                                        <h4 class="header-title mt-0">Formulir Penilaian Karyawan</h4>
                                        <p class="text-muted font-14">-</p>
                                        <!-- Tempatkan ini di dalam file view di mana form Anda berada -->
                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                        <form action="{{ url('simpannilai')}}" method="POST">
                                            {{ csrf_field() }}
                                            <div class="row form-material">
                                                <div class="col-md-12">
                                                    <h6 class="text-muted">Periode Penilaian</h6>
                                                    <select class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;" id="periode" name="periode">
                                                        <option selected disabled>Pilih</option>
                                                        <option value="2021">2021</option>
                                                        <option value="2022">2022</option>
                                                        <option value="2023">2023</option>
                                                        <option value="2024">2024</option>
                                                        <option value="2025">2025</option>
                                                        <option value="2026">2026</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 class="text-muted">Nama</h6>
                                                    <select class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;" id="id_karyawan" name="id_karyawan">
                                                        <option selected disabled>Pilih Nama Karyawan</option>
                                                        @foreach($kry as $item)
                                                            @if($item->jabatan->jabatan !== 'Manager' && $item->jabatan->jabatan !== 'Asisten')
                                                                <option value="{{ $item->id }}" data-nik="{{ $item->nik }}">{{ $item->nama }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 class="text-muted">NIK</h6>
                                                    <input class="form-control" id="nik" name="nik" readonly>
                                                </div>
                                                <div class="col-md-12">
                                                    <br>
                                                    <h4 class="header-title mt-0">Riwayat Penugasan</h4>
                                                    <h6 class="text-muted">Jumlah Penugasan</h6>
                                                    <input type="text" class="form-control" id="jumlah_penugasan" name="jumlah_penugasan" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <br>
                                                    <h4 class="header-title mt-0">Absensi</h4>
                                                    <h6 class="text-muted">Mangkir</h6>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control absensi-input" id="mangkir" name="mangkir" readonly>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">hari</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <br><br>
                                                    <h6 class="text-muted">Izin / P1</h6>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control absensi-input" id="izin_p1" name="izin_p1" readonly>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">hari</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <br>
                                                    <h4 class="header-title mt-0">Surat Peringatan</h4>
                                                    <h6 class="text-muted">SP Ke -</h6>
                                                    <input type="text" class="form-control" id="sp_ke" name="sp_ke" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <br>
                                                    <h4 class="header-title mt-0">Nilai Evaluasi</h4>
                                                    <h6 class="text-muted">Kemampuan</h6>
                                                    <input type="text" class="form-control nilai" id="kemampuan" name="kemampuan">
                                                    <h6 class="text-muted mt-3">Tanggung Jawab</h6>
                                                    <input type="text" id="tanggung_jawab" class="form-control nilai" name="tanggung_jawab">
                                                    <h6 class="text-muted">Prestasi Kerja</h6>
                                                    <input type="text" class="form-control nilai" id="prestasi_kerja" name="prestasi_kerja">
                                                    <h6 class="text-muted mt-3">Kejujuran</h6>
                                                    <input type="text" id="kejujuran" class="form-control nilai" name="kejujuran">
                                                </div>
                                                <div class="col-md-6">
                                                    <br><br>
                                                    <h6 class="text-muted">Disiplin</h6>
                                                    <input type="text" class="form-control nilai" id="disiplin" name="disiplin">
                                                    <h6 class="text-muted mt-3">Loyalitas</h6>
                                                    <input type="text" id="loyalitas" class="form-control nilai" name="loyalitas">
                                                    <h6 class="text-muted">Kerja Keras</h6>
                                                    <input type="text" class="form-control nilai" id="kerja_keras" name="kerja_keras">
                                                    <h6 class="text-muted mt-3">Rasa Memiliki</h6>
                                                    <input type="text" id="rasa_memiliki" class="form-control nilai" name="rasa_memiliki">
                                                    <!-- Input untuk menampilkan nilai rata-rata -->
                                                    <h6 class="text-muted mt-3">Nilai Rata-Rata</h6>
                                                    <p id="nilai_rata_rata_display" class="form-control-static">0.00</p>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-raised mb-0">Submit</button>
                                            <button type="button" class="btn btn-raised btn-danger mb-0">Cancel</button>
                                        </form>
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

    <!-- jQuery and JS Bundle -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap-material-design.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.nicescroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/plugins/timepicker/moment.js"></script>
    <script src="assets/plugins/timepicker/tempusdominus-bootstrap-4.js"></script>
    <script src="assets/plugins/timepicker/bootstrap-material-datetimepicker.js"></script>
    <script src="assets/plugins/clockpicker/jquery-clockpicker.min.js"></script>
    <script src="assets/plugins/colorpicker/jquery-asColor.js"></script>
    <script src="assets/plugins/colorpicker/jquery-asGradient.js"></script>
    <script src="assets/plugins/colorpicker/jquery-asColorPicker.min.js"></script>
    <script src="assets/plugins/select2/select2.min.js"></script>
    <script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/pages/form-advanced.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
        $(document).ready(function() {
            // Menambahkan event listener untuk setiap input dengan class 'nilai'
            $('.nilai').on('input', function() {
                var total = 0;
                var count = 0;

                // Menghitung total nilai yang diinputkan
                $('.nilai').each(function() {
                    var value = parseFloat($(this).val());
                    if (!isNaN(value)) {
                        total += value;
                        count++;
                    }
                });

                // Menghitung nilai rata-rata
                var average = total / count;

                // Menampilkan nilai rata-rata secara langsung di halaman
                $('#nilai_rata_rata_display').text(average.toFixed(2)); // Menampilkan nilai rata-rata di elemen dengan id 'nilai_rata_rata_display'
            });

            $('#id_karyawan').change(function() {
                var nik = $(this).find(':selected').data('nik');
                $('#nik').val(nik);

                // Fetch data related to the selected employee
                var karyawanId = $(this).val();
                if(karyawanId) {
                    $.ajax({
                        url: `/karyawan/data/${karyawanId}`,
                        method: 'GET',
                        success: function(data) {
                            console.log(data); // Tambahkan log untuk debugging
                            // Set nilai jumlah penugasan
                            $('#jumlah_penugasan').val(data.penugasan.length ? data.penugasan.length : 0);
                            // Set nilai mangkir
                            $('#mangkir').val(data.absensi ? data.absensi.mangkir : 0);
                            // Set nilai izin/p1
                            $('#izin_p1').val(data.absensi ? data.absensi.izin_p1 : 0);
                            // Set nilai SP ke-
                            $('#sp_ke').val(data.speringatan ? data.speringatan.sp_ke : 0);
                        },
                        error: function(error) {
                            console.error('Error fetching data:', error);
                            // Tambahkan penanganan kesalahan sesuai kebutuhan Anda
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
