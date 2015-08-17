<?php
 session_start();
 include_once '../modelos/modelo.usuario.php';
 require("../modelos/modelo.registrar_auditoria.php");
 $auditoria = new auditoria("Cierre de session"," cerrar session (Id: ".$_SESSION["id"].",Nombre: ".$_SESSION["nombre_us"].")");
 $auditoria=$auditoria->registrar_auditoria();
 if($auditoria==false)
 {
    $mensaje[0]='error_auditoria';die(json_encode($mensaje));

 }
 $usuario = New Usuario();
 $resp = $usuario->cerrar_session();
 echo "$resp";
?>