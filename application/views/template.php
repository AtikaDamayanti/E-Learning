<?php 
    $session = $this->session->userdata('isLogin');
    
    if($session == true){
        $nik = $_SESSION['nik'];
        $nama = $_SESSION['nama'];
    } else {
        Header('Location: ' . base_url() . 'index.php/login');
    }
?>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    
    <link rel="icon" type="image/png" href="<?php echo base_url()?>assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>E-Learning Krakatau Steel</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/fonts/material_font.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="<?php echo base_url()?>assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    
    <!-- Select2 -->
    <link href="<?php echo base_url()?>assets/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/select2/dist/css/select2-bootstrap.min.css" rel="stylesheet">
    <!-- Tags Input -->
    <link href="<?php echo base_url()?>assets/tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
    <!-- Date Time Picker -->
    <link href="<?php echo base_url()?>vendor/bootstrap/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <style type="text/css">
      .point-fit{
        width: 11%;
      }
      .no-fit{
        width: 1%;
        white-space: nowrap; 
      }

      .jawaban {
      display: block;
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 14px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    /* Hide the browser's default radio button */
    .jawaban input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
    }

    /* Create a custom radio button */
    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #eee;
      border-radius: 50%;
    }

    /* On mouse-over, add a grey background color */
    .jawaban:hover input ~ .checkmark {
      background-color: #ccc;
    }

    /* When the radio button is checked, add a blue background */
    .jawaban input:checked ~ .checkmark {
      background-color: #4473bf;
    }

    /* Create the indicator (the dot/circle - hidden when not checked) */
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }

    /* Show the indicator (dot/circle) when checked */
    .jawaban input:checked ~ .checkmark:after {
      display: block;
    }

    /* Style the indicator (dot/circle) */
    .jawaban .checkmark:after {
      top: 9px;
      left: 9px;
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: white;
    }

    
    </style>
    <!-- Jquery JS -->
    <script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
  </head>

  <body class="nav-md">
    <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo" style="text-align:center">
        <div class="text-muted logo-normal" >
          <img src="<?php echo base_url('assets/img/logox.png') ?>" width="80" height="70">
          <span class="h2">E-Learning</span><br>
          HC Development & Learning Center
        </div>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <?php if($nama == "Administrator") { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('dashboard') ?>">
              <i class="fa fa-dashboard"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('jadwal') ?>">
              <i class="fa fa-calendar"></i>
              <p>Jadwal</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('materi') ?>">
              <i class="fa fa-book"></i>
              <p>Materi</p>
            </a>
          </li>
          <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('dashboard') ?>">
              <i class="fa fa-dashboard"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>

          <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdownProfile">
                  <!-- <div class="dropdown-divider"></div> -->
                  <a class="dropdown-item" href="<?php echo site_url('login/logout')?>">Log out</a>
                </div>
              </li>

              <li class="nav-item">
                <?php echo "Welcome, ". $nama." | ".$nik; ?>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Header -->

      <!-- Start Content -->
      <div class="content">
        <div class="container-fluid">
        <?php echo $body; ?>
        </div>
      </div>
      <!-- End Content -->

      <!-- Start Footer -->
      <!-- <footer class="footer"> -->
        <div class="container-fluid">
          <div class="copyright float-left">
            &copy; <a target="_blank">Atika Rizky Damayanti</a> - 
            Management Trainee PT. Krakatau Steel (Persero) Tbk.
          </div>
        </div>
      <!-- </footer> -->
    </div>
  </div>
  
    

    <script type="text/javascript">
      $(document).ready(function(){
        $('select').select2({
            width: '100%',
            theme : 'bootstrap'
        });

        //$('#tanggal_mulai').datetimepicker({
        //  format : 'DD-MM-YYYY'
        //});
        //$('#tanggal_selesai').datetimepicker({
        //  format : 'DD-MM-YYYY'
        //});

        $('.nav .nav-item').click(function(){
          //alert('ck');
          //$('.nav .nav-item').removeClass('active');
          $(this).addClass('active');
        });
      })
    </script>

  <script src="<?php echo base_url()?>assets/js/core/jquery.min.js"></script>
  <script src="<?php echo base_url()?>assets/js/core/popper.min.js"></script>
  <script src="<?php echo base_url()?>assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="<?php echo base_url()?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="<?php echo base_url()?>assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="<?php echo base_url()?>assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="<?php echo base_url()?>assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="<?php echo base_url()?>assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="<?php echo base_url()?>assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="<?php echo base_url()?>assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="<?php echo base_url()?>assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="<?php echo base_url()?>assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="<?php echo base_url()?>assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="<?php echo base_url()?>assets/js/plugins/fullcalendar.min.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="<?php echo base_url()?>assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="<?php echo base_url()?>assets/js/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="<?php echo base_url()?>assets/js/plugins/arrive.min.js"></script>
  <!-- Chartist JS -->
  <script src="<?php echo base_url()?>assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="<?php echo base_url()?>assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?php echo base_url()?>assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
    <!-- tagsinput -->
    <!-- <script src="<?php echo base_url()?>/vendors/tagsinput/bootstrap-tagsinput.js"></script>
    // <script src="<?php echo base_url()?>/vendors/tagsinput/bootstrap3-typeahead.min.js"></script>-->
     <!-- Select2 -->
    <script src="<?php echo base_url()?>assets/select2/dist/js/select2.min.js"></script>
  </body>
</html>