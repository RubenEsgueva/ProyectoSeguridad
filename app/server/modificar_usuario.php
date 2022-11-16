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

    $origen= "modusuario";
    
    foreach($_POST as $key => $value)
    {
        if (!empty($value)) {
            $value = test_input($value);
            if ($key === 'pswd')
            {
                $value = password_hash($value,PASSWORD_DEFAULT);
            }
            $usuario = $_SESSION['usuario'];
            $query = 'UPDATE USUARIOS SET '.$key.' = "'.$value.'" WHERE usuario = "'.$usuario.'"';
            $enviado = $query;
            if ($key === 'pswd' AND $_POST['pswd'] !== $_POST['pswd2']) {
                $_SESSION['error_modi'] = "Contraseña";
                $resultado = "Valor incorrecto del dato";
                include '/var/www/html/server/addlogs.php';
            } else if ($key === 'Nombre' AND !preg_match("/^[a-zA-Z]*$/",$value)) {
                $_SESSION['error_modi'] = "Nombre";
                $resultado = "Valor incorrecto del dato";
                include '/var/www/html/server/addlogs.php';
            } else if ($key === 'Apellido' AND !preg_match("/^[a-zA-Z]*$/",$value)) {
                $_SESSION['error_modi'] = "Apellido";
                $resultado = "Valor incorrecto del dato";
                include '/var/www/html/server/addlogs.php';
            } else if ($key === 'Telefono' AND !preg_match("/^[0-9]{9}$/",$value)) {
                $_SESSION['error_modi'] = "Telefono";
                $resultado = "Valor incorrecto del dato";
                include '/var/www/html/server/addlogs.php';
            } else if ($key === 'FechaNcto' AND !strtotime($_POST['bdate'])) {
                $_SESSION['error_modi'] = "Fecha Nacimiento";
                $resultado = "Valor incorrecto del dato";
                include '/var/www/html/server/addlogs.php';
            } else if ($key === 'email' AND !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error_modi'] = "Email";
                $resultado = "Valor incorrecto del dato";
                include '/var/www/html/server/addlogs.php';
            } else {
                $resultado = "Se ha actualizado el usuario";
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
