<?php
session_start();
require_once "musicclass.php";
$musicclass=new adminmusic;

if(isset($_GET['act'])){
	if($_GET['act']=='shmusic'){
		$musicclass->listmusic();
	}
	if($_GET['act']=='det'){
		$musicclass->detmusic($_GET['songid']);
	}
	if($_GET['act']=='listreport'){
		$musicclass->listreport();
	}
	if($_GET['act']=='detailreport'){
		$musicclass->detreport($_GET['rid']);
	}
}
if(isset($_POST['act'])){
	if($_POST['act']=='del'){
		$musicclass->delmusic($_POST['musicid']);
	}

}

?>
