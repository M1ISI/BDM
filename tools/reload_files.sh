#!/bin/sh

#On se place à la racine du dépôt.
if [ "`git rev-parse --show-cdup`" != "" ]; then cd `git rev-parse --show-cdup`; fi
sudo mkdir -p /var/www/bdm
sudo rsync -a --exclude='.*' bdm/ /var/www/bdm/
sudo chown -R www-data:www-data /var/www
