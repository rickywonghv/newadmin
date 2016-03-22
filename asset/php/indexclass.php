<?php
/**
 * Index Content Class extends to get the SQL connect for musixcloud db.
 */
require_once "musicclass.php";
class index extends adminmusic
{
  private function ckpermission($aid){
    $conn=$this->connectadmin();
    $stmt=$conn->prepare("select adminType from login where aid=?");
    $stmt->bind_param('i',$aid);
    $stmt->execute();
    $stmt->bind_result($admintype);
    $stmt->fetch();
    if($admintype!=3){
      return false;
    }else{
      return true;
    }
  }
  public function showabout($aid){
    $ck=$this->ckpermission($aid);
    if($ck){
      $conn=$this->connectuser();
      mysqli_set_charset($conn,"utf8");
      $stmt=$conn->prepare("select * from content where type=1");
    	$stmt->execute();
      $data = $stmt->get_result();
         $result = array();
         while($row = $data->fetch_assoc()) {
              $result[] = $row;
          }
          print_r(json_encode($result));
    }else{
      $arrayName = array('error' =>"No Permission" );
      return json_encode($arrayName);
    }

  }

  public function updateAbout($aid,$cont,$lang){ //update about us
    $ck=$this->ckpermission($aid);
    if($ck){
      if(strlen($cont)<=0){
        $arrayName = array('error' =>'too short');
        return json_encode($arrayName);
      }else{
        if($lang=="eng"){
          $lang=1;
        }elseif($lang=="chi"){
          $lang=2;
        }
        $updateDate=date("Y-m-d H:i:s");
        $conn=$this->connectuser();
        mysqli_set_charset($conn,"utf8");
        $sql="update content set content=?,conDateTime=? where language=?";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("ssi",$cont,$updateDate,$lang);
        $stmt->execute();
        $arrayName = array('status'=>"success");
        return json_encode($arrayName);
      }
    }else{
      $arrayName = array('error' =>"No Permission" );
      return json_encode($arrayName);
    }
  }

}


 ?>
