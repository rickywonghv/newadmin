<?php
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('Asia/Hong_Kong');
require_once "cloudflare/cloudflareclass.php";
$cloud=new musixcloudflare;
if(isset($_POST['act'])){
  if($_POST['act']=="cloudstatus"){
    print_r(json_encode($cloud->stats()));
  }
  if($_POST['act']=="setcache"){
    print_r(json_encode($cloud->cache_lvl("musixcloud.xyz",$_POST['tar'])));
  }
  if($_POST['act']=="setsecu"){
    print_r(json_encode($cloud->sec_lvl("musixcloud.xyz",$_POST['targ'])));
  }
  if($_POST['act']=="setdev"){
    print_r(json_encode($cloud->devmode("musixcloud.xyz",$_POST['tardev'])));
  }
}

 ?>
