<?php
    session_start();
    include '/var/www/html/router.php';
    include 'conexion_db.php';
    $matricula = $_POST['matricula'];
    $usuario = $_SESSION['usuario'];
    $dueno = $_POST['usuario'];
    $origen= "detalles";
    if ($_POST['CSRF_token'] == $_SESSION['tokenBorr'])
    {
        if (strcmp($usuario, $dueno) === 0) 
        {
            $query = "DELETE FROM COCHES WHERE matricula = '$matricula'";
            $resultado = mysqli_query($conexion,$query);
            $enviado=$query;
            $resultado="Se ha eliminado el coche";
        } 
        else 
        {
            $enviado = "Borrar coche no propio";
            $resultado="Peticion ignorada";
        }
    }
    else
    {
        $enviado="Llamada sin Token";
        $resultado="Peticion ignorada";
    }
    include '/var/www/html/server/addlogs.php';
    include 'close_conexion_db.php';
    $router->pagesCatalogo(0);
?>
