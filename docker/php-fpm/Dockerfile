FROM php:8.2-fpm-alpine

# Install packages
RUN apk add --no-cache curl git build-base zlib-dev oniguruma-dev autoconf bash supervisor

# Postgres
RUN apk add --no-cache libpq-dev && docker-php-ext-install pdo_pgsql

# Configure non-root user.
RUN apk --no-cache add shadow

ADD supervisord.conf /etc/supervisor/
ADD *.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/*.sh

# Source code
COPY ./ /var/www
WORKDIR /var/www

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/composer --filename=composer

CMD /usr/bin/composer install && supervisord -c /etc/supervisor/supervisord.conf

EXPOSE 8080
