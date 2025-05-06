FROM caddy:latest

COPY deployment/Caddyfile /etc/caddy/Caddyfile

RUN addgroup -g 33 -S www-data; \
    adduser -u 33 -D -S -G www-data www-data

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data /var/www/html

USER www-data