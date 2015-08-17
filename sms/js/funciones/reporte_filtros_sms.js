//JS DE vista.reporte_filtro_env.php
//BLOQUE DE EVENTOS
$("#f_fecha").datetimepicker({ 
    yearOffset:0,
	  lang:'es',
		timepicker:false,
		format:'d/m/Y',
		formatDate:'Y/m/d',
		maxDate: 0,
		maxTime: 0
});
$("#btn_ver_pdf").click(function(){
	/*var f_mensajes=$("#f_mensajes").val();
	var f_grupo=$("#f_grupo").val();
	var f_fecha=$("#f_fecha").val();
	url="./vistas/vista_pdf.reporte_filtro_env.php?f_mensajes="+f_mensajes+"&f_grupo="+f_grupo+"&f_fecha="+f_fecha;
    window.open(url,"Reporte sms enviados");*/
    $("#form_bandeja_entrada").attr("action","./vistas/vista_pdf.reporte_filtro_env.php");
    $("#form_bandeja_entrada").submit();
});
consultar_cuerpo_tabla_sms_env(0,5,0);
//BLOQUE DE FUNCIONES
function consultar_cuerpo_tabla_sms_env(offset,limit,actual)
{
	//delcaro variables
	var f_mensajes=$("#f_mensajes").val();
	var f_grupo=$("#f_grupo").val();
	var f_fecha=$("#f_fecha").val();
	var f_estatus=$("#f_estatus").val();
	var data={
				f_mensajes:f_mensajes,
				f_grupo:f_grupo,
				f_fecha:f_fecha,
				f_estatus:f_estatus,
				offset:offset,
				limit:limit,
				actual:actual
	};
	$.ajax({
				url:"./controladores/controlador.cuerpo_tabla_sms_ev.php",
				type:"POST",
				data:data,
				cache:false,
				error: function()
				{
					  console.log(arguments);
			          mensajes(6);
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
						$("#cuerpo_tabla_sms_env").html(recordset[0]);//cuerpo de la tabla
                		$("#paginacion_tabla_sms").html(recordset[1]);//paginacion
					}	
				}
	});
}