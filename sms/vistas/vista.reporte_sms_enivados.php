<script type="text/javascript" src="./js/funciones/reporte_filtros_sms.js"></script>
<div class="tabla_body">
	<div><legend><i class="fa fa-file-text"></i> Reporte sms enviados</legend></div>
	<form id="form_bandeja_entrada" name="form_bandeja_entrada" type="POST" target="_blank">
	<table class="table table-hover" width="100%">
		<div class="form-inline">
			<input type='text' name='f_mensajes' id='f_mensajes' placeholder='Filtro por mensajes' class='form-control input-sg input-filtros' onblur='consultar_cuerpo_tabla_sms_env(0,5,0);' onKeyPress="return valida(event,this,17,140)" onBlur="valida2(this,17,140)">
			<input type='text' name='f_grupo' id='f_grupo' placeholder='Filtro por grupos' class='form-control input-sg input-filtros' onblur='consultar_cuerpo_tabla_sms_env(0,5,0);' onKeyPress="return valida(event,this,17,50)" onBlur="valida2(this,17,50)">					<input type='text' name='f_fecha' id='f_fecha' placeholder='Filtro por fecha' class='form-control input-sg input-filtros' onblur='consultar_cuerpo_tabla_sms_env(0,5,0);' onKeyPress="return valida(event,this,13,11)" onBlur="valida2(this,13,11)">
			<a id="btn_ver_pdf" name="btn_ver_pdf" class="btn btn-danger btn-consultas" type="button" ><i class="fa fa-file-pdf-o"></i></a>
		</div>
		<thead id="cabecera_tabla" name="cabecera_tabla">
			<tr>
		    	<td id="#mensajes_td" width="25%"><label>Mensajes</label></td>
		    	<td class='campo_esp' width="25%"><label>Grupos</label></td>
		    	<td width="30%"><label>Enviados/Fallidos</label></td>
		    	<td class='campo_esp' width="30%"><label>Fecha</label></td>
		    </tr>
		</thead>
		<tbody id="cuerpo_tabla_sms_env" name="cuerpo_tabla_sms_env">
			<!-- -->
		</tbody>
	</table>
	<div id="paginacion_consulta">        
	  	<ul id="paginacion_tabla_sms" class="pagination"></ul>
	</div>
</div>
</div>