<script type="text/javascript" src="./js/funciones/bandeja_salida.js"></script>
<div class="tabla_body">
	<div><legend><i class="fa fa-envelope-o"></i> Bandeja de Salida</legend></div>
	<table class="table table-hover" width="100%">
		<input type='text' name='f_texto_sms' id='f_texto_sms' style="width:60%" placeholder='Filtro por Texto del mensaje' class='form-control input-sg input-filtros' onblur='consultar_cuerpo_tabla_bs(0,5,0);' onKeyPress="return valida(event,this,4,50)" onBlur="valida2(this,4,50)">
		<thead id="cabecera_tabla_bs" name="cabecera_tabla">
		    <tr>
		    	<td width="50%"><label>Ultimos sms</label></td>
		    	<td width="20%"><label>Enviados/Cargados</label></td>
		    	<td class="campo_esp" width="15%"><label>Grupos</label></td>
		    	<td class="campo_esp" widht="15%"><label>Fecha Enviado</label></td>
		    </tr>
		</thead>
		<tbody id="cuerpo_tabla_bs" name="cuerpo_tabla">
			<!-- -->
		</tbody>
	</table>
	<div id="paginacion_consulta">        
      	<ul id="paginacion_tabla_bs" class="pagination"></ul>
    </div>
</div>
