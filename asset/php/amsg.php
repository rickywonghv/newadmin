<?php
	session_start();
	if(empty($_SESSION['username'])||empty($_SESSION['type'])){
		header("Location:../login.php");
	}

	if(isset($_GET['act'])){
		if($_GET['act']=="amsgtable"){
			amsgtable($_SESSION['username']);
		}
		if($_GET['act']=="detail"){
			detail($_GET['id']);
		}
		if($_GET['act']=="shadmin"){
			shadmin($_SESSION['username']);
		}
	}
	if(isset($_POST['act'])){
		if($_POST['act']=="sendmsg"){
			sendmsg($_POST['fromadmin'],$_POST['toadmin'],$_POST['msg']);
		}
		if($_POST['act']=="del"){
			delmsg($_POST['msgid']);
		}
	}


function amsgtable($user){
		require 'db.php';
		$sql="select * from adminmsg where toadmin=?";
		$stmt=$conn->prepare($sql);
		$stmt->bind_param('s',$user);
		$stmt->execute();
		$data = $stmt->get_result();
	     $result = array();
	     while($row = $data->fetch_assoc()) {
	          $result[] = $row;
	      }
	      echo json_encode($result);
}

function detail($id){
	require 'db.php';
		$sql="select * from adminmsg where msgid=?";
		$stmt=$conn->prepare($sql);
		$stmt->bind_param('i',$id);
		$stmt->execute();
		$data = $stmt->get_result();
	     $result = array();
	     while($row = $data->fetch_assoc()) {
	          $result[] = $row;
	      }
	      echo json_encode($result);
}

function shadmin($user){
	require 'db.php';
		$sql="select aid,username from admin where username!=?";
		$stmt=$conn->prepare($sql);
		$stmt->bind_param('s',$user);
		$stmt->execute();
		$data = $stmt->get_result();
	     $result = array();
	     while($row = $data->fetch_assoc()) {
	          $result[] = $row;
	      }
	      echo json_encode($result);
}

function sendmsg($fromadmin,$toadmin,$msg){
	date_default_timezone_set('Asia/Hong_Kong');
	$ip=$_SERVER["REMOTE_ADDR"];
	$senddate=date('Y-m-d');
	$sendtime=date('H:i:s');
	$msgid=rand();
	require 'db.php';
	try{
		$sql="INSERT INTO adminmsg (msgid,fromadmin,toadmin,msg,date,time,ip) VALUES (?,?,?,?,?,?,?)";
		$stmt=$conn->prepare($sql);
		$stmt->bind_param("issssss",$msgid,$fromadmin,$toadmin,$msg,$senddate,$sendtime,$ip);
		$stmt->execute();
		echo "success";
	}catch(Exception $e){
		printf($e->getMessage());
	}
}

function delmsg($msgid){
	require 'db.php';
	try{
		$sql="delete from adminmsg where msgid=?";
		$stmt=$conn->prepare($sql);
		$stmt->bind_param("i",$msgid);
		$stmt->execute();
		echo "success";
	}catch(Exception $e){
		printf($e->getMessage());
	}
}
?>
