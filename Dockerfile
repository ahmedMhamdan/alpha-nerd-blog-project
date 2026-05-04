FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    git unzip zip curl libpq-dev libzip-dev libpng-dev libonig-dev nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip mbstring exif pcntl bcmath gd

RUN a2enmod rewrite

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build

RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

COPY apache.conf /etc/apache2/sites-available/000-default.conf

RUN chmod -R 775 storage bootstrap/cache public/uploads

RUN mkdir -p public/uploads/posts \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache public/uploads \
    && chmod -R 775 storage bootstrap/cache public/uploads

CMD ["bash", "start.sh"]




