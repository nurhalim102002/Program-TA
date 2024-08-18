<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Urora - Tambah Data Admin</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Plugins css -->
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
</head>

<body class="fixed-left">

    <!-- Loader -->
    <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        @include('tools.sidebar')
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <!-- Top Bar Start -->
                @include('tools.topbar')
                <!-- Top Bar End -->

                <div class="page-content-wrapper ">
                    <div class="container-fluid">

                        <!-- Form Starts Here -->
                        
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item"><a href="/">Minamas</a></li>
                                                <li class="breadcrumb-item"><a href="{{url('dataadmin')}}">Data Admin</a></li>
                                                <li class="breadcrumb-item active">Tambah Data</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Form Tambah Data</h4>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!-- end page title end breadcrumb -->

                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card m-b-30">
                                        <div class="card-body bootstrap-select-1">
                                            <h4 class="header-title mt-0">Form Tambah Data Admin</h4>
                                            <p class="text-muted font-14">Silahkan input Data Admin dengan benar!!</p>                                        
                                            <form action="{{ url('simpanadmin') }}" method="POST">
                                            {{ csrf_field() }}
                                                <div class="row form-material">
                                                    <div class="col-md-12">
                                                        <h6 class="text-muted">Nama</h6>
                                                        <select class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;" id="id_karyawan" name="id_karyawan" onchange="updateJabatan()">
                                                            <option selected disabled>Pilih Nama Karyawan</option>
                                                            @foreach($kry as $item)
                                                                <option value="{{$item->id}}" data-jabatan-id="{{ optional($item->jabatan)->id }}" data-jabatan="{{ optional($item->jabatan)->jabatan }}">{{$item->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-material">
                                                    <div class="col-md-12">
                                                        <h6 class="text-muted">Jabatan</h6>
                                                        <select class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;" id="id_jabatan" name="id_jabatan">
                                                            <!-- Terisi Otomatis -->
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-material">
                                                    <div class="col-md-12">
                                                        <h6 class="text-muted">Level</h6>
                                                        <select class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;" id="level" name="level">
                                                            <option selected disabled>Pilih Level</option>
                                                            <option value="Admin">Admin</option>
                                                            <option value="Penilai">Penilai</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-material">
                                                    <div class="col-md-12">
                                                        <h6 class="text-muted">Email</h6>
                                                        <input type="email" class="form-control" placeholder="Email" id="email" name="email">
                                                    </div>
                                                </div>
                                                <div class="row form-material">
                                                    <div class="col-md-12">
                                                        <h6 class="text-muted">Password</h6>
                                                        <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                                                    </div>
                                                </div>
                                                <br>
                                                <br>
                                                <button type="submit" class="btn btn-primary btn-raised mb-0">Submit</button>
                                                <button type="button" class="btn btn-raised btn-danger mb-0">Cancel</button>                  
                                            </form>
                                        </div>
                                    </div>       
                                </div>
                            </div><!-- end row -->
                        
                        <!-- Form Ends Here -->
                    </div><!-- container -->

                </div> <!-- Page content Wrapper -->

            </div> <!-- content -->

            <footer class="footer">
                © 2018 Urora by Mannatthemes.
            </footer>

        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->

    <!-- jQuery -->
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

    <!-- Plugins js -->
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

    <!-- Plugins Init js -->
    <script src="assets/pages/form-advanced.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <script>
        function updateJabatan() {
            var karyawanSelect = document.getElementById('id_karyawan');
            var jabatanSelect = document.getElementById('id_jabatan');
            var selectedOption = karyawanSelect.options[karyawanSelect.selectedIndex];
            var jabatanId = selectedOption.getAttribute('data-jabatan-id'); // Dapatkan id_jabatan dari data atribut
            var jabatan = selectedOption.getAttribute('data-jabatan');

            jabatanSelect.innerHTML = ''; // Hapus opsi yang ada
            var newOption = document.createElement('option');
            newOption.value = jabatanId; // Gunakan id_jabatan yang benar
            newOption.text = jabatan || 'Tidak ada jabatan'; // Tampilkan 'Tidak ada jabatan' jika null
            jabatanSelect.appendChild(newOption);
        }
    </script>
</body>
</html>
