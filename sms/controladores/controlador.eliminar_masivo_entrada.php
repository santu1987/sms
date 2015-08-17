<?php
session_start();
require_once("../libs/fbasic.php");
require("../modelos/modelo.bandeja_entrada.php");
require("../modelos/modelo.registrar_auditoria.php");
$vector_grupo=array();
//validando por metodo post...
if(isset($_POST["eliminar_sms"]))
{
	$vector_grupo=$_POST["eliminar_sms"];
	$cuantos_eliminar=count($vector_grupo);
}
else
{
	$mensaje="campos_blancos";
	die(json_encode($vector_grupo));
}
//DECLARO EL OBJETO
$obj_bandejae=new Bandeja_entrada();
for($i=0;$i<=$cuantos_eliminar-1;$i++)
{
	$rs=$obj_bandejae->borrar_sms_inbox($vector_grupo[$i]);
	if($rs=="error")
	{
		$mensaje[0]="error";
		die(json_encode($mensaje));
	}	
}
/////////////////////////////////////////////////--AUDITORIA--///////////////////////////////////////
    $auditoria_eva=new auditoria("Bandeja de entrada","Eliminación de mensajes(ID:".to_pg_array($vector_grupo).")");
    $auditoria=$auditoria_eva->registrar_auditoria();
    if($auditoria==false)
    {
        $mensaje[0]='error_auditoria';die(json_encode($mensaje));

    }
////////////////////////////////////////////////////////////////////////////////////////////////////
$mensaje[0]="eliminacion_exitosa";
die(json_encode($mensaje));	
?>