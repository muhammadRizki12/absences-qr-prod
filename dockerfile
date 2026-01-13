# Gunakan image PHP 8.2 FPM resmi berbasis Debian
FROM php:8.2-fpm

# Set working directory di dalam container
WORKDIR /var/www

# Install dependensi sistem yang diperlukan
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    locales \
    zip \
    unzip \
    git \
    curl \
    vim

# Bersihkan cache apt untuk mengurangi ukuran image
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Konfigurasi dan install ekstensi PHP GD
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Install ekstensi PHP lainnya yang dibutuhkan Laravel
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath

# Ambil Composer versi terbaru dari image resmi
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Salin seluruh kode proyek Laravel ke dalam container
COPY . /var/www

# Berikan izin akses (ownership) ke user www-data 
# agar Laravel bisa menulis log dan cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Container akan berjalan di port 9000
EXPOSE 9000

# Jalankan PHP-FPM
CMD ["php-fpm"]