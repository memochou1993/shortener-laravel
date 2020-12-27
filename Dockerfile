FROM php:7.2-fpm

RUN apt-get update \
    && apt-get install -y git zip

WORKDIR /var/www

COPY . /var/www

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --optimize-autoloader --no-dev --no-scripts

RUN docker-php-ext-install pdo_mysql

RUN chown -R www-data:www-data \
    /var/www/storage \
    /var/www/bootstrap/cache
