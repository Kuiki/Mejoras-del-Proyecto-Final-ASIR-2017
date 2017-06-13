<?php 
	session_start();
	include '../conexion.php';
	include '../consultas.php';
 ?>

<?php include '../cabeza.php'; ?>
	<div id="entrada">
<?php if (!isset($_POST['opcion'])) : ?>
			<form action='../opcion_usuario.php' method='post' style='margin:30px 10px;float:right;'>
				<select name='opcion'>
					<option value='ENTRADAS' selected>Mis entradas</option>
					<option value='COMENTARIOS'>Mis comentarios</option>
				<?php  if($_SESSION['Tipo']=='Administrador'){
					echo "<option value='USUARIOS'>Usuarios</option>";
				}
				?>
					<option value='PERFIL'>Mi Perfil</option>
				</select>
				<input type='submit' name='elegir' value='ir'>
			</form>
 <?php else: ?>
			<?php 
			 header("Location: ../Entrada/entradas.php"); 
			?>
<?php endif ?>

 	<h1>Comentarios</h1>
 	<?php 
 		$val="e.CodUsuario='".$_SESSION['CodUsuario']."'";
 		if (isset($_GET['id'])) {
 			$val=$val." AND e.IdEntrada='".$_GET['id']."'";
 		}
 		$comentarios=comentarios($val,$conexion)
 	?>
 	<?php if (count($comentarios)!=0): ?>
 		<table>
 		<tr>
			<th>Imagen</th>
		 	<th>Titulo</th>
		 	<th>Comentario</th>
		 	<th>Eliminar</th>
		</tr>
 	<?php
 			foreach ($comentarios as $comentario) {
 	?>
		<tr>
			<td><img style="width:50px; height:50px;" src='../Img_Entradas/<?php echo $comentario['ImagenEntrada']; ?>'></td>
			<td><a href="http://<?php echo PATH; ?>/enviar_entrada.php?<?php echo "titulo=".$comentario['Titulo']."&id=".$comentario['IdEntrada']; ?>"><?php echo $comentario['Titulo']; ?></a></td>
			<td><p><?php echo $comentario['Comentario']; ?></p></td>
			<td><a href='eliminar_comentario.php?id=<?php echo $comentario['IdComentario']; ?>'>eliminar</a></td>
		</tr>
 	<?php
 			}
	
	?>
	</table>
	<?php else: ?>
		<h3>No tienes Comentarios</h3>
 	<?php endif ?>
 		
	</div>
<?php include '../pie.php'; ?>
