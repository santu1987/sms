<?php
session_start();
ini_set("memory_limit","1024M");
require("../modelos/modelo.destinatarios.php");
require("../modelos/modelo.pdf_sms_noreg.php");
require("../modelos/modelo.registrar_auditoria.php"); 
header('Content-type: application/pdf');
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment");
header('Content-Type: text/html; charset=iso-8859-1');
// valido lo que pasa por $_GET
//lleno las variables filtro...
if(isset($_GET["f_tlf"])){$tlf=$_GET["f_tlf"];}
if(isset($_GET["f_grupo_n"])){$grupos=strtoupper($_GET["f_grupo_n"]);}
if(isset($_GET["f_nombres"])){$nombres=strtoupper($_GET["f_nombres"]);}
/////
/////////////////////////////////////////////////--AUDITORIA--///////////////////////////////////////
    $auditoria_eva=new auditoria("Reporte sms no registrados","Generó reporte de no registrados");
    $auditoria=$auditoria_eva->registrar_auditoria();
    //die(json_encode($auditoria));
    if($auditoria==false)
    {
        $mensaje[0]='error_auditoria';die(json_encode($mensaje));
    }
	/////////////////////////////////////////////////////////////////////////////////////////////////////
/////
//CREO OBJETO PARA LA CONSULTA
$obj_sms=new Destinatarios();	
$rs=$obj_sms->consultar_sms_noreg($tlf,$grupos,$nombres);
//CREO OBJETO PARA EL PDF
$pdf=new pdf_sms_noreg();
$pdf->Header();
$pdf->AliasNbPages();
$pdf->AddPage('L','Letter');
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(159,182,205);
$pdf->SetMargins(10, 5 , 10);
/////////////////////////////////////////
//
$contador=0;
for($i=0;$i<=count($rs)-1;$i++)
{
	set_time_limit(0);
	$pdf->Cell(35,5,$rs[$i][0],1,0,'L',0);
	$pdf->Cell(70,5,utf8_decode(substr($rs[$i][1],0,23)),1,0,'L',0);
	$pdf->Cell(60,5,utf8_decode(substr($rs[$i][2],0,50)),1,0,'L',0);
	$pdf->Cell(90,5,$rs[$i][3],1,0,'L',0);
	$pdf->ln();
	$contador++;
}
$pdf->ln(5);
$pdf->Cell(90,5,"Total destinatarios no registrados: ".$contador,0,0,'L',0);
////////////////////////////////////////
$pdf->Output('reporte_sms_noreg.pdf','D');     
?>