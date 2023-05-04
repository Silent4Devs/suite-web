FROM php:8.2-fpm

RUN apt update && apt install -y --no-install-recommends \
    libpng-dev \
    libjpeg-dev \
    libwebp-dev \
    libfreetype6-dev \
    libxpm-dev \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    curl \
    git \
    unzip \
    && docker-php-ext-configure gd \
    --enable-gd \
    --with-webp \
    --with-jpeg \
    --with-xpm \
    --with-freetype \
    --enable-gd-jis-conv \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql mbstring exif pcntl bcmath opcache zip \
    && pecl install apcu imagick \
    && docker-php-ext-enable apcu imagick \
    && rm -rf /var/lib/apt/lists/* \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add opcache config, jit compiler and file size config
RUN echo 'opcache.jit_buffer_size=100M' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'opcache.jit=1235' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'upload_max_filesize = 10000M' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'post_max_size = 10000M' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'upload_max_filesize = 10000M' >> /usr/local/etc/php/conf.d/docker-php-upload.ini \
    && echo 'post_max_size = 10000M' >> /usr/local/etc/php/conf.d/docker-php-upload.ini

# Add permissions
ARG PUID=33
ARG PGID=33

RUN groupmod -g $PGID www-data && usermod -u $PUID www-data
