# Use official PHP image
FROM php:8.3-fpm

# Install required packages, including Vim
RUN apt-get update && apt-get install -y \
    zip unzip curl libpng-dev libonig-dev libxml2-dev \
    libzip-dev libicu-dev vim nano \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

# Set working directory
WORKDIR /var/www

# Copy Laravel files
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose PHP-FPM port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
