<?php
$code=$_GET['code'];
if($code!=""){
  require_once "asset/php/musixcloudadmin.php";
  $act=new admin;
  $act->actadmin($code);
}elseif (!isset($_GET['code'])) {
  if($_GET['act']=="invalid"){
    echo '<!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>MusixCloud | Activate Email</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="https://admin.musixcloud.xyz/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://admin.musixcloud.xyz/asset/fontawesome/css/font-awesome.css">
        <!-- Ionicons -->
        <!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
        <!-- Theme style -->
        <link rel="stylesheet" href="https://admin.musixcloud.xyz/asset/css/login.css">
        <!-- jQuery 2.1.4 -->
        <script src="https://admin.musixcloud.xyz/asset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="https://admin.musixcloud.xyz/bootstrap/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="https://admin.musixcloud.xyz/asset/js/login.js" charset="utf-8"></script>
        <script src="https://www.google.com/jsapi"></script>
        <link rel="stylesheet" href="https://admin.musixcloud.xyz/dist/css/AdminLTE.min.css">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
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
      </head>
      <body class="hold-transition login-page">
        <div class="login-box">
          <div class="login-logo">
            <b>MusixCloud</b>Admin Panel
          </div>
          <div class="login-box-body">
            <p class="login-box-msg"><h3 align="center">Sorry! Invalid activate token!</h3> </p>
            <p>
              Reason: Your account has been activate or Invalid activate token.
            </p>
            <a href="https://admin.musixcloud.xyz/login.php"><i class="fa fa-sign-in"></i> Back to login page.</a>

          </div>
        </div>
      </body>
    </html>';
  }elseif($_GET['act']=="success"){
    echo '<!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>MusixCloud | Activate Email</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="https://admin.musixcloud.xyz/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://admin.musixcloud.xyz/asset/fontawesome/css/font-awesome.css">
        <!-- Ionicons -->
        <!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
        <!-- Theme style -->
        <link rel="stylesheet" href="https://admin.musixcloud.xyz/asset/css/login.css">
        <!-- jQuery 2.1.4 -->
        <script src="https://admin.musixcloud.xyz/asset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="https://admin.musixcloud.xyz/bootstrap/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="https://admin.musixcloud.xyz/asset/js/login.js" charset="utf-8"></script>
        <script src="https://www.google.com/jsapi"></script>
        <link rel="stylesheet" href="https://admin.musixcloud.xyz/dist/css/AdminLTE.min.css">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
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
      </head>
      <body class="hold-transition login-page">
        <div class="login-box">
          <div class="login-logo">
            <b>MusixCloud</b>Admin Panel
          </div>
          <div class="login-box-body">
            <p class="login-box-msg"><h3 align="center">Your Email activated already! </h3> </p>

            <a href="https://admin.musixcloud.xyz/login.php"><i class="fa fa-sign-in"></i> Back to login page.</a>

          </div>
        </div>
      </body>
    </html>';
  }
}

 ?>
