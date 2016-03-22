$(document).ready(function() {
   // Stuff to do as soon as the DOM is ready
   $.ajax({
     url:"asset/php/userfunction.php",
     type:"POST",
     data:"act=shusermsg",
     dataType:"json",
     success:function(response){
       json=response;
       var NumOfJData = json.length;
       for(var i = 0; i < NumOfJData; i++) {
         if(json[i]["reada"]==1){
           $("#usermsg").append("<tr><td><b>"+json[i]["usermsgid"]+"</b></td><td><b>"+json[i]["fullname"]+"</b></td><td><b>"+json[i]["title"]+"</b></td><td><button type='button' class='btn btn-success' onclick='msgmore("+json[i]["usermsgid"]+")' data-toggle='modal' data-target='#msgdet'><i class='fa fa-info'></i> <span class='hidden-xs'>Detail</span></button></td><td><button type='button' class='btn btn-danger' onclick='usermsgdel("+json[i]["usermsgid"]+")'><i class='fa fa-trash-o'></i> <span class='hidden-xs'>Delete</span></button></td></tr>");
         }else{
           $("#usermsg").append("<tr><td>"+json[i]["usermsgid"]+"</td><td>"+json[i]["fullname"]+"</td><td>"+json[i]["title"]+"</td><td><button type='button' class='btn btn-success' onclick='msgmore("+json[i]["usermsgid"]+")' data-toggle='modal' data-target='#msgdet'><i class='fa fa-info'></i> <span class='hidden-xs'>Detail</span></button></td><td><button type='button' class='btn btn-danger' onclick='usermsgdel("+json[i]["usermsgid"]+")'><i class='fa fa-trash-o'></i> <span class='hidden-xs'>Delete</span></button></td></tr>");
         }

       }
     }
   })


});
function msgmore(msgid){
  //$("#msgdeltitle").html(uid);

  $.ajax({
    url:"asset/php/userfunction.php",
    type:"POST",
    data:"act=usermsg&msgid="+msgid,
    dataType:"json",
    success:function(response){
      console.log(response);
      json=response;
        $("#msgname").html(json[0]["fullname"]);
        $("#moremsgid").html(json[0]["usermsgid"]);
        $("#moremsgtitle").html(json[0]["title"]);
        $("#moremsgip").html(json[0]["ipadd"]);
        $("#moremsgdate").html(json[0]["date"]);
        $("#moremsg").html(json[0]["msg"]);
        $("#closemsgdet").click(function(){
          window.location="usermsg.php";
        })

        return false;
    }
  });
  return false;
}

function usermsgdel(msgid){
  var a=confirm("Are you sure to delete the message that you selected!");
	if(a==true){
		$.ajax({
			type:"POST",
			url:"asset/php/userfunction.php",
			data:"act=userdelmsg&msgid="+msgid,
			success:function(response){
				if(response=="success"){
					alert("Delete successful");
					window.location="usermsg.php";
				}else{
					alert("Error");
					window.location="usermsg.php";
				}
			}
		})
	}
}
