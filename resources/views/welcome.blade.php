<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Minamas - Dashboard</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Mannatthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="assets/plugins/fullcalendar/vanillaCalendar.css"/>
        <link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css">
        <link rel="stylesheet" href="assets/plugins/chartist/css/chartist.min.css">
        <link rel="stylesheet" href="assets/plugins/morris/morris.css">
        <link rel="stylesheet" href="assets/plugins/metro/MetroJs.min.css">

        <link rel="stylesheet" href="assets/plugins/carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/plugins/carousel/owl.theme.default.min.css">

        <link rel="stylesheet" href="assets/plugins/animate/animate.css" type="text/css">
        <link rel="stylesheet" href="assets/css/bootstrap-material-design.min.css" type="text/css">
        <link rel="stylesheet" href="assets/css/icons.css" type="text/css">
        <link rel="stylesheet" href="assets/css/style.css" type="text/css">

        
        @include('tools.head')

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
            @include('tools.sidebar')
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    @include('tools.topbar')
                    <!-- Top Bar End -->

                    <div class="page-content-wrapper dashborad-v">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item active">Dashboard</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Dashboard</h4>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <!-- Column Karyawan -->
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <div class="card bg-info m-b-30">
                                        <div class="card-body">
                                            <div class="d-flex row">
                                                <div class="col-3 align-self-center">
                                                    <div class="round">
                                                        <i class="mdi mdi-account"></i> <!-- Ganti dengan simbol yang relevan -->
                                                    </div>
                                                </div>
                                                <div class="col-9 text-center ml-auto align-self-center">
                                                    <div class="m-l-10 text-white">
                                                        <h5 class="mt-0 round-inner">Karyawan</h5>
                                                        <p class="mb-0">{{$totalKaryawan}} Orang</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column Admin -->
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <div class="card bg-danger m-b-30">
                                        <div class="card-body">
                                            <div class="d-flex row">
                                                <div class="col-3 align-self-center">
                                                    <div class="round">
                                                        <i class="mdi mdi-account-key"></i> <!-- Ganti dengan simbol yang relevan -->
                                                    </div>
                                                </div>
                                                <div class="col-9 text-center ml-auto align-self-center">
                                                    <div class="m-l-10 text-white">
                                                        <h5 class="mt-0 round-inner">Admin</h5>
                                                        <p class="mb-0">{{$totalAdmin}} Orang</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column Penilai -->
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <div class="card bg-success m-b-30">
                                        <div class="card-body">
                                            <div class="d-flex row">
                                                <div class="col-3 align-self-center">
                                                    <div class="round">
                                                        <i class="mdi mdi-scale-balance"></i> <!-- Ganti dengan simbol yang relevan -->
                                                    </div>
                                                </div>
                                                <div class="col-9 text-center ml-auto align-self-center">
                                                    <div class="m-l-10 text-white">
                                                        <h5 class="mt-0 round-inner">Penilai</h5>
                                                        <p class="mb-0">{{$totalPenilai}} Orang</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xl-12">
                                    <div class="card m-b-30" style="height: 400px;"> <!-- Tinggi spesifik tanpa overflow -->
                                        <div class="card-body" style="text-align: center;">
                                            <img src="assets/images/minamas.png" alt="Welcome Image" style="width:10%; height:auto;">
                                            <h2>SELAMAT DATANG DI<h2>
                                            <h4>SISTEM PENILAIAN KINERJA KARYAWAN <BR> PT LANGGENG MUARA MAKMUR</h4>
                                            <div id="morris-area-chart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- container -->

                    </div>
                    <!-- Page content Wrapper -->
                </div>
                <!-- content -->

                <footer class="footer">
                    © 2018 Urora by Mannatthemes.
                </footer>

            </div>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->


        <!-- jQuery  -->
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


        <script src="assets/plugins/carousel/owl.carousel.min.js"></script>
        <script src="assets/plugins/fullcalendar/vanillaCalendar.js"></script>
        <script src="assets/plugins/peity/jquery.peity.min.js"></script>
        <script src="assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="assets/plugins/chartist/js/chartist.min.js"></script>
        <script src="assets/plugins/chartist/js/chartist-plugin-tooltip.min.js"></script>
        <script src="assets/plugins/metro/MetroJs.min.js"></script>
        <script src="assets/plugins/raphael/raphael.min.js"></script>
        <script src="assets/plugins/morris/morris.min.js"></script>
        <script src="assets/pages/dashborad.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
       
    </body>

</html>