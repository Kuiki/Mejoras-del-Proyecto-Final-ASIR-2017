<?php 
	session_start();
	include '../conexion.php';
	include '../consultas.php';
	$dir_subida='../Img_Usuarios/';
?>
<?php include '../cabeza.php'; ?>
	<div id="entrada">
		<form action='../opcion_usuario.php' method='post' style='margin:30px 10px;float:right;'>
			<select name='opcion'>";
				<option value='ENTRADAS'>Mis entradas</option>
				<option value='COMENTARIOS'>Mis comentarios</option>
<?php  
				if($_SESSION['Tipo']=='Administrador'){
					echo "<option value='USUARIOS'>Usuarios</option>";
				}
?>
				<option value='PERFIL' selected>Mi Perfil</option>
				</select>
				<input type='submit' name='elegir' value='ir'>
		</form>
		<br><br>


	<h1>Mis Datos</h1>

	<form method='post' action="editar_perfil.php" enctype='multipart/form-data'>
		<fieldset>
					<?php $usuario_datos=usuario($_SESSION['CodUsuario'],$conexion);
						foreach ($usuario_datos as $usuario_dato) {
					?>
					<span>Usuario:</span><input type='text' name='usuario' value="<?php echo $usuario_dato['Usuario']; ?>" readonly><br><br>
					<span>Nombre:</span><input type='text' name='nombre' value="<?php echo $usuario_dato['Nombre']; ?>" readonly><br><br>
					<span>Apellidos:</span><input type='text' name='apellidos' value="<?php echo $usuario_dato['Apellidos']; ?>" readonly><br><br>
					<span>Fecha de Nacimiento:</span><input type='date' name='fecha' value="<?php echo $usuario_dato['FechaNacimiento']; ?>" readonly><br><br>
                                        <span>Sexo:</span><input type='text' name='sexo' value="<?php echo $usuario_dato['Sexo']; ?>" readonly><br><br>
					<span>Correo Eletronico:</span><input type='email' name='correo' value="<?php echo $usuario_dato['CorreoElectronico']; ?>" readonly><br><br>
					<span>Constraseña:</span><input type='password' name='contra' value="<?php echo $usuario_dato['contraseña']; ?>" readonly><br><br>
					<span style="float: left;">Avatar:</span>
					<img style="width:100px; height:100px; float: left; margin: 10px;" src="../Img_Usuarios/<?php echo $_SESSION['ImgUsuario']; ?>"><br></br><br></br><br></br><br></br>
					<input type='submit' name='enviar' value='Editar Perfíl'>

					<?php
						}

					 ?>
		</fieldset>			
	</form>

</div>
<?php  include '../pie.php'; ?>