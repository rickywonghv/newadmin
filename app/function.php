<?php
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('Asia/Hong_Kong');
require_once "class.php";
$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
$phoneapp=new phoneapp;
//if(stripos($ua,'android') !== false) {
  if(isset($_POST['act'])){
    if($_POST['act']=="loginapp"){
      $phoneapp->login($_POST['loginuser'],$_POST['loginpwd']);
    }
  }
  if(isset($_GET['act'])){
    if($_GET['act']=="adminlog"){
      $phoneapp->adminlog();
    }
  }
//}else{

//}
?>
