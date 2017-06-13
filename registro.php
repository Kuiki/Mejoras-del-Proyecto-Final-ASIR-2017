<?php 
session_start();
include 'conexion.php'; 
include 'cabeza.php';
?>
<div id="entrada">
<style type="text/css">
	#usuario{
		width: 50%;
		margin: 0px auto;
		padding: 5% 10%;
		color:white;
	}
	#usuario .input {
		width:100%;
		font-size:18px;
		margin: 5px;
		padding: 10px;
		border: none;
		background: #e7a61a;
	}
	-input select {
		background: none;
	}
	#usuario span{
		padding:0px 30% 0px 10px;

	}
</style>
<?php if (!isset($_FILES['imgusuario'])): ?>

	<form id="usuario" method="post"  enctype="multipart/form-data">
			<center><h1>Nueva Cuenta</h1></center>
			<span>Usuario:</span><input class="input" type="text" name="Usuario" required>
			<span>Nombre:</span><input class="input" type="text" name="Nombre" required>
			<span>Apellidos:</span><input class="input" type="text" name="Apellidos">
			<span>Correo Electrónico:</span><input class="input" type="email" name="Correo" required>
			<span>Contraseña:</span><input class="input" type="password" name="Pass" required>
			<span>Sexo:</span>
				<input type="radio" name="Sexo" value="H" checked="ckecked">Hombre
				<input type="radio" name="Sexo" value="M">Mujer
			<br><br>
			<span>Fecha Nacimiento</span><input class="input" type="date" name="Nacimiento" value=""><br><br>
			<input type="file" accept="image/*" name="imgusuario" placeholder="">
			<br><br>
			<input id="enviar" type="submit" name="Nueva" class="input" value="Crear Cuenta">
	</form>

<?php else: ?>
	<?php 
		include 'conexion.php';
		$letusuario=substr($_POST['Nombre'], 0,2).substr($_POST['Apellidos'], 0,2);
		$numero=rand(100,999);
		$dir_subida='Img_Usuarios/';

		if($numero<10){
			$numero="00".$numero;
		}elseif ($numero<100) {
			$numero="0".$numero;
		}
		$codusuario=$letusuario.$numero;

		if($_FILES['imgusuario']['name']!=""){
			$fichero_subido=$dir_subida.basename($_FILES['imgusuario']['name']);
			move_uploaded_file($_FILES['imgusuario']['tmp_name'], $fichero_subido);

			$consulta2="INSERT INTO USUARIOS (CodUsuario,Usuario,ImgUsuario,Nombre,Apellidos,Sexo,FechaNacimiento,CorreoElectronico,TipoUsuario,Contraseña) VALUES('".mb_strtoupper($codusuario)."','".$_POST['Usuario']."','".$_FILES['imgusuario']['name']."','".ucwords($_POST['Nombre'])."','".ucwords($_POST['Apellidos'])."','".$_POST['Sexo']."','".$_POST['Nacimiento']."','".$_POST['Correo']."','Estandar','".md5($_POST['Pass'])."')";
		}else{

			$consulta2="INSERT INTO USUARIOS (CodUsuario,Usuario,ImgUsuario,Nombre,Apellidos,Sexo,FechaNacimiento,CorreoElectronico,TipoUsuario,Contraseña) VALUES('".mb_strtoupper($codusuario)."','".$_POST['Usuario']."','user.png','".ucwords($_POST['Nombre'])."','".ucwords($_POST['Apellidos'])."','".$_POST['Sexo']."','".$_POST['Nacimiento']."','".$_POST['Correo']."','Estandar','".md5($_POST['Pass'])."')";

		}

		if($resultado2=mysqli_query($conexion,$consulta2)){
			echo "<script type='text/javascript'>
				alert('Usuario Creado');
				var pagina='index.php';
				function redireccionar(){
				location.href=pagina;
				} 
				setTimeout ('redireccionar()', 300);
			</script>";
			}else{
			echo "<script type='text/javascript'>
				alert('Error al crear usuario');
				var pagina='registro.php';
				function redireccionar(){
				location.href=pagina;
				} 
				setTimeout ('redireccionar()', 300);
			</script>";		}
		
		?>
<?php endif ?>
</div>
<?php include 'pie.php'; ?>