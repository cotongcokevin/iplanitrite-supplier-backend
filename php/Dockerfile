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

# Set PHP memory limit to 512M
RUN echo "memory_limit=512M" > /usr/local/etc/php/conf.d/memory-limit.ini

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first (to leverage Docker cache)
COPY src/composer.json src/composer.lock ./

# Now copy the rest of the application code
COPY src/ .

# Run composer install to install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction