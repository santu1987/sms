<?php
require_once("../controladores/conex.php");
class Bandeja_salida extends conex
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
						enviados a
					left join
						grupos
					on
						grupos.id=a.id_grupo
					WHERE 1=1 ".$where.";";
        $rs2=$this->procesar_query($this->sql);
        $this->num_rows=$rs2[0][0];
        ////////////////////////////////////////////
	}
	//Metodo para armar cuerpo de consulta be
	function consultar_cuerpo_bs($f_texto,$offset,$limit)
	{
		$where='';
		$where2='';
		if($f_texto!="")
		{
			$where="AND upper(a.texto) like '%".$f_texto."%'";
		}
		if(($offset!="")&&($limit!=""))	
		{
			$where2="limit '".$limit."' 
                    offset '".$offset."' ";
		}
		$this->sql="SELECT 
							a.texto,
							(SELECT COUNT(*)FROM sentitems where ".'sentitems."TPMR"'."<> -1 AND a.id=".'sentitems."CreatorID"'."::integer)AS enviados,
							(SELECT COUNT(*)FROM sentitems where ".'sentitems."TPMR"'."=-1 AND a.id= ".'sentitems."CreatorID"'."::integer)AS fallidos,
							a.cantidad_registrados,
							upper(grupos.nombre_grupo) AS nombre_grupo,
							a.tlf_individual,
							to_char(a.fecha,'DD-MM-YYYY') AS fecha					
					FROM
						enviados a
					left join
						grupos
					on
						grupos.id=a.id_grupo
								
					WHERE
						1=1
					".$where."	
					ORDER BY a.id  desc ".$where2.";";
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
