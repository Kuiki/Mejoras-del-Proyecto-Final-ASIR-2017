<?php session_start(); include '../conexion.php'; ?>
<?php include '../cabeza.php'; 	include '../consultas.php';?>
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
		<h1>Entradas</h1><span><a href='nueva_entrada.php<?php if(isset($_GET['user'])){ echo "?user=".$_GET['user'];}  ?>'>[Añadir Nueva Entrada]</a></span>

<?php 
		if (isset($_GET['user'])) {
			$valor=consulta_entradas($_GET['user'],$conexion);
		}else{
			$valor=consulta_entradas($_SESSION['Usuario'],$conexion);
		}

?>

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

				foreach ($valor as $fila) {
?>
				<tr>
				<td><img src="http://<?php echo PATH; ?>/Img_Entradas/<?= $fila['ImagenEntrada']; ?>"</td>
				<td><a href="http://<?php echo PATH; ?>/enviar_entrada.php?<?php echo "titulo=".$fila['Titulo']."&id=".$fila['IdEntrada']; ?>">
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
			<h1>Gráfica de <?php echo $_SESSION['Usuario']; ?></h1>
			<div id="grafica" style="width:98%;padding:0px;margin:10px auto;height: 400px;">
			    <div class="graficas" id="piechart" style="margin: 0px auto;width:50%;height: 360px"></div>

			    <?php if ($_SESSION['TipoUsuario']=='Administrador'): ?>
			    	<style type="text/css">
						#grafica .graficas{float: left;width: 50%; height: 360px;overflow: hidden;}
					</style>
			    	<div class="graficas " id="barchart_values"></div>>
			    <?php endif ?>
			   
		    </div>
<?php 

 ?>
</div>
<?php include '../pie.php'; ?>
