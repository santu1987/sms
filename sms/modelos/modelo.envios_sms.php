<?php
require_once("../controladores/conex.php");
class Mensaje_sms extends conex
{
	public $rs;
	public $sql;
	public $num_rows;
	//Metodo que realiza el envio del mensaje
	function enviar_sms($texto,$modem,$modem_vector,$cantidad_modem,$grupo,$opcion_grupo,$tlf)
	{
		////////////////////////////////////////////////////////////////////////////////////////////
		$this->sql="SELECT envio_sms('".$texto."','".$modem."','".$modem_vector."',".$cantidad_modem.",'".$grupo."',".$opcion_grupo.",'".$tlf."')";
		//return $this->sql;
		$this->rs=$this->procesar_query($this->sql);
		return $this->rs;
		////////////////////////////////////////////////////////////////////////////////////////////
	}
	//Metodo para subir el archivo sms masivos
	public function subir_archivo($archivo, $nombre)
	{
		$variable = "";
		if(move_uploaded_file($archivo,"../archivos_txt/".$nombre)){
			//chmod("../archivos_txt/".$nombre, 0777);
			$variable = 2;
		}else{
			$variable = -2;
		}
		return $variable;
	}
	//metodo para insertar contactos
	public function insertar_contactos($nombre, $id, $tel)
	{
		$sql = "SELECT 
		          contactos_masivos(
		          	                '".$nombre."',
		          	                ".$id.",
		          	                '".$tel."'
		          	               )";

        $resp = $this->procesar_query($sql);
        return $resp;
	}
	//metodo para insertar numeros y contactos no registrados en contactos
	public function insertar_no_registrados($nombre, $id, $tel){
		$query2 = "INSERT INTO contactos_no_reg(
										nombre,
										tlf1, 
										id_grupos)
									values
										('".$nombres."',
										 '".$telf."',
										  ".$id." 	
									    )";
		$this->procesar_query($query2);							    								    
	}
	//metodo para la insercion de numero y contactos con problemas en la informacion
	public function insertar_no_registrados2($nombres, $id, $telf, $detalle){
		 $query3 = "INSERT INTO contactos_no_reg(
												nombre,
												tlf1, 
												id_grupos,
												observacion
												)
											values
												('".$nombres."',
												 '".$telf."',
												  ".$id.",
												 '".$detalle."'  	
											    )";
		$this->procesar_query($query3);	
	}
	//Metodo para eliminar el grupo
	public function eliminar_tel_grupo($id_grupo){
		$sql = "DELETE 
		        FROM 
		            contactos_grupos 
		        WHERE id_grupo=".$id_grupo;
		$this->procesar_query($sql);
		return '1';        
	}
	//Metodo para consultar mensajes enviados en un pdf
	function consultar_mensajes_enviados($mensaje,$grupo,$fecha)
	{
		$mensaje='';
		$where='';
		//BLOQUE DE FILTROS
		if($mensaje!="")
		{
			$where="AND upper(a.texto) like '%".$mensaje."%'";
		}
		if($grupo!="")
		{
			$where="AND upper(grupos.nombre_grupo) like '%".strtoupper($grupo)."%'";
		}
		if($fecha!="")
		{
			$where="AND a.fecha ='".$fecha."'";
		}
		//
		$sql="SELECT 
							a.texto AS mensaje,
							upper(grupos.nombre_grupo) AS nombre_grupo,
							(SELECT COUNT(*)FROM sentitems where ".'sentitems."TPMR"'."<> -1 AND a.id=".'sentitems."CreatorID"'."::integer)AS enviados,
							(SELECT COUNT(*)FROM sentitems where ".'sentitems."TPMR"'."=-1 AND a.id= ".'sentitems."CreatorID"'."::integer)AS fallidos,
							to_char(a.fecha,'DD-MM-YYYY') AS fecha,
							a.tlf_individual					
					FROM
						enviados a
					left join
						grupos
					on
						grupos.id=a.id_grupo
								
					WHERE
						1=1
					".$where."	
					ORDER BY a.id  desc;";
		$rs=$this->procesar_query($sql);
		return $rs; 			
	}
	//Metodo para consultar cuantos sms han sido enviados....
	function cuantos_son_sms_env($where)
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
	//Metodo para consultar mensajes enviados por filtro para ser colocados en la tabla de consultas
	function consultar_cuerpo_env_sms($sms,$grupos,$fecha,$offset,$limit)
	{
		//seccion de filtros
		$where='';
		$where2='';
		if($sms!="")
		{
			$where="AND upper(a.texto) like '%".$sms."%'";
		}
		if($grupos!="")
		{
			$where="AND upper(grupos.nombre_grupo) like '%".strtoupper($grupos)."%'";
		}
		if($fecha!="")
		{
			$where="AND a.fecha ='".$fecha."'";
		}
		if(($offset!="")&&($limit!=""))	
		{
			$where2="limit '".$limit."' 
                    offset '".$offset."' ";
		}
		//
		$this->sql="SELECT 
							a.texto AS mensaje,
							upper(grupos.nombre_grupo) AS nombre_grupo,
							(SELECT COUNT(*)FROM sentitems where ".'sentitems."TPMR"'."<> -1 AND a.id=".'sentitems."CreatorID"'."::integer)AS enviados,
							(SELECT COUNT(*)FROM sentitems where ".'sentitems."TPMR"'."=-1 AND a.id= ".'sentitems."CreatorID"'."::integer)AS fallidos,
							to_char(a.fecha,'DD-MM-YYYY') AS fecha,
							a.tlf_individual					
					FROM
						enviados a
					left join
						grupos
					on
						grupos.id=a.id_grupo
								
					WHERE
						1=1
					".$where."	
					ORDER BY a.id  desc
					".$where2." 
					;";
		//return ($this->sql);
		$this->rs=$this->procesar_query($this->sql);
		//calculo cuantos son...
		$this->cuantos_son_sms_env($where);
		return 	$this->rs;			
	}
}
?>