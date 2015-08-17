<?php
	ini_set("memory_limit","1024M");
	require("../libs/fbasic.php");
	include_once '../modelos/modelo.usuario.php';
	require("../modelos/modelo.paginacion_consultas.php");
	validar_post_paginacion();
	
	 $nombre = strtoupper($_POST['nombre_us']);
	 $cedula='';
	 $offset = $_POST['offset'];
	 $limite = $_POST['limit'];
	 $actual = $_POST['actual'];
     $nom_fun = "armar_cuerpo";
     $cuerpo_contenido='';
	 $mensaje = array();
	 $resp = array();
	 $j='';
	 $k='';
	 $usuario = new Usuario();
	 $resp = $usuario->consultar_cuerpo_consulta_usuarios($nombre,$cedula,$offset,$limite);	
	 $a=1;
	 if($resp == 'error'){
	 	$mensaje[0]="error";
		die(json_encode($mensaje));
	 }else{
	 	for ($i=0; $i < count($resp); $i++) { 
	 		$k=$i+1;
			$j=$j+1;
			$cuerpo_contenido.= "<tr>
								<td width='20%'>".$resp[$i][1]."</td>
								<td  class='nombre_us' width='25%'>".strtoupper($resp[$i][2])."</td>";
								if($resp[$i][4] != 1 ){
            $cuerpo_contenido.=	"<td class='campo_esp' width='15%'>USUARIO</td>";
								}else{
			$cuerpo_contenido.=	"<td class='campo_esp' width='15%'>ADMINISTRADOR</td>";
								}
								if($resp[$i][3] == 0){
			$cuerpo_contenido.=	"<td class='campo_esp' width='25%'><i id='btn".$resp[$i][0]."' class='fa fa-toggle-off' title='Inactivo' onclick='activar(".$resp[$i][0].")' style='color:#D51646; margin-left:10%; cursor:pointer;'></i></td>";
								}else{
			$cuerpo_contenido.=	"<td class='campo_esp' width='25%'><i id='btn".$resp[$i][0]."' class='fa fa-toggle-on' title='Activo' onclick='desactivar(".$resp[$i][0].")' style='color:#3DC564; margin-left:10%; cursor:pointer;'></i></td>";
								}	
			$cuerpo_contenido.="<td width='20%'><button class='btn btn-danger' onclick='editar(".$resp[$i][0].");' onmouseover='cambiar_color_btn(this);' tile='Editar' onmouseout='cambiar_color_btn2(this);' onclick='editar(".$resp[$i][0].");' ><span class='glyphicon glyphicon-ok'></span></button></td>	
						 </tr>";
	 	}
	 	if($actual=="")$actual=0;
		$obj_paginador=new paginacion($actual,$usuario->num_rows,$nom_fun);
		$mensaje[0]=$cuerpo_contenido;
		$mensaje[1]=$obj_paginador->crear_paginacion();
		die(json_encode($mensaje));
	 } 
?>
