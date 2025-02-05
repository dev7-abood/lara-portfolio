# Base stage: PHP with dependencies
FROM php:8.2-fpm AS base
WORKDIR /var/www/html

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

# Ensure cache and storage paths exist and have the right permissions
RUN mkdir -p storage/framework/{sessions,views,cache} bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Clear any existing cache (to prevent issues)
RUN php artisan cache:clear || true

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Configure Laravel optimizations
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Production stage: Lightweight image
FROM php:8.2-fpm AS production
WORKDIR /var/www/html

# Copy optimized application from the base stage
COPY --from=base /var/www/html /var/www/html

# Set proper permissions
RUN chmod -R 775 storage bootstrap/cache && chown -R www-data:www-data storage bootstrap/cache

# Expose default port
EXPOSE 9000

CMD ["php-fpm"]
