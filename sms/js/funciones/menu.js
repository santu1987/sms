///JS DE  vista.menu_app.php
///BLOQUE DE EVENTOS:
$(".activar_menu").click(function(){
	if(screen.width<=980)
	{
		$(".collapse").collapse('hide');
	}
});
$("#btn_sms_inicio").click(function(){
	var img_sms="<div id='imagen_fondo'>\
              <img src='./img/logo_Juventud_Bicentenaria.png' class='logo_juventud'>\
          </div>"
    $("#cuerpo_programa").html(img_sms);      
});
$("#carga_inidividual").click(function(){
	$("#cuerpo_programa").load("./vistas/vista.carga_inidividual.php");
});
$("#envio_sms").click(function(){
	$("#cuerpo_programa").load("./vistas/vista.envios_sms.php");
});
$("#mon_bandeja_entrada").click(function(){
	$("#cuerpo_programa").load("./vistas/vista.bandeja_entrada.php");
});
$("#carga_masiva").click(function(){
	$("#cuerpo_programa").load("./vistas/vista.carga_masiva.php");
});
$("#registro_usuario").click(function(){
	$("#cuerpo_programa").load("./vistas/vista.insertar_usuario.php");
});
$("#registro_grupo").click(function(){
	$("#cuerpo_programa").load("./vistas/vista.registrar_grupo.php");
});
$("#mon_bandeja_salida").click(function(){
	$("#cuerpo_programa").load("./vistas/vista.bandeja_salida.php");
});
$("#rep_sms_env").click(function(){
	$("#cuerpo_programa").load("./vistas/vista.reporte_sms_enivados.php");
});
$("#rep_dest_noreg").click(function(){
	$("#cuerpo_programa").load("./vistas/vista.reporte_sms_noreg.php");
});
$('#nombre_us2').on('click', function(){
   $('#nombre_us2').popover({
   	title: "Opciones de Usuario:",
    html:true,
    placement: 'bottom',
    content:$("#div_us_pop").html()
   });
});
 $("#ayuda_sms").click(function(){
  //$("#cuerpo_programa").load("./vistas/vista.ayuda.php");
  url="./pdf/manual_sms.pdf";
  window.open(url,"Ayuda sistema SMS");
});
///BLOQUE DE FUNCIONES
function cerrar_session(){
	$.ajax({
		url  : './controladores/controlador_cierre_session.php',
		data : "",
		type : 'POST',
		cache: false,
		error : function(error){
			console.log(error);
			mensajes(2);
		},
		success : function(resp){
			window.location.href = resp;
		}
	});
}

function buscar_datos(id){
	$('#cuerpo_programa').load("./vistas/vista.insertar_usuario.php");
	$("#id_usuario").val(id);
    var id = {'id':id}
	$.ajax({
		  url  : './controladores/controlador.buscar_usuario.php',
		  type : 'POST',
		  data : id,
		  cache : false,
		  error :function(arguments){
		  	console.log(arguments);
			mensajes(2);
		  },
		  success : function(resp){
		  	if(resp != 0){
		  	 setTimeout(function(){	
		  		var separar = resp.split(',');
		  		$('#nombre_usuario').val(separar[1]);
			    $('#id_cedula').val(separar[3]);
			    $('#carga_nivel').val(separar[2]);
			  },100);   
		  	}else{
		  		mensajes(2);
		  	}
		  }
	});
}	
