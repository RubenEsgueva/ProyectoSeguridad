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
		function test_input($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		  
	    $usuarioERR = $perfimg = $contrasenaERR = $contrasena2ERR = $correoERR = $nombreERR = $apellidoERR = $tlfERR = $DNIERR = $fechaERR = "";
	    $correo = $nombre = $perfimgERR = $apellido = $tlf = $dni = $pswd = $pswd2 = $fecha = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    if (empty($_POST["usr"]))
	    {
	    	$usuarioERR = "Especificar un usuario es obligatorio.";
	    }

	    if (empty($_POST["pswd"]))
	    {
    		$contrasenaERR = "Especificar una contraseña es obligatorio.";
	    }
	    else
	    {
			if (empty($_POST["pswd2"]))
			{
				$contrasena2ERR = "Por favor, verifique su contraseña.";
			}
			else
			{
				$pswd = test_input($_POST["pswd"]);
				$pswd2 = test_input($_POST["pswd2"]);
				if (strcmp($pswd,$pswd2))
				{
					$contrasena2ERR = "Las contraseñas no coinciden.";
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
	    	}
		}

	    if (empty($_POST["dni"]))
	    {
	    	$DNIERR = "El DNI es necesario para identificarse.";
	    }
	    else
	    {
	    	$dni = test_input($_POST["dni"]);
	    	if (!preg_match("/^[0-9]{8}-[A-Z]$/",$dni))
	    	{
	    	    $DNIERR = "El formato del DNI es incorrecto, debe ser: 11111111-Z.";
	    	}
			else
			{
			    $letra= substr($dni, -1);
		    	$numeros= substr($dni,0,8);
		    	if (substr("TRWAGMYFPDXBNJZSQVHLCKE",$numeros%23,1)!=$letra)
		    	{
				$DNIERR = "La letra del DNI no se corresponde con el número, no es válido.";
		    	}
			}
	    }
	    
	    if (empty($_POST["mail"]))
	    {
	    	$correoERR = "Es necesario vincular la cuenta a un correo.";
	    }	    
	    else
	    {
	    	$correo = test_input($_POST["mail"]);
    		if (!filter_var($correo, FILTER_VALIDATE_EMAIL))
    		{
      		    $correoERR = "El formato del correo es incorrecto.";
    		}
	    }
	    
	    if (!empty($_POST["name"]))
	    {
	    	$nombre = test_input($_POST["name"]);
	    	if (!preg_match("/^[a-zA-Z]*$/",$nombre))
	    	{
	    	    $nombreERR = "El nombre solo puede contener letras.";
	    	}
	    }
	    
	    if (!empty($_POST["surname"]))
	    {
	    	$apellido = test_input($_POST["surname"]);
	    	if (!preg_match("/^[a-zA-Z]*$/",$apellido))
	    	{
	    	    $apellidoERR = "El apellido solo puede contener letras.";
	    	}
	    }
	    
	    if (!empty($_POST["tlf"]))
	    {
	    	$tlf = test_input($_POST["tlf"]);
	    	if (!preg_match("/^[0-9]{9}$/",$tlf))
	    	{
	    	    $tlfERR = "El teléfono solo puede estar formado por 9 números.";
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
