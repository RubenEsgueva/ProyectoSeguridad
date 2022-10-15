<?php
    include 'conexion_db.php';
    $query = "SELECT * FROM USUARIOS";
    $resultado = mysqli_query($conexion,$query) or die (mysqli_error($conexion));
    if ($resultado->num_rows > 0) {
        while ($fila = mysqli_fetch_array($resultado)) {
            //echo $fila['DNI'];
            echo print_r($fila);
        }
    } else {
        echo "No hay datos";
    }
    include 'close_conexion_db.php';
?>
