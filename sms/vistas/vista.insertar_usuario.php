<?php
session_start();
$tipo_us=$_SESSION['nivel']
?>
<!--VISTA DESARROLLADA POR DAVID BELTRÁN-->
<script type="text/javascript" src="./js/funciones/usuarios.js"></script>
<script type="text/javascript">
//BLOQUE DE EVENTOS DE VALIDACION
validar_tipo_us();
//BLOQUE DE FUNCIONES DE VALIDACIONES
function validar_tipo_us()
{
	var tipo_us="<?php echo $tipo_us;?>";
	if(tipo_us=='2')
	{
		$("#btn_consultar,#carga_nivel").hide();
	}	
}
</script>
<div id="contenedor_is" name="contenedor_is">
<form name="form_inicio_sesion" id="form_inicio_sesion" class="form-horizontal" method="post" target="_self">
<fieldset>
	<legend><h3>Ingresar Usuarios</h3></legend>
</fieldset>	
	<div class="form-group">
		<div class="col-lg-10">
			<input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" onpaste="mensajes2('no puedes pegar');return false" onKeyPress="return valida(event,this,16,30)" onBlur="valida2(this,16,30)" placeholder="Nombre de usuario" style="width:100%;">
		</div>
		<div class="col-lg-2">
			<button  id="btn_consultar" name="btn_consultar" title="Consultar Usuarios" type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal_consulta" style="width:100%;"><span class="glyphicon glyphicon-search" style="width:50%;"></span></button>
		</div>
	</div>	
	<div class="form-group">
		<div class="col-lg-12">
			<input type="text" name="id_cedula" id="id_cedula" class="form-control" onpaste="mensajes2('no puedes pegar');return false" onKeyPress="return valida(event,this,10,8)" onBlur="valida2(this,10,8)" placeholder="Cedula">
		</div>
	</div>
	<div class="form-group">
		<div class="col-lg-12">
			<input type="password" name="clave_usuario1" id="clave_usuario1" class="form-control" onpaste="mensajes2('no puedes pegar'); return false" onKeyPress="return valida(event,this,2,10)" onBlur="valida2(this,2,10)" placeholder="Clave de usuario">
		</div>
	</div>
	<div class="form-group">
		<div class="col-lg-12">
			<input type="password" name="clave_usuario2" id="clave_usuario2" class="form-control" onpaste="mensajes2('no puedes pegar');return false" onKeyPress="return valida(event,this,2,10)" onBlur="valida2(this,2,10)" placeholder="Repita Clave de usuario">
		</div>
	</div>
	<div class="form-group">
		<div class="col-lg-12">
			<select name="carga_nivel" id="carga_nivel" class="form-control">
				<option id="0" value="0" >[Tipo de usuario]</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-lg-6">
			<button type="button" id="regitrar_usuario" name="regitrar_usuario" class="btn btn-primary" style="width:100%;">Registrar</button>
		</div>
		<div class="col-lg-6">
		<button type="button" id="limpiar" name="limpiar" class="btn btn-danger" style="width:100%;">Limpiar</button>
		</div>
	</div>	
    <input type="hidden" value="" id="id_usuario"/>
</form>
</div>
