<?php
  session_start();
  include_once '../modelos/modelo.grupos.php';
  require("../modelos/modelo.registrar_auditoria.php");

  if ((isset($_POST['id']))and($_POST['id'] != "")) {
  	$id_grupo = $_POST['id'];
  	$grupo = new Grupos();
  	$resp = $grupo->buscar_grupo($id_grupo);
  	if($resp != 'error' ){
  		for ($i=0; $i < count($resp); $i++) { 
  			$id = $resp[$i][0];
  			$nombre = $resp[$i][1];
        $desc = $resp[$i][2];
  		}
  		$variable = $id.",".$nombre.",".$desc;
      $auditoria = new auditoria("Consultar Grupo","Consultar grupo (id: ".$id_grupo.")");
      $auditoria=$auditoria->registrar_auditoria();
      if($auditoria==false)
      {
        $mensaje[0]='error_auditoria';die(json_encode($mensaje));

      }
      echo $variable; 
  	}else{
  		echo 0;
  	}
  }
?>