$(document).ready(function() {
  listfile();


});

function listfile(){
  $.ajax({
    url:"asset/s3/list.php",
    dataType:"json",
    success:function(response){
      json=response;
      var NumOfJData = json.length;
      $("#listallfile").append('<li class="list-group-item filelistgroup"><h5>File Name</h5> </li>');
      for (var i = 1; i < NumOfJData; i++) {
        var mbsize=json[i]['size']/1024/1024;
        var size=Math.round(mbsize* 1000)/1000;
        $("#listallfile").append('<li class="list-group-item filelistgroup"><div class="items" id="'+json[i]['name']+'"><a href="https://s3-ap-southeast-1.amazonaws.com/musixcloud/'+json[i]['name']+'"><span class="refilename">'+json[i]['name']+'</span></a>  <span class="delfilebtn"><a class="btn btn-danger btn-xs" href="file.php?act=del&filename='+json[i]['name']+'"><i class="fa fa-trash-o"></i><span class="hidden-xs"> Delete</span></a></span> <span class="pull-right">'+size+'<b>MB</b></span></div></li>');
      }
      $(".totalfiles").html(i-1);
      return false;
    }
  })
}

function sdel(name){
  var a=confirm("Are you sure to delete "+name+"!");
	if(a==true){
		$.ajax({
			url:"asset/s3/musixclouds3.php",
      type:"POST",
      data:"act=delfile&filename="+name,
			success:function(response){
				if(response=="success"){
					alert("Successful");
					window.location="file.php";
				}else{
					alert("Error");
					window.location="file.php";
				}

			}
		})
	}else{
    window.location="file.php";
  }
}
function dell(name){
  sdel(name);
}
