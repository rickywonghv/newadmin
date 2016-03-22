$(document).ready(function(){
	$.ajax({
		type:"GET",
		url:"asset/php/adminlog.php?act=shlog",
		dataType:"json",
		success:function(response){
			json=response;
			var NumOfJData = json.length;
				for(var i = 0; i < NumOfJData; i++) {
					$("#listlog").append("<tr><td>"+json[i]['id']+"</td><td>"+json[i]['aid']+"</td><td>"+json[i]['username']+"</td><td>"+json[i]['logDateTime']+"</td><td>"+json[i]['logIp']+"</td><td>"+json[i]['countryName']+"</td><td>"+json[i]['lat']+"</td><td>"+json[i]['long']+"</td></tr>");
				}
		}
	})
	shcount();
})

function dellog(){
	var r=confirm("Sure to delete 4 days records? ");
	if(r==true){
		$.ajax({
			url:"asset/php/adminfunction.php?act=dellog",
			type:"GET",
			data:"html",
			success:function(response){
				if(response=="success"){
					alert("Delete Successful");
					window.location="adminlog.php";
				}else{
					alert("error");
					window.location="adminlog.php";
				}
			}
		})
	}
}

function shcount(){
	$.ajax({
		type:"GET",
		url:"asset/php/adminlog.php?act=count",
		dataType:"html",
		success:function(response){
			$("#adminlogcount").html(response);
		}
	})
}
