<?php
session_start();
if(empty($_SESSION['username'])||empty($_SESSION['type'])){
	header("Location:../login.php");
}
if($_SESSION['type']!=3){
	header("Location:../index.php");
}
date_default_timezone_set('Asia/Hong_Kong');
require_once '../db/admindb.php';

if(isset($_GET['act'])){
	if($_GET['act']=='shlog'){
		shlog($conn);
	}
	if($_GET['act']=="count"){
		logcount($conn);
	}
}
function shlog($conn){
	$sql="select log.id,log.aid,login.username,log.logDateTime,log.logIp,log.countryName,log.lat,log.long From log INNER JOIN login ON log.aid=login.aid";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
  $stmt->bind_result($rid,$raid,$rusername,$rlogDateTime,$rlogIp,$rcountryName,$rlat,$rlong);
  $array= array();
      while ($stmt->fetch()) {
          $array[]=array($rid,$raid,$rusername,$rlogDateTime,$rlogIp,$rcountryName,$rlat,$rlong);
			}
  $sql="select count(id) From log;";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
  $stmt->bind_result($rcount);
  $stmt->fetch();
$jsons = array('draw'=>1,'recordsTotal'=>$rcount,'recordsFiltered'=>$rcount,'data' =>$array);
echo json_encode($jsons);
}
function logcount($conn){
	$sql="SELECT COUNT(id) FROM musixcloudadmin.log";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($result);
	$stmt->fetch();
	echo $result;
}
?>
