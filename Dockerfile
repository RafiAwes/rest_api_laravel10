# Use the official PHP image as the base image
FROM php:7.4-fpm

# Set the working directory inside the container
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pdo_mysql

# Copy composer.json and composer.lock to install dependencies
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application code
COPY . .

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 5000
EXPOSE 5000

# Copy .env file
COPY .env.example .env

# Generate application key and migrate database
RUN php artisan key:generate
RUN php artisan migrate --seed

# Start PHP-FPM
CMD ["php-fpm"]
