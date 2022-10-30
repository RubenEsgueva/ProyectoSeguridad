<?php
    session_start();
    include 'conexion_db.php';
    $matricula = $_POST['matricula'];
    $usuario = $_SESSION['usuario'];
    $dueno = $_POST['usuario'];
    if (strcmp($usuario, $dueno) === 0) {
        $query = "DELETE FROM COCHES WHERE matricula = '$matricula'";
        $resultado = mysqli_query($conexion,$query);
    } else {
    }
    include 'close_conexion_db.php';
    echo '<script type="text/javascript">window.location.replace("http://localhost:81/src/pages/catalogo/catalogo.php");</script>';
?>
