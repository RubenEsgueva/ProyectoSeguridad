<?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        echo '<script type="text/javascript">window.location.replace("http://localhost:81/src/pages/catalogo/catalogo.php");</script>';
    }
    //TO DO: Consulta sql INSERT nuevo coche con los datos que se pasan
?>
