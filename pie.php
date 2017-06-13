<div id="pie" style="padding-top: 30px;" >
	
	<center>
		<span>Administración de Sistemas Informaticos en Red (2ASIR).</span><br>
		<span>Dirección: Calle San Jacinto, 79 - Sevilla.</span><br>
		<span>Página realizada por Luigui Alvarez Ramirez.</span>
	</center>
	<?php if (isset($_SESSION['Usuario'])): ?>
	<div style="width: 24%;margin:15px auto ;position: relative;">
	<form method="post" action="http://<?php echo PATH; ?>/tema.php">
	<span>Elige un tema</span>
		<select name="color">
			<option value="default">Predeterminado</option>
			<option value="oscuro">Oscuro</option>
			<option value="claro">Claro</option>
		</select>
		<input type="submit" name="tema" value="ok">
	</form>
	</div>
	<?php endif ?>
</div>
</body>
</html>