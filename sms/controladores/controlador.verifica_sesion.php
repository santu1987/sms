<?php
 session_start();
 if(isset($_SESSION["sms"])){

    if($_SESSION["sms"] != "SI"){
        session_unset();
        session_destroy();	
        echo "<script>
                    location.href='http://".$_SERVER['HTTP_HOST']."/sms/';
             </script>";
        exit();
    }
    
 }else{
     echo "<script>
                   location.href = 'http://".$_SERVER['HTTP_HOST']."/sms/';
           </script>";
 }
 
 if (isset($_GET["cerrar"])){ $cerrar = base64_decode($_GET["cerrar"]);} else { $cerrar = ""; }
?> 