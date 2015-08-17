<?php
session_start();
ini_set("memory_limit","1024M");
require("../libs/fbasic.php");
include_once '../modelos/modelo.grupos.php';
require("../modelos/modelo.paginacion_consultas.php");
validar_post_paginacion();

 $nombre = $_POST['nombre'];
 $offset = $_POST['offset'];
 $limite = $_POST['limit'];
 $actual = $_POST['actual'];
 $nom_fun = "armar_cuerpo";
 $j='';
 $k='';
 $cuerpo_contenido='';
 $mensaje = array();
 $resp = array();
 $nombre =strtoupper($nombre); 
  $destinatario = new Grupos();
 $resp = $destinatario->consultar_cuerpo_consulta_contactos($nombre,$offset,$limite);
 if($resp == 'error'){
 	$mensaje[0]="error";
	die(json_encode($mensaje));
 }else{
 	for ($i=0; $i < count($resp); $i++) { 
 		$k=$i+1;
		$j=$j+1;
		$cuerpo_contenido.="<tr>
							<td width='25%'>".$resp[$i][1]."</td>
							<td width='25%' class='campo_esp'>".$resp[$i][2]."</td>
							<td width='25%'><button class='btn btn-danger' id='btn_selec_dest".$k."' onmouseover='cambiar_color_btn(this);' tile='Editar' onmouseout='cambiar_color_btn2(this);' onclick='editar(".$resp[$i][0].");' ><span class='glyphicon glyphicon-ok'></span></button></td>	
					 </tr>";
 	}
 	if($actual=="")$actual=0;
	$obj_paginador=new paginacion($actual,$destinatario->num_rows,$nom_fun);
	$mensaje[0]=$cuerpo_contenido;
	$mensaje[1]=$obj_paginador-> crear_paginacion();
	die(json_encode($mensaje));
 }
?>