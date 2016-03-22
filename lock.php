<?php
  session_start();
  if(!isset($_SESSION['status'])){
    header("login.php");
  }elseif ($_SESSION['status']=="unlock") {
    header("index.php");
  }

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
    <script src="asset/js/login.js" charset="utf-8"></script>
    <script src="https://www.google.com/jsapi"></script>
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
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
    <script type="text/javascript">
      $(document).ready(function() {
        $("#lockpwd").focus();
      });
    </script>
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <b>MusixCloud</b>Admin Panel
      </div>
      <div class="login-box-body">

        <form method="post" id="lockform">
          <div class="" align="center">
            <img src="img/lock.png" alt="" />
          </div>
          <p class="login-box-msg"><h4 align="center">Locked:  <?php echo $_SESSION['username'];?></h4> </p>
          <div class="form-group has-feedback">
            <div class="input-group">
            <span class="input-group-addon"><span class="fa fa-lock"></span><span class="hidden-xs"> Password</span></span>
            <input type="password" class="form-control" placeholder="Password" id="lockpwd">
          </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <button type="button" id="unlockbtn" class="btn btn-primary btn-block btn-flat">Unlock</button>
            </div>
            <div class="col-xs-12">
              <div class="" id="message">

              </div>
            </div>
          </div>
        </form>
        <a href="logout.php" id="backlogin" class="btn btn-info"><i class="fa fa-sign-out"></i> Do not use this account</a>
        <a href="#">I forgot my password</a><br>
      </div>
    </div>
  </body>
</html>
