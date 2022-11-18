#!/bin/bash
hoy=$(date -d "today" '+%d-%m-%Y')
ayer=$(date -d "yesterday" '+%d-%m-%Y')

rsync -av --link-dest=/var/backups/$ayer/basedatos /var/lib/mysql/COCHES /var/backups/$hoy/basedatos
rsync -av --link-dest=/var/backups/$ayer/logs /var/log/apache2 /var/backups/$hoy/logs

#if $hoy es domingo, entonces subir el backup a drive o github o etc...
