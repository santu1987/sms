<?php
//CREADO POR DAVID BELTRAN
//MODIFICADO POR GIANNI SANTUCCI  29/10/2014
 session_start();
 include_once '../libs/fbasic.php';
 include_once '../modelos/modelo.envios_sms.php';
 $contador_registrados=0;
 $contador_no_registrados=0;
 $contador=0;
 if((isset($_POST['data'])) and ($_POST['data'] != "")){
 	 $seleccion = $_POST['data'];
 	 $archivo = fopen('../archivos_txt/insertar.csv', "r");
 	 $sms = new Mensaje_sms();
 	 if($archivo !== FALSE){
 	 	while(($datos = fgetcsv($archivo,1000000, ";")) !== FALSE){
 	 		set_time_limit(0);
 	 		$nombres = curar_cadena_letras($datos[0]);
 	 		$telf = curar_tlf($datos[1]);
 	 		$cod = substr($telf, 0,4);
 	 		if((strlen($telf) == '11') && ($telf != '00000000000')&&($telf != "0")&&($nombres != "")&&(($cod == "0412") or ($cod == '0414')or($cod == '0212')or($cod == '0424')or($cod == '0426')or($cod == "0416"))){
 	 			$contador++;
 	 			$resp = $sms->insertar_contactos($nombres, $seleccion, $telf);
 	 			//Valido que si dam error insertando contactos devuelva ese mensaje .gs
 	 			if($resp=="error"){
 	 				die(json_encode("error"));
 	 			}	
 	 			//
 	 			if ($resp[0][0] == "a"){
 	 				$contador_registrados++;//Le sumo 1 al contador de registrados cada vez que .gs
 	 			}else if($resp[0][0]=="b"){
 	 				$contador_no_registrados++;
 	 			}
 	 			else{
 	 				$sms->insertar_no_registrados($nombres, $seleccion, $telf);
	 	 			$contador_no_registrados++;
 	 			}
 	 		}else{
 	 			$detalle = 'error en tipo de dato';
 	 			$nombre =  explode(',', $datos[0]);
 	 			$sms->insertar_no_registrados2($nombre[0], $seleccion, $nombre[1], $detalle);
 	 			$contador_no_registrados++;
 	 		}
 	 	}
 	 	//Armo mensaje con especificaciones...gs
 	 	$mensaje[0]=$contador_registrados;
 	 	$mensaje[1]=$contador_no_registrados;
 	 	die(json_encode($mensaje));
 	 	//
 	 }else{
 	 	fclose($archivo);
 	 }
 }