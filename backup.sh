#!/bin/bash
hoy=$(date -d "today" '+%d-%m-%Y')
ayer=$(date -d "yesterday" '+%d-%m-%Y')

rsync -av --link-dest=/var/tmp/Carshow-Backups/$ayer . /var/tmp/Carshow-Backups/$hoy
