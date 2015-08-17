//JS de inicio.php
//BLOQUE DE EVENTOS
$(document).ready(function(){
	$("#cuerpo_nav").load("./vistas/vista.menu_app.php");
	   window.location.hash="no-back-button";
	   window.location.hash="Again-No-back-button" //chrome
	   window.onhashchange=function()
	   {
	    window.location.hash="#";
	  }
/*$(document).on('click',function(){
	$('.collapse').collapse('hide');
	});
	$("#envio_sms").click(function(){
		$('.collapse').collapse('hide');
	});*/
});
//BLOQUE DE FUNCIONES
