<?php 
	$conexion=mysqli_connect("localhost","id1042747_blog","blog1234","id1042747_blog");
	if(mysqli_connect_errno()){
		echo "Error al conectar con la BBDD";
	}
	mysqli_set_charset($conexion,"utf8");
?>
