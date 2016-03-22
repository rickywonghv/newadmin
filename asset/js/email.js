$(document).ready(function() {
  $("#saveemail").click(function(){
    var newemail=$("#newemail").val();
    newemail(newemail);

  })
});
function newemail(newemail){
  if(newemail==""){
    $("#emailcallresult").html('<div class="alert alert-danger"><strong>Error!</strong>Please enter the email! </div>');
  }else{
    $.ajax({
      url:"asset/php/adminfunction.php",
      type:"POST",
      data:"act=saveemail&newemail="+newemail,
      dataType:"json",
      success:function(response){
        if(response.result=="success"){
          $("#emailcallresult").html('<div class="alert alert-success"><strong>Success!</strong>Please activate your email! </div>');
        }else if(response.result=="fail"){
          alert("fail");
        }else{
          alert("response");
        }
      }
    }) //end ajax

  }
}
