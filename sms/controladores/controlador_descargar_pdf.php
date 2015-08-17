<?php
    $f = $_GET["reporte_pdf"];
    $f="../vistas/".$f;
    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"$f\"\n");
    $fp=fopen("$f", "r");
    fpassthru($fp);
?>