<?php
  include_once "asset/php/chper.php";

  session_start();
  checkper(); //check login
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
    <link rel="stylesheet" href="asset/css/style.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="asset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="asset/js/user.js" charset="utf-8"></script>
    <script src="asset/js/count.js" charset="utf-8"></script>
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
            Admin Panel | View Users
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">View Users</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12" >
              <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse" id="viewusercoll"><i class="fa fa-minus"></i></button>
                </div>
                <div class="widget-user-header with-border bg-red" id="userheader" style="">
                  <div class="widget-user-image hidden-xs" id="userimg">
                    <img src="img/multiusers.jpg" class="img-circle" alt="" />
                  </div>
                  <h3 class="widget-user-username">Users</h3>
                  <h5 class="widget-user-desc">All Users</h5>
                </div>

                <div class="box-footer with-border hidden-xs">
                  <div class="row with-border">
                    <div class="col-sm-3 border-right">
                      <div class="description-block">
                        <h5 class="description-header" id="freecount"></h5>
                        <span class="description-text">FREE ACCOUNT</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 border-right">
                      <div class="description-block">
                        <h5 class="description-header" id="precount"></h5>
                        <span class="description-text">PREMIUM</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3">
                      <div class="description-block">
                        <h5 class="description-header" id="blockcount"></h5>
                        <span class="description-text">Block</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3">
                      <div class="description-block">
                        <h5 class="description-header" id="total"></h5>
                        <span class="description-text">TOTAL</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div>
                <div class="">
                  <div class='table-responsive'>
                    <table class='table table-striped table-bordered table-hover table-condensed'>
                      <thead>
                        <tr>
                          <th>User ID</th>
          				        <th>Email</th>
          				        <th>Fullname</th>
          								<th>View</th>
                        </tr>
                      </thead>
                      <tbody id="userlist">

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
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

    <!--User View Modal-->
		<div class="modal fade" id="userviewmodal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id=""><span class="viewuid"></span> <span class="viewfullname"></span> -- View User</h4>
		      </div>
		      <div class="modal-body">
						<div class="list-item">
							<ul class="list-group">
							  <li class="list-group-item"><b>User ID: </b> <span class="viewuid"></span></li>
								<li class="list-group-item"><b>Facebook ID: </b><span class="viewfbid"></span></li>
								<li class="list-group-item"><b>Fullname: </b><span class="viewfullname"></span></li>
								<li class="list-group-item"><b>Email: </b><span class="viewemail"></span></li>
								<li class="list-group-item"><b>Type: </b><span class="viewtype"></span></li>
								<li class="list-group-item"><b>Gender: </b><span class="viewgender"></span></li>
								<li class="list-group-item"><b>Date of birth: </b><span class="viewdob"></span></li>
								<li class="list-group-item"><b>Expiry Date: </b><span class="viewexp"></span></li>
								<li class="list-group-item"><b>Register Date: </b><span class="viewregdate"></span></li>
								<li class="list-group-item"><b>Register IP: </b><span class="viewregip"></span></li>
								<li class="list-group-item"><b>Token: </b><span class="viewtoken"></span></li>
							</ul>
						</div>
		      </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info pull-left" data-dismiss="modal" >close</button>
          </div>
		    </div>
		  </div>
		</div>
		<!--End User View Modal-->

    <!-- jQuery 2.1.4 -->

    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="asset/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <script src="asset/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="asset/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="asset/plugins/slimScroll/jquery.slimscroll.min.js"></script>

    <script type="text/javascript">
      $("#usermenu").addClass('active');
    </script>
  </body>
</html>
