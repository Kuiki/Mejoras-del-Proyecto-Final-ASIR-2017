<?php 
	function usuarios($usuarios,$conexion){
		$datos=[];
		$consulta="SELECT NombreCategoria, count(e.IdEntrada) as cantidad FROM CATEGORIAS c JOIN  PERTENECE p ON c.CodCategoria=p.CodCategoria JOIN ENTRADAS e ON p.IdEntrada=e.IdEntrada WHERE CodUsuario='".$usuarios."' GROUP BY NombreCategoria";

		$query=mysqli_query($conexion,$consulta);
		if ($query) {
			while ($fila=mysqli_fetch_array($query)) {
				$datos[]=$fila;
			}
		}
		
		return $datos;



	}



 ?>