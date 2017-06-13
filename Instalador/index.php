<!DOCTYPE html>
<html>
<head>
	<title>Instalación</title>
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<style type="text/css">
		*{
   			 font-family: Arial, Helvetica, sans-serif;
		}
		label,input{
			display: inline-block;
		}
		#content{
			width: 30%;
			height: 100%;
			margin: 10% auto;
		}
		#form{
			width: 100%;
		}
		#form form input {
			border:1px solid #DDDDDD;
			padding: 2px;
			margin-bottom: 10px; 
			height: 30px;
			font-size:20px;
                        width: 100%;
		}
		label{
			width: 100%;
		}

		#enviar{
			background: #333333;
			color:#FFFFFF;
		}
		i{
			margin-top:20%;
		}

	</style>
			<script type="text/javascript">
			function mostrar(){
			document.getElementById('ocultar').style.display = 'none';
			document.getElementById('ver').style.display = 'block';}
	</script>
</head>
<body>
<div id="content">
		<center><h1>Bienvenido al Instalación</h1></center>
			<div id="form">
				<form action="../install.php" method="post" >
					<div id="ocultar" >
					<label>Host Name</label>
						<input type="text" name="host">
					<label>Nueva Base de Datos</label>
						<input type="text" name="bbdd">
					<label>Usuario MySQL</label>
						<input type="text" name="usuariomysql">
					<label>Constraseña MySQL</label>
						<input type="password" name="contrasenamysql">
					<label>Datos</label>
						<input style="width: 20%; height: 20px;" type="radio" name="datos" value="no">No
						<input style="width: 20%; height: 20px;" type="radio" name="datos" value="si">Si
					<input id="enviar" style="width: 101%;border: none;height: 50px;" type="button" value="Siguiente" onclick="mostrar()">
					</div>

					<div id="ver" style='display:none;'>
					<label>Nombre</label>
						<input type="text" name="nombre">
					<label>Apellidos</label>
						<input type="text" name="apellidos">
					<label>Usuario</label>
						<input type="text" name="usuario">
					<label>Contraseña</label>
						<input type="password" name="contrasena">
					<label>Correo Electrónico</label>
						<input type="email" name="correo">
					<br>
					<input id="enviar" name="siguiente" value="Instalar" style="width: 101%;border: none;height: 50px;" type="submit">
					</div>
				</form>
			</div>		
	<center>
		<i class="fa fa-linux fa-2x"  aria-hidden="true"><span style="font-size: 12px;"> @2Asir</span></i>
	</center>
</div>
</body>
</html>