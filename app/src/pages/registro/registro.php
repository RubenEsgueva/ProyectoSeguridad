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
		function test_input($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		  
	    $usuarioERR = $contrasenaERR = $contrasena2ERR = $correoERR = $nombreERR = $apellidoERR = $tlfERR = $DNIERR = $fechaERR = "";
	    $correo = $nombre = $apellido = $tlf = $dni = $pswd = $pswd2 = $fecha = "";

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
	    	    $tlfERR = "El teléfono solo puede contener números.";
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
		<div>Correo electrónico:</div>
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
