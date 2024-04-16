FROM php:8.2-fpm-alpine

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
    make \
    #mysql-client \
    nodejs \
    npm \
    oniguruma-dev \
    yarn \
    openssh-client \
    postgresql-libs \
    rsync \
    zlib-dev \
    sudo \
    zip \
    unzip \
    libsodium-dev \
    dcron

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

# Enable phpredis extension
#RUN echo "extension=redis.so" > /usr/local/etc/php/conf.d/docker-php-ext-redis.ini

# Copy custom php.ini
COPY php.ini /usr/local/etc/php/php.ini

# Copy custom www.conf
COPY www.conf /usr/local/etc/php-fpm.d/www.conf

RUN chown -R www-data:www-data /var/www \
    && chmod 755 -R /var/www

# Install npm
RUN npm install -g npm@latest

# Healthcheck
HEALTHCHECK --interval=15m --timeout=3s \
    CMD curl --fail http://localhost/ || exit 1

RUN curl -L https://download.newrelic.com/php_agent/archive/10.10.0.1/newrelic-php5-10.10.0.1-linux.tar.gz | tar -C /tmp -zx \
    && export NR_INSTALL_USE_CP_NOT_LN=1 \
    && export NR_INSTALL_SILENT=1 \
    && /tmp/newrelic-php5-10.10.0.1-linux/newrelic-install install \
    && rm -rf /tmp/newrelic-php5-* /tmp/nrinstall*

RUN find /etc /opt/etc /usr/local/etc -type f -name newrelic.ini \
    -exec sed -i \
    -e "s/newrelic.license[[:space:]]=[[:space:]].*/newrelic.license = 4125e930d3e3d4e0ee11b9017af9447dFFFFNRAL/" \
    -e "s/newrelic.appname[[:space:]]=[[:space:]].*/newrelic.appname = \"TabantajProd\"/" \
    -e '$anewrelic.daemon.address="newrelic-php-daemon:31339"' {} \; 2>/dev/null
