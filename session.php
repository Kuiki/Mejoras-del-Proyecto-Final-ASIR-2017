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
			font-family: Arial;
			border-radius: 5px;
			color:rgb(46, 74, 117);

		}

		fieldset{
			padding: 100px;
			margin: 50px 0px;
			border-radius: 5px;
			background: #e7a61a;
                        box-shadow: 0px 0px 4px 3px rgba(0,0,0,0.27);
		}
		span{
			display: inline-block;
			font:bold 25px Arial;
		}

		input{
			display: inline-block;
			margin: 5px 0px;
			padding: 5px;
			height: 40px;
			width: 400px;
			font-size: 25px;
			border-radius: 30px;

		}
		#botones{
			padding: 0px;
			margin: 0px auto;
			margin: 0px;
		}
	</style>
	<script type="text/javascript">
		function inicio(){
			location.href='index.php';
		}

	</script>
</head>
<body>
<?php if (!isset($_POST['nueva'])): ?>

	<form method="post"  enctype="multipart/form-data">
		<fieldset>
			<span>Usuario:</span><br><input type="text" name="Usuario"><br>
			<span>Contraseña:</span><br><input type="password" name="Contra">
  			<br></br><center>
			<div id="botones">
			<input type="submit" name="nueva" value="Iniciar Sesión"><input type="submit" name="nueva" value="Cancelar">
			</div></center>
		</fieldset>

	</form>

<?php else: ?>
	<?php 
             if($_POST['nueva']=='Iniciar Sesión'){
		include 'conexion.php';
		$consulta="SELECT * FROM USUARIOS WHERE Usuario='".$_POST['Usuario']."'";
		$resultado=mysqli_query($conexion,$consulta);
		$fila=mysqli_fetch_array($resultado);

		if(!is_null($fila)){
			if($fila['9']==md5($_POST['Contra'])){
				$_SESSION['Usuario']=$_POST['Usuario'];
				$_SESSION['CodUsuario']=$fila['CodUsuario'];
				$_SESSION['ImgUsuario']=$fila['ImgUsuario'];
				if ($fila['TipoUsuario']=='Administrador') {
					echo "<script type='text/javascript'>
					alert('¡Bienvenido Administrador!');
					var pagina='index.php?user=".$_SESSION['Usuario']."';
					function redireccionar(){
					location.href=pagina;
					} 
					setTimeout ('redireccionar()', 500);
					</script>";
					}else {
					echo "<script type='text/javascript'>
					alert('¡Bienvenido ".$_SESSION['Usuario']."!');
					var pagina='index.php?user=".$_SESSION['Usuario']."';
					function redireccionar(){
					location.href=pagina;
					} 
					setTimeout ('redireccionar()', 500);
					</script>";
					}
			}else{
					echo "<script type='text/javascript'>
					alert('¡Contraseña Incorrecta!');
					var pagina='session.php';
					function redireccionar(){
					location.href=pagina;
					} 
					setTimeout ('redireccionar()', 500);
			</script>";
					}
		}else{
			echo "<script type='text/javascript'>
					alert('¡No existe usuario!');
					var pagina='session.php';
					function redireccionar(){
					location.href=pagina;
					} 
					setTimeout ('redireccionar()', 500);
			</script>";

		}
}else{
header("Location: ../../index.php");
}
		
	?>
<?php endif ?>
</body>
</html>