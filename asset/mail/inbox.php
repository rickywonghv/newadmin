<?
/*
if($_GET['act']='header'){
  mailheader();
}*/
header('Content-Type: text/html; charset=utf-8');
function mailheader() {
    $dns = "{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX";
    $email = "musixcloudreg@gmail.com";
    $password = "basa3aTR";

    $openmail = imap_open($dns,$email,$password ) or die("Cannot Connect ".imap_last_error());
    if ($openmail) {
        $leng=imap_num_msg($openmail);
        for($i=1; $i<=$leng; $i++) {
            $header=imap_header($openmail,$i);
              $str= iconv_mime_decode($header->Subject,0, "UTF-8");
              $date=$header->Date;
              $arrayName = array('id'=>$i,'header' =>  $str,'date'=>$date);
              $result[] = $arrayName;
        }
        print_r(json_encode($result, JSON_UNESCAPED_UNICODE));
    } else {
        echo "Failed reading messages!!";
    }
}

function body(){
  header('Content-Type: text/html; charset=utf-8');
  $id=7;
  $dns = "{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX";
  $email = "musixcloudreg@gmail.com";
  $password = "basa3aTR";
  $openmail = imap_open($dns,$email,$password ) or die("Cannot Connect ".imap_last_error());
  $msg=imap_base64(imap_fetchbody($openmail,$id,1.2));
  //$header=iconv_mime_decode(imap_header($openmail,),0, "UTF-8");
  //$date=$header->Date;

  print_r($msg);
}
?>
