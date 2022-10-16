<?php
    session_start();
    include 'conexion_db.php';
    foreach($_POST as $key => $value)
    {
        if (!empty($value)) {
            $usuario = $_SESSION['usuario'];
            if ($key === 'pswd' AND $_POST['pswd'] !== $_POST['pswd2']) {
                $_SESSION['error_modi'] = "Contraseña";
            } else if ($key === 'Nombre' AND !preg_match("/^[a-zA-Z]*$/",$value)) {
                $_SESSION['error_modi'] = "Nombre";
            } else if ($key === 'Apellido' AND !preg_match("/^[a-zA-Z]*$/",$value)) {
                $_SESSION['error_modi'] = "Apellido";
            } else if ($key === 'Telefono' AND !preg_match("/^[0-9]{9}$/",$value)) {
                $_SESSION['error_modi'] = "Telefono";
            } else if ($key === 'FechaNcto' AND !strtotime($_POST['bdate'])) {
                $_SESSION['error_modi'] = "Fecha Nacimiento";
            } else if ($key === 'email' AND !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error_modi'] = "Email";
            } else {
                $query = 'UPDATE USUARIOS SET '.$key.' = "'.$value.'" WHERE usuario = "'.$usuario.'"';
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
