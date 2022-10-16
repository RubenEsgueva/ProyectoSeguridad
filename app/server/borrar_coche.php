<?php
    include 'conexion_db.php';
    $matricula = $_POST['matricula'];
    $usuario = $_SESSION['usuario'];
    $dueno = $_POST['usuario'];
    if (empty($dueno)) {
        echo '<script type="text/javascript">window.location.replace("http://localhost:81/src/pages/catalogo/catalogo.php");</script>';
    }
    if ("$usuario" !== "$dueno") {
        echo '<script type="text/javascript">window.location.replace("http://localhost:81/src/pages/catalogo/catalogo.php");</script>';
    } else {
        $query = "DELETE FROM COCHES WHERE matricula = '$matricula'";
        $resultado = mysqli_query($conexion,$query);
    }
    include 'close_conexion_db.php';
    echo '<script type="text/javascript">window.location.replace("http://localhost:81/src/pages/catalogo/catalogo.php");</script>';
?>
