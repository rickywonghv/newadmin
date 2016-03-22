<?php
/**
 * musixcloud backup class
 */
 require_once "../s3/S3.php";

class backup extends S3{
  private $host='fypsg.cpnxlvkuunux.ap-southeast-1.rds.amazonaws.com';
  private $user='fyp';
  private $pass='basa3aTR';
  //private $name='musixcloudadmin';//dbname

  /* backup the db OR just a table */
  public function backup_tables($name,$tables = '*'){
    if($name=="admin"){
      $name='musixcloudadmin';
    }elseif($name=="main"){
      $name='musixcloud';
    }

  	$link = mysql_connect($this->host,$this->user,$this->pass);
  	mysql_select_db($name,$link);

  	//get all of the tables
  	if($tables == '*')
  	{
  		$tables = array();
  		$result = mysql_query('SHOW TABLES');
  		while($row = mysql_fetch_row($result))
  		{
  			$tables[] = $row[0];
  		}
  	}
  	else
  	{
  		$tables = is_array($tables) ? $tables : explode(',',$tables);
  	}

  	//cycle through
  	foreach($tables as $table)
  	{
  		$result = mysql_query('SELECT * FROM '.$table);
  		$num_fields = mysql_num_fields($result);

  		$return.= 'DROP TABLE '.$table.';';
  		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
  		$return.= "\n\n".$row2[1].";\n\n";

  		for ($i = 0; $i < $num_fields; $i++)
  		{
  			while($row = mysql_fetch_row($result))
  			{
  				$return.= 'INSERT INTO '.$table.' VALUES(';
  				for($j=0; $j < $num_fields; $j++)
  				{
  					$row[$j] = addslashes($row[$j]);
  					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
  					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
  					if ($j < ($num_fields-1)) { $return.= ','; }
  				}
  				$return.= ");\n";
  			}
  		}
  		$return.="\n\n\n";
  	}

  	//save file
    //save file
    $file='db/db-backup-'.$name.'-'.time().'-'.(md5(implode(',',$tables))).'.sql';
  	$handle = fopen($file,'w+');

  	fwrite($handle,$return);
    fclose($handle);

    $s3 = new S3("AKIAICVVTJOLPMFXXUTQ", '7/Z+gom7J2jk40c9k9TwD+Zf4nQWoI8ckl8yfhX3');
    $bucketName="musixcloud-backup";
    $s3->putObject($s3->inputResource(fopen($file, 'rb'), filesize($file)), $bucketName, $file, $s3->ACL_PUBLIC_READ);
    echo "true";


  }

  public function listdbbackup(){
    $s3 = new S3("AKIAICVVTJOLPMFXXUTQ", '7/Z+gom7J2jk40c9k9TwD+Zf4nQWoI8ckl8yfhX3');
    $bucketName="musixcloud-backup";
    $contents = $s3->getBucket($bucketName,'db');
    $result = array();
    foreach ($contents as $key) {
      $result[] = $key;

    }
    print_r(json_encode($result));
  }
  public function delfile($filename){
    // AWS access info
    if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAICVVTJOLPMFXXUTQ');
    if (!defined('awsSecretKey')) define('awsSecretKey', '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');

    // Check for CURL
    if (!extension_loaded('curl') && !@dl(PHP_SHLIB_SUFFIX == 'so' ? 'curl.so' : 'php_curl.dll'))
    	exit("\nERROR: CURL extension not loaded\n\n");

    $s3 = new S3(awsAccessKey, awsSecretKey);

    $bucket = 'musixcloud-backup';
    // Delete our file
    if ($s3->deleteObject($bucket, $filename)) {
      //echo "S3::deleteObject(): Deleted file .$uploadFile\n ";
      return true;

    } else {
      echo "S3::deleteObject(): Failed to delete file\n";
    }
  }


}







 ?>
