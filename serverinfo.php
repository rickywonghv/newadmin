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

dadmin();
dmusic();
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
    <link href="asset/plugins/realtime/style.css" rel="stylesheet" />
        <script src="asset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="asset/plugins/bootstrap-switch/bootstrap-switch.min.js" charset="utf-8"></script>
        <script src="asset/plugins/realtime/graph.js" charset="utf-8"></script>
        <script src="asset/plugins/realtime/script.js" charset="utf-8"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="asset/js/count.js" charset="utf-8"></script>
    <script src="asset/js/cloudflare.js" charset="utf-8"></script>
    <script src="asset/js/info.js" async charset="utf-8"></script>

    <style media="screen">
      .listserver{
        font-size: 15px;
      }
    </style>
    <script type="text/javascript">
    $(document).ready(function() {
      cloudflare();
      var cksec='<?php cksecret(); ?>'
      if(cksec=="isset"){
        $("#starttwoauth").hide();
      }else if (cksec=="notset") {
        $("#distwofabtn").hide();
      }
    });
    </script>

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
            Admin Panel | <i class="fa fa-server"></i> Server Info
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Server Info</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-6" >
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title" id="server"><i class="fa fa-server" ></i>Server</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="refresh"><i class="fa fa-refresh"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="list-group">
                    <li class="list-group-item listserver">Server IP: <span id="serverip"></span></li>
                    <li class="list-group-item listserver"><b>Page View:</b> Regular: <span class="regularpage"></span> Threat: <span class="threatpage"></span> Crawler: <span class="crawlerpage"></span></li>
                    <li class="list-group-item listserver">
                      <button type="button" class="btn bg-orange" data-toggle="modal" data-target="#cloudflaremodal" id="cloudflare"><img src="img/cloudflare.png" width="20px" alt="" /> CloudFlare</button>
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
                    <button class="btn btn-box-tool" data-widget="refresh" id="rehdd"><i class="fa fa-refresh"></i></button>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="list-group">
                    <li class="list-group-item">
                      <span class="label label-default">Used Space:</span>
                      <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="" id="diskinfo" aria-valuemin="0" aria-valuemax="100" style="">
                        <span class="sr-only"></span>
                      </div>
                    </div></li>
                    <li class="list-group-item listserver">Total HDD Space: <span id="shdisktotal"></span> MB</li>
                    <li class="list-group-item listserver">Free HDD Space: <span id="shdiskfree"></span> MB</li>
                    <li class="list-group-item listserver">Used HDD Space: <span id="shdiskused"></span> MB</li>
                  </ul>
                </div><!-- ./box-body -->
                <div class="box-footer">
                  <div class="row">

                  </div><!-- /.row -->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->

            <div class="col-md-6">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-database"></i> Database</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="refresh" id="redb"><i class="fa fa-refresh"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="list-group">
                    <li class="list-group-item"><b>Database Endpoint: </b><span class="dbendpoint"></span></li>
                    <li class="list-group-item listserver"><b>Uptime: </b><span class="dbuptime"></span></li>
                    <li class="list-group-item listserver"><b>Mysql Version: </b><span class="dbversion"></span></li>
                    <li class="list-group-item listserver"><b>Process list: </b><button type='button' class='btn btn-flat bg-yellow' id="prolistbtn" data-toggle="modal" data-target="#prolist"> Show</button></li>
                  </ul>
                </div><!-- ./box-body -->

              </div><!-- /.box -->
            </div><!-- /.col -->

            <div class="col-md-6">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-chain-broken"></i> Bandwidth</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="refresh" id="redb"><i class="fa fa-refresh"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div id="rec_result"></div>
                  <canvas	id="rec_graph" width="500" height="300"></canvas>
                  <div id="snd_result"></div>
                  <canvas	id="snd_graph" width="500" height="300"></canvas>

                </div><!-- ./box-body -->
                <div class="box-footer">
                  <div class="row">
                    <div class="col-xs-12">
                      <button type='button' class='btn bg-yellow btn-flat pull-right' id=""> More</button>
                    </div>

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


      <div class="modal fade " id="prolist" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="">Database Process List</h4>
            </div>
            <div class="modal-body">
              <div class='table-responsive'>
                <table class='table table-striped table-bordered table-hover table-condensed'>
                  <thead>
                    <tr>
                      <th>ID</th><th>User</th><th>Host</th><th>Database</th><th>Command</th><th>Time</th><th>Status</th><th>Info</th>
                    </tr>
                  </thead>
                  <tbody class="prolistresult">

                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>




    <!-- jQuery 2.1.4 -->

    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="asset/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="asset/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="asset/js/cksession.js" charset="utf-8"></script>
  </body>
</html>
