<?php
require('script-imprimir.php');
include '../consultas.php';
include '../conexion.php';
$buscar_archivo=scandir("ver/",1);
$archivo_actual_entrada="ver/".$buscar_archivo[0];
$datos=ver_entrada($_GET['id'],$conexion);
$imprimir="";
foreach ($datos as $dato) {
	$imprimir=$imprimir.$dato['Contenido'];
}

$pdf=new PDF_HTML();
    $pdf->SetFont('Arial','',10);
    $pdf->AddPage();
    $pdf->WriteHTML("<h1>hola mundo</h1>".$imprimir);
    $pdf->Output();
exit;
?>