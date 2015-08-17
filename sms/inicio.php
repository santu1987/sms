<?php
require('controladores/controlador.verifica_sesion.php');
?>
<!DOCTYPE html>
<!--SISTEMA DESARROLLADO PARA EL IPASME POR GIANNI SANTUCCI/DAVID BELTRAN- FECHA: 01/10/2014 -->

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="gsantucci">
    <!--librerias de JS -->
    <script type="text/javascript" src="js/fbasic.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.datetimepicker.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="js/funciones/inicio.js"></script>
    <script src="js/bootbox.min.js"></script>
    <!-- CSS de la Tecnologia Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- CSS DEL SISTEMA -->
    <link href="css/index.css" rel="stylesheet">
    <link href="css/jquery.datetimepicker.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link href="font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- -->
    <link rel="shortcut icon" href="./img/juventud.jpg" type="image/jpg" />
    <script type="text/javascript">
        $(document).ready(function(){
          //$("#cuerpo_programa").load("./vistas/vista.inicio_sesion.php");
        });
      //fin document.ready
    </script>
  </head>
  <body>
  <div id="cuerpo_nav" name="cuerpo_nav">
  </div>
  <!--<div class="barra_colores">
           <div style="background-color:#23ADEF;width:34%;height:5px;float:left;" ></div>
          <div style="background-color:#EC2B8A;width:32%;height:5px;float:left;" ></div>
          <div style="background-color:#F3702B;width:34%;height:5px;float:left;" ></div>
  </div>-->
  <div id="cuerpo_programa" name="cuerpo_programa">
          <div id="imagen_fondo">
              <img src="./img/logo_Juventud_Bicentenaria.png" class="logo_juventud">
          </div> 
  </div>
  <div id="pie_pagina" name="pie_pagina"></div>
    <!-- Modal para los mensajes-->
      <div class="modal fade" id="modal_mensaje" name="modal_mensaje" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" id="cerrar_mensaje" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <p id="cabecera_mensaje" name="cabecera_mensaje"></p>
              </div>
              <div class="modal-body" id="cuerpo_mensaje" name="cuerpo_mensaje">
               </div>
              <div class="modal-footer">
                <button type="button" id="aceptar_mensaje" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
             </div>
            </div>
          </div>
      </div>
      <!-- -->  
 
  </body>
</html>
<?php
require_once("modal_consultas_emergentes.html");//modal para consultas emergentes...
?>
