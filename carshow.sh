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
echo -e "\t[6] Imprimir logs de docker de una imagen o servicio (si hay algún error y no se monta)"
echo -e "\t[7] Obtener una shell del codigo fuente."
echo -e "\t[8] Obtener una shell de la base de datos mysql."
echo -e "\t[9] Inicializar la base de datos mysql."
echo -e "\t[10] Configurar cron para realizar backups."
echo -e "\t[11] Mostrar logs del servidor web."
echo ""
read -p "Opcion: " option
echo ""

function instalarDependencias() {
    dependencias="docker docker-compose openssl cronie"
    ls /bin/pacman &> /dev/null
    if [[ "$?" != "0" ]]; then
        pacman -S $dependencias --noconfirm
    fi
    ls /bin/apt &> /dev/null
    if [[ "$?" != "0" ]]; then
        apt install $dependencias -y
    fi
}

function iniciarServidor() {
    #sudo echo "127.0.0.1  localhost durruti" >> /etc/hosts
    mkdir backups &> /dev/null
    mkdir logs &> /dev/null
    chmod 777 logs &> /dev/null
    docker exec -i carshow-web-1 /bin/bash -c "sudo chmod 777 /var/log/apache2" &> /dev/null
    cat crontabs &> /dev/null
    if [[ "$?" != "0" ]]; then
        echo "0 0 * * * $(pwd)/backup.sh" > crontabs
    fi
    cp crontabs > /var/spool/cron/carshow &> /dev/null
    config="virtualhost/carshow.conf"
    sudo rm -f virtualhost/carshow.conf &> /dev/null
    mkdir virtualhost &> /dev/null
    echo "<VirtualHost *:80>" >> $config
    #echo "      Redirect / https://'$(curl ifconfig.me)'" >> $config
    echo "      Redirect / https://localhost:443" >> $config
    echo "</VirtualHost>" >> $config
    echo "" >> $config
    echo "<VirtualHost *:444>" >> $config
    echo "      SSLEngine on" >> $config
    echo "      SSLCertificateFile /etc/apache2/ssl/certificado.crt" >> $config
    echo "      SSLCertificateKeyFile /etc/apache2/ssl/llave.key" >> $config
    echo "      SSLCertificateChainFile /etc/apache2/ssl/servidor.csr" >> $config
    #echo "      SSLCACertificateFile /etc/apache2/ssl/certificado.ca" >> $config
    echo "      ServerAdmin example@localhost.com" >> $config
    echo "      <Directory /var/www/html/>" >> $config
    echo "              AllowOverride all" >> $config
    echo "      </Directory>" >> $config
    echo "      DocumentRoot /var/www/html/" >> $config
    echo "      ErrorLog /var/log/apache2/error.log" >> $config
    echo "      LogLevel warn" >> $config
    echo "      CustomLog /var/log/apache2/error.log combined" >> $config
    echo "</VirtualHost>" >> $config
    /bin/cat virtualhost/certificados/certificado.crt &> /dev/null
    if [[ "$?" != "0" ]]; then
        mkdir virtualhost/certificados &> /dev/null
        openssl genrsa -out virtualhost/certificados/llave.key 2048
        openssl req -new -key virtualhost/certificados/llave.key -out virtualhost/certificados/servidor.csr
        openssl x509 -req -days 365 -in virtualhost/certificados/servidor.csr -signkey virtualhost/certificados/llave.key -out virtualhost/certificados/certificado.crt
    fi
    chmod +x backup.sh &> /dev/null
    sudo systemctl start docker
    docker build -t="carshow" .
    docker-compose up -d
    docker container ls &> /dev/null
    inicializarBaseDeDatos
    usuario="www-data"
    docker exec -i carshow-web-1 /bin/bash -c "chown $usuario:$usuario /var/www/html/public" &> /dev/null
    docker exec -i carshow-web-1 /bin/bash -c "chmod -R 0755 /var/www/html/public" &> /dev/null
    echo -e "\n[OK] Todo listo, visita la siguiente direccion en tu navegador:" 
    echo -e "\t[*] http://localhost:81"
    echo -e "\t[*] https://localhost:444"
}

function apagarServidor() {
    #grep -v "127.0.0.1  localhost durruti" /etc/hosts > tmp.txt
    #sudo mv tmp.txt /etc/hosts
    rm -f /var/spool/cron/carshow
    chmod -x backup.sh &> /dev/null
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

function imprimirLogsDocker() {
    docker-compose ps | cut -d " " -f 1 | grep -v "NAME" > tmp.txt
    echo "Elige numero de la imagen de la que quieras imprimir los logs: "
    count="1"
    while read -r line; do
        echo -e "\t[$count] $line"
        count=$(($count+1))
    done < tmp.txt
    echo "El if esta roto"
    read -p "Numero: " num
    if [[ "$num" -lt "$count" && "$num" -gt "0" ]]; then
        imagen="$(head -n $num tmp.txt | tail -n 1)"
        echo ""
        sudo docker logs $imagen
    else
        echo "$num no vale"
    fi
    rm tmp.txt
}

function obtenerShellCodigoFuente() {
    docker exec -it carshow-web-1 /bin/bash
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
    nano crontabs
}

function mostrarLogs() {
    docker exec -i carshow-web-1 /bin/bash -c "ls /var/log/apache2" > tmp.txt
    echo "Elige numero que quieras imprimir los logs: "
    count="1"
    while read -r line; do
        echo -e "\t[$count] $line"
        count=$(($count+1))
    done < tmp.txt
    read -p "Numero: " num
    if [[ "$num" -lt "$count" && "$num" -gt "0" ]]; then
        logfile="$(head -n $num tmp.txt | tail -n 1)"
        echo ""
        docker exec -i carshow-web-1 /bin/bash -c "cat /var/log/apache2/$logfile"
    else
        echo "$num no vale"
    fi
    rm tmp.txt
}

case $option in
    1) instalarDependencias;;
    2) iniciarServidor;;
    3) apagarServidor;;
    4) reiniciarServidor;;
    5) estadoServiciosDocker;;
    6) imprimirLogsDocker;;
    7) obtenerShellCodigoFuente;;
    8) obtenerShellMysql;;
    9) inicializarBaseDeDatos;;
    10) configurarCron;;
    11) mostrarLogs;;
    *) echo "Opcion no valida";;
esac

#sudo groupadd docker
#sudo usermod -aG docker $USER
#sudo gpasswd -a $USER docker
