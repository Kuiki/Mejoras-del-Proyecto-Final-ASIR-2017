<?php session_start(); ?>
<?php if (isset($_SESSION['Usuario'])): ?>
	<?php 
	if (isset($_POST['color'])){
		include 'conexion.php';
		$consulta="UPDATE USUARIOS SET Tema='".$_POST['color']."' WHERE Usuario='".$_SESSION['Usuario']."'";
		$query=mysqli_query($conexion,$consulta);
		if ($query) {
			$_SESSION['Tema']=$_POST['color'];
			$pagina=$_SERVER['HTTP_REFERER'];
			header("Location: $pagina");
		}
	}
	?>
<?php else: ?>
	<h2>Acceso denegado</h2>
<?php endif ?>
