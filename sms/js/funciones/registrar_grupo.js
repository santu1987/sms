/*Bloque de eventos de vista.registar_grupo.php
eventos*/
clearInterval(intervalo);
$('#bnt_guardar_grupo').click(function(){
	var grupo = $('#grupo').val();
	var mensaje="";
	if((grupo != "") && ($('#id_descripcion').val() != "") ){
		ingresar(grupo);
	}else
	if((grupo != "") && ($('#id_descripcion').val() == "")){
		mensaje = "<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Debe ingresar una descripci&oacute;n del grupo";
        mensajes2(mensaje);
	}else{
		mensaje = "<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Debe ingresar un nombre de grupo";
        mensajes2(mensaje);
	}
});

$('#bnt_limpiar').click(function(){
	$('#grupo').val("");
	$("#id_descripcion").val("");
});

$('#btn_consultar').click(function(){
	armar_consulta();
});
//fin
/*funciones*/
function ingresar(grupo){
	var id_grupo = $('#id_grupo').val();
	var descripcion = $('#id_descripcion').val();
	var data = {'grupo':grupo, 'id_grupo':id_grupo, 'descripcion':descripcion}
	$.ajax({
		url  : './controladores/controlador.guardar_grupo.php',
		data : data,
		type : 'POST',
		cache: false,
		error: function(arguments){
			console.log(arguments);
			mensajes(2);
		},
		success : function(resp){
			if(resp != 'error'){
				$('#grupo').val("");
				$("#id_descripcion").val("");
				bootbox.confirm("<i class='fa fa-check fa-2x' style='color:#16E91D'></i> Operaci&oacute;n realizada de manera exitosa ¿Desea cargar contactos a este grupo?", function(confirmar){
					if(confirmar){
						pasar(resp);
					}				
				});
			}
		}
	});
}

function armar_consulta(){
	var cabecera="<b>Consulta emergente: Grupos</b>";
	$("#myModalLabelconsulta").html(cabecera);
	//genero los campos de la tabla
	var cabacera_tabla="<tr>\
						<td><input type='text' name='nombre' id='nombre' placeholder='Filtro por nombre' class='form-control input-sg input-filtros' onblur='armar_cuerpo(0,5,0);' onblur='consultar_cuerpo_tabla_sms_env(0,5,0);' onKeyPress='return valida(event,this,17,50)'></td>\
						</tr>\
						<tr>\
							<td width='40%'><label>Nombres</label></td>\
							<td class='campo_esp' width='50%'><label>Descripción</label></td>\
							<td width='10%' colpand='2'><label>Seleccione</label></td>\
						</tr>";
	$("#cabecera_consulta").html(cabacera_tabla);	
	//consultar cuerpo de la tabla
	armar_cuerpo(0,5,0);
}

function armar_cuerpo(offset,limit,actual){
 var nombre = $('#nombre').val();
 var data = { 'nombre': nombre, 'offset':offset, 'limit': limit, 'actual':actual }
 $.ajax({
 	   url : './controladores/controlador.consultar_grupos.php',
 	   type: 'POST',
 	   data: data,
 	   cache: false,
 	   error: function(error){
 	   	    console.log(arguments);
			mensajes(2);
 	   },
 	   success: function(resp){
 	   	 tabla=$.parseJSON(resp);
 	   	 if(tabla=="error"){
			  mensajes(2);//error inesperado
		}else{ 
		 	if(tabla=="campos_blancos"){
						mensajes(6);//error pasando campos vacios
		    }else{
				$("#cuerpo_consulta").html(tabla[0]);//cuerpo de la tabla
	    		$("#paginacion_tabla").html(tabla[1]);//paginacion
			}	
		}
      }
   });
}

function editar(id){
	var data = {'id':id}
	$.ajax({
		 url  : './controladores/controlador.editar_grupo.php',
		 data : data,
		 type : 'POST',
		 cache :false,
		 error : function(resp){
		 	console.log(arguments);
			mensajes(2);
		 },
		 success : function(resp){
		 	if(resp != '0'){
		 		var separar = resp.split(',');
		 		$('#id_grupo').val(separar[0]);
		 		$('#grupo').val(separar[1]);
		 		$("#id_descripcion").val(separar[2]);
		 		$('.close').click();
		 	}else{
		 		 mensajes(2);
		 	}
		 }
	});
}

function pasar(id){
	$("#cuerpo_programa").load("./vistas/vista.carga_inidividual.php");
	setTimeout(function(){
		$("#carga_ind_grupo").val(id);
	},250);
}
/*fin*/
