#!/usr/bin/env bash
export DEBIAN_FRONTEND=noninteractive

printf "Setting up the pgbh-api base database config"

[ -r /etc/lsb-release ] && . /etc/lsb-release

if [ -z "$DISTRIB_RELEASE" ] && [ -x /usr/bin/lsb_release ]; then
    # Fall back to using the very slow lsb_release utility
    DISTRIB_RELEASE=$(lsb_release -s -r)
    DISTRIB_CODENAME=$(lsb_release -s -c)
fi

if [ ! -x "/var/www/pgbh-api/.env" ]; then 
    printf "Verifying postgres DB port"
    sed -i 's/DB_PORT=5433/DB_PORT=5432/' /var/www/pgbh-api/.env
fi

echo "Completing installation composers/laravel (as vagrant user)"

printf "Create migration table"
sudo su - vagrant -c "cd /var/www/pgbh-api && php artisan migrate:install"
printf "Perform migrations"
sudo su - vagrant -c "cd /var/www/pgbh-api && php artisan migrate"
printf "Vendor publish"
sudo su - vagrant -c "cd /var/www/pgbh-api && php artisan vendor:publish"
printf "Optimize"
sudo su - vagrant -c "cd /var/www/pgbh-api && php artisan optimize"
printf "Dump autoload"
sudo su - vagrant -c "cd /var/www/pgbh-api && composer dump-autoload"

