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
</head>
<body>
    <form action="../../server/login.php" method="post">
        <input type="text" name="user_id">
        <input type="submit" value="LogIn">
    </form>
</body>
</html>