FROM php:apache-bullseye

RUN apt-get -y update --fix-missing --no-install-recommends
RUN apt-get -y upgrade


RUN apt-get -y install default-mysql-client
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli