<?php
    session_start();
    include 'conexion_db.php';
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $query = "SELECT * FROM USUARIOS WHERE usuario = '$usuario' AND pswd = '$contrasena'";
    $resultado = mysqli_query($conexion,$query);
    include 'close_conexion_db.php';
    if ($resultado->num_rows > 0) {
        $_SESSION['usuario']= $_POST['usuario'];
        $_SESSION['user_data'] = mysqli_fetch_array($resultado); 
        echo '<script type="text/javascript">window.location.replace("http://localhost:81/src/pages/catalogo/catalogo.php");</script>';
    } else {
        echo '<script type="text/javascript">window.location.replace("http://localhost:81/src/pages/login/login.php");</script>';
    }
    include 'close_conexion_db.php';
?>
