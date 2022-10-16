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
		//este archivo y anadircoches.php cumplen una función muy similar por lo que en su mayoría será la misma explicación.
		//para guardar datos hace falta conectarse a la base de datos.
		$hostname = "db";
		$username = "admin";
		$password = "admin1234";
		$db = "COCHES";
	
		$conexion = mysqli_connect($hostname, $username, $password, $db);
		if ($conexion->connect_error)
		{
			die("Database connection failed: " . $coexion->connect_error);
		}
		//este es un metodo de seguridad, obtenido de: https://www.w3schools.com/php/php_form_validation.asp
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
	//Cada vez que se pulse el boton de confirmar habrá que comprobar el contenido de cada casilla.
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
		//si todos los contenidos cumplen las condiciones entonces podremos añadir el elemento a la base de datos.
		if ($valid)
		{
			$query = "INSERT INTO USUARIOS (DNI,email,pswd,usuario) VALUES ('{$dni}','{$correo}','{$pswd}','{$usuario}')";
			if ($conexion->query($query) === TRUE) 
				{
					//tras haber creado ya la fila con los datos principales vamos comprobando que datos que se pueden quedar vacíos hay puestos.
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
					//tras meter toda la información necesaria volvemos a login para que pueda iniciar sesión.
					echo '<script type="text/javascript">window.location.replace("http://localhost:81/src/pages/login/login.php");</script>';
				} 
				else 
				{
					echo "Error: " . $query . "<br>" . $conexion->error;
				}
		}
	}
	?>
	<p><span class="error">* campo obligatorio</span></p>
	<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
		<p>Nombre de usuario:</p>
		<input type="text" class="casilla" name="usr" placeholder="Introduzca su nombre de usuario" autofocus>
		<span class="error">* <?php echo $usuarioERR;?></span><br>
		<p>Contraseña:</p>
		<input type="password" class="casilla" name="pswd" placeholder="Mantén tu contraseña oculta.">
		<span class="error">* <?php echo $contrasenaERR;?></span><br>
		<p>Confirmar contraseña:</p>
		<input type="password" class="casilla" name="pswd2" placeholder="Repite tu contraseña.">
		<span class="error">* <?php echo $contrasena2ERR;?></span><br>
		<p>Adjuntar una foto de perfil:</p>
 		<input type="file" id="perfimagen" name="perfimagen">
		<span class="error"><?php echo $perfimgERR;?></span><br>
		<p>Correo electrónico:</p>
		<input type="text" class="casilla" name="mail" placeholder="yourmail@example.something">
		<span class="error">* <?php echo $correoERR;?></span><br>
		<p>Nombre:</p>
		<input type="text" class="casilla" name="name" placeholder="Hermenegilda">
		<span class="error"><?php echo $nombreERR;?></span><br>
		<p>Apellido:</p>
		<input type="text" class="casilla" name="surname" placeholder="Barinagarrementeria">
		<span class="error"><?php echo $apellidoERR;?></span><br>
		<p>DNI:</p>
		<input type="text" class="casilla" name="dni" placeholder="11111111-Z">
		<span class="error">* <?php echo $DNIERR;?></span><br>
		<p>Número de teléfono:</p>
		<input type="text" class="casilla" name="tlf" placeholder="NNNNNNNNN">
		<span class="error"><?php echo $tlfERR;?></span><br>
		<p>Fecha de nacimiento:</p>
		<input type="date" class="casilla" name="bdate" value="<?php echo date('Y-m-d'); ?>">
		<span class="error"><?php echo $fechaERR;?></span><br><br>
		<input type="submit" class="boton" value="Confirmar">
	</form>
</body>
</html>
