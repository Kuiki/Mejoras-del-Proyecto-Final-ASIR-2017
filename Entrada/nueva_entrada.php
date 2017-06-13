<?php ob_start(); session_start();
include '../conexion.php';
include '../consultas.php'; 

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../blog_css.css">
<script>
	function init(x) {
		if (x=="h") {
			document.getElementById('txtbox').style.display='none';
			document.getElementById('text').style.display='block';
		}

		if (x=="s") {
			document.getElementById('txtbox').style.display='block';
			document.getElementById('text').style.display='none';
		}

		document.getElementById('text').value=document.getElementById('txtbox').innerHTML;

		if (x!="h" || x!="s"){ 
			document.execCommand(x,false,null);
			document.getElementById('txtbox').focus();
		}
if (x=="o") {
					
               document.getElementById('text').value=document.getElementById('txtbox').innerHTML;

		}

	}


</script>
</head>
<body>
<?php include '../cabeza.php' ?>
	<div id="cuerpo" style="margin: 0px auto;width: 1200px;height: 635px;">
	<?php if (!isset($_FILES['imgentrada'])) : ?>
		<form method="post" enctype="multipart/form-data">
			<div id="editor">
				<h1>Nueva Entrada</h1>
				<input id="titulo" type="text" name="titulo" value="" required><br>
				<div id="menu">
					<center>
						<input type="button" value="N" onclick="init('bold')"></input>
						<input type="button" value="I" onclick="init('italic')"></input>
						<input type="button" value="U" onclick="init('underline')"></input>
						<input type="button" value="Centrado" onclick="init('justifycenter')"></input>
						<input type="button" value="Ordenado" onclick="init('justifyfull')"></input>
						<input type="button" value="Izq" onclick="document.execCommand('justifyLeft',false,'')"></input>
						<input type="button" value="Der" onclick="document.execCommand('justifyright',false,'')"></input>
						<input type="button" value="Fuente +" onclick="init('increasefontsize')"></input>
						<input type="button" value="Linea HR" onclick="init('inserthorizontalrule')"></input>
						<input type="button" value="Rehacer" onclick="init('redo')"></input>
						<input type="button" value="Deshacer" onclick="init('undo')"></input>
						<input type="button" value="Real" onclick="init('s')"></input>
						<input type="button" value="HTML" onclick="init('h')"></input>
					</center>
				</div>
				<div id="txtbox" contenteditable="true">
					<p>Escribe aqui ...</p>
				</div>
				<textarea id="text" name="text"></textarea>
			</div>
			<div id="enviar">
				<br>
				<center>
					<input type="submit" name="guardar" value="Guardar" onclick="init('o')">
					<input type="submit" name="guardar" value="Publicar" onclick="init('o')">			
					<br></br>
					<span><b>Categorias</b></span>
				</center>
				<ul style="list-style: none;">
				<?php $categorias=ver_categorias($conexion); 
					foreach ($categorias as $categoria) {
				?>
					<li><input type="radio" name="categoria" value="<?php echo $categoria['CodCategoria']; ?>"><?php echo " ".$categoria['NombreCategoria']; ?></li><br>
				<?php
					}
				?>
				</ul>
				<br>
				<center>
					<span><b>Imágen de Portada</b></span><br></br>
					<input style="background: #5f5f5f; width: 200px;" type="file" accept="image/*" name="imgentrada">
				</center>

			</div>
		</form>
	<?php else: ?>
		<?php
		$usuario=""; 
		if (isset($_GET['user'])) {
			$usuario=buscar_usuario($_GET['user'],$conexion);
			foreach ($usuario as $valor) {
				$usuario=$valor['CodUsuario'];
			}
			
		}else{
			$usuario=$_SESSION['CodUsuario'];
		}
			$entrada=substr($usuario,0, 4).rand(100,999);
			$IdEntrada=mb_strtoupper($entrada);
			$_POST=array_merge($_POST,array("id" => $IdEntrada));
			$dir_subida='../Img_Entradas/';
		
		if($_FILES['imgentrada']['name']!=""){
				$fichero_subido=$dir_subida.basename($_FILES['imgentrada']['name']);
				move_uploaded_file($_FILES['imgentrada']['tmp_name'], $fichero_subido);
				$_POST=array_merge($_POST,array("imgentrada" => $_FILES['imgentrada']['name']));
		}else{
			$_POST=array_merge($_POST,array("imgentrada" => "sinimagen.png"));
		}
		
		$agregar=agregar_entrada($_POST,$usuario,$conexion);

		if ($agregar==true) {
			if (isset($_GET['user'])) {
					$pagina="http://".PATH."/Entrada/index.php?user=".$_GET['user'];
					header("Location: $pagina");
			}else{
					$pagina="http://".PATH."/Entrada/";
					header("Location: $pagina");
			}
		}
		 ?>

	<?php endif ?>
</div>
	<br></br>
<?php include '../pie.php'; ?>

</body>
</html>
<?php ob_end_flush(); ?>