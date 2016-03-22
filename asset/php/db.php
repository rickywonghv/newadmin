<?php
require 'config.php';
	$conn = mysqli_connect($host,$username,$password,$dbname);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
	mysqli_set_charset($conn,"utf8");
?>
