<html>
<head>
	<title>Tuto Informatico</title>
	<?php if (isset($_COOKIE["Tema"])): ?>
		<link rel="stylesheet" type="text/css" href="http://tutoinformatico.000webhostapp.com/<?php echo $_COOKIE["Tema"]; ?>.css">
	<?php else: ?>
		<link rel="stylesheet" type="text/css" href="http://tutoinformatico.000webhostapp.com/blog_css.css">
	<?php endif ?>

	</head>
<body>
<div id="cabeza">
			<div id="logo">
				<a href="http://tutoinformatico.000webhostapp.com"><img src="http://tutoinformatico.000webhostapp.com/logo.png"><a>
				<h1>Tuto Informático</h1>
			</div>
			<div id="login">
				<div id="user">
						<?php  include 'iniciar_sesion.php'; ?>
				</div>
			</div>
</div>

<div id="categorias">
	<ul>
		<a href="http://tutoinformatico.000webhostapp.com/Windows/"><li>Windows</li></a>
		<a href="http://tutoinformatico.000webhostapp.com/Linux"><li>GNU/Linux</li></a>
		<a href="http://tutoinformatico.000webhostapp.com/Raspberry"><li>Raspberry</li></a>
		<a href="http://tutoinformatico.000webhostapp.com/Android"><li>Android</li></a>
		<a href="http://tutoinformatico.000webhostapp.com/PCs"><li>PC'S</li></a>
	</ul>
</div>