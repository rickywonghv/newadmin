<?php
session_start();
if(!isset($_SESSION['aid'])||$_SESSION['type']!=3){
  header("Location:../../index.php?err=noper");
}

if($_POST['act']=='send'&&$_SESSION['type']==3){
  adminsendmail($_POST['to'],$_POST['subject'],$_POST['content']);
}

function adminsendmail($tomail,$sub,$cont){   //tomail and the activate url
  date_default_timezone_set('Asia/Hong_Kong');
  require 'phpmailer/PHPMailerAutoload.php';
  $mail = new PHPMailer();
  $mail->isSMTP();
  //$mail->SMTPDebug = 3; //use to debug
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = "ssl";
  $mail->Host = "smtp.gmail.com";
  $mail->Port = 465;
  $mail->isHTML(true);
  $mail->Username = "musixcloudreg@gmail.com";
  $mail->Password = "basa3aTR";
  $mail->SetFrom("musixcloudreg@gmail.com",'MusixCloud');
  $mail->AddAddress($tomail);
  //$mail->addReplyTo('replyto@example.com', 'First Last');
  $mail->Subject = $sub;
  $mail->Body = $cont;
  if(!$mail->Send()){
        echo "Mailer Error: " . $mail->ErrorInfo;
        echo 'error';
  }else{
        echo "success";
  }
}

function expire($tomail,$fullname,$expdate){   //tomail and the activate url
  date_default_timezone_set('Asia/Hong_Kong');
  require 'phpmailer/PHPMailerAutoload.php';
  $mail = new PHPMailer();
  $mail->isSMTP();
  //$mail->SMTPDebug = 3; //use to debug
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = "ssl";
  $mail->Host = "smtp.gmail.com";
  $mail->Port = 465;
  $mail->isHTML(true);
  $mail->Username = "musixcloudreg@gmail.com";
  $mail->Password = "basa3aTR";
  $mail->SetFrom("musixcloudreg@gmail.com",'MusixCloud');
  $mail->AddAddress($tomail);
  //$mail->addReplyTo('replyto@example.com', 'First Last');
  $mail->Subject = "Your premium MusixCloud account will expire!";
  $mail->Body = "<p>Dear ".$fullname."</P><p>Your premium MusixCloud account will expire on ".$expdate.", click this link to login and renew. <a href='http://musixcloud.xyz/user'>http://musixcloud.xyz/user</a></p><p>MusixCloud</p>";
  if(!$mail->Send()){
        echo "Mailer Error: " . $mail->ErrorInfo;
        echo 'error';
  }else{
        echo "success";
  }
}
?>
