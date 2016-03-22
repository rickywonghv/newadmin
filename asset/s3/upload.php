<?php
/**
* $Id$
*
* S3 form upload example
*/

if (!class_exists('S3')) require_once 'S3.php';

// AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAICVVTJOLPMFXXUTQ');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');

// Check for CURL
if (!extension_loaded('curl') && !@dl(PHP_SHLIB_SUFFIX == 'so' ? 'curl.so' : 'php_curl.dll'))
	exit("\nERROR: CURL extension not loaded\n\n");

// Pointless without your keys!
//if (awsAccessKey == 'change-this' || awsSecretKey == 'change-this')
//	exit("\nERROR: AWS access information required\n\nPlease edit the following lines in this file:\n\n".
//	"define('awsAccessKey', 'change-me');\ndefine('awsSecretKey', 'change-me');\n\n");


S3::setAuth(awsAccessKey, awsSecretKey);

$bucket = 'musixcloud';
$path = 'share/'; // Can be empty ''

$lifetime = 3600; // Period for which the parameters are valid
$maxFileSize = (1024 * 1024 * 500); // 500 MB

$metaHeaders = array('uid' => 123);
$requestHeaders = array(
    'Content-Type' => 'application/octet-stream',
    'Content-Disposition' => 'attachment; filename=${filename}'
);

$params = S3::getHttpUploadPostParams(
    $bucket,
    $path,
    S3::ACL_PRIVATE,
    $lifetime,
    $maxFileSize,
    //201, // Or a URL to redirect to on success
		//'http://admin.musixcloud.xyz/file.php?act=uploaded',
		'https://admin.musixcloud.xyz/file.php?act=uploaded',
    $metaHeaders,
    $requestHeaders,
    false // False since we're not using flash
);

$uploadURL = 'https://' . $bucket . '.s3.amazonaws.com/';

?>
