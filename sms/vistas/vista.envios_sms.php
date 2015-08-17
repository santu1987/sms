<script type="text/javascript" src="./js/funciones/envios_sms.js"></script>
<div class="contenedor_mensajes">
<form name="form_envio_mensajes" id="form_envio_mensajes" class="form-horizontal" method="post" target="_self">
	<div class="panel panel-deafult">
		<div class="panel-heading"><h3>Mensaje de Texto</h3></div>
		<div class="panel-body">
			<div class="form-group">
				<div class="col-lg-12">
					<textarea id="enviar_texto_sms" name="enviar_texto_sms" class="form-control" rows="4" placeholder="Ingrese en el recuadro su mensaje de texto (140 caracteres)" onKeyPress="return valida(event,this,18,140);" onBlur="valida2(this,18,140);"></textarea>
				</div>
			</div>
			<div class="form-group">	
				<div class="col-lg-12">
					<select name="enviar_texto_modem" id="enviar_texto_modem" class="form-control">
						<option id="-1" value="-1">[Modem]</option>
					</select>
				</div>
				<div id="enviar_frame_modem" name="enviar_frame_modem"></div>
			</div>		
			<div id="enviar_grupo_dest" name="enviar_grupo_dest">
				<br>
				<div><b>Enviar a:</b></div>	
				<div class="col-lg-4"><input type="radio" name="enviar_radio" id="enviar_radio_grupo" checked value="1"> Grupo</div>
				<div class="col-lg-6"><input type="radio" name="enviar_radio" id="enviar_radio_individual" value="2"> Individual</div>
				<div id="enviar_frame_grupos" name="enviar_frame_grupos"></div>
			</div>	
		<button type="button" name="bnt_enviar_sms" id="btn_enviar_sms" class="btn btn-primary btn_is">Enviar</button>
		<button type="button" id="btn_limpiar_enviar_sms" name="btn_limpiar_enviar_sms" class="btn btn-danger btn_is">Limpiar</button>
	</div>
</form>
</div>
