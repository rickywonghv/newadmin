$(document).ready(function(){
	$.ajax({
		type:"GET",
		url:"asset/php/musicfunction.php?act=shmusic",
		dataType:'json',
		success:function(response){
					json=response;
						if(json==""){
							$("#listmusic").html('<tr><td colspan=7><div class="alert alert-warning">No Song! </div></td></tr>');
						}else{
							var NumOfJData = json.length;
							for(var i = 0; i < NumOfJData; i++) {
								$("#listmusic").append("<tr><td><button class='song btn' value='play.php?url="+json[i]['songPath']+"' >"+json[i]["title"]+"</button></td><td>"+json[i]["singer"]+"</td><td>"+json[i]["uploadDateTime"]+"</td><td>"+json[i]["totalPlay"]+"</td><td>"+json[i]["totalDownload"]+"</td><td><button id='mdetailbtn' class='btn btn-info' data-toggle='modal' data-target='#mdetailmodal' onclick=mdetail("+json[i]["songid"]+")>Detail</button></td><td><button id='musicdelbtn' class='btn btn-danger' onclick='musicdel("+json[i]["songid"]+")'>Delete</button></td><tr>");
							}
						}
		}
	})
});

function musicdel(id){
	var musicid=id;
	if(musicid==""){
		alert("Please select a song to delete!");
	}else{
		var a=confirm("Are you sure to Delete this song?");
		if(a==true){
			$.ajax({
				type:"POST",
				data:"musicid="+musicid+"&act=del",
				url:"asset/php/musicfunction.php",
				success:function(response){
					if(response=="success"){
						alert("The song is already deleted.");
						window.location="music.php";
					}else{
						alert("Error");
						window.location="music.php";
					}

				}
			})
		}
	}
}

function mdetail(id){
	var musicid=id;
	$.ajax({
		type:"GET",
		url:"asset/php/musicfunction.php?act=det&songid="+musicid,
		dataType:'json',
		success:function(response){
			json=response;
						if(json==""){
							$("#listmusic").html('<tr><td colspan=7><div class="alert alert-warning">No Song! </div></td></tr>');
						}else{
							var NumOfJData = json.length;
							for(var i = 0; i < NumOfJData; i++) {
								$("#songid").html(json[i]["songid"]);
								$("#songname").html(json[i]["title"]);
								$("#lyricist").html(json[i]["lyricist"]);
								$("#singer").html(json[i]["singer"]);
								$("#composer").html(json[i]["composer"]);
								$("#album").html(json[i]["album"]);
								$("#track").html(json[i]["track"]);
								$("#year").html(json[i]["year"]);
								$("#copyright").html(json[i]["copyright"]);
								$("#artpath").html(json[i]["artPath"]);
								$("#lyrics").html(json[i]["lyrics"]);
								$("#uploadtime").html(json[i]["uploadDateTime"]);
								$("#totalplay").html(json[i]["totalPlay"]);
								$("#totaldownload").html(json[i]["totalDownload"]);
								$("#songpath").html(json[i]["songPath"]);
								$("#uploadUser").html(json[i]["userid"]);

							}

						}
		}
	})
}
