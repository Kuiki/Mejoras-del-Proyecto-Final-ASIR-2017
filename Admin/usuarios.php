 <?php
 session_start();
 	include '../conexion.php';
 	include '../consultas.php';
 ?>
<?php include '../cabeza.php'; ?>
	<div id="entrada">
		<form action='../opcion_usuario.php' method='post' style='margin:30px 10px;float:right;'>
				<select name='opcion'>
					<option value='ENTRADAS' selected>Mis entradas</option>
					<option value='COMENTARIOS'>Mis comentarios</option>
				<?php  if ($_SESSION['TipoUsuario']=='Administrador'){
					echo "<option value='USUARIOS'>Usuarios</option>";
				}
				?>
					<option value='PERFIL'>Mi Perfil</option>
				</select>
				<input type='submit' name='elegir' value='ir'>
			</form>

        <h1>Usuarios</h1>
		 <a href="../registro.php">[Crear Nuevo Usuario]</a>
 	
		 <?php 
		 	$consulta_usuarios="SELECT u.CodUsuario, u.Usuario, u.ImgUsuario, count(e.IdEntrada) from ENTRADAS e RIGHT JOIN USUARIOS u ON e.CodUsuario=u.CodUsuario WHERE u.TipoUsuario='Estandar' GROUP BY u.CodUsuario, u.Usuario, u.ImgUsuario";

		 	$ver_consulta=mysqli_query($conexion,$consulta_usuarios);
		 	if(!$ver_consulta){
		 		echo "<h2>error en la consulta</h2>";
		 		echo $consulta_usuarios;
		 	}

		 	if (mysqli_num_rows($ver_consulta)==0){
		 		echo "<h2>No hay usuario registrados</h2>";
		 	}else{


		 ?>

		 <table>
		 	<tr style="background: #5f5f5f; color:white">

		 		<th>Imagen</th>
		 		<th>Usuario</th>
		 		<th>Entradas</th>
		 		<th>Editar</th>
		 	</tr>
		 	<?php 
		 		while ($fila=mysqli_fetch_array($ver_consulta)) {
		 			echo "<tr><td>";
		 			echo "<img style='width:50px; height:50px;' src='../Img_Usuarios/".$fila['ImgUsuario']."'></td><td>";
		 			echo "<a href='../Entrada/index.php?user=".$fila['Usuario']."'>".$fila['Usuario']."</a</td><td>";
		 			echo "(".$fila['count(e.IdEntrada)'].") entradas creadas</td><td>";
		 			echo "<a href='borrar_usuario.php?user=".$fila['CodUsuario']."'>eliminar</a>
		 				  <a href='editar_usuario.php?user=".$fila['CodUsuario']."'>editar</a>
		 				  </td></tr>";
		 		}

		 	 ?>
		 </table>

<?php } ?>
		
	</div>
<?php include '../pie.php'; ?>
