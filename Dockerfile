FROM php:7.4-apache
WORKDIR /var/www/html
COPY . /var/www/html
RUN apt-get update && \
    apt-get install -y git zip unzip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader
EXPOSE 8080
CMD ["apache2-foreground"]