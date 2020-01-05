FROM php:7.4-fpm

#pdoインストール
RUN docker-php-ext-install pdo_mysql

#composerインストール
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

#gitインストール
RUN apt-get update -y
RUN apt-get install -y sudo
RUN sudo apt-get install -y git
RUN sudo apt-get install -y apt-utils
RUN sudo apt-get install -y iproute2
RUN sudo apt-get install -y iputils-ping
RUN sudo apt-get install -y zip unzip # php7.0-zip
# composer create-projectでプロジェクトファイルを作るので、Laravelインストーラは入れなくてもいい。
# RUN composer global require "Laravel/installer=~1.4"


RUN echo "export PATH=~/.composer/vendor/bin:$PATH" >> ~/.bashrc
# RUN source ~/.bashrc
