<?php
require_once("../controladores/conex.php");
class Bandeja_entrada extends conex
{
	public $rs;
	public $sql;
	public $num_rows;
	//Metodo para determinar la longitud de la tabla
	function cuantos_son($where)
	{
		//calculo cuantos son..
        $this->sql="SELECT 
    					count(*) 
    				FROM
						contactos
					INNER JOIN 
							inbox
					ON 
							contactos.tlf1=".'inbox."SenderNumber"'."
					WHERE 1=1 AND 	inbox.estatus_bandeja=1	".$where.";";
        $rs2=$this->procesar_query($this->sql);
        $this->num_rows=$rs2[0][0];
        ////////////////////////////////////////////
	}
	//Metodo para armar cuerpo de consulta be
	function consultar_cuerpo_be($f_nom_be,$f_num_be,$offset,$limit)
	{
		$where='';
		$where2='';
		if($f_nom_be!="")
		{
			$where="AND upper(contactos.nombre) like '%".$f_nom_be."%'";
		}
		if($f_num_be!="")
		{
			$where="AND upper(contactos.tlf1) like '%".$f_num_be."%'";
		}
		if(($offset!="")&&($limit!=""))	
		{
			$where2="limit '".$limit."' 
                    offset '".$offset."' ";
		}
		$this->sql="SELECT 
							".'inbox."ID"'." AS id_sms,
							contactos.nombre,
							contactos.tlf1,
							".'inbox."TextDecoded"'."
					FROM
							contactos
					INNER JOIN 
							inbox
					ON 
							contactos.tlf1=".'inbox."SenderNumber"'."	
					WHERE
							1=1
					AND
							inbox.estatus_bandeja=1		
					".$where." 
							ORDER BY id_sms desc
					".$where2.";";
		//return $this->sql;
		$this->rs=$this->procesar_query($this->sql);
		//calculo cuantos son...
		$this->cuantos_son($where);
		return 	$this->rs;		
	}
	//Metodo para borrar de inbox un registro...
	function borrar_sms_inbox($id)
	{
		$this->sql="SELECT borrar_sms_inbox(".$id.")";
		$this->rs=$this->procesar_query($this->sql);
		return $this->rs;
	}
}
?>