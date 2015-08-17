<?php
require_once("../controladores/conex.php");
class Grupos extends conex
{
	//metodo que consulta los grupos
	function consultar_grupos()
	{
		$rs=$this->procesar_query("SELECT 
										id,
										upper(nombre_grupo),
										descripcion
								  FROM 
								  		grupos");
		return $rs;						  			  		
	}
	
	public function registra_grupo($grupo, $id_grupo, $desc){
		 $sql = "SELECT 
		            registrar_grupo('".$grupo."',".$id_grupo.",'".$desc."')";
		 $resp = $this->procesar_query($sql);
		 return $resp;            
	}
	
	function cuantos_son($where)
	{
		//calculo cuantos son..
        $this->sql="SELECT count(*) FROM grupos WHERE 1=1 ".$where.";";
        $rs2=$this->procesar_query($this->sql);
        $this->num_rows=$rs2[0][0];
        ////////////////////////////////////////////
	}

	function consultar_cuerpo_consulta_contactos($f_nom,$offset,$limit)
	{
		$where='';
		$where2='';
		if($f_nom!="")
		{
			$where="AND upper(nombre_grupo) like '%".$f_nom."%'";
		}	
		if(($offset!="")&&($limit!=""))	
		{
			$where2="limit '".$limit."' 
                    offset '".$offset."' ";
		}
		$this->sql="SELECT 
							id,
							nombre_grupo,
							descripcion
					FROM
							grupos
					WHERE
							1=1
					".$where." 
					".$where2." 
					;";
		$this->rs=$this->procesar_query($this->sql);
		//calculo cuantos son...
		$this->cuantos_son($where);
		return 	$this->rs;		
	}

	public function buscar_grupo($id){
		$sql = " SELECT * 
		               FROM 
		                    grupos
		               WHERE 
		                    id = ".$id;
		$resp = $this->procesar_query($sql);
		return $resp;	
	}
}
?>
