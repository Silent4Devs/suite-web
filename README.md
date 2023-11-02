<p align="center"><img src="public/img/Silent4Business-Logo-Color.png" width="400"></p>

# Gestión normativa S4B

El proyecto se tiene que clonar dentro de la carpeta raiz en donde se publiquen las URL

# Archivos

Una vez descargado se deben correr los siguientes comandos en este orden:

1.  composer install
2.  npm install
3.  npm run dev

## ¡Alerta!

Si vas a constribuir dentro del proyecto recuerda que cada cambio que se realice debe partir de una branch bifurcada de develop

## Si has sido invitado a este proyecto

Si has sido invitado a este repositorio recuerda que no puedes hacer un push o merge directamente a otra rama, siempre debera realizarse un pull request

# En caso de usar Docker

Para usarlo debes tener instalado Docker previamente.

### Levantamiento en Local o Dev

Corriendo el proyecto:

1. docker-compose build

## Levantamiento en Producción

2. docker-compose up -d

## Levantamiento en Staging

3. docker-compose -f docker-compose.staging.yml up -d

Instalación:

1. docker-compose exec php composer install --no-dev
2. docker-compose exec php cp .env.example .env
3. docker-compose exec php php artisan key:generate
4. docker-compose exec php php artisan migrate
5. docker-compose exec php chmod 777 -R storage
6. docker-compose exec php php artisan optimize:clear

Ojo: si te sale algún error es porque no tienes permisos root en las carpetas de tu proyecto o que no existen las carpetas de caché, para esto tengo 2 comandos para ti.

# para obtener permisos dentro del servicio php

docker-compose exec php chown -R www-data: /var/www/html

# para crear las carpetas del proyecto de php desde la carpeta src

pwd# debe decir que estas enla carpeta src
<br>
mkdir storage/framework/{views, testing, sessions, cache/data}

# mysql

#Enter to the running container
docker-compose exec postgres-tabantaj /bin/bash

#Backup
sudo docker exec -i fa63d8e7e87b bash -c "PGPASSWORD='secret' pg_dump -U homestead -h localhost -d homestead" > dump.sql

#Restore
1.- Ensure that you have the PostgreSQL 14 container up and running.
2.- Locate the local dump file (backup.sql) and copy it into the container using the docker cp command:
docker cp backup.sql <container_id>:/backup.sql
3.- Access the PostgreSQL 14 container using docker exec:
4.- docker exec -it <container_id> bash
5.- cd /
6.- createdb -U postgres <database_name>
7.- psql -U postgres -d <database_name> -f /backup.sql
