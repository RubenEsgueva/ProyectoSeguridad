<?php
    echo '
    <link rel="stylesheet" href="/src/components/sidebar/sidebar.css">
    <aside class="sidebar_modificar">
        <img class="usuario_img_sidebar_modificar" src="" alt="Foto de perfil">
        <button class="cerrar_sidebar_modificar">Cerrar</button>
        <form action="/server/modificar_usuario.php" method="post">
            <p class="datos_usuario"> Usuario: '.$_SESSION['user_data']['usuario'].'</p>
            <p class="datos_usuario"> Contraseña: <input type="password" name="pswd" placeholder="****"></p>
            <p class="datos_usuario"> Repetir contraseña: <input type="password" name="pswd2" placeholder="****"></p>
            <p class="datos_usuario"> Nombre: <input type="text" name="Nombre" placeholder="Nombre"></p>
            <p class="datos_usuario"> Apellido: <input type="text" name="Apellido" placeholder="Apellido"></p>
            <p class="datos_usuario"> DNI: '.$_SESSION['user_data']['DNI'].'</p>
            <p class="datos_usuario"> Telefono: <input type="text" name="Telefono" placeholder="Telefono"></p>
            <p class="datos_usuario"> Telefono: <input type="text" name="FechaNcto" placeholder="Fecha Nacimiento"></p>
            <p class="datos_usuario"> Email: <input type="text" name="email" placeholder="Email"></p>
            <input type="submit" value="Aceptar" class="aceptar_modificacion">
        </form>
        <button class="cancelar_modificacion">Cancelar</button>
        ';
        if ($_SESSION['error_modi'] !== '') {
            //si hay algun error al modificar esto notificara al usuario
            echo '<p class="error">Error: El campo '.$_SESSION['error_modi'].' tiene mal formato.</p>';
        }
    echo '
    </aside>
    <aside class="sidebar">
        <img class="usuario_img_sidebar" src="" alt="Foto de perfil">
        <button class="cerrar_sidebar">Cerrar</button>
        <p class="datos_usuario"> Usuario: '.$_SESSION['user_data']['usuario'].'</p>
        <p class="datos_usuario"> Contraseña: '."********".'</p>
        <p class="datos_usuario"> Nombre: '.$_SESSION['user_data']['Nombre'].' '.$_SESSION['user_data']['Apellido'].'</p>
        <p class="datos_usuario">DNI: '.$_SESSION['user_data']['DNI'].'</p>
        <p class="datos_usuario">Telefono: '.$_SESSION['user_data']['Telefono'].'</p>
        <p class="datos_usuario">Fecha Nacimiento: '.$_SESSION['user_data']['FechaNcto'].'</p>
        <p class="datos_usuario">Email: '.$_SESSION['user_data']['email'].'</p>
        <button class="modificar_datos">Modificar datos</button>
        <button class="cerrar_sesion">Cerrar Sesión</button>
        <button class="iniciar_sesion">Iniciar Sesión</button>
        <button class="registrarse">Registrarse</button>
    </aside>
    <script src="/src/components/sidebar/sidebar.js"></script>';
?>
