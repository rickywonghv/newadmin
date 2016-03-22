$(document).ready(function(){
	$.ajax({
		type:"GET",
		url:"asset/userlogfunction.php?act=shlog",
		dataType:"json",
		success:function(response){
			json=response;
			var NumOfJData = json.length;							
				for(var i = 0; i < NumOfJData; i++) {
					$("#listlog").append("<tr><td>"+json[i]['logid']+"</td><td>"+json[i]['userid']+"</td><td>"+json[i]['username']+"</td><td>"+json[i]['logindate']+"</td><td>"+json[i]['logintime']+"</td><td>"+json[i]['logip']+"</td><td>"+json[i]['country']+"</td><td>"+json[i]['latitude']+"</td><td>"+json[i]['longitude']+"</td></tr>");		
				}

		}
	})
})

function dellog(){
	var r=confirm("Sure to delete 4 days records? ");
	if(r==true){
		$.ajax({
			url:"asset/userlogfunction.php?act=dellog",
			type:"GET",
			data:"html",
			success:function(response){
				if(response=="success"){
					alert("Delete Successful");
					window.location="userlog.php";
				}else{
					alert("error");
					window.location="userlog.php";
				}
			}
		})
	}
}