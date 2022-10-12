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
	    $usuarioERR = $contrasenaERR = $contrasena2ERR = $correoERR = $nombreERR = $apellidoERR = $tlfERR = $DNIERR = $fechaERR = "";
	    $correo = $nombre = $apellido = $tlf = $dni = $fecha = "";
	    if (empty($_POST["usr"]))
	    {
	    	$usuarioERR = "Especificar un usuario es obligatorio.";
	    }
	    if (empty($_POST["pswd"]))
	    {
    		$contrasenaERR = "Especificar una contraseña es obligatorio.";
	    }
	    if (empty($_POST["pswd2"]))
	    {
	    	$contrasena2ERR = "Por favor, verifique su contraseña.";
	    }
	    if (empty($_POST["dni"]))
	    {
	    	$DNIERR = "El DNI es necesario para identificarse.";
	    }
	    else
	    {
	    	$dni = test_input($_POST["dni"]);
	    	if (!preg_match("/^[0-9]{8}-[A-Z]$/",$dni)
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
	    	$mail = test_input($_POST["mail"]);
    		if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
    		{
      		    $mailERR = "El formato del correo es incorrecto.";
    		}
	    }
	    
	    if (!empty($_POST["name"]))
	    {
	    	$nombre = test_input($_POST["name"]);
	    	if (!preg_match("/^[a-zA-Z]*$/",$name)
	    	{
	    	    $nombreERR = "El nombre solo puede contener letras.";
	    	}
	    }
	    
	    if (!empty($_POST["surname"]))
	    {
	    	$apellido = test_input($_POST["surname"]);
	    	if (!preg_match("/^[a-zA-Z]*$/",$surname)
	    	{
	    	    $apellidoERR = "El apellido solo puede contener letras.";
	    	}
	    }
	    
	    if (!empty($_POST["tlf"]))
	    {
	    	$tlf = test_input($_POST["tlf"]);
	    	if (!preg_match("/^[0-9]{9}$/",$tlf)
	    	{
	    	    $tlfERR = "El teléfono solo puede contener números.";
	    	}
	    }
	    
	    if (!empty($_POST["bdate"]))
	    {
	    	$fecha = test_input($_POST["bdate"]);
	    	if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/",$fecha)
	    	{
	    	    $fechaERR = "El teléfono solo puede contener números.";
	    	}
	    }

	    function test_input($data) {
	  	$data = trim($data);
	  	$data = stripslashes($data);
	  	$data = htmlspecialchars($data);
	   	return $data;
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
		<span class="error"><?php echo $nameErr;?></span><br>
		<p>Fecha de nacimiento:</p>
		<input type="text" class="casilla" name="bdate" placeholder="YYYY-MM-DD">
		<span class="error"><?php echo $nameErr;?></span><br><br>
		<input type="submit" class="boton" value="Confirmar">
	</form>
</body>
</html>
