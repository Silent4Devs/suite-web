FROM php:8.0-fpm

#le pasamos los argumentos para la creación de usuarios
ARG user="laravel"
ARG uid=20

# Instalamos las dependencias que necesitará
RUN apt-get update && apt-get install -y \
    git \
    curl \
    vim \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# limpiamos cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
#RUN apt-get install gitlab-ci-multi-runner=1.11.1
# Instalamos extensiones PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# traemos la última versión de composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiamos de la última imagen de node en nuestro proyecto las librerías de los módulos y de node
COPY --from=node:latest /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node:latest /usr/local/bin/node /usr/local/bin/node
# Creamos un enlace virtual para poder utilizar directamente npm dentro de la máquina Docker:
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm


#creamos el usuario para ejecutar laravel y su directorio
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$usr



# nos posicionamos en el directorio y copiamos proyecto
WORKDIR /home/$user/
COPY [".", "."]
RUN chmod -R 777 storage
#instalamos composer
#RUN composer install --ignore-platform-reqs


#WORKDIR /home/$user/tabantaj
RUN composer install --ignore-platform-reqs --no-scripts
#RUN php artisan cache:clear
RUN php artisan config:cache
RUN cp .env.example .env
RUN php artisan config:clear
RUN php artisan key:generate
CMD php artisan serve --host=0.0.0.0 --port=8080
#EXPOSE 8080

USER $user
