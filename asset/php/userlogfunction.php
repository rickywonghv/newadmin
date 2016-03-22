<?php
session_start();
if(empty($_SESSION['type'])||empty($_SESSION['username'])){
	header("Location:../login.php");
}

if(isset($_GET['act'])){
	if($_GET['act']=='shlog'){
		shlog();
	}
	if($_GET['act']=='dellog'){
		dellog();
	}
}

function shlog(){
	require 'db.php';
	$sql="select userlog.logid,userlog.userid,user.username,userlog.logindate,userlog.logintime,userlog.logip,userlog.country,userlog.latitude,userlog.longitude from userlog inner join user on userlog.userid=user.userid";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$data = $stmt->get_result();
	     $result = array();
	     while($row = $data->fetch_assoc()) {
	          $result[] = $row;
	      }
	      echo json_encode($result);
}

function dellog(){
	require 'db.php';
	$sql="delete from userlog where logindate<curdate()-4";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	echo "success";
}
?>