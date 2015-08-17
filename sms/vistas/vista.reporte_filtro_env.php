<script type="text/javascript" src="./js/funciones/reporte_filtros_sms.js"></script>
<div id="contenedor_inicial" name="contenedor_inicial" class="contenedor_forms">
	<form id="form_reporte_filtro_sms" name="form_reporte_filtro_sms" class="form-horizontal" method="POST" target="_self>
		<fieldset>
			<legend>
				<h3>Reporte de mensajes enviados</h3>
			</legend>
		</fieldset>
		<div id="principal_div" name="principal_div">
			<div class="form-group">
				<div class="col-lg-12">
					<select name="reporte_sms_mensaje" id="reporte_sms_mensaje" class="form-control" style="margin-top: 2%;">
						<option id="-1" value="-1" >[Mensajes]</option>
					</select>
				</div>
			</div>	
			<div class="form-group">
				<div class="col-lg-12">
					<select name="reporte_sms_grupo" id="reporte_sms_grupo" class="form-control" style="margin-top: 2%;">
						<option id="-1" value="-1" >[Grupo]</option>
					</select>
				</div>
			</div>
			<div class="form-group">	
				<div class="col-lg-12">
					<select name="reporte_sms_estatus" id="reporte_sms_estatus" class="form-control" style="margin-top: 2%;">
						<option id="-1" value="-1" >[Estatus]</option>
						<option id="0" valuie="0">Envios satisfactorios</option>
						<option id="1" valuie="1">Fallidos</option>
					</select>
				</div>
			</div>
			<div class="form-group">	
				<div class="col-lg-12">
					<input type="text" placeholder="Fecha desde" id="reporte_sms_fecha_desde" name="reporte_sms_fecha_desde" onkeyup="this.value=formateafecha(this.value);" placeholder="dd/mm/aaaa" class="form-control">
				</div>
			</div>
			<div class="form-group">	
				<div class="col-lg-12">
					<input type="text" placeholder="Fecha Hasta" id="reporte_sms_fecha_hasta" name="reporte_sms_fecha_hasta" onkeyup="this.value=formateafecha(this.value);" placeholder="dd/mm/aaaa" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-12">
					<button type="submit"  class="btn btn-primary btn btn-primary btn_is" id="btn_rep_sms" name="btn_rep_sms">Ver pdf</button>
				</div>
			</div>	
		</div>	
		<div class="form-group" id="div_pdf" name="div_pdf">
		</div>	
	</form>
</div>