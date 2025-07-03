FROM php:8.4-fpm

# Install dependencies required for mbstring and others
RUN apt-get update \
 && apt-get install -y \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    unzip \
    zlib1g-dev \
    libonig-dev \
 && docker-php-ext-install \
    pdo_pgsql \
    mbstring \
    intl \
    zip \
 && apt-get clean \
 && rm -rf /var/lib/apt/lists/*

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer