$(document).ready(function() {
  de();

  $("#uploadprogressbar").hide();
  $('#uploadfile').bind('change', function() {
    $("#customFileName").val(getFileData(this));
    $("#uploadprogressbar").show();
    if(this.files[0].size>=1048576000){
      alert("Too Large");
      alert(this.files[0].size);
      $("#submitupload").hide();
    }else{
      $("#submitupload").show();
    }
  });

});

function filedetail(filename){
  $("#detailfilepre").modal({hide:false});

  $.ajax({
    url:"asset/fileupload/getdetail.php",
    type:"POST",
    data:"filename="+filename,
    dataType:"json",
    success:function(response){
      
      $(".detailfilename").html(response.filename);
      $("#detailfilendate").html(response.filedate);
      $("#detailfilentime").html(response.filetime);
      $("#detailfilentype").html(response.filetype);
      $("#detailfilensize").html(response.filesize);

    }
  })
}


function getFileData(getName){
   var file = getName.files[0];
   var filename = file.name;
   return filename;
}

function de(){
  var getact = getUrlVars()["act"];
  var getfilename=getUrlVars()["filename"];
  if(getact==="del"&&(getact!="")&&(getfilename!=null)){
    var filename=getfilename;
    sdel(filename);
  }
}

(function() {

var bar = $('.bar');
var percent = $('.percent');
var status = $('#status');

$('form').ajaxForm({
  beforeSend: function() {
      status.empty();
      var percentVal = '0%';
      bar.width(percentVal)
      percent.html(percentVal);
  },
  uploadProgress: function(event, position, total, percentComplete) {
      var percentVal = percentComplete + '%';
      bar.width(percentVal)
      percent.html(percentVal);
  //console.log(percentVal, position, total);
  },
  success: function() {
      var percentVal = '100%';
      bar.width(percentVal)
      percent.html(percentVal);
  },
complete: function(xhr) {
  status.html(xhr.responseText);
}
});

})();
