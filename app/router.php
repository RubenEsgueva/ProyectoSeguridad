<?php
    $host="https://localhost:443";
    class router {
        function pagesCatalogo($miliseconds) {
            echo '<script type="text/javascript">
                    window.setTimeout(function(){window.location.replace('.$host.'"/src/pages/catalogo/catalogo.php")},'.$miliseconds.');
                </script>';
        }
        function pagesLogin($miliseconds) {
            echo '<script type="text/javascript">
                    window.setTimeout(function(){window.location.replace('.$host.'"/src/pages/login/login.php")},'.$miliseconds.');
                </script>';
        }
        function pagesRegistro($miliseconds) {
            echo '<script type="text/javascript">
                    window.setTimeout(function(){window.location.replace('.$host.'"/src/pages/registro/registro.php")},'.$miliseconds.');
                </script>';
        }
        function serverCloseSesion($miliseconds) {
            echo '<script type="text/javascript">
                    window.setTimeout(function(){window.location.replace('.$host.'"/server/close_session.php")},'.$miliseconds.');
                </script>';
        }
    }
    $router = new router;
?>