<?php 
	session_start();
	include '../conexion.php';
	include '../consultas.php';
?>
<?php include '../cabeza.php'; ?>
		<div id="entrada">
<?php if (!isset($_FILES['avatar']['name'])): ?>

		<form method='post' action="editar_perfil.php" enctype='multipart/form-data'>
		<fieldset>
					<?php $usuario_datos=usuario($_SESSION['CodUsuario'],$conexion);
						foreach ($usuario_datos as $usuario_dato) {
					?>
					<span>Usuario:</span><input type='text' name='Usuario' value="<?php echo $usuario_dato['Usuario']; ?>"><br><br>
					<span>Nombre:</span><input type='text' name='Nombre' value="<?php echo $usuario_dato['Nombre']; ?>"><br><br>
					<span>Apellidos:</span><input type='text' name='Apellidos' value="<?php echo $usuario_dato['Apellidos']; ?>"><br><br>
					<span>Fecha de Nacimiento:</span><input type='date' name='FechaNacimiento' value="<?php echo $usuario_dato['FechaNacimiento']; ?>"><br><br>
                    <span>Sexo:</span>
                    	<input type='radio' name='Sexo' value="H">Hombre
                    	<input type='radio' name='Sexo' value="M">Mujer<br><br>
					<span>Correo Eletronico:</span><input type='email' name='CorreoElectronico' value="<?php echo $usuario_dato['CorreoElectronico']; ?>"><br><br>
					<span>Constraseña:</span><input type='password' name='Contraseña' value="<?php echo $usuario_dato['Contraseña']; ?>"><br><br>
					<span>Avatar:</span><input type="file" accept="image/*" name="avatar"><br>
					<img style="width:100px; height:100px; float: left; margin: 10px;" src="../Img_Usuarios/<?php echo $_SESSION['ImgUsuario']; ?>">
					<br></br><br></br><br></br><br></br>
					<input type='submit' name='enviar' value='Guardar'>

					<?php
						}

					 ?>
		</fieldset>			
	</form>

 <?php else: ?>
 	<?php 
 		$contra=md5($_POST['Constraseña']);
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
			
		if(editar_entrada ($_SESSION['id'],$_POST,$conexion)==true){
				header('Location: http://tutoinformatico.000webhostapp.com/Usuario/perfil.php');
		}else{
				echo "error en la consulta";
		}
 	 ?>
<?php endif ?>
</div>
<?php include '../pie.php'; ?>