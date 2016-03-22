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
        <script src="asset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
                      Your admin type: <?php type($_SESSION['type']);?>
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
            Admin Panel | Add Admin
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Admin</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12" >
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title" id="profile"><i class="fa fa-user" ></i>Add Administrator</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form class="form" id="addadminform" method="post">
                    <div class="form-group">
                      <label for="user">Username</label>
                      <input type="text" class="form-control" id="user" placeholder="Enter username">
                    </div>

                    <div class="form-group">
                      <label for="pwd">Password</label>
                      <input type="password" class="form-control" id="pwd" placeholder="Enter password">
                    </div>
                    <div class="form-group">
                      <label for="pwdb">Confirm Password</label>
                      <input type="password" class="form-control" id="pwdb" placeholder="Enter password again">
                    </div>
                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
                    <div class="">
                      <label for="fname">First Name</label>
                      <input type="text" class="form-control" id="fname" placeholder="Enter your firstname">
                    </div>
                  </div>
                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
                      <div class="">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" id="lname" placeholder="Enter your lastname">
                      </div>
                    </div>
                      <div class="form-group">

                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" placeholder="Enter Email (Optional)">
                    </div>

                    <div class="form-group">
                      <label for="">Permission</label>
                      <p class="help-block">Help text here.</p>
                      <table class='table table-striped table-bordered table-hover table-condensed'>
                        <thead>
                          <tr>
                            <th>Add Admin</th><th>
                              Manage Admin
                            </th>
                            <th>
                              Admin Log
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <div class='checkbox-inline'>
                                <label>
                                  <input type='checkbox' name='addper' value='1' id="addadminper" checked>
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class='checkbox-inline'>
                                <label>
                                  <input type='checkbox' name='addper' value='1' id="madminper" checked>
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class='checkbox-inline'>
                                <label>
                                  <input type='checkbox' name='addper' value='1' id="logadminper" checked>
                                </label>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="form-group">
                      <label><b>Admin Type:</b></label>
                      <select class="form-control" id="addadmintype">
                        <option value=3> Super Admin</option>
                        <option value=2>Admin</option>
                        <option value=1>Music Admin</option>
                      </select>
                    </div>
                    <div class="col-xs-12">
                      <button type="button" name="button" class="btn btn-info pull-right btn-flat" onclick="addadmin('<?php echo $_SESSION['type']?>')"><span class="glyphicon glyphicon-plus"></span> Add</button>
                    </div>
                  </form>

                </div><!-- ./box-body -->
                <div class="box-footer">
                  <div class="row">
                    <div class="" id="response">

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

    <!-- jQuery 2.1.4 -->

    <script src="asset/js/adminscript.js" charset="utf-8"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="asset/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="asset/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script type="text/javascript">
      $("#adminmenu").addClass('active');
    </script>
  </body>
</html>
