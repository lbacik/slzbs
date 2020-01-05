FROM php:fpm

COPY . /project

WORKDIR /project

RUN chown -R www-data.www-data var
