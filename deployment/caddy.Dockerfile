FROM caddy:latest

COPY deployment/Caddyfile /etc/caddy/Caddyfile

WORKDIR /var/www/html

COPY . .