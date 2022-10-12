sudo docker build -t="carshow" .
sudo docker-compose up -d
mysql_container_id=$(sudo docker container ls | grep mysql | cut -d " " -f 1)
sudo docker exec -i $mysql_container_id sh -c 'exec mysql -uadmin -padmin1234' < "$(pwd)/database/database.sql"
firefox "http://localhost:81/index.php"

#sudo docker-compose ps #Muestra los servivios abiertos en este proyecto
#sudo docker-compose exec db mysql -uadmin -padmin1234 #Obtener shell de mysql del servidor (obviamente inseguro porue cualquiera puede ejecutar)
