<?php
    //Este fichero solo es un ejemplo
    include 'conexion.php';
    //echo $_POST['name'];
    /*if ($_SESSION['username']="hola") {

    }*/
    $query = "SELECT * FROM users";
    $resultado = mysqli_query($conexion,$query);
    if ($resultado->num_rows > 0) {
        while ($fila = mysqli_fetch_array($resultado)) {
            echo $fila['name'];
            echo nl2br("\r\n");
        }
    }
?>