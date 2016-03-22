<?php

require_once "backupclass.php";

$backup=new backup;


if(isset($_GET['act'])){
	if($_GET['act']=='dbbackup'){
		$backup->backup_tables($_GET['db']);
	}
	if($_GET['act']=='listdbbackup'){
		$backup->listdbbackup();
	}
	if($_GET['act']=='del'){
		$backup->delfile($_GET['filename']);
		header("Location:https://admin.musixcloud.xyz/backup.php");
	}
}


?>
