<?php
session_start();
if(isset($_SESSION["sms"]))
{
  echo "<script type='text/javascript'>alert(".$_SESSION["sms"].")</script>";
  if ($_SESSION["sms"] == "SI")
  {
    echo "<script>location.href='http://".$_SERVER['HTTP_HOST']."/sms/inicio.php';</script>";
    exit(); 
  }
}
if (isset($_GET["cerrar"])){ $cerrar = base64_decode($_GET["cerrar"]); } else{ $cerrar = ""; }

?>
