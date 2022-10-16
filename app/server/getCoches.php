<?php
    include 'conexion_db.php';
    $query = "SELECT * FROM COCHES";
    $listaCoches = mysqli_query($conexion,$query);
    include 'close_conexion_db.php';
?>
