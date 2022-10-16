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
    <title>CarShow - Detalles</title>
    <link rel="stylesheet" href="../catalogo/catalogo.css">
</head>
<body>
    <?php
        $matricula = $_POST['matricula'];
        $hostname = "db";
		$username = "admin";
		$password = "admin1234";
		$db = "COCHES";
	
		$conexion = mysqli_connect($hostname, $username, $password, $db);
		if ($conexion->connect_error)
		{
			die("Database connection failed: " . $coexion->connect_error);
		}
        $anadirERR="";
        $query = "SELECT * FROM COCHES WHERE matricula='{$matricula}'";
        $datos = mysqli_query($conexion,$query);
        $row = mysqli_fetch_assoc($datos);
        echo '<br>'.$row['imagen'].' <br>Modelo:' .$row['modelo'].' <br>Propietario: ' .$row['usuario'].'<br>Matricula: ' .$matricula.'<br>Estado: '.$row['estado'];
        if (!empty($row['kilometraje']))
        {
            echo '<br> Kilometraje: '.$row['kilometraje'];
        }
        if (!empty($row['precio']))
        {
            echo '<br> Precio: '.$row['precio'];
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if (isset($_SESSION['usuario'])) 
            {
                if (confirm())
                {
                    $query = "";
                    mysqli_query($conexion,$query);
                    echo '<script type="text/javascript">window.location.replace("http://localhost:81/src/pages/catalogo/catalogo.php");</script>';
                }
            } 
            else 
            {
                $anadirERR = "Solo el propietario puede realizar esta accion.";
            }
        }
    ?>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <br><input type="submit" class="boton" value="Borrar Vehículo">
        <span class="error"><?php echo $anadirERR;?></span><br>
	</form>
</body>