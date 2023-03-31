FROM php:8.2-fpm-alpine

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
    imagemagick-dev \
    && docker-php-ext-install soap gd curl zip pdo pdo_pgsql pdo_mysql mbstring exif pcntl bcmath opcache imagick\
    && docker-php-ext-enable soap gd curl zip pdo pdo_pgsql pdo_mysql mbstring exif pcntl bcmath opcache imagick

# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#add jit compiler
RUN echo 'opcache.jit_buffer_size=100M' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'opcache.jit=1235' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

# add composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


ARG PUID=33
ARG PGID=33
# RUN groupmod -g $PGID www-data \
#     && usermod -u $PUID www-data

RUN chown -R www-data:www-data /var/www
RUN chmod 755 -R /var/www

# COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# CMD ["curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer"]
