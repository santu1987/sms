<?php
require_once("../controladores/conex.php");
class Modem extends conex
{
	public $rs;
	public $sql;
	//metodo que arma el select del modem
	function consultar_select_modem()
	{
		$this->sql="SELECT * FROM phones order by ".'phones."ID"'."";
		$this->rs=$this->procesar_query($this->sql);
		return $this->rs;
	}	
}
?>