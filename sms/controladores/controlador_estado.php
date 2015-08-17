<?php
session_start();
$mensaje=array();
require_once('../modelos/modelo.estado.php');
$obj_grupos=new Grupos();
$rs=$obj_grupos->consultar_grupos();
$campos_grupos.="<option value='-1' id='-1'>[Grupos]</option>";
for($i=0;$i<=count($rs)-1;$i++)
{
	$campos_grupos.="<option id=".$rs[$i][0].">".$rs[$i][1]."</option>";
}
die($campos_grupos);
?>