<?php
/**
 *
 */
 require_once "server.php";
class phoneapp extends serverinfo{

  public function login($loginuser,$loginpwd){
    $conn=$this->connect();
    $stmt=$conn->prepare("SELECT * FROM login WHERE username=?");
    $stmt->bind_param('s',$loginuser);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($raid,$ruser,$rpwd,$rauth,$rtype);
    $stmt->fetch();
    $hpwd=hash("sha512",$loginpwd);
    if($ruser==$loginuser&&$rpwd==$hpwd&&$rtype!=0){
      $arr = array('status' =>'true');
      echo json_encode($arr);
    }elseif($rtype===0){
      $arr = array('status' =>'block');
      echo json_encode($arr);
    }else{
      $arr = array('status' =>'wrong');
      echo json_encode($arr);
    }
  }

  public function adminlog(){
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
}

 ?>
