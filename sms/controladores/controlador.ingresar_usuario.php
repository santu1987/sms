<?php
 session_start();
 include_once '../modelos/modelo.usuario.php';
 require("../modelos/modelo.registrar_auditoria.php");
 if ((isset($_POST['nombre']))and(isset($_POST['cedula']))and(isset($_POST['clave']))and(isset($_POST['nivel']))){
 	$nombre = strtoupper($_POST['nombre']);
 	$cedula = $_POST['cedula'];
 	$clave  = $_POST['clave'];
 	$nivel  = $_POST['nivel'];
 	$id_usuario ='';
    if(isset($_POST['id_usuario']))
    {
        if($_POST['id_usuario']!='')
        {
            $id_usuario = $_POST['id_usuario'];
        }    
    }
 	if($id_usuario != ""){
        $estatus = 0;
    }else{
        $estatus = 1;
    }
    $nombre = strtoupper($nombre);

    if($id_usuario == ""){
    	$id_usuario = 0;
    }
 	$nuevo_usuario = new Usuario();
 	$resp = $nuevo_usuario->ingresar_usuario($nombre, $cedula, $clave, $nivel, $estatus, $id_usuario);
 	$envio_resp = $resp[0][0];
    $auditoria = new auditoria("Registrar Usuario"," Ingresar usuario (Nombres: ".$nombre.",Cedula: ".$cedula.")");
    $auditoria=$auditoria->registrar_auditoria();
    if($auditoria==false)
    {
        $mensaje[0]='error_auditoria';die(json_encode($mensaje));
    }
 	echo $envio_resp;  	
 }
?>