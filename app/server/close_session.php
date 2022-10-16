<?php
    session_start();
    session_destroy();
    echo '<script type="text/javascript">window.location.replace("http://localhost:81/src/pages/catalogo/catalogo.php");</script>';
?>
