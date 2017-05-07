<?php 
	session_start();
	include '../conexion.php';
	if (isset($_SESSION['Usuario'])) {
		$consulta="DELETE FROM COMENTARIOS WHERE IdComentario='".$_GET['id']."'";
 		$query=mysqli_query($conexion,$consulta);
 		if ($query) {
 			$pagina=$_SERVER['SERVER_NAME']."/Usuario/comentarios.php";
 			header("Location:http://$pagina");
 		}else{
 			return "Error en la consulta";
 		}

	}else{
		echo "no puede entrar";
	}

 ?>