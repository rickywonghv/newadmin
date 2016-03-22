<?php
function check(){
  if(isset($_SESSION['username'])||isset($_SESSION['aid'])||isset($_SESSION['type'])){
    sessionset($_SESSION['username'],$_SESSION['aid'],$_SESSION['type']);
  }else{
    session_destroy();
    session_unset();
  }
}


function sessionset($user,$aid,$type){
  if(isset($user)&&isset($aid)&&isset($type)){
    header("Location:index.php");
  }else{

  }
}


 ?>
