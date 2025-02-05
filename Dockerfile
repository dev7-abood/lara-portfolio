# Set base image for PHP 8.2
FROM php:8.2-fpm AS base

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-configure gd \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql mbstring xml opcache bcmath

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Laravel application files
COPY . .

# Install dependencies based on environment
ARG APP_ENV=production
RUN if [ "$APP_ENV" = "production" ]; then \
        composer install --no-dev --optimize-autoloader; \
    else \
        composer install; \
    fi

# Set permissions for Laravel storage and bootstrap cache
RUN chmod -R 775 storage bootstrap/cache && chown -R www-data:www-data storage bootstrap/cache

# Configure Laravel Optimizations
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Multi-stage for Nginx (final image)
FROM nginx:alpine AS final

# Set working directory
WORKDIR /var/www/html

# Copy application files from the base stage
COPY --from=base /var/www/html /var/www/html

# Copy Nginx config
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Expose ports
EXPOSE 80 443

# Start Nginx and PHP-FPM
CMD ["nginx", "-g", "daemon off;"]
