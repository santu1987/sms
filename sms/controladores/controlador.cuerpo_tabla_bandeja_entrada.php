<?php
session_start();
ini_set("memory_limit","1024M");
require("../libs/fbasic.php");
require("../modelos/modelo.bandeja_entrada.php");
require("../modelos/modelo.paginacion_consultas.php");
//valido los post
validar_post_paginacion();
//
$mensaje=array();
$cuerpo_contenido='';
$f_nom_be=strtoupper($_POST["f_nom_be"]);//nombre
$f_num_be=$_POST["f_num_be"];//numero tlf
$offset=$_POST["offset"];//offset
$j=$offset;//contador para el campo n°
$limit=$_POST["limit"]; //limit
$actual=$_POST["actual"];
$nom_fun="consultar_cuerpo_tabla_be";
$rs=array();
$obj_be=new Bandeja_entrada();
$rs=$obj_be->consultar_cuerpo_be($f_nom_be,$f_num_be,$offset,$limit);
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
		$cuerpo_contenido.="<tr>
								<td class='campo_esp' width='25%'>".$rs[$i][1]."</td>
								<td width='25%'>".$rs[$i][2]."</td>
								<td width='5%'>".$rs[$i][3]."</td>
								<td width='5%'>
									<input type='checkbox' name='eliminar_sms[]' style='margin-left:20%' id='eliminar_sms".$i."' value='".$rs[$i][0]."'>
								</td>
								<td width='15%'>
									<button type='button' class='btn btn-danger operaciones_be' id='btn_selec_dest".$k."' onmouseover='cambiar_color_btn(this);' onmouseout='cambiar_color_btn2(this);' onclick='btn_el_inbox(".$rs[$i][0].");' ><span class='glyphicon glyphicon-remove'></span></button>
								</td>	
					 		</tr>";
		
	}
	if($actual=="")$actual=0;
	$obj_paginador=new paginacion($actual,$obj_be->num_rows,$nom_fun);
	$mensaje[0]=$cuerpo_contenido;
	$mensaje[1]=$obj_paginador-> crear_paginacion();
	die(json_encode($mensaje));
}	
?>