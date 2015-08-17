<script type="text/javascript" src="./js/funciones/bandeja_entrada.js"></script>
<div class="tabla_body">
	<div><legend><i class="fa fa-envelope"></i> Bandeja de entrada</legend></div>
	<form id="form_bandeja_entrada" name="form_bandeja_entrada" type="POST">
	<table class="table table-hover" width="100%">
		<div class="form-inline">
			<input type='text' name='f_nom_be' id='f_nom_be' placeholder='Filtro por nombres' class='form-control input-sg input-filtros' onblur='consultar_cuerpo_tabla_be(0,5,0);' onKeyPress="return valida(event,this,17,140)" onBlur="valida2(this,17,140)">
			<input type='text' name='f_num_be' id='f_num_be' placeholder='Filtro por n&uacute;mero de tlf' class='form-control input-sg input-filtros' onblur='consultar_cuerpo_tabla_be(0,5,0);' onKeyPress="return valida(event,this,13,11)" onBlur="valida2(this,13,11)">
			<button  id="btn_recargar_bj" name="btn_recargar_bj" title="Actualizar Bandeja de entrada" type="button" class="btn btn-warning btn-consultas"><i class="fa fa-refresh"></i></button>
			<button  id="btn_eliminar_masivos" name="btn_eliminar_masivos" title="Eliminar sms en p&aacute;gina" type="button" class="btn btn-warning btn-consultas"><i class="fa fa-trash"></i></button>
		</div>
		<thead id="cabecera_tabla" name="cabecera_tabla">
			
			<tr>
		    	<td class="campo_esp" width="25%"><label>Nombres</label></td>
		    	<td width="25%"><label>Tel&eacute;fono</label></td>
		    	<td width="30%"><label>Mensaje</label></td>
		    	<td width="5%"><label><button name="btn_seleccionar_check" id="btn_seleccionar_check" title="Seleccionar mensajes de la p&aacute;gina" class="btn btn-primary" type="button"><i class='fa fa-check'></i></button></label></td>
		    	<td width="15%" style="text-align:center;"><label>Operaciones</label></td>
		    </tr>
		</thead>
		<tbody id="cuerpo_tabla" name="cuerpo_tabla">
			<!-- -->
		</tbody>
	</table>
	<div id="paginacion_consulta">        
      	<ul id="paginacion_tabla" class="pagination"></ul>
    </div>
</div>
</div>