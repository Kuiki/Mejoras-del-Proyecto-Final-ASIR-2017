<?php 
	function crear_bbdd($val,$conexion){
		mysqli_select_db($conexion,$val['bbdd']) or die ("No existe la BBDD".$val['bbdd']);
		mysqli_set_charset($conexion,'utf8');
		if ($val['datos']=='si') {
			$tablas=file_get_contents('Instalador/blog.sql');
		}else{
			$tablas=file_get_contents('Instalador/base.sql');
		}
		
		$tablas=explode(";", $tablas);
		foreach ($tablas as $tabla) {
			$insertar=$tabla;
			if ($insertar!="") {
				$query=mysqli_query($conexion,$insertar);
			}
		}
	return $query;
}

function usuario ($val,$conexion){

	$consulta="INSERT INTO USUARIOS (CodUsuario,Nombre,Apellidos,Usuario,Contraseña,CorreoElectronico,TipoUsuario) VALUES ('ADMI001','".$val['nombre']."','".$val['apellidos']."','".$val['usuario']."','".md5($val['contrasena'])."','".$val['correo']."','Administrador')";

	$query=mysqli_query($conexion,$consulta);
	return $query;

}


if (isset($_POST['siguiente'])) {

	$a=dirname($_SERVER['REQUEST_URI']);
	if ($a=="/") {
		$a="";
	}
	$ruta=$_SERVER['HTTP_HOST'].$a;
	
	$host='define("HOST", "'.$_POST['host'].'",true);';
	$db='define("DB", "'.$_POST['bbdd'].'",true);';
	$user='define("USER", "'.$_POST['usuariomysql'].'",true);';
	$pass='define("PASSWORD", "'.$_POST['contrasenamysql'].'",true);';
	$path='define("PATH","'.$ruta.'",true);';
	$conect='$conexion=mysqli_connect(HOST,USER,PASSWORD,DB);
	if(mysqli_connect_errno()){
		echo "Error al conectar con la BBDD";
	}
	mysqli_set_charset($conexion,"utf8");';
	$fp = fopen('conexion.php', 'w');
			fwrite($fp, "<?php ");
			fwrite($fp, $host);
			fwrite($fp, $user);
			fwrite($fp, $pass);
			fwrite($fp, $db);
			fwrite($fp, $path);
			fwrite($fp, $conect);
			fwrite($fp, " ?>");
		  fclose($fp);

	sleep(2);

	include 'conexion.php';
	
	$crear=crear_bbdd($_POST,$conexion);

	$usuario=usuario($_POST,$conexion);
	if ($usuario) {
		//rmdir("Instalador");
		unlink('Instalador/index.php');
		unlink('Instalador/base.sql');
		unlink('Instalador/blog.sql');
		echo "<center><h1>Instalacion Completa</h1></center>";
		header("Refresh:2; url=index.php");
	}

}else{
	$ruta=$_SERVER['HTTP_HOST'].dirname($_SERVER['REQUEST_URI']);
	echo "<h1>Access denied</h1>";
}
			
?>