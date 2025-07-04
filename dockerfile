FROM php:8.2-apache

# (nouveau) supprimer l’avertissement de ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

COPY . /var/www/html/

RUN { \
    echo "display_errors=On"; \
    echo "error_reporting=E_ALL"; \
} >> /usr/local/etc/php/conf.d/docker-php-dev.ini

EXPOSE 80

