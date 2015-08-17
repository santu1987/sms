<?php
session_start();
ini_set("memory_limit","1024M");
require("../libs/fbasic.php");
require("../modelos/modelo.destinatarios.php");
require("../modelos/modelo.paginacion_consultas.php");
//valido los post
validar_post_paginacion();
//
$mensaje=array();
$f_nom=strtoupper($_POST["f_nom_"]);//nombre
$f_num=$_POST["f_num"];//numero tlf
$offset=$_POST["offset"];//offset
$j=$offset;//contador para el campo n°
$limit=$_POST["limit"]; //limit
$actual=$_POST["actual"];
$nom_fun="consultar_cuerpo_tabla_destinatarios";
$cuerpo_contenido='';
$k='';
$j='';
$rs=array();
$obj_destinatarios=new Destinatarios();
$rs=$obj_destinatarios->consultar_cuerpo_consulta_destinatarios($f_nom,$f_num,$offset,$limit);
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
							<td width='50%'>".$rs[$i][1]."</td>
							<td width='25%'>".$rs[$i][2]."</td>
							<td width='25%'><button class='btn btn-danger' id='btn_selec_dest".$k."' onmouseover='cambiar_color_btn(this);' onmouseout='cambiar_color_btn2(this);' onclick='btn_selec_des(\"$tlf\");' ><span class='glyphicon glyphicon-ok'></span></button></td>	
					 </tr>";
	}
	if($actual=="")$actual=0;
	$obj_paginador=new paginacion($actual,$obj_destinatarios->num_rows,$nom_fun);
	$mensaje[0]=$cuerpo_contenido;
	$mensaje[1]=$obj_paginador-> crear_paginacion();
	die(json_encode($mensaje));
}	
?>