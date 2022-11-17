<?php
    session_start();
    include 'conexion_db.php';

    function test_input($data)
    {
        $data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		//$data = mysqli_real_escape_string($conexion, $data);
		return $data;
    }

    $origen= "modcoche";
    
    foreach($_POST as $key => $value)
    {
        if (strcmp($usuario, $dueno) === 0) {
            if ($key === 'matricula'){

            $matricula = $_SESSION['matricula'];
            $query = 'UPDATE COCHES SET '.$key.' = "'.$value.'" WHERE matricula = "'.$matricula.'"';
            $enviado = $query;
            } else if ($key === 'Model' AND !preg_match("/^[a-zA-Z]*$/",$value)) {
                $_SESSION['error_modi'] = "Model";
                $resultado = "Valor incorrecto del dato";
                include '/var/www/html/server/addlogs.php';
            } else if ($key === 'imagen' AND test_input($_POST["imagen"]) ){
                $exten_permit = array("jpg","jpeg","png","gif");
				$exten_img = pathinfo($imagen, PATHINFO_EXTENSION);
                $_SESSION['error_modi'] = "imagen";
                $resultado = "Valor incorrecto del dato";
                include '/var/www/html/server/addlogs.php';
            } else if ($key === 'status' AND test_input($_POST["status"])) {
                $_SESSION['error_modi'] = "status";
                $resultado = "Valor incorrecto del dato";
                include '/var/www/html/server/addlogs.php';
            } else if ($key === 'km' AND !preg_match("/^[0-9]*$/",$value)) {
                $_SESSION['error_modi'] = "km";
                $resultado = "Valor incorrecto del dato";
                include '/var/www/html/server/addlogs.php';
            } else if ($key === 'price' AND !preg_match("/^[0-9]*\.[0-9]{2}$/",$value)) {
                $_SESSION['error_modi'] = "price";
                $resultado = "Valor incorrecto del dato";
                include '/var/www/html/server/addlogs.php';
            } else {
                $resultado = "Se ha actualizado el coche";
                include '/var/www/html/server/addlogs.php';
                $resultado = mysqli_query($conexion,$query);
            }
        }
    }
    $query = "SELECT * FROM USUARIOS WHERE usuario = '$usuario'";
    $resultado = mysqli_query($conexion,$query);
    while($row = mysqli_fetch_array($resultado)) {
        $_SESSION['user_data'] = $row;
    }
    include 'close_conexion_db.php';
    echo '<script type="text/javascript">window.location.replace("http://localhost:81/src/pages/catalogo/catalogo.php");</script>';
?>
