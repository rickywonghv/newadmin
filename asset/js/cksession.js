$(function() {
    startrefresh();
});

function startrefresh() {
    setTimeout(startrefresh,30000);
    cksession();
}
function cksession(){
  var data="act=cksession";
  $.ajax({
    url:'asset/php/adminfunction.php',
    data:data,
    success:function(response){
      if(response=="true"){

      }else{
        $.ajax({
          url:'asset/php/adminfunction.php?act=logout',
          success:function(response){
            if(response=="true"){
              window.location="login.php?act=loginfrom";s
            }
          }
        })
      }

    }
  })
}
