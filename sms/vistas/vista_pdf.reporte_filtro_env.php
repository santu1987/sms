<?php
session_start();
require("../modelos/modelo.envios_sms.php");
require("../modelos/modelo.pdf_sms_enviados.php");
require("../modelos/modelo.registrar_auditoria.php"); 
header('Content-type: application/pdf');
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment");
header('Content-Type: text/html; charset=iso-8859-1');
// valido lo que pasa por $_GET
$fhasta='';$fdesde='';$grupo='';$mensaje='';$estatus='';$f_fecha='';
//mensaje
if(isset($_GET["f_mensajes"])) {if($_GET["f_mensajes"]!=""){$mensaje=$_GET["f_mensajes"];}}
//grupo
if(isset($_GET["f_grupo"])) {if($_GET["f_grupo"]!=""){$grupo=$_GET["f_grupo"];}}
//fecha
if(isset($_GET["f_fecha"])) {if($_GET["f_fecha"]!=""){$f_fecha=$_GET["f_fecha"];}}
/////
/////////////////////////////////////////////////--AUDITORIA--///////////////////////////////////////
    $auditoria_eva=new auditoria("Reporte sms enviados","Generó reporte de sms enviados");
    $auditoria=$auditoria_eva->registrar_auditoria();
    //die(json_encode($auditoria));
    if($auditoria==false)
    {
        $mensaje[0]='error_auditoria';die(json_encode($mensaje));

    }
	/////////////////////////////////////////////////////////////////////////////////////////////////////
/////
//CREO OBJETO PARA LA CONSULTA
$obj_sms=new Mensaje_sms();	
$rs=$obj_sms->consultar_mensajes_enviados($mensaje,$grupo,$f_fecha);
//CREO OBJETO PARA EL PDF
$pdf=new pdf_sms_enviados();
$pdf->Header();
$pdf->AliasNbPages();
$pdf->AddPage('L','Letter');
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(159,182,205);
$pdf->SetMargins(10, 5 , 10);
/////////////////////////////////////////
//
for($i=0;$i<=count($rs)-1;$i++)
{
	if($rs[$i][1]!="")
	{
		$nombre_grupo=$rs[$i][1];
	}
	else
	{
		$nombre_grupo=$rs[$i][5];
	}	
	$pdf->Cell(100,5,utf8_decode(substr($rs[$i][0],0,40))."...",1,0,'L',0);
	$pdf->Cell(70,5,utf8_decode(substr($nombre_grupo,0,40)),1,0,'C',0);
	$pdf->Cell(30,5,$rs[$i][2],1,0,'C',0);
	$pdf->Cell(30,5,$rs[$i][3],1,0,'C',0);
	$pdf->Cell(30,5,$rs[$i][4],1,0,'C',0);
	$pdf->ln();
}	
////////////////////////////////////////
$pdf->Output('reporte_sms_ev.pdf','D');     
?>