<?php
//require 'permission.php';
include 'db.php';
function countadmin(){
	include 'db.php';
	$sql="select username from admin";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$stmt->store_result();
	printf($stmt->num_rows);

}
function countuser(){
	include 'db.php';
	$sql="select userid from user";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$stmt->store_result();
	printf($stmt->num_rows);
}
function countmusic(){
	include 'db.php';
	$sql="select * from music";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$stmt->store_result();
	printf($stmt->num_rows);
}
function unreadusermsg(){
	include 'db.php';
	$sql="SELECT COUNT(reada) FROM usermsg where reada=1";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($result);
	$stmt->fetch();
	printf($result);
}
function unreadadminmsg(){
	include 'db.php';
	$sql="SELECT COUNT(reada) FROM adminmsg where reada=1 and toadmin=?";
	$stmt=$conn->prepare($sql);
	$stmt->bind_param('s',$_SESSION['username']);
	$stmt->execute();
	$stmt->bind_result($result);
	$stmt->fetch();
	printf($result);
}
?>
