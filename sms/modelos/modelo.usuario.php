<?php
require_once("../controladores/conex.php");
class Usuario extends conex
{
	public $rs=array();
	private $salida_gammu;
	public $num_rows;
	//Metodo para activar el servicio de mensajeria...
	function activar_gammu()
	{
		$this->salida_gammu=shell_exec('sudo /etc/init.d/arranque_sms start');
	}
	//Metodo inciar session
	function iniciar_session($login,$clave)
	{
		$this->clave=$clave;
		$this->login=strtoupper($login);
		$this->rs=$this->procesar_query("SELECT * FROM usuarios WHERE upper(nombre_us)='".$login."' and clave='".md5($clave)."';");
		////////////////////////////////////
		if(isset($this->rs[0][0]))
		{
			if($this->rs=='')
			{
				return "clave_invalida";
			}else
			if($this->rs!='error')
			{
				$_SESSION["id"]=$this->rs[0][0];//es el id_persona...
				$_SESSION["nombre_us"]=$this->rs[0][1];
				$_SESSION["sms"]="SI";
				$_SESSION['nivel']=$this->rs[0][3];
				//aqui activo gammu desde php
				//$this->activar_gammu();
				return $this->salida_gammu;
			}
			else
			if($this->rs=='error')
			{
				return "error";
			}
		}else
		{
				return "clave_invalida";
		}
	}
	//Metodo para el llenado del combo de nivel
	public function llenar_combo_nivel(){
		$sql="SELECT
		            * 
		       FROM
		           nivel";
		$resp = $this->procesar_query($sql);
		return $resp;           
	}
	//Metodo para ingresar el usuario
	public function ingresar_usuario($nombre, $cedula, $clave, $nivel, $estatus, $id_usuario){
		$sql = "SELECT 
		              ingresar_usuario('".$nombre."','".$clave."',".$cedula." ,".$nivel.",".$estatus.", ".$id_usuario.")";
		$resp = $this->procesar_query($sql);
		return $resp;              
	}
	//metodo patra determinar cuantos destintarios existen..
	function cuantos_son($where)
	{
		//calculo cuantos son..
        $this->sql="SELECT count(*) FROM usuarios WHERE 1=1 ".$where.";";
        $rs2=$this->procesar_query($this->sql);
        $this->num_rows=$rs2[0][0];
        ////////////////////////////////////////////
	}
	//metodo el cuerpo de modal consultas destinatarios
	function consultar_cuerpo_consulta_usuarios($f_nom,$f_ced,$offset,$limit)
	{
		$where='';
		if($f_nom!="")
		{
			$where.=" AND upper(nombre_us) like '%".$f_nom."%'";
		}
		if($f_ced!="")
		{
			$where.=" AND upper(cedula) like '%".$f_ced."%'";
		}	
		if(($offset!="")&&($limit!=""))	
		{
			$where2="limit '".$limit."' 
                    offset '".$offset."' ";
		}
		$this->sql="SELECT 
		                     id, cedula, nombre_us, estatus, nivel_id
					FROM
							usuarios
					WHERE
							1=1
					".$where." 
					".$where2."
					";
		$this->rs=$this->procesar_query($this->sql);
		//calculo cuantos son...
		$this->cuantos_son($where);
		return $this->rs;		
	}
	//Metodo para buscar usuario
	public function buscar_usuario($id){
		$sql = "SELECT 
		              id, 
		              nombre_us, 
		              nivel_id, 
		              cedula
		        FROM 
		            usuarios 
		        WHERE 
		             id = ".$id;
		$resp = $this->procesar_query($sql);
		return $resp;             
	}
	//Metodo para cambiar el estatus del usuario
	public function cambio_estatus($id)
	{
		$sql=" SELECT 
		            activar_desactivar_us(".$id.")";
		$resp = $this->procesar_query($sql);
		return $resp;            
	}
	//Metodo para cerrar la sesion del sistema
	public function cerrar_session()
	{
		session_start();
        session_unset();
        session_destroy();
        $cs = base64_encode('1');
        $envio = "http://" . $_SERVER['HTTP_HOST']."/sms/index.php?cerrar=".$cs; 
        return $envio;
	}
}
?>
