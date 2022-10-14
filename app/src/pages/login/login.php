<?php 
    session_start(); //Empezar o reanudar sesion en la pagina actual
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/var/www/html/src/pages/login/login.css">
</head>
<body>
    <form action="/var/www/html/server/login.php" method="post">
        <input type="text" name="user_id">
        <input type="submit" value="LogIn">
    </form>
    <?php include '/var/www/html/src/components/footer/footer.php'?>
</body>
</html>