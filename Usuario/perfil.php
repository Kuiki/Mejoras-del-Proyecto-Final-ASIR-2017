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
				if($_SESSION['TipoUsuario']=='Administrador'){
					echo "<option value='USUARIOS'>Usuarios</option>";
				}
?>
				<option value='PERFIL' selected>Mi Perfil</option>
				</select>
				<input type='submit' name='elegir' value='ir'>
		</form>
		<br><br>

	<form id="usuario"  method='post' action="editar_perfil.php" enctype='multipart/form-data'>
					<?php $usuario_datos=usuario($_SESSION['CodUsuario'],$conexion);

						foreach ($usuario_datos as $usuario_dato) {
					?>
					<center><h1>Mis Datos Personales</h1></center>
					<span>Usuario:</span><input class="input" type="text" name="Usuario" value="<?php echo $usuario_dato['Usuario']; ?>" readonly>
					<span>Nombre:</span><input class="input" type="text" name="Nombre" value="<?php echo $usuario_dato['Nombre']; ?>" readonly>
					<span>Apellidos:</span><input class="input" type="text" name="Apellidos" value="<?php echo $usuario_dato['Apellidos']; ?>" readonly>
					<span>Fecha de Nacimiento:</span><input class="input" type='date' name='FechaNacimiento' value="<?php echo $usuario_dato['FechaNacimiento'];?>" readonly>
					<span>Correo Electrónico:</span><input class="input" type="email" name="Correo" value="<?php echo $usuario_dato['CorreoElectronico']; ?>" readonly>
					<span>Constraseña:</span><input class="input" type='password' name='Contraseña' value="<?php echo $usuario_dato['Contraseña']; ?>" readonly>
					<span>Sexo:</span>
						<input type="radio" name="Sexo" value="H" checked="ckecked">Hombre
						<input type="radio" name="Sexo" value="M">Mujer
					<br><br>
					<span>Foto de Perfil:</span>
					<br><br>
					<img style="width:100px; height:100px; float: left; margin: 10px;" src="../Img_Usuarios/<?php echo $_SESSION['ImgUsuario']; ?>">
					<br><br>
					<input id="enviar" type="submit" name="Nueva" class="input" value="Editar Perfil">

					<?php
						}

					 ?>		
	</form>

</div>
<?php  include '../pie.php'; ?>