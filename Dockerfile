FROM php:8.2-fpm
# Install system dependencies
RUN apt-get update &&\
    apt-get install -y \
    libcurl4-openssl-dev \
    libzip-dev \
    build-essential \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libgd-dev \
    jpegoptim optipng pngquant gifsicle \
    libonig-dev \
    libxml2-dev \
    zip \
    sudo \
    unzip \
    npm \
    nodejs \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/* \
    # Install PHP extensions
    && docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd curl soap zip pdo mbstring exif bcmath opcache \
    && docker-php-ext-enable pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd curl soap zip pdo mbstring exif bcmath opcache \
    # add composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# add permissions
# ARG PUID=33
# ARG PGID=33

RUN chown -R www-data:www-data /var/www \
    && chmod 755 -R /var/www

# Increase memory_limit
RUN echo 'memory_limit = 0M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini

# Add opcache config, jit compiler and file size config
RUN echo 'opcache.jit_buffer_size=100M' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'opcache.jit=1235' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'upload_max_filesize = 10000M' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'post_max_size = 10000M' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'upload_max_filesize = 10000M' >> /usr/local/etc/php/conf.d/docker-php-upload.ini \
    && echo 'post_max_size = 10000M' >> /usr/local/etc/php/conf.d/docker-php-upload.ini

# Healthcheck
HEALTHCHECK --interval=15m --timeout=3s \
    CMD curl --fail http://localhost/ || exit 1

