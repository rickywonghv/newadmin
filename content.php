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
    <link rel="stylesheet" href="asset/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css">
    <link rel="stylesheet" href="asset/plugins/bootstrap-wysihtml5/wysiwyg-color.css">

        <script src="asset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="asset/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
        <script src="asset/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="asset/js/count.js" charset="utf-8"></script>
    <script src="asset/js/cksession.js" charset="utf-8"></script>
    <script src="asset/js/indexcon.js" charset="utf-8"></script>
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
            Admin Panel | Index Content
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Index Content</li>
          </ol>
        </section>
        <!--DB 1=ENG 2=CHI -->
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12" >
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title" id=""><i class="fa fa-th-list"></i>About US</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="list-group">
                    <li class="list-group-item">
                       <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#aboutconmodal" onclick="showaboutcon()"><i class="fa fa-pencil"></i></button>
                       <h4>About US</h4>

                         <script type="text/javascript">
                           $.ajax({
                             url:"asset/php/adminfunction.php?act=indexabout",
                             dataType:"json",
                             success:function(response){
                                console.log(response);
                                json=response;
                                for (var i = 0; i < json.length; i++) {
                                  if(json[i]['language']==1){
                                    $(".aboutengcon").html(json[i]['content']);
                                  }else{
                                    $(".aboutchicon").html(json[i]['content']);
                                  }
                                }
                             }
                           })
                         </script>
                      <div id="aboutcon" class="" style="padding:20px">
                        <div class="abouteng" style="padding:5px 0 5px 0">
                           <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="collapse" data-target=".aboutengcon"><i class="fa fa-plus"></i></button>
                           <h4>English</h4>
                          <p class="aboutengcon">

                          </p>
                        </div>
                        <div class="aboutchi" style="padding:5px 0 5px 0">

                          <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="collapse" data-target=".aboutchicon"><i class="fa fa-plus"></i></button>
                          <h4>Chinese</h4>
                          <p class="aboutchicon collapse">

                          </p>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div><!-- ./box-body -->
                <div class="box-footer">

                  <!-- /.row -->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row"> <!--Price-->
            <div class="col-md-12" >
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title" id=""><i class="fa fa-th-list"></i>Price</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="list-group">
                    <li class="list-group-item">
                       <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#pricemodal"><i class="fa fa-pencil"></i></button>
                       <h4>Price</h4>
                      <div id="pricecon" class="" style="padding:20px">
                        <div class="priceeng">
                          <h4>English</h4>
                          <p class="priceengcon">
                            <div class="section" id="price">
                            <style media="screen">
                            .pricebtn {
                              -webkit-box-shadow: 0px 1px 3px #666666;
                              -moz-box-shadow: 0px 1px 3px #666666;
                              box-shadow: 0px 1px 3px #666666;
                              font-family: Arial;
                              color: #ffffff;
                              font-size: 20px;
                              background: #3498db;
                              padding: 10px 70px 10px 70px;
                              text-decoration: none;
                            }

                            .pricebtn:hover {
                              background: #3cb0fd;
                              text-decoration: none;
                            }
                            </style>
                            <!--Pay-->
                            <div class="row">
                              <div class="col-md-12"> <h1 class="text-center primary"><i class="fa fa-usd"></i> Pricing</h1> </div>
                              <div class="col-md-6">
                                <div class="free">
                                  <div class="price success">
                                    <div class="list-group">
                                        <ul>
                                          <li class="list-group-item list-group-item-success pricehead"><strong><h2>FREE</h2></strong><br><h4><i class="fa fa-usd"></i><span class="freepricere">0</span></h4></li>
                                          <li class="list-group-item plandel"><i class="fa fa-headphones"></i> Play Music (Free music only)</li>
                                          <li class="list-group-item plandel"><i class="fa fa-cloud-upload"></i> Upload Music * (Free music only)</li>
                                          <li class="list-group-item plandel"><i class="fa fa-cloud-download"></i> Download Music * (Free music only)</li>
                                          <li class="list-group-item plandel"><i class="fa fa-android"></i> Support Android App</li>
                                          <li class="list-group-item plandel"><i class="fa fa-life-ring"></i> Admin Support</li>
                                          <li class="list-group-item plandel">Download music with CDN *</li>
                                          <li class="list-group-item plandel"><a class="pricebtn">Detail</a></li>
                                        </ul>
                                    </div>

                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="per">
                                  <div class="price success">
                                    <div class="list-group">
                                        <ul>
                                          <li class="list-group-item list-group-item-danger  pricehead"><strong><h2>PERMIUM</h2></strong><br><h4><i class="fa fa-usd"></i><span class="perprice"></span></h4></li>
                                          <li class="list-group-item plandel"><i class="fa fa-headphones"></i> Play Music (Free & Permium music)</li>
                                          <li class="list-group-item plandel"><i class="fa fa-cloud-upload"></i>Upload Music * (Unlimited Music)</li>
                                          <li class="list-group-item plandel"><i class="fa fa-cloud-download"></i> Download Music * (All Music)</li>
                                          <li class="list-group-item plandel"><i class="fa fa-android"></i> Support Android App</li>
                                          <li class="list-group-item plandel"><i class="fa fa-pencil-square-o"></i> Audio Editor</li>
                                          <li class="list-group-item plandel"><span class="glyphicon glyphicon-user"></span> All Free Account function</li>
                                          <li class="list-group-item plandel"><a class="pricebtn">Detail</a></li>
                                        </ul>
                                    </div>

                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12"><div class="alert alert-info text-center">We are accept <i class="fa fa-paypal"></i> Paypal only</div></div>
                            </div>
                          <!--End Pay-->
                          </div>
                          </p>
                        </div>
                        <div class="pricechi">
                          <h4>Chinese</h4>
                          <p class="pricechicon">

                          </p>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div><!-- ./box-body -->
                <div class="box-footer">

                  <!-- /.row -->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="modal fade" id="aboutconmodal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="">About US Edit</h4>
                </div>
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#tab_1-1" data-toggle="tab"><i class="fa fa-file-o"></i> Chinese</a></li>
                    <li><a href="#tab_2-2" data-toggle="tab"><i class="fa fa-cloud-upload"></i> English</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab_1-1">
                      <form class="form" id="abouteditchi" method="post">
                      <div class="modal-body">
                        Chinese
                        <textarea name="abouttextchi" id="abouttextchi" class="textarea form-control" rows="8"></textarea>
                        <div class="errorupdate">

                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-info" id="aboutConChiDraft">Draft</button>
                        <button type="button" class="btn btn-success" id="aboutConChiSave">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                      </div>
                      </form>
                    </div>

                    <div class="tab-pane" id="tab_2-2">
                      <form class="form" id="aboutediteng" method="post">
                      <div class="modal-body">
                        English
                        <textarea name="abouttexteng" id="abouttexteng" class="textarea form-control" rows="8"></textarea>
                        <div class="errorupdate">

                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-info" id="aboutConEngDraft">Draft</button>
                        <button type="button" class="btn btn-success" id="aboutConEngSave">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                      </div>
                      </form>
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>

          <div class="modal fade" id="pricemodal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="">Price</h4>
                </div>
                <div class="modal-body">
                  <h4>Set Price</h4>
                  <form class="form" method="post">
                    <input type="number" id="price" value="">
                    <button type="submit" id="submitprice">Submit</button>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary"></button>
                </div>
              </div>
            </div>
          </div>

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
    <script src="asset/js/cksession.js" charset="utf-8"></script>


    <script type="text/javascript">

      $(document).ready(function() {
        $("#indexcon").addClass('active');
        $(".textarea").wysihtml5();
        $("#aboutConChiSave").click(function(){
          updateAbout('chi');
        });
        $("#aboutConEngSave").click(function(){
          updateAbout('eng');
        });
      });



    </script>

  </body>
</html>
