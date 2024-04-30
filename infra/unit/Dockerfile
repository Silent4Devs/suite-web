# Use unit:php as the base image
FROM unit:php8.2

# Prepare workfir
RUN mkdir -p /var/www/html
RUN mkdir -p /var/www/html/databasestore
WORKDIR /var/www/html

# Set timezone
ENV TZ=America/Mexico_City

# Add docker-php-extension-installer script
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install dependencies
RUN apt-get update && apt-get install -y \
    bash \
    curl \
    libfreetype6-dev \
    g++ \
    gcc \
    git \
    libicu-dev \
    #libicu63 \
    libc-dev \
    libzip-dev \
    libpq-dev \
    make \
    #mysql-client \
    nodejs \
    npm \
    libonig-dev \
    yarn \
    openssh-client \
    libpq5 \
    postgresql-client \
    rsync \
    zlib1g-dev \
    sudo \
    zip \
    unzip \
    libsodium-dev \
    cron

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
    posix

COPY config.json /docker-entrypoint.d/config.json

COPY entrypoint.sh /docker-entrypoint.d/entrypoint.sh
# If you want to include entrypoint.sh, uncomment the line above

RUN chmod +x /docker-entrypoint.d/entrypoint.sh
# If entrypoint.sh needs execution permission,
EXPOSE 9090
