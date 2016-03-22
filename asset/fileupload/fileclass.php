<?php
/**
 * File Upload Class
 */
 require_once "../s3/S3.php";
class fileclass extends S3{
  private $apiPublic="AKIAICVVTJOLPMFXXUTQ"; //S3 API KEY
  private $apiSecret="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"; //S3 API KEY
  private $bucketName="musixcloud"; //S3 bucket Name

  protected function connect(){
    return new S3($this->apiPublic,$this->apiSecret);
  }

  public function upload(){
    $ck=$this->ckfile();

    if($ck){
      $filename=$this->ckname();
      $file=$_FILES["uploadfile"]["tmp_name"];
      $s3=$this->connect();
      $bucketName=$this->bucketName;
      $s3->putObject($s3->inputResource(fopen($file, 'rb'), filesize($file)), $bucketName, "share/".$filename, $s3->ACL_PRIVATE);
      return $filename." Uploaded";
    }elseif($ck=="large"){
      return "Too Large";
    }
    else{
        return "Empty File";
    }
  }

  private function ckname(){
    if(!empty($_POST['customFileName'])){
      $filename=$_POST['customFileName'];
    }else{
      $filename=basename($_FILES["uploadfile"]["name"]);
    }
    return str_replace('+', '', $filename);
  }

  private function ckfile(){
    if(empty($_FILES['uploadfile'])){
        return false;
    }elseif(filesize($_FILES['uploadfile']["tmp_name"])>=9990000){
      return "large";
    }else{
      return true;
    }
  }

  public function getdetail(){
    $s3=$this->connect();
    $name=$_POST['filename'];
    $uri="https://s3-ap-southeast-1.amazonaws.com/musixcloud/".$name;
    $result=$s3->getObjectInfo($this->bucketName, $name,$returnInfo=true);
    return $result;
  }
}

 ?>
