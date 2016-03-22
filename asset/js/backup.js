$(document).ready(function() {
  $("#dbadminbackup").click(function(){
    dbbackup('admin');
  })
  $("#dbmainbackup").click(function(){
    dbbackup('main');
  })
  list();

});


function dbbackup(db){
  $.ajax({
    url:"asset/backup/dbbackup.php?act=dbbackup&db="+db,
    dataType:'html',
    success:function(response){
      if(response=="true"){
        alert("Database backup already");
        window.location="backup.php";
      }else{
        alert(response);
        window.location="backup.php";
      }
    }
  })
}

function list(){
  $.ajax({
    url:"asset/backup/dbbackup.php?act=listdbbackup",
    dataType:"json",
    success:function(response){
      json=response;
      var NumOfJData = json.length;
      for (var i = 1; i < NumOfJData; i++) {
        var mbsize=json[i]['size']/1024/1024;
        var size=Math.round(mbsize* 1000)/1000;
        $("#dbfilebackup").append("<tr><td><div class='targets' id='"+json[i]['name']+"'><a href='https://s3-ap-southeast-1.amazonaws.com/musixcloud-backup/"+json[i]['name']+"' >"+json[i]['name']+"</a></div></td><td>"+size+"<b>MB</b></td><td><a class='btn btn-danger' href='asset/backup/dbbackup.php?act=del&filename="+json[i]['name']+"'>Delete</a></td></tr>");
      }

      return false;
    }
  })
}
