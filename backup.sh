#!/bin/bash
hoy=$(date -d "today" '+%d-%m-%Y')
ayer=$(date -d "yesterday" '+%d-%m-%Y')

rsync -av --link-dest=$(pwd)/backups/$ayer/basedatos $(pwd)/mysql/COCHES $(pwd)/backups/$hoy/basedatos
rsync -av --link-dest=$(pwd)/backups/$ayer/logs $(pwd)/logs $(pwd)/backups/$hoy/logs

diaSem=$(date -d "today" | cut -d " " -f 1)
if [[ "$diaSem" == "dom" ]]; then
    #Implementar subir el backup a un servicio en la nube
fi
