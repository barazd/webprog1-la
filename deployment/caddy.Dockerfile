FROM caddy:latest

COPY deployment/Caddyfile /etc/caddy/Caddyfile

RUN addgroup -g 101 -S www-data; \
    adduser -u 101 -D -S -G www-data www-data

USER www-data

WORKDIR /var/www/html

COPY . .