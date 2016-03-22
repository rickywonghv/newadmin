<?php
date_default_timezone_set("Asia/Hong_Kong");
require_once "fileclass.php";
$file=new fileclass;
$result=$file->getdetail();
$date=date('m/d/Y', $result['date']);
$time=date('H:i:s',$result['time']);
$size=formatSize($result['size']);
$name=pathtoname($_POST['filename']);
$arrayName = array('filename'=>$name,'filedate' =>$date,'filetime'=>$time, 'filetype'=>$result['type'],'filesize'=>$size);
echo json_encode($arrayName);

function formatSize( $bytes ){
        $types = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB' );
        for( $i = 0; $bytes >= 1024 && $i < ( count( $types ) -1 ); $bytes /= 1024, $i++ );
        return( round( $bytes, 2 ) . " " . $types[$i] );
}

function pathtoname($path){
  return str_replace('share/', '', $path);
}
 ?>
