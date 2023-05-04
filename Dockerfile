FROM php:8.2-fpm-alpine

RUN apk add --no-cache autoconf \
    postgresql-dev \
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
    c-client \
    imagemagick-dev \
    \
    # Install gd
    && ln -s /usr/lib/$(apk --print-arch)-linux-gnu/libXpm.* /usr/lib/ \
    && docker-php-ext-configure gd \
    --enable-gd \
    --with-webp \
    --with-jpeg \
    --with-xpm \
    --with-freetype \
    --enable-gd-jis-conv \
    && docker-php-ext-install -j$(nproc) gd \
    && true \
    \
    # # Install apcu
    # && pecl install apcu \
    # && docker-php-ext-enable apcu \
    # && true \
    # \
    && docker-php-ext-install soap gd curl zip pdo pdo_pgsql pdo_mysql mbstring exif pcntl bcmath opcache \
    && docker-php-ext-enable soap gd curl zip pdo pdo_pgsql pdo_mysql mbstring exif pcntl bcmath opcache \
    # \
    # # Install imagick
    # && pecl install imagick \
    # && docker-php-ext-enable imagick \
    # && true \
    # \
    # add composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# add permissions
ARG PUID=33
ARG PGID=33

RUN chown -R www-data:www-data /var/www \
    && chmod 755 -R /var/www

# Add opcache config, jit compiler and file size config
RUN echo 'opcache.jit_buffer_size=100M' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'opcache.jit=1235' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'upload_max_filesize = 10000M' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'post_max_size = 10000M' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'upload_max_filesize = 10000M' >> /usr/local/etc/php/conf.d/docker-php-upload.ini \
    && echo 'post_max_size = 10000M' >> /usr/local/etc/php/conf.d/docker-php-upload.ini
