<?php
    $hostname = "db";
    $username = "admin";
    $password = "admin1234";
    $db = "COCHES";

    $conexion = mysqli_connect($hostname, $username, $password, $db);
    if ($conexion->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }
    //$query = mysqli_query($conexion, "INSERT INTO USUARIOS VALUES('Nombre','Apel','6777777k','988988988','2002-11-28','emailol','passswd','usuario2');")
    //or die (mysqli_error($conexion));
?>
