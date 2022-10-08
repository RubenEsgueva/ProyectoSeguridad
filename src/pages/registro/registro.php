<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarShow - Registrate</title>
	<link rel="stylesheet" href="/var/www/html/src/pages/registro/registro.css">
</head>
<body>
	<form action="database/usuarios.php" method="post">
		<p>Nombre de usuario:</p>
		<input type="text" class="casilla" name="usr" placeholder="Example404" autofocus><br>
		<p>Contraseña:</p>
		<input type="password" class="casilla" name="pswd" placeholder="Mantén tu contraseña oculta."><br>
		<p>Confirmar contraseña:</p>
		<input type="password" class="casilla" name="pswd2" placeholder="Repite tu contraseña."><br>
		<p>Correo electrónico:</p>
		<input type="text" class="casilla" name="mail" placeholder="yourmail@example.something"><br>
		<p>Nombre:</p>
		<input type="text" class="casilla" name="name" placeholder="Hermenegilda"><br>
		<p>Apellido:</p>
		<input type="text" class="casilla" name="surname" placeholder="Barinagarrementeria"><br>
		<p>DNI:</p>
		<input type="text" class="casilla" name="dni" placeholder="NNNNNNNL"><br>
		<p>Número de teléfono:</p>
		<input type="text" class="casilla" name="tlf" placeholder="NNNNNNNNN"><br>
		<p>Fecha de nacimiento:</p>
		<input type="text" class="casilla" name="bdate" placeholder="DD/MM/YY"><br><br>
		<input type="submit" class="boton" value="Confirmar">
	</form>
</body>
</html>
