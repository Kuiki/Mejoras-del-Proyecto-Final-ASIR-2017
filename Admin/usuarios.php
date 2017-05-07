 <?php
 session_start();
 	include '../conexion.php';
 	include '../consultas.php';
 ?>
<?php include '../cabeza.php'; ?>
	<div id="entrada">
		<?php if (!isset($_POST['opcion'])) : ?>
			<?php 
			echo "<form action='../opcion_usuario.php' method='post' style='margin:30px 10px;float:right;'>";
				echo "<select name='opcion'>";
					echo "<option value='ENTRADAS'>Mis entradas</option>";
					echo "<option value='COMENTARIOS'>Comentarios</option>";
					echo "<option value='USUARIOS' selected>Usuarios</option>";
					echo "<option value='PERFIL'>Mi Perfil</option>";
				echo "</select>";
				echo "<input type='submit' name='elegir' value='ir'>";
			echo "</form>";
		 ?>
 	
		 <?php 
		 	$consulta_usuarios="SELECT u.CodUsuario, u.Usuario, u.ImgUsuario, count(e.IdEntrada) from ENTRADAS e RIGHT JOIN USUARIOS u ON e.CodUsuario=u.CodUsuario WHERE u.TipoUsuario='Estandar' GROUP BY u.CodUsuario, u.Usuario, u.ImgUsuario";

		 	$ver_consulta=mysqli_query($conexion,$consulta_usuarios);
		 	if(!$ver_consulta){
		 		echo "<h2>error en la consulta</h2>";
		 		echo $consulta_usuarios;
		 	}

		 ?>
                 <h1>Usuarios</h1>
		 <a style="color:rgb(46, 74, 117);'" href="../registro.php">[Crear Nuevo Usuario]</a>
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



		<?php else: ?>
			<?php 
			 header("Location: ../Entrada/index.php?user=kuiki"); 
			?>
		<?php endif ?>
		
	</div>
<?php include '../pie.php'; ?>
