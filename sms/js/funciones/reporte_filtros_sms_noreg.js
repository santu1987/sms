//JS DE vista.reporte_filtro_env.php
//BLOQUE DE EVENTOS
$("#btn_ver_pdf_noreg").click(function(){
	/*var f_tlf=$("#f_tlf").val();
	var f_grupo_n=$("#f_grupo_n").val();
	var f_nombres=$("#f_nombres").val();
	url="./vistas/vista_pdf.reporte_filtro_noreg.php?f_tlf="+f_tlf+"&f_grupo_n="+f_grupo_n+"&f_nombres="+f_nombres;
    window.open(url,"Reporte Destinatarios no registrados");*/
    $("#form_bandeja_noreg").attr("action","./vistas/vista_pdf.reporte_filtro_noreg.php");
    $("#form_bandeja_noreg").submit();
});
consultar_cuerpo_tabla_sms_noreg(0,5,0);
//BLOQUE DE FUNCIONES
function consultar_cuerpo_tabla_sms_noreg(offset,limit,actual)
{
	//delcaro variables
	var f_tlf=$("#f_tlf").val();
	var f_grupo_n=$("#f_grupo_n").val();
	var f_nombres=$("#f_nombres").val();
	var data={
				f_tlf:f_tlf,
				f_grupo:f_grupo_n,
				f_nombres:f_nombres,
				offset:offset,
				limit:limit,
				actual:actual
	};
	$.ajax({
				url:"./controladores/controlador.cuerpo_tabla_sms_noreg.php",
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
					//alert(recordset[2]);
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
						$("#cuerpo_tabla_sms_noreg").html(recordset[0]);//cuerpo de la tabla
                		$("#paginacion_tabla_sms_noreg").html(recordset[1]);//paginacion
                		$("#cantidad_no_registrados_n").html(recordset[2])//Cantidad de personas no registradas
					}	
				}
	});
}