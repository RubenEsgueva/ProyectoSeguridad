<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarShow - Añadir Coche</title>
	<link rel="stylesheet" href="/var/www/html/src/pages/anadircoches/anadircoches.css">
</head>
<body>
	<form action="database/coches.php" method="post">
		<p>Modelo:</p>
		<input type="text" class="casilla" name="model" placeholder="Ej.: Batmóvil 2016" autofocus><br>
		<p>Matrícula:</p>
		<input type="text" class="casilla" name="platenum" placeholder="Especifique su matrícula"><br>
		<p>Seleccione la imagen que desee adjuntar:</p>
 		<input type="file" id="imagen" name="imagen"><br>
		<p>Estado:</p>
		<input type="radio" id="nuevo" class="radio" name="status" value="Nuevo">
		<label for="nuevo">Nuevo</label><br>
		<input type="radio" id="seminuevo" class="radio" name="status" value="Seminuevo">
		<label for="seminuevo">Seminuevo</label><br>
		<input type="radio" id="segundamano" class="radio" name="status" value="Segunda Mano">
		<label for="segundamano">Segunda mano</label><br>
		<p>Kilometraje:</p>
		<input type="text" class="casilla" name="km" placeholder="Introduzca los kilometros recorridos."><br>
		<p>Precio:</p>
		<input type="text" class="casilla" name="price" placeholder="Introduzca el valor del vehículo."><br><br>
		<input type="submit" class="boton" value="Confirmar">
	</form>
</body>
</html>