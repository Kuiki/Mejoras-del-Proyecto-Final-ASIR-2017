<?php session_start(); include 'conexion.php'; ?>
<?php include('cabeza.php'); ?>
<div id="entrada">
<?php 
	include 'consultas.php';
	$entradas=mostrar_entradas("",$conexion);
	foreach ($entradas as $dato) {
?>
	<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/enviar_entrada.php?<?php echo "titulo=".$dato['Titulo']."&id=".$dato['IdEntrada']; ?>">
		<div class='enviar_entrada'>
			<img class='imgentrada' src='http://<?php echo $_SERVER['SERVER_NAME']; ?>/Img_Entradas/<?php echo $dato['ImagenEntrada']; ?>'; ><br>
			<p class='sintaxis'><?php echo $dato['Contenido']; ?></p>
		</div>
	</a>
<?php
	}
?>
</div>
<?php include('pie.php'); ?>
