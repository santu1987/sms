<script type="text/javascript" src="./js/funciones/iniciar_sesion.js"></script>
<div id="contenedor_is" name="contenedor_is">
<form name="form_inicio_sesion" id="form_inicio_sesion" class="form-horizontal" method="post" target="_self">
<fieldset>
	<legend>Inicio de sesi&oacute;n</legend>
</fieldset>	
	<div class="form-group">
		<div class="col-lg-12">
			<input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" onpaste="mensajes2('no puedes pegar');return false" onKeyPress="return valida(event,this,7,100)" onBlur="valida2(this,7,100)" placeholder="Nombre de usuario">
		</div>
	</div>
	<div class="form-group">
		<div class="col-lg-12">
			<input type="password" name="clave_usuario" id="clave_usuario" class="form-control" onpaste="mensajes2('no puedes pegar');return false" onKeyPress="return valida(event,this,2,10)" onBlur="valida2(this,2,10)" placeholder="Clave de usuario">
		</div>
	</div>
		<button type="button" id="ingresar_usuario" name="ingresar_usuario" class="btn btn-primary btn_is">Ingresar</button>
</form>
</div>