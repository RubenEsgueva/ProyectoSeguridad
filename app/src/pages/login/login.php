<?php 
    session_start(); //Empezar o reanudar sesion en la pagina actual
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">

</head>

<body>
    <?php
        $token = md5(uniqid(rand(),true));
	    $_SESSION['tokenLogin'] = $token;
    ?>
    <style>
        .login{
            font-weight: bold;
            max-width: fit-content;
        }
    </style>
         <div class="titulo">
        
        </div>
    <div class="derrape">
        <div class="imagen">
            <form action="/var/www/html/server/login.php" method="post">
                <div class="av">
                    <input type="text" class ="sinborde" name="user_id">
                    <br>
                    <input type="submit" class="login" value="Log In"  size="30">  
                </div>
            </form>
        </div>
    </div>
    <form action="/server/login.php" method="post">
        <input type="hidden" name="CSRF_token" value="<?php echo $token; ?>">
        <input type="text" name="usuario" placeholder="Usuario"><br>
        <input type="password" name="contrasena" placeholder="Contraseña"><br><br>
        <input type="submit" value="Log in">
    </form>
</body>

</html>
