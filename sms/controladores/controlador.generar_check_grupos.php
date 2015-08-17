<?php
session_start();
$mensaje=array();
require_once('../modelos/modelo.grupos.php');
$op_check=$_POST["valor"];
$checkear='';
$obj_grupos=new Grupos();
$rs=$obj_grupos->consultar_grupos();
$check_grupos='<legend><h3>Listado de grupos</h3></legend>';
for($i=0;$i<=count($rs)-1;$i++)
{
	$k=$i+1;//value='".$rs[$i][0]."'
	
///////recorro la matriz de las opciones marcadas, caso de que alguna este seleccionada...
if($op_check!=0)	
{	
	 for($z=0;$z<=count($op_check)-1;$z++)
	 {
	 	if($op_check[$z][0]==$rs[$i][0]){ $checkear=" checked "; break;}	
	 }	
}
/////
	$check_grupos.=" <input type='checkbox' name='grupos[]' id='grupo_".$k."' value='".$rs[$i][0]."' ".$checkear.">".$rs[$i][1]."<br>";
	$checkear="";
/////
}
die(json_encode($check_grupos));
?>