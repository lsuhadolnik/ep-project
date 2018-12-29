#!/bin/bash

# Update PHP - ne bo treba

sudo apt update
# install composer
sudo apt install curl php-cli php-mbstring git unzip php-curl
curl -sS https://getcomposer.org/installer -o composer-setup.php
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# clone project
sudo git clone https://github.com/lsuhadolnik/ep-project.git /var/www/ep-project

sudo chown -R ep:ep /var/www/ep-project
sudo chmod -R 755 /var/www/ep-project/*

# Install dependancies
cd /var/www/ep-project/
composer install
cd ~

sudo rm -rf /etc/apache2/sites-enabled/*
sudo cp /var/www/ep-project/Docs/apache-conf/000-default.conf /etc/apache2/sites-available
sudo cp /var/www/ep-project/Docs/apache-conf/default-ssl.conf /etc/apache2/sites-available

# Enable sites
sudo ln -s /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-enabled/000-default.conf
sudo ln -s /etc/apache2/sites-available/default-ssl.conf /etc/apache2/sites-enabled/default-ssl.conf

# Generate certificates
chmod +x /var/www/ep-project/Docs/gencerts.sh
mkdir /var/www/ep-project/certs
cp /var/www/ep-project/Docs/gencerts.sh /var/www/ep-project/certs
cd /var/www/ep-project/
/var/www/ep-project/certs/gencerts.sh

# Configure apache
sudo a2enmod rewrite
sudo a2enmod ssl
sudo service apache2 restart

# Add mysql user
mysql -u root -pep < /var/www/ep-project/Docs/createMySQLUser.sql

cd /var/www/ep-project
cp .env.example .env
artisan migrate
artisan db:seed



