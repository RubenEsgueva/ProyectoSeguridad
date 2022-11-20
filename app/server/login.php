<?php
    session_start();
    include '/var/www/html/router.php';
    include 'conexion_db.php';
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']); //Escapar el nombre de usuario
    $contrasena = mysqli_real_escape_string($conexion, $_POST['contrasena']); //Escapar la contraseña
    $query = "SELECT * FROM USUARIOS WHERE usuario = '$usuario'";
    $resultado = mysqli_query($conexion,$query);
    $user_data = mysqli_fetch_array($resultado);
    $origen= "login";
    $enviado= $query;
    include 'close_conexion_db.php';
    if ($_POST['CSRF_token'] == $_SESSION['tokenLogin'])
    {
        if ($resultado->num_rows > 0) 
        {
            $pass = $user_data["pswd"];
            if (password_verify($contrasena,$pass))
            {
                $_SESSION['intentos']= 0;
                $_SESSION['usuario']= $usuario;
                $_SESSION['user_data'] = $user_data;
                $resultado= "Se ha iniciado sesion";
                include '/var/www/html/server/addlogs.php';
                $router->pagesCatalogo(0);
            }
            else
            {
                $resultado= "Contrasena incorrecta";
                include '/var/www/html/server/addlogs.php';
                if ($_SESSION['intentos']==0)
                {
                    $_SESSION['intentos']= 1;
                }
                else
                {
                    $_SESSION['intentos']= $_SESSION['intentos']+1;
                }
                $router->pagesLogin(0);
            }
        } 
        else 
        {
            $resultado= "No existe usuario";
            include '/var/www/html/server/addlogs.php';
            $router->pagesLogin(0);
        }
    }
    else
    {
        $resultado= "Llamada sin token ignorada";
        include '/var/www/html/server/addlogs.php';
    }
?>
