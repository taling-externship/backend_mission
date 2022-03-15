# Composer
FROM composer:latest as vendor

COPY database/ database/
COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist


# Frontend
FROM node:14.19.0 as frontend

RUN mkdir -p /app/public

COPY package.json webpack.mix.js package-lock.json /app/
COPY resources/ /app/resources/

WORKDIR /app

RUN npm install && npm run production


# Application
FROM php:8.1.3-apache-buster
COPY . /var/www/html
RUN cp /var/www/html/000-default.conf /etc/apache2/sites-enabled/000-default.conf
RUN cp /var/www/html/.env.production /var/www/html/.env
COPY --from=vendor /app/vendor/ /var/www/html/vendor/
COPY --from=frontend /app/public/js/ /var/www/html/public/js/
COPY --from=frontend /app/public/css/ /var/www/html/public/css/
COPY --from=frontend /app/mix-manifest.json /var/www/html/mix-manifest.json
