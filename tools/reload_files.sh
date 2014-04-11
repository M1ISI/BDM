#!/bin/sh

sudo mkdir /var/www/bdm
sudo rsync -a --exclude='.*' ../bdm/ /var/www/bdm/
sudo chown -R www-data:www-data /var/www
