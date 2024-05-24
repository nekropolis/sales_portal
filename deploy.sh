DIR="/var/www/sales_portal";
cd $DIR || exit;

git checkout package-lock.json

git pull

DIR="/var/www/sales_portal";
cd $DIR || exit;

rm -f storage/logs/*.log
rm -f storage/framework/sessions/*
rm -f bootstrap/cache/*.php

composer install

php artisan cache:clear
php artisan view:clear
php artisan clear-compiled
php artisan route:cache
php artisan config:cache
php artisan livewire:discover
php artisan migrate

rm -rf node_modules
npm install
npm run build

[ -L "public/storage" ] || ln -s ../storage/app/public public/storage

chown -R www-data:www-data $DIR
find $DIR/storage -type d -exec chmod 775 {} \;
find $DIR/storage -type f -exec chmod 664 {} \;
rm -f storage/framework/sessions/*
