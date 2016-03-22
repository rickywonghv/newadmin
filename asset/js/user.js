$(document).ready(function(){
  $.ajax({
    url:"asset/php/userfunction.php?act=shuser",
    dataType:"json",
    success:function(response){
      //console.log(response[0]);
      json=response;
      var NumOfJData = json.length;
      for(var i = 0; i < NumOfJData; i++) {
        $("#userlist").append("<tr><td>"+json[i]["userid"]+"</td><td>"+json[i]["email"]+"</td><td>"+json[i]["fullname"]+"</td><td><button type='button' onclick='viewuser("+json[i]["userid"]+");' class='btn btn-success' data-toggle='modal' data-target='#userviewmodal' >View</button></td><td></td><tr>");
      }
    }
  })
  count();

  $("#viewusercoll").click(function(){
    $( "#userimg" ).toggle( "slow", function() {
    });
    $("#userheader").toggle(function() {
      /* Stuff to do every *odd* time the element is clicked */
      $("#userheader").attr('style', 'height:60px');
    }, function() {

    });
  })
})
function viewuser(uid){
  $.ajax({
    url:"asset/php/userfunction.php?act=shuser&uid="+uid,
    dataType:"json",
    success:function(response){
      //console.log(response[0]);
      json=response;
      var NumOfJData = json.length;
      for(var i = 0; i < NumOfJData; i++) {
        $(".viewuid").html(json[i]["userid"]);
        $(".viewfullname").html(json[i]["fullname"]);
        $(".viewfbid").html(json[i]["fbuid"]);

        $(".viewregdate").html(json[i]["regDate"]);
        $(".viewregip").html(json[i]["regIp"]);
        $(".viewgender").html(json[i]["gender"]);

            if(json[i]["type"]=="0"){
              $(".viewtype").html("Blocaked");
              $(".viewexp").html("Blocked! No Expire");
            }else if(json[i]["type"]=="1"){
              $(".viewtype").html("Free Account");
              $(".viewexp").html("No Expire");
            }else if(json[i]["type"]=="2"){
              $(".viewtype").html("Paid Account");
              $(".viewexp").html(json[i]["expDate"]);
            }

            if(json[i]["dob"]==null){
              $(".viewdob").html("Not Set");
            }else{
              $(".viewdob").html(json[i]["dob"]);
            }

            if(json[i]["email"]==null){
              $(".viewemail").html("Not Set");
            }else{
              $(".viewemail").html(json[i]["email"]);
            }

            if(json[i]["uToken"]==null){
              $(".viewtoken").html("Not Set");
            }else{
              $(".viewtoken").html(json[i]["uToken"]);
            }
      }
    }
  })
}


function count(){
  $.ajax({
    url:"asset/php/userfunction.php?act=count",
    dataType:"json",
    success:function(response){
      console.log(response);
      json=response;
      $("#freecount").html(response.free);
      $("#precount").html(response.pre);
      $("#blockcount").html(response.block);
      $("#total").html(response.total);
    }
  })
}
