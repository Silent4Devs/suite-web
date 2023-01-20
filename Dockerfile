FROM php:8.1-fpm-alpine

RUN apk add postgresql-dev \
    oniguruma-dev \
    libzip-dev \
    curl-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    libxpm-dev \
    libmcrypt-dev \
    && docker-php-ext-install soap gd curl zip pdo pdo_pgsql pdo_mysql mbstring exif pcntl bcmath \
    && docker-php-ext-enable soap gd curl zip pdo pdo_pgsql pdo_mysql mbstring exif pcntl bcmath

# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


ARG PUID=33
ARG PGID=33
# RUN groupmod -g $PGID www-data \
#     && usermod -u $PUID www-data

RUN chown -R www-data:www-data /var/www
RUN chmod 755 -R /var/www

# COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# CMD ["curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer"]
