<?php
require_once("../controladores/conex.php");
class auditoria extends conex
{
	public $seccion;
	public $accion;
	function __construct($seccion,$accion)
	{
		$this->seccion=$seccion;
		$this->accion=$accion;
	}
	//////////////////////////////
	function registrar_auditoria()
	{
		$hora=date("H:i:s");
		$dia=date("Y-m-d");
		$sql="SELECT registrar_auditoria(
		    '".$this->seccion."',
		    '".$this->accion."',
		    '".$_SESSION["nombre_us"]."',
		    '".$_SESSION["id"]."',
		   '".$_SERVER['REMOTE_ADDR']."',
		   '".$dia."',
		   '".$hora."'
		);";
		///////////////////////////////////
		//return $sql;
		$record=$this->procesar_query($sql);
		if($record=="error")
		{
			return false;
		}
		else
		{
			return true;
		}
		/////////////////////////////////	
	}
	//////////////////////////
}
?>