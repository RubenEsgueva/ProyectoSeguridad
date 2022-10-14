<?php
    session_start();
    if ($_POST['user_id'] == "01") {
        $_SESSION['user_id']=$_POST['user_id'];
    }
    header("location: ../../index.php");
?>