#!/bin/sh

# Make sure all required Laravel dirs exist
mkdir -p /app/storage/framework/cache
mkdir -p /app/storage/framework/sessions
mkdir -p /app/storage/framework/views

# Generate a key if we do not have one
if ! grep -q "^APP_KEY=" ".env" || [ -z "$(grep "^APP_KEY=" ".env" | cut -d '=' -f2)" ]; then
    php artisan key:generate
fi

# Run migrations
php artisan migrate --force

# Start supervisor
/usr/bin/supervisord -c supervisor.conf