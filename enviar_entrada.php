<?php 
	$buscar_archivo=scandir("Entrada/ver/",1);
	$archivo_actual_entrada="Entrada/ver/".$buscar_archivo[0];
	
	function url($a){
	$tildes=['á','é','í','ó','ú','ñ',' ','¡','¿','?','!'];
	$sintildes=['a','e','i','o','u','n','_','','','',''];
	$a=str_replace($tildes, $sintildes, $a);
	return $a;
	}

	$valor=url(utf8_decode($_GET['titulo']));
	$nombre_entrada="Entrada/ver/".$valor.".php";
	rename($archivo_actual_entrada,$nombre_entrada);
	$archivo_actual_entrada=$nombre_entrada;
	header("Location: ".$nombre_entrada."?id=".$_GET['id']);
 ?>