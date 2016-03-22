$(document).ready(function(){



	$("#unlockbtn").click(function(){
		var unlockpwd=$("#lockpwd").val();
		$.ajax({
			url:"asset/php/cklogin.php",
			type:"POST",
			data:"act=unlock&unlockpwd="+unlockpwd,
			success:function(response){
				if(response=="success"){
					window.location="index.php";
				}else if(response=="wrong"){
					//alert(response);
					$("#message").html('<div class="alert alert-danger"><strong>Error!</strong> Wrong Password!</div>');
					return false;
				}else if(response=="block"){
					$("#message").html('<div class="alert alert-danger"><strong>Error!</strong> Your account has been blocked!</div>');
					return false;
				}
			}
		})
	})
	$("form").submit(function() {
		login();
});
})

var onloadCallback = function() {
        grecaptcha.render('html_element', {
          'sitekey' : '6Ld5dRoTAAAAAHV-fyiGpdZbWg5okdZZKUe69A8_'
        });

      };



function login(){

	if(google.loader.ClientLocation==null){
		if(user.length>0&&pass.length>0){
			$.ajax({
				type:"POST",
				data:$("form").serialize()+"&countryname=null&latitude=null&longitude=null",
				url:"asset/php/cklogin.php?act=login",
				dataType:"html",
				beforeSend: function() {
						$("#message").html('<img src="img/loading.gif">');
				 },
				success:function(html){
					if(html=='true'){
							window.location='index.php';
					}else if(html=="block"){
						$("#message").html('<div class="alert alert-danger"><strong>Error!</strong>Your account has been blocked! </div>');
						return false;
					}else if (html=='auth') {
						window.location='auth.php';
					}
					else if(html=="noact"){
						$("#message").html('<div class="alert alert-warning"><strong>Error!</strong>Your email did not activate! Please activate before login.</div>');
						return false;
					}
					else if(html=="wrong"){
						$("#message").html('<div class="alert alert-warning"><strong>Error!</strong>Wrong Username or Password</div>');
						return false;
					}
				}
			});
			return false;
		}else{
			$("#message").html('<div class="alert alert-danger"><strong>Error!</strong> Please fill in Username and Password!</div>');
			return false;
		}
	}else{
		if(user.length>0&&pass.length>0){
		var countryname=google.loader.ClientLocation.address.country;
		var latitude=google.loader.ClientLocation.latitude;
		var longitude=google.loader.ClientLocation.longitude;
			$.ajax({
				type:"POST",
				data:$("form").serialize()+"&countryname="+countryname+"&latitude="+latitude+"&longitude="+longitude,
				url:"asset/php/cklogin.php?act=login",
				dataType:"html",
				success:function(html){
					if(html=='true'){
							window.location='index.php';
					}else if(html=="block"){
						$("#message").html('<div class="alert alert-danger"><strong>Error!</strong>Your account has been blocked! </div>');
						return false;
					}else if (html=='auth') {
						window.location='auth.php';
					}
					else if(html=="noact"){
						$("#message").html('<div class="alert alert-warning"><strong>Error!</strong>Your email did not activate! Please activate before login.</div>');
						return false;
					}
					else if(html=="wrong"){
						$("#message").html('<div class="alert alert-warning"><strong>Error!</strong>Wrong Username or Password</div>');
						return false;
					}
				}
			});
			return false;
	}else{
		$("#message").html('<div class="alert alert-danger"><strong>Error!</strong> Please fill in Username and Password!</div>');
		return false;
	}
	}


}

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
    	vars[key] = value;
    });
    return vars;
}
function ck(){
	var getpro = getUrlVars()["act"];
	var getid=getUrlVars()["id"];
	if(getpro==="expire"&&(getid!="")||(getid!=null)){
		$("#expiremodal").modal({show:true});
		$("#message").html('<div class="alert alert-danger"><strong><i class="fa fa-clock-o"></i></strong> Session Expired! </div>');
	}else if (getpro==="expireauth") {
		$("#message").html('<div class="alert alert-danger"><strong><i class="fa fa-clock-o"></i></strong> Session Expired! </div>');
	}
	else if (getpro==="loginfrom") {
		$("#message").html('<div class="alert alert-warning"><strong><i class="fa fa-user"></i></strong> Your account login from other way! Session Invalid </div>');
	}
}
jQuery(document).ready(function($) {
	ck();
});
