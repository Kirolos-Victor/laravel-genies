FROM php:8.1 as php

LABEL maintainer="Your Name kirolosvictor1@gmail.com"

EXPOSE 8000

RUN apt-get update -y
RUN apt-get install -y unzip libpq-dev libcurl4-gnutls-dev
RUN docker-php-ext-install pdo pdo_mysql bcmath

WORKDIR /var/www/app
COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENTRYPOINT ["/bin/bash", "docker/entrypoint.sh"]

