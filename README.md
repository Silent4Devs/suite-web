<p align="center"><img src="public/img/Silent4Business-Logo-Color.png" width="400"></p>

# tabantaj S4B

El proyecto se tiene que clonar dentro de la carpeta raiz en donde se publiquen las URL


# Archivos

Una vez descargado se deben correr los siguientes comandos en este orden:

 1. composer install
 2. npm install
 3. npm run dev
 4. php artisan migrate --seed
 5. cargar triggers de la carpeta trigger

## ¡Alerta!

Si vas  a constribuir dentro del proyecto recuerda que cada cambio que se realice debe partir de una branch bifurcada de develop

## Si has sido invitado a este proyecto

Si has sido invitado a este repositorio recuerda que no puedes hacer un push o merge directamente a otra rama, siempre debera realizarse un pull request

<br>

# En caso de usar Docker

Para usarlo debes tener instalado Docker previamente.

Corriendo el proyecto:

1. docker-compose build
2. docker-compose up -d


Instalación:

1. docker-compose exec php composer install --ignore-platform-reqs
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

