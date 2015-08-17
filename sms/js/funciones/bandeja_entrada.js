//JS DE vista.bandeja_entrada.php
//BLOQUE DE EVENTOS
consultar_cuerpo_tabla_be(0,5,0);
detener_interval();
$("#btn_recargar_bj").click(function(){
	consultar_cuerpo_tabla_be(0,5,0);
});
$("#btn_seleccionar_check").click(function(){
	var chk=document.getElementsByName("eliminar_sms"+'[]');
	//alert(chk.length);
		for(j=0;j<chk.length;j++) 
		{
			if(chk.item(j).checked == false) 
			{
				chk.item(j).checked =true;
			}
		}	
});
$("#btn_eliminar_masivos").click(function(){
if(validar_check()==true)
{	
	bootbox.confirm("¿Realmente desea eliminar sms seleccionados ?", function(result) 
	{
	    if (result)
	    {
			var data=$("#form_bandeja_entrada").serialize();
			$.ajax({
						url:"./controladores/controlador.eliminar_masivo_entrada.php",
						type:'POST',
						data:data,
						cache:false,
						error: function()
						{
							console.log(arguments);
					        mensajes(2);
						},
						success: function(html)
						{
							var recordset=$.parseJSON(html);
							if(recordset=="error")
							{
								mensajes(2);//error
							}else 
							if(recordset=="campos_blancos")
							{
								mensajes(6);//error pasando campos vacios
							}
							else
							if(recordset=="eliminacion_exitosa")
							{
								mensajes(0);//eliminación de sms de manera exitosa
								consultar_cuerpo_tabla_be(0,5,0);
							}	
						}
			});
		}//if(result)	
	});//confirm		
}	
});
//BLOQUE DE FUNCIONES
function validar_check()
{
	var chk=document.getElementsByName("eliminar_sms"+'[]');
	var b=0;
		for(j=0;j<chk.length;j++) 
		{
			if(chk.item(j).checked == false) 
			{
				b=b+1;
			}
		}
		if(b == chk.length)
		{
			mensajes(17);
			return false;
		}
	return true;		
}
function btn_el_inbox(id)
{
	bootbox.confirm("¿Realmente desea eliminar el sms ?", function(result) 
	{
	    if (result)
	    {
		    var id_tlf=id;
			var data={
						id_tlf:id
			};
			$.ajax({
						url:"./controladores/controlador.borrar_inbox.php",
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
							//alert(recordset);
							if(recordset=="error_bd")
							{
								mensajes(2);//error inesperado
							}
							else if(recordset=="campos_blancos")
							{
								mensajes(6);//error pasando campos vacios
							}
							else if(recordset=="no_existe_sms")
							{
								mensajes(13);//no existe el sms en la bandeja de entrada
								consultar_cuerpo_tabla_be(0,5,0);
							}
							else if(recordset=="eliminacion_exitosa")
							{
								mensajes(0);//eliminación de sms de manera exitosa
								consultar_cuerpo_tabla_be(0,5,0);
							}	
						}
			});
		}//fin del if
	});//fin de la pregunta
}
function consultar_cuerpo_tabla_be(offset,limit,actual)
{
	//alert("aaaas");
	var f_nom_be=$("#f_nom_be").val();
	var f_num_be=$("#f_num_be").val();
	var data={
				f_nom_be:f_nom_be,
				f_num_be:f_num_be,
				offset:offset,
				limit:limit,
				actual:actual
	};
	$.ajax({
				url:"./controladores/controlador.cuerpo_tabla_bandeja_entrada.php",
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
					recordset=$.parseJSON(html);
					//alert(recordset);
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
						$("#cuerpo_tabla").html(recordset[0]);//cuerpo de la tabla
                		$("#paginacion_tabla").html(recordset[1]);//paginacion
					}	
				}
	});
}