<?php
/**
 * MusixCloud Music Class
 */
class adminmusic{
  private $dbhost="fypsg.cpnxlvkuunux.ap-southeast-1.rds.amazonaws.com";
  private $dbuser="fyp";
  private $dbpwd="basa3aTR";
  private $dbname="musixcloud";
  private $admindbname="musixcloudadmin";

  protected function connectuser(){ //connect to the musixcloud db using mysqli
    return  new mysqli($this->dbhost,$this->dbuser, $this->dbpwd, $this->dbname);
  }

  protected function connectadmin(){ //connect to the musixcloud db using mysqli
    return  new mysqli($this->dbhost,$this->dbuser, $this->dbpwd, $this->admindbname);
  }

  public function listmusic(){ //list all the music
    $conn=$this->connectuser();
    mysqli_set_charset($conn,"utf8");
    $stmt=$conn->prepare("select * from music");
  	$stmt->execute();
  	$data = $stmt->get_result();
       $result = array();
       while($row = $data->fetch_assoc()) {
            $result[] = $row;
        }
        print_r(json_encode($result));
  }

  public function detmusic($id){ //show detail of the music
    $conn=$this->connectuser();
    mysqli_set_charset($conn,"utf8");
  	$sql="select * from music where songid=?";
  	$stmt=$conn->prepare($sql);
  	$stmt->bind_param('i',$id);
  	$stmt->execute();
  	$data = $stmt->get_result();
       $result = array();
       while($row = $data->fetch_assoc()) {
            $result[] = $row;
        }
        echo json_encode($result);
  }

  public function delmusic($musicid){ //delete Music
    $conn=$this->connectuser();
    mysqli_set_charset($conn,"utf8");
  	try{
  		$sql="delete from music where songid=?";
  		$stmt=$conn->prepare($sql);
  		$stmt->bind_param('i',$musicid);
  		$stmt->execute();
  		echo "success";
  	}catch(Exception $e){
  		printf($e->getMessage());
  	}
  }

  public function listreport(){ //list all the music report
    $conn=$this->connectuser();
    mysqli_set_charset($conn,"utf8");
    $sql="SELECT * FROM musixcloud.reportMusic_v";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->get_result();
       $result = array();
       while($row = $data->fetch_assoc()) {
            $result[] = $row;
        }
        echo json_encode($result);
  }

  public function detreport($rid){ //detail of the music report
    $conn=$this->connectuser();
    mysqli_set_charset($conn,"utf8");
    $sql="SELECT * FROM musixcloud.reportMusic_v where reportId=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param('i',$rid);
    $stmt->execute();
    $data = $stmt->get_result();
       $result = array();
       while($row = $data->fetch_assoc()) {
            $result[] = $row;
        }
        echo json_encode($result);
  }

}




 ?>
