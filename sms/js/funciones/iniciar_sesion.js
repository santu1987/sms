//JS DE vista.inicio_sesion.php
//BLOQUE DE EVENTOS
$("document").ready(function(){
	$("#ingresar_usuario").click(function(){
		if(validar_campos_is()==true)
		{
		    var data=$("#form_inicio_sesion").serialize();
			$.ajax({
						url:'./controladores/controlador.iniciar_sesion.php',
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
		                   // alert(recordset);
			                if(recordset[0]=="cargando_perfil")
		                    {
		                    	//mensajes2(recordset);
		                    	document.forms.form_inicio_sesion.action='./inicio.php';
					            document.forms.form_inicio_sesion.submit();
		                    }
		                    else if(recordset=="clave_invalida")
		                    {
		                    	mensajes(1);//clave invalida
		                    }
		                    else if(recordset=="error_bd")
		                    {
		                    	mensajes(2);//error en bd
		                    }
		                    else if(recordset=="campos_blancos")
		                    {
		                    	mensajes(3);//no debe incluir campos en blanco...
		                    }	
			            }
					});
		}	
	});			            
});
$("#nombre_usuario,#clave_usuario").keypress(function(e) {
  if(e.which==13){
      $("#ingresar_usuario").click();
    }
});  
//BLOQUE DE FUNCIONES
function validar_campos_is()
{
	if($("#nombre_usuario,#clave_usuario").val()=="")
	{
		mensajes(3);
		return false;
	}else
	{
		return true;
	}	
}