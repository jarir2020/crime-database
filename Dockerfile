# Multi-stage build for Laravel Crime Database Application
# Stage 1: Build Frontend Assets
FROM node:20-alpine AS frontend-builder
WORKDIR /build

# Copy package files
COPY package.json package-lock.json ./

# Install dependencies
RUN npm ci

# Copy source files
COPY . .

# Build assets
RUN npm run build

# Stage 2: PHP Application
FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install required PHP extensions and system dependencies
RUN apk add --no-cache \
    curl \
    git \
    unzip \
    postgresql-libs \
    postgresql-dev \
    sqlite-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libxml2-dev \
    oniguruma-dev \
    libzip-dev \
    curl-dev \
    supervisor \
    && docker-php-ext-configure pdo_pgsql \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_sqlite \
    pdo_pgsql \
    gd \
    bcmath \
    xml \
    mbstring \
    zip \
    curl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files from build context
COPY . /var/www/html

# Copy built assets from frontend builder
COPY --from=frontend-builder /build/public/build /var/www/html/public/build

# Install PHP dependencies
RUN composer install --no-dev --no-interaction --prefer-dist --no-scripts \
    && composer clear-cache \
    && php artisan package:discover --ansi

# Create necessary directories and set permissions
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Copy supervisor configuration
COPY docker/supervisor.conf /etc/supervisor/conf.d/laravel.conf

# Generate Laravel key
RUN php artisan key:generate --force || true

# Expose port
EXPOSE 9000

# Create entrypoint script
RUN echo '#!/bin/sh' > /usr/local/bin/entrypoint.sh && \
    echo 'cd /var/www/html' >> /usr/local/bin/entrypoint.sh && \
    echo 'php artisan migrate --force' >> /usr/local/bin/entrypoint.sh && \
    echo 'php-fpm' >> /usr/local/bin/entrypoint.sh && \
    chmod +x /usr/local/bin/entrypoint.sh

# Set user
USER www-data

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
