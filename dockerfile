FROM php:8.2-apache


RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

COPY . /var/www/html/

RUN { \
    echo "display_errors=On"; \
    echo "error_reporting=E_ALL"; \
} >> /usr/local/etc/php/conf.d/docker-php-dev.ini

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "."]