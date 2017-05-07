
<?php if (isset($_SESSION['Usuario'])): ?>
	<center>
                            <img src='http://tutoinformatico.000webhostapp.com/Img_Usuarios/<?php echo $_SESSION['ImgUsuario']; ?>'>
                            <br><a href='http://tutoinformatico.000webhostapp.com/Entrada/'><?php echo $_SESSION['Usuario']; ?></a>
                            <br><a href='http://tutoinformatico.000webhostapp.com/cerrar_session.php'>[cerrar sesión]</a>
    </center>
<?php elseif (!isset($_POST['usuario'])) : ?>
    <form method="post">
        <span>Usuario:</span>
        <input type="text" name="usuario" required>
        <br>
        <span>Contraseña:</span>
        <input type="password" name="contra" required>
        <br>
        <a style="font-size:13px; margin-left: 70px;" href="registro.php">Registrate</a>
        <input style="width:auto" type="submit" name="sesion" value="Iniciar Sesion">
    </form>
<?php else: ?>
	<?php 
        include 'conexion.php';
        $usuario=$_POST['usuario'];
        $contra=md5($_POST['contra']);
        $iniciar_session="SELECT CodUsuario, Usuario, ImgUsuario, TipoUsuario FROM USUARIOS WHERE Usuario='".$usuario."' AND Contraseña='".$contra."'";
        $resultado_session=mysqli_query($conexion,$iniciar_session);


        if(mysqli_num_rows($resultado_session)>0){
            $usuario=mysqli_fetch_array($resultado_session);
            $_SESSION['Usuario']=$usuario['Usuario'];
            $_SESSION['CodUsuario']=$usuario['CodUsuario'];
            $_SESSION['Tipo']=$usuario['TipoUsuario'];
            $_SESSION['ImgUsuario']=$usuario['ImgUsuario'];
            echo "<center>
                            <img src='http://tutoinformatico.000webhostapp.com/Img_Usuarios/".$_SESSION['ImgUsuario']."'>
                            <br><a href='http://tutoinformatico.000webhostapp.com/Entrada/'>".$_SESSION['Usuario']."</a>
                            <br><a href='http://tutoinformatico.000webhostapp.com/cerrar_session.php'>[cerrar sesión]</a>
            </center>";
        }else{
            echo "<script type='text/javascript'>alert ('Usuario o Contraseña Incorrecta');</script>";
            $pagina= $_SERVER["SERVER_NAME"];
            header("Location: http://$pagina");
        }

     ?>
<?php endif ?>