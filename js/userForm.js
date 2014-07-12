$("#submit").click( function() {
	$.post( $("#login").attr("action"),
	$("#login :input").serializeArray(),
	function(info) {
		if(info=="Success")
			location.reload();
		else if(info=="Empty Username!")
			$( "#username" ).prev().css( "background-color", "#d9534f" );
		else if(info=="Empty Password!")
			$( "#password" ).prev().css( "background-color", "#d9534f" );
		else
		{
			$("#errmsg").empty();
			$("#errmsg").html(info);
		}
	});

	$("#login").submit( function() {
	return false;	
	});
	$("#username").on("focus",function(){
		$( "#username" ).prev().css( "background-color", "" );
    })
	$("#password").on("focus",function(){
		$( "#password" ).prev().css( "background-color", "" );
    })
});
/*
$("#submit").click( function() {
alert($("#login :input").serializeArray());
 $.post( $("#login").attr("action"),
	$("#myForm :input").serializeArray(),
	function(info) {
		if(info=="Success")
			location.reload();
		else if(info=="!username!")
			$( "#username" ).prev().css( "background-color", "#d9534f" );
		else
		{
			$("#errmsg").empty();
			$("#errmsg").html(info);
		}
	});
	$("#login").submit( function() {
	   return false;	
	});

});
*/