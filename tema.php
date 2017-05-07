<?php if (isset($_POST['color'])): ?>
		<?php 
		setcookie("Tema", $_POST['color']); 
		$pagina=$_SERVER['HTTP_REFERER'];
		header("Location: $pagina");
		?>
<?php endif ?>