<?php
session_start();
$mensaje=array();
if(isset($_GET["opcion"]))
{
	if($_GET["opcion"]!="")
	{
		$opcion=$_GET["opcion"];
	}	
}else
$opcion='';
require_once('../modelos/modelo.grupos.php');
$obj_grupos=new Grupos();
$rs=$obj_grupos->consultar_grupos();
$campos_grupos='';
$campos_grupos.="<option value='-1' id='-1'>[Grupos]</option>";
for($i=0;$i<=count($rs)-1;$i++)
{
	$campos_grupos.="<option id=".$rs[$i][0]." value=".$rs[$i][0].">".$rs[$i][1]."</option>";
}
if($opcion!='1')
{
	$campos_grupos.="<option id='-999' value='-999'>VARIOS GRUPOS</option>";
}
die($campos_grupos);
?>