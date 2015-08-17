<?php
 session_start();
 include_once '../modelos/modelo.usuario.php';

 $combo = new Usuario();
 $resp = $combo->llenar_combo_nivel();
 if($resp != 'error'){
 	echo"<option value='0'>[Tipo de usuario]</option>";
 	for ($i=0; $i < count($resp); $i++) {
 		echo"<option value=".$resp[$i][0].">".$resp[$i][1]."</option>";
    }
 } 
?>