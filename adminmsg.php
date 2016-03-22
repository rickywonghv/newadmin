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
    <script src="asset/js/count.js" charset="utf-8"></script>
    <script src="asset/js/adminmsg.js" charset="utf-8"></script>
    <!--<script src="asset/js/search.js" charset="utf-8"></script>-->
    <link rel="stylesheet" href="asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      $(".textarea").wysihtml5();
    });
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
            Admin Panel | Admin Message
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Admin Message</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12" >
              <div class="box box-info">
                <div class="box-header with-border">
                  <div class="">
                    <h3 class="box-title pull-left"><i class="fa fa-envelope-o"></i> Admin Message <span class="label label-default"><span class="countread"></span></span></h3>
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
                  <div class="">
                    <button type="button" class="btn bg-navy btn-flat margin" id="msgsendmodal" data-toggle="modal" data-target="#sendmsgmodal"><span class="fa fa-reply"></span> Send Message</button>
                    <?php require 'asset/php/exmodal.php';?>
                  </div>
                  <div class="table-responsive col-xs-12">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th class='hidden-xs'>Message ID</th>
                          <th>From</th>
                          <th>Subject</th>
                          <th><span class="hidden-xs">Received </span>Date Time</th>
                          <th>More</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody id="amsgbody">
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
    <!--Admin Message Detail Modal-->
			<div id="amsgmodal">
				<div id="msgmodal" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Message Detail</h4>
				      </div>
				      <div class="modal-body">
				        <b>From Admin:</b><div id="fadmin"></div>
                <b>Subject:</b><div id="sub"></div>
				        <b>Receive Date Time:</b><div id="datetime"></div>
                <b>Message:</b><div id="msg"></div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" id="adminclosemsg" data-dismiss="modal">Close</button>
				      </div>
				    </div>

				  </div>
				</div>
			</div>
			<!--End Admin Message Detail Modal-->
      <!--Admin Message Add Modal-->
			<div id="sendmsg">
				<div id="sendmsgmodal" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Send Message</h4>
				      </div>
				      <div class="modal-body">
					    <form method="post" id="sendmsgform">
							<ul class="list-group">
							  <li class="list-group-item"><b>From Admin:</b><?php printf($_SESSION['username']);?> -- <?php printf($_SESSION['name']);?></li>
							  <li class="list-group-item">
								<div class="form-group">
								  <label for="toadmin"><b>To Admin:</b></label>
								  <select class="form-control" id="toadmin" class="form-control"></select>
								</div>
							  </li>

                  <li class="list-group-item">
                    <label for="sub">Subject</label>
                    <input type="text" id="sendsubject" class="form-control">
                  </li>


							  <li class="list-group-item">
								  <div class="form-group">
									  <label for="msgtext"><b>Message:</b></label>
                    <div class="box-body pad">
                      <form>
                        <textarea class="textarea" id="msgtext" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                      </form>
                    </div>
								  </div>
							  </li>
							</ul>
							<div id="callbackmsg"></div>
				      </div>
				      <div class="modal-footer">
				      	<button type="submit" class="btn bg-olive " id="sendBtn"><i class="fa fa-paper-plane"></i> Send</button>
				        <button type="button" class="btn  pull-left" data-dismiss="modal">Close</button>
				      </div>
				      </form>
				    </div>

				  </div>
				</div>
			</div>
			<!--End Admin Message Add Modal-->
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
      $("#menumsg").addClass('active');
    </script>
  </body>
</html>
