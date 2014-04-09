#!/bin/sh

cd ../bdm
sudo git checkout-index -a -f --prefix=/var/www/
sudo chown -R www-data:www-data /var/www
