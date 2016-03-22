<?php
  include_once "asset/php/chper.php";

  session_start();
  checkper(); //check login
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
    <script src="asset/js/music.js" charset="utf-8"></script>
    <script src="asset/js/reportmusic.js" charset="utf-8"></script>
    <script src="asset/js/search.js" charset="utf-8"></script>
    <script src="asset/js/player.js" charset="utf-8"></script>
    <script type="text/javascript" src="asset/jplayer/jquery.jplayer.js"></script>
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
            Admin Panel | Report Music
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Report Music</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12" >
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title pull-left"><i class="fa fa-list-alt"></i> Report Music</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive col-xs-12">
                    <div class='table-responsive'>
                      <table class='table table-striped table-bordered table-hover table-condensed'>
                        <thead>
                          <tr>
                            <th>Report Id</th><th>Song Id</th><th>Song Name</th><th>UserID</th><th>User Name</th><th>Report Date Time</th>
                          </tr>
                        </thead>
                        <tbody id="listreporttable">

                        </tbody>
                      </table>
                    </div>
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
    </div><!-- ./wrapper -->
    <div id="musicdetail">
					<div id="mdetailmodal" class="modal fade musicdetail" role="dialog">
					  <div class="modal-dialog">
					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">Song Detail</h4>
					      </div>
					      <div class="modal-body">
                  <ul class="list-group">
                    <li class="list-group-item"><b>Song ID:</b><span id="songid"></span></li>
                    <li class="list-group-item"><b>Song Name:</b><span id="songname"></span></li>
                    <li class="list-group-item"><b>Upload User:</b><span id="uploadUser"></span></li>
                    <li class="list-group-item"><b>Lyricist:</b><span id="lyricist"></span></li>
                    <li class="list-group-item"><b>Singer:</b><span id="singer"></span></li>
                    <li class="list-group-item"><b>Composer:</b><span id="composer"></span></li>
                    <li class="list-group-item"><b>Album:</b><span id="album"></span></li>
                    <li class="list-group-item"><b>Track:</b><span id="track"></span></li>
                    <li class="list-group-item"><b>Year:</b><span id="year"></span></li>
                    <li class="list-group-item"><b>Copyright:</b><span id="copyright"></span></li>
                    <li class="list-group-item"><b>Art Path:</b><span id="artpath"></span></li>
                    <li class="list-group-item"><b>Lyrics:</b><span id="lyrics"></span></li>
                    <li class="list-group-item"><b>Song Path:</b><span id="songpath"></span></li>
                    <li class="list-group-item"><b>Upload Time:</b><span id="uploadtime"></span></li>
                    <li class="list-group-item"><b>Total Play:</b><span id="totalplay"></span></li>
                    <li class="list-group-item"><b>Total Download:</b><span id="totaldownload"></span></li>
                  </ul>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					      </div>
					    </div>

					  </div>
					</div>
				</div>

        <div class="modal fade" id="reportdetail" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Report Detail -- <span id="dreportid"></span></h4>
              </div>
              <div class="modal-body">
                <ul class="list-group">
                  <li class="list-group-item">Music ID: <span id="dmusicid"></span></li>
                  <li class="list-group-item">Music Name: <span id="dmusicname"></span></li>
                  <li class="list-group-item">Report UserId: <span id="duid"></span></li>
                  <li class="list-group-item">Report User Name: <span id="duname"></span></li>
                  <li class="list-group-item">Reason: <span id="dreason"></span></li>
                  <li class="list-group-item">Report Date Time: <span id="ddatetime"></span></li>
                  <li class="list-group-item"><span id="ddetailmusic"></span></li>
                </ul>
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
    <script src="asset/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="asset/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="asset/plugins/slimScroll/jquery.slimscroll.min.js"></script>

    <script type="text/javascript">
      $("#musicmenu").addClass('active');
    </script>
  </body>
</html>
