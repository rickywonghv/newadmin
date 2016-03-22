$(document).ready(function() {
  $("#cloudflare").click(function(){
    cloudflare();
  })

  $("#setcachelvlbtn").click(function(){
    var sele=$("#setcachelvl").val();
    setcache(sele);
  })
  $("#setseclvlbtn").click(function(){
    var setsecu=$("#setseclvl").val();
    $.ajax({
      url:"asset/php/cloudflare.php",
      type:"POST",
      data:"act=setsecu&targ="+setsecu,
      dataType:"json",
      success:function(response){
        alert(response.result);
        window.location="serverinfo.php";
      }
    })
  })
  $("#setdevbtn").click(function(){
    var setdev=$("#setdev").val();
    $.ajax({
      url:"asset/php/cloudflare.php",
      type:"POST",
      data:"act=setdev&tardev="+setdev,
      dataType:"json",
      success:function(response){
        alert(response.response.fb_msg);
        window.location="serverinfo.php";
      }
    })
  })


  setdev


});
function cloudflare(){
  $.ajax({
    url:"asset/php/cloudflare.php",
    type:"POST",
    data:"act=cloudstatus",
    dataType:"json",
    success:function(response){
      var cachelvl=response.response.result.objs[0].cache_lvl;
      if(cachelvl=="agg"){
        cachelvl="Aggressive";
      }else{
        cachelvl="Basic";
      }
      var dev=response.response.result.objs[0].dev_mode;
      var devstats;
      if(dev==0){
        devstats="Disable";
      }else{
        //="Enabled";
        //var d = new Date(dev);
        devstats="<b>Expire at</b> "+convertTimestamp(dev);
      }
      $("#cachelvl").html(cachelvl);
      $(".regularpage").html(response.response.result.objs[0].trafficBreakdown.pageviews.regular);
      $(".threatpage").html(response.response.result.objs[0].trafficBreakdown.pageviews.threat);
      $(".crawlerpage").html(response.response.result.objs[0].trafficBreakdown.pageviews.crawler);
      $("#seclvl").html(response.response.result.objs[0].userSecuritySetting);
      $("#devstats").html(devstats);

    }
  })
}

function convertTimestamp(timestamp) {
  var d = new Date(timestamp * 1000),	// Convert the passed timestamp to milliseconds
		yyyy = d.getFullYear(),
		mm = ('0' + (d.getMonth() + 1)).slice(-2),	// Months are zero based. Add leading 0.
		dd = ('0' + d.getDate()).slice(-2),			// Add leading 0.
		hh = d.getHours(),
		h = hh,
		min = ('0' + d.getMinutes()).slice(-2),		// Add leading 0.
		ampm = 'AM',
		time;
	if (hh > 12) {
		h = hh - 12;
		ampm = 'PM';
	} else if (hh === 12) {
		h = 12;
		ampm = 'PM';
	} else if (hh == 0) {
		h = 12;
	}
	time = yyyy + '-' + mm + '-' + dd + ', ' + h + ':' + min + ' ' + ampm;
	return time;
}

function setcache(sele){
  $.ajax({
    url:"asset/php/cloudflare.php",
    type:"POST",
    data:"act=setcache&tar="+sele,
    dataType:"json",
    success:function(response){
      alert(response.result);
      window.location="serverinfo.php";
    }
  })
}
