<img class="coche_img_modificar" src="" alt= "Foto del coche">
<form action="/server/detalles.php" method="post">
            <p class="datos_usuario"> Kilometraje:'.$_SESSION['user_data']['Kilometraje'].' </p>
            <p class="datos_usuario"> Estado: '.$_SESSION['user_data']['estado'].'</p>
            <p class="datos_usuario"> Precio: '.$_SESSION['user_data']['precio'].'</p>
            <p class="datos_usuario"> imagen: '.$_SESSION['user_data']['imagen'].'</p>
            <input type="submit" value="Aceptar" class="aceptar_modificacion">
</form>