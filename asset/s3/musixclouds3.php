<?php
if(isset($_POST['act'])){
  if($_POST['act']=="delfile"){
    del($_POST['filename']);
  }
}

function del($filename){
  require_once 's3class.php';
  $admin=new musixclouds3;
  $admin->del($filename);
}

 ?>
