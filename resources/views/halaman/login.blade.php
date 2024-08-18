<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Minamas - Login</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap-material-design.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">

    <!-- Inline Styles -->
    <style>
        .login-title {
            font-size: 24px;
            font-weight: bold;
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<!-- Begin page -->
<div class="accountbg"></div>
<div class="wrapper-page">
    <div class="display-table">
        <div class="display-table-cell">
            <diV class="container">
                <div class="row">
                    <div class="col-md-6">
                        <img src="assets/images/extra.png" alt="" class="img-fluid">
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center pt-3">
                                    <div class="login-title">LANTING ESTATE</div>
                                </div>
                                <div class="px-3 pb-3">
                                    <form class="form-horizontal m-t-20 mb-0" action="{{ url('post-login') }}" method="post">
                                    {{ csrf_field() }}
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input class="form-control" type="email" required="" id="email" name="email" placeholder="Email">
                                            </div>
                                        </div>
                
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input class="form-control" type="password" required="" id="password" name="password" placeholder="Password">
                                            </div>
                                        </div>
                
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <div class="custom-control custom-checkbox">
                                                </div>
                                            </div>
                                        </div>
                
                                        <div class="form-group text-right row m-t-20">
                                            <div class="col-12">
                                                <button class="btn btn-primary btn-raised btn-block waves-effect waves-light" type="submit">Log In</button>
                                            </div>
                                        </div>
                
                                        <div class="form-group m-t-10 mb-0 row">
                                            
                                        </div>
                                    </form>
                                </div>
                
                            </div>
                        </div>
                    </div>
                   
                </div>
            </diV>
        </div>
    </div>
</div>

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

<!-- App js -->
<script src="assets/js/app.js"></script>

</body>
</html>
