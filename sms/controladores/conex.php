<?php
//conexion de bd aplicando patron de diseño singleton...
class Conex
{
		
			private $conexion;
			private $servidor="localhost";
			private $clave="123456";
			private $usuario="postgres";
			private $bd="db_sms_2015";
			private $query;
			public $arreglo = array();
			public  $sql="";
		/*Metodo constructor*/
		public function __construct()
		{
			$this->query="";
		}
		//
		//metodo que permite conectarse a la bd
		public function conectar()
		{
			$this->conexion=pg_connect('host='.$this->servidor. ' port=5432'. ' dbname='.$this->bd. ' user='.$this->usuario.' password='.$this->clave);
			if($this->conexion)
			{
				return 'SI';
			}
			else
			{
				return 'NO';
			}	
		}
		//
		//metodo que permite ejecutar un query
		//para select
		function enviarQuery($sql)
		{
			$this->query = pg_query($sql);
			return $this->query;
		}

		function vectorizar()
		{
			return pg_fetch_row($this->query);
		}

		//para insert, update, delete
		function execute($sql)
		{
			$result = $this->enviarQuery($sql);
			if($result){
				$arr = array();
				while($row = $this->vectorizar()){
					$arr[] = $row;
				}
			}else{
				$arr = "error";
			}
			return $arr;
		}
		//METODO CREADO EL 2/10/2014 POR GIANNI SANTUCCI, PARA AGILIZAR EL PROCESO DE EXECUTE DE UN QUERY
		function procesar_query($sql)
		{
			$this->conectar();
			$rs=$this->execute($sql);
			return $rs;
		}
}
$db= new Conex();
?>
