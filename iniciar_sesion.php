
<?php if (isset($_SESSION['Usuario'])): ?>
	<center>
                            <img src='http://<?php echo PATH; ?>/Img_Usuarios/<?php echo $_SESSION['ImgUsuario']; ?>'>
                            <br><a href='http://<?php echo PATH; ?>/Entrada/'><?php echo $_SESSION['Usuario']; ?></a>
                            <br><a href='http://<?php echo PATH; ?>/cerrar_session.php'>[cerrar sesión]</a>
    </center>
<?php elseif (!isset($_POST['usuario'])) : ?>
    <form method="post">
        <span>Usuario:</span>
        <input type="text" name="usuario" required>
        <br>
        <span>Contraseña:</span>
        <input type="password" name="contra" required>
        <br>
        <a style="font-size:13px; margin-left: 70px;" href="http://<?php echo PATH; ?>/registro.php">Registrate</a>
        <input style="width:auto" type="submit" name="sesion" value="Iniciar Sesion">
    </form>
<?php else: ?>
	<?php 
        include 'conexion.php';
        $usuario=$_POST['usuario'];
        $contra=md5($_POST['contra']);
        $iniciar_session="SELECT CodUsuario, Usuario, ImgUsuario, TipoUsuario,Tema FROM USUARIOS WHERE Usuario='".$usuario."' AND Contraseña='".$contra."'";
        echo $iniciar_session;
       
        $resultado_session=mysqli_query($conexion,$iniciar_session);


        if(mysqli_num_rows($resultado_session)>0){
            $usuario=mysqli_fetch_array($resultado_session);
            $_SESSION['Usuario']=$usuario['Usuario'];
            $_SESSION['CodUsuario']=$usuario['CodUsuario'];
            $_SESSION['TipoUsuario']=$usuario['TipoUsuario'];
            $_SESSION['ImgUsuario']=$usuario['ImgUsuario'];
            $_SESSION['Tema']=$usuario['Tema'];
            echo "<center>
                            <img src='http://".PATH."/Img_Usuarios/".$_SESSION['ImgUsuario']."'>
                            <br><a href='http://".PATH."/Entrada/'>".$_SESSION['Usuario']."</a>
                            <br><a href='http://".PATH."/cerrar_session.php'>[cerrar sesión]</a>
            </center>";
            $pagina= PATH;
            header("Location: http://$pagina");
        }else{
            echo "<script type='text/javascript'>alert ('Usuario o Contraseña Incorrecta');</script>";
            $pagina= PATH;
            header("Location: http://$pagina");
        }
     ?>
<?php endif ?>