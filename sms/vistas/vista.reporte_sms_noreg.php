<script type="text/javascript" src="./js/funciones/reporte_filtros_sms_noreg.js"></script>
<div class="tabla_body">
	<div><legend><i class="fa fa-file-text"></i> Reporte destinatarios no registrados</legend></div>
	<form id="form_bandeja_noreg" name="form_bandeja_noreg" type="POST">
	<table class="table table-hover" width="100%">
		<div class="form-group">
			<div class="form-inline col-lg-6">
				<input type='text'  name='f_nombres' id='f_nombres' placeholder='Filtro por nombres' class='form-control input-sg input-filtros' onblur='consultar_cuerpo_tabla_sms_noreg(0,5,0);' onKeyPress="return valida(event,this,17,100)" onBlur="valida2(this,13,11)">
				<input type='text' name='f_tlf' id='f_tlf' placeholder='Filtro por tel&eacute;fono' class='form-control input-sg input-filtros campo_esp' onblur='consultar_cuerpo_tabla_sms_noreg(0,5,0);' onKeyPress="return valida(event,this,13,140)" onBlur="valida2(this,13,140)">
				<input type='text'  name='f_grupo_n' id='f_grupo_n' placeholder='Filtro por grupos' class='form-control input-sg input-filtros ' onblur='consultar_cuerpo_tabla_sms_noreg(0,5,0);' onKeyPress="return valida(event,this,17,50)" onBlur="valida2(this,17,50)">
				<a id="btn_ver_pdf_noreg" name="btn_ver_pdf_noreg" class="btn btn-danger btn-consultas" type="button" ><i class="fa fa-file-pdf-o"></i></a>
			</div>
			<div class="col-lg-6">
				<div type='text' id='cantidad_no_registrados_n' name='cantidad_no_registrados_n'>xxx</div>
			</div>
		</div>	
		<thead id="cabecera_tabla" name="cabecera_tabla">
		    <tr>
		    	<td class='nom_no_reg' width="30%"><label>Nombres</label></td>
		    	<td width="25%"><label>Tel&eacute;fono</label></td>
		    	<td class='campo_esp' width="25%"><label>Grupos</label></td>
		    	<td class='campo_esp' width="30%"><label>Condici&oacute;n</label></td>
		    </tr>
		</thead>
		<tbody id="cuerpo_tabla_sms_noreg" name="cuerpo_tabla_sms_env">
			<!-- -->
		</tbody>
	</table>
	<div id="paginacion_consulta">        
	  	<ul id="paginacion_tabla_sms_noreg" class="pagination"></ul>
	</div>
</div>
</div>