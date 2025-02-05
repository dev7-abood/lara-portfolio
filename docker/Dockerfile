# Base stage: PHP with dependencies
FROM php:8.3.9-fpm AS base
WORKDIR /var/www/html

# Set environment variable for compiled views
ENV VIEW_COMPILED_PATH=/var/www/html/storage/framework/views

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libjpeg-dev libfreetype6-dev zip unzip libonig-dev libxml2-dev \
    libzip-dev libicu-dev g++ locales \
    && docker-php-ext-configure gd \
    && docker-php-ext-install gd pdo pdo_mysql mbstring xml bcmath opcache intl zip

# Add Git safe directory
RUN git config --global --add safe.directory /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Ensure required directories exist and have correct permissions
RUN mkdir -p storage/framework/{sessions,views,cache/data} bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Clear Laravel cache (ignore errors if cache not set up yet)
RUN php artisan cache:clear || true

# Install dependencies (this will trigger package discovery)
RUN composer install --no-dev --optimize-autoloader

# Configure Laravel optimizations (caches, routes, views)
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Production stage: Lightweight image
FROM php:8.3.9-fpm AS production
WORKDIR /var/www/html

# Copy optimized application from the base stage
COPY --from=base /var/www/html /var/www/html

# Set proper permissions for storage and cache directories
RUN chmod -R 775 storage bootstrap/cache && chown -R www-data:www-data storage bootstrap/cache

# Expose the default PHP-FPM port
EXPOSE 9000

# Run PHP-FPM
CMD ["php-fpm"]
