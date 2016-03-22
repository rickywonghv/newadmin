<?php

/**
 * S3 Class for MusixCloud Admin Panel!!
 */
 require_once 'S3.php';
class musixclouds3 extends S3{

  function init(){

  }

  function del($uploadFile){
    // AWS access info
    if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAICVVTJOLPMFXXUTQ');
    if (!defined('awsSecretKey')) define('awsSecretKey', '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');

    // Check for CURL
    if (!extension_loaded('curl') && !@dl(PHP_SHLIB_SUFFIX == 'so' ? 'curl.so' : 'php_curl.dll'))
    	exit("\nERROR: CURL extension not loaded\n\n");

    $s3 = new S3(awsAccessKey, awsSecretKey);

    $bucket = 'musixcloud';
    // Delete our file
    if ($s3->deleteObject($bucket, $uploadFile)) {
      //echo "S3::deleteObject(): Deleted file .$uploadFile\n ";
      echo "success";

    } else {
      echo "S3::deleteObject(): Failed to delete file\n";
    }
  }
}






 ?>
