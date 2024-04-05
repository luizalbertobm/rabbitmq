FROM php:7.4-apache

ARG USER_ID=1000
ARG GROUP_ID=1000

# Instala o instalador de extensões do PHP
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Instala pacotes e extensões necessárias
RUN chmod +x /usr/local/bin/install-php-extensions \
    && install-php-extensions xdebug mbstring opcache sockets mysqli pdo decimal bcmath amqp @composer @fix_letsencrypt \
    && docker-php-ext-enable xdebug amqp \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/php.ini  \
    && rm -rf /tmp/pear \
    && a2enmod rewrite

COPY .docker/apache2.conf /etc/apache2/apache2.conf
COPY .docker/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Define o usuário e grupo do container
RUN usermod --uid $USER_ID www-data && groupmod --gid $GROUP_ID www-data
RUN chown -R www-data:www-data /var/www

# Define o usuário e grupo do container
WORKDIR /var/www/html
