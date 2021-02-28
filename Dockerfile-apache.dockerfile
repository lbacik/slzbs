FROM php:7 as base

RUN apt update && apt-get install -y \
    libzip-dev

RUN docker-php-ext-install \
    zip

COPY . /project
WORKDIR /project

COPY --from=composer:1.10.15 /usr/bin/composer /usr/bin/composer

RUN composer i \
    && bin/console ckeditor:install \
    && bin/console assets:install

FROM php:7-apache

RUN docker-php-ext-install \
    pdo_mysql

COPY --from=base /project /project
WORKDIR /project

RUN chown -R www-data.www-data var \
    && rm -d /var/www/html \
    && ln -s /project/public /var/www/html \
    && a2enmod rewrite

EXPOSE 80
