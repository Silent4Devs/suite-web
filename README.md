<p align="center"><img src="public/img/Silent4Business-Logo-Color.png" width="400"></p>

[![Build and Test](https://github.com/Silent4Devs/suite-web/actions/workflows/build-test.yml/badge.svg?branch=develop)](https://github.com/Silent4Devs/suite-web/actions/workflows/build-test.yml)
[![Check code quality](https://github.com/Silent4Devs/suite-web/actions/workflows/code-style.yml/badge.svg)](https://github.com/Silent4Devs/suite-web/actions/workflows/code-style.yml)
[![Dependencies Security checks](https://github.com/Silent4Devs/suite-web/actions/workflows/security-check.yml/badge.svg)](https://github.com/Silent4Devs/suite-web/actions/workflows/security-check.yml)
[![DevSecOps and Docker build](https://github.com/Silent4Devs/suite-web/actions/workflows/devsecops.yml/badge.svg)](https://github.com/Silent4Devs/suite-web/actions/workflows/devsecops.yml)
[![Docker Compose build and test](https://github.com/Silent4Devs/suite-web/actions/workflows/container-build.yml/badge.svg)](https://github.com/Silent4Devs/suite-web/actions/workflows/container-build.yml)


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

1. docker compose build

## Levantamiento en Producción

2. docker compose up -d

## Levantamiento en Staging

3. docker compose -f docker-compose.staging.yml up -d

Instalación:

1. docker compose exec php composer install --no-dev
2. docker compose exec php cp .env.example .env
3. docker compose exec php php artisan key:generate
4. docker compose exec php php artisan migrate
5. docker compose exec php chmod 777 -R storage
6. docker compose exec php php artisan preload:placeholder
7. docker compose exec php php artisan optimize:clear

Ojo: si te sale algún error es porque no tienes permisos root en las carpetas de tu proyecto o que no existen las carpetas de caché, para esto tengo 2 comandos para ti.

# para obtener permisos dentro del servicio php

docker compose exec php chown -R www-data: /var/www/html

# para crear las carpetas del proyecto de php desde la carpeta src

pwd# debe decir que estas enla carpeta src
<br>
mkdir storage/framework/{views, testing, sessions, cache/data}

# mysql

#Enter to the running container
docker compose exec postgres-tabantaj /bin/bash

#Backup
<ul>
<li>
sudo docker exec -i fa63d8e7e87b bash -c "PGPASSWORD='secret' pg_dump -U homestead -h localhost -d homestead" > dump.sql
</li>
</ul>

#Restore
<ol>
<li>Ensure that you have the PostgreSQL 14 container up and running.</li>
<li>Locate the local dump file (backup.sql) and copy it into the container using the docker cp command:</li>
docker cp backup.sql container_id:/backup.sql
<li>Access the PostgreSQL 16 container using docker exec:</li>
<li>docker exec -it container_id bash</li>
<li>cd /</li>
<li>createdb -U postgres database_name</li>
<li>psql -U postgres -d database_name -f /backup.sql</li>
</ol>
