<?php define("HOST", "localhost",true);define("USER", "root",true);define("PASSWORD", "28012013",true);define("DB", "prueba2",true);define("PATH","localhost/Proyecto",true);$conexion=mysqli_connect(HOST,USER,PASSWORD,DB);
	if(mysqli_connect_errno()){
		echo "Error al conectar con la BBDD";
	}
	mysqli_set_charset($conexion,"utf8"); ?>