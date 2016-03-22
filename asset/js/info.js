$(function() {
    startRefresh();
    info();


});


function startRefresh() {
    setTimeout(startRefresh,10000);
    db();
}

function info(){
  $.ajax({
    url:"asset/php/serverfunction.php?act=serverinfo",
    dataType:'json',
    success:function(response){
      var total=response.hddtotal;
      var free=response.hddfree;
      var used=Math.round(response.hddtotal-response.hddfree);
      var perfree=(response.hddfree/response.hddtotal)*100;
      var perused=(used/total)*100;
      if(perused>=85){
        $("#shdisk").attr("class","panel panel-danger");
        $("#diskinfo").attr("class","progress-bar progress-bar-danger");
        $("#diskicon").addClass("fa fa-exclamation-triangle");
      }
      if(perused>=75){
        $("#shdisk").attr("class","panel panel-warning");
        $("#diskinfo").attr("class","progress-bar progress-bar-warning");
        $("#diskicon").addClass("fa fa-exclamation-triangle");
      }
      $("#diskinfo").attr("aria-valuenow",perused);
      $("#diskinfo").attr("style","width:"+perused+"%;");
      $("#diskinfo").html(Math.round(perused)+"%");
      $("#shdisktotal").html(total);
      $("#shdiskused").html(used);
      $("#shdiskfree").html(free);
      $("#serverip").html(response.servip);
    }
  })
}

function db(){
  $.ajax({
    url:"asset/php/serverfunction.php?act=dbstat",
    dataType:'json',
    success:function(response){
      $(".dbuptime").html(response.day+" Days "+response.time);
      $(".dbversion").html(response.version);
      $(".dbendpoint").html(response.endpoint);
    }
  })

  $.ajax({
    url:"asset/php/serverfunction.php?act=prolist",
    dataType:'json',
    success:function(response){
      $(".prolistresult").html("");
      json=response;
			for (var i = 0; i < json.length; i++) {
          $(".prolistresult").append('<tr><td>'+json[i]['Id']+'</td><td>'+json[i]['User']+'</td><td>'+json[i]['Host']+'</td><td>'+json[i]['db']+'</td><td>'+json[i]['Command']+'</td><td>'+json[i]['Time']+'</td><td>'+json[i]['State']+'</td><td>'+json[i]['Info']+'</td></tr>')
      }
    }
  })
}
