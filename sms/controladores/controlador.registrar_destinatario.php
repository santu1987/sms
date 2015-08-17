<?php
session_start();
require_once("../libs/fbasic.php");
require("../modelos/modelo.registrar_auditoria.php"); 
require_once("../modelos/modelo.destinatarios.php");
$mensaje=array();
//valido los post
validar_campos();
//opero
$cuantos_nombres=count($_POST["carga_ind_nombre"]);
$cuantos_tlf=count($_POST["carga_ind_tlf"]);
$grupo=$_POST["carga_ind_grupo"];
//caso varios grupos
if($grupo=='-999')
{
	$vector_grupo=$_POST["grupos"];
	$cuantos_vg=count($vector_grupo);
}else
{
	$vector_grupo[0]=$grupo;
	$cuantos_vg=1;
}
//	
if($cuantos_nombres!=$cuantos_tlf)
{
	$mensaje[0]="error1";
	die(json_encode($mensaje));
}
$obj_destinatarios=new Destinatarios();
$v_nombre=to_pg_array($_POST["carga_ind_nombre"]);
$v_tlf=to_pg_array($_POST["carga_ind_tlf"]);
$v_grupo=to_pg_array($vector_grupo);
$rs=$obj_destinatarios->registrar_destinatarios($v_nombre,$v_tlf,$cuantos_tlf,$cuantos_vg,$v_grupo);
//die(json_encode($rs));
if($rs=='error')
{
	$mensaje[0]="error";
	die(json_encode($mensaje));
}else
if($rs[0][0]=="registro_exitoso")
{
	/////////////////////////////////////////////////--AUDITORIA--///////////////////////////////////////
    $auditoria_eva=new auditoria("Cargar destinatario","Registro de destinatarios (TLF:".$v_tlf.",GRUPO:".$v_grupo.")");
    $auditoria=$auditoria_eva->registrar_auditoria();
    //die(json_encode($auditoria));
    if($auditoria==false)
    {
        $mensaje[0]='error_auditoria';die(json_encode($mensaje));

    }
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	$mensaje[0]="registro_exitoso";
	die(json_encode($mensaje));
}
?>
