<?php 
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("location: ../../index.php");
    }
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
    <?php //include $_SERVER['DOCUMENT_ROOT'].'/carshow/components/navbar/navbar.php'; ?>
    <?php //include $_SERVER['DOCUMENT_ROOT'].'/carshow/components/sidebar/sidebar.php'; ?>
    <form action="../../server/close_session.php" method="post">
        <input type="submit" value="Close">
    </form>
</body>
</html>