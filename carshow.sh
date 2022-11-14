#!/bin/bash

if [[ "$(whoami)" != "root" ]]; then
    echo -e "[!] Error: Debes ejecutar el script como usuario root. \"sudo ./init.sh\""
    exit 1
fi

echo -e "Selecciona una opcion:\n"
echo -e "\t[1] Instalar dependencias."
echo -e "\t[2] Iniciar el servidor."
echo -e "\t[3] Apagar el servidor."
echo -e "\t[4] Reiniciar el servidor."
echo -e "\t[5] Mostrar el estado de los servicios de la web."
echo -e "\t[6] Obtener una shell del codigo fuente."
echo -e "\t[7] Obtener una shell de la base de datos mysql."
echo -e "\t[8] Inicializar la base de datos mysql."
echo -e "\t[9] Configurar cron para realizar backups."
echo -e "\t[10] Mostrar logs del servidor web."
echo ""
read -p "Opcion: " option
echo ""

function instalarDependencias() {
    apt install docker docker-compose -y
}

function iniciarServidor() {
    chmod +x backup.sh
    sudo systemctl start docker
    docker build -t="carshow" .
    docker-compose up -d
    docker container ls &> /dev/null
    inicializarBaseDeDatos
    usuario="www-data"
    docker exec -i carshow_web_1 /bin/bash -c "chown $usuario:$usuario /var/www/html/public" &> /dev/null
    docker exec -i carshow_web_1 /bin/bash -c "chmod -R 0755 /var/www/html/public" &> /dev/null
    echo -e "\n[OK] Todo listo, visita la siguiente direccion en tu navegador: http://localhost:81/index.php"
    #firefox "http://localhost:81/index.php"
}

function apagarServidor() {
    chmod -x backup.sh
    docker-compose down
    rm -rf mysql 2&> /dev/null
}
function reiniciarServidor() {
    apagarServidor
    iniciarServidor
}

function estadoServiciosDocker() {
    docker-compose ps
}

function obtenerShellCodigoFuente() {
    docker exec -it carshow_web_1 /bin/bash
}

function obtenerShellMysql() {
    docker-compose exec db mysql -uadmin -padmin1234
}

function inicializarBaseDeDatos() {
    echo -e "[*] Cargando toda la base de datos..."
    mysql_container_id=$(docker container ls | grep mysql | cut -d " " -f 1)
    docker exec -i $mysql_container_id sh -c 'exec mysql -uroot -proot1234' < "$(pwd)/database/database.sql" &> /dev/null
    while [[ "$?" == "1" ]]; do
        docker exec -i $mysql_container_id sh -c 'exec mysql -uroot -proot1234' < "$(pwd)/database/database.sql" &> /dev/null
    done
    echo -e "\n[OK] Base de datos inicializada."
}

function configurarCron() {
    crontab -e
}

function mostrarLogs() {
    echo "Todavía no está implementado visualizar los logs..."
}

case $option in
    1) instalarDependencias;;
    2) iniciarServidor;;
    3) apagarServidor;;
    4) reiniciarServidor;;
    5) estadoServiciosDocker;;
    6) obtenerShellCodigoFuente;;
    7) obtenerShellMysql;;
    8) inicializarBaseDeDatos;;
    9) configurarCron;;
    10) mostrarLogs;;
    *) echo "Opcion no valida";;
esac

#sudo groupadd docker
#sudo usermod -aG docker $USER
#sudo gpasswd -a $USER docker
