<?php if (file_exists("Instalador/index.php")) {
   header('Location: Instalador/');
} ?>
<html>
<head>
	<title>Tuto Informatico</title>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<?php if (isset($_SESSION['TipoUsuario'])): ?>
		<?php if ($_SESSION['TipoUsuario']=='Administrador'): ?>
		<?php 
			function graficausuarios($conexion){
				$datos=[];
				$consulta="SELECT Usuario,count(IdEntrada) as cantidad FROM USUARIOS u LEFT JOIN ENTRADAS e ON u.CodUsuario=e.CodUsuario GROUP BY Usuario";
				$query=mysqli_query($conexion,$consulta);
				if ($query) {
					while ($fila=mysqli_fetch_array($query)) {
						$datos[]=$fila;
					}
				}
				return $datos;
			}
			$valoresusuarios=graficausuarios($conexion);

		?>
		 <script type="text/javascript">

		      google.charts.load("current", {packages:["corechart"]});
		      google.charts.setOnLoadCallback(drawChart);
		      function drawChart() {
		        var data = google.visualization.arrayToDataTable([
		        	["Usuario", "Entradas", { role: "style" } ],
		        <?php 
		            foreach ($valoresusuarios as $usuario) {
		        ?>
		        	["<?php echo $usuario['Usuario']; ?>",<?php echo $usuario['cantidad'] ?>,"#0000cf"],
		        <?php 
           		 }
          		?>
		
		        ]);

		        var view = new google.visualization.DataView(data);
		        view.setColumns([0, 1,
		                         { calc: "stringify",
		                           sourceColumn: 1,
		                           type: "string",
		                           role: "annotation" },
		                         2]);

		        var options = {
		          title: "Entradas de Usuarios",
		          width: 600,
		          height: 400,
		          bar: {groupWidth: "95%"},
		          legend: { position: "none" },
		        };
		        var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
		        chart.draw(view, options);
		    }
    	</script>
		
		<?php endif ?>
	<?php endif ?>
	
	<?php
		function grafica1($grafica,$conexion){
		$datos=[];
		$consulta="SELECT NombreCategoria, count(e.IdEntrada) as cantidad FROM CATEGORIAS c JOIN  PERTENECE p ON c.CodCategoria=p.CodCategoria JOIN ENTRADAS e ON p.IdEntrada=e.IdEntrada WHERE CodUsuario='".$grafica."' GROUP BY NombreCategoria";

		$query=mysqli_query($conexion,$consulta);
		if ($query) {
			while ($fila=mysqli_fetch_array($query)) {
				$datos[]=$fila;
			}
		}
		
		return $datos;
		}
	 	$valores=grafica1($_SESSION['CodUsuario'], $conexion);
	 ?>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php 
            foreach ($valores as $valor) {
          ?>
              ['<?php echo $valor['NombreCategoria'] ?>', <?php echo $valor['cantidad']; ?>],
          <?php 
            }
          ?>
          ['Sleep',    0]
        ]);

        var options = {
          title: 'Mis Entradas'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

	<?php if (isset($_SESSION["Tema"])): ?>
		<link rel="stylesheet" type="text/css" href="http://<?php echo PATH; ?>/<?php echo $_SESSION["Tema"]; ?>.css">
	<?php else: ?>
		<link rel="stylesheet" type="text/css" href="http://<?php echo PATH; ?>/default.css">
	<?php endif ?>
</head>
<body>
<div id="cabeza">
			<div id="logo">
				<a href="http://<?php echo PATH; ?>"><img src="http://<?php echo PATH; ?>/logo.png"><a>
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
		<a href="http://<?php echo PATH; ?>/Windows/"><li>Windows</li></a>
		<a href="http://<?php echo PATH; ?>/Linux"><li>GNU/Linux</li></a>
		<a href="http://<?php echo PATH; ?>/Raspberry"><li>Raspberry</li></a>
		<a href="http://<?php echo PATH; ?>/Android"><li>Android</li></a>
		<a href="http://<?php echo PATH; ?>/PCs"><li>PC'S</li></a>
	</ul>
</div>