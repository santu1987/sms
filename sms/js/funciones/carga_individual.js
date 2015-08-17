//PROGRAMA DESARROLLADO POR GIANNI SANTUCCI OCTUBRE 2014
//JS DE vista.carga_inidivudal.php
//BLOQUE DE EVENTOS
cargar_filas();
clearInterval(intervalo);
$("#carga_ind_grupo").load("./controladores/controlador_grupo.php");
$("#carga_ind_grupo").change(function(){
	if($("#carga_ind_grupo").val()=='-999')
	{
		cargar_varios_grupos(0);	
	}else
	{
		$("#contenedor_grupos").html("");
	}
});
$("#btn_ag_ind").click(function(){
	cargar_filas();
	subir();
});
$("#btn_qui_ind").click(function(){
	quitar_filas();
});
$("#btn_carga_ind_reg").click(function(){
	if(validar_carga_individual()==true)
	{	
		var data=$("#form_carga_individual").serialize();
		$.ajax({
					url:"./controladores/controlador.registrar_destinatario.php",
					type:"POST",
					data:data,
					cache:false,
					error: function()
					{
						  console.log(arguments);
				          mensajes(3);
					},
					success: function(html)
					{
						var recordset=$.parseJSON(html);
						var id_grupo=$("#carga_ind_grupo").val();
						//alert(recordset);
						if(recordset[0]=="error")
						{
							mensajes(2);//error inesperado
						}
						else if(recordset[0]=="campos_blancos")
						{
							mensajes(4);//debe llenar todos los campos del formulario
						}	
						else if(recordset[0]=="registro_exitoso")
						{
							/*Este bloque fue modificado por orden del director, debe incluirse modal que envien el id del grupo al formulario de envio de sms para facilitar el proceso*/
							/*Si desean cambiarlo a como estaba antes descomentar estas lineas 23/10/2014*/
							//							mensajes(0);
							//							limpiar_campos_ind();
							mensaje_opcion(id_grupo);//funcion que envia al formulario de envio de sms...
						}
						else if(recordset[0]=="error_auditoria")
						{
							mensajes(16);
						}		
					}
		});
	}	 
});
$("#btn_cons_ind").click(function(){
	var cabecera="<b>Consulta emergente: Destinatarios</b>";
	$("#myModalLabelconsulta").html(cabecera);
	//genero los campos de la tabla
	var cabacera_tabla="<tr><td><input type='text' name='f_nom' id='f_nom' placeholder='Filtro por nombres' class='form-control input-sg input-filtros' onblur='consultar_cuerpo_tabla_destinatarios(0,5,0);' onKeyPress='return valida(event,this,17,50);'></td>\
						<td class='campo_esp'><input type='text' name='f_num' id='f_num' placeholder='Filtro por n&uacute;mero de tlf' class='form-control input-sg input-filtros' onblur='consultar_cuerpo_tabla_destinatarios(0,5,0);' onKeyPress='return valida(event,this,13,50)'></td>\
						</tr>\
						<tr>\
							<td width='25%'><label>Nombres</label></td>\
							<td width='25%'><label>N&uacute;mero de Tel&eacute;fono</label></td>\
							<td width='25%'><label>Seleccione</label></td>\
						</tr>";
	$("#cabecera_consulta").html(cabacera_tabla);	
	//consultar cuerpo de la tabla
	consultar_cuerpo_tabla_destinatarios(0,5,0);					
});
$("#btn_limpiar_ind_reg").click(function(){
	limpiar_campos_ind();
});
//BLOQUE DE FUNCIONES
function mensaje_opcion(id_grupo)
{
	//mensaje de verificación
	bootbox.confirm("<i class='fa fa-check fa-2x' style='color:#16E91D'></i> Operación realizada de manera exitosa, ¿Desea enviar un mensaje a este grupo ?", function(result) 
	{	if(result)
		{
			$("#cuerpo_programa").load("./vistas/vista.envios_sms.php");
			setTimeout(function(){$("#enviar_sms_grupo").val(id_grupo);},1000);
		}
		else
		{
			limpiar_campos_ind();
		}	
	});
}
function subir()
{
	$('html, body').stop().animate({scrollTop: $($("#btn_ag_ind").attr('href')).offset().top}, 1000);
}
function limpiar_campos_ind()
{
	$("#cuerpo_destinatarios").html("");
	cargar_filas();
	$("#carga_ind_grupo").val("-1");
	$("#contenedor_grupos").html("");
	$("#btn_ag_ind").removeClass("disabled");
	//document.getElementById("btn_ag_ind").disabled="";
}
function validar_texto_vector(valor)
{
  var b = 0;
  var txt=document.getElementsByName(valor+'[]');
    for(j=0;j<txt.length;j++) {
      //alert(chk.item(j).checked);
      if(txt.item(j).value!="") {
        b++;
      }
  }
    if(b ==txt.length) {
      txt='';
      //alert("Selecciones una o varias opciones");
      return 1;
    } 
    txt='';
    return 0;
}
function validar_carga_individual()
{
	var validacion_nombres=validar_texto_vector("carga_ind_nombre");
	var validacion_tlf=validar_texto_vector("carga_ind_tlf");
	//alert("validacion tlf"+validacion_tlf);
	if(validacion_nombres==0)
	{
		mensajes2("<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Disculpe, debe ingresar nombre de destinatario");
		return false;
	}else
	if(validacion_tlf==0)
	{
		mensajes2("<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Disculpe, debe ingresar tlf de destinatario");
		return false;
	}
	else
	if($("#carga_ind_grupo").val()=="-1")
	{
		mensajes2("<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Disculpe, debe seleccionar un grupo");
		return false;
	}else
	if($("#carga_ind_grupo").val()=='-999')
	{
		//verifico que al menos una caja este checkeada...
		 if (validar_checkbox("grupos")==0)
		 {
		 	mensajes2("<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Disculpe, debe chequear al menos un grupo");
		 	return false;
		 }	
	}
	return true;	
}
function consultar_cuerpo_tabla_destinatarios(offset,limit,actual)
{
	var f_nom=$("#f_nom").val();
	var f_num=$("#f_num").val();
	var data={
				f_nom_:f_nom,
				f_num:f_num,
				offset:offset,
				limit:limit,
				actual:actual
	};
	$.ajax({
				url:"./controladores/controlador.cuerpo_tabla_destinatarios.php",
				type:"POST",
				data:data,
				cache:false,
				error: function()
				{
					  console.log(arguments);
			          mensajes(2);
				},
				success: function(html)
				{
					//alert(html);
					recordset=$.parseJSON(html);
					if(recordset=="error")
					{
						mensajes(2);//error inesperado
					}
					else if(recordset=="campos_blancos")
					{
						mensajes(6);//error pasando campos vacios
					}
					else
					{
						$("#cuerpo_consulta").html(recordset[0]);//cuerpo de la tabla
                		$("#paginacion_tabla").html(recordset[1]);//paginacion
					}	
				}
	});
}
function btn_selec_des(n_tlf)
{
	var data={
				n_tlf:n_tlf,
	};
	$.ajax({
				url:"./controladores/controlador.consultar_destinatario.php",
				type:"POST",
				data:data,
				cache:false,
				error: function()
				{
					  console.log(arguments);
			          mensajes(3);
				},
				success: function(html)
				{
					var recordset=$.parseJSON(html);
					if(recordset[0]=="error_bd")
					{
						mensajes(2);//error inesperado de base de datos
					}////
					else
					{
						rsdatos1=recordset[0];
						rsdatos2=recordset[1];
						//alert(rsdatos2);
						//limpio los campos
						limpiar_campos_ind();
						//inhabiito boton de de +
						$("#btn_ag_ind").addClass("disabled");
						$("#carga_ind_nombre1").val(rsdatos1[0][0]);
						$("#carga_ind_tlf1").val(rsdatos1[0][1]);
						//document.getElementById("btn_ag_ind").disabled="disabled";
						//si es un solo grupo
						if(recordset[2]==1)
						{
							$("#carga_ind_grupo").val(rsdatos2);
							$("#contenedor_grupos").html("");
						}//en caso contraio que sean mas de un grupo...
						else if(recordset[2]>1)
						{
							$("#carga_ind_grupo").val('-999');
							//invoco a la funcion que genera los check
							cargar_varios_grupos(rsdatos2);	
						}
						$(".cerrar_modal").click();
					}/////	
				}
	});
}
function cargar_filas()
{
	var cuantas_filas_ind=$(".div_ind_dest").length
	var omega1=parseInt(cuantas_filas_ind)+1;
	//para la primera fila
	if(omega1==1)
	{
		destinatario='<div class="form-group div_ind_dest" id="carga_ind_fila'+omega1+'">\
							<div class="col-lg-6">\
								<input type="text" name="carga_ind_nombre[]" id="carga_ind_nombre'+omega1+'" class="form-control" onKeyPress="return valida(event,this,4,50)" onBlur="valida2(this,4,50);" placeholder="Nombre de destinatario">\
							</div>\
							<div class="col-lg-4">\
								<input type="text" name="carga_ind_tlf[]" id="carga_ind_tlf'+omega1+'" class="form-control" onKeyPress="return valida(event,this,13,11);" onBlur="valida2(this,13,11);formato_tlf(this)" placeholder=" N°Tel&eacute;fono" >\
							</div>\
							<div class="col-lg-2">\
								<button id="btn_qui_ind1" name="btn_qui_ind1" title="Quitar Destinatario" type="button" class="btn btn-danger btn-qui" onclick="quitar_fila_n('+omega1+');"><span class="glyphicon glyphicon-minus"></span></button>\
							</div>\
						</div>';	
	}
	else
	{
		destinatario='<div class="form-group div_ind_dest" id="carga_ind_fila'+omega1+'">\
							<div class="col-lg-6">\
								<input type="text" name="carga_ind_nombre[]" id="carga_ind_nombre'+omega1+'" class="form-control" onKeyPress="return valida(event,this,4,50)" onBlur="valida2(this,4,50)" placeholder="Nombre de destinatario">\
							</div>\
							<div class="col-lg-4">\
								<input type="text" name="carga_ind_tlf[]" id="carga_ind_tlf'+omega1+'" class="form-control" onKeyPress="return valida(event,this,13,11);" onBlur="valida2(this,13,11);formato_tlf(this);" placeholder=" N°Tel&eacute;fono" >\
							</div>\
							<div class="col-lg-2">\
								<button id="btn_qui_ind'+omega1+'" name="btn_qui_ind'+omega1+'" title="Quitar Destinatario" type="button" class="btn btn-danger btn-qui" onclick="quitar_fila_n('+omega1+');"><span class="glyphicon glyphicon-minus"></span></button>\
							</div>\
					  </div>';
	}	
	$("#cuerpo_destinatarios").append(destinatario);
}
function quitar_filas()
{
	var cuantas_filas_ind=$(".div_ind_dest").length;
	if(cuantas_filas_ind>1)
	{
		var omega1=parseInt(cuantas_filas_ind);
		$("#carga_ind_fila"+omega1).remove();
	}	
}
function quitar_fila_n(numero)
{
	var cuantas_filas_ind=$(".div_ind_dest").length;
	if(cuantas_filas_ind>1)
	{
		$("#carga_ind_fila"+numero).remove();	
	}
	else
	{
		mensajes(15);
	}	
}
//
