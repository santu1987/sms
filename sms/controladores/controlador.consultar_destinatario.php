<?php
session_start();
ini_set("memory_limit","1024M");
require("../libs/fbasic.php");
require("../modelos/modelo.destinatarios.php");
$mensaje=array();
//valido el campo
if((isset($_POST["n_tlf"]))&&($_POST["n_tlf"]!=""))
{
	$n_tlf=$_POST["n_tlf"];
}
$obj_destinatario=new Destinatarios();
$rs=$obj_destinatario->consulta_destinatario_tlf($n_tlf);
$rs2=$obj_destinatario->consultar_grupos_tlf($n_tlf);
$cuantos_grupos=count($rs2);
//die(json_encode($rs));
if(($rs=="error")||($rs2=="error"))
{
	$mensaje[0]="error_bd";
	die(json_encode($mensaje));
}else
{
	$mensaje[0]=$rs;
	$mensaje[1]=$rs2;
	$mensaje[2]=$cuantos_grupos;
	die(json_encode($mensaje));
}	
?>