<?php
    $hostname = "db";
    $username = "admin";
    $password = "admin1234";
    $db = "COCHES";

    $conexion = mysqli_connect($hostname, $username, $password, $db);
    if ($conexion->connect_error) {
        die("Database connection failed: " . $conexion->connect_error);
    }
?>
