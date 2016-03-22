function authreg(){
  $.ajax({
    url:"asset/php/adminfunction.php",
    type:"POST",
    data:"act=regauth",
    dataType:"json",
    success:function(response){
      $("#authregsecret").html(response['secret']);
      $("#authregimg").attr("src",response['qrurl']);
    }
  })
}
function authcon(){
  var secret=$("#authregsecret").text();
  $.ajax({
    url:"asset/php/adminfunction.php",
    type:"POST",
    data:"act=regconauth&secret="+secret,
    dataType:"html",
    success:function(response){
      alert(response);
    }
  })
}
$(document).ready(function() {

  $("#authsub").click(function(){
    var code=$("#code").val();
    if(google.loader.ClientLocation==null){
        var datas="act=authlogin&code="+code+"&countryname=null&latitude=null&longitude=null";
			}else{
        var countryname=google.loader.ClientLocation.address.country;
  			var latitude=google.loader.ClientLocation.latitude;
  			var longitude=google.loader.ClientLocation.longitude;
        var datas="act=authlogin&code="+code+"&countryname="+countryname+"&latitude="+latitude+"&longitude="+longitude;
      }

      $.ajax({
        url:"asset/php/adminfunction.php",
        type:"POST",
        data:datas,
        dataType:"html",
        success:function(response){

          if(response==="true"){
            window.location="index.php";
          }else{
            $(".authmsg").html('<div class="alert alert-danger"> Wrong 6 digi, please try again. </div>');
            return false;
          }
        }
      })
      return false;
  })

  $("#distwofabtn").click(function(){
    var r=confirm("Sure to disable two factor authentication? ");
  	if(r==true){
  		$.ajax({
  			url:"asset/php/adminfunction.php",
  			type:"POST",
  			data:"act=disauthtwo",
  			dataType:"html",
  			success:function(response){
  				if(response=="true"){
  					alert("Disabled");
  					window.location="index.php";
  				}else{
  					alert(response);
  					//window.location="adminlog.php";
  				}
  			}
  		})
  	}
  })

  $("#lockbtn").click(function() {
    $.ajax({
      url:"asset/php/adminfunction.php",
      type:"POST",
      data:"act=lock",
      dataType:"html",
      success:function(response){
          window.location="lock.php";
      }
    })
  });
});

function authlogin(){

}
