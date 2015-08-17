<?php
session_start();
require("../modelos/modelo.modem.php");
$mensaje=array();
$obj_modem=new Modem();
$rs=$obj_modem->consultar_select_modem();
$campos_modem="<option value='-1' id='-1'>[Modem]</option>";
for($i=0;$i<=count($rs)-1;$i++)
{
	$campos_modem.="<option id=".$rs[$i][0]." value=".$rs[$i][0].">".$rs[$i][0]."</option>";
}
$campos_modem.="<option id='-999' value='-999'>VARIOS MODEM</option>";
die($campos_modem);
?>