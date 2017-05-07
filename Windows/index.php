<?php session_start(); include '../conexion.php'; ?>
<?php include ('../cabeza.php'); ?>
<div id="entrada">
<?php 
	include '../consultas.php';
	$entradas=mostrar_entradas("Windows",$conexion);
	foreach ($entradas as $dato) {
?>
	<a href="http://tutoinformatico.000webhostapp.com/enviar_entrada.php?<?php echo "titulo=".$dato['Titulo']."&id=".$dato['IdEntrada']; ?>">
		<div id='enviar_entrada'>
			<img class='imgentrada' src='http://tutoinformatico.000webhostapp.com/Img_Entradas/<?php echo $dato['ImagenEntrada']; ?>'; ><br>
			<p class='sintaxis'><?php echo $dato['Contenido']; ?></p>
		</div>
	</a>
<?php
	}
?>
</div>
<?php include ('../pie.php'); ?>