FROM php:8.2-fpm
#FROM serversideup/php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libcurl4-openssl-dev \
    libzip-dev \
    build-essential \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    #libjpeg62-turbo-dev \
    libmcrypt-dev \
    libgd-dev \
    jpegoptim optipng pngquant gifsicle \
    libonig-dev \
    libxml2-dev \
    zip \
    sudo \
    unzip \
    # npm \
    # nodejs \
    libpq-dev \
    cron \
    supervisor \
    && rm -rf /var/lib/apt/lists/* \
    # Install PHP extensions
    && docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd curl soap zip pdo mbstring exif bcmath opcache \
    && pecl install apcu \
    && docker-php-ext-enable pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd curl soap zip pdo mbstring exif bcmath opcache apcu\
    # Add composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add permissions
# ARG PUID=33
# ARG PGID=33

RUN chown -R www-data:www-data /var/www \
    && chmod 755 -R /var/www

# Add opcache and other config settings
RUN echo 'opcache.memory_consumption=256' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'opcache.interned_strings_buffer=16' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'opcache.max_accelerated_files=5000' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'memory_limit = 512M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini \
    && echo 'opcache.enable=1' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'opcache.enable_cli=1' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'opcache.jit_buffer_size=5120M' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'opcache.jit=1235' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'upload_max_filesize = 10000M' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'post_max_size = 10000M' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo 'upload_max_filesize = 10000M' >> /usr/local/etc/php/conf.d/docker-php-upload.ini \
    && echo 'post_max_size = 10000M' >> /usr/local/etc/php/conf.d/docker-php-upload.ini \
    && echo 'max_file_uploads = 10000' >> /usr/local/etc/php/conf.d/docker-php-upload.ini \
    && echo 'max_execution_time = 3600' >> /usr/local/etc/php/conf.d/docker-php-execution.ini \
    && echo 'max_input_time = 3600' >> /usr/local/etc/php/conf.d/docker-php-execution.ini

# WORKDIR /var/www/html
# COPY . .
#automatic backups
COPY ./infra/supervisor/supervisor.conf /etc/supervisor/conf.d/supervisord.conf
# RUN composer install --optimize-autoloader

CMD ["/usr/bin/supervisord"]

# Healthcheck
HEALTHCHECK --interval=15m --timeout=3s \
    CMD curl --fail http://localhost/ || exit 1
