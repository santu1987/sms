<?php
session_start();
ini_set("memory_limit","1024M");
require("../libs/fbasic.php");
require("../modelos/modelo.envios_sms.php");
require("../modelos/modelo.paginacion_consultas.php");
//valido los post
validar_post_paginacion();
$mensaje=array();
$cuerpo_contenido='';
//lleno las variables filtro...
$sms=strtoupper($_POST["f_mensajes"]);
$grupos=$_POST["f_grupo"];
$fecha=$_POST["f_fecha"];
//
$offset=$_POST["offset"];//offset
$j=$offset;//contador para el campo n°
$limit=$_POST["limit"]; //limit
$actual=$_POST["actual"];
$nom_fun="consultar_cuerpo_tabla_sms_env";
$rs=array();
$obj_env_sms=new Mensaje_sms();
$rs=$obj_env_sms->consultar_cuerpo_env_sms($sms,$grupos,$fecha,$offset,$limit);
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
		if($rs[$i][1]=='')
		{
			$nom_grupo=$rs[$i][5];
		}
		else
		{
			$nom_grupo=$rs[$i][1];
		}	
		//
		$cuerpo_contenido.="<tr>
								<td width='25%'>".$rs[$i][0]."</td>
								<td class='campo_esp' width='25%'>".$nom_grupo."</td>
								<td width='5%'>".$rs[$i][2]."/".$rs[$i][3]."</td>
								<td class='campo_esp' width='25%'>".$rs[$i][4]."</td>
							</tr>";
	}
	if($actual=="")$actual=0;
	$obj_paginador=new paginacion($actual,$obj_env_sms->num_rows,$nom_fun);
	$mensaje[0]=$cuerpo_contenido;
	$mensaje[1]=$obj_paginador-> crear_paginacion();
	die(json_encode($mensaje));
}	
?>