//JS DE vista.inicio_sesion.php
//BLOQUE DE EVENTOS
clearInterval(intervalo);
$('#carga_nivel').load('./controladores/controlador.llenado_combo_nivel.php');
$('#regitrar_usuario').click(function(){
	var nombre = $('#nombre_usuario').val();
	var clave  = $('#clave_usuario1').val();
	var clave_verificar  = $('#clave_usuario2').val();
	var cedula = $('#id_cedula').val();
	var nivel  = $('#carga_nivel').val();
    var id_usuario = $('#id_usuario').val();

	if((nombre != "")&&(clave != "")&&(clave_verificar != "")&&(cedula != "")&&(nivel != '0')){
      if(clave === clave_verificar){
		guardar_info(nombre, clave, cedula, nivel);
	  }else{
	  	mensajes(10);
	  }	
    }else{
	  mensajes(4);
	}
});

$('#btn_consultar').click(function(){
   armar_consulta();
});

$('#limpiar').click(function(){
	limpiar();
});
//BLOQUE DE FUNCIONES
function guardar_info(nombre, clave, cedula, nivel, id_usuario){
	var data = {'nombre':nombre, 'clave':clave, 'cedula': cedula, 'nivel':nivel, 'id_usuario':id_usuario}
	$.ajax({
		url  :'./controladores/controlador.ingresar_usuario.php',
		data : data,
		type : 'POST',
		cache: false,
		error: function()
		{
		  console.log(arguments);
          mensajes(3);
	    },
		success : function(resp) {
			if(resp == 1){
				mensajes(0);
				limpiar();
			}else
			if(resp == 2){
				mensajes(0);
				limpiar();
			}else{
				mensajes(6);
			}
		} 
	})
}

function limpiar(){
	$('#nombre_usuario').val("");
    $('#clave_usuario1').val("");
    $('#clave_usuario2').val("");
    $('#id_cedula').val("");
    $('#carga_nivel').val(0);
    $('#id_usuario').val("");
}

function armar_consulta(){
	var cabecera="<b>Consulta emergente: Usuarios</b>";
	$("#myModalLabelconsulta").html(cabecera);
	//genero los campos de la tabla
	var cabacera_tabla="<tr>\
						<td colspan=2><input type='text' name='nombre_us' id='nombre_us' onKeyPress='return valida(event,this,17,50)' placeholder='Filtro por nombre' class='form-control input-sg input-filtros' onblur='armar_cuerpo(0,5,0);'></td>\
						</tr>\
						<tr>\
							<td width='20%'><label>C&eacute;dula</label></td>\
							<td class='nombre_us' width='25%'><label>Nombre de Usuario</label></td>\
							<td class='campo_esp' name='campo3' width='15%'><label>Nivel de Usuario</label></td>\
							<td class='campo_esp' name='campo3' width='15%'><label>Estatus</label></td>\
							<td width='20%'><label>Seleccione</label></td>\
						</tr>";
	$("#cabecera_consulta").html(cabacera_tabla);	
	//consultar cuerpo de la tabla
	armar_cuerpo(0,5,0);
}

function armar_cuerpo(offset,limit,actual){
  var nombre_us = $("#nombre_us").val();
  var data = { 'nombre_us':nombre_us, 'offset':offset, 'limit': limit, 'actual':actual }
 $.ajax({
 	   url : './controladores/controlador.consultar_usuarios.php',
 	   type: 'POST',
 	   data: data,
 	   cache: false,
 	   error: function(arguments){
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
		  		var separar = resp.split(',');

		  		$('#nombre_usuario').val(separar[1]);
			    $('#id_cedula').val(separar[3]);
			    $('#carga_nivel').val(separar[2]);
			    $('#id_usuario').val(separar[0]);
			    $('.close').click();
		  	}else{
		  		mensajes(2);
		  	}
		  }
	});
}

function desactivar(id){
	$("#btn"+id).removeClass('fa fa-toggle-on');
	$("#btn"+id).attr('title','Inactivo');
	$("#btn"+id).attr('onclick','activar('+id+')');
	$("#btn"+id).css('color','#D51646');
	$("#btn"+id).addClass('fa fa-toggle-off');
	var data = {'id':id}
	$.ajax({
		url : './controladores/controlador.desactivar_activar_usuario.php',
		type : 'POST',
		data : data,
		cache : false,
		error : function(error){
			console.log(error);
			mensajes(2);
		},
		success : function(resp){
			console.log(resp);
		}
	});
}

function activar(id){
	$("#btn"+id).removeClass('fa fa-toggle-off');
	$("#btn"+id).attr('onclick','desactivar('+id+')');
	$("#btn"+id).attr('title','Activo');
	$("#btn"+id).css('color','#3DC564');
	$("#btn"+id).addClass('fa fa-toggle-on');
	var data = {'id':id}
	$.ajax({
		url : './controladores/controlador.desactivar_activar_usuario.php',
		type : 'POST',
		data : data,
		cache : false,
		error : function(error){
			console.log(error);
			mensajes(2);
		},
		success : function(resp){
			console.log(resp);
		}
	});
}
