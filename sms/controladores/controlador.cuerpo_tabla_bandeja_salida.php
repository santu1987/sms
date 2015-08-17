<?php
session_start();
ini_set("memory_limit","1024M");
require("../libs/fbasic.php");
require("../modelos/modelo.bandeja_salida.php");
require("../modelos/modelo.paginacion_consultas.php");
//valido los post
validar_post_paginacion();
//
$mensaje=array();
$cuerpo_contenido='';
$f_texto_sms='';
if(isset($_POST["f_texto_sms"]))
{
	if($_POST["f_texto_sms"]!="")
	{
		$f_texto_sms=strtoupper($_POST["f_texto_sms"]);//numero tlf
	}
}
$offset=$_POST["offset"];//offset
$j=$offset;//contador para el campo n°
$limit=$_POST["limit"]; //limit
$actual=$_POST["actual"];
$nom_fun="consultar_cuerpo_tabla_bs";
$rs=array();
$obj_bs=new Bandeja_salida();
$rs=$obj_bs->consultar_cuerpo_bs($f_texto_sms,$offset,$limit);
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
		$campo="#pop_ejem".$k;
		$tlf=$rs[$i][2];
		$cuantos_van=$rs[$i][1]+$rs[$i][2];
		$total_reg=$rs[$i][3];
		//validando grupos
		if($rs[$i][4]=='')
		{
			$grupos=$rs[$i][5];
		}else
		{
			$grupos=$rs[$i][4];
		}	
		//	
		$mensaje_estatus=$cuantos_van."/".$total_reg;
		$mensaje_estatus2="Enviados: ".$rs[$i][1]." Fallidos: ".$rs[$i][2];
		$cuerpo_contenido.="<tr>
								<td width='50%'>".$rs[$i][0]."</td>
								<td width='20%'><label>".$mensaje_estatus." <i class='fa fa-comment' style='cursor:pointer' data-container='body' id='pop_ejem".$k."' name='pop_ejem' onmouseout='desactivar_pop();' onclick='activar_pop(\"$campo\");' data-toggle='popover' data-placement='right' data-content='".$mensaje_estatus2."'></i></label></td>
								<td class='campo_esp' width='15%'>".$grupos."</td>
								<td class='campo_esp' width='15%'>".$rs[$i][6]."</td>
								</td>
								</tr>";
	}
	if($actual=="")$actual=0;
	$mensaje[0]=$cuerpo_contenido;
	/*$obj_paginador=new paginacion($actual,$obj_bs->num_rows,$nom_fun);
	$mensaje[1]=$obj_paginador-> crear_paginacion();*/
	die(json_encode($mensaje));
}	
?>