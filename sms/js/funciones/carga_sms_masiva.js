//SCRIPT DESARROLLADO POR DAVID BELTRAN
//MODIFICADO POR GIANNI SANTUCCI 29/10/2014
//JS DE vista.carga_masiva.php
//BLOQUE DE EVENTOS
clearInterval(intervalo);
var opcion=1;
$("#carga_ind_grupo").load("./controladores/controlador_grupo.php?opcion="+opcion);
$("#carga_ind_grupo").change(function(){
	if($("#carga_ind_grupo").val()=='-999')
	{
		cargar_varios_grupos(0);	
	}else
	{
		$("#contenedor_grupos").html("");
	}
});
$('#archivo').change(function(){
	var archivo = $('#archivo').val();
	if(archivo != ""){
		ingresar();
	}else{
		$('#archivo').val('');
	} 
});

$('#btn_carga_ind_reg').click(function(){
	if($('#carga_ind_grupo').val() != '-1'){
		var seleccion = $('#carga_ind_grupo').val();
		enviar_sms(seleccion);
	}else{
		$('#carga_ind_grupo').val("");
    var mensaje = "<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Debe seleccionar un grupo..";
    mensajes2(mensaje);
	}
});

$("#btn_borrar_cont").click(function(){
  var id_grupo = $('#carga_ind_grupo').val();
   if(id_grupo != "-1"){
     bootbox.confirm("<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> ¿Realmente desea Eliminar la Información Referente ha este Grupo?", function(confirmar)
      {if(confirmar){borrar_grupos(id_grupo)}}); 
   }else{
    var mensaje = "<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i>  Debe seleccionar un grupo..";
    mensajes2(mensaje);
   }
});
//BLOQUE DE FUNCIONES

function ingresar(){
  barra_inicial("Espere unos segundos mientras se carga el archivo");//mensaje mientras realiza el envió...
	var data = new FormData($("#form_carga_masiva")[0]);
  $.ajax({
       url : './controladores/controlador_cargar_masiva.php',
       type: 'POST',
       data : data,
       cache: false,
       contentType: false,
       processData: false,
       success : function(resp){
        resetear_modal();
        if(resp == '2'){
        	mensajes(7);
        }else
        if(resp == '-2'){
          mensajes(8);
        }else
        if(resp == '1'){
          mensajes(9);
        }
      }
  });
}
function barra_inicial(mensaje)
{
  var barra='<div><i class="fa fa-exclamation-triangle fa-2x" style="color:#E9E216"></i> '+mensaje+' </div><br>\
            <div class="progress progress-striped active">\
            <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">\
            </div>\
            </div>';
  mensajes2(barra);
  $("#cerrar_mensaje,#aceptar_mensaje").css({"display":"none"});
  $('#modal_mensaje').removeData("modal").modal({backdrop: 'static', keyboard: false})      
}
function resetear_modal()
{
    $("#cerrar_mensaje,#aceptar_mensaje").css({"display":"block"});
}
function cerrar_modal()
{
  //$("#modal_mensaje").hide();
  $("#aceptar_mensaje").click();
}
function enviar_sms(seleccion){
	//Mientras se carga sale este mensaje
  barra_inicial("Espere unos segundos mientras se carga el grupo");//mensaje mientras realiza el envió...
  var data = {'data':seleccion}
	$.ajax({
		  url : './controladores/controlador_enviar_masivo.php',
          type: 'POST',
          data : data,
          cache: false,
          success : function(resp){
            var recordset=$.parseJSON(resp);
          	if(recordset != "error")
            {
              //mensaje de verificación
              //Modificacion, por mensaje de verificación..gs
              if(recordset[0]>0)//si registro al menos un contacto....
              {///  
                  cerrar_modal();
                  bootbox.confirm("<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Operaci&oacute;n realizada, cantidad de destinatarios registrados :"+recordset[0]+", no registrados:"+recordset[1]+", ¿Desea enviar un mensaje a este grupo ?", function(result) 
                  { if(result)
                    {
                      var grupo=$('#carga_ind_grupo').val();
                      $("#cuerpo_programa").load("./vistas/vista.envios_sms.php");
                      setTimeout(function(){$("#enviar_sms_grupo").val(grupo);},1000);
                    }
                    else
                    {
                      $('#carga_ind_grupo,#archivo').val("");
                    }  
                  });
              ////
              }else//Si no registro ningun contacto
              {
                  resetear_modal();
                  mensajes2("<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Operaci&oacute;n realizada, cantidad de destinatarios registrados :"+recordset[0]+", no registrados:"+recordset[1]);                      
                  $('#carga_ind_grupo,#archivo').val("");
              }                
            }else{//SI dió algun error...
              mensajes(6);
            }
          }
	});
}

function borrar_grupos(id_grupo){
  var data = {'id_grupo':id_grupo}
  $.ajax({
      url : './controladores/controlador.carga_masiva_eliminar_contactos.php',
      type: 'POST',
      data: data,
      cache : false,
      success : function(resp){
        if(resp == 1){
          mensajes(0);
          $('#carga_ind_grupo').val("");
          $('#archivo').val("");
        }
      }
  });
}
