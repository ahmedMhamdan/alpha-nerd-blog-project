#!/usr/bin/env bash
set -e

mkdir -p public/uploads/posts
mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache

chown -R www-data:www-data storage bootstrap/cache public/uploads || true
chmod -R 775 storage bootstrap/cache public/uploads || true

php artisan config:clear
php artisan route:clear
php artisan view:clear

php artisan migrate --force

apache2-foreground
