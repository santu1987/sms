<?php
 session_start();
 include_once '../modelos/modelo.grupos.php';
 require("../modelos/modelo.registrar_auditoria.php"); 

 if ((isset($_POST['grupo'])) and ($_POST['grupo'] != "")) {
 	$nombre_grupo = $_POST['grupo'];
 	$id_grupo = $_POST['id_grupo'];
 	$descripcion = $_POST['descripcion'];
 	$grupo = new Grupos();

 	if($id_grupo == ""){
 		$id_grupo = 0;
 	}

 	$resp = $grupo->registra_grupo($nombre_grupo, $id_grupo, $descripcion);
 	$auditoria=new auditoria("Ingresar Grupo","Insertar_contactos(GRUPO: ".$id_grupo.", Nombre: ".$nombre_grupo.")");
    $auditori=$auditoria->registrar_auditoria();
    if($auditori==false)
    {
        $mensaje[0]='error_auditoria';die(json_encode($mensaje));

    }
 	echo $resp[0][0];
 }
?>