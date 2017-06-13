<?php
require('script-imprimir.php');
include '../consultas.php';
include '../conexion.php';
$buscar_archivo=scandir("ver/",1);
$archivo_actual_entrada="ver/".$buscar_archivo[0];
$datos=ver_entrada($_GET['id'],$conexion);
$imprimir="";
$titulo="";
$imagen="../Img_Entradas/";
foreach ($datos as $dato) {
	$imprimir=$imprimir.$dato['Contenido'];
	$imagen=$imagen.$dato['ImagenEntrada'];
	$titulo=$dato['Titulo'];
}

$pdf=new PDF_HTML();
$pdf->AddPage();
if ($imagen!="") {
	$pdf->Image($imagen,50,20,-300);
	$pdf->SetXY(2, 100);
}
$pdf->SetFont('Arial','B',18);
$pdf->Cell(80);
$pdf->Cell(30,10,$titulo,0,0,'C');
$pdf->Ln(20);
$pdf->SetFont('Arial','',12);
$pdf->WriteHTML(utf8_decode($imprimir));
$pdf->Output();
?>