<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>.error {color: #FF0000;}</style>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarShow - Catálogo</title>
    <link rel="stylesheet" href="./catalogo.css">
</head>
<body>
    <?php include '/var/www/html/src/components/navbar/navbar.php'; ?>
    <?php include '/var/www/html/src/components/sidebar/sidebar.php'; ?>
    <h1>Colección de vehículos:</h1>
    <?php
        include '/var/www/html/server/getCoches.php';
        while($row = mysqli_fetch_assoc($listaCoches)) {
            echo '<hr class="solid">';
            echo '<br><img class="coche_img" src="/public/matriculas/'.$row['imagen'].'" alt="Foto de coche"> <br>Modelo:' .$row['modelo'].' <br>Propietario: ' .$row['usuario'].'<br>';
            $matricula = $row['matricula'];
            $usuario = $row['usuario'];
            echo '
                <form action="/src/pages/detalles/detalles.php" method="post">
                <input type="hidden" name="usuario" value='.$usuario.'>
                    <input type="hidden" name="matricula" value='.$matricula.'>
                    <br><input type="submit" class="boton" name='.$matricula.' value="Ver detalles">
                </form>';      
        }
        if (isset($_SESSION['usuario'])) {
            $username = $_SESSION['usuario'];
        } else {
            $username = "";
            echo 'Inicia Sesion para añadir coches';
        }
        echo "<script type='text/javascript' username='$username' class='gestionar_sesion' src='./gestionar_sesion.js'></script>";    
    ?>
</body>
</html>
