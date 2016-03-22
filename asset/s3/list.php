<?php
header("Content-Type:text/html; charset=utf-8");
session_start();
if(empty($_SESSION['username'])||empty($_SESSION['type'])||$_SESSION['type']=='musicadmin'){
  header("Location:../../login.php");
}
if (!class_exists('S3')) require_once 'S3.php';

// AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAICVVTJOLPMFXXUTQ');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');

$bucketName = 'musixcloud'; // Temporary bucket

if (!extension_loaded('curl') && !@dl(PHP_SHLIB_SUFFIX == 'so' ? 'curl.so' : 'php_curl.dll'))
	exit("\nERROR: CURL extension not loaded\n\n");

if (awsAccessKey == 'change-this' || awsSecretKey == 'change-this')
	exit("\nERROR: AWS access information required\n\nPlease edit the following lines in this file:\n\n".
	"define('awsAccessKey', 'change-me');\ndefine('awsSecretKey', 'change-me');\n\n");

// Instantiate the class
$s3 = new S3(awsAccessKey, awsSecretKey);
$contents = $s3->getBucket($bucketName,'share');
$result = array();
foreach ($contents as $key) {
  $result[] = $key;

}
print_r(json_encode($result));

 ?>
