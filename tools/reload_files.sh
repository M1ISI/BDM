#!/bin/sh

tools_path=`pwd`

sudo mkdir /var/www/bdm
sudo rsync -a --exclude='.*' "$tools_path"/../bdm/ /var/www/bdm/
sudo chown -R www-data:www-data /var/www
