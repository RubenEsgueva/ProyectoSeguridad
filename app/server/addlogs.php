<?php
    $ip=$_SERVER['REMOTE_ADDR'];
    $puerto=$_SERVER['SERVER_PORT'];
    if(empty($origen))
    {
        $origen="externo";
    }
    $userid=$_SESSION['usuario'];
    $current_user = trim(shell_exec('whoami'));
    $log  = $_SERVER['REMOTE_ADDR'].'-'.$puerto.'-'.$origen.'-'.$userid.'-'.date("F j, Y, g:i a").'-'.$enviado.'-'.$resultado.PHP_EOL;
    touch('/var/log/apache2/logs_'.date("j.n.Y").'.txt');
    file_put_contents('/var/log/apache2/logs_'.date("j.n.Y").'.txt', $log, FILE_APPEND);
?>
