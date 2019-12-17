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
    <!-- ===== Bootstrap CSS ===== -->
    <link href="<?= base_url() ?>assets/template/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/template/plugins/components/morrisjs/morris.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/template/plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
     
    <link href="<?= base_url() ?>assets/template/css/animate.css" rel="stylesheet">
    <!-- ===== Custom CSS ===== -->
    <link href="<?= base_url() ?>assets/template/css/style.css" rel="stylesheet">
    <!-- ===== Color CSS ===== -->
    <link href="<?= base_url() ?>assets/template/css/colors/default.css" id="theme" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template/css/sweet-alert.css">
    <script src="<?= base_url() ?>assets/template/plugins/components/jquery/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timer.jquery/0.7.0/timer.jquery.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>assets/template/css/bootstrap-timepicker.min.css"> 
    <script src="<?= base_url() ?>/assets/template/js/bootstrap-timepicker.min.js"></script>  
    <link href="<?= base_url() ?>/assets/template/plugins/components/morrisjs/morris.css" rel="stylesheet"> 
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?= base_url() ?>assets/template/https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="<?= base_url() ?>assets/template/https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->  

    <link href="<?= base_url() ?>/assets/template/plugins/components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" /> 
</head>

<style type="text/css">
    #goog-gt-tt {display:none !important;}
    .goog-te-banner-frame {display:none !important;}
    .goog-te-menu-value:hover {text-decoration:none !important;}
    .goog-text-highlight {background-color:transparent !important;box-shadow:none !important;}
    body {top:0 !important;}
    #google_translate_element2 {display:none!important;}
</style>

<div id="google_translate_element2"></div>
<script type="text/javascript">
    function googleTranslateElementInit2() {new google.translate.TranslateElement({pageLanguage: 'id',autoDisplay: false}, 'google_translate_element2');}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>


<script type="text/javascript">
    function GTranslateGetCurrentLang() {var keyValue = document['cookie'].match('(^|;) ?googtrans=([^;]*)(;|$)');return keyValue ? keyValue[2].split('/')[2] : null;}
    function GTranslateFireEvent(element,event){try{if(document.createEventObject){var evt=document.createEventObject();element.fireEvent('on'+event,evt)}else{var evt=document.createEvent('HTMLEvents');evt.initEvent(event,true,true);element.dispatchEvent(evt)}}catch(e){}}
    function doGTranslate(lang_pair){if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];if(GTranslateGetCurrentLang() == null && lang == lang_pair.split('|')[0])return;var teCombo;var sel=document.getElementsByTagName('select');for(var i=0;i<sel.length;i++)if(/goog-te-combo/.test(sel[i].className)){teCombo=sel[i];break;}if(document.getElementById('google_translate_element2')==null||document.getElementById('google_translate_element2').innerHTML.length==0||teCombo.length==0||teCombo.innerHTML.length==0){setTimeout(function(){doGTranslate(lang_pair)},500)}else{teCombo.value=lang;GTranslateFireEvent(teCombo,'change');GTranslateFireEvent(teCombo,'change')}}
</script>

<body class="mini-sidebar">
    <!-- ===== Main-Wrapper ===== -->
    <div id="wrapper">
      <!--   <div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div> -->
        <!-- ===== Top-Navigation ===== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <a class="navbar-toggle font-20 hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="top-left-part">
                    
                </div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li>
                        <a href="javascript:void(0)" class="sidebartoggler font-20 waves-effect waves-light"><i class="icon-arrow-left-circle"></i></a>
                    </li>
                 </ul>
  
                <ul class="nav navbar-top-links navbar-right pull-right">

                      <li class="dropdown">
                        <a  id="notifikasi_not" class="dropdown-toggle waves-effect waves-light font-20" data-toggle="dropdown" href="javascript:void(0);">
                            <i class="icon-speech"></i>
                            <span class="badge badge-xs badge-danger"><div id="notifikasi"></div></span>
                        </a>
                        <ul class="dropdown-menu mailbox animated bounceInDown">
                            <li>
                                <div class="drop-title">Data Notulen yang open.</div>
                            </li>
                            
                           <div id="data_notulen_list"></div>
                         </ul>
                    </li>


                    <li class="dropdown"> 
                        <a href="javascript:void(0);" onclick="doGTranslate('id|id');return false;" title="Indonesian" class="gflag nturl dropdown-toggle waves-effect waves-light font-20" data-toggle="dropdown" href="javascript:void(0);">
                         <img src="<?= base_url('assets/template/plugins/images/id.png') ?>">
                     </a> 
                 </li>
                 <li class="dropdown"> 
                   <a href="javascript:void(0);" onclick="doGTranslate('id|en');return false;" title="English" class="gflag nturl dropdown-toggle waves-effect waves-light font-20" data-toggle="dropdown" href="javascript:void(0);">
                     <img src="<?= base_url('assets/template/plugins/images/en.png') ?>">
                 </a>
             </li>
             
         </ul>
     </div>
 </nav>
 
 <?php $data=$this->db->get_where('login',array('id_user'=>$this->session->id_user))->row_array(); ?>
 <aside class="sidebar">
    <div class="scroll-sidebar">
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                <div class="profile-image">
                    <img src="<?= base_url('assets/img/foto/'.$data['foto']) ?>" alt="user-img" class="img-circle" id="image_2" onerror="this.src='<?= base_url('assets/img/no_image.jpg') ?>';">
                    <a href="javascript:void(0);" class="dropdown-toggle u-dropdown text-blue" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="badge badge-danger">
                            <i class="fa fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated flipInY">
                        <li><a href="<?= base_url('profile') ?>"><i class="fa fa-user"></i> Profile</a></li>
                        <li><a href="javascript:void(0);"><i class="fa fa-inbox"></i> Inbox</a></li>
                        <li role="separator" class="divider"></li>
                        
                        <li><a href="<?= base_url('logout') ?>"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                </div>
                <p class="profile-text m-t-15 font-16"><a href="javascript:void(0);"> <?= ucfirst($data['nama']) ?></a></p>
            </div>
        </div>
        <nav class="sidebar-nav"> 
           <?= main_menu('Bottom',$this->session->level) ?>
       </nav>
       
   </div>
</aside>
<!-- ===== Left-Sidebar-End ===== -->
<!-- ===== Page-Content ===== -->
<div class="page-wrapper">
            <!-- <div class="row m-0">
                <div class="col-md-3 col-sm-6 info-box">
                    <div class="media">
                        <div class="media-left">
                            <span class="icoleaf bg-primary text-white"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span>
                        </div>
                        <div class="media-body">
                            <h3 class="info-count text-blue">154</h3>
                            <p class="info-text font-12">Bookings</p>
                            <span class="hr-line"></span>
                            <p class="info-ot font-15">Target<span class="label label-rounded label-success">300</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 info-box">
                    <div class="media">
                        <div class="media-left">
                            <span class="icoleaf bg-primary text-white"><i class="mdi mdi-comment-text-outline"></i></span>
                        </div>
                        <div class="media-body">
                            <h3 class="info-count text-blue">68</h3>
                            <p class="info-text font-12">Complaints</p>
                            <span class="hr-line"></span>
                            <p class="info-ot font-15">Total Pending<span class="label label-rounded label-danger">154</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 info-box">
                    <div class="media">
                        <div class="media-left">
                            <span class="icoleaf bg-primary text-white"><i class="mdi mdi-coin"></i></span>
                        </div>
                        <div class="media-body">
                            <h3 class="info-count text-blue">&#36;9475</h3>
                            <p class="info-text font-12">Earning</p>
                            <span class="hr-line"></span>
                            <p class="info-ot font-15">March : <span class="text-blue font-semibold">&#36;514578</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 info-box b-r-0">
                    <div class="media">
                        <div class="media-left p-r-5">
                            <div id="earning" class="e" data-percent="60">
                                <div id="pending" class="p" data-percent="55"></div>
                                <div id="booking" class="b" data-percent="50"></div>
                            </div>
                        </div>
                        <div class="media-body">
                            <h2 class="text-blue font-22 m-t-0">Report</h2>
                            <ul class="p-0 m-b-20">
                                <li><i class="fa fa-circle m-r-5 text-primary"></i>60% Earnings</li>
                                <li><i class="fa fa-circle m-r-5 text-primary"></i>55% Pending</li>
                                <li><i class="fa fa-circle m-r-5 text-info"></i>50% Bookings</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- ===== Page-Container ===== -->
            <div class="container-fluid"><?= $contents ?>
        </div>
        <!-- ===== Page-Container-End ===== -->
        
    </div>
    <!-- ===== Page-Content-End ===== -->
</div>
<!-- ===== Main-Wrapper-End ===== -->
    <!-- ==============================
        Required JS Files
        =============================== -->
        <!-- ===== jQuery ===== -->

        <!-- ===== Bootstrap JavaScript ===== -->
        <script type="text/javascript">
          
             $(function(){  
               var reload = 'yes';   
              $.post('<?= base_url('notulen/get_notify') ?>',{reload : reload },function(respond){
                $('#notifikasi').html(respond);
              }); 

           $('#notifikasi_not').click(function(){
               var ket = 'yes';
               $.ajax ({
                url : '<?= base_url('notulen_detail/get_list_not') ?>',
                data :'ket='+ket,
                type  :'post',
                dataType :'html',
                chache:false,     
                success:function(respond){
                 $('#data_notulen_list').html(respond);
                },error:function(respond){
                    swal('error','server not respond','error');
                }              
 
               }); 
           }); 
         });
          
        </script>




        <script src="<?= base_url() ?>assets/template/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?= base_url() ?>/assets/template/plugins/components/raphael/raphael-min.js"></script>
        <script src="<?= base_url() ?>/assets/template/plugins/components/morrisjs/morris.js"></script>
        <!-- ===== Slimscroll JavaScript ===== -->
        <script src="<?= base_url() ?>assets/template/js/jquery.slimscroll.js"></script>
        <!-- ===== Wave Effects JavaScript ===== -->
        <script src="<?= base_url() ?>assets/template/js/waves.js"></script>
        <!-- ===== Menu Plugin JavaScript ===== -->
        <script src="<?= base_url() ?>assets/template/js/sidebarmenu.js"></script>
        <!-- ===== Custom JavaScript ===== -->
        <script src="<?= base_url() ?>assets/template/js/custom.js"></script>
        <!-- ===== Plugin JS ===== -->
        <script src="<?= base_url() ?>assets/template/js/sweet-alert.js"></script>
        <!-- ===== Style Switcher JS ===== -->

          <script src="<?= base_url() ?>/assets/template/plugins/components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

        <script src="<?= base_url() ?>assets/template/plugins/components/styleswitcher/jQuery.style.switcher.js"></script>  
        <!-- datatable -->
        <script src="<?= base_url() ?>assets/template/plugins/components/datatables/jquery.dataTables.min.js"></script>

        <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script> 
        <script src="<?= base_url('assets/template') ?>/plugins/components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
          
    </body>

    
    </html>
