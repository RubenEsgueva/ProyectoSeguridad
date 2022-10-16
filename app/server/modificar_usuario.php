<?php
    session_start();
    include 'conexion_db.php';
    foreach($_POST as $key => $value)
    {
        if (!empty($value)) {
            $usuario = $_SESSION['usuario'];
            $query = "UPDATE USUARIOS SET $key = $value WHERE usuario = '$usuario'";
            $resultado = mysqli_query($conexion,$query);
            $query = "SELECT * FROM USUARIOS WHERE usuario = '$usuario'";
            $resultado = mysqli_query($conexion,$query);
            while($row = mysqli_fetch_array($resultado)) {
                $_SESSION['user_data'] = $row;
            }
        }
    }
    include 'close_conexion_db.php';
    echo '<script type="text/javascript">window.location.replace("http://localhost:81/src/pages/catalogo/catalogo.php");</script>';
?>
