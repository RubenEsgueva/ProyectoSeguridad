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
    <title>CarShow - Añadir Coche</title>
	<link rel="stylesheet" href="/var/www/html/src/pages/anadircoches/anadircoches.css">
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
			die("Database connection failed: " . $conn->connect_error);
		}

		function test_input($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		$modelo = $matricula = $imagen = $estado = $kmtraje = $precio = "";
		$modelERR = $matERR = $estadoERR = $imgERR = $kmERR = $precioERR = "";
		$valido = true;
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			if (empty($_POST["model"]))
	    	{
	    		$modelERR = "Es necesario indicar el modelo del vehículo.";
				$valido = false;
	    	}
			else
			{
				$modelo = test_input($_POST["model"]);
			}

			if (empty($_POST["platenum"]))
	    	{
	    		$matERR = "Es necesario indicar la matrícula del vehículo.";
				$valido = false;
	    	}
			else
			{
				$matricula = test_input($_POST["platenum"]);
			}

			if (empty($_POST["imagen"]))
	    	{
	    		$imgERR = "Para verlo en el catálogo es necesario adjuntar una imagen.";
				$valido = false;
	    	}
			else
			{
				$exten_permit = array("jpg","jpeg","png","gif");
				$imagen = test_input($_POST["imagen"]);
				$exten_img = pathinfo($imagen, PATHINFO_EXTENSION);
	    		if (!in_array($exten_img, $exten_permit))
	    		{
	    		    $imgERR = "El archivo adjuntado no tiene una extensión válida.";
					$valido = false;
	    		}
			}

			if (empty($_POST["status"]))
	    	{
	    		$estadoERR = "Por favor especifique el estado del vehículo.";
				$valido = false;
	    	}
			else
			{
				$estado = test_input($_POST["status"]);
			}

			if (!empty($_POST["km"]))
	    	{
	    		$kmtraje = test_input($_POST["km"]);
	    		if (!preg_match("/^[0-9]*$/",$kmtraje))
	    		{
	    		    $kmERR = "Por favor exprese el kilometraje en números enteros.";
					$valido = false;
	    		}
	    	}
			if (!empty($_POST["price"]))
	    	{
	    		$precio = test_input($_POST["price"]);
	    		if (!preg_match("/^[0-9]*\.[0-9]{2}$/",$precio))
	    		{
	    		    $precioERR = "Utilize el formato 9999.99 por favor.";
					$valido = false;
	    		}
	    	}
			if ($valido)
			{
				$query = "INSERT INTO COCHES VALUES($matricula,$modelo,'FoulRune',$estado,$kmtraje,$precio,$imagen)";
				mysqli_query($conexion, $query);
			}
		}
	?>
	<p><span class="error">* campo obligatorio</span></p>
	<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
		<p>Modelo:</p>
		<input type="text" class="casilla" name="model" placeholder="Ej.: Batmóvil 2016" autofocus>
		<span class="error">* <?php echo $modelERR;?></span><br>
		<p>Matrícula:</p>
		<input type="text" class="casilla" name="platenum" placeholder="Especifique su matrícula">
		<span class="error">* <?php echo $matERR;?></span><br>
		<p>Seleccione la imagen que desee adjuntar:</p>
 		<input type="file" id="imagen" name="imagen">
		<span class="error">* <?php echo $imgERR;?></span><br>
		<p>Estado:</p>
		<input type="radio" id="nuevo" class="radio" name="status" value="Nuevo">
		<label for="nuevo">Nuevo</label><br>
		<input type="radio" id="seminuevo" class="radio" name="status" value="Seminuevo">
		<label for="seminuevo">Seminuevo</label><br>
		<input type="radio" id="segundamano" class="radio" name="status" value="Segunda Mano">
		<label for="segundamano">Segunda mano</label><br>
		<span class="error">* <?php echo $estadoERR;?></span>
		<p>Kilometraje:</p>
		<input type="text" class="casilla" name="km" placeholder="Introduzca los kilometros recorridos.">
		<span class="error"><?php echo $kmERR;?></span><br>
		<p>Precio:</p>
		<input type="text" class="casilla" name="price" placeholder="Formato: 9999.99">
		<span class="error"><?php echo $precioERR;?></span><br><br>
		<input type="submit" class="boton" value="Confirmar">
	</form>
</body>
</html>
