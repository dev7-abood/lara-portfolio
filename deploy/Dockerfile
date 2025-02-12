# Stage 1: Build Stage
FROM php:8.2-fpm-alpine AS build

# Install required dependencies for PHP, Node.js, and NPM
RUN apk add --no-cache \
    zip \
    unzip \
    git \
    curl \
    bash \
    libzip-dev \
    freetype \
    libjpeg-turbo \
    libpng \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    icu \
    icu-dev \
    libintl \
    autoconf \
    g++ \
    make \
    nginx \
    npm \
    nodejs \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip pdo pdo_mysql intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && pecl install redis \
    && docker-php-ext-enable gd intl redis

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy application files
COPY . .

# ✅ Fix Git Ownership Issue
RUN git config --global --add safe.directory /var/www/html

# ✅ Ensure storage and cache directories exist
RUN mkdir -p storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# ✅ Install PHP, Node.js, and NPM dependencies
RUN composer install --no-dev --prefer-dist \
    && npm install \
    && npm run build

# ✅ Set correct ownership and permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Stage 2: Production Stage
FROM php:8.2-fpm-alpine

# Install Nginx and Node.js
RUN apk add --no-cache \
    nginx \
    npm \
    nodejs \
    && rm -rf /var/cache/apk/*

# Copy files from the build stage
COPY --from=build /var/www/html /var/www/html
COPY ./deploy/nginx.conf /etc/nginx/http.d/default.conf
COPY ./deploy/php.ini "$PHP_INI_DIR/conf.d/app.ini"

WORKDIR /var/www/html

# Define volumes for persistent storage
VOLUME ["/var/www/html/storage/app"]

# Start Nginx and PHP-FPM
CMD ["sh", "-c", "nginx && php-fpm"]
