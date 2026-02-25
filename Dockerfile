
FROM php:8.4-fpm


RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd intl


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


RUN useradd -ms /bin/bash -u 1000 sail

WORKDIR /var/www/html


RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest


COPY --chown=sail:sail . /var/www/html


USER sail


RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
    && npm install


USER root
RUN chmod -R 775 storage bootstrap/cache \
    && chown -R sail:sail storage bootstrap/cache

USER sail

EXPOSE 9000
CMD ["php-fpm"]
