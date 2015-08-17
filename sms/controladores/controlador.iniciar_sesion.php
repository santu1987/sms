<?php
session_start();
$mensaje=array();
require_once('../modelos/modelo.usuario.php');
//valido que los campos no esten vacios...
if((isset($_POST["nombre_usuario"]))&&(isset($_POST["clave_usuario"]))&&($_POST["nombre_usuario"]!="")&&($_POST["clave_usuario"]))
{
	$datos[0]=strtoupper($_POST["nombre_usuario"]);
	$datos[1]=$_POST["clave_usuario"];
}
else
{
	$mensaje[0]="campos_blancos";
	die(json_encode($mensaje));
}
//
$obj_usuario= new Usuario();
$rs=$obj_usuario->iniciar_session($datos[0],$datos[1]);
//die(json_encode($rs));
if($rs=="error")
{
	$mensaje[0]="error_bd";
}
else if($rs=="clave_invalida")
{
	$mensaje[0]="clave_invalida";
}
else
{
	$mensaje[0]="cargando_perfil";
	$mensaje[1]=$rs;
}
die(json_encode($mensaje));
?>