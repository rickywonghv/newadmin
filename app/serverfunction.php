<?php
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('Asia/Hong_Kong');
header('Content-Type: application/json; charset=utf-8');
require_once 'server.php';
$server=new serverinfo;

if(isset($_GET['act'])){
  if($_GET['act']=="serverinfo"){
    $server->status();
  }
  if($_GET['act']=="dbname"){
    $server->dbname();
  }
  if($_GET['act']=="dbstat"){
    $server->dbstat();
  }
  if($_GET['act']=="prolist"){
    $server->dbprocess();
  }

}

?>
