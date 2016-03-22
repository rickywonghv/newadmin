$(document).ready(function() {
  $(".chpwdform").submit(function() {
    /* Act on the event */
    var opwd=$("#opwd").val();
    var npwd=$("#npwd").val();
    var npwdb=$("#npwdb").val();
    var msg=$("#chpwdmsg");
    if(opwd==""||npwd==""||npwdb==""){
      msg.html('<div class="alert alert-danger"> Please fill in all column</div>');
      return false;
    }else if(npwd!=npwdb){
      msg.html('<div class="alert alert-danger"> Password not match.</div>');
      return false;
    }else if(npwd.length<8||npwdb.length<8){
      msg.html('<div class="alert alert-danger"> Password too short.</div>');
      return false;
    }else{
      $.ajax({
        url:"asset/php/adminfunction.php",
        type:"POST",
        data:"act=chadminpwd&opwd="+opwd+"&npwd="+npwd+"&npwdb="+npwdb,
        dataType:"html",
        success:function(response){
          if(response=="success"){
            alert("Change successfully");
            window.location="index.php";
          }else if(response=="wrongpwd"){
            msg.html('<div class="alert alert-danger"> Wrong old password.</div>');
            return false;
          }
        }
      })
    }
    return false;
  });
});
