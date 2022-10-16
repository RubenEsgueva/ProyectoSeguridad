<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>.error {color: #FF0000;}</style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarShow - Registrate</title>
		<link rel="stylesheet" href="/var/www/html/src/pages/registro/registro.css">
</head>
<body>
	<?php
		$hostname = "db";
		$username = "admin";
		$password = "admin1234";
		$db = "COCHES";
	
		$conexion = mysqli_connect($hostname, $username, $password, $db);
		if ($conexion->connect_error)
		{
			die("Database connection failed: " . $coexion->connect_error);
		}

		function test_input($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		  
	    $usuarioERR = $perfimg = $contrasenaERR = $contrasena2ERR = $correoERR = $nombreERR = $apellidoERR = $tlfERR = $DNIERR = $fechaERR = "";
	    $correo = $perfimgERR= $dni = $pswd = $pswd2 = "";
		$valid = true;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    if (empty($_POST["usr"]))
	    {
	    	$usuarioERR = "Especificar un usuario es obligatorio.";
			$valid = false;
	    }
		else
		{
			$usuario = $_POST["usr"];
			$query = "SELECT * FROM USUARIOS WHERE usuario = '{$usuario}'";
			$resultado = mysqli_query($conexion,$query);
			if ($resultado->num_rows > 0) 
			{
				$usuarioERR = "Ese nombre de usario está en uso.";
				$valid = false;
			}
		}

	    if (empty($_POST["pswd"]))
	    {
    		$contrasenaERR = "Especificar una contraseña es obligatorio.";
			$valid = false;
	    }
	    else
	    {
			if (empty($_POST["pswd2"]))
			{
				$contrasena2ERR = "Por favor, verifique su contraseña.";
				$valid = false;
			}
			else
			{
				$pswd = test_input($_POST["pswd"]);
				$pswd2 = test_input($_POST["pswd2"]);
				if (strcmp($pswd,$pswd2))
				{
					$contrasena2ERR = "Las contraseñas no coinciden.";
					$valid = false;
				}
			}
	    }
		
		if (!empty($_POST["perfimagen"]))
	    {
			$exten_permit = array("jpg","jpeg","png","gif");
			$perfimg = test_input($_POST["perfimagen"]);
			$exten_img = pathinfo($perfimg, PATHINFO_EXTENSION);
	    	if (!in_array($exten_img, $exten_permit))
	    	{
	    	    $perfimgERR = "El archivo adjuntado no tiene una extensión válida.";
				$valid = false;
	    	}
		}

	    if (empty($_POST["dni"]))
	    {
	    	$DNIERR = "El DNI es necesario para identificarse.";
			$valid = false;
	    }
	    else
	    {
	    	$dni = test_input($_POST["dni"]);
	    	if (!preg_match("/^[0-9]{8}-[A-Z]$/",$dni))
	    	{
	    	    $DNIERR = "El formato del DNI es incorrecto, debe ser: 11111111-Z.";
				$valid = false;
	    	}
			else
			{
			    $letra= substr($dni, -1);
		    	$numeros= substr($dni,0,8);
		    	if (substr("TRWAGMYFPDXBNJZSQVHLCKE",$numeros%23,1)!=$letra)
		    	{
				$DNIERR = "La letra del DNI no se corresponde con el número, no es válido.";
				$valid = false;
		    	}
			}
	    }
	    
	    if (empty($_POST["mail"]))
	    {
	    	$correoERR = "Es necesario vincular la cuenta a un correo.";
			$valid = false;
	    }	    
	    else
	    {
	    	$correo = test_input($_POST["mail"]);
    		if (!filter_var($correo, FILTER_VALIDATE_EMAIL))
    		{
      		    $correoERR = "El formato del correo es incorrecto.";
				  $valid = false;
    		}
	    }
	    
	    if (!empty($_POST["name"]))
	    {
	    	$nombre = test_input($_POST["name"]);
	    	if (!preg_match("/^[a-zA-Z]*$/",$nombre))
	    	{
	    	    $nombreERR = "El nombre solo puede contener letras.";
				$valid = false;
	    	}
	    }
	    
	    if (!empty($_POST["surname"]))
	    {
	    	$apellido = test_input($_POST["surname"]);
	    	if (!preg_match("/^[a-zA-Z]*$/",$apellido))
	    	{
	    	    $apellidoERR = "El apellido solo puede contener letras.";
				$valid = false;
	    	}
	    }
	    
	    if (!empty($_POST["tlf"]))
	    {
	    	$tlf = test_input($_POST["tlf"]);
	    	if (!preg_match("/^[0-9]{9}$/",$tlf))
	    	{
	    	    $tlfERR = "El teléfono solo puede estar formado por 9 números.";
				$valid = false;
	    	}
	    }
	    
	    if (!empty($_POST["bdate"]))
	    {
	    	$fecha = strtotime($_POST['bdate']);
	    	if ($fecha)
	    	{
	    	    $fechanac = date('Y-m-d', $fecha);
	    	}
	    }

		if ($valid)
		{
			$query = "INSERT INTO USUARIOS (DNI,email,pswd,usuario) VALUES ('{$dni}','{$correo}','{$pswd}','{$usuario}')";
			if ($conexion->query($query) === TRUE) 
				{
					if (isset($nombre))
					{
						$query = "UPDATE USUARIOS SET Nombre = '{$nombre}' WHERE usuario = '{$usuario}'";
						if ($conexion->query($query) === TRUE) 
						{
							echo "DATABASE UPDATED SUCCESFULLY";
						}
						else
						{
							echo "Error: " . $query . "<br>" . $conexion->error;
						}
					}
					if (isset($apellido))
					{
						$query = "UPDATE USUARIOS SET Apellido = '{$apellido}' WHERE usuario = '{$usuario}'";
						if ($conexion->query($query) === TRUE) 
						{
							echo "DATABASE UPDATED SUCCESFULLY";
						}
						else
						{
							echo "Error: " . $query . "<br>" . $conexion->error;
						}
					}
					if (isset($tlf))
					{
						$query = "UPDATE USUARIOS SET Telefono = '{$tlf}' WHERE usuario = '{$usuario}'";
						if ($conexion->query($query) === TRUE) 
						{
							echo "DATABASE UPDATED SUCCESFULLY";
						}
						else
						{
							echo "Error: " . $query . "<br>" . $conexion->error;
						}
					}
					if (isset($fechanac))
					{
						$query = "UPDATE USUARIOS SET FechaNcto = '{$fechanac}' WHERE usuario = '{$usuario}'";
						if ($conexion->query($query) === TRUE) 
						{
							echo "DATABASE UPDATED SUCCESFULLY";
						}
						else
						{
							echo "Error: " . $query . "<br>" . $conexion->error;
						}
					}
					if (isset($perfimg))
					{
						$query = "UPDATE USUARIOS SET imagen = '{$perfimg}' WHERE usuario = '{$usuario}'";
						if ($conexion->query($query) === TRUE) 
						{
							echo "DATABASE UPDATED SUCCESFULLY";
						}
						else
						{
							echo "Error: " . $query . "<br>" . $conexion->error;
						}
					}
					$location = "/var/www/html/public/{$_POST['usr']}.png";
					if (move_uploaded_file($_FILES['perfimagen']['tmp_name'], $location)) {
						echo 'Imagen guardada correctamente';
					} else {
						echo 'Error';
					}
					echo '<script type="text/javascript">window.location.replace("http://localhost:81/src/pages/login/login.php");</script>';
				} 
				else 
				{
					echo "Error: " . $query . "<br>" . $conexion->error;
				}
		}
	}
	?>
	<style>
        form{
            font-weight: bold;
            color:#000000;
        }
        .boton{
            font-weight:bolder;
            color:rosybrown;
        }
    </style>

	<div><span class="error">* campo obligatorio</span></div>
	<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
		<div>Nombre de usuario:</div>
		<input type="text" class="casilla" name="usr" placeholder="Introduzca su nombre de usuario" autofocus>
		<span class="error">* <?php echo $usuarioERR;?></span><br>
		<div>Contraseña:</div>
		<input type="password" class="casilla" name="pswd" placeholder="Mantén tu contraseña oculta.">
		<span class="error">* <?php echo $contrasenaERR;?></span><br>
		<div>Confirmar contraseña:</div>
		<input type="password" class="casilla" name="pswd2" placeholder="Repite tu contraseña.">
		<span class="error">* <?php echo $contrasena2ERR;?></span><br>
		<p>Adjuntar una foto de perfil:</p>
 		<input type="file" id="perfimagen" name="perfimagen">
		<span class="error"><?php echo $perfimgERR;?></span><br>
		<p>Correo electrónico:</p>
		<input type="text" class="casilla" name="mail" placeholder="yourmail@example.something">
		<span class="error">* <?php echo $correoERR;?></span><br>
		<div>Nombre:</div>
		<input type="text" class="casilla" name="name" placeholder="Hermenegilda">
		<span class="error"><?php echo $nombreERR;?></span><br>
		<div>Apellido:</div>
		<input type="text" class="casilla" name="surname" placeholder="Barinagarrementeria">
		<span class="error"><?php echo $apellidoERR;?></span><br>
		<div>DNI:</div>
		<input type="text" class="casilla" name="dni" placeholder="11111111-Z">
		<span class="error">* <?php echo $DNIERR;?></span><br>
		<div>Número de teléfono:</div>
		<input type="text" class="casilla" name="tlf" placeholder="NNNNNNNNN">
		<span class="error"><?php echo $nameErr;?></span><br>
		<div>Fecha de nacimiento:</div>
		<input type="date" class="casilla" name="bdate" value="<?php echo date('Y-m-d'); ?>">
		<span class="error"><?php echo $nameErr;?></span><br><br>
		<div class="boton">
		<input type="submit" class="boton" value="Confirmar">
		</div>
	</form>
</body>
</html>
