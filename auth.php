<?php
session_start();
if(!isset($_SESSION['secret'])||!isset($_SESSION['expireauth'])){
  header("Location:../../login.php");
}

$now = time();
      if ($now > $_SESSION['expireauth']) {
          session_destroy();
          session_unset();
          header("Location:login.php?act=expireauth");
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="asset/css/login.css">
    <!-- jQuery 2.1.4 -->
    <script src="asset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="https://www.google.com/jsapi"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="asset/js/auth.js" charset="utf-8"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#code").focus();
      });
    </script>
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <b>MusixCloud</b>Admin Panel
      </div>
      <div class="login-box-body">
        <p class="login-box-msg">Enter the 6 digi</p>
        <form class='' id="authform" role="form" method="POST">
          <div class="col-xs-12 inputauth">
            <input type="text" name="code" id="code" class="form-control" placeholder="Please enter the 6 digit">
          </div>
          <div class="authmsg col-xs-12">

          </div>
          <div class="col-xs-12 inputauth">
            <button type="button" id="authsub" class="btn btn-block">Confirm</button>
          </div>
        </form>

        <a href="" data-toggle="modal" data-target="#another">Another authentication method</a><br>

      </div>
    </div>

  </body>
</html>
