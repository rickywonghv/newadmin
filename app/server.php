<?php
/**
 * MusixCloud Server Information Class
 */

 class serverinfo{
   private $host="fypsg.cpnxlvkuunux.ap-southeast-1.rds.amazonaws.com";
   private $user="fyp";
   private $pwd="basa3aTR";
   private $db="musixcloudadmin";

   protected function connect()
   {
     return new mysqli($this->host,$this->user, $this->pwd, $this->db);
   }

  public function dbprocess(){
    $conn=$this->connect();
    $sql="show processlist";
    if($stmt=$conn->prepare($sql)){
      $stmt->execute();
      $data = $stmt->get_result();
   	$result = array();
   	 while($row = $data->fetch_assoc()) {
   			$result[] = $row;
   	}
   	 echo json_encode($result);
    }
  }

  public function dbstat(){
    $conn=$this->connect();
    $sql="show status where Variable_name='Uptime'";
    if($stmt=$conn->prepare($sql)){
      $stmt->execute();
      $data = $stmt->get_result();
   	$result = array();
   	 while($row = $data->fetch_assoc()) {
   			$result[] = $row;
   	}
    $day = floor($result[0]['Value']/86400);
    $hour = floor(($result[0]['Value'] % 86400)/3600);
    $minute = floor((($result[0]['Value'] % 86400) % 3600)/60);
    $second = (($result[0]['Value'] % 86400) % 3600) % 60;

    $endpoint;
    $mysqlver=$conn->server_info; //Mysql version
    $uparr = array('day' =>$day ,'time'=>$hour.":".$minute.":".$second,'version'=>$mysqlver,'endpoint'=>$endpoint);


   	print_r(json_encode($uparr));
    }
  }

  public function dbglo(){
    $conn=$this->connect();
    $sql="show global status like '%conn%';";
    if($stmt=$conn->prepare($sql)){
      $stmt->execute();
      $data = $stmt->get_result();
   	$result = array();
   	 while($row = $data->fetch_assoc()) {
   			$result[] = $row;
   	}
   	echo json_encode($result);
    }
  }

  public function dbname(){
    $conn=$this->connect();
    echo $this->conn->adminhost;
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

 }
  ?>
