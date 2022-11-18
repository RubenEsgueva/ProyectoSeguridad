<?php
    session_start();
    session_destroy();
    include '/var/www/html/router.php';
    $router->pagesCatalogo(0);
?>
