<?php session_start(); 
	include '../../conexion.php'; 
	include '../../consultas.php';
	include '../../cabeza.php'; 
?>

<div id="entrada">
<img style="" src="../pdf.png"><a href="#">Imprimir</a><br><br>
<?php
	$entrada=ver_entrada($_GET['id'],$conexion);
	foreach ($entrada as $dato) {
?>
	<div id="contenedor_entrada">
		<center>
			<?php if ($dato['ImagenEntrada']!='sinimagen.png'): ?>
				<img src='../../Img_Entradas/<?php echo $dato['ImagenEntrada']; ?>'>
			<?php endif ?>
			<h1><u><?php echo $dato['Titulo']; ?></u></h1>
		</center>
			<span><?php echo $dato['Contenido']; ?></span>
<?php 
	}
?>
	

				
</div>

<div id="comentarios">
	<h3><u>Comentarios</u></h3>
<?php 
	$comentarios=comentarios_entrada($_GET['id'],$conexion);
	foreach ($comentarios as $dato) {
?>
	<div class='contenedor_comentario'>
		<div>
			<center>
				<img src='../../Img_Usuarios/<?php echo $dato['ImgUsuario']; ?>'><br>
				<span>[<?php echo $dato['Usuario']; ?>]</span>
			</center>
		</div>
		<div class='comentario'>
			<b><i><?php echo $dato['Comentario']; ?></i></b>
		</div>
	</div>
	<br>


<?php 
	}
 ?>

	<span><b>¿Quieres responder?</b></span>
	<form method='post'>
		<textarea name='comentario'></textarea><br>
		<input type='submit' name='comentar' value='RESPONDER'>
	</form>


<?php 
	if (!empty($_POST['comentario'])) {
		if (!empty($_SESSION['CodUsuario'])) {
			if(comentar($_SESSION['CodUsuario'],$_GET['id'],$_POST['comentario'],$conexion)==true){
				$direccion=$_SERVER['REQUEST_URI'];
				echo "<script type='text/javascript'>
						var pagina='".$direccion."';
						function redireccionar(){
						location.href=pagina;
						} 
						setTimeout ('redireccionar()', 200);
					</script>";
			}
		}else{
?>
			<script type="text/javascript">
				alert("Necesitas registrarte para comentar");
			</script>
<?php 
		}	
	} 
?>
</div>
</div>
<?= include '../../pie.php'; ?>