<?php session_start(); ?>
<?php include '../conexion.php'; ?>
	<?php 
		$consulta="DELETE FROM ENTRADAS WHERE IdEntrada='".$_GET['id']."'";
		$resultado=mysqli_query($conexion,$consulta);
		if($resultado){
			$pagina="http://".$_SERVER['SERVER_NAME']."/Entrada/";
			if (isset($_GET['user'])) {
				$pagina=$pagina."index.php?user=".$_GET['user'];
			}
			
			header("Location: $pagina");
		}else {
			echo "Hubo un problema al eliminar";
		}

	 ?>
	<script type="text/javascript"></script>