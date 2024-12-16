FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Set working directory
WORKDIR /var/www

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . /var/www

# Install application dependencies
RUN composer install

# Set permissions
RUN chown -R www-data:www-data /var/www/storage

# Pastikan ekstensi MySQL PHP terpasang
RUN docker-php-ext-install pdo pdo_mysql

# Expose port 8080
EXPOSE 8080

# Start Apache
CMD ["apache2-foreground"]