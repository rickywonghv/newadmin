<?php
  session_start();
  include "asset/php/loginfunction.php";
  check();



?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MusixCloud | Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="asset/fontawesome/css/font-awesome.css">
    <!-- Ionicons -->
    <!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
    <!-- Theme style -->
    <link rel="stylesheet" href="asset/css/login.css">
    <!-- jQuery 2.1.4 -->
    <script src="asset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://www.google.com/jsapi"></script>
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="favicon.ico" rel="icon" type="image/x-icon" />
    <style media="screen">
      .expmodalbody{
        font-style: normal;
        align-content: center;
        text-align: center;
      }
      #message{
        padding-top: 5px;
        margin-top: 5px;
        text-align: center;
      }
    </style>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#username").focus();
      });
    </script>


  </head>
  <body class="hold-transition login-page">

    <div class="login-box">
      <div class="login-logo">
        <b>MusixCloud</b>Admin Panel
      </div>
      <div class="login-box-body">
        <p class="login-box-msg">Login to manage MusixCloud</p>
        <form method="post" id="loginform" action="asset/php/cklogin.php?act=login">
          <div class="form-group has-feedback">
            <div class="input-group">
              <span class="input-group-addon"><span class="fa fa-user"></span><span class="hidden-xs"> Username</span></span>
              <input type="text" class="form-control" placeholder="Username" id="username" name="username">
            </div>
          </div>
          <div class="form-group has-feedback">
            <div class="input-group">
            <span class="input-group-addon"><span class="fa fa-lock"></span><span class="hidden-xs"> Password</span></span>
            <input type="password" class="form-control" placeholder="Password" id="pwd" name="pwd">
          </div>
          </div>
          <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12" style="margin:auto,padding:auto">
              <div class="g-recaptcha" data-sitekey="6Ld5dRoTAAAAAHV-fyiGpdZbWg5okdZZKUe69A8_"></div>
          </div>
            <div class="col-xs-12">
              <button type="submit" id="loginbtn" name="loginbtn" class="btn btn-primary btn-block btn-flat">Login</button>
            </div>

            <div class="col-xs-12">
              <div class="" id="message">
                <?php
                  if(isset($_GET['error'])){
                    if($_GET['error']=="block"){
                      echo '<div class="alert alert-danger"><strong>Error!</strong>Your account has been blocked! </div>';
                    }elseif ($_GET['error']=="noact") {
                      echo '<div class="alert alert-warning"><strong>Error!</strong>Your email did not activate! Please activate before login.</div>';
                    }elseif($_GET['error']=="wrong"){
                      echo '<div class="alert alert-warning"><strong>Error!</strong>Wrong Username or Password</div>';
                    }elseif($_GET['error']=="gcaperror"){
                      echo '<div class="alert alert-warning"><strong>Error!</strong>Please Check to reCAPTCHA</div>';
                    }elseif($_GET['act']=="loginfrom"){
                      echo '<div class="alert alert-warning"><strong><i class="fa fa-user"></i></strong> Your account login from other way! Session Invalid </div>';
                    }
                  }
                 ?>
              </div>
            </div>
          </div>
        </form>
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=zh-hk" async defer>    </script>

        <a href="#">I forgot my password</a><br>
      </div>
    </div>
    <div class="modal fade" id="expiremodal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body" style="background:#f56954">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="expmodalbody">
              <i class="fa fa-clock-o"></i> Session Expired! Please login again.
            </div>

          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
    var verifyCallback = function(response) {
            alert(response);
          };
    </script>
  </body>
</html>
