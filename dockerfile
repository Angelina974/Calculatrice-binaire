# 1. Image PHP + Apache
FROM php:8.2-apache

# 2. Installer unzip et curl pour Composer
RUN apt-get update \
 && apt-get install -y --no-install-recommends unzip curl \
 && rm -rf /var/lib/apt/lists/*

# 3. Installer Composer globalement
RUN curl -sS https://getcomposer.org/installer | php \
 && mv composer.phar /usr/local/bin/composer

# 4. Copier uniquement composer.json + composer.lock et installer deps
WORKDIR /var/www/html
COPY composer.json composer.lock ./
RUN composer install --no-interaction --optimize-autoloader --dev

# 5. Copier le reste de l’application
COPY . /var/www/html/

# 6. Activer affichage des erreurs (dev)
RUN { \
    echo "display_errors=On"; \
    echo "error_reporting=E_ALL"; \
} >> /usr/local/etc/php/conf.d/docker-php-dev.ini

EXPOSE 80
