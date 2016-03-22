function showaboutcon(){//show content to modal
    $.ajax({
      url:"asset/php/adminfunction.php?act=indexabout",
      dataType:'json',
      success:function(data){
        json=data;
        for (var i = 0; i < json.length; i++) {
          if(json[i]['language']=='1'){ //ENG
            $('#abouttexteng').data("wysihtml5").editor.setValue(json[i]['content'],true);
          }else if(json[i]['language']=='2'){ //CHI
            $('#abouttextchi').data("wysihtml5").editor.setValue(json[i]['content'],true);
          }
        } //End For Loop
      } //End Success
    }) //End ajax
}//End showaboutcon function

function updateAbout(lang){ //lang=chi or eng
  var inputvar;
  if(lang=='chi'){
    inputvar=$("#abouttextchi").val();
  }else if(lang=='eng'){
    inputvar=$("#abouttexteng").val();
  }
  var error=$(".errorupdate");
  var errorempty='<div class="alert alert-danger"><strong>Error!</strong>Please enter something! </div>';
  var successresult='<div class="alert alert-success"><strong>Successful!</strong>Updated! </div>';
  var data="act=updateabout&lang="+lang+"&cont="+inputvar;
  if(inputvar==""||inputvar==null){
    error.html(errorempty);
  }else{
      $.ajax({
        url:"asset/php/adminfunction.php",
        type:"POST",
        data:data,
        dataType:"json",
        success:function(response){
          console.log(response);
          if(response.status=="success"){
            error.html(successresult);
            alert("Update Success!");
            window.location="content.php";
            return true;
          }else{
            alert(response);
            window.location="content.php";
            return false;
          }
        }
      })//end ajax


  }
}
