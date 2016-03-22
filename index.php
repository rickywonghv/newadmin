<?php
  include_once "asset/php/chper.php";
  session_start();
  checkper(); //check login
require_once 'asset/php/count.php';

function cksecret(){
  if(isset($_SESSION['secret'])){
    echo "isset";
  }else{
    echo "notset";
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MusixCloud | Admin Panel</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="asset/fontawesome/css/font-awesome.css">
    <!-- Ionicons -->
    <!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="asset/plugins/bootstrap-switch/bootstrap-switch.min.css" media="screen" title="no title" charset="utf-8">
        <script src="asset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="asset/plugins/bootstrap-switch/bootstrap-switch.min.js" charset="utf-8"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="asset/js/count.js" charset="utf-8"></script>
    <script src="asset/js/auth.js" charset="utf-8"></script>
    <script src="asset/js/cloudflare.js" charset="utf-8"></script>
    <link href="favicon.ico" rel="icon" type="image/x-icon" />
    <style media="screen">
      #twofatable{
        padding: auto;
        margin: auto;
      }
    </style>
    <script type="text/javascript">
    $(document).ready(function() {
      var cksec='<?php cksecret(); ?>'
      if(cksec=="isset"){
        $("#starttwoauth").hide();
      }else if (cksec=="notset") {
        $("#distwofabtn").hide();
      }

      $("#devBtn").bootstrapSwitch();

    });
    function email(){
        $.ajax({
          url:"asset/php/adminfunction.php?act=callemail",
          dataType:"json",
          success:function(response){
            if(response.email==""){
              $("#adminemail").html("<form class='form-inline form-horizontal' method='post'><input type='email' id='newemailval' class='form-control' placeholder='Please enter your Email'> <button type='button' class='btn btn-info' id='saveemail' onclick='newemail();'><i class='fa fa-save'></i>Save</button><div id='emailcallresult'></div></form>");
            }else{
              $("#adminemail").html(response.email);
            }

          }
        })
    }
    </script>
    <script type="text/javascript">

    function newemail(){
      var newemail=$("#newemailval").val();
      if(newemail==""){
        $("#emailcallresult").html('<div class="alert alert-danger"><strong>Error!</strong>Please enter the email! </div>');
      }else{
        $.ajax({
          url:"asset/php/adminfunction.php",
          type:"POST",
          data:"act=saveemail&newemail="+newemail,
          dataType:"json",
          success:function(response){
            if(response.result=="success"){
              $("#emailcallresult").html('<div class="alert alert-success"><strong>Success!</strong>Please activate your email! </div>');
            }else if(response.result=="fail"){
              alert("fail");
            }else{
              alert("response");
            }
          }
        }) //end ajax

      }
    }

    </script>

    <script src="asset/js/cksession.js" charset="utf-8"></script>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="img/logo.png" class="img-circle" width="30px" alt="" /></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"> <b>MusixCloud</b> Admin <img src="img/logo.png" class="img-circle" width="30px" alt="" /></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="">
                <a href="adminmsg.php?username=<?php echo $_SESSION['username']?>">
                  <i class="fa fa-envelope-o"></i>
                </a>
              </li>

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-user img-circle"></i>
                  <!--User Name--><span class="hidden-xs"></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <h1><i class="fa fa-user img-circle"></i></h1>
                    <p>
                      <!--User Name--><?php echo $_SESSION['name'];?><!--End User Name-->
                    </p>
                    <p>
                      Your admin type: <?php echo type($_SESSION['type']);?>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="index.php#profile"  class="btn btn-default btn-flat">My Profile</a>
                    </div>

                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->

            </ul>
          </div>

        </nav>
      </header>
      <?php menu($_SESSION['type']); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin Panel
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-hdd-o"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">HDD used Storage</span>
                  <span class="info-box-number">90<small>%</small></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-envelope"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Unread Users Message</span>
                  <span class="info-box-number"></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-music"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Music</span>
                  <span class="info-box-number">10</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <?php user($_SESSION['type']); ?>

          </div><!-- /.row -->

          <div class="row">
            <div class="col-md-6" >
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title" id="profile"><i class="fa fa-user" ></i>Profile</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="list-group">
                    <li class="list-group-item"><b>Username:</b> <?php echo $_SESSION['username'] ?></li>
                    <li class="list-group-item"><b>Full Name:</b> <?php echo $_SESSION['name'] ?></li>
                    <li class="list-group-item"><b>Admin Type:</b> <?php echo type($_SESSION['type']) ?></li>
                    <li class="list-group-item"><b>Your IP Address:</b> <?php echo $_SERVER['REMOTE_ADDR'];?></li>
                    <li class="list-group-item"><b></b> <button type="button" class="btn btn-success" role="button" data-toggle="modal" data-target="#chpwdmodal"><i class="fa fa-key"></i> Change Password</button> <button type="button" name="button" class="btn btn-info" role="button" data-toggle="modal" data-target="#twoauth"> 2FA</button></li>
                    <li class="list-group-item"><button type="button" class="btn btn-default" id="lockbtn"><i class="fa fa-lock"></i> Lock</button>
                      <?php
                      if($_SESSION['type']==3){
                        echo '<button type="button" class="btn bg-orange" data-toggle="modal" data-target="#cloudflaremodal" id="cloudflare"><img src="img/cloudflare.png" width="20px" alt="" /> CloudFlare</button>';
                        echo '<a href="" class="btn btn-info"> MusixCloud Admin APP</a>';
                      }
                      ?>
                      <button type="button" class="btn bg-yellow btn-flat" id="emailbtn" onclick='email();' data-toggle="modal" data-target="#emailmodal"><i class="fa fa-envelope"></i> Email</button>
                    </li>

                  </ul>
                </div><!-- ./box-body -->
                <div class="box-footer">
                  <div class="row">

                  </div><!-- /.row -->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->

            <div class="col-md-6">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-hdd-o"></i> HDD Info</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">

                </div><!-- ./box-body -->
                <div class="box-footer">
                  <div class="row">

                  </div><!-- /.row -->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        Copyright by <img src="img/logo.png" class="img-circle" width="30px" alt="" /> <a href="http://musixcloud.xyz">MusixCloud</a>.<br>
      <!--  Theme Provided by <a href="http://almsaeedstudio.com">Almsaeed Studio</a>-->
      </footer>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->
    <!--Change Pwd-->
    <div class="modal fade" id="chpwdmodal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content ">
          <div class="modal-header bg-green">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id=""><i class="fa fa-key"></i> Change Password</h4>
          </div>
          <div class="modal-body">
            <form class="chpwdform" method="post">
              <div class="form-group col-xs-12">
                <label for="oldpwd">Old Password</label>
                <input type="password" class="form-control" name="oldpwd" id="opwd" placeholder="Enter old password">
              </div>
              <div class="form-group col-xs-12 col-sm-6">
                <label for="npwd">New Password</label>
                <input type="password" class="form-control" name="npwd" id="npwd" placeholder="Enter new password">
              </div>
              <div class="form-group col-xs-12 col-sm-6">
                <label for="npwdb">Confirm Password</label>
                <input type="password" class="form-control" name="npwdb" id="npwdb" placeholder="Enter new password again">
              </div>
              <div id="chpwdmsg" class="col-xs-12"></div>
          </div>
          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-backward"></i> Close</button>
            <button type="submit" class="btn btn-primary" id="savechpwed" ><i class="fa fa-save"></i> Save</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--End Change Pwd-->

    <div class="modal fade" id="twoauth" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="">Two Factor Authentication</h4>
          </div>
          <div class="modal-body">
            <table class='table col-xs-12' id="twofatable">
              <tbody align="center" class='col-xs-12'>
                <tr class='col-xs-12'><td><img src="img/2fa_img.png" width="250px" alt="" /></td></tr>
                <tr class='col-xs-12'><td><p>The use of two-factor authentication to prove one's identity is based on the premise that an unauthorized actor is unlikely to be able to supply both factors required for access. If, in an authentication attempt, at least one of the components is missing or supplied incorrectly, the user's identity is not established with sufficient certainty and access to the asset (e.g., a building, or data) being protected by two-factor authentication then remains blocked.</p></td></tr>
                <tr class='col-xs-12'><td>Reference from: <a href="https://support.google.com/a/answer/184711?hl=en">https://support.google.com/a/answer/184711?hl=en</a></td></tr>
                <tr class='col-xs-12'><td>Reference from: <a href="https://en.wikipedia.org/wiki/Two-factor_authentication">https://en.wikipedia.org/wiki/Two-factor_authentication</a></td></tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="distwofabtn">Disable 2FA</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#twoauthregmodal" id="starttwoauth" onclick="authreg()">Start</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="twoauthregmodal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="">Last step to enable 2FA</h4>
          </div>
          <div class="modal-body">
            <table class='table'>
              <tbody align="center">
                <tr>
                  <td><img src="" id="authregimg" alt="" class="img-responsive" /></td>

                </tr>
                <tr>
                  <td><b>Secret:</b> <span id="authregsecret"></span></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="authcon()"><i class="fa fa-tag"></i> Confirm</button>
          </div>
        </div>
      </div>
    </div>


      <!--CloudFlare modal-->
      <div class="modal fade" id="cloudflaremodal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-orange">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id=""><img src="img/cloudflare.png" width="40px" alt="" /> CloudFlare -- musixcloud.xyz </h4>
            </div>
            <div class="modal-body">
            <ul class="list-group">
              <li class="list-group-item"><b>Page View:</b> Regular: <span class="regularpage"></span> Threat: <span class="threatpage"></span> Crawler: <span class="crawlerpage"></span></li>
              <li class="list-group-item"><b>Domain:</b> <span id="cloudflaredomain"></span></li>
              <li class="list-group-item"><b>Cache Level:</b> <span id="cachelvl"></span></li>
              <li class="list-group-item"><b>Set Cache Level:</b>
                <form method="post" class="sidebar-form">
                  <div class="input-group">
                    <select class="form-control" id="setcachelvl">
                      <option value="basic">Basic</option>
                      <option value="agg">Aggressive</option>
                    </select>
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-group" id="setcachelvlbtn">Set</button>
                    </span>
                  </div>
                </form>
              </li>
              <li class="list-group-item"><b>Security Level:</b> <span id="seclvl"></span></li>
              <li class="list-group-item"><b>Set Security Level:</b>
                <form method="post" class="sidebar-form">
                  <div class="input-group">
                    <select class="form-control" id="setseclvl">
                      <option value="high">High</option>
                      <option value="med">Medium</option>
                      <option value="low">Low</option>
                      <option value="eoff">Essentially Off</option>
                    </select>
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-group" id="setseclvlbtn">Set</button>
                    </span>
                  </div>
                </form>
              </li>
              <li class="list-group-item"><b>Dev Mode:</b> <span id="devstats"></span></li>
              <li class="list-group-item"><b>Set Dev Mode:</b>
                <form method="post" class="sidebar-form">
                  <div class="input-group">
                    <select class="form-control" id="setdev">
                      <option value=1>Enable</option>
                      <option value=0>Disable</option>
                    </select>
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-group" id="setdevbtn">Set</button>
                    </span>
                  </div>
                </form>
              </li>
            </ul>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" id="emailmodal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-green">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id=""><i class="fa fa-envelope-o"></i> Email</h4>
            </div>
            <div class="modal-body">
              <ul class="list-group">
                <li class="list-group-item">Email: <span id="adminemail"></span></li>
              </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>





    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="asset/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="asset/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="asset/js/chpwd.js" charset="utf-8"></script>
  </body>
</html>
