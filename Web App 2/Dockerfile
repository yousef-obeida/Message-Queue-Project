FROM php:8.4-apache

# Install system dependencies
RUN apt-get update && apt-get install -y unzip git

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory and copy files
WORKDIR /var/www/html
COPY . .

# Install PHP dependencies
RUN composer install

EXPOSE 80