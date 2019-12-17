<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title><?= $judul ?></title>
    <link href="<?= base_url() ?>assets/template/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="<?= base_url() ?>assets/template/css/animate.css" rel="stylesheet">
    <!-- ===== Custom CSS ===== -->
    <link href="<?= base_url() ?>assets/template/css/style.css" rel="stylesheet">
    <!-- ===== Color CSS ===== -->
    <link href="<?= base_url() ?>assets/template/css/colors/default.css" id="theme" rel="stylesheet">
    <script src="<?= base_url() ?>assets/template/plugins/components/jquery/dist/jquery.min.js"></script> 
    <script type="text/javascript">
        function base_url(){
            return '<?= base_url() ?>';
        }
    </script>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template/css/sweet-alert.css">
   <script src="<?= base_url() ?>assets/template/js/sweet-alert.js"></script>
    <script src="<?= base_url() ?>assets/template/js/login.js"></script>
  
</head>

<body class="mini-sidebar">
   <!-- Preloader -->
   <div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
    <div class="login-box">
       <?php
       $stat= isset($_GET['stat']) ? $_GET['stat'] : '';
       if ($stat == 1) {
         echo "<div class='alert alert-info'>Anda Berhasil Keluar Silahkan Login Untuk Melanjut kan kembali</div>"; 
     }else{

     }
 
     ?>
     <div class="white-box">
        <form id="clogin" class="form-horizontal form-material">
            <h3 class="box-title m-b-20">Aplikasi Notulen</h3>
            <b><small>Pencatatan data elektronik</small></b>
            <br /><br />
            <div class="form-group ">
                <div class="col-xs-12">
                    <input name="username" class="form-control" type="text" required="" placeholder="Username">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input name="password" class="form-control" type="password" required="" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                         <!--    <div class="checkbox checkbox-primary pull-left p-t-0">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup"> Remember me </label>
                            </div> -->
                            <!--  <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a>  --></div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>

                            </div>

                        </div>
                        <center> <font color="black">&copy; 2019 By Design 
                      <!--   <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                                <div class="social">
                                    <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a>
                                    <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a>
                                </div>
                            </div>
                        </div> -->

                    </form>
                    <div id="notifikasi"></div>
                    <form class="form-horizontal" id="recoverform" action="http://jthemes.org/demo-admin/cubic/cubic-html/index.html">
     
                       <!--  <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                            </div> -->
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- jQuery -->

        <!-- Bootstrap Core JavaScript -->
        <script src="<?= base_url() ?>assets/template/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- Menu Plugin JavaScript -->
        <script src="<?= base_url() ?>assets/template/js/sidebarmenu.js"></script>
        <!--slimscroll JavaScript -->
        <script src="<?= base_url() ?>assets/template/js/jquery.slimscroll.js"></script>
        <!--Wave Effects -->
        <script src="<?= base_url() ?>assets/template/js/waves.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?= base_url() ?>assets/template/js/custom.js"></script>
        <!--Style Switcher -->
        <script src="<?= base_url() ?>assets/template/plugins/components/styleswitcher/jQuery.style.switcher.js"></script>
    </body> 
    </html>
