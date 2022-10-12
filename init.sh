echo "[*] Limpiando archivos conflictivos..."
sudo docker-compose down
sudo rm -rf mysql 2&> /dev/null #¿Borra todos los datos de la base de datos?
echo "[*] Montando la imagen principal del proyecto en docker..."
sudo docker build -t="carshow" . > /dev/null
echo "[*] Ejecutando todos los servicios de la pagina web en contenerdores..."
sudo docker-compose up --remove-orphans -d > /dev/null
mysql_container_id=$(sudo docker container ls | grep mysql | cut -d " " -f 1)
#echo $mysql_container_id
#sudo chmod 750 "/var/lib/mysql/#innodb_redo"
#sudo chmod 640 "/var/lib/mysql/#innodb_redo/#ib_redo*"
echo "[*] Inicializando la base de datos..."
sleep 8
sudo systemctl restart mysql
sudo systemctl restart mysqld
sudo docker exec -i $mysql_container_id sh -c 'exec mysql -uadmin -padmin1234' < "$(pwd)/database/database.sql" > /dev/null
echo ""
echo "[*] Todo listo, visita la siguiente direccion en tu navegador: http://localhost:81/index.php"
#firefox "http://localhost:81/index.php"

#sudo docker-compose ps #Muestra los servivios abiertos en este proyecto
#sudo docker-compose exec db mysql -uadmin -padmin1234 #Obtener shell de mysql del servidor (obviamente inseguro porue cualquiera puede ejecutar)
