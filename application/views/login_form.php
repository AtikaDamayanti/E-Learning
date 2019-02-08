<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>vendor/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>vendor/fonts/iconic/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>vendor/css/util.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>vendor/css/main.css">

</head>
<body>
  
  <div class="limiter">
    <div class="container-login100" style="background-image: url('<?php echo base_url() ?>assets/img/coil2.jpg');">
      <div class="wrap-login100">
        <form class="login100-form validate-form" method="post" action="<?php echo site_url('login/do_login')?>">
          <span class="login100-form-logo">
            <i class="zmdi zmdi-landscape"></i>
          </span>

          <span class="login100-form-title p-b-34 p-t-27">
            Log in
          </span>

          <div class="wrap-input100 validate-input" data-validate = "Enter username">
            <input class="input100" type="text" name="email" placeholder="Username">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Enter password">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100" data-placeholder="&#xf191;"></span>
          </div>

          <div class="container-login100-form-btn">
            <button class="login100-form-btn">
              Login
            </button>
          </div>

          <div class="text-center p-t-90">
            <a class="txt1" href="#">
              Forgot Password?
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
  

  <div id="dropDownSelect1"></div>
  

  <script src="<?php echo base_url() ?>vendor/jquery/jquery-3.2.1.min.js"></script>
  <script src="<?php echo base_url() ?>vendor/bootstrap/js/popper.js"></script>
  <script src="<?php echo base_url() ?>vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>vendor/js/main.js"></script>

</body>
</html>