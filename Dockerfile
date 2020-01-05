FROM php:7.3-fpm

RUN docker-php-ext-install pdo_mysql

COPY . /project
WORKDIR /project

RUN chown -R www-data.www-data var
