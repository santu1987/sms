<?php 
  require('../controladores/controlador.verifica_sesion.php');
?>
<script type="text/javascript" src="./js/funciones/menu.js"></script>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="navbar-header">
      <!-- -->
      <button id='btn_navegacion' type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
      </button>
      <!-- -->
    <a id="btn_sms_inicio" title="Sistema de Mensajeria IPASME" class="navbar-brand" href="#"><i  class = "fa fa-comments-o" ></i> SMS</a>
  </div>
  <!-- cabecera -->
  <div id="navbarCollapse" class="collapse navbar-collapse navbar-ex1-collapse">
    <!--Modulo de usuarios-->
      <ul class="nav navbar-nav">
          <li class="dropdown">
             <a href="#" class="dropdown-toggle"  data-toggle="dropdown">Registros<b class="caret"></b></a>
               <ul class="dropdown-menu">
                <?php if($_SESSION['nivel'] != 2){
                   echo "<li><a id='registro_usuario' class='activar_menu' name='registro_usuario' href='#'>Registrar Usuario</a></li>";
                 } ?>  
                  <li><a id="registro_grupo" class='activar_menu' name="registro_grupo" href="#">Registrar de Grupo</a></li>
              </ul>   
          </li>  
        </ul> 
    <!--fin--> 
    <!-- modulo de cargas --> 
      <ul class="nav navbar-nav">
        <li class="dropdown">
           <a href="#" class="dropdown-toggle"  data-toggle="dropdown">
            Carga de destinatarios<b class="caret"></b></a>
             <ul class="dropdown-menu">
                <li><a id="carga_inidividual" class='activar_menu' name="carga_individual" href="#">Carga individual</a></li>
                <li><a id="carga_masiva" class='activar_menu' name="carga_masiva" href="#">Carga Masiva</a></li>
            </ul>   
        </li>  
      </ul> 
    <!-- --> 
    <!-- modulo de envios -->
      <ul class="nav navbar-nav">
        <li class="dropdown">
            <a id="envio_sms" name="envio_sms" href="#" class="dropdown-toggle activar_menu" data-toggle="dropdown">
              Env&iacute;o de mensajes</a>
        </li>
      </ul>  
    <!-- -->
    <!-- modulo de monitoreo -->
      <ul class="nav navbar-nav">
        <li class="dropdown">
            <a id="envio_sms" name="envio_sms" href="#" class="dropdown-toggle"  data-toggle="dropdown">
            Monitoreo<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a id="mon_bandeja_entrada" name="mon_bandeja_entrada" class='activar_menu' href="#">Bandeja de entrada</a></li>
              <li><a id="mon_bandeja_salida" name="mon_bandeja_salida" class='activar_menu' href="#">Bandeja de salida</a></li>
            </ul>  
        </li>
      </ul>  
    <!-- --> 
    <!-- Modulo de reportes -->
    <ul class="nav navbar-nav">
      <li class="dropdown">
        <a id="reporte_sms_enviados" name="reporte_sms_enviados" href="#" class="dropdown-toggle" data-toggle="dropdown">
        Reportes<b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a id="rep_sms_env" name="rep_sms_env" class='activar_menu' href="#">Sms Enviados</a></li>
          <li><a id="rep_dest_noreg" name="rep_dest_noreg" class='activar_menu' href="#">Contactos no registrados</a></li>
        </ul>  
      </li>  
    </ul>  
    <!-- --> 
    <!-- Nombre usuario -->
    <ul class="nav navbar-nav">    
        <li class="dropdown">  
            <a  id="nombre_us2" name="nombre_us2"  data-toggle="popover" style="cursor:pointer;" href="#"><?php echo "@".substr($_SESSION["nombre_us"],0,20); ?></a>
        </li>
    </ul>
    <!-- -->
    <!-- Engrane-->
    <ul class="nav navbar-nav">
        <li class="dropdown">
           <!-- <a href="#"><i id="op_menu" name="op_menu" class="fa fa-cog fa-2x img_menu"></i></a>-->
        </li>
    </ul>
    <!-- -->
    <!-- ayuda-->
    <ul class="nav navbar-nav">
        <li class="dropdown">
           <a href="#" title="ayuda" id="ayuda_sms" class='activar_menu'><i class="fa fa-question-circle"></i>Ayuda</a>
        </li>
    </ul>
    <!-- -->
  </div>
      <div style="background-color:#23ADEF;width:25%;height:5px;float:left" id=""></div>
      <div style="background-color:#EC2B8A;width:25%;height:5px;float:left" id=""></div>
      <div style="background-color:#F3702B;width:25%;height:5px;float:left" id=""></div>
      <div style="background-color:#ABCF38;width:25%;height:5px;float:left" id=""></div>
  <!-- -->
</nav> 
<!-- div que contiene los elementos del pop over-->
<div id="div_us_pop" class="hide">
   <div id="cuerpo_op">
       <button id="btn-actualizar" onclick="buscar_datos('<?php echo $_SESSION['id']?>');" class="btn btn-primary" title="ir perfil"><span class="glyphicon glyphicon-user"></span></button>
       <button id="cerrar_session" onclick="cerrar_session()" name="cerrar_session" class="btn btn-danger activar_menu" data-dismiss="clickover" title="Cerrar Sesi&oacute;n"><span class="glyphicon glyphicon-off"></span></button>
   </div>
</div>    
