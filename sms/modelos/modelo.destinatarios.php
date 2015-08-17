<?php
require_once("../controladores/conex.php");
class Destinatarios extends conex
{
	public $sql;
	public $rs;
	public $num_rows;
	public $num_rows2;
	public $cantidad_no_registrados;
	//metodo para registrar los contactos
	function registrar_destinatarios($carga_ind_nombre,$carga_ind_tlf,$cuantos,$cuantos_vg,$vector_grupo)
	{
		$this->sql="SELECT registrar_destinatarios('".$carga_ind_nombre."','".$carga_ind_tlf."',".$cuantos.",".$cuantos_vg.",'".$vector_grupo."')";
		//return $this->sql;
		$this->rs=$this->procesar_query($this->sql);
		return $this->rs;
	}
	//metodo patra determinar cuantos destintarios existen..
	function cuantos_son($where)
	{
		//calculo cuantos son..
        $this->sql="SELECT count(*) FROM contactos WHERE 1=1 ".$where.";";
        $rs2=$this->procesar_query($this->sql);
        $this->num_rows=$rs2[0][0];
        ////////////////////////////////////////////
	}
	//metodo el cuerpo de modal consultas destinatarios
	function consultar_cuerpo_consulta_destinatarios($f_nom,$f_num,$offset,$limit)
	{
		$where="";
		if($f_nom!="")
		{
			$where.=" AND upper(contactos.nombre) like '%".$f_nom."%'";
		}
		if($f_num!="")
		{
			$where.=" AND upper(contactos.tlf1) like '%".$f_num."%'";
		}	
		if(($offset!="")&&($limit!=""))	
		{
			$where2="limit '".$limit."' 
                    offset '".$offset."' ";
		}
		$this->sql="SELECT 
							contactos.id,
							contactos.nombre,
							contactos.tlf1
					FROM
							contactos
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
	//metodo para consultar de forma individual un destinatario segun su tlf
	function consulta_destinatario_tlf($n_tlf)
	{
		$this->sql="SELECT 
							contactos.nombre,
							contactos.tlf1
					FROM	
							contactos
					WHERE 
							contactos.tlf1='".$n_tlf."';";
		//return($this->sql);					
		$this->rs=$this->procesar_query($this->sql);
		return $this->rs;						
	}
	//metodo para consultar los grupos a los que pertenece un destinatario
	function consultar_grupos_tlf($n_tlf)
	{
		$this->sql="
					SELECT
							contactos_grupos.id_grupo
					FROM
							contactos_grupos
					WHERE
							contactos_grupos.tlf='".$n_tlf."';";
		$this->rs=$this->procesar_query($this->sql);
		return $this->rs;					
	}
	//Metodo para contar cuantos destinatarios no se registraron
	function cuantos_son_sms_noreg($where)
	{
		//calculo cuantos son..
        $this->sql="SELECT 
    					count(*) 
    				FROM
			  			contactos_no_reg
					INNER JOIN 
					  	grupos
					ON 
					  	contactos_no_reg.id_grupos=grupos.id
					WHERE 1=1 ".$where.";";
        $rs2=$this->procesar_query($this->sql);
        $this->num_rows2=$rs2[0][0];
        ////////////////////////////////////////////
	}
	//Metodo para consultar contactos no registrados
	function consultar_cuerpo_sms_noreg($tlf,$grupos,$nombres,$offset,$limit)
	{
		//FILTROS
		$where='';
		$where2='';
		if($tlf!="")
		{
			$where.=" AND contactos_no_reg.tlf1 like '%".$tlf."%'";
		}
		if($grupos!="")
		{
			$where.=" AND upper(grupos.nombre_grupo) like '%".strtoupper($grupos)."%'";
		}
		if($nombres!="")
		{
			$where.=" AND upper(contactos_no_reg.nombre) like '%".strtoupper($nombres)."%'";
		}
		if(($offset!="")&&($limit!=""))	
		{
			$where2=" limit '".$limit."' 
                      offset '".$offset."' ";
		}
		//
		$this->sql="  SELECT 
							 tlf1 AS tlf,
							 nombre AS nombres,
		  					 upper(grupos.nombre_grupo) AS nombre_grupo,
							 upper(observacion)
					  FROM
					  		contactos_no_reg
					  INNER JOIN 
					  		grupos
					  ON 
					  		contactos_no_reg.id_grupos=grupos.id				
					  WHERE
					  		1=1
					  ".$where."
					  ORDER BY contactos_no_reg.id desc
					  ".$where2.";";
		//return $this->sql;	  
		$rs=$this->procesar_query($this->sql);
		//calculo cuantos son...
		$this->cuantos_son_sms_noreg($where);
		//verifico cuanto es el total de personas no registradas....
		//$this->cuantos_son_no_reg_total($where);
		return $rs; 
	}
	//Metodo para consultar mensajes enviados en un pdf
	function consultar_sms_noreg($tlf,$grupos,$nombres)
	{
		
		$where='';
		//BLOQUE DE FILTROS
		if($tlf!="")
		{
			$where="AND contactos_no_reg.tlf1 like '%".$tlf."%'";
		}
		if($grupos!="")
		{
			$where="AND upper(grupos.nombre_grupo) like '%".strtoupper($grupos)."%'";
		}
		if($nombres!="")
		{
			$where="AND upper(contactos_no_reg.nombre) like '%".strtoupper($nombres)."%'";
		}
		//
		$this->sql="SELECT 
							 tlf1 AS tlf,
							 upper(nombre) AS nombres,
		  					 upper(grupos.nombre_grupo) AS nombre_grupo,
							 upper(observacion)
					  FROM
					  		contactos_no_reg
					  INNER JOIN 
					  		grupos
					  ON 
					  		contactos_no_reg.id_grupos=grupos.id				
					  WHERE
					  		1=1
					  ".$where."
					  ORDER BY contactos_no_reg.id desc";
		//return $this->sql;			  
		$rs=$this->procesar_query($this->sql);
		return $rs; 			
	}
	/////////////////////////////////////////////////////////////////////////////////////
}
?>