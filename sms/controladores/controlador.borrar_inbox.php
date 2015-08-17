<?php
session_start();
require("../modelos/modelo.bandeja_entrada.php");
require("../modelos/modelo.registrar_auditoria.php"); 
$mensaje=array();
/////////////////////////////////////////////////////////
if(isset($_POST["id_tlf"]))
{
	if($_POST["id_tlf"]!="")
	{
		$id=$_POST["id_tlf"];
	}
	else
	{
		$mensaje[0]="campos_blancos";
		die(json_encode($mensaje));
	}	
}
else
{
	$mensaje[0]="campos_blancos2";
	die(json_encode($mensaje));
}	
///////////////////////////////////////////////////////
$obj_be=new Bandeja_entrada();
$rs=$obj_be->borrar_sms_inbox($id);
if($rs=="error")
{
	$mensaje[0]="error_bd";
}
else
{
	$mensaje[0]=$rs[0][0];//puede tener el valor no existe sms o eliminacion exitosa....
	if($rs[0][0]=="eliminacion_exitosa")
	{
	/////////////////////////////////////////////////--AUDITORIA--///////////////////////////////////////
	    $auditoria_eva=new auditoria("Bandeja de entrada","Eliminar sms inbox (ID:".$id.")");
	    $auditoria=$auditoria_eva->registrar_auditoria();
	    if($auditoria==false)
	    {
	        $mensaje[0]='error_auditoria';die(json_encode($mensaje));

	    }
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	}
}	
die(json_encode($rs));
?>