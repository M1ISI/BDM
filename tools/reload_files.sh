#!/bin/sh

sudo mkdir /var/www
sudo cp -rf ../bdm/ /var/www/
sudo chown -R www-data:www-data /var/www
