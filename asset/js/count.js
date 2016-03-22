jQuery(document).ready(function($) {
   // Stuff to do as soon as the DOM is ready. Use $() w/o colliding with other libs
   countread();
});


function countread(){
	$.ajax({
		type:"GET",
		url:"asset/php/adminfunction.php?act=countread",
		dataType:"json",
		success:function(response){
			$(".countread").html(response);
		}
	})
}
