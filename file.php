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
    <link rel="stylesheet" href="asset/plugins/context-menu/nu-context-menu.css" media="screen" title="no title" charset="utf-8">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="asset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="asset/js/searchlist.js" charset="utf-8"></script>
    <script src="asset/js/file.js" charset="utf-8"></script>
    <script src="asset/js/count.js" charset="utf-8"></script>
    <script src="asset/plugins/upload/jquery.form.js" charset="utf-8"></script>
    <script src="asset/plugins/context-menu/jquery.nu-context-menu.js" charset="utf-8"></script>
    <script type="text/javascript">
    function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
          vars[key] = value;
        });
        return vars;
    }
    </script>
    <script src="asset/js/cksession.js" charset="utf-8"></script>
    <style media="screen">
      .progress { position:relative; max-width:400px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
      .bar { background-color: rgba(0, 142, 76, 0.75); width:0%; height:20px; border-radius: 3px; }
      .percent { position:absolute; display:inline-block; top:3px; left:48%; }
      .delfilebtn {padding-left: 3px; padding-right: 3px; padding-bottom: 3px; position:relative; float: right;}
      .filelistgroup {padding: 0px; min-height:40px; }
      .items{min-height:40px; position: relative;}
      .refilename{overflow: hidden; white-space:nowrap; text-overflow:ellipsis;}

      @media all and (max-width: 1200px) { /* screen size until 1200px */
          #node {
              font-size: 1.5em; /* 1.5x default size */
          }
      }
      @media all and (max-width: 1000px) { /* screen size until 1000px */
          #node {
              font-size: 1.2em; /* 1.2x default size */
              }
          }
      @media all and (max-width: 500px) { /* screen size until 500px */
          #node {
              font-size: 1em; /* 0.8x default size */
              overflow: hidden;
              white-space:nowrap;
              text-overflow:ellipsis;

              }
          #node .filelistgroup{height:ellipsis;}
          }
    </style>

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
            Admin Panel | <i class="fa fa-amazon"></i> Files
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Files</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">



          <div class="row" style="padding-bottom:5px; margin-bottom:5px;">
            <div class="col-xs-12 col-sm-12 hidden-md hidden-lg bg-orange">
              <div class="col-xs-6">
                <i class="fa fa-files-o"></i> Total Uploads: <span class="totalfiles"></span>
              </div>
              <div class="col-xs-6">
              <i class="fa fa-files-o"></i> Total Sizes: <span class="totalsize"></span>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="row">
              <div class="hidden-sm hidden-xs">
                <div class="info-box">
                  <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total Uploads</span>
                    <span class="info-box-number"><span class="totalfiles"></span></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->
            </div>
            <div class="row">
              <div class="hidden-sm hidden-xs">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-files-o"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total Sizes</span>
                    <span class="info-box-number"><span class="totalsize"></span></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->
            </div>
          </div>

          <div class="row">
            <div class="col-md-8">
              <!-- Custom Tabs (Pulled to the right) -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                  <li class="active"><a href="#tab_1-1" data-toggle="tab"><i class="fa fa-file-o"></i> Files</a></li>
                  <li><a href="#tab_2-2" data-toggle="tab"><i class="fa fa-cloud-upload"></i> Upload</a></li>

                  <li class="pull-left header"><img src="img/s3_icon.png" height="45px" alt="s3 icon" /> Files</li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1-1">
                    <div class='' id='node'>
                      <i class="fa fa-search"></i><input type="text" id="searchinput" placeholder="Search" >
                      <ul class="list-group" id="listallfile">

                      </ul>
                  </div>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2-2">
                    <div class="box box-info">
                      <div class="box-body">

                        <form action="asset/fileupload/" method="post" enctype="multipart/form-data">
                          <div class="">
                            <input type="text" name="customFileName" id="customFileName" class="form-control text" placeholder="You can rename the file before upload" value="">
                            <input type="file" id="uploadfile" class="form-control btn" name="uploadfile">
                          </div>
                            <div class="">
                              <button type="submit" class="btn btn-success pull-right" id="submitupload"><i class="fa fa-upload"></i> Upload</button>
                            </div>
                        </form>
                        <div class="progress" id="uploadprogressbar">
                            <div class="bar"></div>
                            <div class="percent">0%</div>
                        </div>
                        <div id="status"></div>
                      </div><!-- ./box-body -->
                      <div class="box-footer">
                        <div class="row">
                          File must less than 1GB.
                        </div><!-- /.row -->
                      </div><!-- /.box-footer -->
                    </div><!-- /.box -->

                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
          </div> <!-- /.row -->

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

    <div class="modal fade" id="detailfilepre" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id=""><span class="detailfilename"></span></h4>
          </div>
          <div class="modal-body">
            <ul class="list-group">
              <li class="list-group-item">File Name: <span class="detailfilename"></span></li>
              <li class="list-group-item">Upload Date: <span id="detailfilendate"></span></li>
              <li class="list-group-item">Upload Time: <span id="detailfilentime"></span></li>
              <li class="list-group-item">File Type: <span id="detailfilentype"></span></li>
              <li class="list-group-item">File Size: <span id="detailfilensize"></span></li>
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

    <!-- FastClick -->
    <script src="asset/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <script src="asset/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="asset/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="asset/plugins/slimScroll/jquery.slimscroll.min.js"></script>

    <script type="text/javascript">
      $("#filemenu").addClass('active');



    </script>
    <script src="asset/js/upload.js" charset="utf-8"></script>
    <script>
    $(function() {
      var context = $('#node')
        .nuContextMenu({

          hideAfterClick: true,

          items: '.items',

          callback: function(key, element) {
            if(key=="delete"){
              var filename=$(element).attr('id');
              window.location="file.php?act=del&filename="+filename;
            }else if (key=="download") {
              var filename=$(element).attr('id');
              window.location="https://s3-ap-southeast-1.amazonaws.com/musixcloud/"+filename;
            }else if (key=="detail") {
              var filename=$(element).attr('id');
              filedetail(filename);
            }
          },

          menu: [
            {
              name: 'download', //key
              title: 'Download',
              icon: 'download',
            },
            {
              name: 'void'
            },
            {
              name: 'delete',
              title: 'Delete',
              icon: 'trash',
            },

            {
              name: 'void'
            },

            {
              name: 'detail', //key
              title: 'Detail',
              icon: 'detail',
            },
          ]

        });

    });
  </script>
  </body>
</html>
