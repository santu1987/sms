<script type="text/javascript" src="./js/funciones/carga_sms_masiva.js"></script>
<div class="contenedor_forms">
<form name="form_carga_individual" id="form_carga_masiva" class="form-horizontal" method="post" target="_self">
<fieldset>
	<legend><h3>Carga Masiva de SMS</h3></legend>
</fieldset>	
	<div id="cuerpo" name="cuerpo">
		<div class="form-group div_ind_dest">
		  <div class="col-lg-4">
			<div style="float:left">
				<label>Ingrese el archivo: </label>
			</div>
		  </div>
		  <div class="col-lg-8">
		    <div style="float:left">
				<input type="file" id='archivo' name="archivo" class="btn btn-primary btn_is" style="width:100%;"/>
			    <span class="help-block"><i class="fa fa-exclamation"></i>Informaci&oacute;n: El archivo a subir debe ser formato csv, este debe contener dos columnas donde indique el nombre y el numero telefonico "En ese orden". Indicar que el separador de columnas debe ser ";"</span>
			</div>	
		  </div>		
		</div>
	</div>
	<div class="form-group">
		<div class="col-lg-12">
			<select name="carga_ind_grupo" id="carga_ind_grupo" class="form-control">
				<option id="-1" value="-1" >[Grupo]</option>
			</select>
		</div>
	</div>
	<div class="form-group" id="contenedor_grupos" name="contenedor_grupos">
	</div>
	<div class="form-group">
	 <div class="col-lg-6">	
		<button type="button" id="btn_carga_ind_reg" name="btn_carga_ind_reg" class="btn btn-primary" style="width:100%;">Guardar</button>
    </div>
    <div class="col-lg-6">
       <button type="button" id="btn_borrar_cont" name="btn_carga_ind_reg" class="btn btn-danger" style="width:100%;">Borrar Contactos</button>
    </div> 
</form>
</div>