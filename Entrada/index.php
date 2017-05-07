<?php session_start(); include '../conexion.php'; ?>
<?php include '../cabeza.php'; ?>
<div id="entrada">
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
		<h1>Entradas</h1><span><a style='color:rgb(46, 74, 117);' href='nueva_entrada.php<?php if(isset($_GET['user'])){ echo "?user=".$_GET['user'];}  ?>'>[Añadir Nueva Entrada]</a></span>

		<table>
		<tr>
				<th>Imagen</th>
				<th>Titulo</th>
				<th>Categoria</th>
				<th>Ult.Modificación</th>
				<th>Publicado</th>
				<th colspan="2">Editar</th>
				<th>Comentarios</th>
		</tr>
<?php 
				include '../consultas.php';
				if (isset($_GET['user'])) {
					$valor=consulta_entradas($_GET['user'],$conexion);
				}else{
					$valor=consulta_entradas($_SESSION['Usuario'],$conexion);
				}

				foreach ($valor as $fila) {
?>
				<tr>
				<td><img src="http://tutoinformatico.000webhostapp.com/Img_Entradas/<?= $fila['ImagenEntrada']; ?>"</td>
				<td><a href="http://tutoinformatico.000webhostapp.com/enviar_entrada.php?<?php echo "titulo=".$fila['Titulo']."&id=".$fila['IdEntrada']; ?>">
					<?php echo $fila['Titulo']; ?></a></td>
				<td><?php echo $fila['NombreCategoria']; ?></td>
				<td><?php echo $fila['UltimaModificacion']; ?></td>
				<td><?php echo $fila['Publicado']; ?></td>
				<?php if (isset($_GET['user'])) {
					$fila['IdEntrada']=$fila['IdEntrada']."&user=".$_GET['user'];
					} 
				?>
				<td><a href="editar_entrada.php?id=<?php echo $fila['IdEntrada'] ?>">editar</a>
					<a href="borrar_entrada.php?id=<?php echo $fila['IdEntrada'] ?>">eliminar</a>
				</td>
				<td></td>
				<td><?php echo $fila['Comentarios']; ?></td>
				</tr>

<?php 
				}
 ?>
			
			</table>

</div>
<?php include '../pie.php'; ?>