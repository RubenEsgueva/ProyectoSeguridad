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
echo ""
read -p "Opcion: " option
echo ""

function instalarDependencias() {
    apt install docker docker-compose -y
}

function iniciarServidor() {
    docker build -t="carshow" .
    docker-compose up -d
    mysql_container_id=$(docker container ls | grep mysql | cut -d " " -f 1)
    docker container ls &> /dev/null
    echo -e "[*] Cargando toda la base de datos..."
    docker exec -i $mysql_container_id sh -c 'exec mysql -uroot -proot1234' < "$(pwd)/database/database.sql" &> /dev/null
    while [[ "$?" == "1" ]]; do
        docker exec -i $mysql_container_id sh -c 'exec mysql -uroot -proot1234' < "$(pwd)/database/database.sql" &> /dev/null
    done
    echo -e "\n[OK] Todo listo, visita la siguiente direccion en tu navegador: http://localhost:81/index.php"
    #firefox "http://localhost:81/index.php"
}

function apagarServidor() {
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

case $option in
    1) instalarDependencias;;
    2) iniciarServidor;;
    3) apagarServidor;;
    4) reiniciarServidor;;
    5) estadoServiciosDocker;;
    6) obtenerShellCodigoFuente;;
    7) obtenerShellMysql;;
    *) echo "Opcion no valida";;
esac

#sudo groupadd docker
#sudo usermod -aG docker $USER
#sudo gpasswd -a $USER docker
