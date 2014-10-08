$(document).ready(function(){
	$("div.formulario > form").fadeIn("slow");
	
	$(".sysmsge").ready(function(){
		$(".sysmsge").show("slow");
	});
	
	$(".msge_title").click(function(){
		$(".msge_body").slideToggle();
	});
	
	$("#botonmenu").hover(function(){
		$("#sysmenu").slideToggle();
	});

			
		
});

