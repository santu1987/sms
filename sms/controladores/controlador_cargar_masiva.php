<?php
 session_start();
 include_once 'conex.php';
 include_once '../modelos/modelo.envios_sms.php';

 if ((isset($_FILES['archivo']['name'])) and ($_FILES['archivo']['name'] != "")) {
 	$archivo = $_FILES['archivo']['name'];
 	$tipos_archivo = $_FILES['archivo']['type'];
 	$separar = explode('/', $tipos_archivo);
 	 if(($separar[1] == 'csv')||($separar[1] == "CSV")){
 	 	$nombre = 'insertar.csv';
 		$sms = new Mensaje_sms();
 		$resp = $sms->subir_archivo($_FILES['archivo']['tmp_name'], $nombre);
 		echo $resp;
 	 }else{
 	 	echo 1;
 	 }
  }else{
  	echo 0;
  }
