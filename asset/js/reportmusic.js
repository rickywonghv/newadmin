$(document).ready(function() {
  listreport();

});
function listreport(){
  $.ajax({
    url:"asset/php/musicfunction.php?act=listreport",
    dataType:'json',
    success:function(response){
      json=response;
          var NumOfJData = json.length;
          for(var i = 0; i < NumOfJData; i++) {
            $("#listreporttable").append("<tr><td>"+json[i]['reportId']+"</td><td>"+json[i]['musicId']+"</td><td>"+json[i]['musicName']+"</td><td>"+json[i]['uid']+"</td><td>"+json[i]['userName']+"</td><td>"+json[i]['datetime']+"</td><td><button class='btn btn-info' data-toggle='modal' data-target='#reportdetail' onclick='redetail("+json[i]['reportId']+")'><i class='fa fa-info-circle'></i> <span class='hidden-xs'>Detail</span></button></td></tr>");
          }


    }
  })
}

function redetail(reportid){

  $("#dreportid").html(reportid);
  $.ajax({
    url:"asset/php/musicfunction.php?act=detailreport&rid="+reportid,
    dataType:'json',
    success:function(response){
      json=response;
          var NumOfJData = json.length;
          for(var i = 0; i < NumOfJData; i++) {
            $("#dmusicid").html(json[i]['musicId']);
            $("#dmusicname").html(json[i]['musicName']);
            $("#duid").html(json[i]['uid']);
            $("#duname").html(json[i]['userName']);
            $("#dreason").html(json[i]['reason']);
            $("#ddatetime").html(json[i]['datetime']);
            $("#ddetailmusic").html("<button data-toggle='modal' data-target='#mdetailmodal' class='btn btn-info' onclick=musicdetail("+json[i]["musicId"]+")>Music Detail</button>")
          }
    }
  })
}

function musicdetail(id){
  $('#reportdetail').modal('hide');
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
