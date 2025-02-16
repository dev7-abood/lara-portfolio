FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    zip unzip curl libpng-dev libonig-dev libxml2-dev \
    libzip-dev libicu-dev git vim \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

# Install the latest Composer version
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy Laravel files
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Set correct permissions (Fix: Removed non-existing path)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
