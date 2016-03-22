$(document).ready(function() {
   // Stuff to do as soon as the DOM is ready
   headerinbox();
   $("#composebtn").click(function(event) {
     /* Act on the event */
     $("#inbox").hide();
     $("#compose").show();
   });

   $("#inboxbtn").click(function(event) {
     /* Act on the event */
     $("#inbox").show();
     $("#compose").hide();
   });

   $(document).on('click','#sendmailbtn',function(){
     valid();
   })
   $(document).on('click','#previewbtn',function(){
     preview();
   })
});

function preview(){
  var to=$("#tomailinput").val();
  var sub=$("#mailsubinput").val();
  var cont=$("#mailcont").val();
  $("#preto").html(to);
  $("#presub").html(sub);
  $("#prebody").html(cont);
}

function headerinbox(){
    $.ajax({
      url:"https://script.google.com/macros/s/AKfycbwBiBUomXX2xl8_X5bVl9p8d2hiNW6qwwZcdObxN3cdwjRxaCbn/exec",
      dataType:'json',
      beforeSend:function(){
        $(".loading").html("<h3><img src='img/loading.gif'> Loading</h3>");
      },complete:function(){
         $('.loading').hide();
     },success:function(response){
        json=response;
        var NumOfJData = json.length;
        for (var i = 0; i <NumOfJData; i++) {
          var unread=json[i]['isunread'];
          if(unread==false){
            $("#mailheader").append("<tr><td>"+json[i]['from']+"</td><td><div class='msg' data-toggle='modal' data-target='#shmailmsg' onclick=readmsg("+json[i]['id']+")>"+json[i]['sub']+"</div></td><td><div class='msg' data-toggle='modal' data-target='#shmailmsg' onclick=readmsg("+json[i]['id']+")>"+json[i]['date']+"</div></td></tr>");
          }else{
            $("#mailheader").append("<tr><td><b>"+json[i]['from']+"</b></td><td><div class='msg' data-toggle='modal' data-target='#shmailmsg' onclick=readmsg("+json[i]['id']+")><b>"+json[i]['sub']+"</b></div></td><td><div class='msg' data-toggle='modal' data-target='#shmailmsg' onclick=readmsg("+json[i]['id']+")><b>"+json[i]['date']+"</b></div></td></tr>");
          }

          }
          $("#num").html(NumOfJData);
      }
    })

}

function readmsg(id){
  $.ajax({
    url:"https://script.google.com/macros/s/AKfycbwZ20uCQogijmJJLsSHBq_0wzFuXd02JzYgOa2UPrNmsXEX0Zk/exec",
    data:"msgid="+id,
    dataType:'json',
    cache:false,
    beforeSend:function(){
      $(".loadingpng").html("<h3><img src='img/loading.gif'> Loading</h3>");
    },complete:function(){
       $('.loadingpng').hide();
   },success:function(response){
        $("#msgfrom").html(response['from']);
        $("#msgsubject").html(response['sub']);
        $("#msgdate").html(response['date']);
        $("#mailbody").html(response['body']);
          return false;
        $(".closeread").click(function(){
          $("#msgfrom").html("");
          $("#msgsubject").html("");
          $("#msgdate").html("");
          $("#mailbody").html("");

        })
    }
  })
}

function valid(){
  var to=$("#tomailinput").val();
  var sub=$("#mailsubinput").val();
  var cont=$("#mailcont").val();
//check email valid
  var x = document.getElementById('tomailinput');
 var atpos=x.value.indexOf("@");
 var dotpos=x.value.lastIndexOf(".");
 if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length){
   $(".mailmsg").html('<div class="alert alert-warning"><strong>Error!</strong>Not a valid e-mail address! </div>');
   $("#tomailinput").css('background', 'rgba(222, 81, 81, 0.64)');
   $("#tomailinput").css('color', '#fff');
   $("#tomaillabel").addClass('label-danger');
   $("#tomaillabel").css('color', '#fff');
   $("#tomailinput").focus();
  } else if(to==""){ //end check email valid
    $("#tomaillabel").addClass('label-warning');
    $("#tomaillabel").css('color', '#fff');
    $("#tomailinput").css('background', 'rgba(222, 81, 81, 0.64)');
    $(".mailmsg").html('<div class="alert alert-warning"><strong>Error!</strong>You can not send a mail without mail address! Mail did not send! </div>');
    $("#tomailinput").focus();
    $("#tomailinput").css('color', '#fff');
    $("#tomailinput").attr('placeholder', '');
  }else if (sub=="") {
    $("#mailsublabel").addClass('label-danger');
    $("#mailsublabel").css('color', '#fff');
    $(".mailmsg").html('<div class="alert alert-warning"><strong>Error!</strong>You can not send a mail without subject! Mail did not send! </div>');
    $("#mailsubinput").css('background', 'rgba(222, 81, 81, 0.64)');
    $("#mailsubinput").css('color', '#fff');
    $("#mailsubinput").attr('placeholder', '');
    $("#tomailinput").focus();
  }else if (cont=="") {
    $("#maileditor").addClass('label-warning');
    $(".mailmsg").html('<div class="alert alert-danger"><strong>Error!</strong> Please enter something, the mail did not send! </div>');
    alert("You can not send a mail without content!");
  }else{
    sendmail(to,sub,cont);
  }
}

function sendmail(to,sub,cont){
  var to=to;
  var sub=sub;
  var cont=cont;
  $.ajax({
    url:"asset/mail/mail.php",
    type:"POST",
    data:"act=send&to="+to+"&subject="+sub+"&content="+cont,
    beforeSend: function() {
        $("#loading").html('<img src="img/loading.gif">');
     },
     complete:function(){
        $('#loading').hide();
    },
    success:function(response){
      if(response=="success"){
        $(".mailmsg").html('<div class="alert alert-success"> The mail has been sent! </div>');
        $('#sendmailbtn').hide();
      }else{
        $(".mailmsg").html('<div class="alert alert-danger">Error</div>');
      }
    }
  })

}
