<?php
function checkauth(){

}

function type($type){
  if($type===1){
    echo "Music Admin";
  }else if($type===2){
    echo "Admin";
  }else if($type===3){
    echo "Super Admin";
  }
}
function menu($type){
  if($type==3){
    echo '<!-- Left side column. contains the logo and sidebar -->
          <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
              <!-- Sidebar user panel -->
              <div class="user-panel">
                <div class="pull-left image">

                  <h1><i class="fa fa-user img-circle"></i></h1>
                </div>
                <div class="pull-left info">
                  <h4><p><!--User Name--> ';
                  echo $_SESSION['name'].'</p></h4>

                </div>
              </div>
              <!-- sidebar menu: : style can be found in sidebar.less -->
              <ul class="sidebar-menu">
                <li class="header">NAVIGATION</li>
                <li id="indexcon"><a href="content.php"><i class="fa fa-th-list"></i> Index Content</a></li>
                <li class="treeview" id="adminmenu">
                  <a href="#">
                    <i class="fa fa-user"></i> <span>Administrator</span> <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="addadmin.php"><i class="fa fa-circle-o"></i> Add Administrator</a></li>
                    <li><a href="admin.php"><i class="fa fa-circle-o"></i> Manage Administrator</a></li>
                    <li><a href="adminlog.php"><i class="fa fa-circle-o"></i> Administrators Logging</a></li>

                  </ul>
                </li>
                <li class="treeview" id="usermenu">
                  <a href="#">
                    <i class="fa fa-user"></i> <span>User</span> <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="user.php"><i class="fa fa-circle-o"></i> View Users</a></li>
                    <li><a href="userlog.php"><i class="fa fa-circle-o"></i>Users Logging</a></li>
                    <li><a href="usermsg.php"><i class="fa fa-circle-o"></i>User Messages</a></li>
                  </ul>
                </li>

                <li class="treeview" id="usermenu">
                  <a href="#">
                    <i class="fa fa-music"></i> <span>Manage Music</span> <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                  <li id="musicmenu">
                    <a href="music.php">
                      <i class="fa fa-music"></i> <span>Music</span>
                    </a>
                  </li>
                  <li id="musicreport">
                    <a href="musicreport.php">
                      <i class="fa fa-list-alt"></i> <span>Report Music</span>
                    </a>
                  </li>
                  </ul>
                </li>


                <li class="treeview" id="menumsg">
                  <a href="#">
                    <i class="fa fa-envelope"></i>
                    <span>Messages</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="adminmsg.php?username='.$_SESSION['username'].'"><i class="fa fa-circle-o"></i> Admin Messages <span class="badge pull-right"><span class="countread"></span></span></a> </li>
                    <li><a href="usermsg.php"><i class="fa fa-circle-o"></i> User Messages</a></li>
                  </ul>
                </li>
                <li id="mailmenu">
                  <a href="mail.php">
                    <i class="fa fa-mail-reply"></i> <span>Mail</span>
                    <!--New Emails--><small class="label pull-right bg-yellow"></small>
                  </a>
                </li>
                <li id="filemenu">
                  <a href="file.php">
                    <i class="fa fa-file"></i> <span>Files</span>
                  </a>
                </li>
                <li id="serverinfo">
                  <a href="serverinfo.php">
                    <i class="fa fa-server"></i> <span>Server Info</span>
                  </a>
                </li>
                <li id="backup">
                  <a href="backup.php">
                     <span>Backup</span>
                  </a>
                </li>
              </ul>
            </section>
            <!-- /.sidebar -->
          </aside>';
  }elseif ($type==2) {
    echo '<!-- Left side column. contains the logo and sidebar -->
          <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
              <!-- Sidebar user panel -->
              <div class="user-panel">
                <div class="pull-left image">

                  <h1><i class="fa fa-user img-circle"></i></h1>
                </div>
                <div class="pull-left info">
                  <h4><p><!--User Name-->';
                  echo $_SESSION['name'].'</p></h4>

                </div>
              </div>
              <!-- sidebar menu: : style can be found in sidebar.less -->
              <ul class="sidebar-menu">
                <li class="header">NAVIGATION</li>
                <li class="treeview" id="usermenu">
                  <a href="#">
                    <i class="fa fa-user"></i> <span>User</span> <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="user.php"><i class="fa fa-circle-o"></i> View Users</a></li>
                    <li><a href="userlog.php"><i class="fa fa-circle-o"></i>Users Logging</a></li>
                    <li><a href="usermsg.php"><i class="fa fa-circle-o"></i>User Messages</a></li>
                  </ul>
                </li>
                <li class="treeview" id="usermenu">
                  <a href="#">
                    <i class="fa fa-user"></i> <span>Manage Music</span> <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                  <li id="musicmenu">
                    <a href="music.php">
                      <i class="fa fa-music"></i> <span>Music</span>
                    </a>
                  </li>
                  <li id="musicreport">
                    <a href="musicreport.php">
                      <i class="fa fa-list-alt"></i> <span>Report Music</span>
                    </a>
                  </li>
                  </ul>
                </li>

                <li class="treeview" id="menumsg">
                  <a href="#">
                    <i class="fa fa-envelope"></i>
                    <span>Messages</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="adminmsg.php?username='.$_SESSION['username'].'"><i class="fa fa-circle-o"></i> Admin Messages <span class="badge pull-right"><span class="countread"></span></span></a> </li>
                    <li><a href="usermsg.php"><i class="fa fa-circle-o"></i> User Messages</a></li>
                  </ul>
                </li>
                <li id="mailmenu">
                  <a href="mail.php">
                    <i class="fa fa-mail-reply"></i> <span>Mail</span>
                    <!--New Emails--><small class="label pull-right bg-yellow"></small>
                  </a>
                </li>
                <li id="filemenu">
                  <a href="file.php">
                    <i class="fa fa-file"></i> <span>Files</span>
                  </a>
                </li>
              </ul>
            </section>
            <!-- /.sidebar -->
          </aside>';
  }elseif ($type==1) {
    echo '<!-- Left side column. contains the logo and sidebar -->
          <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
              <!-- Sidebar user panel -->
              <div class="user-panel">
                <div class="pull-left image">

                  <h1><i class="fa fa-user img-circle"></i></h1>
                </div>
                <div class="pull-left info">
                  <h4><p><!--User Name-->';
                  echo $_SESSION['name'].'</p></h4>

                </div>
              </div>
              <!-- sidebar menu: : style can be found in sidebar.less -->
              <ul class="sidebar-menu">
                <li class="header">NAVIGATION</li>
                <li class="treeview" id="usermenu">
                  <a href="#">
                    <i class="fa fa-user"></i> <span>Manage Music</span> <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                  <li id="musicmenu">
                    <a href="music.php">
                      <i class="fa fa-music"></i> <span>Music</span>
                    </a>
                  </li>
                  <li id="musicreport">
                    <a href="musicreport.php">
                      <i class="fa fa-list-alt"></i> <span>Report Music</span>
                    </a>
                  </li>
                  </ul>
                </li>

                <li class="" id="menumsg">

                    <li><a href="adminmsg.php?username='.$_SESSION['username'].'"><i class="fa fa-circle-o"></i> Admin Messages <span class="badge pull-right"><span class="countread"></span></span></a> </li>

                </li>

              </ul>
            </section>
            <!-- /.sidebar -->
          </aside>';
  }
}
function checkper(){
  if(!isset($_SESSION['username'])||!isset($_SESSION['aid'])||!isset($_SESSION['type'])){
    header('Location:login.php');
  }else{
    chexp();
  }
  if ($_SESSION['status']=="lock") {
    header('Location:lock.php');
  }elseif($_SESSION['status']=="unlock"){

  }
}
function chexp(){
  $now = time();
        if ($now > $_SESSION['expire']) {
            session_destroy();
            session_unset();
            header("Location:login.php?act=expire&id=".hash('sha256',$_SESSION['aid']));
        }
}
function dadmin(){
  if($_SESSION['type']=="1"||$_SESSION['type']!="3"||$_SESSION['type']=="2"||$_SESSION['type']=="0"){
    header('Location:login.php');
  }
}
function dmusic(){
  if($_SESSION['type']=="1"||$_SESSION['type']=="0"){
    header('Location:login.php');
  }
}

function user($type){
  if($type=="3"){
    echo '<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Users</span>
          <span class="info-box-number">100</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->';
  }else if($type=="2"){
    echo '<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Users</span>
          <span class="info-box-number">100</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->';
  }

}

function logout(){
  $adminhost="fypsg.cpnxlvkuunux.ap-southeast-1.rds.amazonaws.com";
  $adminuser="fyp";
  $adminpwd="basa3aTR";
  $admindb="musixcloudadmin";
  session_start();
  $conn=new mysqli($adminhost,$adminuser, $adminpwd, $admindb);
  $stmt=$conn->prepare("delete from session where sessionid=?");
  $stmt->bind_param("s",$_SESSION['sessionid']);
  $stmt->execute();

  session_start();
  session_unset();
  session_destroy();
  header("Location:login.php");
}

?>
