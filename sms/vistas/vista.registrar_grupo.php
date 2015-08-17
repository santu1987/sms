<!--Vista desarrollada por David beltrán-->
<script type="text/javascript" src="./js/funciones/registrar_grupo.js"></script>
<div id="contenedor_is" name="contenedor_is">
<form name="form_inicio_sesion" id="form_inicio_sesion" class="form-horizontal" method="post" target="_self">
<fieldset>
	<legend><h3>Ingresar Grupo</h3></legend>
</fieldset>	
	<div class="form-group">	
		<div class="col-lg-10">
			<input type="text" id="grupo" name="grupo" class="form-control" onpaste="mensajes2('no puedes pegar');return false" onKeyPress="return valida(event,this,7,100)" onBlur="valida2(this,7,100)" placeholder="Nombre del grupo" style="width:100%;">
		</div>
		<div class="col-lg-2">
			<button  id="btn_consultar" name="btn_consultar" title="Consultar Destinatario" type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal_consulta" style="width:100%;"><span class="glyphicon glyphicon-search"></span></button>
		</div>
	</div>
	<div class="form-group">	
		<div class="col-lg-12">
           <textarea id="id_descripcion" name="id_descripcion" class="form-control" rows="4" placeholder="Ingrese una breve descripci&oacute;n referente al grupo (200 caracteres)" onkeypress="return valida(event,this,17,140);" onblur="valida2(this,17,140);"></textarea>	
		</div>
	</div>
	<div class="form-group">	
		<div class="col-lg-6">	
           <button type="button" name="bnt_guardar_grupo" id="bnt_guardar_grupo" class="btn btn-primary" style="width:100%;">Guardar</button>
        </div>
         <div class="col-lg-6"> 
           <button type="button" name="bnt_limpiar" id="bnt_limpiar" class="btn btn-danger" style="width:100%;">Limpiar</button>
    	 </div>
	</div>	
    <input type="hidden" id="id_grupo" name="id_grupo" class="form-control">
</form>
</div>
