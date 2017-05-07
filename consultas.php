<?php 
	function consulta_entradas ($val,$conexion){
		$datos= [];
		$consulta="SELECT e.ImagenEntrada, e.IdEntrada, e.Titulo, c.NombreCategoria, e.UltimaModificacion,e.Publicado, count(Comentario) Comentarios FROM ENTRADAS e JOIN USUARIOS u ON u.CodUsuario=e.CodUsuario LEFT JOIN PERTENECE p ON e.IdEntrada=p.IdEntrada LEFT JOIN CATEGORIAS c ON p.CodCategoria=c.CodCategoria LEFT JOIN COMENTARIOS co ON e.IdEntrada=co.IdEntrada where u.Usuario='".$val."' group by e.ImagenEntrada, e.IdEntrada, e.Titulo,c.NombreCategoria,e.UltimaModificacion,e.Publicado";
		$query = mysqli_query($conexion,$consulta);

		while ($fila=mysqli_fetch_array($query)) {
			$datos[]=$fila;
		}

		return $datos;

 	}

 	function mostrar_entradas ($val,$conexion){
 		$datos=[];
 		$consulta="SELECT e.IdEntrada, e.Titulo, e.ImagenEntrada, e.Contenido FROM ENTRADAS e JOIN PERTENECE p ON e.IdEntrada=p.IdEntrada JOIN CATEGORIAS c ON p.CodCategoria=c.CodCategoria WHERE Publicado='S'";

 		if ($val!=""){
 			$consulta=$consulta." AND NombreCategoria='".$val."'";
 		}

 		$query=mysqli_query($conexion,$consulta);

 		while ($fila=mysqli_fetch_array($query)){
 			$fila['Contenido'] = substr(strip_tags($fila['Contenido']), 0, 100);
			if (strlen(strip_tags($fila['Contenido'])) > 100){
        		$fila['Contenido'] .= ' ...';
    		}

    		$datos[]=$fila;
 		}

 		return $datos;
 	}

 	function ver_entrada($val,$conexion){
 		$datos=[];
 		$consulta="SELECT Titulo,Contenido,ImagenEntrada FROM ENTRADAS WHERE IdEntrada='".$val."'";
 		$query=mysqli_query($conexion,$consulta);
 		while ($fila=mysqli_fetch_array($query)) {
 			$datos[]=$fila;
 		}
 		return $datos;
 	}

 	function comentarios_entrada ($val,$conexion){
 		$datos=[];
 		$consulta="SELECT u.Usuario, u.ImgUsuario, c.Comentario FROM USUARIOS u JOIN COMENTARIOS c ON u.CodUsuario=c.CodUsuario WHERE c.IdEntrada='".$val."'";
 		$query=mysqli_query($conexion,$consulta);
 		if (!$query) {
 			echo "Error en la consulta ...";
 		}
 		while ($fila=mysqli_fetch_array($query)) {
 			$datos[]=$fila;
 		}
 		return $datos;
 	}

 	function comentar ($usuario,$entrada,$comentario,$conexion){
 		$datos=[];
 		$consulta="INSERT INTO COMENTARIOS (CodUsuario,IdEntrada,Comentario) VALUES ('$usuario','$entrada','$comentario')";
 		$query=mysqli_query($conexion,$consulta);
 		return $query;
 	}


 	function agregar_entrada ($val,$usuario,$conexion){
 		if ($val['guardar']=="Guardar") {
 			$val['guardar']="N";
 		}else{
 			$val['guardar']="S";
 		}
 		$consulta="INSERT INTO ENTRADAS (IdEntrada,Titulo,Contenido,Publicado,ImagenEntrada,CodUsuario) VALUES ('".$val['id']."','".$val['titulo']."','".$val['text']."','".$val['guardar']."','".$val['imgentrada']."','".$usuario."')";
 		$query=mysqli_query($conexion,$consulta);
 		if (!isset($val['categoria'])) {
			$val=array_merge($val,array("categoria" => "SIN000"));
 		}

 		$consulta="INSERT INTO PERTENECE VALUES ('".$val['id']."','".$val['categoria']."')";
		$query=mysqli_query($conexion,$consulta);
 		return $query;
 	}

 	function ver_categorias($conexion) {
 		$datos=[];
 		$consulta="SELECT * FROM CATEGORIAS WHERE NombreCategoria!='Sin Categoria'";
 		$query=mysqli_query($conexion,$consulta);
 		while ($fila=mysqli_fetch_array($query)) {
 			$datos[]=$fila;
 		}
 		return $datos;
 	}

 	function datos_entrada($val,$conexion){
 		$datos=[];
 		$consulta="SELECT e.Titulo,e.Contenido,e.ImagenEntrada,c.NombreCategoria FROM ENTRADAS e JOIN PERTENECE p ON p.IdEntrada=e.IdEntrada JOIN CATEGORIAS c ON c.CodCategoria=p.CodCategoria WHERE e.IdEntrada='".$val."'";
 		$query=mysqli_query($conexion,$consulta);
 		while ($fila=mysqli_fetch_array($query)) {
 			$datos[]=$fila;
 		}
 		return $datos;
 	}

 	function editar_entrada ($id,$val,$conexion){
 		switch ($val['Publicado']) {
 			case 'Publicar':
 				$val['Publicado']="S";
 				break;
 			
 			default:
 				$val['Publicado']="N";
 				break;
 		}
 		foreach ($val as $key => $value) {
 			$consulta="UPDATE ENTRADAS SET $key='$value' WHERE IdEntrada='$id'";
 			if ($key=='Categoria') {
 				$consulta="UPDATE PERTENECE SET CodCategoria='$value' WHERE IdEntrada='$id'";
 			}

 			$query=mysqli_query($conexion,$consulta);
 		}
 		return $query;
 	}

 	function comentarios ($val,$conexion){
 		$datos=[];
 		$consulta="SELECT e.ImagenEntrada,e.IdEntrada,e.Titulo,c.Comentario,c.IdComentario FROM ENTRADAS e JOIN COMENTARIOS c ON e.IdEntrada=c.IdEntrada WHERE ".$val;
 		$query=mysqli_query($conexion,$consulta);
 		while ($fila=mysqli_fetch_array($query)) {
 			$datos[]=$fila;
 		}
 		return $datos;
 	
 	}

 	function usuario($val,$conexion){
 		$datos=[];
 		$consulta="SELECT * FROM USUARIOS WHERE Usuario='$val'";
 		$query=mysqli_query($conexion,$consulta);
 		while ($fila=mysqli_fetch_array($query)) {
 			$datos[]=$fila;
 		}
 		return $datos;
 	}

 	function editar_usuario($id,$val,$conexion){
 		unset($val['enviar']);
 		foreach ($val as $key => $value) {
 			$consulta="UPDATE USUARIOS SET $key='$value' WHERE CodUsuario='$id'";
 			$query=mysqli_query($conexion,$consulta);
 			if (!$query) {
 				echo $consulta."<br>";
 			}
 		}
 		return $query;

 	}
?>
