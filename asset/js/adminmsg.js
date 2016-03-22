$(document).ready(function(){
	$.ajax({
		type:"GET",
		url:"asset/php/adminfunction.php?act=shadminmsg",
		dataType:"json",
		success:function(response){
			json=response;
						if(json==""){
							$("#amsgbody").html('<tr><td colspan=7><div class="alert alert-warning">No Message! </div></td></tr>');
						}else{
							var NumOfJData = json.length;
							for(var i = 0; i < NumOfJData; i++) {
								if(json[i]["reada"]==0){
								$("#amsgbody").append("<tr><td class='hidden-xs'><b>"+json[i]["msgid"]+"</b></td><td><b>"+json[i]["from"]+"</b></td><td><b>"+json[i]["sub"]+"</b></td><td><b>"+json[i]["datetime"]+"</b></td><td><button class='btn btn-info' data-toggle='modal' data-target='#msgmodal' onclick='msgdetail("+json[i]["msgid"]+")'><i class='fa fa-eye'></i> <span class='hidden-xs'>Detail</span></button></td><td><button class='btn btn-danger' onclick='msgdel("+json[i]["msgid"]+")'><i class='fa fa-trash'></i> <span class='hidden-xs'>Delete</span></button></td></tr>");
							}else{
								$("#amsgbody").append("<tr><td class='hidden-xs'>"+json[i]["msgid"]+"</td><td>"+json[i]["from"]+"</td><td>"+json[i]["sub"]+"</td><td>"+json[i]["datetime"]+"</td><td><button class='btn btn-info' data-toggle='modal' data-target='#msgmodal' onclick='msgdetail("+json[i]["msgid"]+")'><i class='fa fa-eye'></i> <span class='hidden-xs'>Detail</span></button></td><td><button class='btn btn-danger' onclick='msgdel("+json[i]["msgid"]+")'><i class='fa fa-trash'></i> <span class='hidden-xs'>Delete</span></button></td><td><button class='btn' onclick='unread("+json[i]['msgid']+")'><i class='fa fa-envelope'></i></button></td></tr>");
							}
							}
						}
		}
	})
	$("#msgsendmodal").click(function(){
		$.ajax({
			url:"asset/php/adminfunction.php?act=shadminlist",
			type:"GET",
			dataType:"json",
			success:function(response){
				json=response;
				var NumOfJData = json.length;
							for(var i = 0; i < NumOfJData; i++) {
								$("#toadmin").append('<option value='+json[i]["aid"]+'>'+json[i]["username"]+'</option>');
							}
			}
		})
	})

	$("#sendBtn").click(function(){
		var toadmin=$("#toadmin").val();
		var msg=$("#msgtext").val();
		var sub=$("#sendsubject").val();
		if(sub==""){
			$("#callbackmsg").html('<div class="alert alert-danger"><strong>Error!</strong>Please enter before send! </div>');
			return false;
		}else if (msg=="") {
			$("#callbackmsg").html('<div class="alert alert-danger"><strong>Error!</strong>Please enter Content!</div>');
			return false;
		}
		else{
			$.ajax({
				type:"POST",
				url:"asset/php/adminfunction.php",
				data:"sub="+sub+"&toadmin="+toadmin+"&msg="+msg+"&act=sendmsg",
				success:function(response){
					if(response=="sent"){
						$("#callbackmsg").html('<div class="alert alert-success"><strong>Success!</strong>Your Message sent! </div>');
						return false;
					}else{
						$("#callbackmsg").html('<div class="alert alert-danger"><strong>Error!</strong>'+response+'</div>');
						return false;
					}
				}
			})
			return false;
		}
	})

})

function msgdetail(id){
	$.ajax({
		type:"GET",
		url:"asset/php/adminfunction.php?act=msgdetail&msgid="+id,
		dataType:"json",
		success:function(response){
			json=response;
			var NumOfJData = json.length;
							for(var i = 0; i < NumOfJData; i++) {

								$("#fadmin").html(json[i]["from"]);
								$("#msg").html(json[i]["msg"]);
								$("#datetime").html(json[i]["datetime"]);
								$("#sub").html(json[i]["sub"]);
								$("#adminclosemsg").click(function(){
									window.location="adminmsg.php";
								})
							}
		}
	})
}

function msgdel(id){
	var a=confirm("Are you sure to delete the message that you selected!");
	if(a==true){
		$.ajax({
			type:"POST",
			url:"asset/php/adminfunction.php",
			data:"act=delmsg&msgid="+id,
			success:function(response){
				if(response=="deleted"){
					alert("Delete successful");
					window.location="adminmsg.php";
				}else{
					alert(response);
					window.location="adminmsg.php";
				}
			}
		})
	}
}
function unread(msgid){
	var a=confirm("Are you sure to mark the message to unread!");
	if(a==true){
		$.ajax({
			url:"asset/php/adminfunction.php?act=unread&msgid="+msgid,
			success:function(response){
				if(response=="success"){
					alert("Successful");
					window.location="adminmsg.php";
				}else{
					//alert("Error");
					window.location="adminmsg.php";
				}
			}
		})
	}
}
