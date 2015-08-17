//BLOQUE DE EVENTOS
clearInterval(intervalo);
//Por defecto cargo el select de grupos...
cargar_select_grupos();
$("#btn_limpiar_enviar_sms").click(function(){
	limpiar_campos_sms();	
});
$("#enviar_texto_modem").load("./controladores/controlador_modem.php");
$("#enviar_radio_individual").click(function(){
	$("#enviar_frame_grupos").html("");
	var select_grupos='<div class="col-lg-12"><input type="text" name="enviar_sms_grupo" id="enviar_sms_grupo" class="form-control sms_grupo_input" onKeyPress="return valida(event,this,13,11);" onBlur="valida2(this,13,11);formato_tlf(this)" placeholder="N° de Tel&eacute;fono"></div>';
	$("#enviar_frame_grupos").html(select_grupos);
	//$("#enviar_sms_grupo").focus();
});
$("#enviar_radio_grupo").click(function(){
	cargar_select_grupos();
});
$("#enviar_sms_grupo").change(function(){
	if($("#enviar_sms_grupo").val()=='-999')
	{
		cargar_varios_grupos(0);	
	}else
	{
		$("#contenedor_grupos").html("");
	}
});
$("#enviar_texto_modem").change(function(){
	if($("#enviar_texto_modem").val()=='-999')
	{
		if($("#enviar_radio_individual").is(":checked"))
		{
			$("#enviar_texto_modem").val(-1);
			mensajes(12);
		}
		else
		{
			cargar_varios_modem(0);
		}
	}else
	{
		$("#enviar_frame_modem").html("");
	}
});
$("#btn_enviar_sms").click(function(){
if(validar_campos_envios()==true)
{
	bootbox.confirm("¿Realmente desea enviar el sms ?", function(result) 
	{
	    if (result)
	    {
				
				barra_inicial();//mensaje mientras realiza el envió...
				var data=$("#form_envio_mensajes").serialize();
				$.ajax({
							url:"./controladores/controlador.envios_sms.php",
							data:data,
							type:"POST",
							cache:false,
							error: function()
							{
								  console.log(arguments);
						          mensajes(3);
							},
							success: function(html)
							{
								//alert(html);
								var recordset=$.parseJSON(html);
								if(recordset[0]=="error_bd")
								{
									document.getElementById("aceptar_mensaje").style.display="block";
									document.getElementById("cerrar_mensaje").style.display="block";
									mensajes(2);//error inesperado									
								}
								else if(recordset[0]=="campos_blancos")
								{
									document.getElementById("aceptar_mensaje").style.display="block";
									document.getElementById("cerrar_mensaje").style.display="block";
									mensajes(4);//debe llenar todos los campos del formulario
								}	
								else if(recordset[0]=="registro_exitoso")
								{
									mensajes_cargados_bd(recordset[1]);
									limpiar_campos_sms();
								}	
								else
								{
									mensajes2(recordset);
								}
							}
				});
		}//fin de if result	
	});//fin de bootbox confirm	
}//fin de if de validacion
});
$("#enviar_radio_individual").click(function(){
	if($("#enviar_texto_modem").val()=='-999')
	{
		validar_check_individual();
	}		
});
//BLOQUE DE FUNCIONES
function limpiar_campos_sms()
{
	$("#enviar_texto_sms").val("");
	$("#enviar_frame_modem").html("");
	$("#enviar_texto_modem").val("-1");
	cargar_select_grupos();
	$("#enviar_sms_grupo").val("-1");
	$("#enviar_radio_grupo").prop("checked",true);
}
function validar_campos_envios()
{
	if($("#enviar_texto_sms").val()=="")
	{
		mensajes2("<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Disculpe, debe ingresar el texto del mensaje");
		return false;
	}else
	if($("#enviar_texto_modem").val()=='-1')
	{
		mensajes2("<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Disculpe, debe seleccionar un modem");
		return false;
	}else
	if($("#enviar_texto_modem").val()=='-999')
	{
		//verifico que al menos una caja este checkeada...
		 if (validar_checkbox("modem")==0)
		 {
		 	mensajes2("<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Disculpe, debe chequear al menos un modem");
		 	return false;
		 }	
	}else
	if(($("#enviar_sms_grupo").val()=='-1')||($("#enviar_sms_grupo").val()==''))
	{
		mensajes2("<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Disculpe, debe seleccionar un grupo o ingresar un n° de tel&eacute;fono");
		return false;
	}
	return true;	
}
function mensajes_cargados_bd(cuantos_enviados)
{
	var men='mensaje cargado';
	if(cuantos_enviados>1)
	{
		men='mensajes cargados';
	}	
//	$("#cuerpo_mensaje").html("Operaci&oacute;n realizada de manera exitosa, "+cuantos_enviados+" "+men+"  en base de datos");
	$("#cuerpo_mensaje").html("<i class='fa fa-check fa-2x' style='color:#16E91D'></i>Operaci&oacute;n realizada de manera exitosa");
	document.getElementById("aceptar_mensaje").style.display="block";
	document.getElementById("cerrar_mensaje").style.display="block";
}
function barra_inicial()
{
	var barra='<div><i class="fa fa-exclamation-triangle fa-2x" style="color:#E9E216"></i>Espere unos segundos mientras se cargan los mensajes</div><br>\
				  <div class="progress progress-striped active">\
				  <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">\
				  </div>\
				</div>';
	mensajes2(barra);
	document.getElementById("aceptar_mensaje").style.display="none";
	document.getElementById("cerrar_mensaje").style.display="none";	
	$('#modal_mensaje').removeData("modal").modal({backdrop: 'static', keyboard: false})		  
}
function validar_check_individual()
{
	$("#enviar_texto_modem").val(-1);
	mensajes(12);
	$("#enviar_frame_modem").html("");
}
function cargar_select_grupos()
{
	var select_grupos='<div class="form-group">\
						<div class="col-lg-12">\
							<select name="enviar_sms_grupo" id="enviar_sms_grupo" class="form-control sms_grupo_select">\
								<option id="-1" value="-1" >[Grupo]</option>\
							</select>\
						</div>\
					</div>\
					<div class="form-group" id="contenedor_grupos" name="contenedor_grupos">\
					</div>';
	$("#enviar_frame_grupos").html(select_grupos);
	var opcion=1;
	$("#enviar_sms_grupo").load("./controladores/controlador_grupo.php?opcion="+opcion);
}