# ProyectoSeguridad
Miembros: Leire Becerra, Unai Elorriaga y Rubén Esgueva.
Pasos a seguir:
  # Si no se ha hecho previamente:
    $sudo groupadd docker
    $sudo usermod -aG docker $USER
  Ir a la carpeta en la que se ha extraido el proyecto y ejecutar: $sudo ./carshow.sh
  # La primera vez que se utiliza:
    Seleccionar la primera opción escribiendo '1' en la terminal.
  Una vez hecho esto se vuelve a ejecutar el comando: $sudo ./carshow.sh
  Se selecciona la acción que se desea realizar escribiendo el número por la terminal.
  
Para la preentrega la aplicación no se puede navegar aún, por lo que por favor solo prueba que se instale bien y que se ha cargado correctamente la base de datos.
  Para esto tras iniciar el servidor (opción 2) seleccione la opción 7 para abrir mysql, y ejecute los siguientes comandos:
    mysql>USE COCHES;
    mysql>SHOW TABLES;
  si se muestran las tablas "USUARIOS" y "COCHES" entonces se ha cargado correctamente.
