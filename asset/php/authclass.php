<?php
/**
 * MusixCloud 2FA and login class
 */
 require_once "../auth/GoogleAuthenticator.php";
class auth extends musixcloudTwoFactorAuth{
  private $adminhost="fypsg.cpnxlvkuunux.ap-southeast-1.rds.amazonaws.com";
  private $adminuser="fyp";
  private $adminpwd="basa3aTR";
  private $admindb="musixcloudadmin";

  protected function connect(){ //connect to the admin db using mysqli
    return new mysqli($this->adminhost,$this->adminuser, $this->adminpwd, $this->admindb);
  }


  public function reg(){
    $secret = $this->createSecret();
    //echo "Secret is: ".$secret."\n\n";

    $qrCodeUrl = $this->getQRCodeGoogleUrl($_SESSION['username'].'@MusixCloud', $secret);
    //echo "Google Charts URL for the QR-Code: ".$qrCodeUrl."\n\n";
    //echo "<img src=".$qrCodeUrl.">";

    $oneCode = $this->getCode($secret);
    //echo "Checking Code '$oneCode' and Secret '$secret':\n";
    $result = array('qrurl'=>$qrCodeUrl,'secret'=>$secret,'getcode'=>$oneCode );
    print_r(json_encode($result, JSON_UNESCAPED_UNICODE));
  }
  public function conreg($aid,$secret){
    $conn=$this->connect();
    $stmt=$conn->prepare("update login set auth=? where aid=?");
    $stmt->bind_param('si',$secret,$aid);
    $stmt->execute();
    echo "success";
  }
  public function authlogin($secret,$code){
    $checkResult = $this->verifyCode($secret, $code, 2);    // 2 = 2*30sec clock tolerance
    if ($checkResult) {
        $conn=$this->connect();
        $sql="select aid,username,adminType,auth from login where auth=?";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("s",$secret);
        $stmt->execute();
        $stmt->bind_result($raid,$ruser,$rtype,$auth);
        $stmt->fetch();
        $this->logging($raid,$ruser,$raid,$rtype);
        $this->sess($ruser,$raid,$rtype);
        $set="auth";
        $this->sessionset($raid,$set);

        //echo 'success';

    } else {
        echo "fail";
    }
  }

  private function ckgcap($gcap){
    if($gcap==""||$gcap=null){
      return false;
    }else{
      return true;
    }
  }

  public function login($loginuser,$loginpwd,$gcap){ //Login function
    if($this->ckgcap($gcap)){
      date_default_timezone_set('Asia/Hong_Kong');
      session_start();
      $conn=$this->connect();
      $stmt=$conn->prepare("SELECT * FROM login WHERE username=?");
      $stmt->bind_param('s',$loginuser);
      $stmt->execute();
      $stmt->store_result();
      $stmt->bind_result($raid,$ruser,$rpwd,$rauth,$rtype);
      $stmt->fetch();
      $ckact=$this->checkact($raid);
      $hpwd=hash("sha512",$loginpwd);
      if($ruser==$loginuser&&$rpwd==$hpwd&&$rtype!=0&&$ckact==1){
        if($rauth==""||$rauth==null){
            $this->logging($raid,$ruser,$raid,$rtype);
            $this->sess($ruser,$raid,$rtype);
            $this->sessionset($raid,$set="notauth");
        }else{
          $_SESSION['startauth'] = time();
          $_SESSION['expireauth'] = $_SESSION['startauth'] + (60*3); //3 mins
          $_SESSION['secret']=$rauth;
          //echo "auth";
          header("Location:https://admin.musixcloud.xyz/auth.php");
        }
      }elseif($rtype===0){
        //echo "block";
        header("Location:https://admin.musixcloud.xyz/login.php?error=block");
      }elseif($ckact===0){
        //echo "noact";
        header("Location:https://admin.musixcloud.xyz/login.php?error=noact");
      }else{
        //echo "wrong";
        header("Location:https://admin.musixcloud.xyz/login.php?error=wrong");
      }
    }else{
      //echo "gcaperror";
      header("Location:https://admin.musixcloud.xyz/login.php?error=gcaperror");
    }


  }

  private function checkact($aid){
    $conn=$this->connect();
    $sql="select activate from profile where aid=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param('i',$aid);
    $stmt->execute();
    $stmt->bind_result($reactivate);
    $stmt->fetch();
    return $reactivate;
  }

  private function logging($raid,$ruser,$raid,$rtype){ //login Log


    $conn=$this->connect();
    $country=filter_input(INPUT_POST, 'countryname');
		$latitude=filter_input(INPUT_POST, 'latitude');
		$longitude=filter_input(INPUT_POST, 'longitude');
		$id;
		$datetime=date('Y-m-d H:i:s', time());
		$logip=$_SERVER['REMOTE_ADDR'];
		$stmt=$conn->prepare("INSERT INTO log VALUES (?,?,?,?,?,?,?)");
		$stmt->bind_param("iisssss",$id,$raid,$datetime,$logip,$country,$latitude,$longitude);
		$stmt->execute();


  }


  private function sess($ruser,$raid,$rtype){ //Write Session

    $conn=$this->connect();
		$stmt=$conn->prepare("select firstName,lastName from profile where aid=?");
		$stmt->bind_param("i",$raid);
		$stmt->execute();
		$stmt->bind_result($rfirstName,$rlastName);
		$stmt->fetch();
		$_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (60*60); //1hour
		$_SESSION['name']=$rfirstName." ".$rlastName;
		$_SESSION['username']=$ruser;
		$_SESSION['aid']=$raid;
		$_SESSION['type']=$rtype;
    $_SESSION['status']="unlock";




  }

  public function sessionset($raid,$set){
    $str = 'abcdefghijklmnopqrstuvwxyz1234567890';
    $randstring = str_shuffle($str);
    $_SESSION['sessionid']=$randstring;

    $conn=$this->connect();
    $stmt=$conn->prepare("select * from session where aid=?");
    $stmt->bind_param("i",$raid);
    $stmt->execute();
    $stmt->bind_result($id,$resessionid,$reaid);
    $stmt->fetch();
    if($resessionid!=""){
      $this->sessionupdate($raid,$randstring,$set);
    }else{
      $this->sessionnew($raid,$randstring,$set);
    }
  }

  public function sessionupdate($raid,$randstring,$set){
    $conn=$this->connect();
    $stmt=$conn->prepare("update session set sessionid=? where aid=?");
    $stmt->bind_param("si",$randstring,$raid);
    $stmt->execute();
      //echo "true";
      if($set=="notauth"){
        header("Location:https://admin.musixcloud.xyz");
      }else{
        echo "true";
      }


  }

  public function sessionnew($raid,$randstring,$set){
    $id;
    $conn=$this->connect();
    $stmt=$conn->prepare("insert into session values(?,?,?)");
    $stmt->bind_param("isi",$id,$randstring,$raid);
    $stmt->execute();
    //echo "true";
    if($set=="notauth"){
      header("Location:https://admin.musixcloud.xyz");
    }else{
      echo "true";
    }

  }

  public function cksession($aid,$sessionid){
    $conn=$this->connect();
    $stmt=$conn->prepare("select * from session where aid=?");
    $stmt->bind_param("i",$aid);
    $stmt->execute();
    $stmt->bind_result($id,$resessionid,$reaid);
    $stmt->fetch();
    if($resessionid==$sessionid){
      echo "true";

    }else{
      echo "false";
    }
  }

  public function disabletwoauth($aid){
    $auth;
    $conn=$this->connect();
    $stmt=$conn->prepare("update login set auth=? where aid=?");
		$stmt->bind_param("si",$auth,$aid);
		$stmt->execute();
    echo "true";
  }

  public function unlock($lockpwd){
    date_default_timezone_set('Asia/Hong_Kong');
    session_start();
    $aid=$_SESSION['aid'];
    $conn=$this->connect();
    $stmt=$conn->prepare("SELECT * FROM login WHERE aid=?");
    $stmt->bind_param('i',$aid);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($raid,$ruser,$rpwd,$rauth,$rtype);
    $stmt->fetch();
    $hpwd=hash("sha512",$lockpwd);
    if($rpwd==$hpwd&&$rtype!=0){
          $_SESSION['status']="unlock";
          echo "success";
    }elseif($rtype===0){
      echo "block";
    }else{
      echo "wrong";
    }
  }
}
 ?>
