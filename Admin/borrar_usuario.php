<?php 
include '../conexion.php';
if(isset($_GET['user'])){
	$consulta_eliminar="DELETE FROM USUARIOS WHERE CodUsuario='".$_GET['user']."'";
	$eliminar=mysqli_query($conexion,$consulta_eliminar);
	if(!$eliminar){
		echo "No se pudo eliminar el usuario";
	}else{
		echo "<script type='text/javascript'>
					alert('¡Usuario Eliminado!');
					var pagina='usuarios.php?opcion=USUARIOS&elegir=ir';
					function redireccionar(){
					location.href=pagina;
					} 
					setTimeout ('redireccionar()', 500);
			</script>";
	}
}
?>