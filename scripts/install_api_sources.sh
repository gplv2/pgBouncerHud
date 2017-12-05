#!/usr/bin/env bash
export DEBIAN_FRONTEND=noninteractive

printf "Installing laravel 5.2 api"

[ -r /etc/lsb-release ] && . /etc/lsb-release

if [ -z "$DISTRIB_RELEASE" ] && [ -x /usr/bin/lsb_release ]; then
    # Fall back to using the very slow lsb_release utility
    DISTRIB_RELEASE=$(lsb_release -s -r)
    DISTRIB_CODENAME=$(lsb_release -s -c)
fi

echo "Installing SSH keys"
if [ ! -d "/root/.ssh" ]; then 
    mkdir /root/.ssh
    chmod 700 /root/.ssh
fi

echo "Adding SSH github host key"

# Create known_hosts
touch /root/.ssh/known_hosts

# Add bitbuckets key
ssh-keyscan github.com >> /root/.ssh/known_hosts

echo "Cloning code"

cd /var/www
git clone git@github.com:gplv2/pgBouncerHud.git pgbh-api
cd pgbh-api 

echo "Completing installation composers/laravel"

chown vagrant:vagrant /var/www
chown -R vagrant:vagrant /var/www/pgbh-api

sudo su - vagrant -c "cd /var/www/pgbh-api && composer install --no-progress"
