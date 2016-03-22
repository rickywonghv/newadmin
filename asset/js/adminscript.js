function view(aid){ //view admin detail
	$.ajax({
		url:'asset/php/adminfunction.php?act=view&aid='+aid,
		dataType:'json',
		success:function(res){
			json=res;
			for (var i = 0; i < json.length; i++) {
				if(json[i]['adminType']=="3"){
					$(".widget-user-header").attr('class','widget-user-header bg-yellow');
				}else if(json[i]['adminType']=="2"){
					$(".widget-user-header").attr('class','widget-user-header bg-aqua-active');
				}else if(json[i]['adminType']=="1"){
					$(".widget-user-header").attr('class','widget-user-header bg-green');
				}else if(json[i]['adminType']=="0"){
					$(".widget-user-header").attr('class','widget-user-header bg-red');
				}
				var atype;
				if(json[i]['adminType']=="3"){
					atype="Super Admin";
				}else if (json[i]['adminType']=="2") {
					atype="Admin";
				}else if (json[i]['adminType']=="1") {
					atype="Music Admin";
				}else if (json[i]['adminType']=="0") {
					atype="Block";
				}
				$('.viewuser').html(json[i]['username']);
				$("#viewaid").html(json[i]['aid']);
				$(".viewstatus").html(atype);
				$("#viewemail").html(json[i]['email']);
				$(".fullname").html(json[i]['firstName']+" "+json[i]['lastName']);
				$(".regdate").html(json[i]['regDate']);
				$(".regip").html(json[i]['regIp']);
				if(json[i]['type']=='block'){
					$("#viewstatus").prop('class',"label label-danger");
				}else{
					$("#viewstatus").prop('class',"label label-default");
				}

			}
		}
	})
}

function addadmin(settype){ //add admin
	var user=$("#user").val();
	var pwda=$("#pwd").val();
	var pwdb=$("#pwdb").val();
	var type=$("#addadmintype").val();
	var email=$("#email").val();
	var fname=$("#fname").val();
	var lname=$("#lname").val();
//permission
//	var addadminper=

	//madminper
	//logadminper
/*
	var addadminper=$("#addadminper").is(":checked");
	var aadmin;
	if(addadminper==true){
		aadmin=1;
	}else{
		aadmin=0;
	}

	alert(aadmin);

	var madminper=$("#madminper").is(":checked");
	var madmin;
	if(madminper==true){
		madmin=1;
	}else{
		madmin=0;
	}

alert(madmin);

//});
*/
//permission end

	if(user==""||pwda==""||pwdb==""||type==""||fname==""||lname==""){
		$('#response').html('<div class="alert alert-warning"><strong>Warning!</strong>Should fill in the column!</div>');
	}else	if(pwda.length<8){
		$('#response').html('<div class="alert alert-warning"><strong>Warning!</strong>Password length should more than 7!</div>');
		//return false;
	}	else if(pwda!=pwdb){
		$('#response').html('<div class="alert alert-warning"><strong>Warning!</strong>Password are not match! </div>');
		//return false;
	}else if(user==""||pwda==""||pwdb==""||type==""||fname==""||lname==""){
		$('#response').html('<div class="alert alert-warning"><strong>Warning!</strong>Should fill in the column!</div>');
	}else{
		$.ajax({
			type:'POST',
			data:'user='+user+'&pwd='+pwda+'&type='+type+'&email='+email+"&fname="+fname+"&lname="+lname+"&act=addadmin",
			url:'asset/php/adminfunction.php',
			success:function(response){
				if(response=='success'){
					$('#response').html('<div class="alert alert-success"><strong>Success!</strong>Add Successfully.</div>');
					return false;
					window.location='admin.php';
				}else if(response=="shortpass"){
					$('#response').html('<div class="alert alert-warning"><strong>Warning!</strong>Password is too short! Password length should more than 7 !</div>');

				}else if(response=='existex'){
					$('#response').html('<div class="alert alert-warning"><strong>Warning!</strong>The Email exist already! </div>');

				}else if(response=='successact'){
					$('#response').html('<div class="alert alert-success"><strong>Success!</strong>The activation Email sent already! Please activate the accont before login! </div>');
				}else if(response=='exist'){
					$('#response').html('<div class="alert alert-warning"><strong>Warning!</strong>This admin exist already! </div>');
				}
			}
		});
	return false;
	}

}

function block(aid){ //block admin

		var r=confirm("Sure to block?");
		if(r==true){
			$.ajax({
				type:"GET",
				url:"asset/php/adminfunction.php?act=block&aid="+aid,
				dataType:'html',
				success:function(response){
					if(response=="success"){
						alert("Already blocked");
						window.location="admin.php";
					}else if(response=="errself"){
						alert("You can not block yourself!");
						window.location="admin.php";
					}
				}
			})
		}


}

function editsh(aid){ //show admin while click change type button
	var aid=aid;
	$.ajax({
		url:'asset/php/adminfunction.php?act=shedit&aid='+aid,
		dataType:'json',
		success:function(res){
			json=res;
			for (var i = 0; i < json.length; i++) {
				var atype;
				if(json[i]['adminType']=="3"){
					atype="Super Admin";
				}else if (json[i]['adminType']=="2") {
					atype="Admin";
				}else if (json[i]['adminType']=="1") {
					atype="Music Admin";
				}else if (json[i]['adminType']=="0") {
					atype="Block";
				}
				$('.editauser').html(json[i]['username']);
				$("#editaid").html(json[i]['aid']);
				$("#adminstatus").html(atype);
				$("#editAdminBtn").attr("onclick","chtype("+json[i]['aid']+");");
				if(json[i]['type']=='0'){
					$("#adminstatus").prop('class',"label label-danger");
				}else{
					$("#adminstatus").prop('class',"label label-default");
				}

			}
		}
	})
}

function chtype(aid){ //change admin type
	var aid=aid;
		var admintype=$("#chtartype").val();
		var r=confirm("Sure to change the type to "+admintype+"?");
		if(r==true){
			$.ajax({
				url:"asset/php/adminfunction.php",
				type:"POST",
				data:"aid="+aid+"&type="+admintype+"&act=chtype",
				dataType:"html",
				ifModified:true,
				cache:false,
				success:function(response){
					if(response=="success"){
						alert("Type has been save");
						window.location="admin.php";
						return false;
						//window.load("admin.php");
					}else{
						alert("Error");
						return false;
						//window.load("admin.php");
					}
				}
			})
			return false;
		}
}

function selectlog() { //admin select log
 var selected = [];
 $('input[name=selectlog]:checked').each(function() {
	 selected.push($(this).val());
 });
 dellog(selected);
}

function dellog(selected){ //delete admin log
	var r=confirm("Sure to delete record "+selected);
	if(r==true){
		$.ajax({
			url:"asset/php/adminfunction.php?act=dellog",
			type:"POST",
			data:"selected="+selected,
			dataType:"html",
			success:function(response){
				if(response=="success"){
					alert("Delete Successful");
					window.location="adminlog.php";
				}else{
					alert(response);
					//window.location="adminlog.php";
				}
			}
		})
	}
}
