<?php session_start() ?>
<?php 
if(!isset($_SESSION['Usuario'])){
	echo "<h2>Lo siento no puedes entrar ...<h2>";
}else{
	if (isset($_POST['opcion'])) {
		switch ($_POST['opcion']) {
			case 'ENTRADAS':
				header("Location: Entrada/entradas.php?user=".$_SESSION['Usuario']);
				break;
			case 'USUARIOS':
				header("Location: Admin/usuarios.php");
				break;
			case 'COMENTARIOS':
				header("Location: Usuario/comentarios.php");
				echo "hola";
				break;
			case 'PERFIL':
				header("Location: Usuario/perfil.php");
				break;
		}

	}


}


 ?>