FROM dunglas/frankenphp:latest-builder-php8.2-alpine

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
    libsodium-dev

# Install php extensions
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions \
    @composer \
    redis-stable \
    bcmath \
    calendar \
    exif \
    gd \
    intl \
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

# INSTALL AND UPDATE COMPOSER
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer self-update --2

# Set working directory
WORKDIR /app

# Copy application files
COPY . /app

# INSTALL YOUR DEPENDENCIES
RUN composer install

# Ensure permissions are correct
RUN chown -R www-data:www-data /app \
    && chmod 755 -R /app

EXPOSE 80 443 8000

# Healthcheck
HEALTHCHECK --interval=15m --timeout=3s \
    CMD curl --fail http://localhost/ || exit 1
