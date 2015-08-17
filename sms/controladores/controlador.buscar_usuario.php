<?php
  session_start();
  include_once '../modelos/modelo.usuario.php';
  if((isset($_POST['id']))and($_POST['id'] != "")){
  	$id_usuario = $_POST['id'];
  	$usuario = new Usuario();
  	$resp = $usuario->buscar_usuario($id_usuario);
  	if($resp != 'error'){
  		for ($i=0; $i < count($resp) ; $i++) { 
  		    $id     = $resp[$i][0];
  		    $nombre = $resp[$i][1];
  		    $nivel_id = $resp[$i][2];
  		    $cedula = $resp[$i][3];
  		}
  		$variable = $id.",".$nombre.",".$nivel_id.",".$cedula;
  		echo $variable;
  	}else{
       echo 0;
  	}  
  }
?>