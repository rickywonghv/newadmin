<?php
session_start();
//require_once '../db/admindb.php';
date_default_timezone_set('Asia/Hong_Kong');
require_once 'musixcloudadmin.php';
$admin=new admin;

require_once 'authclass.php';
$auth=new auth;

require_once 'indexclass.php';
$index=new index;

if(isset($_GET['act'])){
	if($_GET['act']=='shadmin'){ //list all admin in admin page
		$admin->adminlist();
	}
	if($_GET['act']=='view'&&$_GET['aid']!=""){ //view admin detail when click admin view button
		$admin->viewadmin($_GET['aid']);
	}
	if($_GET['act']=='block'&&$_GET['aid']!=""){ //block admin
		$admin->adminblock($_SESSION['aid'],$_GET['aid']);
	}
	if($_GET['act']=='shedit'&&$_GET['aid']!=""){ //show admin detail while click change type button
		$admin->shchangeadmin($_GET['aid']);
	}
	if($_GET['act']=='shlog'){ //list all log
		$admin->showlog();
	}
	if($_GET['act']=='dellog'){ //delete log
		$admin->deladminlog($_POST['selected']);
	}
	if($_GET['act']=="shadminmsg"){ //show admin msg
		$admin->showadminmsg($_SESSION['aid']);
	}
	if($_GET['act']=="msgdetail"){
		$admin->msgdetail($_GET['msgid']);
	}
	if($_GET['act']=="unread"){
		$admin->unread($_GET['msgid']);
	}
	if($_GET['act']=="countread"){
		$admin->msgcount($_SESSION['aid']);
	}
	if($_GET['act']=="shadminlist"){
		$admin->shadminlist($_SESSION['username']);
	}
	if($_GET['act']=="cksession"){
		$auth->cksession($_SESSION['aid'],$_SESSION['sessionid']);
	}
	if($_GET['act']=="logout"){
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
		echo "true";
	}
	if($_GET['act']=="callemail"){
		$admin->callemail($_SESSION['aid']);
	}
	if($_GET['act']=="indexabout"){ //show content of index about us
		echo $index->showabout($_SESSION['aid']);
	}
}
	if(isset($_POST['act'])){
		if($_POST['act']=="chtype"){
			$admin->changetype($_POST['type'],$_POST['aid']);
		}
		if($_POST['act']=="addadmin"){
			$addUser=filter_input(INPUT_POST, 'user');
			$addPwd=filter_input(INPUT_POST, 'pwd');
			$addType=filter_input(INPUT_POST, 'type');
			$addEmail=filter_input(INPUT_POST, 'email');
			$addFname=filter_input(INPUT_POST, 'fname');
			$addLname=filter_input(INPUT_POST, 'lname');
			$admin->addadmin($addUser,$addPwd,$addType,$addEmail,$addFname,$addLname);
		}
		if($_POST['act']=="sendmsg"){
			$admin->sendmsg($_POST['sub'],$_POST['toadmin'],$_POST['msg']);
		}
		if($_POST['act']=="delmsg"){
			$admin->delmsg($_POST['msgid']);
		}
		if($_POST['act']=='chadminpwd'){
			$opwd=filter_input(INPUT_POST,'opwd');
			$npwd=filter_input(INPUT_POST,'npwd');
			$npwdb=filter_input(INPUT_POST,'npwdb');
			$admin->chpwd($_SESSION['aid'],$opwd,$npwd,$npwdb);
		}
		if($_POST['act']=="regauth"){
			$auth->reg();
		}
		if($_POST['act']=="regconauth"){
			$secret=filter_input(INPUT_POST,'secret');
			$auth->conreg($_SESSION['aid'],$secret);
		}
		if($_POST['act']=="authlogin"){
			$code=filter_input(INPUT_POST,'code');
			$auth->authlogin($_SESSION['secret'],$code);
		}
		if($_POST['act']=="disauthtwo"){
			$auth->disabletwoauth($_SESSION['aid']);
		}
		if($_POST['act']=="lock"){
			lock();
		}
		if($_POST['act']=="saveemail"){
			$admin->newemail($_POST['newemail'],$_SESSION['aid']);
		}
		if($_POST['act']=="updateabout"){
			echo $index->updateAbout($_SESSION['aid'],$_POST['cont'],$_POST['lang']);
		}
	}

function lock(){
  $_SESSION['status']="lock";

}

?>
