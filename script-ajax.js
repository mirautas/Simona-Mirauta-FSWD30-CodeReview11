$("#sub").click(function(){
	$.post($("#myForm").attr("action"),
		$("#myForm :select").serializeArray(),
		function(info){
		$("#message").html(info);
	});
})

$("#myForm").submit(function(){
	return false ;
});