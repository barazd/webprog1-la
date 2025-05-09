FROM php:8.4-fpm

RUN curl -sSLf \
        -o /usr/local/bin/install-php-extensions \
        https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions && \
    chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo_mysql

COPY deployment/php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data /var/www/html

USER www-data