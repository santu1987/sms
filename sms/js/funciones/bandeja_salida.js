//JS DE vista.bandeja_salida.js
//BLOQUE DE EVENTOS
consultar_cuerpo_tabla_bs(0,20,0);
var intervalo=setInterval(function(){consultar_cuerpo_tabla_bs(0,20,0);},3000);
//luego que haya aceptadop un mensaje emergente activa nuevamente el interval...
$("#aceptar_mensaje").click(function(){
//
	actualizacion_automatica();
	$("#f_texto_sms").val("");
//	
});
//BLOQUE DE FUNCIONES
function detener_interval(intervalo)
{
	//clearInterval(setInterval(function(){consultar_cuerpo_tabla_bs(0,20,0);},3000));
  clearInterval(intervalo);

}
function desactivar_pop()
{
	$(".popover").remove();
}
function activar_pop(campo)
{
	$(".popover").remove();
	$(campo).popover();
}
//funcion que genera el setTimeInterval...s
function actualizacion_automatica()
{
   intervalo=setInterval(function(){consultar_cuerpo_tabla_bs(0,20,0);},3000);
}
//funcion del archivo bandeja_salida.js, se coloca aqui debido a que se debe detener el setinterval cuando se desplaze entre los diferentes módulos
function consultar_cuerpo_tabla_bs(offset,limit,actual)
{
  //alert("aaaas");
  var f_texto_sms=$("#f_texto_sms").val();
  var data={
        f_texto_sms:f_texto_sms,
        offset:offset,
        limit:limit,
        actual:actual
       };
  $.ajax({
        url:"./controladores/controlador.cuerpo_tabla_bandeja_salida.php",
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
            detener_interval(intervalo);
          }
          else if(recordset=="campos_blancos")
          {
            mensajes(6);//error pasando campos vacios
            detener_interval(intervalo);
          }
          else
          {
            $("#cuerpo_tabla_bs").html(recordset[0]);//cuerpo de la tabla
                    //$("#paginacion_tabla_bs").html(recordset[1]);//paginacion
          } 
        }
  });
}