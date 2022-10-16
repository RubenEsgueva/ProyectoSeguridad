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
    <?php include '/var/www/html/src/components/footer/footer.php'?>

   
</body>

</html>