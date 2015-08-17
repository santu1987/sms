<?php
session_start();
ini_set("memory_limit","1024M");
require("../libs/fbasic.php");
require("../modelos/modelo.destinatarios.php");
require("../modelos/modelo.paginacion_consultas.php");
//valido los post
validar_post_paginacion();
$mensaje=array();
$cuerpo_contenido='';
$tlf='';
$grupos='';
$nombres='';
//lleno las variables filtro...
if(isset($_POST["f_tlf"])){$tlf=$_POST["f_tlf"];}
if(isset($_POST["f_grupo"])){$grupos=strtoupper($_POST["f_grupo"]);}
if(isset($_POST["f_nombres"])){$nombres=strtoupper($_POST["f_nombres"]);}
//
$offset=$_POST["offset"];//offset
$j=$offset;//contador para el campo n°
$limit=$_POST["limit"]; //limit
$actual=$_POST["actual"];
$nom_fun="consultar_cuerpo_tabla_sms_noreg";
$rs=array();
$obj_noreg=new Destinatarios();
$rs=$obj_noreg->consultar_cuerpo_sms_noreg($tlf,$grupos,$nombres,$offset,$limit);
//die(json_encode($rs));
if($rs=="error")
{
	$mensaje[0]="error";
	die(json_encode($mensaje));
}
else
{
	for($i=0;$i<=count($rs)-1;$i++)
	{
		//debido a que tiene demasiados contactos
		set_time_limit(0);
		$k=$i+1;
		$j=$j+1;
		$tlf=$rs[$i][2];
		//valido el grupo
		
		//
		$cuerpo_contenido.="<tr>
								<td class='nom_no_reg' width='30%'>".$rs[$i][1]."</td>
								<td width='25%'>".$rs[$i][0]."</td>
								<td class='campo_esp'  width='25%'>".$rs[$i][2]."</td>
								<td class='campo_esp'  width='25%'>".$rs[$i][3]."</td>
							</tr>";
	}
	if($actual=="")$actual=0;
	$obj_paginador=new paginacion($actual,$obj_noreg->num_rows2,$nom_fun);
	$mensaje[0]=$cuerpo_contenido;
	$mensaje[1]=$obj_paginador-> crear_paginacion();
	$mensaje[2]="<h4><b>Cantidad de personas no registradas ".$obj_noreg->num_rows2."</b></h4>";
	die(json_encode($mensaje));
}	
?>