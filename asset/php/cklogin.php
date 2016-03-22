<?php
	date_default_timezone_set('Asia/Hong_Kong');
	require_once 'authclass.php';
	$login=new auth;
	if(isset($_GET['act'])){
		if($_GET['act']=="login"){
			$user= filter_input(INPUT_POST, 'username');
			$pwd=filter_input(INPUT_POST, 'pwd');
			$gcap=filter_input(INPUT_POST, 'g-recaptcha-response');
			$login->login($user,$pwd,$gcap);
			

		}

	}elseif(isset($_POST['act'])){
		if($_POST['act']=="unlock"){
			$unlockpwd=filter_input(INPUT_POST, 'unlockpwd');
			$login->unlock($unlockpwd);
		}
	}
	else{
		echo "Did not set the necessary perameter";
	}

?>
