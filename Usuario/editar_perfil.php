<?php 
	session_start();
	include '../conexion.php';
	include '../consultas.php';
?>
<?php include '../cabeza.php'; ?>
		<div id="entrada">
<?php if (!isset($_FILES['avatar']['name'])): ?>

		<form id="usuario" method='post' action="" enctype='multipart/form-data'>
					<?php $usuario_datos=usuario($_SESSION['CodUsuario'],$conexion);

						foreach ($usuario_datos as $usuario_dato) {
					?>
					<center><h1>Editar Perfil</h1></center>
					<span>Usuario:</span><input class="input" type="text" name="Usuario" value="<?php echo $usuario_dato['Usuario']; ?>">
					<span>Nombre:</span><input class="input" type="text" name="Nombre" value="<?php echo $usuario_dato['Nombre']; ?>">
					<span>Apellidos:</span><input class="input" type="text" name="Apellidos" value="<?php echo $usuario_dato['Apellidos']; ?>">
					<span>Correo Electrónico:</span><input class="input" type="email" name="CorreoElectronico" value="<?php echo $usuario_dato['CorreoElectronico']; ?>">
					<span>Fecha de Nacimiento:</span><input class="input" type='date' name='FechaNacimiento' value="<?php echo $usuario_dato['FechaNacimiento']; ?>">
					<span>Constraseña:</span><input class="input" type='password' name='Contraseña' value="<?php echo $usuario_dato['Contraseña']; ?>">
					<span>Sexo:</span>
						<input type="radio" name="Sexo" value="H" checked="ckecked">Hombre
						<input type="radio" name="Sexo" value="M">Mujer
					<br><br>
					<span>Foto de Perfil:</span>
					<br><input accept="image/*" name="avatar" type="file"><br>
					<img style="width:100px; height:100px; float: left; margin: 10px;" src="../Img_Usuarios/<?php echo $_SESSION['ImgUsuario']; ?>">
					<br><br>
					<input id="enviar" type="submit" name="enviar" class="input" value="Editar">

					<?php
						}

					 ?>					
	</form>

 <?php else: ?>
 	<?php 
		$dir_subida='../Img_Usuarios/';

		if($_FILES['avatar']['name']!=""){
 				$_POST=array_merge($_POST, array('ImagUsuario'=>$_FILES['avatar']['name']));
				$usuario_datos=usuario($_SESSION['id'],$conexion); 
				foreach ($usuario_datos as $dato) {
					if ($dato['ImgUsuario']!='sinimagen.png') {
						unlink($dir_subida.$dato['ImgUsuario']);
					}
				}
				$fichero_subido=$dir_subida.basename($_FILES['avatar']['name']);
				move_uploaded_file($_FILES['avatar']['tmp_name'], $fichero_subido);
				$_POST=array_merge($_POST,array("ImgUsuario" => $_FILES['avatar']['name']));
				$_SESSION['ImgUsuario']=$_POST['ImgUsuario'];
			}

			
		if(editar_usuario ($_SESSION['CodUsuario'],$_POST,$conexion)==true){
				header('Location: http://'.PATH.'/Usuario/perfil.php');
		}else{
				echo "error en la consulta";
		}
 	 ?>
<?php endif ?>
</div>
<?php include '../pie.php'; ?>