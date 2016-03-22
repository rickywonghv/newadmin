<?php
/**
 * MusixCloud Admin Class
 */
class admin {
  private $adminhost="fypsg.cpnxlvkuunux.ap-southeast-1.rds.amazonaws.com";
  private $adminuser="fyp";
  private $adminpwd="basa3aTR";
  private $admindb="musixcloudadmin";

  protected function connect(){ //connect to the admin db using mysqli
    return new mysqli($this->adminhost,$this->adminuser, $this->adminpwd, $this->admindb);
  }

  public function chpwd($aid,$opwd,$npwd,$npwdb){ //change admin pwd
    if($npwd!=$npwdb){
      echo "Password match";
    }elseif($opwd==""||$opwd==null) {
      echo "Old password wrong";
    }else{
      $this->ckopwd($aid,$opwd,$npwd,$npwdb);
    }
  }

  private function ckopwd($aid,$opwd,$npwd,$npwdb){ //check pwd
    $conn=$this->connect();
    $stmt=$conn->prepare("SELECT pwd FROM musixcloudadmin.login WHERE aid=?");
    $stmt->bind_param('i',$aid);
    $stmt->execute();
    $stmt->bind_result($resultpwd);
    $stmt->fetch();
    $hopwd=hash("sha512",$opwd);
    if($resultpwd!=$hopwd){
        echo "wrongpwd";
    }elseif($resultpwd==$hopwd){
      $this->chloginpwd($aid,$npwd);
    }
  }

  private function chloginpwd($aid,$npwd){ //update login table pwd
    $npwd=hash("sha512",$npwd);
    $conn=$this->connect();
    $sql="update login set pwd=? where aid=?";
    if($stmt=$conn->prepare($sql)){
      $stmt->bind_param('si',$npwd,$aid);
      $stmt->execute();
      echo "success";
    }
  }

  public function status(){ //return server info
    $ds = disk_total_space("/")/1024/1024;
  	$fds = disk_free_space("/")/1024/1024;
  	$uds=($ds-$fds);
    $uds=$uds/1024/1024;
    $ds=round($ds,3);
    $fds=round($fds,3);
    $uds=round($uds,3);
  	$exip=exec('curl icanhazip.com');
  	$result = array('hddtotal'=>$ds,'hddfree'=>$fds,'hddused'=>$uds,'servip'=>$exip);
  	echo json_encode($result);
  }

  public function dbendpoint(){ //Database Info
    $endpoint=$this->adminhost; //Database Endpoint
    return $endpoint;
  }

  public function bandwidth(){
    $interface="eth0";
    $inbound=exec("cat /sys/class/net/".$interface."/statistics/rx_bytes");
    $outbound=exec("cat /sys/class/net/".$interface."/statistics/tx_bytes");
    $arrayName = array('in'=>$inbound,'out'=>$outbound );
    echo json_encode($arrayName);
  }

  public function adminlist(){ //list all admin
    $conn=$this->connect();
    $stmt=$conn->prepare("select aid,username,adminType from login");
    $stmt->execute();
    $stmt->bind_result($raid,$rusername,$radminType);
    $array= array();
        while ($stmt->fetch()) {
          if($radminType=="3"){
  					$atype="Super Admin";
  				}else if ($radminType=="2") {
  					$atype="Admin";
  				}else if ($radminType=="1") {
  					$atype="Music Admin";
  				}else if ($radminType=="0") {
  					$atype="Block";
  				}
            $array[]=array($raid,$rusername,$atype,'<button class="btn btn-success" onclick="view('.$raid.')" data-toggle="modal" data-target="#viewmodal")"><i class="fa fa-eye"></i> <span class="hidden-xs">View</span></button>','<button type="button" id="editBtn" class="btn btn-info" data-toggle="modal" data-target="#chtypwmodal" onclick=editsh('.$raid.');><i class="fa fa-pencil"></i><span class="hidden-xs"> Change Type</span></button>','<button type="button" class="btn btn-danger" onclick=block('.$raid.') id="adminDelBtn" ><i class="fa fa-trash"></i> <span class="hidden-xs">Block</span></button>');
        }
    $jsons = array('draw'=>1,'data'=>$array);
    echo json_encode($jsons);
  }

  public function viewadmin($aid){ //view admin detail
    $conn=$this->connect();
  	$stmt=$conn->prepare("select login.aid,login.username,login.adminType,profile.email,profile.firstName,profile.lastName,regDate,regIp from login INNER join profile on login.aid=profile.aid where login.aid= ?");
  	$stmt->bind_param('i',$aid);
  	$stmt->execute();
  	$data = $stmt->get_result();
  	$result = array();
  	while($row = $data->fetch_assoc()) {
  			$result[] = $row;
  	}
  	echo json_encode($result);
  }

  public function changetype($type,$aid){ //change admin type
    $conn=$this->connect();
    $sql="update login set adminType=? where aid=?";
  	$stmt=$conn->prepare($sql);
  	$stmt->bind_param('ii',$type,$aid);
  	$stmt->execute();
  	echo "success";
  	printf($stmt->error);
  }

  public function adminblock($sesaid,$aid){ //block admin
    $conn=$this->connect();
    if($sesaid==$aid){
      echo "errself";
    }else{
      $type=0;
      $stmt=$conn->prepare("update login set adminType=? where aid=?");
      $stmt->bind_param('ii',$type,$aid);
      $stmt->execute();
      echo "success";
      printf($stmt->error);
    }
  }

  public function shchangeadmin($aid){ //show admin detail while onclick change type button
    $conn=$this->connect();
    $sql="select aid,username,adminType from login where aid= ?";
  	$stmt=$conn->prepare($sql);
  	$stmt->bind_param('i',$aid);
  	$stmt->execute();
  	$data = $stmt->get_result();
  	$result = array();
  	while($row = $data->fetch_assoc()) {
  			$result[] = $row;
  	}
  	echo json_encode($result);
  }

  public function showlog(){ //show all log
    $conn=$this->connect();
    $sql="select log.id,log.aid,login.username,log.logDateTime,log.logIp,log.countryName,log.lat,log.long From log INNER JOIN login ON log.aid=login.aid";
  	$stmt=$conn->prepare($sql);
  	$stmt->execute();
    $stmt->bind_result($rid,$raid,$rusername,$rlogDateTime,$rlogIp,$rcountryName,$rlat,$rlong);
    $array= array();
        while ($stmt->fetch()) {
          $che='<input type="checkbox" name="selectlog"  value='.$rid.'>';
            $array[]=array($che,$rid,$raid,$rusername,$rlogDateTime,$rlogIp,$rcountryName,$rlat,$rlong);
  			}
    $sql="select count(id) From log;";
  	$stmt=$conn->prepare($sql);
  	$stmt->execute();
    $stmt->bind_result($rcount);
    $stmt->fetch();
    $jsons = array('draw'=>1,'recordsTotal'=>$rcount,'recordsFiltered'=>$rcount,'data' =>$array);
    echo json_encode($jsons);
  }

  public function deladminlog($selected){ //delete log
    $conn=$this->connect();
    $sql="DELETE from log where id in (".$selected.")";
    $stmt=mysqli_query($conn,$sql);
    //printf($stmt->error);
    echo "success";
  }

  public function addadmin($adduser,$addpwd,$addtype,$addEmail,$addFname,$addLname){ //add admin function
      $result=$this->checkadmin($adduser,$addpwd,$addtype,$addEmail,$addFname,$addLname);
      echo $result;
  }

  private function checkadmin($adduser,$addpwd,$addtype,$addEmail,$addFname,$addLname){ //check admin is it exist
    $conn=$this->connect();
    $stmt=$conn->prepare("select count(username) from login where username= ?");
  	$stmt->bind_param('s',$adduser);
  	$stmt->execute();
  	$stmt->bind_result($reuser);
  	$stmt->fetch();

  	if($reuser>0){
  		echo 'exist';
  	}elseif(strlen($addpwd)<8){
  		echo "shortpass";
  	}else{
      $this->checkemail($adduser,$addpwd,$addtype,$addEmail,$addFname,$addLname);
    }
  }

  private function checkemail($adduser,$addpwd,$addtype,$addEmail,$addFname,$addLname){ //check email is it used
    $conn=$this->connect();
    $stmt=$conn->prepare("select email from profile where email= ?");
  	$stmt->bind_param('s',$addEmail);
  	$stmt->execute();
  	$stmt->bind_result($reemail);
  	$stmt->fetch();
  	if($reemail!=""||$reemail!=null){
  		echo 'existex';
  	}else{
      $this->adda($adduser,$addpwd,$addtype,$addEmail,$addFname,$addLname);
    }
  }

  private function adda($adduser,$addpwd,$addtype,$addEmail,$addFname,$addLname){ //add admin to login table
    $conn=$this->connect();
    $mpwd=hash("sha512",$addpwd);
  	$addaid=rand(1,9999999);
  	$auth;
  	$sql="insert into login (aid,username,pwd,auth,adminType) values(?,?,?,?,?)";
  	$stmt=$conn->prepare($sql);
  	$stmt->bind_param('issss',$addaid,$adduser,$mpwd,$auth,$addtype);
  	$stmt->execute();
    $this->profile($addaid,$addEmail,$addFname,$addLname);
    printf($stmt->error);
  }

  private function profile($retuenaid,$addEmail,$addFname,$addLname){ //add admin profile to profile table
    $conn=$this->connect();
    $regdate=date('Y-m-d');
  	$regip=$_SERVER['REMOTE_ADDR'];
    if($addEmail==""){
      $act=1;
    } else{
      $act=0;
      $this->actgen($retuenaid,$addEmail);
    }

  	$sql="insert into profile values(?,?,?,?,?,?,?)";
  	$stmt=$conn->prepare($sql);
  	$stmt->bind_param('isssiss',$retuenaid,$addEmail,$addFname,$addLname,$act,$regdate,$regip);
  	$stmt->execute();

    if($addEmail==""){
      echo 'success';
    }elseif($addEmail!=""){
      echo 'successact';
    }
    printf($stmt->error);
  }

  private function actgen($aid,$email){
    $id=null;
    $str = 'abcdefghijklmnopqrstuvwxyz1234567890ABC';
    $actcode = str_shuffle($str);

    $conn=$this->connect();
    $sql="insert into activate values(?,?,?)";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param('iis',$id,$aid,$actcode);
  	$stmt->execute();
    printf($stmt->error);
    $this->sendactmail($email,$actcode);
  }

  private function sendactmail($tomail,$actcode){
    $bodyhtml='<!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>MusixCloud | Error 404</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="https://admin.musixcloud.xyz/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://admin.musixcloud.xyz/asset/fontawesome/css/font-awesome.css">
        <!-- Ionicons -->
        <!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
        <!-- Theme style -->
        <link rel="stylesheet" href="https://admin.musixcloud.xyz/asset/css/login.css">
        <!-- jQuery 2.1.4 -->
        <script src="https://admin.musixcloud.xyz/asset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="https://admin.musixcloud.xyz/bootstrap/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="https://admin.musixcloud.xyz/asset/js/login.js" charset="utf-8"></script>
        <script src="https://www.google.com/jsapi"></script>
        <link rel="stylesheet" href="https://admin.musixcloud.xyz/dist/css/AdminLTE.min.css">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style media="screen">
          .expmodalbody{
            font-style: normal;
            align-content: center;
            text-align: center;
          }
          #message{
            padding-top: 5px;
            margin-top: 5px;
            text-align: center;
          }
        </style>
      </head>
      <body class="hold-transition login-page">
        <div class="login-box">
          <div class="login-logo">
          <img src="https://admin.musixcloud.xyz/img/logo.png" width="60px">
            <b>MusixCloud</b>Admin Panel
          </div>
          <div class="login-box-body">

            <p>
              Please Click the link below.
              https://admin.musixcloud.xyz/activate.php?code='.$actcode.'
            </p>

          </div>
        </div>
      </body>
    </html>
';



    date_default_timezone_set('Asia/Hong_Kong');
    require_once '../mail/phpmailer/PHPMailerAutoload.php';
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
    $mail->Subject = "MusixCloud Admin Email Confirmation";
    $mail->Body = $bodyhtml;
    if(!$mail->Send()){
          echo "Mailer Error: " . $mail->ErrorInfo;
          echo 'error';
    }else{
          //echo "success";
    }
  }

  public function actadmin($code){ //check activation code
    $conn=$this->connect();
    $sql="select aid,actcode from activate where actcode=?";
    $stmt=$conn->prepare($sql);
  	$stmt->bind_param('s',$code);
    $stmt->execute();
    $stmt->bind_result($reaid,$reactcode);
    $stmt->fetch();
    if($reaid==""){
      header("Location:https://admin.musixcloud.xyz/activate.php?act=invalid");
    }else{
      $this->actpro($reaid);
    }
  }

  private function actpro($aid){ //update profile activate
    $conn=$this->connect();
    $stat='1';
    $sql="update profile set activate=? where aid=?";
    $stmt=$conn->prepare($sql);
  	$stmt->bind_param('ii',$stat,$aid);
    $stmt->execute();
    $this->delactcode($aid);
    header("Location:https://admin.musixcloud.xyz/activate.php?act=success");
  }

  private function delactcode($aid){ //delete activation code
    $conn=$this->connect();
    $sql="delete from activate where aid=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param('i',$aid);
    $stmt->execute();
  }

  public function showadminmsg($aid){ //show admin message
    $conn=$this->connect();
    $sql="select msg.msgid,musixcloudadmin.login.username as 'from',msg.sub,msg.datetime,msg.reada from musixcloudadmin.msg inner join musixcloudadmin.login on musixcloudadmin.msg.from=musixcloudadmin.login.aid where msg.to=? order by msg.datetime DESC";
  	$stmt=$conn->prepare($sql);
  	$stmt->bind_param('i',$aid);
  	$stmt->execute();
  	$data = $stmt->get_result();
  	$result = array();
  	while($row = $data->fetch_assoc()) {
  			$result[] = $row;
  	}
  	echo json_encode($result);
  }

  public function msgdetail($msgid){ //admin msg detail
    $conn=$this->connect();
    $sql="select msg.msgid,musixcloudadmin.login.username as 'from',msg.sub,msg.msg,msg.datetime,msg.reada from musixcloudadmin.msg inner join musixcloudadmin.login on musixcloudadmin.msg.from=musixcloudadmin.login.aid where msg.msgid=?";
  	$stmt=$conn->prepare($sql);
  	$stmt->bind_param('i',$msgid);
  	$stmt->execute();
  	$data = $stmt->get_result();
  	$result = array();
  	while($row = $data->fetch_assoc()) {
  			$result[] = $row;
  	}
  	$this->reada($conn,$msgid);
  	echo json_encode($result);
  }

  private function reada($conn,$msgid){ //admin msg mark as read
  	$read=1;
  	$sql="update msg set reada=? where msg.msgid=?";
  	$stmt=$conn->prepare($sql);
  	$stmt->bind_param('ii',$read,$msgid);
  	$stmt->execute();
  }

  public function unread($msgid){ //admin msg mark as unread
    $conn=$this->connect();
  	$read=0;
  	$sql="update msg set reada=? where msg.msgid=?";
  	$stmt=$conn->prepare($sql);
  	$stmt->bind_param('ii',$read,$msgid);
  	$stmt->execute();
  	echo "success";
  }

  public function msgcount($aid){ //count admin msg
    $conn=$this->connect();
  	$sql="select count(msgid) from msg where msg.to=? and msg.reada=0";
  	$stmt=$conn->prepare($sql);
  	$stmt->bind_param('i',$aid);
  	$stmt->execute();
  	$stmt->bind_result($result);
  	$stmt->fetch();
  	echo $result;
  }

  public function delmsg($msgid){ //delete Admin Message
    $conn=$this->connect();
  	$sql="delete from msg where msgid=?";
  	$stmt=$conn->prepare($sql);
  	$stmt->bind_param('i',$msgid);
  	$stmt->execute();
  	echo "deleted";
  }

  public function shadminlist($user){ //list the admin in the send msg dialog
    $conn=$this->connect();
  		$sql="select aid,username from login where username!=?";
  		$stmt=$conn->prepare($sql);
  		$stmt->bind_param('s',$user);
  		$stmt->execute();
  		$data = $stmt->get_result();
  	     $result = array();
  	     while($row = $data->fetch_assoc()) {
  	          $result[] = $row;
  	      }
  	      echo json_encode($result);
  }

  public function sendmsg($sub,$toadmin,$msg){ //send admin msg
    $conn=$this->connect();
  	$msgid;
  	$senddate=date('Y-m-d H:i:s', time());
  	$reada=0;
  	$fromuser=$_SESSION['aid'];
  	$sql="insert into msg values (?,?,?,?,?,?,?)";
  	$stmt=$conn->prepare($sql);
  	$stmt->bind_param('iiisssi',$msgid,$fromuser,$toadmin,$sub,$msg,$senddate,$reada);
  	$stmt->execute();
  	echo "sent";
  }

  public function callemail($aid){ //admin email callback
    $conn=$this->connect();
    $sql="select email from profile where aid=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("i",$aid);
    $stmt->execute();
    $stmt->bind_result($reemail);
    $stmt->fetch();
    $arrayName = array('email' => $reemail);
    echo json_encode($arrayName);
  }

  public function newemail($newemail,$aid){ //update admin email
    $activate=0;
    $conn=$this->connect();
    $sql="update profile set email=?,activate=? where aid=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("sii",$newemail,$activate,$aid);
    $stmt->execute();
    $this->actgen($aid,$newemail);
    $arrayName = array('result' =>"success");
    echo json_encode($arrayName);
  }
}
?>
