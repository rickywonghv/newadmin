<?php
  include_once "asset/php/chper.php";

  session_start();
  checkper(); //check login
  dadmin();
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
    <link rel="stylesheet" href="asset/css/style.css">
        <script src="asset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="asset/js/count.js" charset="utf-8"></script>
    <link rel="stylesheet" href="asset/plugins/datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" href="asset/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" media="screen" title="no title" charset="utf-8">
    <script src="asset/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="asset/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="asset/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js" charset="utf-8"></script>
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
          <span class="logo-lg"><b>MusixCloud</b> Admin <img src="img/logo.png" class="img-circle" width="30px" alt="" /></span>
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
            Admin Panel | Manage Admin
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manage Admin</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12" >
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title" id="profile"><i class="fa fa-user" ></i>Manage Administrator</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="col-xs-12" style="margin-bottom:20px;">
                    <a href="addadmin.php" id="toaddadmin" class="pull-left btn btn-success btn-flat"><span class="glyphicon glyphicon-plus"></span> Add Admin</a>
                  </div>

                  <div class=' col-xs-12'>
                    <!-- Widget: user widget style 1 -->
                    <table id="adminlisttable" class="display responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr><th>ID</th><th>Username</th><th>Type</th><th>View</th><th>Change Type</th><th>Block</th></tr>
                        </thead>
                        <tfoot>
                            <tr><th>ID</th><th>Username</th><th>Type</th><th>View</th><th>Change Type</th><th>Block</th></tr>
                        </tfoot>
                    </table>
                  </div>
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
      <!--Change Type modal-->
      <div class="modal" id="chtypwmodal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Change Type -- <span class="editauser"></span></h4>
            </div>
            <div class="modal-body">
              <ul class="list-group">
                <li class="list-group-item chtypetext"><b>Admin ID:</b> <span id="editaid"></span></li>
                <li class="list-group-item chtypetext"><b>Username:</b> <span class="editauser"></span></li>
                <li class="list-group-item chtypetext"><b>Admin Status:</b> <span id="adminstatus"></span></li>
                <li class="list-group-item chtypetext">
                  <div class="form-group">
                    <label><b>Admin Type:</b></label>
                    <select class="form-control" id="chtartype">
                      <option value=3> Super Admin</option>
                      <option value=2>Admin</option>
                      <option value=1>Music Admin</option>
                    </select>
                  </div>
                </li>
              </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="editAdminBtn">Save changes</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>
      <!--End Change Type modal-->
      <div class="modal" id="viewmodal">
        <div class="modal-dialog">
          <div class="modal-content">

            <!--<div class="modal-header"></div>-->
            <div class="modal-body">
              <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header ">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Change Type -- <span class="viewuser"></span></h4>
                  <div class="widget-user-image">
                    <img class="img-circle" src="img/user.png" alt="User Avatar">
                  </div><!-- /.widget-user-image -->
                  <h3 class="widget-user-username"><span class="viewuser"></span> -- <span class="fullname"></span></h3>
                  <h5 class="widget-user-desc"><span class="viewstatus"></span></h5>
                </div>
                <div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
                    <li><a href="#"><b>Admin ID:</b> <span id="viewaid"></span></a></li>
                    <li><a href="#"><b>Username:</b> <span class="viewuser"></span></a></li>
                    <li><a href="#"><b>Admin Status:</b> <span class="viewstatus"></span></a></li>
                    <li><a href="#"><b>Email: </b><span id="viewemail"></span></a></li>
                    <li><a href="#"><b>Full Name: </b><span class="fullname"></span></a></li>
                    <li><a href="#"><b>Reg Date: </b><span class="regdate"></span></a></li>
                    <li><a href="#"><b>Reg IP: </b><span class="regip"></span></a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->

    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="asset/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="asset/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="asset/js/adminscript.js" charset="utf-8"></script>
    <script type="text/javascript">
      $("#adminmenu").addClass('active');
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
      $('#adminlisttable').DataTable( {
          "processing": true,
          "serverSide": false,
          "ajax": "asset/php/adminfunction.php?act=shadmin",
          "paging":   true,
            "ordering": true,
            "info":     true
      } );
    } );
    </script>
  </body>
</html>
