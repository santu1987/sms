<script type="text/javascript" src="./js/funciones/carga_individual.js"></script>
<div class="contenedor_forms">
<form name="form_carga_individual" id="form_carga_individual" class="form-horizontal" method="post" target="_self">
<fieldset>
	<legend>
		<h3>Carga Individual de Destinatarios</h3>
	</legend>
</fieldset>
	<div id="cuerpo_destinatarios" name="cuerpo_destinatarios">
		<!-- -->
	</div>
	<div class="form-group">
		<div class="col-lg-8">
			<input type="hidden" class="form-control" >
		</div>
		<div class="col-lg-2">	
			<button  id="btn_cons_ind" name="btn_cons_ind" title="Consultar Destinatario" type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal_consulta"><span class="glyphicon glyphicon-search"></span></button>
		</div>
		<div class="col-lg-2">	
			<a  href="#div_btn" id="btn_ag_ind" name="btn_ag_ind" title="Agregar Destinatario" type="button" class="btn btn-primary" ><span class="glyphicon glyphicon-plus"></span></a>
		</div>
	</div>	
	<div class="form-group" id="div_btn">
		<div class="col-lg-12">
			<select name="carga_ind_grupo" id="carga_ind_grupo" class="form-control" style="margin-top: 2%;">
				<option id="-1" value="-1" >[Grupo]</option>
			</select>
		</div>
	</div>
	<div class="form-group" id="contenedor_grupos" name="contenedor_grupos">
	</div>
	<div class="form-group">	
		<div class="col-lg-6">	
			<button type="button" id="btn_carga_ind_reg" name="btn_carga_ind_reg" class="btn btn-primary btn_is">Registrar</button>
		</div>
		<div class="col-lg-6">
			<button type="button" id="btn_limpiar_ind_reg" name="btn_limpiar_ind_reg" class="btn btn-danger btn_is">Limpiar</button>
		</div>
	<div class="form-group">	
</form>
</div>