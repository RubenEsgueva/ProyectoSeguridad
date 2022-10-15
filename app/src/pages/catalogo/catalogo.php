<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./catalogo.css">
</head>
<body>
    <?php include '/var/www/html/src/components/navbar/navbar.php'; ?>
    <?php include '/var/www/html/src/components/sidebar/sidebar.php'; ?>
    <h1>Esto es el Catalogo.</h1>
    <form action="/var/www/html/server/close_session.php" method="post">
        <input type="submit" value="Close">
    </form>
</body>
</html>
