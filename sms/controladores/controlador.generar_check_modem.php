<?php
session_start();
$mensaje=array();
require_once('../modelos/modelo.modem.php');
$op_check=$_POST["valor"];
$checkear='';
$obj_modem=new Modem();
$rs=$obj_modem->consultar_select_modem();
$check_modem='<div class="form-group" id="contenedor_modem" name="contenedor_modem"><legend><h3>Listado de modem</h3></legend>';
for($i=0;$i<=count($rs)-1;$i++)
{
	$k=$i+1;//value='".$rs[$i][0]."'
if($op_check!=0)
{	
///////recorro la matriz de las opciones marcadas, caso de que alguna este seleccionada...
	 for($z=0;$z<=count($op_check)-1;$z++)
	 {
	 	if($op_check[$z][0]==$rs[$i][0]){ $checkear=" checked "; break;}	
	 }	
/////
}	 
	$check_modem.=" <input type='checkbox' name='modem[]' id='modem_".$k."' value='".$rs[$i][0]."' ".$checkear.">".$rs[$i][0]."<br>";
	$checkear="";
/////
}
$check_modem.="</div>";
die(json_encode($check_modem));
?>