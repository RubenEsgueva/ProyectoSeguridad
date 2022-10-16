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
        //queremos mostrar los datos de los vehículos por lo que tenemos que obtenerlos de la base de datos.
        $hostname = "db";
		$username = "admin";
		$password = "admin1234";
		$db = "COCHES";
	
		$conexion = mysqli_connect($hostname, $username, $password, $db);
		if ($conexion->connect_error)
		{
			die("Database connection failed: " . $coexion->connect_error);
		}

        if (isset($_SESSION['usuario'])) {
            $username= $_SESSION['usuario'];
        } else {
            $login = "";
        }
        echo "<script type='text/javascript' username='$username' class='gestionar_sesion' src='./gestionar_sesion.js'></script>";

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if (isset($_SESSION['usuario'])) 
            {
                echo '<script type="text/javascript">window.location.replace("http://localhost:81/src/pages/anadircoches/anadircoches.php");</script>';
            } 
            else 
            {
                $anadirERR = "Es necesario iniciar sesión para realizar esta acción.";
            }
        }

        $query = "SELECT * FROM COCHES";
        $listaCoches = mysqli_query($conexion,$query);
        while($row = mysqli_fetch_assoc($listaCoches)) 
        {
            echo '<hr class="solid">';
            echo '<br>'.$row['imagen'].' <br>Modelo:' .$row['modelo'].' <br>Propietario: ' .$row['usuario'].'<br>';
            $matricula = $row['matricula'];
            echo '
                <form action="/src/pages/detalles/detalles.php" method="post">
                    <input type="hidden" name="matricula" value='.$matricula.'>
                    <br><input type="submit" class="boton" name='.$matricula.' value="Ver detalles">
                </form>';         
        }     
    ?>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <br>
        <input type="submit" class="boton" value="Añadir Coche">
        <span class="error"><?php echo $anadirERR;?></span><br>
	</form>
</body>
</html>
