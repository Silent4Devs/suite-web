FROM shinsenter/php:8.2-roadrunner

# Add docker-php-extension-installer script
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

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
    libpq-dev \
    make \
    #mysql-client \
    nodejs \
    npm \
    oniguruma-dev \
    yarn \
    openssh-client \
    postgresql-libs \
    postgresql-client \
    rsync \
    zlib-dev \
    sudo \
    zip \
    unzip \
    libsodium-dev \
    # Install required libraries for FrankenPHP
    libevent-dev \
    libssl3

# Install php extensions
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions \
    @composer \
    redis-stable \
    #imagick-stable \
    #xdebug-stable \
    bcmath \
    calendar \
    exif \
    gd \
    intl \
    #pdo_mysql \
    pdo_pgsql \
    pcntl \
    soap \
    zip \
    apcu \
    opcache \
    sockets \
    sodium \
    excimer \
    pcntl \
    posix \
    amqp \
    ftp

# Enable phpredis extension
#RUN echo "extension=redis.so" > /usr/local/etc/php/conf.d/docker-php-ext-redis.ini

RUN chown -R www-data:www-data /var/www \
    && chmod 755 -R /var/www

# Healthcheck
HEALTHCHECK --interval=15m --timeout=3s \
    CMD curl --fail http://localhost/ || exit 1

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies including Laravel Octane
RUN composer install --no-dev --no-autoloader --no-ansi --no-scripts --audit

# Expose the port RoadRunner will run on
EXPOSE 9000

# Define the command to run Octane
CMD ["php", "artisan", "octane:start", "--server=roadrunner"]
