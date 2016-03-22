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
            Admin Panel | Manage Music
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manage Music</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12" >
            <div class="box box-success">
              <div class="box-header with-border">
                  <!--Player-->
                  <div class="player">
                  	<div class="player">
                  		<div class="player" >
                  			<div id="jquery_jplayer_1" class="jp-jplayer"></div>
                  			<div id="jp_container_1" class="jp-audio" role="application" aria-label="media player">
                  			<div class="jp-gui jp-interface">
                  				<div class="jp-controls-holder">
                  				<span class="player col-xs-12">
                            <div class="btn-group">
                              <button type="button" class="jp-play jcontrol btn btn-success " role="button"><i class="fa fa-play"></i></button>
                              <button type="button" class="jp-stop jcontrol btn btn-success" role="button"><i class="fa fa-stop"></i></button>
                              <button type="button" class="jp-mute jcontrol btn btn-success" role="button"><i class="fa fa-volume-off"></i></button>
                              <button type="button" class="jp-repeat jcontrol btn btn-success" role="button"><i class="fa fa-repeat"></i></button>
                            </div>
                  					<span class="jp-current-time"></span>
                  					<span class="time-sep">/</span>
                  					<span class="jp-duration"></span>
                  					<span class="jp-title" aria-label="title">&nbsp;</span>
                            <div class="hidden-xs" style="float:right;">
                      				<div class="glyphicon glyphicon-volume-up" ></div>
                      				<div class="jp-volume-bar ">
                      						<div class="jp-volume-bar-value"><span class="handle"></span></div>
                      				</div>
                      			</div>
                  					</span>
                  				<div class="jp-no-solution">
                  					<span>Error Update Require! </span>
                  					To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                  				</div>
                  			</div>
                  			</div>
                  		</div>
                  		</div>
                  	</div>
                  </div>
                </div>
                  <!--End Player-->
                </span>
              </div>
            </div>
              <div class="box-body">

          </div>
          </div>
          <div class="row">
            <div class="col-md-12" >
              <div class="box box-info">
                <div class="box-header with-border">
                  <div class="">
                    <h3 class="box-title pull-left"><i class="fa fa-music"></i> Manage Music</h3>
                  </div>

                  <span class="box-tools pull-right">
                    <span style="max-width:250px; float:right;" id="searchbar">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                          <input type="text" class="form-control" id="searchinput" placeholder=" Search for...">
                        </div>
                      </div>
                    </span>
                  </span>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive col-xs-12">
                  <table class="table table-hover table-striped" align="center">
                      <thead>
                        <tr>
                          <th>Song Name</th>
                          <th>Singer</th>
                          <th>Upload Time</th>
                          <th>Total Play</th>
                          <th>Total Download</th>
                        </tr>
                      </thead>
                      <tbody id="listmusic" class="searchdata">

                      </tbody>
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
