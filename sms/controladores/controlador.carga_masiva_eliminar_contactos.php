<?php
  session_start();
  include_once '../modelos/modelo.envios_sms.php';
   if ((isset($_POST['id_grupo'])) and ($_POST['id_grupo'] != "")) {
   	$id_grupo = $_POST['id_grupo'];
   	 $sms = new Mensaje_sms();
   	 $resp = $sms->eliminar_tel_grupo($id_grupo);
   	 echo $resp;
   } 