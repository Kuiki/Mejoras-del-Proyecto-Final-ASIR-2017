<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
                body{
                    background:url(honguitos.jpg);
                }
		form{
			width: 600px;
			margin: 0px auto;
                        font-family:Arial;
                        color:white;
		}
		fieldset{
			padding: 80px;
			margin: 50px 0px;
                        background:#e7a61a;
                        border-radius:5px;
                        box-shadow: 0px 0px 4px 3px rgba(0,0,0,0.27);

		}
		span{
			display: inline-block;
			width: 200px;
		}

		input{
			display: inline-block;
			margin: 5px;
                        border-radius:5px;
		}
		#botones{
			width: 200px;
			padding: 5px;
			margin: 0px auto;
		}
	</style>

</head>
<body>
<?php if (!isset($_FILES['imgusuario'])): ?>

	<form method="post"  enctype="multipart/form-data">
		<fieldset>
			<center><h1>Nueva Cuenta</h1></center>
			<span>Usuario:</span><input type="text" name="Usuario" required>
			<span>Nombre:</span><input type="text" name="Nombre" required>
			<span>Apellidos:</span><input type="text" name="Apellidos">
			<span>Correo Electrónico:</span><input type="email" name="Correo" required>
			<span>Contraseña:</span><input type="password" name="Pass" required>
			<span>Sexo:</span><input type="radio" name="Sexo" value="H" checked="ckecked">Hombre<input type="radio" name="Sexo" value="M">Mujer<br>
			<span>Fecha Nacimiento</span><input type="date" name="Nacimiento" value="">
			<input type="file" accept="image/*" name="imgusuario">
  			<br></br>
			<div id="botones">
                        <center>
			<input type="submit" name="Nueva" value="Crear Cuenta">
                        </center>
			</div>
		</fieldset>
	</form>
<a href="index.php"><input type="button" name="inicio" value="Pricipal"></a><br></br>

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

			$consulta2="INSERT INTO USUARIOS VALUES('".mb_strtoupper($codusuario)."','".$_POST['Usuario']."','".$_FILES['imgusuario']['name']."','".ucwords($_POST['Nombre'])."','".ucwords($_POST['Apellidos'])."','".$_POST['Sexo']."','".$_POST['Nacimiento']."','".$_POST['Correo']."','Estandar','".	md5($_POST['Pass'])."')";
		}else{

			$consulta2="INSERT INTO USUARIOS VALUES('".mb_strtoupper($codusuario)."','".$_POST['Usuario']."','user.png','".ucwords($_POST['Nombre'])."','".ucwords($_POST['Apellidos'])."','".$_POST['Sexo']."','".$_POST['Nacimiento']."','".$_POST['Correo']."','Estandar','".md5($_POST['Pass'])."')";

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
</body>
</html>