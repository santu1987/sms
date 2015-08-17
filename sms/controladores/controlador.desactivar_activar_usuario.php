<?php
 session_start();
 include_once '../modelos/modelo.usuario.php';

 if((isset($_POST['id'])) && ($_POST['id'] != "")){
 	$id_usuario = $_POST['id'];
    $usuario = New Usuario();
 	$resp = $usuario->cambio_estatus($id_usuario);
 	$envio="";
 	if(($resp != "error") && ($resp[0][0] == 'a')){
 		$envio = 1;
 	}else{
 		 $envio = 0;
 	}
 	echo "$envio"; 
 }
?>