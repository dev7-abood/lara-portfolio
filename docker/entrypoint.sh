#!/bin/sh

# Run Laravel storage link
php artisan storage:link || true

# Fix permissions for storage and cache
chown -R www-data:www-data storage bootstrap/cache

# Start PHP-FPM
exec php-fpm
