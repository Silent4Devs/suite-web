FROM php:8.2-fpm-alpine

# Add docker-php-extension-installer script
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install system dependencies
# RUN apt-get update &&\
#     apt-get install -y \
#     libcurl4-openssl-dev \
#     libzip-dev \
#     build-essential \
#     git \
#     curl \
#     libpng-dev \
#     libjpeg-dev \
#     libfreetype6-dev \
#     libjpeg62-turbo-dev \
#     libmcrypt-dev \
#     libgd-dev \
#     jpegoptim optipng pngquant gifsicle \
#     libonig-dev \
#     libxml2-dev \
#     zip \
#     sudo \
#     unzip \
#     npm \
#     nodejs \
#     libpq-dev \
#     && rm -rf /var/lib/apt/lists/* \
#     # Install PHP extensions
#     && docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
#     && docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd curl soap zip pdo mbstring exif bcmath opcache \
#     && docker-php-ext-enable pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd curl soap zip pdo mbstring exif bcmath opcache \
#     # add composer
#     && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN apk add --no-cache \
    bash \
    curl \
    freetype-dev \
    g++ \
    gcc \
    git \
    icu-dev \
    icu-libs \
    libc-dev \
    libzip-dev \
    make \
    mysql-client \
    nodejs \
    npm \
    oniguruma-dev \
    yarn \
    openssh-client \
    postgresql-libs \
    rsync \
    zlib-dev\
    && docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd curl soap zip pdo mbstring exif bcmath opcache \
    && docker-php-ext-enable pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd curl soap zip pdo mbstring exif bcmath opcache \
    # add composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install php extensions
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions \
    @composer \
    redis-stable \
    imagick-stable \
    xdebug-stable \
    bcmath \
    calendar \
    exif \
    gd \
    intl \
    pdo_mysql \
    pdo_pgsql \
    pcntl \
    soap \
    zip

# Add local and global vendor bin to PATH.
ENV PATH ./vendor/bin:/composer/vendor/bin:/root/.composer/vendor/bin:/usr/local/bin:$PATH

# Install PHP_CodeSniffer
RUN composer global require "squizlabs/php_codesniffer=*"

# add permissions
# ARG PUID=33
# ARG PGID=33

RUN chown -R www-data:www-data /var/www \
    && chmod 755 -R /var/www

# Increase memory_limit
#RUN echo 'memory_limit = 0M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini

# Add opcache config, jit compiler and file size config
RUN echo 'memory_limit = 10000M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini \
    && echo 'opcache.enable=1' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'opcache.enable_cli=1' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'opcache.jit_buffer_size=5120M' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'opcache.jit=1235' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'upload_max_filesize = 10000M' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'post_max_size = 10000M' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'upload_max_filesize = 10000M' >> /usr/local/etc/php/conf.d/docker-php-upload.ini \
    && echo 'post_max_size = 10000M' >> /usr/local/etc/php/conf.d/docker-php-upload.ini \
    && echo 'max_file_uploads = 10000' >> /usr/local/etc/php/conf.d/docker-php-upload.ini \
    && echo 'max_execution_time = 1800' >> /usr/local/etc/php/conf.d/docker-php-execution.ini \
    && echo 'max_input_time = 1800' >> /usr/local/etc/php/conf.d/docker-php-execution.ini \
    # Add PHP-FPM config
    && echo 'pm.max_children = 50' >> /usr/local/etc/php-fpm.d/www.conf \
    && echo 'pm.start_servers = 5' >> /usr/local/etc/php-fpm.d/www.conf \
    && echo 'pm.min_spare_servers = 5' >> /usr/local/etc/php-fpm.d/www.conf \
    && echo 'pm.max_spare_servers = 35' >> /usr/local/etc/php-fpm.d/www.conf

# WORKDIR /var/www/html
# COPY . .
# RUN composer install

# Healthcheck
HEALTHCHECK --interval=15m --timeout=3s \
    CMD curl --fail http://localhost/ || exit 1

